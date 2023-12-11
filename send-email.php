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

    $mail->setFrom($email, $name);
    $mail->addAddress("contacto@almacocinera.com");

    $mail->Subject = "Contacto";
    $mail->Body = $message;

    try {
        $mail->send();
        // Respuesta para el formulario en caso de éxito
        echo json_encode(["status" => "success"]);
        // Redirigir a la página principal después del éxito
        header("Location: index.html");
        exit();
    } catch (Exception $e) {
        // Respuesta para el formulario en caso de error
        echo json_encode(["status" => "error", "message" => "Error al enviar el correo. Por favor, inténtalo de nuevo más tarde."]);
    }    
}
?>

