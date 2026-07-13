<?php

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$staticFile = __DIR__ . $requestPath;

if (PHP_SAPI === 'cli-server' && is_file($staticFile)) {
    return false;
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();

require_once dirname(__DIR__) . '/App/config/helpers.php';

$config = require app_path('config/config.php');
$globalRoutes = $config['global_routes'] ?? [];
$postRoutes = $config['post_routes'] ?? [];
$routes = $config['routes'] ?? [];
$langs = $config['langs'] ?? array_keys($routes);
$langDefault = $config['lang_default'] ?? 'es';
$requestMethod = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

$url = urldecode($requestPath);

if ($url !== '/') {
    $url = rtrim($url, '/');
}

// Los formularios no cargan una vista: ejecutan un controlador PHP.
// Solo se pueden usar las rutas POST dadas de alta en config.php.
if (isset($postRoutes[$url])) {
    if ($requestMethod !== 'POST') {
        http_response_code(405);
        header('Allow: POST');
        echo 'Esta ruta solo admite peticiones POST.';
        exit;
    }

    $controller = app_path($postRoutes[$url]);

    if (!is_file($controller)) {
        http_response_code(500);
        echo 'El controlador POST no existe.';
        exit;
    }

    require $controller;
    exit;
}

if ($requestMethod === 'POST') {
    http_response_code(404);
    echo 'La ruta POST no esta permitida.';
    exit;
}

if ($url === '/') {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: /' . $langDefault);
    exit;
}

$isGlobalRoute = isset($globalRoutes[$url]);

if ($isGlobalRoute) {
    $lang = $langDefault;
    $route = $globalRoutes[$url];
} else {
    $segments = explode('/', trim($url, '/'));
    $lang = $segments[0] ?? $langDefault;

    if (!in_array($lang, $langs, true)) {
        $lang = $langDefault;
        $route = null;
    } else {
        $route = $routes[$lang][$url] ?? null;
    }
}

$GLOBALS['lang'] = $lang;
$GLOBALS['app_langs'] = $langs;
$GLOBALS['app_global_routes'] = array_keys($globalRoutes);

if ($route === null) {
    http_response_code(404);
    $route = $routes[$lang]['/' . $lang . '/404'] ?? [
        'view' => '404.php',
        'resources' => null,
    ];
}

$view = $isGlobalRoute
    ? app_path('views/' . $route['view'])
    : app_path('views/' . $lang . '/' . $route['view']);

if (!is_file($view)) {
    http_response_code(500);
    echo 'La vista no existe: ' . e($route['view']);
    exit;
}

require $view;
