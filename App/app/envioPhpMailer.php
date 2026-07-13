<?php

use PHPMailer\PHPMailer\PHPMailer;

$basePath = dirname(__DIR__, 2);
require_once $basePath . '/vendor/autoload.php';

// Estas variables permiten al controlador saber si SMTP acepto el correo.
$envioCorreoOk = false;
$envioCorreoError = null;

$mailEnabled = filter_var(env('MAIL_ENABLED', 'true'), FILTER_VALIDATE_BOOLEAN);
$smtpHost = env('SMTP_HOST');
$smtpUser = env('SMTP_USERNAME');
$smtpPassword = env('SMTP_PASSWORD');

if (!$mailEnabled) {
    $envioCorreoError = 'El envio de correo esta desactivado.';
    return;
}

if (
    $smtpHost === null
    || $smtpUser === null
    || $smtpPassword === null
    || empty($correoEmisor)
    || empty($correoDestinatario)
) {
    $envioCorreoError = 'Faltan datos de correo en .env.';
    error_log('PHPMailer: ' . $envioCorreoError);
    return;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPassword;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->Timeout = 15;

    $mail->setFrom($correoEmisor, $nombreEmisor);
    $mail->addAddress($correoDestinatario, $nombreDestinatario);

    if (!empty($correoResponderA) && comprobarEmailSintaxis($correoResponderA)) {
        $mail->addReplyTo($correoResponderA, $nombreResponderA ?? '');
    }

    $mail->isHTML(true);
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;
    $mail->AltBody = $cuerpoTexto ?? 'Mensaje enviado desde el formulario de la web.';

    $logo = $basePath . '/App/app/img/logo.png';
    if (is_file($logo)) {
        $mail->addEmbeddedImage($logo, 'logo');
    }

    $envioCorreoOk = $mail->send();
} catch (Throwable $exception) {
    // No imprimimos errores porque romperian la respuesta JSON del formulario.
    $envioCorreoError = $exception->getMessage();
    error_log('PHPMailer: ' . $envioCorreoError);
}
