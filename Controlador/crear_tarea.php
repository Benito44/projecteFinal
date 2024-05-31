<?php
session_start();
require '../Model/mainfunction.php';

// Comprobar si se recibieron los datos necesarios
if (isset($_POST['taskName']) && isset($_POST['projectId'])) {
    $taskName = $_POST['taskName'];
    $projectId = $_POST['projectId'];
    
    // Conectar a la base de datos
    $connexio = connexio();

    // Insertar la tarea en la base de datos con el estado por defecto "Por hacer"
    $taskId = inserirTasca($connexio, $projectId, $taskName);

    // Si la inserción fue exitosa, devolver el ID de la nueva tarea
    if ($taskId) {
        // Obtener los detalles de la tarea recién creada
        $novaTasca = obtenirTascaPerId($connexio, $taskId);
        // Retornar los detalles de la tarea en formato JSON
        echo json_encode($novaTasca);
    } else {
        // Si ocurrió algún error durante la inserción, devolver un mensaje de error
        echo json_encode("Error al crear la tarea");
    }
} else {
    // Si no se recibieron los datos esperados, devolver un mensaje de error
    echo json_encode("Falta información para crear la tarea");
}
?>
