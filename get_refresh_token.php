<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Configuración de OAuth 2.0
$oauthConfig = [
    'clientId' => '',
    'clientSecret' => '',
    'redirectUri' => 'http://localhost/Yeka/get_refresh_token.php',
    'host' => 'https://accounts.google.com',
];

// Configuración de PHPMailer
$mail = new PHPMailer(true);
$mail->AuthType = 'XOAUTH2';
$mail->oauthUserEmail = 'yekacomidas@gmail.com';
$mail->oauthClientId = $oauthConfig['clientId'];
$mail->oauthClientSecret = $oauthConfig['clientSecret'];
$mail->oauthRedirectUri = $oauthConfig['redirectUri'];

// Verificar si se recibe el código de autorización
if (isset($_GET['code'])) {
    $oauthCode = $_GET['code'];

    try {
        // Intercambio de código de autorización por tokens de acceso y refresh
        $accessToken = $mail->oauthUserEmail($oauthCode);

        // Mostrar el refresh token
        echo "Tu refresh token es: " . $accessToken->getRefreshToken();
    } catch (Exception $e) {
        echo "Error al intercambiar el código por tokens: {$e->getMessage()}";
    }
} else {
   // Si no hay código de autorización, redirigir al usuario para que inicie el proceso de autorización
$authorizationUrl = $oauthConfig['host'] . '/o/oauth2/auth?' . http_build_query([
    'response_type' => 'code',
    'client_id' => $oauthConfig['clientId'],
    'redirect_uri' => $oauthConfig['redirectUri'],
    'scope' => 'https://mail.google.com/',
    'access_type' => 'offline',
]);
echo "Visita la siguiente URL para autorizar la aplicación: $authorizationUrl";

}
