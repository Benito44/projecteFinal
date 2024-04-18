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
$sql = "SELECT * FROM projectes WHERE id_usuari = ?";
$stmt = $connexio->prepare($sql);
$stmt->execute([$row['id']]);
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$proyectos) {
    exit("Error: No se encontraron proyectos para este usuario");
}
include '../Vista/mostrar.projectes.vista.php'; 

?>
