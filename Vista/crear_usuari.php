<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/crear_usuari.css">
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
<div class="content">
    <div class="container">
        <h1>Crear Nou Usuari</h1>
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
