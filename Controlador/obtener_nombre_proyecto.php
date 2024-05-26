<?php

require '../Model/mainfunction.php';
$proyectoId = $_GET['id'];

// Obtener el nombre del proyecto
$nombreProyecto = obtenerNombreProyecto($proyectoId);

echo $nombreProyecto;
?>
