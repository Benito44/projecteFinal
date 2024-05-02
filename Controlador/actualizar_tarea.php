<?php
session_start();
require '../Model/mainfunction.php';

$connexio = connexio();

// Obtener los datos de la solicitud AJAX
$taskId = $_POST['taskId'];
$newState = $_POST['newState'];

// Actualizar el estado de la tarea en la base de datos
$sql = "UPDATE tasques SET estat = ? WHERE id = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$newState, $taskId]);

// Responder con un mensaje de éxito
echo "Tarea actualizada correctamente";
?>
