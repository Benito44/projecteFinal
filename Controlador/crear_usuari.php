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

if (isset($_POST['usuari']) && isset($_POST['email']) && isset($_POST['contrasenya']) && isset($_POST['contrasenya_2'])) {
    $usuari = $_POST['usuari'];
    $email = $_POST['email'];
    $contrasenya = $_POST['contrasenya'];
    $contrasenya_2 = $_POST['contrasenya_2'];
    $rol = $_POST['rol'];

    // Verificar si las contrasenyes coincideixen
    if ($contrasenya === $contrasenya_2) {

        if (strlen($contrasenya) >= 8 &&
            preg_match('/[A-Z]/', $contrasenya) && // Al menys una lletra mayúscula
            preg_match('/[a-z]/', $contrasenya) && // Al menys una lletra minúscula
            preg_match('/[0-9]/', $contrasenya)) { // Al menos un número


            $encriptada = password_hash($contrasenya, PASSWORD_BCRYPT);

            $statement = $conn->prepare("INSERT INTO usuaris (usuari, email, contrasenya, rol) VALUES (?,?,?,?)");
            $statement->bindParam(1, $usuari);
            $statement->bindParam(2, $email);
            $statement->bindParam(3, $encriptada);
            $statement->bindParam(4, $rol);
            $statement->execute();

            header("Location: ../Controlador/mostrar_usuaris.php");
            exit();
        } else {
            $error = "Les contrasenyes ha de tenir almenys 8 caràcters, incloent una lletra majúscula, una lletra minúscula, un número.";
        }
    } else {
        $error = "Les contrasenyes no coincideixen.";
    }
} else {
    $error = "Tots els camps són obligatoris.";
}

include_once '../Vista/crear_usuari.php';
ob_end_flush();
?>