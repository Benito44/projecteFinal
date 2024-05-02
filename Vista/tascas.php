<?php
// Aquí deberías incluir tu lógica para conectar a la base de datos y verificar la sesión
session_start();
require '../Model/mainfunction.php';

$connexio = connexio();
$proyectoId = $_GET['id']; // Obtener el ID del proyecto de la URL
// Consulta para obtener las tareas del proyecto
$sql = "SELECT * FROM tasques WHERE id_projecte = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$proyectoId]);
$tareas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="tascas.js"></script>
    <style>
        .column {
            width: 200px;
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .task {
            margin-bottom: 5px;
            padding: 5px;
            background-color: #f0f0f0;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form id="newTaskForm">
        <input type="text" id="newTaskInput" placeholder="Nueva tarea">
        <button type="submit">Crear tarea</button>
    </form>

    <div class="column" id="Por hacer">
        <h2>Por hacer</h2>
        <?php
    // Iterar sobre las tareas y mostrarlas en la columna "Completadas"
    foreach ($tareas as $tarea) {
        if ($tarea['estat'] === 'Por hacer') {
            echo "<div id='{$tarea['id']}' class='task' draggable='true'>{$tarea['descripcio']}</div>";
        }
    }
    ?>
    </div>

    <div class="column" id="En progres">
        <h2>En progreso</h2>
        <?php
    // Iterar sobre las tareas y mostrarlas en la columna "Completadas"
    foreach ($tareas as $tarea) {
        if ($tarea['estat'] === 'En progres') {
            echo "<div id='{$tarea['id']}' class='task' draggable='true'>{$tarea['descripcio']}</div>";
        }
    }
    ?>
    </div>

    <div class="column" id="En revisio">
        <h2>En revisio</h2>
        <?php
    // Iterar sobre las tareas y mostrarlas en la columna "Completadas"
    foreach ($tareas as $tarea) {
        if ($tarea['estat'] === 'En revisio') {
            echo "<div id='{$tarea['id']}' class='task' draggable='true'>{$tarea['descripcio']}</div>";
        }
    }
    ?>
    </div>

    <div class="column" id="Completades">
        <h2>Completadas</h2>
        <?php
    // Iterar sobre las tareas y mostrarlas en la columna "Completadas"
    foreach ($tareas as $tarea) {
        if ($tarea['estat'] === 'Completades') {
            echo "<div id='{$tarea['id']}' class='task' draggable='true'>{$tarea['descripcio']}</div>";
        }
    }
    ?>
    </div>
    <?php
// Iterar sobre las tareas y mostrarlas en la columna correspondiente
foreach ($tareas as $tarea) {
    // Dependiendo del estado de la tarea, decide en qué columna mostrarla
    $columnId = '';
    switch ($tarea['estat']) {
        case 'Por hacer':
            $columnId = 'Por hacer';
            break;
        case 'en_progreso':
            $columnId = 'progres';
            break;
        case 'en_revision':
            $columnId = 'revisio';
            break;
        case 'Completades':
            $columnId = 'complet';
            break;
        default:
            // Por defecto, colocamos las tareas en la columna "Por hacer"
            $columnId = 'Por hacer';
    }
}
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</body>
</html>
