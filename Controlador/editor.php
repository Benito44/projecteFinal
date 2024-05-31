<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, mostrar un mensaje de error
        header('Location: ../Vista/login.vista.php');
    exit(); // Detener la ejecución del script después de mostrar el mensaje de error
}
require '../Model/mainfunction.php';
$connexio = connexio();

$sql = "SELECT rol FROM usuaris WHERE email = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$_SESSION['email']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

$es_admin = false;

if ($row && isset($row['rol'])) {
    $es_admin = ($row['rol'] === 'admin');
}

// Verificar si el usuario tiene permisos para acceder al proyecto
$proyectoId = $_GET['id']; // Obtener el ID del proyecto de la URL
//echo $proyectoId;
$usuarioActual = encontrarPorUsuario($_SESSION['usuario']); // Obtener el ID del usuario de la sesión
//echo $usuarioActual;
$sql = "SELECT * FROM proyecto_usuario WHERE id_usuario = ? AND id_proyecto = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$usuarioActual, $proyectoId]);
$row = $statement->fetch(PDO::FETCH_ASSOC);



// Consulta para obtener los usuarios con permisos en el proyecto
$sql_usuarios_permisos = "SELECT u.usuari, u.imatge, u.email 
                          FROM usuaris u
                          INNER JOIN proyecto_usuario pu ON u.id = pu.id_usuario
                          WHERE pu.id_proyecto = ?";
$statement_usuarios_permisos = $connexio->prepare($sql_usuarios_permisos);
$statement_usuarios_permisos->execute([$proyectoId]);
$usuarios_permisos = $statement_usuarios_permisos->fetchAll(PDO::FETCH_ASSOC);

$sql_tasca = "SELECT descripcio FROM tasques WHERE estat = 'En revisio' AND id_projecte = ?";
$statement_tasques = $connexio->prepare($sql_tasca);
$statement_tasques->execute([$proyectoId]);
$tasca = $statement_tasques->fetchAll(PDO::FETCH_ASSOC);


$sql_progres = "SELECT descripcio FROM tasques WHERE estat = 'En progres' AND id_projecte = ?";
$statement_tasques_2 = $connexio->prepare($sql_progres);
$statement_tasques_2->execute([$proyectoId]);
$tasca_progres = $statement_tasques_2->fetchAll(PDO::FETCH_ASSOC);

include '../Vista/editor.php';
?>