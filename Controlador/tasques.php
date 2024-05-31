<?php
// Aquí deberías incluir tu lógica para conectar a la base de datos y verificar la sesión
session_start();
require '../Model/mainfunction.php';

if (!isset($_SESSION['email'])) {
    exit("Error: No se ha iniciado sesión");
} else {
    $connexio = connexio(); 
    $sql = "SELECT id, rol FROM usuaris WHERE email = ?";
    $statement = $connexio->prepare($sql);
    $statement->execute([$_SESSION['email']]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $es_admin = $row['rol'] === 'admin';
}

$connexio = connexio();
$proyectoId = $_GET['id'];
// Consulta para obtener las tareas del proyecto
$sql = "SELECT * FROM tasques WHERE id_projecte = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$proyectoId]);
$tareas = $statement->fetchAll(PDO::FETCH_ASSOC);

include '../Vista/tascas.php';
?>
