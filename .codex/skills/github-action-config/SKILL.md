---
name: vite-ssh-github-action-deploy
description: Configurar despliegues portables con GitHub Actions para proyectos Vite por SSH/rsync, con variantes de solo frontend estático, backend PHP con Composer o backend Node con PM2. Usar al crear CI/CD, claves SSH de deploy, secrets y variables de GitHub, rutas de producción, document root de subdominios, Apache/Nginx, PHP-FPM, Composer, Node/PM2, releases con symlink, rollback y smoke checks.
---

# Deploy GitHub Actions Para Vite Por SSH

Usa esta skill para guiar al agente, en orden, al configurar deploy automático para proyectos Vite en un servidor accesible por SSH.

Variantes soportadas:

- **A. Solo frontend estático:** Vite genera `dist/` y el servidor sirve HTML/CSS/JS.
- **B. Frontend Vite + backend PHP:** Vite + PHP con Composer, normalmente con web root en `current/public`.
- **C. Frontend Vite + backend Node:** Vite + API Node/Express u otro backend Node gestionado con PM2.

El agente debe elegir una variante y no mezclar plantillas salvo que el proyecto lo requiera explícitamente.

## 0. Orden Obligatorio Del Agente

1. Inspeccionar el proyecto.
2. Preguntar o deducir la variante: `static`, `php-composer` o `node-pm2`.
3. Inspeccionar el hosting por SSH sin cambios destructivos y clasificar `REMOTE_DEPLOY_MODE`.
4. Comprobar permisos remotos, `rsync`, `tar`, espacio disponible y carpetas runtime.
5. Fijar nombres reales: dominio, usuario SSH, host SSH, puerto, ruta destino, rama, versión Node, versión PHP si aplica.
6. Preparar ficheros del proyecto: `.deployignore`, workflow y ajustes de Vite/backend.
7. Dar comandos SSH para preparar destino: usuario, carpetas, `.env`, runtime, servidor web.
8. Dar comandos para generar clave SSH de deploy y explicar privada vs pública.
9. Dar pasos de GitHub: environment `production`, secrets, variables, Actions y permisos.
10. Ejecutar o pedir ejecución del primer deploy.
11. Verificar por SSH y HTTP.
12. Dejar comando de rollback o backup/restore según el modo remoto.

No imprimir secretos. No poner valores reales de `.env` en docs, código ni chat.

## 0.1 Guía Formativa Paso A Paso

Cuando el usuario quiera montar un deploy desde cero, guiarle por pasos cortos y no saltar al workflow hasta tener datos reales del proyecto y del hosting. En cada paso, pedirle que pegue la salida si el agente no puede ejecutarlo directamente.

### Paso 1: Entender El Proyecto Local

Objetivo: saber qué se construye, qué dependencias existen y si front/back están acoplados.

Comandos:

```bash
ls -la
find . -maxdepth 2 -type f \( -name "package.json" -o -name "vite.config.*" -o -name "composer.json" -o -name "composer.lock" -o -name "package-lock.json" \)
cat package.json
test -f composer.json && cat composer.json
git status --short --ignored -- composer.lock package-lock.json .npmrc vendor node_modules
git ls-files composer.lock package-lock.json
```

En PowerShell:

```powershell
Get-ChildItem -Force
Get-ChildItem -Recurse -Depth 2 -Include package.json,vite.config.*,composer.json,composer.lock,package-lock.json
Get-Content package.json
if (Test-Path composer.json) { Get-Content composer.json }
git status --short --ignored -- composer.lock package-lock.json .npmrc vendor node_modules
git ls-files composer.lock package-lock.json
```

Interpretación:

- Si hay `composer.json` y PHP, elegir variante `php-composer`.
- Si `npm run build` ejecuta PHP, Composer o scripts que usan `vendor/autoload.php`, el workflow debe instalar Composer antes del build frontend.
- `composer.lock` y `package-lock.json` deben estar versionados para CI reproducible.
- `.npmrc`, `vendor/` y `node_modules/` no deben subirse al repo.

### Paso 2: Inspeccionar El Hosting Sin Cambios Destructivos

Objetivo: descubrir rutas reales, document root, PHP, Composer remoto y si el hosting permite releases con symlink o exige carpetas fijas.

Comandos en SSH remoto:

```bash
pwd
ls -la
ls -la public socios App vendor www 2>/dev/null || true
[ -L public ] && readlink public || echo "public no es symlink"
[ -L socios ] && readlink socios || echo "socios no es symlink"
[ -f .env ] && echo ".env existe" || echo ".env no existe"
[ -f public/index.php ] && echo "public/index.php existe" || true
[ -f socios/index.php ] && echo "socios/index.php existe" || true
[ -f App/config/config.php ] && echo "App/config/config.php existe" || true
php -v | head -n 1
which php
composer --version 2>/dev/null || echo "composer no disponible en hosting"
```

Interpretación:

- Si el subdominio apunta a una carpeta física fija, por ejemplo `~/socios`, usar `REMOTE_DEPLOY_MODE=fixed-dirs`.
- Si el document root puede apuntar a `current/public` o `current/socios`, usar `release-symlink`.
- Si existe otro sitio, por ejemplo WordPress en `~/www`, no tocar esa carpeta.
- Si Composer no existe en remoto, Composer debe correr en GitHub Actions y se debe subir `vendor/`.

### Paso 3: Comprobar Permisos Y Herramientas Remotas

Objetivo: evitar descubrir problemas de permisos dentro del primer deploy.

Comandos en SSH remoto, adaptando nombres de carpetas:

```bash
id
groups
command -v rsync || echo "rsync no disponible"
rsync --version | head -n 1
command -v tar || echo "tar no disponible"
df -h .

mkdir -p ~/.deploy-staging ~/.deploy-backups
touch App/.deploy-write-test
touch vendor/.deploy-write-test
touch socios/.deploy-write-test
touch ~/.deploy-staging/.deploy-write-test
touch ~/.deploy-backups/.deploy-write-test
ls -la App/.deploy-write-test vendor/.deploy-write-test socios/.deploy-write-test ~/.deploy-staging/.deploy-write-test ~/.deploy-backups/.deploy-write-test
rm -f App/.deploy-write-test vendor/.deploy-write-test socios/.deploy-write-test ~/.deploy-staging/.deploy-write-test ~/.deploy-backups/.deploy-write-test
ls -ld socios socios/.well-known App/logs App/tmp 2>/dev/null || true
```

Interpretación:

- Excluir siempre carpetas runtime o gestionadas por hosting: `.well-known/`, `uploads/`, `App/logs/`, `App/tmp/`.
- Si la carpeta pública pertenece a `www-data` pero el usuario SSH escribe por grupo, usar `rsync` con `--omit-dir-times --no-perms --no-owner --no-group`.
- Si el usuario confirma backups recuperables del hosting, puede omitirse backup automático; si no, preparar backup de las carpetas tocadas.

### Paso 4: Fijar Valores Antes De Escribir El Workflow

Crear una tabla con valores reales:

```text
APP_DOMAIN=
PRODUCTION_URL=
SSH_HOST=
SSH_PORT=
SSH_USER=
REMOTE_DEPLOY_MODE=release-symlink|fixed-dirs
DEPLOY_PATH=             # release-symlink
REMOTE_BASE_PATH=        # fixed-dirs
LOCAL_PUBLIC_DIR=public
REMOTE_PUBLIC_DIR=public|socios
NODE_VERSION=
PHP_VERSION=
BRANCH=main
```

Ayudar al usuario a encontrar `SSH_HOST`, `SSH_PORT` y `SSH_USER`:

- Del comando SSH: `ssh -p 2222 usuario@host` da `SSH_PORT=2222`, `SSH_USER=usuario`, `SSH_HOST=host`.
- Del panel del hosting: buscar secciones `SSH`, `Servidor`, `Hostname`, `IPv4`, `Usuario`.
- Probar puerto desde local:

```powershell
Test-NetConnection <ssh-host> -Port <ssh-port>
```

### Paso 5: Preparar Archivos Del Repo

Objetivo: que GitHub Actions pueda construir siempre igual.

- Crear `.deployignore`.
- Corregir `.gitignore` si ignora `composer.lock` o `package-lock.json`.
- Mantener ignorados `.env`, `.npmrc`, `vendor/` y `node_modules/`.
- Si hay registry npm privado, generar `.npmrc` dentro del workflow desde secret; no subir tokens.
- Si GSAP usa `@gsap/shockingly`, preferir migrar a `gsap` público `>=3.13` si el proyecto lo permite.

### Paso 6: Crear Clave SSH De Deploy

Objetivo: GitHub Actions entra por SSH con una clave dedicada, no con contraseña ni clave personal.

PowerShell recomendado:

```powershell
ssh-keygen -t ed25519 -C "github-actions-<proyecto>" -f "$env:USERPROFILE\Desktop\github-actions-<proyecto>"
```

Pulsar Enter cuando pregunte passphrase si el workflow no va a desbloquear passphrase. En algunos Windows OpenSSH, `-N ""` puede fallar con `option requires an argument -- N`; en ese caso usar el comando anterior y dejar passphrase vacía de forma interactiva.

