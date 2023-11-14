<?php

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "mail.estacionkm325.com.ar";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // o PHPMailer::ENCRYPTION_SMTPS para SSL
$mail->Port = 465; // o 465 para SSL
$mail->Username = "info@estacionkm325.com.ar";
$mail->Password = "infoestacionkm325";

$mail->setFrom($email, $name);
$mail->addAddress("info@estacionkm325.com.ar"); // Reemplaza esto con la dirección de correo del destinatario

$mail->Subject = "Contacto";
$mail->Body = $message;

try {
    $mail->send();
    echo "Email enviado con éxito";
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
