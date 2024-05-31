<?php
session_start();
require '../Model/mainfunction.php';
$conn = connexio();
$sql = "SELECT rol FROM usuaris WHERE email = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION['email']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

$es_admin = false;

if ($row && isset($row['rol'])) {
    $es_admin = ($row['rol'] === 'admin');
}
include '../Vista/mostrar_usuaris.php';




if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = obtenerUsuarioPorId($id);
    echo json_encode($usuario);
    exit();
}

function obtenerTodosUsuarios() {
    $conn = connexio();
    $statement = $conn->query("SELECT * FROM usuaris");
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerUsuarioPorId($id) {
    $conn = connexio();
    $statement = $conn->prepare("SELECT * FROM usuaris WHERE id = :id");
    $statement->execute(['id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}


?>