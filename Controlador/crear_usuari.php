<?php
session_start();
require '../Model/mainfunction.php';


if (!isset($_SESSION['email'])) {
    exit("Error: No se ha iniciado sesión");
} 

include '../Vista/crear_usuari.php';
if (isset($_POST['usuari']) && isset($_POST['email'])) {
$conn = connexio();

$usuari = $_POST['usuari'];
$email = $_POST['email'];
$contrasenya = $_POST['contrasenya'];
//Encriptem la contrasenya
$encriptada = password_hash($contrasenya, PASSWORD_BCRYPT);
$contrasenya_2 = $_POST['contrasenya_2'];
$rol = $_POST['rol'];

$statement = $conn->prepare("INSERT INTO usuaris (usuari, email, contrasenya, rol) VALUES (?,?,?,?)");
$statement->bindParam(1,$usuari);
$statement->bindParam(2,$email);
$statement->bindParam(3,$encriptada);
$statement->bindParam(4,$rol);
$statement->execute();

header("Location: ./crear_proyecte.php");

}
?>