Copiar clave pública:

```powershell
Get-Content "$env:USERPROFILE\Desktop\github-actions-<proyecto>.pub" -Raw | Set-Clipboard
```

En el servidor, añadir la pública a `~/.ssh/authorized_keys` sin borrar claves existentes:

```bash
mkdir -p ~/.ssh
chmod 700 ~/.ssh
nano ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
```

Probar desde local:

```powershell
ssh -i "$env:USERPROFILE\Desktop\github-actions-<proyecto>" -p <ssh-port> <ssh-user>@<ssh-host> "whoami && pwd && hostname"
```

Copiar clave privada para GitHub:

```powershell
Get-Content "$env:USERPROFILE\Desktop\github-actions-<proyecto>" -Raw | Set-Clipboard
```

No imprimir la clave privada en el chat.

### Paso 7: Configurar GitHub Environment

Si el job usa:

```yaml
environment: production
```

configurar siempre:

```text
Settings > Environments > production
```

No confundirlo con `Settings > Secrets and variables > Actions`, que crea valores globales del repo.

En **Environment secrets**:

```text
SSH_HOST=<host SSH>
SSH_PORT=<puerto SSH>
SSH_USER=<usuario SSH>
SSH_PRIVATE_KEY=<clave privada OpenSSH completa>
DEPLOY_PATH=<ruta base con releases/current, solo release-symlink>
REMOTE_BASE_PATH=<ruta base fija, solo fixed-dirs>
NPM_TOKEN=<solo si hay registry npm privado>
```

En **Environment variables**:

```text
PRODUCTION_URL=<url pública, por ejemplo https://app.example.com>
VITE_APP_URL=<solo si el frontend la necesita>
VITE_API_BASE_URL=<solo si el frontend la necesita>
REMOTE_PUBLIC_DIR=<opcional si se decide no fijarlo en env del workflow>
```

Regla clave: `PRODUCTION_URL` no es secret; debe estar en **Environment variables** para que `${{ vars.PRODUCTION_URL }}` tenga valor. Si falta, el smoke check puede mostrar `curl "/"` o `URL rejected: No host part in the URL`.

### Paso 8: Crear El Workflow Adecuado

Elegir una sola plantilla:

- `static`: solo front estático.
- `php-composer`: Vite + PHP con releases si el document root es configurable.
- `fixed-dirs`: PHP + Vite en hosting compartido con carpetas remotas fijas.
- `node-pm2`: Vite + backend Node con PM2.

Para `fixed-dirs`, el workflow completo debe:

1. Ejecutar `composer install` en GitHub Actions.
2. Ejecutar `npm ci`.
3. Ejecutar `npm run build`.
4. Preparar `.deploy/release`.
5. Renombrar `LOCAL_PUBLIC_DIR` a `REMOTE_PUBLIC_DIR` si difieren.
6. Subir `vendor/`, `App/` y la carpeta pública con `rsync`.
7. Excluir runtime y carpetas del hosting.
8. Verificar `vendor/autoload.php` por SSH.
9. Hacer smoke check HTTP con `PRODUCTION_URL`.

### Paso 9: Primer Deploy Y Verificación

Antes de push, validar localmente si el entorno lo permite:

```bash
composer validate --no-check-publish
composer install
npm ci
npm run build
git status --short
```

No incluir artefactos generados por build local salvo decisión explícita del proyecto.

Después:

```bash
git add .github/workflows/deploy-production.yml .deployignore
git add .gitignore composer.lock package-lock.json 2>/dev/null || true
git commit -m "Add production deploy workflow"
git push
```

Adaptar el `git add` a los ficheros reales del proyecto. No forzar lockfiles inexistentes, pero si existen deben quedar versionados.

Verificar:

- GitHub Actions debe pasar por Composer, npm, build, subida SSH, verificación remota y smoke check.
- Por HTTP:

```bash
curl -I <PRODUCTION_URL>
```

- Por SSH en PHP:

```bash
php -r "require '<ruta-remota>/vendor/autoload.php'; echo 'autoload ok'.PHP_EOL;"
```

### Paso 10: Diagnóstico De Fallos Habituales

- `npm warn Unknown project config "always-auth"`: quitar `always-auth=true`; usar `npm ci --no-audit --fund=false --progress=false`.
- `npm ci` se queda atascado con GSAP privado: comprobar si puede migrarse a `gsap` público `>=3.13` y eliminar `NPM_TOKEN`.
- `failed to set times on ".../socios/."`: añadir `--omit-dir-times`.
- `failed to set permissions on ".../socios/."`: añadir `--no-perms --no-owner --no-group`.
- `curl "/"` o `URL rejected: No host part in the URL`: falta `PRODUCTION_URL` en **Environment variables** o el job no usa `environment: production`.
- El cambio de documentación dispara deploy: añadir `paths-ignore` para `.codex/**`, `AGENTS*.md`, `README.md`, `.vscode/**` y carpetas documentales.

## 1. Datos Que Hay Que Fijar

Usar esta tabla como checklist antes de escribir el workflow:

| Dato | Ejemplo | Notas |
| --- | --- | --- |
| `APP_DOMAIN` | `profe-lab-pfinal.webda.eus` | Dominio público |
| `PRODUCTION_URL` | `https://profe-lab-pfinal.webda.eus` | URL para smoke check |
| `DEPLOY_PATH` | `/var/www/profe-lab-pfinal.webda.eus` | Base con `releases`, `shared`, `current` |
| `SSH_HOST` | `webda.eus` o IP | Host de conexión SSH; no tiene por qué ser el dominio público |
| `SSH_PORT` | `22` | Puerto SSH real |
| `SSH_USER` | `deploy-profe-lab` | Usuario remoto de deploy |
| `BRANCH` | `main` | Rama que dispara producción |
| `NODE_VERSION` | `24` | Usar `.nvmrc` si existe |
| `PHP_VERSION` | `8.3` | Solo variante PHP; debe coincidir con servidor |
| `LOCAL_PUBLIC_DIR` | `public` | Carpeta pública generada por el proyecto |
| `REMOTE_PUBLIC_DIR` | `public` o `socios` | Carpeta pública real en hosting |
| `REMOTE_DEPLOY_MODE` | `release-symlink` o `fixed-dirs` | Estrategia remota real |
| `PM2_APP_NAME` | `profe-lab-api` | Solo variante Node |
| `APP_PORT` | `15030` | Solo variante Node detrás de proxy |

Convención recomendada para secrets:

| Secret | Qué contiene |
| --- | --- |
| `SSH_HOST` | Host/IP SSH |
| `SSH_PORT` | Puerto SSH |
| `SSH_USER` | Usuario SSH |
| `SSH_PRIVATE_KEY` | Clave privada OpenSSH completa, no contraseña |
| `DEPLOY_PATH` | Ruta base con `releases`, `shared` y `current`, solo `release-symlink` |
| `REMOTE_BASE_PATH` | Ruta base fija del hosting, solo `fixed-dirs` |
| `NPM_TOKEN` | Token de registry npm privado, solo si el proyecto usa paquetes privados |

Si el proyecto usa prefijo de entorno, mantener el mismo significado. Ejemplo Orduda: `PROD_SSH_HOST`, `PROD_SSH_PORT`, `PROD_SSH_USER`, `PROD_SSH_PRIVATE_KEY`.

### 1.1 Cómo Encontrar `SSH_HOST`, `SSH_PORT` Y `SSH_USER`

Antes de pedir al usuario que invente valores, ayudarle a localizarlos:

- Mirar el comando con el que ya entra por SSH. Ejemplo: `ssh -p 2222 usuario@host.example.com` significa `SSH_USER=usuario`, `SSH_HOST=host.example.com`, `SSH_PORT=2222`.
- Si entra sin `-p`, asumir provisionalmente `SSH_PORT=22` y comprobarlo.
- Revisar el panel del hosting en la sección SSH, servidor, información y rutas, o consola SSH.
- En consolas web, buscar líneas tipo `Hostname: ...`, `IPv4: ...` y `Usuario: ...`.
- Preferir hostname estable a IP si el panel lo proporciona.
- Verificar desde local que el puerto responde antes de crear secrets.

Comprobaciones:

```bash
ssh -p 22 usuario@host.example.com "whoami && pwd"
```

En PowerShell:

```powershell
Test-NetConnection host.example.com -Port 22
```

No pedir ni imprimir la contraseña SSH. Para GitHub Actions se usará una clave privada dedicada en `SSH_PRIVATE_KEY`.

## 2. Inspección Del Proyecto

Ejecutar:

```bash
ls -la
find . -maxdepth 2 -type f \( -name "package.json" -o -name "vite.config.*" -o -name "composer.json" -o -name "server.js" -o -name "index.js" -o -name "app.js" \)
```

Detectar variante:

