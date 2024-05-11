<?php
require '../Model/mainfunction.php';
include '../Vista/recuperar_vista.php';

if (isset($_POST['contra'])) {
    $connexio = connexio();

    $email = $_POST['contra'];
    $nova_contra = '4E5u46\4M';
    
    $usuari = encontrarPorEmail($email);

    //Encriptem la contrasenya
    $encriptada = password_hash($nova_contra, PASSWORD_BCRYPT);

    $statement = $connexio->prepare("UPDATE usuaris SET contrasenya = ? WHERE email = ?");
    $statement->bindParam(1,$encriptada);
    $statement->bindParam(2,$email);
    $statement->execute();

    $text = 'Hola '. $usuari . '<br>' . 'Nova contrasenya: ' . $nova_contra . '<br>' .
    'http://localhost';
    
    
    // Enviem el correu a l'email enviat
    phphmailer($usuari, $email, $text);
    $error = "";
    $error = "Emal enviat";
    header("Location: ../Vista/login.vista.php");
}


?>