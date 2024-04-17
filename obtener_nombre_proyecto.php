<?php
// Obtener el ID del proyecto enviado desde la solicitud AJAX
$proyectoId = $_GET['id'];

include './Model/mainfunction.php';

// Función para obtener el nombre del proyecto basado en su ID
function obtenerNombreProyecto($id) {
    $conn = connexio(); // Conexión a la base de datos

    // Consulta para obtener el nombre del proyecto
    $sql = "SELECT nom FROM projectes WHERE id = ?";
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Devolver el nombre del proyecto
    return $row['nom'];
}

// Obtener el nombre del proyecto
$nombreProyecto = obtenerNombreProyecto($proyectoId);

// Devolver el nombre del proyecto como respuesta a la solicitud AJAX
echo $nombreProyecto;
?>