- Si no hay backend runtime: usar **A. Solo frontend estático**.
- Si hay `composer.json`, ficheros `.php`, `public/index.php` o backend PHP: usar **B. PHP + Composer**.
- Si hay backend Node (`server.js`, `api/index.js`, Express, Fastify, Socket.IO, etc.): usar **C. Node + PM2**.

Comprobar scripts:

```bash
cat package.json
test -f composer.json && cat composer.json
```

Esperado para Vite:

```json
{
  "scripts": {
    "build": "vite"
  }
}
```

### 2.1 Orden Real De Build En PHP + Vite

Antes de escribir el workflow, leer los scripts de `package.json`.

Si `npm run build`, `prebuild` o scripts auxiliares ejecutan Composer o PHP, por ejemplo:

```json
{
  "scripts": {
    "prebuild": "composer liquidstack-core:sync-resources",
    "build": "concurrently \"php App/tools/build-sitemap.php\" \"vite build\""
  }
}
```

el orden del workflow **no** puede ser `npm ci -> npm run build -> composer install`. Debe ser:

1. `setup-php`
2. `composer validate`
3. `composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader`
4. `setup-node`
5. `npm ci`
6. `npm run build`
7. preparar release y subirlo

Motivo: el build frontend puede depender de `vendor/autoload.php`, comandos Composer o clases instaladas por Composer.

### 2.2 Lockfiles Obligatorios Para CI

Para workflows reproducibles:

- `package-lock.json` debe estar versionado si se usa `npm ci`.
- `composer.lock` debe estar versionado si se usa `composer install`.
- Si `.gitignore` ignora esos lockfiles, corregirlo antes del primer deploy o `git add -f package-lock.json composer.lock` solo como medida puntual.
- No subir `node_modules/` ni `vendor/`; el workflow los reconstruye.

Comprobación local obligatoria:

```bash
git status --short --ignored -- composer.lock package-lock.json .npmrc vendor node_modules
git ls-files composer.lock package-lock.json
```

Si salen como ignorados y no versionados:

- quitar `composer.lock` y `package-lock.json` de `.gitignore`;
- mantener `.npmrc`, `vendor/` y `node_modules/` ignorados por Git;
- confirmar que `git status --short` muestra `composer.lock` y `package-lock.json` como añadibles.

### 2.3 Registries NPM Privados

Revisar `.npmrc` sin imprimir tokens.

Si el proyecto usa un registry privado, no subir `.npmrc` con secretos al repo. Crear `.npmrc` durante el workflow a partir de un secret. Ejemplo para GSAP/GreenSock:

```yaml
      - name: Configure private npm registry
        env:
          NPM_TOKEN: ${{ secrets.NPM_TOKEN }}
        run: |
          set -euo pipefail
          if [ -z "${NPM_TOKEN:-}" ]; then
            echo "NPM_TOKEN is required for the private npm registry." >&2
            exit 1
          fi
          printf '%s\n' "//npm.greensock.com/:_authToken=${NPM_TOKEN}" > .npmrc
          printf '%s\n' '@gsap:registry=https://npm.greensock.com' >> .npmrc
```

Este paso debe ejecutarse antes de `npm ci`.

Con npm 11, no añadir `always-auth=true`: emite `npm warn Unknown project config "always-auth"` y dejará de estar soportado. Para CI, preferir:

```bash
npm ci --no-audit --fund=false --progress=false
```

Si un run queda atascado en `npm ci` mostrando solo ese warning:

1. Cancelar el run en GitHub Actions.
2. Quitar `always-auth=true` del `.npmrc` generado por el workflow.
3. Cambiar el paso a `npm ci --no-audit --fund=false --progress=false`.
4. Añadir `timeout-minutes` al job si no existía.
5. Hacer commit y push del ajuste.

Si el workflow usa `concurrency.cancel-in-progress: false`, cancelar manualmente el run atascado antes de empujar el fix para evitar cola.

Caso GSAP:

- Si el proyecto usa `gsap` como `npm:@gsap/shockingly` y `.npmrc` apunta a `npm.greensock.com`, comprobar la documentación actual de GSAP antes de mantener ese registry.
- La documentación oficial de GSAP indica que el registry privado ya no se mantiene y que desde GSAP `3.13` los plugins están disponibles en npm público.
- Para proyectos nuevos o migrables, cambiar a `gsap` público `>=3.13`, regenerar `package-lock.json`, eliminar el paso `Configure private npm registry` del workflow y no crear `NPM_TOKEN`.
- Mantener `NPM_TOKEN` solo si otro paquete privado real lo necesita.

Comandos de migración:

```bash
npm install gsap@latest --save-exact --package-lock-only --ignore-scripts --no-audit --fund=false --registry=https://registry.npmjs.org
npm ci --no-audit --fund=false --progress=false
npm run build
```

Si `.npmrc` local solo existía para GSAP privado, eliminarlo o quitar las líneas `@gsap:registry`, `_authToken` y `always-auth` para evitar warnings locales.

## 3. Ficheros Comunes Del Proyecto

### 3.1 `.deployignore`

Crear en la raíz:

```gitignore
.git/
.github/
.deploy/
node_modules/
.env
.env.*
*.log
npm-debug.log*
yarn-debug.log*
yarn-error.log*
.DS_Store
.vscode/
.idea/
coverage/
tests/
tmp/
```

No excluir `src/` a ciegas. En PHP puede ser código autoloaded por Composer; en frontend Vite suele ser fuente no necesaria en producción. Revisar antes.

Regla para `vendor/`:

- En Git, `vendor/` debe estar ignorado.
- En `.deployignore`, no excluir `vendor/` si el workflow ejecuta `composer install` en CI y el hosting no tiene Composer.
- Si Composer se ejecuta en remoto, entonces sí se puede excluir `vendor/` del paquete subido.

### 3.2 Vite

Mantener `vite.config.*` si ya compila correctamente.

Frontend estático normal:

```js
import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    outDir: 'dist',
    sourcemap: false,
    emptyOutDir: true
  }
});
```

Si PHP sirve assets desde `public/build`:

```js
import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    outDir: 'public/build',
    sourcemap: false,
    emptyOutDir: true,
    manifest: true
  }
});
```

Regla crítica: solo usar `VITE_*` para valores públicos de navegador. Nunca meter secretos en `VITE_*`.

### 3.3 Web Root Remoto Distinto De `public`

No asumir que la carpeta pública remota se llama igual que la local.

Caso habitual:

```text
release/
  App/
  vendor/
  .env -> ../shared/.env
  public/
    index.php
    assets/
```

Web root:

```text
$DEPLOY_PATH/current/public
```

Caso hosting con carpeta pública personalizada, por ejemplo un subdominio que apunta a `socios/`:

```text
release/
  App/
  vendor/
  .env -> ../shared/.env
  socios/
    index.php
    assets/
```

Web root:

```text
$DEPLOY_PATH/current/socios
```

En este caso el workflow debe copiar o renombrar `public/` a `socios/` dentro de la release antes de activar el symlink. El backend (`App/`), `.env` y `vendor/` deben quedar como hermanos de `socios/`, no dentro de la carpeta pública.

Esto permite convivir con otros sitios en el mismo hosting, por ejemplo WordPress instalado en la raíz pública principal y un subdominio apuntando a una carpeta propia.

### 3.4 Hosting Compartido Con Document Root Fijo

Antes de elegir el workflow de producción, confirmar cómo apunta el subdominio:

- **Document root configurable:** apuntarlo a `$DEPLOY_PATH/current/$REMOTE_PUBLIC_DIR`. Usar releases atómicas con symlink `current`.
- **Document root fijo pero permite symlinks:** dejar el backend en releases y hacer que la carpeta pública fija, por ejemplo `~/socios`, sea symlink a `$DEPLOY_PATH/current/$REMOTE_PUBLIC_DIR`.
- **Document root fijo sin symlinks:** usar despliegue directo a la estructura fija del hosting, por ejemplo `~/socios`, `~/App`, `~/vendor` y `~/.env`. Este modo pierde rollback atómico; hacer backup previo y evitar `rsync --delete` sobre carpetas runtime.

No tocar la raíz pública de otro sitio existente, por ejemplo un WordPress instalado en `www/`. El subdominio del proyecto debe quedar aislado en su document root propio.

Orden recomendado para `REMOTE_DEPLOY_MODE=fixed-dirs`:

1. Inspeccionar hosting y confirmar rutas fijas.
2. Confirmar permisos de escritura, `rsync`, `tar` y espacio.
3. Corregir `.gitignore` para versionar lockfiles.
4. Crear `.deployignore` sin excluir `vendor/` si Composer corre en CI.
5. Generar clave SSH dedicada, instalar la pública y probar acceso desde local.
6. Crear workflow `fixed-dirs`.
7. Crear environment `production` en GitHub.
8. Crear secrets y variables en GitHub.
9. Commit y push a la rama de producción.
10. Ejecutar `workflow_dispatch` o push a `main`.
11. Verificar por SSH y HTTP.

Checklist validado para `fixed-dirs` en hosting compartido:

