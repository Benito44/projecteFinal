<?php
// Aquí deberías incluir tu lógica para conectar a la base de datos y verificar la sesión
session_start();
require '../Model/mainfunction.php';

if (!isset($_SESSION['email'])) {
    exit("Error: No se ha iniciado sesión");
} else {
    $connexio = connexio(); 
    $sql = "SELECT id, rol FROM usuaris WHERE email = ?";
    $statement = $connexio->prepare($sql);
    $statement->execute([$_SESSION['email']]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $es_admin = $row['rol'] === 'admin';
}

$connexio = connexio();
$proyectoId = $_GET['id'];
// Consulta para obtener las tareas del proyecto
$sql = "SELECT * FROM tasques WHERE id_projecte = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$proyectoId]);
$tareas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="../js/tascas.js"></script>
    <link rel="stylesheet" href="../css/tascas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="../Controlador/perfil.php">
            <?php
            $imagen_perfil = obtenerImagenPerfil($_SESSION['email']);
            if ($imagen_perfil) {
                echo '<img src="' . $imagen_perfil . '" alt="Imagen de perfil">';
            } else {
                                echo '<img src="../uploads/default.webp" alt="Imagen de perfil por defecto">';
            }
            ?>
        </a>
        <a class="navbar-brand d-flex align-items-center" href="#">
            Gestió de Projecte
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar projectes</a>
                </li>
                <?php if ($es_admin): ?>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/mostrar_usuaris.php">Mostrar Usuaris</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/crear_usuari.php">Crear Usuari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/crear_proyecte.php">Crear Projecte</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/cerrar_session.php">
                        <img src="../uploads/ruberga.png" alt="Cerrar sesión" width="20" height="20">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form id="newTaskForm">
    <input type="text" id="newTaskInput" placeholder="Nueva tarea" class="form-control">
    <button type="submit" class="btn btn-primary">Crear tarea</button>
</form>

<div class="container">
    <div class="column" id="Por hacer">
        <h2>Per fer</h2>
        <?php
        foreach ($tareas as $tarea) {
            if ($tarea['estat'] === 'Por hacer') {
                echo "<div id='{$tarea['id']}' class='task' draggable='true'>
                        <span>{$tarea['descripcio']}</span>
                        <button class='deleteTaskBtn' data-task-id='{$tarea['id']}'>&times;</button>
                      </div>";
            }
        }
        ?>
    </div>

    <div class="column" id="En progres">
        <h2>En progrés</h2>
        <?php
        foreach ($tareas as $tarea) {
            if ($tarea['estat'] === 'En progres') {
                echo "<div id='{$tarea['id']}' class='task' draggable='true'>
                        <span>{$tarea['descripcio']}</span>
                        <button class='deleteTaskBtn' data-task-id='{$tarea['id']}'>&times;</button>
                      </div>";
            }
        }
        ?>
    </div>

    <div class="column" id="En revisio">
        <h2>En revisió</h2>
        <?php
        foreach ($tareas as $tarea) {
            if ($tarea['estat'] === 'En revisio') {
                echo "<div id='{$tarea['id']}' class='task' draggable='true'>
                        <span>{$tarea['descripcio']}</span>
                        <button class='deleteTaskBtn' data-task-id='{$tarea['id']}'>&times;</button>
                      </div>";
            }
        }
        ?>
    </div>

    <div class="column" id="Completades">
        <h2>Completades</h2>
        <?php
        foreach ($tareas as $tarea) {
            if ($tarea['estat'] === 'Completades') {
                echo "<div id='{$tarea['id']}' class='task' draggable='true'>
                        <span>{$tarea['descripcio']}</span>
                        <button class='deleteTaskBtn' data-task-id='{$tarea['id']}'>&times;</button>
                      </div>";
            }
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</body>
</html>
