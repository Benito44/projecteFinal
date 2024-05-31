<?php
require '../Model/mainfunction.php';


if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format de correu no existent';
        header("Location: ../Vista/login.vista.php");
    }

    try {
        $connexio = connexio();

        $nova_contra = "";
        $pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $max = strlen($pattern) - 1;
        for ($i = 0; $i < 9; $i++) {
            $nova_contra .= substr($pattern, mt_rand(0, $max), 1);
        }

        $usuari = encontrarPorEmail($email);

        if (!$usuari) {
            $error = 'Usuari no trobat';
            header("Location: ../Vista/login.vista.php");
        }

        // Encriptar la contraseña
        $encriptada = password_hash($nova_contra, PASSWORD_BCRYPT);

        $statement = $connexio->prepare("UPDATE usuaris SET contrasenya = ? WHERE email = ?");
        $statement->bindParam(1, $encriptada);
        $statement->bindParam(2, $email);
        $statement->execute();

        $text = 'Hola ' . $usuari . ',<br><br>' .
        'L\'administrador ha proporcionat una nova contrasenya per al teu compte.<br>' .
        '<strong>Nova contrasenya:</strong> ' . $nova_contra . '<br><br>' .
        'Si us plau, inicia sessió amb la nova contrasenya i canvia-la des del teu perfil el més aviat possible.<br><br>' .
        '<a href="http://localhost">http://localhost</a><br><br>' .
        'Salutacions,<br>' .
        'L\'equip de suport';


        // Enviar el correo electrónico al usuario
        phphmailer($usuari, $email, $text);

        $error = 'Correu per recuperar la contrasenya ha sigut enviat';
        header("Location: ../Vista/login.vista.php");
        exit();

    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
include '../Vista/recuperar_vista.php';
?>