- Confirmar que el subdominio apunta a su carpeta pública propia y no a la raíz de otro sitio. Ejemplo: `~/socios` para el subdominio y `~/www` reservado para WordPress.
- Si el backend vive fuera de la carpeta pública, mantener estructura de hermanos: `~/.env`, `~/App`, `~/vendor` y `~/socios`.
- Si `composer` no existe en remoto, ejecutar `composer install` en GitHub Actions y subir `vendor/`.
- Si `npm run build` ejecuta scripts PHP o Composer, instalar dependencias Composer antes de `npm ci` y `npm run build`.
- Crear `.deployignore` sin excluir `vendor/` cuando `vendor/` se genera en CI y debe subirse al hosting.
- En GitHub, usar `Settings > Environments > production`, no solo `Settings > Secrets and variables > Actions`, cuando el job declare `environment: production`.
- En **Environment secrets**, guardar valores sensibles: `SSH_HOST`, `SSH_PORT`, `SSH_USER`, `SSH_PRIVATE_KEY` y `REMOTE_BASE_PATH`.
- En **Environment variables**, guardar valores no sensibles: `PRODUCTION_URL`. Si falta aquí, `${{ vars.PRODUCTION_URL }}` estará vacío y el smoke check puede acabar ejecutando `curl "/"`.
- Probar que el run completo pasa por Composer, npm, build, `rsync`, verificación PHP remota y smoke check HTTP.
- Tras el primer deploy correcto, dejar `paths-ignore` para que cambios de `.codex/`, `AGENTS*.md`, `README.md` o documentación no disparen despliegues innecesarios.

## 4. Preparar SSH En El Servidor

### 4.0 Paso 1 Remoto: Inspección Del Hosting

Antes de crear workflow, secrets o claves de deploy, entrar por SSH con el usuario real del hosting y ejecutar una inspección no destructiva.

Desde la ruta donde vive o vivirá el proyecto:

```bash
pwd
ls -la
ls -la public socios App vendor 2>/dev/null || true
[ -L public ] && readlink public || true
[ -L socios ] && readlink socios || true
[ -f .env ] && echo ".env existe" || echo ".env no existe"
[ -f public/index.php ] && echo "public/index.php existe" || true
[ -f socios/index.php ] && echo "socios/index.php existe" || true
[ -f App/config/config.php ] && echo "App/config/config.php existe" || true
php -v | head -n 1
which php
composer --version 2>/dev/null || echo "composer no disponible en hosting"
```

No imprimir el contenido de `.env` ni secretos.

Con la salida, fijar estos datos antes de continuar:

```text
REMOTE_BASE_PATH=
REMOTE_PUBLIC_DIR=
REMOTE_DEPLOY_MODE=
PHP_VERSION=
COMPOSER_REMOTE=
```

Reglas de decisión:

- Si el document root puede apuntar a `$DEPLOY_PATH/current/$REMOTE_PUBLIC_DIR`, usar `REMOTE_DEPLOY_MODE=release-symlink`.
- Si la carpeta pública real ya existe, no es symlink y el hosting no permite cambiar document root, usar `REMOTE_DEPLOY_MODE=fixed-dirs`.
- Si el hosting permite convertir la carpeta pública fija en symlink, se puede usar `release-symlink`, pero solo tras backup y confirmación explícita.
- Si `composer` no existe en remoto, el workflow debe ejecutar `composer install` en GitHub Actions y subir `vendor/`.
- Si hay otro sitio en la misma cuenta, por ejemplo WordPress en `www/`, no tocar esa carpeta ni usarla como base del deploy.

### 4.0.1 Paso 2 Remoto: Permisos Y Herramientas

Después de clasificar el hosting, comprobar permisos de escritura, `rsync`, `tar` y espacio disponible antes de crear el workflow:

```bash
id
groups
command -v rsync || echo "rsync no disponible"
rsync --version | head -n 1
command -v tar || echo "tar no disponible"
command -v /bin/tar || true
df -h .

mkdir -p ~/.deploy-staging ~/.deploy-backups

touch App/.deploy-write-test
touch vendor/.deploy-write-test
touch socios/.deploy-write-test
touch ~/.deploy-staging/.deploy-write-test
touch ~/.deploy-backups/.deploy-write-test

ls -la App/.deploy-write-test vendor/.deploy-write-test socios/.deploy-write-test ~/.deploy-staging/.deploy-write-test ~/.deploy-backups/.deploy-write-test

rm -f App/.deploy-write-test vendor/.deploy-write-test socios/.deploy-write-test ~/.deploy-staging/.deploy-write-test ~/.deploy-backups/.deploy-write-test

ls -ld socios socios/.well-known App/logs App/tmp 2>/dev/null || true
```

Si alguna escritura falla, no seguir con el workflow hasta resolver propietario/permisos o ajustar las rutas.

Notas para interpretar la salida:

- Si una carpeta pública, por ejemplo `socios/`, pertenece a `www-data` pero el usuario SSH puede crear el archivo de prueba por permisos de grupo, el deploy puede continuar.
- Si existen rutas gestionadas por el hosting como `socios/.well-known` con propietario `root`, excluirlas siempre del `rsync --delete`.
- Si existen carpetas runtime como `App/logs` o `App/tmp`, excluirlas del deploy de `App/`.
- Si `rsync` falla con `failed to set times on ".../socios/.": Operation not permitted`, añadir `--omit-dir-times` a los `rsync` del workflow. En hostings compartidos es normal poder escribir por permisos de grupo pero no poder cambiar metadatos de una carpeta propiedad de `www-data`.
- Si después falla con `failed to set permissions on ".../socios/.": Operation not permitted`, añadir también `--no-perms --no-owner --no-group`. En carpetas públicas propiedad de `www-data` no basta con poder escribir: `rsync -a` intenta preservar metadatos que el usuario SSH no puede cambiar.
- Si el disco está justo de espacio, no hacer backup completo del home. Respaldar solo las carpetas afectadas por el deploy: `App/`, `vendor/` y la carpeta pública fija.
- El backup automático del workflow puede omitirse solo si el usuario confirma que el hosting tiene backups recuperables y acepta restaurar desde proveedor/panel ante un fallo.
- En algunos hostings `tar` aparece como alias interactivo. En workflows no interactivos usar `/bin/tar` si existe.

### 4.1 Usuario Y Carpetas

En VPS con `sudo`:

```bash
sudo adduser --disabled-password --gecos "" deploy-profe-lab
sudo mkdir -p /var/www/profe-lab-pfinal.webda.eus/releases
sudo mkdir -p /var/www/profe-lab-pfinal.webda.eus/shared
sudo mkdir -p /var/www/profe-lab-pfinal.webda.eus/shared/uploads
sudo chown -R deploy-profe-lab:www-data /var/www/profe-lab-pfinal.webda.eus
sudo chmod -R 775 /var/www/profe-lab-pfinal.webda.eus
```

En hosting compartido sin `sudo`, usar el usuario dado por el proveedor y crear rutas dentro de `$HOME`:

```bash
mkdir -p ~/profe-lab-pfinal/releases
mkdir -p ~/profe-lab-pfinal/shared/uploads
chmod 755 ~/profe-lab-pfinal
```

En ese caso `DEPLOY_PATH` será algo como:

```text
/home/usuario/profe-lab-pfinal
```

### 4.2 `.env` En Destino

Solo si el backend lo necesita:

```bash
nano /var/www/profe-lab-pfinal.webda.eus/shared/.env
chmod 600 /var/www/profe-lab-pfinal.webda.eus/shared/.env
```

No subir `.env` desde GitHub salvo decisión explícita. Lo normal es tenerlo en `shared/.env` y enlazarlo a cada release.

## 5. Clave SSH De Deploy

`SSH_PRIVATE_KEY` no es la contraseña del usuario. Es una clave privada completa:

```text
-----BEGIN OPENSSH PRIVATE KEY-----
...
-----END OPENSSH PRIVATE KEY-----
```

La clave pública correspondiente va en `~/.ssh/authorized_keys` del usuario remoto.

### 5.1 Opción Recomendada: Generar Clave En Local

En local:

```bash
ssh-keygen -t ed25519 -C "github-actions-profe-lab-pfinal" -f github-actions-profe-lab-pfinal -N ""
```

En PowerShell, el camino más compatible es ejecutar sin `-N` y dejar la passphrase vacía cuando la pida:

```powershell
ssh-keygen -t ed25519 -C "github-actions-profe-lab-pfinal" -f "$env:USERPROFILE\Desktop\github-actions-profe-lab-pfinal"
```

Cuando pregunte:

```text
Enter passphrase:
Enter same passphrase again:
```

pulsar Enter dos veces.

Si se quiere forzar desde línea de comandos, probar con comillas simples:

```powershell
ssh-keygen -t ed25519 -C "github-actions-profe-lab-pfinal" -f "$env:USERPROFILE\Desktop\github-actions-profe-lab-pfinal" -N ''
```

En algunas versiones de `ssh-keygen` en Windows, `-N ""` falla con `option requires an argument -- N`.

Esto crea:

