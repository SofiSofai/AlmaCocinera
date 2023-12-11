<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'config.php'; // Incluye el archivo de configuración

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validar la dirección de correo electrónico
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
        } catch (Exception $e) {
            // Respuesta para el formulario en caso de error
            echo json_encode(["status" => "error", "message" => "Error al enviar el correo: {$mail->ErrorInfo}"]);
        }
    } else {
        // Si la dirección de correo electrónico no es válida, devuelve un mensaje de error
        echo json_encode(["status" => "error", "message" => "Dirección de correo electrónico no válida."]);
    }
} else {
    // Si el formulario no se envió mediante POST, redirigir a la página principal
    header("Location: index.html");
    exit();
}

// Redirigir a la página principal en caso de éxito
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    header("Location: index.html");
    exit();
}
?>
