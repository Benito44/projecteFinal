<?php
include '../Model/mainfunction.php';

session_start(); // Iniciar sesión si aún no está iniciada

if (!isset($_SESSION['email'])) {
    exit("Error: No se ha iniciado sesión");
} else {
    $connexio = connexio(); 
    $sql = "SELECT id FROM usuaris WHERE email = ?";
    $statement = $connexio->prepare($sql);
    $statement->execute([$_SESSION['email']]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
}

$connexio = connexio(); 
$sql = "SELECT p.* FROM proyecto_usuario pu INNER JOIN projectes p ON pu.id_proyecto = p.id WHERE pu.id_usuario = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$row['id']]);
$proyectos = $statement->fetchAll(PDO::FETCH_ASSOC);



include '../Vista/mostrar.projectes.vista.php'; 
if (!$proyectos) {
    echo ("Error: No se encontraron proyectos para este usuario");
}
?>