- `github-actions-profe-lab-pfinal`: privada, se guarda en GitHub como `SSH_PRIVATE_KEY`.
- `github-actions-profe-lab-pfinal.pub`: pública, se instala en el servidor.

Instalar la pública:

```bash
ssh -p 22 deploy-profe-lab@webda.eus "mkdir -p ~/.ssh && chmod 700 ~/.ssh"
cat github-actions-profe-lab-pfinal.pub | ssh -p 22 deploy-profe-lab@webda.eus "cat >> ~/.ssh/authorized_keys && chmod 600 ~/.ssh/authorized_keys"
```

Probar acceso:

```bash
ssh -i ./github-actions-profe-lab-pfinal -p 22 deploy-profe-lab@webda.eus "whoami && pwd"
```

En PowerShell:

```powershell
ssh -i "$env:USERPROFILE\Desktop\github-actions-profe-lab-pfinal" -p 22 deploy-profe-lab@webda.eus "whoami && pwd && hostname"
```

### 5.2 Alternativa: Generar Clave Dentro Del Servidor

Usar solo si no se puede generar localmente. Luego borrar la copia privada del servidor.

```bash
ssh -p 22 deploy-profe-lab@webda.eus
mkdir -p ~/.ssh
chmod 700 ~/.ssh
ssh-keygen -t ed25519 -C "github-actions-profe-lab-pfinal" -f ~/.ssh/github-actions-profe-lab-pfinal -N ""
cat ~/.ssh/github-actions-profe-lab-pfinal.pub >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
cat ~/.ssh/github-actions-profe-lab-pfinal
rm -f ~/.ssh/github-actions-profe-lab-pfinal ~/.ssh/github-actions-profe-lab-pfinal.pub
```

Pegar el contenido mostrado por `cat` como `SSH_PRIVATE_KEY` en GitHub. No borrar `authorized_keys`.

### 5.3 Passphrase

El workflow base no desbloquea passphrase. Generar una clave sin passphrase: con `-N ""` o `-N ''` si la versión local lo soporta, o dejando la passphrase vacía de forma interactiva. Compensar con usuario limitado, clave dedicada por proyecto y permisos mínimos.

## 6. Configuración En GitHub

### 6.1 UI De GitHub

En el repositorio:

1. `Settings > Actions > General`: permitir GitHub Actions.
2. `Settings > Environments`: crear `production`.
3. En `production`, añadir secrets:
   - `SSH_HOST`
   - `SSH_PORT`
   - `SSH_USER`
   - `SSH_PRIVATE_KEY`
   - `DEPLOY_PATH`, solo si se usa `release-symlink`.
   - `REMOTE_BASE_PATH`, solo si se usa `fixed-dirs`.
   - `NPM_TOKEN`, solo si hay registry npm privado
4. En `production`, añadir variables:
   - `PRODUCTION_URL`
   - `VITE_APP_URL`, si el frontend la usa.
   - `VITE_API_BASE_URL`, si el frontend la usa.
   - `PM2_APP_NAME`, solo Node si se quiere variable en lugar de `env`.
   - `APP_PORT`, solo Node si se quiere variable en lugar de `env`.
5. Si se desea aprobación manual, configurar required reviewers en el environment `production`.

Ruta directa:

```text
https://github.com/<org>/<repo>/settings/environments
```

Si el usuario está en:

```text
Settings > Secrets and variables > Actions
```

eso gestiona secrets/variables globales del repositorio. Para workflows con:

```yaml
environment: production
```

preferir `Settings > Environments > production`, porque secrets y variables quedan aislados por entorno.

### 6.1.1 Checklist UI Para Environment `production`

Usar este checklist cuando el workflow incluya:

```yaml
jobs:
  deploy:
    environment: production
```

Crear o abrir:

```text
Settings > Environments > production
```

En **Environment secrets**, añadir:

```text
SSH_HOST=<host SSH estable, por ejemplo vl28050.dinaserver.com>
SSH_PORT=<puerto SSH, normalmente 22>
SSH_USER=<usuario SSH>
SSH_PRIVATE_KEY=<clave privada OpenSSH dedicada al deploy>
DEPLOY_PATH=<ruta base con releases/current, solo release-symlink>
REMOTE_BASE_PATH=<ruta base remota fija, por ejemplo /home/usuario, solo fixed-dirs>
NPM_TOKEN=<solo si el proyecto usa registry npm privado>
```

En **Environment variables**, añadir:

```text
PRODUCTION_URL=<url pública de producción>
```

Comprobar visualmente que `PRODUCTION_URL` aparece bajo **Environment variables**. Si aparece en **Environment secrets**, o no aparece en esa sección, `${{ vars.PRODUCTION_URL }}` será vacío.

Diagnóstico habitual: si el smoke check muestra `curl "/"` o `URL rejected: No host part in the URL`, falta `PRODUCTION_URL` en `Settings > Environments > production > Environment variables`, está mal escrito, o el job no tiene `environment: production`.

Para copiar la clave privada sin imprimirla en PowerShell:

```powershell
Get-Content "$env:USERPROFILE\Desktop\github-actions-proyecto" -Raw | Set-Clipboard
```

Para copiar el token npm desde `.npmrc` sin imprimirlo:

```powershell
(Select-String -Path .npmrc -Pattern '_authToken=(.+)$').Matches[0].Groups[1].Value | Set-Clipboard
```

Para proyectos sin registry privado, no crear `NPM_TOKEN` y quitar el paso `Configure private npm registry` del workflow.

No guardar `.env`, contraseñas SSH ni tokens en variables visibles de GitHub. Todo secreto va en **Environment secrets**.

Si `gh` no está instalado, usar la UI y copiar valores sensibles al portapapeles sin imprimirlos.

Clave privada SSH en PowerShell:

```powershell
Get-Content "$env:USERPROFILE\Desktop\github-actions-profe-lab-pfinal" -Raw | Set-Clipboard
```

Token de registry privado desde `.npmrc`:

```powershell
(Select-String -Path .npmrc -Pattern '_authToken=(.+)$').Matches[0].Groups[1].Value | Set-Clipboard
```

Pegar esos valores solo en GitHub Secrets, nunca en chat ni en ficheros del repo.

### 6.2 GitHub CLI

Desde una máquina con `gh` autenticado:

```bash
gh secret set SSH_PRIVATE_KEY --env production < github-actions-profe-lab-pfinal
gh secret set SSH_HOST --env production --body "webda.eus"
gh secret set SSH_PORT --env production --body "22"
gh secret set SSH_USER --env production --body "deploy-profe-lab"

# release-symlink
gh secret set DEPLOY_PATH --env production --body "/var/www/profe-lab-pfinal.webda.eus"

# fixed-dirs
gh secret set REMOTE_BASE_PATH --env production --body "/home/usuario"

gh variable set PRODUCTION_URL --env production --body "https://profe-lab-pfinal.webda.eus"
gh variable set VITE_APP_URL --env production --body "https://profe-lab-pfinal.webda.eus"
gh variable set VITE_API_BASE_URL --env production --body "/api"
```

## 7. Workflow A: Solo Frontend Estático

Usar cuando no hay backend runtime.

Crear `.github/workflows/deploy.yml`:

```yaml
name: Deploy production

on:
  push:
    branches: [main]
    paths-ignore:
      - ".codex/**"
      - ".readme/**"
      - ".vscode/**"
      - "AGENTS*.md"
      - "README.md"
  workflow_dispatch:

permissions:
  contents: read

concurrency:
  group: deploy-production
  cancel-in-progress: false

env:
  NODE_VERSION: "24"
  DEPLOY_KEEP_RELEASES: "5"

jobs:
  deploy:
    runs-on: ubuntu-latest
    environment: production
    steps:
      - uses: actions/checkout@v6
        with:
          persist-credentials: false

      - uses: actions/setup-node@v6
        with:
          node-version: ${{ env.NODE_VERSION }}
          cache: npm

      - run: npm ci

      - name: Build
        run: npm run build
        env:
          VITE_APP_URL: ${{ vars.VITE_APP_URL }}
          VITE_API_BASE_URL: ${{ vars.VITE_API_BASE_URL }}

      - name: Configure SSH
        env:
          SSH_PRIVATE_KEY: ${{ secrets.SSH_PRIVATE_KEY }}
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
        run: |
          set -euo pipefail
          mkdir -p ~/.ssh
          chmod 700 ~/.ssh
          printf '%s\n' "$SSH_PRIVATE_KEY" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -p "$SSH_PORT" -H "$SSH_HOST" >> ~/.ssh/known_hosts

      - name: Upload and activate
        env:
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
          SSH_USER: ${{ secrets.SSH_USER }}
          DEPLOY_PATH: ${{ secrets.DEPLOY_PATH }}
          KEEP_RELEASES: ${{ env.DEPLOY_KEEP_RELEASES }}
        run: |
          set -euo pipefail
          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "mkdir -p '$DEPLOY_PATH/releases/$GITHUB_SHA'"
          rsync -az --delete -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" dist/ "$SSH_USER@$SSH_HOST:$DEPLOY_PATH/releases/$GITHUB_SHA/"
          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "ln -sfn '$DEPLOY_PATH/releases/$GITHUB_SHA' '$DEPLOY_PATH/current' && ls -1dt '$DEPLOY_PATH'/releases/* 2>/dev/null | tail -n +$((KEEP_RELEASES + 1)) | xargs -r rm -rf"

      - name: Smoke check
        env:
          PRODUCTION_URL: ${{ vars.PRODUCTION_URL }}
        run: |
          set -euo pipefail
          if [ -z "${PRODUCTION_URL:-}" ]; then
            echo "PRODUCTION_URL environment variable is required in the GitHub environment." >&2
            exit 1
          fi
          curl -fsS --retry 3 --retry-delay 5 "${PRODUCTION_URL%/}/" >/dev/null
```

