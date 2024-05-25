<?php
require '../Model/mainfunction.php';

if (isset($_GET['id'])) {
    $connexio = connexio();
    $proyectoId = $_GET['id'];
    
    $sql = "DELETE FROM projectes WHERE id = :id";
    $statement = $connexio->prepare($sql);
    $statement->bindParam(':id', $proyectoId, PDO::PARAM_INT);
    
    if ($statement->execute()) {
        header("Location: ../Controlador/mostrar.projectes.php");
        exit();
    } else {
        header("Location: ../Controlador/mostrar.projectes.php");
        exit();
    }
} else {
    header("Location: ../Controlador/index.php");
    exit();
}
?>
