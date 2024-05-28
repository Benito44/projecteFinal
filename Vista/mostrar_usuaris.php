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
        .image-preview {
            max-width: 150px;
            max-height: 150px;
            margin-bottom: 10px;
        }
        .fixed-profile-image {
            position: fixed;
            top: 20px;
            right: 20px;
        }
        .fixed-profile-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
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

        </ul>
    </div>
</nav>
<div class="fixed-profile-image">
    <?php
    // Obtener la imagen de perfil del usuario
    $imagen_perfil = obtenerImagenPerfil($_SESSION['email']);
    if($imagen_perfil) {
        echo '<img src="' . htmlspecialchars($imagen_perfil) . '" alt="Imagen de perfil">';
    } else {
        echo '<img src="default_profile_image.jpg" alt="Imagen de perfil por defecto">';
    }
    ?>
</div>
<div class="content">
    <div class="container">
        <h2>Ver Usuarios</h2>
        <a href='../Controlador/crear_usuari.php' class='btn btn-primary'>+</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Imatge</th>
                    <th scope="col">Nom de l'Usuari</th>
                    <th scope="col">Correu Electrónic</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $usuarios = obtenerTodosUsuarios();
                foreach ($usuarios as $usuario) {
                    $imagenPerfil = !empty($usuario['imatge']) ? htmlspecialchars($usuario['imatge']) : '../uploads/default.webp';
                    echo "<tr data-id='{$usuario['id']}'>";
                    echo "<td><img src='" . $imagenPerfil . "' alt='Imagen de Perfil' style='width: 50px; height: 50px; border-radius: 50%;'></td>";
                    echo "<td>{$usuario['usuari']}</td>";
                    echo "<td>{$usuario['email']}</td>";
                    echo "<td>{$usuario['rol']}</td>";
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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const rows = document.querySelectorAll('table tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                const userId = row.getAttribute('data-id');
                window.location.href = `editar_usuaris.php?id=${userId}`;
            });
        });
    });
</script>
</body>
</html>