Web root recomendado:

```text
$DEPLOY_PATH/current
```

## 8. Workflow B: Vite + PHP + Composer

Usar cuando el backend es PHP.

Proyecto recomendado:

```text
project/
  app/
  public/
    index.php
    .htaccess
  src/
  composer.json
  composer.lock
  package.json
  package-lock.json
```

Workflow:

```yaml
name: Deploy production

on:
  push:
    branches: [main]
    paths-ignore:
      - ".codex/**"
      - ".readme/**"
      - ".vscode/**"
      - "AGENTS*.md"
      - "README.md"
  workflow_dispatch:

permissions:
  contents: read

concurrency:
  group: deploy-production
  cancel-in-progress: false

env:
  NODE_VERSION: "24"
  PHP_VERSION: "8.3"
  LOCAL_PUBLIC_DIR: "public"
  REMOTE_PUBLIC_DIR: "public"
  DEPLOY_KEEP_RELEASES: "5"

jobs:
  deploy:
    runs-on: ubuntu-latest
    environment: production
    steps:
      - uses: actions/checkout@v6
        with:
          persist-credentials: false

      - uses: shivammathur/setup-php@v2
        with:
          php-version: ${{ env.PHP_VERSION }}
          tools: composer:v2
          coverage: none

      - run: composer validate --no-check-publish
      - run: composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader

      - uses: actions/setup-node@v6
        with:
          node-version: ${{ env.NODE_VERSION }}
          cache: npm

      - run: npm ci

      - name: Build frontend
        run: npm run build
        env:
          VITE_APP_URL: ${{ vars.VITE_APP_URL }}
          VITE_API_BASE_URL: ${{ vars.VITE_API_BASE_URL }}

      - name: Prepare release
        env:
          LOCAL_PUBLIC_DIR: ${{ env.LOCAL_PUBLIC_DIR }}
          REMOTE_PUBLIC_DIR: ${{ env.REMOTE_PUBLIC_DIR }}
        run: |
          set -euo pipefail
          mkdir -p .deploy/release
          rsync -a --delete ./ .deploy/release/ --exclude-from=.deployignore --exclude='.deploy/'
          if [ "$LOCAL_PUBLIC_DIR" != "$REMOTE_PUBLIC_DIR" ]; then
            rm -rf ".deploy/release/$REMOTE_PUBLIC_DIR"
            mv ".deploy/release/$LOCAL_PUBLIC_DIR" ".deploy/release/$REMOTE_PUBLIC_DIR"
          fi
          test -f .deploy/release/vendor/autoload.php
          test -f ".deploy/release/$REMOTE_PUBLIC_DIR/index.php"
          echo "sha=${GITHUB_SHA}" > .deploy/release/REVISION

      - name: Configure SSH
        env:
          SSH_PRIVATE_KEY: ${{ secrets.SSH_PRIVATE_KEY }}
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
        run: |
          set -euo pipefail
          mkdir -p ~/.ssh
          chmod 700 ~/.ssh
          printf '%s\n' "$SSH_PRIVATE_KEY" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -p "$SSH_PORT" -H "$SSH_HOST" >> ~/.ssh/known_hosts

      - name: Upload and activate
        env:
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
          SSH_USER: ${{ secrets.SSH_USER }}
          DEPLOY_PATH: ${{ secrets.DEPLOY_PATH }}
          REMOTE_PUBLIC_DIR: ${{ env.REMOTE_PUBLIC_DIR }}
          KEEP_RELEASES: ${{ env.DEPLOY_KEEP_RELEASES }}
        run: |
          set -euo pipefail
          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "mkdir -p '$DEPLOY_PATH/releases/$GITHUB_SHA' '$DEPLOY_PATH/shared/uploads'"
          rsync -az --delete -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" .deploy/release/ "$SSH_USER@$SSH_HOST:$DEPLOY_PATH/releases/$GITHUB_SHA/"
          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "DEPLOY_PATH='$DEPLOY_PATH' RELEASE_SHA='$GITHUB_SHA' REMOTE_PUBLIC_DIR='$REMOTE_PUBLIC_DIR' KEEP_RELEASES='$KEEP_RELEASES' bash -se" <<'REMOTE'
          set -euo pipefail
          RELEASE="$DEPLOY_PATH/releases/$RELEASE_SHA"
          [ -f "$DEPLOY_PATH/shared/.env" ] && ln -sfn "$DEPLOY_PATH/shared/.env" "$RELEASE/.env"
          mkdir -p "$RELEASE/$REMOTE_PUBLIC_DIR"
          rm -rf "$RELEASE/$REMOTE_PUBLIC_DIR/uploads"
          ln -sfn "$DEPLOY_PATH/shared/uploads" "$RELEASE/$REMOTE_PUBLIC_DIR/uploads"
          php -r "require '$RELEASE/vendor/autoload.php'; echo 'autoload ok'.PHP_EOL;"
          ln -sfn "$RELEASE" "$DEPLOY_PATH/current"
          ls -1dt "$DEPLOY_PATH"/releases/* 2>/dev/null | tail -n +"$((KEEP_RELEASES + 1))" | xargs -r rm -rf
          REMOTE

      - name: Smoke check
        env:
          PRODUCTION_URL: ${{ vars.PRODUCTION_URL }}
        run: |
          set -euo pipefail
          if [ -z "${PRODUCTION_URL:-}" ]; then
            echo "PRODUCTION_URL environment variable is required in the GitHub environment." >&2
            exit 1
          fi
          curl -fsS --retry 3 --retry-delay 5 "${PRODUCTION_URL%/}/" >/dev/null
```

Web root recomendado:

```text
$DEPLOY_PATH/current/$REMOTE_PUBLIC_DIR
```

### 8.1 Workflow B2: PHP + Vite En Hosting Compartido Con Carpetas Fijas

Usar esta variante cuando el hosting ya tiene una estructura fija y no se puede apuntar el subdominio a `current/<public>` ni sustituir la carpeta pública por un symlink.

Ejemplo real:

```text
/home/usuario/
  .env
  App/
  vendor/
  socios/        # document root del subdominio
  www/           # otro sitio, por ejemplo WordPress; no tocar
```

Principios:

- Composer se ejecuta en GitHub Actions, no en remoto, si el hosting no tiene `composer`.
- `vendor/` se sube ya construido desde CI.
- `node_modules/` no se sube.
- La carpeta local `public/` se sube a la carpeta pública remota fija, por ejemplo `socios/`.
- `.env` vive en remoto y no se sube desde CI.
- No usar `rsync --delete` sin excluir carpetas runtime o gestionadas por el hosting, por ejemplo `.well-known/`, `uploads/`, `App/logs/` o `App/tmp/`.
- Antes del primer deploy, hacer backup remoto de `App/`, `vendor/` y la carpeta pública.
- El backup remoto automático puede omitirse si el usuario confirma que el hosting tiene backups recuperables y acepta resolver un fallo restaurando desde el panel/proveedor.

Secrets recomendados para este modo:

| Secret | Ejemplo |
| --- | --- |
| `SSH_HOST` | Host/IP SSH |
| `SSH_PORT` | `22` |
| `SSH_USER` | `usuario` |
| `SSH_PRIVATE_KEY` | Clave privada OpenSSH |
| `REMOTE_BASE_PATH` | `/home/usuario` |
| `NPM_TOKEN` | Solo si hay registry npm privado |

Variables recomendadas:

| Variable | Ejemplo |
| --- | --- |
| `PRODUCTION_URL` | `https://bazkide.example.com` |
| `REMOTE_PUBLIC_DIR` | `socios` |

Bloque remoto de subida:

```yaml
      - name: Upload fixed hosting directories
        env:
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
          SSH_USER: ${{ secrets.SSH_USER }}
          REMOTE_BASE_PATH: ${{ secrets.REMOTE_BASE_PATH }}
          REMOTE_PUBLIC_DIR: ${{ vars.REMOTE_PUBLIC_DIR }}
        run: |
          set -euo pipefail
          rsync -az --delete --omit-dir-times --no-perms --no-owner --no-group \
            --exclude='logs/' \
            --exclude='tmp/' \
            -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" \
            .deploy/release/App/ "$SSH_USER@$SSH_HOST:$REMOTE_BASE_PATH/App/"

          rsync -az --delete --omit-dir-times --no-perms --no-owner --no-group \
            -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" \
            .deploy/release/vendor/ "$SSH_USER@$SSH_HOST:$REMOTE_BASE_PATH/vendor/"

          rsync -az --delete --omit-dir-times --no-perms --no-owner --no-group \
            --exclude='.well-known/' \
            --exclude='uploads/' \
            -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" \
            ".deploy/release/$REMOTE_PUBLIC_DIR/" "$SSH_USER@$SSH_HOST:$REMOTE_BASE_PATH/$REMOTE_PUBLIC_DIR/"
```

