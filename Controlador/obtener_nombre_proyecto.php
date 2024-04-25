<?php

$proyectoId = $_GET['id'];

include '../Model/mainfunction.php';

// Obtener el nombre del proyecto
$nombreProyecto = obtenerNombreProyecto($proyectoId);

echo $nombreProyecto;
?>
