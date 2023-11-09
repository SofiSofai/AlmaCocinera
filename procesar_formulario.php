<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name"];
    $email = $_POST["email"];
    $mensaje = $_POST["text"];

    $destinatario = "yekacomidas@gmail.com";
    $asunto = "Nuevo mensaje de formulario";

    $cuerpoMensaje = "Nombre: $nombre\n";
    $cuerpoMensaje .= "Correo Electrónico: $email\n";
    $cuerpoMensaje .= "Mensaje: $mensaje\n";

    // Configuración de SMTP para Gmail con OAuth 2.0
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->AuthType = 'XOAUTH2';
        $mail->oauthUserEmail = 'yekacomidas@gmail.com';
        $mail->oauthClientId = '1073857541088-lkj8v46ljgebfmqr4ihags0b5usrc30b.apps.googleusercontent.com';
        $mail->oauthClientSecret = '';
        $mail->oauthRefreshToken = '';

        // Configuración de parámetros de correo
        $mail->setFrom('tucorreo@gmail.com', 'Tu Nombre');
        $mail->addAddress($destinatario);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpoMensaje;

        // Envío del correo
        $mail->send();

        // Redirigir o mostrar un mensaje de éxito si es necesario
        header("Location: confirmation.html");
        exit();
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>

