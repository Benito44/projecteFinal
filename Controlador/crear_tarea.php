<?php
session_start();
require '../Model/mainfunction.php';

// Comprobar si se recibieron los datos necesarios
if (isset($_POST['taskName']) && isset($_POST['projectId'])) {
    $taskName = $_POST['taskName'];
    $projectId = $_POST['projectId'];
    
    // Conectar a la base de datos
    $connexio = connexio();

    $taskId = inserirTasca($connexio, $projectId, $taskName);

    if ($taskId) {
        $novaTasca = obtenirTascaPerId($connexio, $taskId);
        echo json_encode($novaTasca);
    } else {
        echo json_encode("Error al crear la tarea");
    }
} else {
    echo json_encode("Falta información para crear la tarea");
}
?>
