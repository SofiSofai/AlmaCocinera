<?php
// Verifica si la solicitud es de tipo POST (cuando el formulario se envía)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["text"];

    // Configuración del correo electrónico
    $to = "yekacomidas@gmail.com"; // Reemplaza con tu dirección de correo electrónico
    $subject = "Nuevo mensaje de contacto de $name";
    $message = "Nombre: $name\nCorreo Electrónico: $email\nMensaje:\n$message";
    $headers = "From: $email";

    // Configuración del servidor SMTP de Gmail
    ini_set("SMTP", "smtp.gmail.com");
    ini_set("smtp_port", "587");
    ini_set("sendmail_from", "yekacomidas@gmail.com"); // Reemplaza con tu dirección de correo electrónico de Gmail

    // Autenticación de Gmail
    $username = "yekacomidas@gmail.com"; // Reemplaza con tu dirección de correo electrónico de Gmail
    $password = "acomerla"; // Reemplaza con la contraseña de tu cuenta de Gmail

    // Envía el correo electrónico utilizando SMTP de Gmail
    mail($to, $subject, $message, $headers, "-f$yekacomidas@gmail.com");

    // Redirige al usuario a una página de confirmación
    header("Location: confirmation.html"); // Crea una página de confirmación si no la tienes
}
?>
