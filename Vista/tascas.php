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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    


    <script src="../js/tascas.js"></script>
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
        ul {
      list-style-type: none;
      padding: 0;
      margin: 20px auto;
      max-width: 600px;
    }
    li {
      margin-bottom: 10px;
    }
    li a {
      text-decoration: none;
      color: #333;
      display: block;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    li a:hover {
      background-color: #f0f0f0;
    }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Mi Sitio Web</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(actual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Acerca de</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Servicios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
      </li>
      <div style="position: absolute; top: 20px; right: 20px;">
            <?php
            // Obtener la imagen de perfil del usuario
            $imagen_perfil = obtenerImagenPerfil($_SESSION['email']);
            if($imagen_perfil) {
                echo '<img src="' . $imagen_perfil . '" alt="Imagen de perfil" style="width: 100px; height: 100px; border-radius: 50%;">';
            } else {
                echo '<img src="default_profile_image.jpg" alt="Imagen de perfil por defecto" style="width: 100px; height: 100px; border-radius: 50%;">';
            }
            ?>
        </div>
    </ul>
  </div>
</nav>
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
