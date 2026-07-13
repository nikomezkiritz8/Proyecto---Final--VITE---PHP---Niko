---
name: seo-content
description: Redaccion, revision y planificacion de contenido SEO del proyecto, incluyendo titles, meta descriptions, H1/H2/H3, ALT, copy on-page, arquitectura de keywords por URL e idioma, comprobaciones contra canibalizacion, topónimos, intención de búsqueda, tono, datos confirmados y limites de extension. Use esta skill cuando Codex deba crear, auditar o ajustar textos orientados a posicionamiento organico en este repositorio.
---

# SEO Content

## Flujo obligatorio

1. Usa esta skill como fuente principal de instrucciones SEO del repositorio.
2. Reutiliza solo datos confirmados del cliente: servicios, valores, partners, coberturas, textos comerciales, direcciones, telefonos, correos y fechas.
3. Busca esos datos en el codigo, JSON de idiomas, contenidos existentes o documentacion vigente del proyecto. Si no aparecen, tratalos como no confirmados.
4. Revisa los controladores PHP relacionados con la ruta o recurso solicitado y respeta los comentarios de minimos y maximos de palabras o caracteres.
5. Si falta informacion clave, marcala como pendiente y solicita confirmacion. No inventes servicios, ubicaciones, telefonos, correos, fechas, coberturas ni claims.
6. Si el cliente valida informacion nueva, documentala donde el proyecto guarde su contenido vigente antes de reutilizarla en otros textos.

## Arquitectura SEO

Cuando una URL o idioma no tenga directrices suficientes, define o propone primero su arquitectura SEO antes de generar el copy asociado.

Documenta por cada URL e idioma estos 4 vectores:

- Servicio, solucion o producto.
- Atributos diferenciadores.
- Finalidad, aplicacion o sector.
- Localidad.

Explica cualquier matiz necesario para evitar canibalizaciones y para que el contenido respete la intencion de busqueda objetivo.

## Topónimos

Limita cada vector de localidad a un maximo de 3 topónimos por URL e idioma:

- Incluye 1 topónimo macroterritorial: provincia, departamento o region amplia.
- Incluye 1 o 2 topónimos locales: municipio, comarca o zona especifica.
- No repitas la misma combinacion exacta de topónimos en distintas URLs del mismo idioma.

Distingue entre topónimos que definen la URL y topónimos que amplian el alcance territorial.

## Redaccion SEO

Redacta contenido util, fiable y pensado para personas.

- Satisface la intencion de busqueda de principio a fin.
- Usa los keywords de los vectores correspondientes con naturalidad.
- Añade 3-6 variantes semanticas o entidades relacionadas para los vectores de servicio, atributos y finalidad.
- No uses porcentajes de densidad.
- Evita keyword stuffing en texto, titulos, metas, ALT, anchors y listados.
- No repitas una misma palabra mas de dos veces seguidas en un parrafo.
- Usa sinonimos y variaciones para mantener fluidez.
- Mantén un tono cercano, educativo y profesional.
- Dirigete de tu a tu al usuario final y a su empresa.
- Combina lenguaje tecnico con explicaciones claras para publico no especializado.
- Sustenta afirmaciones con datos, citas o referencias verificables cuando proceda.
- Destaca en negrita solo algunas keywords dentro de bloques introductorios. No uses negrita en titulos ni abuses de ella.

## Elementos on-page

Comprueba estos elementos cuando redactes o audites una pagina:

- `title`: unico, persuasivo y de 60-65 caracteres como maximo.
- `meta description`: atractiva y orientada a clic, sin repetir keywords de forma artificial.
- `H1`: unico, coherente con el title y con la propuesta de valor en las primeras 100 palabras.
- Topónimo principal: incluyelo en las primeras 100 palabras si aplica.
- `H2`/`H3`: añade 1-2 encabezados relevantes que organicen el contenido y respondan busquedas relacionadas.
- Parrafos: cortos, escaneables y apoyados en listas, tablas, resumenes ejecutivos o bloques destacados cuando mejore la lectura.
- Comparativas, pros/contras y ejemplos: incluyelos cuando ayuden a explicar la propuesta.
- Anchors: usa textos descriptivos que aporten contexto.
- ALT: añade descripciones reales a 1-2 imagenes clave cuando proceda y varia el vocabulario.
- Recursos visuales o multimedia: proponlos cuando sean relevantes y explica su funcion dentro del copy.

## Multidioma

Mantén coherencia semantica y estructural entre idiomas, pero adapta expresiones, referencias, topónimos y matices culturales al idioma concreto. No traduzcas literalmente si perjudica la intencion de busqueda o la naturalidad.

## Zonas rojas

Evita de forma taxativa:

- Keyword stuffing.
- Doorway pages o contenido producido a escala sin valor real.
- Texto oculto, cloaking o datos estructurados engañosos.
- Abuso de reputacion del sitio.
- Reutilizacion de dominios caducados con fines manipulativos.
- Datos no verificados o afirmaciones no sustentadas.
- Contenido que comprometa fiabilidad, utilidad o experiencia de usuario.

## Revision antes de entregar

Antes de finalizar, verifica:

- Que el contenido respeta los limites de extension del recurso.
- Que no hay claims ni datos inventados.
- Que la URL e idioma tienen vectores SEO definidos.
- Que los topónimos no canibalizan otra URL.
- Que el copy cubre la intencion de busqueda.
- Que metas, headings, anchors y ALT son naturales y no sobreoptimizados.
