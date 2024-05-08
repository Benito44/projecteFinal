<?php
require '../Model/mainfunction.php';
session_start();
$token = bin2hex(random_bytes(16)); // Genera un token aleatorio
// Temps d'expiració del token
$expiration = time() + 4 * 3600;

$connexio = connexio();
$email = $_POST['email'];
$_SESSION['email'] = $email;

$usuari = encontrarPorEmail($email);
$insertat_token = insertar_token($token, $email, $expiration);

$text = 'Hola '. $usuari . '<br>' . 'Per restablir la teva contrasenya només clica al següent link: ' . 
'http://localhost/Controlador/canviar_contra.php?token=' . $insertat_token . '&usuari=' . $usuari;
// Enviem el correu a l'email enviat
phphmailer($usuari, $email, $text);
$error = "";
$error = "Emal enviat";
include '../Vista/login.vista.php';

?>