Tras la subida, verificar por SSH:

```bash
php -r "require '/home/usuario/vendor/autoload.php'; echo 'autoload ok'.PHP_EOL;"
test -f /home/usuario/socios/index.php
test -f /home/usuario/.env
```

Workflow completo recomendado para `fixed-dirs` sin backup automático:

```yaml
name: Deploy production

on:
  push:
    branches: [main]
    paths-ignore:
      - ".codex/**"
      - ".readme/**"
      - ".vscode/**"
      - "AGENTS*.md"
      - "README.md"
  workflow_dispatch:

permissions:
  contents: read

concurrency:
  group: deploy-production
  cancel-in-progress: false

env:
  NODE_VERSION: "24"
  PHP_VERSION: "8.4"
  LOCAL_PUBLIC_DIR: "public"
  REMOTE_PUBLIC_DIR: "socios"

jobs:
  deploy:
    runs-on: ubuntu-latest
    environment: production
    timeout-minutes: 30

    steps:
      - uses: actions/checkout@v6
        with:
          persist-credentials: false

      - uses: shivammathur/setup-php@v2
        with:
          php-version: ${{ env.PHP_VERSION }}
          tools: composer:v2
          coverage: none

      - run: composer validate --no-check-publish

      - run: composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader

      - uses: actions/setup-node@v6
        with:
          node-version: ${{ env.NODE_VERSION }}
          cache: npm

      - run: npm ci --no-audit --fund=false --progress=false

      - name: Build frontend
        run: npm run build

      - name: Prepare release
        env:
          LOCAL_PUBLIC_DIR: ${{ env.LOCAL_PUBLIC_DIR }}
          REMOTE_PUBLIC_DIR: ${{ env.REMOTE_PUBLIC_DIR }}
        run: |
          set -euo pipefail
          mkdir -p .deploy/release
          rsync -a --delete ./ .deploy/release/ --exclude-from=.deployignore --exclude='.deploy/'
          if [ "$LOCAL_PUBLIC_DIR" != "$REMOTE_PUBLIC_DIR" ]; then
            rm -rf ".deploy/release/$REMOTE_PUBLIC_DIR"
            mv ".deploy/release/$LOCAL_PUBLIC_DIR" ".deploy/release/$REMOTE_PUBLIC_DIR"
          fi
          test -f .deploy/release/vendor/autoload.php
          test -f .deploy/release/App/config/config.php
          test -f ".deploy/release/$REMOTE_PUBLIC_DIR/index.php"
          test -f ".deploy/release/$REMOTE_PUBLIC_DIR/.htaccess"
          echo "sha=${GITHUB_SHA}" > .deploy/release/REVISION

      - name: Configure SSH
        env:
          SSH_PRIVATE_KEY: ${{ secrets.SSH_PRIVATE_KEY }}
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
        run: |
          set -euo pipefail
          mkdir -p ~/.ssh
          chmod 700 ~/.ssh
          printf '%s\n' "$SSH_PRIVATE_KEY" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -p "$SSH_PORT" -H "$SSH_HOST" >> ~/.ssh/known_hosts

      - name: Upload fixed hosting directories
        env:
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
          SSH_USER: ${{ secrets.SSH_USER }}
          REMOTE_BASE_PATH: ${{ secrets.REMOTE_BASE_PATH }}
          REMOTE_PUBLIC_DIR: ${{ env.REMOTE_PUBLIC_DIR }}
        run: |
          set -euo pipefail

          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" \
            "test -d '$REMOTE_BASE_PATH/App' && test -d '$REMOTE_BASE_PATH/vendor' && test -d '$REMOTE_BASE_PATH/$REMOTE_PUBLIC_DIR' && test -f '$REMOTE_BASE_PATH/.env'"

          rsync -az --delete --delay-updates --omit-dir-times --no-perms --no-owner --no-group \
            -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" \
            .deploy/release/vendor/ "$SSH_USER@$SSH_HOST:$REMOTE_BASE_PATH/vendor/"

          rsync -az --delete --delay-updates --omit-dir-times --no-perms --no-owner --no-group \
            --exclude='logs/' \
            --exclude='tmp/' \
            -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" \
            .deploy/release/App/ "$SSH_USER@$SSH_HOST:$REMOTE_BASE_PATH/App/"

          rsync -az --delete --delay-updates --omit-dir-times --no-perms --no-owner --no-group \
            --exclude='.well-known/' \
            --exclude='uploads/' \
            -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" \
            ".deploy/release/$REMOTE_PUBLIC_DIR/" "$SSH_USER@$SSH_HOST:$REMOTE_BASE_PATH/$REMOTE_PUBLIC_DIR/"

      - name: Verify remote PHP autoload
        env:
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
          SSH_USER: ${{ secrets.SSH_USER }}
          REMOTE_BASE_PATH: ${{ secrets.REMOTE_BASE_PATH }}
        run: |
          set -euo pipefail
          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "REMOTE_BASE_PATH='$REMOTE_BASE_PATH' bash -se" <<'REMOTE'
          set -euo pipefail
          PHP_BIN="$REMOTE_BASE_PATH/.bin/php"
          if [ ! -x "$PHP_BIN" ]; then
            PHP_BIN="php"
          fi
          "$PHP_BIN" -r "require '$REMOTE_BASE_PATH/vendor/autoload.php'; echo 'autoload ok'.PHP_EOL;"
          REMOTE

      - name: Smoke check
        env:
          PRODUCTION_URL: ${{ vars.PRODUCTION_URL }}
        run: |
          set -euo pipefail
          if [ -z "${PRODUCTION_URL:-}" ]; then
            echo "PRODUCTION_URL environment variable is required in the GitHub environment." >&2
            exit 1
          fi
          curl -fsS --retry 3 --retry-delay 5 "${PRODUCTION_URL%/}/" >/dev/null
```

Apache `public/.htaccess` básico:

```apache
Options -Indexes
DirectoryIndex index.php index.html

<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^ index.php [QSA,L]
</IfModule>

<FilesMatch "^\.">
  Require all denied
</FilesMatch>
```

## 9. Workflow C: Vite + Backend Node + PM2

Usar cuando el backend Node queda vivo en el servidor.

Servidor: instalar Node y PM2 para el usuario deploy. En hosting sin systemd, PM2 puede necesitar watchdog por cron.

```bash
mkdir -p ~/.npm-global
npm config set prefix ~/.npm-global
echo 'export PATH=$HOME/.npm-global/bin:$PATH' >> ~/.bashrc
export PATH="$HOME/.npm-global/bin:$PATH"
npm i -g pm2
node -v
pm2 -v
```

Workflow:

