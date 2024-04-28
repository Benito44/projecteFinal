<?php
session_start(); // Iniciar la sesión
require '../Model/mainfunction.php';
$connexio = connexio();    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
 } else {
    include '../Vista/perfil.vista.php';
 }



 


?>
