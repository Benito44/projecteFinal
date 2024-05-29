<?php
session_start();
require '../Model/mainfunction.php';

if (!isset($_SESSION['email'])) {
    header('Location: ../Vista/login.vista.php');
} 

$connexio = connexio();

$sql = "SELECT rol FROM usuaris WHERE email = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$_SESSION['email']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

$es_admin = false;

if ($row && isset($row['rol'])) {
    $es_admin = ($row['rol'] === 'admin');
}

include '../Vista/calendari.php';
?>