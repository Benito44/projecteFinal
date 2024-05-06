<?php
ob_start(); // Start output buffering

session_start();

require 'autentificacion.php';
require '../Model/mainfunction.php';

$usuari = $google_account_info->name;
$email = $google_account_info->email;

try {
    if (comprovarEmail($email)) {
        $error = "L'email ja està registrat";
        $usuari = encontrarPorEmail($email);
        $_SESSION['usuario'] = $usuari;
        $_SESSION['email'] = $email;
        header("Location: ./mostrar.projectes.php");
        exit; // Ensure script stops after redirection
    } else {
        insertar_usuari_Oauth2($usuari, $email);
        $_SESSION['usuario'] = $usuari;
        $_SESSION['email'] = $email;
        header("Location: ./mostrar.projectes.php");
        exit; // Ensure script stops after redirection
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

ob_end_flush(); // Flush the output buffer
?>
