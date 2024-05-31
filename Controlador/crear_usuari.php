<?php
ob_start();
session_start();
require_once '../Model/mainfunction.php';
        $conn = connexio();
if (!isset($_SESSION['email'])) {
    header('Location: ../Vista/login.vista.php');
}

$sql = "SELECT rol FROM usuaris WHERE email = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION['email']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

$es_admin = false;

if ($row && isset($row['rol'])) {
    $es_admin = ($row['rol'] === 'admin');
}

// Verificar si se enviaron los datos del formulario
if (isset($_POST['usuari']) && isset($_POST['email']) && isset($_POST['contrasenya']) && isset($_POST['contrasenya_2'])) {
    // Verificar si las contraseñas coinciden
    if ($_POST['contrasenya'] === $_POST['contrasenya_2']) {

        $usuari = $_POST['usuari'];
        $email = $_POST['email'];
        $contrasenya = $_POST['contrasenya'];
        $encriptada = password_hash($contrasenya, PASSWORD_BCRYPT);
        $rol = $_POST['rol'];

        $statement = $conn->prepare("INSERT INTO usuaris (usuari, email, contrasenya, rol) VALUES (?,?,?,?)");
        $statement->bindParam(1, $usuari);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $encriptada);
        $statement->bindParam(4, $rol);
        $statement->execute();

        header("Location: ../Controlador/mostrar_usuaris.php");
        exit();
    } else {
        $error = "Las contraseñas no coinciden";
    }
} else {
    $error = "Recuerda completar todos los campos";
}

include_once '../Vista/crear_usuari.php';
ob_end_flush();
?>