```yaml
name: Deploy production

on:
  push:
    branches: [main]
    paths-ignore:
      - ".codex/**"
      - ".readme/**"
      - ".vscode/**"
      - "AGENTS*.md"
      - "README.md"
  workflow_dispatch:

permissions:
  contents: read

concurrency:
  group: deploy-production
  cancel-in-progress: false

env:
  NODE_VERSION: "24"
  NODE_ENTRY: "server.js"
  PM2_APP_NAME: "profe-lab-api"
  APP_PORT: "15030"
  DEPLOY_KEEP_RELEASES: "5"

jobs:
  deploy:
    runs-on: ubuntu-latest
    environment: production
    steps:
      - uses: actions/checkout@v6
        with:
          persist-credentials: false

      - uses: actions/setup-node@v6
        with:
          node-version: ${{ env.NODE_VERSION }}
          cache: npm

      - run: npm ci
      - run: npm run build
        env:
          VITE_APP_URL: ${{ vars.VITE_APP_URL }}
          VITE_API_BASE_URL: ${{ vars.VITE_API_BASE_URL }}

      - name: Prepare release
        run: |
          set -euo pipefail
          mkdir -p .deploy/release
          rsync -a --delete ./ .deploy/release/ --exclude-from=.deployignore --exclude='.deploy/'
          echo "sha=${GITHUB_SHA}" > .deploy/release/REVISION

      - name: Configure SSH
        env:
          SSH_PRIVATE_KEY: ${{ secrets.SSH_PRIVATE_KEY }}
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
        run: |
          set -euo pipefail
          mkdir -p ~/.ssh
          chmod 700 ~/.ssh
          printf '%s\n' "$SSH_PRIVATE_KEY" > ~/.ssh/deploy_key
          chmod 600 ~/.ssh/deploy_key
          ssh-keyscan -p "$SSH_PORT" -H "$SSH_HOST" >> ~/.ssh/known_hosts

      - name: Upload and activate Node release
        env:
          SSH_HOST: ${{ secrets.SSH_HOST }}
          SSH_PORT: ${{ secrets.SSH_PORT }}
          SSH_USER: ${{ secrets.SSH_USER }}
          DEPLOY_PATH: ${{ secrets.DEPLOY_PATH }}
          NODE_ENTRY: ${{ env.NODE_ENTRY }}
          PM2_APP_NAME: ${{ env.PM2_APP_NAME }}
          APP_PORT: ${{ env.APP_PORT }}
          KEEP_RELEASES: ${{ env.DEPLOY_KEEP_RELEASES }}
        run: |
          set -euo pipefail
          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "mkdir -p '$DEPLOY_PATH/releases/$GITHUB_SHA' '$DEPLOY_PATH/shared/uploads' '$DEPLOY_PATH/shared/logs'"
          rsync -az --delete -e "ssh -i ~/.ssh/deploy_key -p $SSH_PORT" .deploy/release/ "$SSH_USER@$SSH_HOST:$DEPLOY_PATH/releases/$GITHUB_SHA/"
          ssh -i ~/.ssh/deploy_key -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "DEPLOY_PATH='$DEPLOY_PATH' RELEASE_SHA='$GITHUB_SHA' NODE_ENTRY='$NODE_ENTRY' PM2_APP_NAME='$PM2_APP_NAME' APP_PORT='$APP_PORT' KEEP_RELEASES='$KEEP_RELEASES' bash -se" <<'REMOTE'
          set -euo pipefail
          export PATH="$HOME/.npm-global/bin:$PATH"
          export PM2_HOME="$HOME/.pm2"
          RELEASE="$DEPLOY_PATH/releases/$RELEASE_SHA"
          [ -f "$DEPLOY_PATH/shared/.env" ] && ln -sfn "$DEPLOY_PATH/shared/.env" "$RELEASE/.env"
          cd "$RELEASE"
          npm ci --omit=dev
          ln -sfn "$RELEASE" "$DEPLOY_PATH/current"
          cd "$DEPLOY_PATH/current"
          if pm2 describe "$PM2_APP_NAME" >/dev/null 2>&1; then
            PORT="$APP_PORT" NODE_ENV=production pm2 restart "$PM2_APP_NAME" --update-env
          else
            PORT="$APP_PORT" NODE_ENV=production pm2 start "$NODE_ENTRY" --name "$PM2_APP_NAME"
          fi
          pm2 save
          for i in 1 2 3 4 5 6 7 8; do
            curl -fsS "http://127.0.0.1:$APP_PORT/health" >/dev/null && break
            sleep 2
          done
          curl -fsS "http://127.0.0.1:$APP_PORT/health" >/dev/null
          ls -1dt "$DEPLOY_PATH"/releases/* 2>/dev/null | tail -n +"$((KEEP_RELEASES + 1))" | xargs -r rm -rf
          REMOTE

      - name: Smoke check
        env:
          PRODUCTION_URL: ${{ vars.PRODUCTION_URL }}
        run: |
          set -euo pipefail
          if [ -z "${PRODUCTION_URL:-}" ]; then
            echo "PRODUCTION_URL environment variable is required in the GitHub environment." >&2
            exit 1
          fi
          curl -fsS --retry 3 --retry-delay 5 "${PRODUCTION_URL%/}/" >/dev/null
```

El backend debe exponer healthcheck. Ejemplo Express:

```js
app.get('/health', (_req, res) => res.json({ ok: true }));
```

Nginx proxy básico:

```nginx
server {
    listen 80;
    server_name profe-lab-pfinal.webda.eus;

    location / {
        proxy_pass http://127.0.0.1:15030;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

Si usa WebSockets, añadir:

```nginx
proxy_set_header Upgrade $http_upgrade;
proxy_set_header Connection "upgrade";
proxy_read_timeout 3600;
proxy_send_timeout 3600;
```

## 10. Servidor Web

### 10.1 Nginx Estático O PHP

Estático:

```nginx
server {
    listen 80;
    server_name profe-lab-pfinal.webda.eus;
    root /var/www/profe-lab-pfinal.webda.eus/current;
    index index.html;

    location / {
        try_files $uri $uri/ /index.html;
    }
}
```

PHP:

Si `REMOTE_PUBLIC_DIR` no es `public`, sustituir `current/public` por `current/<REMOTE_PUBLIC_DIR>` en la configuración del servidor web.

```nginx
server {
    listen 80;
    server_name profe-lab-pfinal.webda.eus;
    root /var/www/profe-lab-pfinal.webda.eus/current/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Activar:

```bash
sudo ln -s /etc/nginx/sites-available/profe-lab-pfinal.webda.eus /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
sudo certbot --nginx -d profe-lab-pfinal.webda.eus
```

### 10.2 Apache PHP

```apache
<VirtualHost *:80>
    ServerName profe-lab-pfinal.webda.eus
    DocumentRoot /var/www/profe-lab-pfinal.webda.eus/current/public

    <Directory /var/www/profe-lab-pfinal.webda.eus/current/public>
        AllowOverride All
        Require all granted
        Options -Indexes
    </Directory>
</VirtualHost>
```

```bash
sudo a2ensite profe-lab-pfinal.webda.eus.conf
sudo apachectl configtest
sudo systemctl reload apache2
sudo certbot --apache -d profe-lab-pfinal.webda.eus
```

## 11. DNS

Crear registro:

```text
Type: A
Name: profe-lab-pfinal
Value: <IPv4 del servidor>
```

Comprobar:

```bash
dig profe-lab-pfinal.webda.eus +short
curl -I http://profe-lab-pfinal.webda.eus
```

## 12. Primer Deploy Y Verificación

Antes de push:

```bash
npm ci
npm run build
test -f composer.json && composer validate --no-check-publish
```

Si se ejecuta `npm run build` en local para validar el workflow, revisar después:

```bash
git status --short
```

En proyectos donde `public/.vite/manifest.json`, `public/robots.txt` o `public/sitemap.xml` están versionados, el build local puede dejarlos modificados por hashes o fechas. Para el commit inicial del workflow:

- incluir `.github/workflows/deploy-production.yml`;
- incluir `.deployignore`;
- incluir `.gitignore` si se han liberado lockfiles;
- incluir `composer.lock` y `package-lock.json`;
- incluir documentación de skill si se está mejorando el proceso;
- no incluir artefactos generados por una prueba local salvo decisión explícita del proyecto.

El workflow debe regenerar esos artefactos en GitHub Actions antes de subirlos al hosting.

Después:

1. Commit de `.github/workflows/deploy.yml`, `.deployignore`, lockfiles y cambios de config.
2. Push a `main` o ejecutar `workflow_dispatch`.
3. Revisar logs de GitHub Actions.
4. Verificar por SSH:

```bash
readlink -f /var/www/profe-lab-pfinal.webda.eus/current
cat /var/www/profe-lab-pfinal.webda.eus/current/REVISION
```

5. Verificar HTTP:

```bash
curl -I https://profe-lab-pfinal.webda.eus
```

Para Node:

```bash
pm2 status
curl -i http://127.0.0.1:15030/health
```

## 13. Rollback

Listar releases:

```bash
ls -1dt /var/www/profe-lab-pfinal.webda.eus/releases/*
```

Activar una release anterior:

```bash
ln -sfn /var/www/profe-lab-pfinal.webda.eus/releases/<previous-sha> /var/www/profe-lab-pfinal.webda.eus/current
```

Para Node, reiniciar PM2 tras el symlink:

```bash
cd /var/www/profe-lab-pfinal.webda.eus/current
PORT=15030 NODE_ENV=production pm2 restart profe-lab-api --update-env
```

Para PHP con OPcache:

```bash
sudo systemctl reload php8.3-fpm
```

## 14. Reglas De Seguridad

- Usar una clave SSH dedicada por proyecto.
- No reutilizar claves personales.
- No guardar `.env` en Git.
- No poner secretos en `VITE_*`.
- No exponer la raíz completa del repo si hay `public/`.
- No borrar carpetas runtime (`uploads`, logs, `.env`) con `rsync --delete`.
- Mantener `permissions: contents: read`.
- Para entornos críticos, fijar actions por commit SHA en vez de tags mayores.
- Verificar fingerprint SSH manualmente si se requiere seguridad alta; `ssh-keyscan` automatiza `known_hosts`, pero no valida identidad por sí solo.

## 15. Fuentes Primarias Para Refrescar La Skill

Revisar antes de actualizar versiones:

- GitHub workflow syntax: `https://docs.github.com/en/actions/reference/workflows-and-actions/workflow-syntax`
- GitHub secrets/environments: `https://docs.github.com/en/actions/how-tos/write-workflows/choose-what-workflows-do/use-secrets`
- `actions/checkout`: `https://github.com/actions/checkout`
- `actions/setup-node`: `https://github.com/actions/setup-node`
- `shivammathur/setup-php`: `https://github.com/shivammathur/setup-php`
- GSAP installation and private registry migration: `https://gsap.com/docs/v3/Installation`
