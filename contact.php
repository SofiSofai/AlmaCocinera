<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $email = $_POST["email"];
  $mensaje = $_POST["mensaje"];

  $to = "info@estacionkm325.com.ar"; // Reemplaza con tu dirección de correo electrónico
  $subject = "Nuevo mensaje de contacto de $nombre";
  $message = "Nombre: $nombre\n";
  $message .= "Correo Electrónico: $email\n";
  $message .= "Mensaje:\n$mensaje";

  $headers = "From: $email";

  // Configura el servidor SMTP
  ini_set("SMTP", "mail.estacionkm325.com.ar");
  ini_set("smtp_port", 465);

  // Configura la autenticación
  ini_set("sendmail_from", "info@estacionkm325.com.ar");
  ini_set("auth_username", "info@estacionkm325.com.ar");
  ini_set("auth_password", "infoestacionkm325");

  // Envía el correo electrónico
  mail($to, $subject, $message, $headers);

  // Redirige al usuario a una página de confirmación
  header("Location: confirmation.html"); // Crea una página de confirmación si no la tienes
}
?>

