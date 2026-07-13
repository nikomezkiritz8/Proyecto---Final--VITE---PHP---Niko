<?php

$basePath = dirname(__DIR__, 2);
require_once $basePath . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($basePath);
$dotenv->load();

require_once $basePath . '/App/config/helpers.php';

// 1. Recoger los datos enviados por el formulario.
$nombre = trim((string) ($_POST['nombre'] ?? ''));
$telefono = trim((string) ($_POST['telefono'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$mensaje = trim((string) ($_POST['mensaje'] ?? ''));
$terminos = (string) ($_POST['terminos'] ?? '');
$respUser = trim((string) ($_POST['respUser'] ?? ''));
$respSystem = trim((string) ($_POST['respSystem'] ?? ''));
$url = ruta_interna($_POST['url'] ?? '/showroom');
$langRecibido = (string) ($_POST['lang'] ?? 'es');
$lang = in_array($langRecibido, ['es', 'eu'], true) ? $langRecibido : 'es';
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$fecha = date('Y-m-d H:i:s');

// 2. Validar los datos antes de intentar enviar correos.
if (comprobarVacio($terminos)) {
    enviarRespuestaAsincrona('Debes aceptar las condiciones de consentimiento', true, 'condiciones');
}

if ($respUser === '' || $respSystem === '') {
    enviarRespuestaAsincrona('Debes cumplir con el captcha', true, 'captcha');
}

if ($respUser !== $respSystem) {
    enviarRespuestaAsincrona('Debes resolver la operación de forma correcta', true, 'captcha');
}

if (comprobarVacio($nombre)) {
    enviarRespuestaAsincrona('Debes rellenar el campo nombre', true, 'nombre');
}

if (comprobarCaracteres($nombre, 3, 40)) {
    enviarRespuestaAsincrona('El nombre debe tener entre 3 y 40 caracteres', true, 'nombre');
}

if (comprobarVacio($telefono)) {
    enviarRespuestaAsincrona('El campo teléfono debe cumplimentarse', true, 'telefono');
}

if (comprobarVacio($email)) {
    enviarRespuestaAsincrona('Debes indicar el correo electrónico', true, 'email');
}

if (!comprobarEmailSintaxis($email)) {
    enviarRespuestaAsincrona('El correo electrónico no tiene un formato adecuado', true, 'email');
}

if (comprobarVacio($mensaje)) {
    enviarRespuestaAsincrona('El mensaje no puede quedar vacío', true, 'mensaje');
}

if (comprobarCaracteres($mensaje, 4, 200)) {
    enviarRespuestaAsincrona('El mensaje debe tener entre 4 y 200 caracteres', true, 'mensaje');
}

// 3. Cargar una sola vez la plantilla usada por los dos correos.
$templatePath = $basePath . '/App/app/templates/artForm02.html';
$html = file_get_contents($templatePath);

if (!is_string($html)) {
    error_log('artForm02: no se ha podido leer la plantilla de correo.');
    enviarRespuestaAsincrona('No se ha podido preparar el correo. Inténtalo de nuevo más tarde.', true, 'envio');
}

$web = app_url($url);
$nombreAsunto = str_replace(["\r", "\n"], ' ', $nombre);

// Los valores insertados en el correo HTML deben ir escapados.
$valoresHtml = [
    'web' => e($web),
    'url' => e($url),
    'nombre' => e($nombre),
    'telefono' => e($telefono),
    'email' => e($email),
    'mensaje' => nl2br(e($mensaje)),
    'fecha' => e($fecha),
];

// 4. Correo de aviso a la administración.
$correoEmisor = env('EMAIL_WEB', '');
$nombreEmisor = 'Web de ejemplo';
$correoDestinatario = env('EMAIL_ADMIN', '');
$nombreDestinatario = 'Administración';
$correoResponderA = $email;
$nombreResponderA = $nombreAsunto;
$asunto = "Nueva consulta desde la web de ejemplo: $nombreAsunto";

$vars = [
    '{web}' => $valoresHtml['web'],
    '{url}' => $valoresHtml['url'],
    '{asunto}' => e($asunto),
    '{aviso}' => 'Se ha recibido una nueva consulta desde la web de ejemplo.',
    '{explicacion}' => 'Se ha recibido una consulta desde el formulario de la web.',
    '{contexto}' => 'Nueva consulta de',
    '{razon}' => 'Puedes responder directamente al correo facilitado por esta persona.',
    '{nombre}' => $valoresHtml['nombre'],
    '{telefono}' => $valoresHtml['telefono'],
    '{email}' => $valoresHtml['email'],
    '{mensaje}' => $valoresHtml['mensaje'],
    '{responder}' => 'Procura responder en un plazo máximo de 2 días laborables.',
    '{fecha}' => $valoresHtml['fecha'],
];

$cuerpo = str_replace(array_keys($vars), array_values($vars), $html);
$cuerpoTexto = "Nueva consulta de $nombre\nTeléfono: $telefono\nEmail: $email\nMensaje: $mensaje\nFecha: $fecha\nURL: $web";
include $basePath . '/App/app/envioPhpMailer.php';
$correoAdminEnviado = $envioCorreoOk;
$errorCorreoAdmin = $envioCorreoError;

// Si no llega el aviso principal, no intentamos un segundo correo con la misma
// conexion SMTP. Asi evitamos agotar el tiempo maximo de ejecucion de PHP.
if (!$correoAdminEnviado) {
    error_log('artForm02: no se ha enviado el aviso a administracion. ' . ($errorCorreoAdmin ?? 'Sin detalle.'));
    enviarRespuestaAsincrona('No se ha podido enviar el correo. Intentalo de nuevo mas tarde.', true, 'envio');
}

// 5. Correo de confirmación a la persona que ha escrito.
$correoEmisor = env('EMAIL_WEB', '');
$nombreEmisor = 'Web de ejemplo';
$correoDestinatario = $email;
$nombreDestinatario = $nombreAsunto;
$correoResponderA = env('EMAIL_ADMIN', env('EMAIL_WEB', ''));
$nombreResponderA = 'Administración';
$asunto = "$nombreAsunto, hemos recibido tu consulta | Web de ejemplo";

$vars = [
    '{web}' => $valoresHtml['web'],
    '{url}' => $valoresHtml['url'],
    '{asunto}' => e($asunto),
    '{aviso}' => 'Tu consulta se ha recibido correctamente.',
    '{explicacion}' => 'Gracias por contactar con nosotros. Hemos recibido correctamente tu consulta.',
    '{contexto}' => 'Gracias por escribir,',
    '{razon}' => 'Estos son los datos que nos has enviado.',
    '{nombre}' => $valoresHtml['nombre'],
    '{telefono}' => $valoresHtml['telefono'],
    '{email}' => $valoresHtml['email'],
    '{mensaje}' => $valoresHtml['mensaje'],
    '{responder}' => 'Responderemos lo antes posible.',
    '{fecha}' => $valoresHtml['fecha'],
];

$cuerpo = str_replace(array_keys($vars), array_values($vars), $html);
$cuerpoTexto = "Hola $nombre, hemos recibido tu consulta.\nTeléfono: $telefono\nEmail: $email\nMensaje: $mensaje\nFecha: $fecha";
include $basePath . '/App/app/envioPhpMailer.php';
$correoUsuarioEnviado = $envioCorreoOk;
$errorCorreoUsuario = $envioCorreoError;

// 6. Guardar la consulta si este proyecto tiene una BBDD configurada.
$bbddHost = env('BBDD_HOST');
$bbddUser = env('BBDD_USER');
$bbddPass = env('BBDD_PASS');
$bbddNombre = env('BBDD_BBDD');

if (extension_loaded('mysqli') && $bbddHost && $bbddUser && $bbddNombre) {
    $con = @mysqli_connect($bbddHost, $bbddUser, (string) $bbddPass, $bbddNombre);

    if ($con === false) {
        error_log('artForm02: error de conexión con la BBDD: ' . mysqli_connect_error());
    } else {
        $con->set_charset('utf8mb4');
        $sql = 'INSERT INTO `consultas_web` (`creado_en`, `nombre`, `telefono`, `email`, `mensaje`, `ip`, `idioma`, `url_origen`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt === false) {
            error_log('artForm02: error al preparar la consulta: ' . mysqli_error($con));
        } else {
            mysqli_stmt_bind_param($stmt, 'ssssssss', $fecha, $nombre, $telefono, $email, $mensaje, $ip, $lang, $url);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        mysqli_close($con);
    }
}

// Nunca se confirma el formulario si SMTP no ha aceptado los dos correos.
if (!$correoUsuarioEnviado) {
    error_log('artForm02: no se ha enviado la confirmacion al usuario. ' . ($errorCorreoUsuario ?? 'Sin detalle.'));

    enviarRespuestaAsincrona('No se ha podido enviar el correo. Inténtalo de nuevo más tarde.', true, 'envio');
}

enviarRespuestaAsincrona("Gracias por escribir, $nombre. En breve te contactaremos.", false, $nombre);
