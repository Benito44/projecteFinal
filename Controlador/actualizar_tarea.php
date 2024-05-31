<?php
session_start();
require '../Model/mainfunction.php';

$connexio = connexio();

// Obtener los datos de la solicitud AJAX
$idTasca = $_POST['taskId'];
$nouEstat = $_POST['newState'];

// Utilitzar la funció per actualitzar l'estat de la tasca a la base de dades
actualitzarEstatTasca($connexio, $idTasca, $nouEstat);
?>
