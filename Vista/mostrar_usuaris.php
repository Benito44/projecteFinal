<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table tr {
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">Gestió de Projectes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Controlador/crear_proyecte.php">Crear Projecte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar Projectes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../Controlador/cerrar_session.php">Tancar sessió</a>
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
<div class="content">
    <div class="container">
        <h2>Ver Usuarios</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre de Usuario</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $usuarios = obtenerTodosUsuarios();
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td><a href='editar_usuaris.php?id={$usuario['id']}'>{$usuario['usuari']}</a></td>";
                    echo "<td>{$usuario['email']}</td>";
                    echo "<td>{$usuario['rol']}</td>";
                    echo "<td><a href='editar_usuaris.php?id={$usuario['id']}' class='btn btn-primary'>Editar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
