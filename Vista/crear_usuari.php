<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
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
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .btn-center-right {
            display: flex;
            justify-content: flex-end;
        }
        .profile-image {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .profile-image img {
            width: 50px;
            height: 50px;
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
        <h2>Crear Nou Usuari</h2>
        <div class="forms-container">
            <form id="second-form" action="../Controlador/crear_usuari.php" method="post">
                <div class="mb-3">
                    <label for="usuari" class="form-label">Nom de l'usuari:</label>
                    <input type="text" id="usuari" name="usuari" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="contrasenya" class="form-label">Contrasenya:</label>
                    <input type="password" id="contrasenya" name="contrasenya" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="contrasenya_2" class="form-label">Nova Contrasenya</label>
                    <input type="password" id="contrasenya_2" name="contrasenya_2" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol de l'usuari:</label>
                    <select id="rol" name="rol" class="form-select">
                        <option value="admin">Administrador</option>
                        <option value="membre">Usuari</option>
                    </select>
                </div>
                <span class="error">
                    <?php if(isset($error)) { echo $error; } ?>
                </span>
                <div class="btn-center-right">
                    <input type="submit" value="Crear Usuari" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
