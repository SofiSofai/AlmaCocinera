<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Verificar si la dirección de correo electrónico es válida
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "mail.estacionkm325.com.ar";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->Username = "info@estacionkm325.com.ar";
        $mail->Password = "infoestacionkm325";

        $mail->setFrom($email, $name);
        $mail->addAddress("info@estacionkm325.com.ar");

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
