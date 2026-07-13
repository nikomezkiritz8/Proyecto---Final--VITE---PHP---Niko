<?php

function env(string $key, $default = null)
{
    $value = getenv($key);

    if ($value === false || $value === null || $value === '') {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? null;
    }

    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return $value;
}

function root_path(string $path = ''): string
{
    $root = dirname(__DIR__, 2);

    if ($path === '') {
        return $root;
    }

    return $root . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, ltrim($path, '/\\'));
}

function app_path(string $path = ''): string
{
    return root_path('App' . ($path !== '' ? '/' . ltrim($path, '/\\') : ''));
}

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Helpers de validacion usados por los controladores de formulario.
function comprobarVacio($value): bool
{
    return trim((string) $value) === '';
}

function comprobarCaracteres($value, int $min, int $max): bool
{
    $length = mb_strlen(trim((string) $value));

    return $length < $min || $length > $max;
}

function comprobarEmailSintaxis($email): bool
{
    return filter_var((string) $email, FILTER_VALIDATE_EMAIL) !== false;
}

// Solo permite volver a una ruta de esta web, nunca a un dominio externo.
function ruta_interna($ruta, string $fallback = '/showroom'): string
{
    $path = parse_url((string) $ruta, PHP_URL_PATH);

    if (!is_string($path) || $path === '' || $path[0] !== '/' || str_starts_with($path, '//')) {
        return $fallback;
    }

    return $path;
}

// RUTA apunta a los assets de Vite. Esta funcion obtiene la URL del servidor PHP.
function app_url(string $path = ''): string
{
    $https = ($_SERVER['HTTPS'] ?? '') !== '' && ($_SERVER['HTTPS'] ?? '') !== 'off';
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:3000';

    return $scheme . '://' . $host . ($path !== '' ? '/' . ltrim($path, '/') : '');
}

function enviarRespuestaAsincrona(string $mensaje, bool $fallo, string $param3): void
{
    header('Content-Type: application/json; charset=UTF-8');

    echo json_encode([
        'mensaje' => $mensaje,
        'fallo' => $fallo,
        'param3' => $param3,
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

function route_url(string $path = '/'): string
{
    $lang = $GLOBALS['lang'] ?? env('LANG_DEFAULT', 'es');
    $langs = $GLOBALS['app_langs'] ?? [$lang];
    $globalRoutes = $GLOBALS['app_global_routes'] ?? [];
    $path = '/' . trim($path, '/');

    if ($path === '/') {
        return '/' . $lang;
    }

    if (in_array($path, $globalRoutes, true)) {
        return $path;
    }

    $firstSegment = explode('/', trim($path, '/'))[0] ?? '';

    if (in_array($firstSegment, $langs, true)) {
        return $path;
    }

    return '/' . $lang . $path;
}

function url(string $path = '/'): string
{
    $base = rtrim((string) env('RUTA', ''), '/');
    $path = route_url($path);

    return e(($base !== '' ? $base : '') . $path);
}

function asset(string $path): string
{
    $base = rtrim((string) env('RUTA', ''), '/');
    $path = ltrim($path, '/');

    return e(($base !== '' ? $base . '/' : '/') . $path);
}

function vite_manifest_path(): string
{
    // El directorio publico puede llamarse dist, www, public_html, etc.
    $publicRoot = trim((string) ($_SERVER['DOCUMENT_ROOT'] ?? ''));

    if ($publicRoot === '') {
        $frontController = (string) ($_SERVER['SCRIPT_FILENAME'] ?? '');
        $publicRoot = $frontController !== '' ? dirname($frontController) : root_path();
    }

    return rtrim($publicRoot, '/\\')
        . DIRECTORY_SEPARATOR
        . '.vite'
        . DIRECTORY_SEPARATOR
        . 'manifest.json';
}

function vite_collect_css(array $manifest, array $chunk, array &$css): void
{
    foreach (($chunk['imports'] ?? []) as $import) {
        if (isset($manifest[$import])) {
            vite_collect_css($manifest, $manifest[$import], $css);
        }
    }

    foreach (($chunk['css'] ?? []) as $file) {
        $css[$file] = true;
    }
}

function vite_tags(?string $resources): string
{
    if ($resources === null || $resources === '') {
        return '';
    }

    $assetBase = rtrim((string) env('RUTA', 'http://localhost:5173'), '/');
    $entry = ltrim($resources, '/');
    $environment = env('APP_ENV', 'development');

    if ($environment === 'development') {
        return implode(PHP_EOL, [
            '<script type="module" src="' . e($assetBase . '/@vite/client') . '"></script>',
            '<script type="module" src="' . e($assetBase . '/' . $entry) . '"></script>',
        ]);
    }

    $manifestPath = vite_manifest_path();

    if (!is_file($manifestPath)) {
        return '<!-- No se ha encontrado el manifest de Vite. Ejecuta npm run build. -->';
    }

    $manifest = json_decode((string) file_get_contents($manifestPath), true);

    if (!is_array($manifest) || !isset($manifest[$entry])) {
        return '<!-- La entrada de Vite no existe en el manifest: ' . e($entry) . ' -->';
    }

    $chunk = $manifest[$entry];
    $css = [];
    vite_collect_css($manifest, $chunk, $css);

    $tags = [];

    foreach (array_keys($css) as $file) {
        $tags[] = '<link rel="stylesheet" href="' . e($assetBase . '/' . ltrim($file, '/')) . '">';
    }

    $tags[] = '<script type="module" src="' . e($assetBase . '/' . ltrim($chunk['file'], '/')) . '"></script>';

    return implode(PHP_EOL, $tags);
}
