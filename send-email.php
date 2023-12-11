<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = SMTP_HOST;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = SMTP_PORT;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;

    // Establecer la codificación de caracteres
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($email, $name, 'UTF-8');
    $mail->addAddress("contacto@almacocinera.com");

    // Codificar el asunto
    $mail->Subject = "=?UTF-8?B?".base64_encode("Contacto")."?=";

    // Codificar el cuerpo del mensaje
    $mail->Body = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    try {
        $mail->send();
        // Respuesta para el formulario en caso de éxito
        echo json_encode(["status" => "success"]);
        // Redirigir a la página principal después del éxito (mediante JavaScript)
        echo '<script>window.location.href = "index.html";</script>';
        exit();
    } catch (Exception $e) {
        // Respuesta para el formulario en caso de error
        echo json_encode(["status" => "error", "message" => "Error al enviar el correo. Por favor, inténtalo de nuevo más tarde."]);
    }
} else {
    // Si el formulario no se envió mediante POST, redirigir a la página principal
    header("Location: index.html");
    exit();
}
?>



