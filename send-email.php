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

$mail->Host = "mail.ejemplo.com"; //Poner Host
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //
$mail->Port = 465; // Puerto
$mail->Username = "info@ejemplo.com"; // Usuario
$mail->Password = "iejemplocontraseña"; // contraseña

$mail->setFrom($email, $name);
$mail->addAddress("destiantario@ejemplo.com.ar"); // Reemplaza esto con la dirección de correo del destinatario

$mail->Subject = "Contacto";
$mail->Body = $message;

try {
    $mail->send();
    echo "Email enviado con éxito";
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
