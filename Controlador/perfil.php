<?php
session_start(); // Iniciar la sesión
require '../Model/mainfunction.php';
$connexio = connexio();    

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actual'])) {

    $actual = $_POST['actual'];
    $nova_contrasenya = $_POST['nova_contrasenya'];
    $nova_contrasenya2 = $_POST['nova_contrasenya2'];

    if ($actual == encontrarContrasenya($_SESSION['email']) && $nova_contrasenya == $nova_contrasenya2) {
    $connexio = connexio();
    $statement = $connexio->prepare("UPDATE usuaris SET contrasenya=? WHERE email= ?");
    $statement->bindParam(1,$nova_contrasenya);
    $statement->bindParam(2,$_SESSION['email']);
    $statement->execute();
    
    include '../Vista/perfil.vista.php';
    }else {
        echo "Algo esta mal";
        include '../Vista/perfil.vista.php';
    }
 } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_eliminar'])) {

        $email_eliminar = $_POST['email_eliminar'];
        if ($_POST['email_eliminar'] == $_SESSION['email']) {
        $connexio = connexio();
        borrarCompte($_POST['email_eliminar']);
        header("Location: ./login.php");
        } else {
            echo "Error";
            include '../Vista/perfil.vista.php';
        }
        

 

 } elseif ($_SERVER["REQUEST_METHOD"] == "POST" ) {


    $nom_canviat = $_POST['usuario'];
    $email_canviat = $_POST['email'];
    
        $connexio = connexio();
        $statement = $connexio->prepare("UPDATE usuaris SET usuari=?,email = ? WHERE email= ?");
        $statement->bindParam(1,$nom_canviat);
        $statement->bindParam(2,$email_canviat);
        $statement->bindParam(3,$_SESSION['email']);
        $statement->execute();
        
        $_SESSION['usuario'] = $nom_canviat;
        $_SESSION['email'] = $email_canviat;
        
        include '../Vista/perfil.vista.php';
 

 }else {
    include '../Vista/perfil.vista.php';
 }


?>
