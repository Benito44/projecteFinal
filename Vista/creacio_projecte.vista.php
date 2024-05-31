<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/crear_projecte.css">
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



    <div class="content">
        <div class="container">
            <h1>Crear Nou Projecte</h1>
            <form action="../Controlador/crear_proyecte.php" method="post" id="crearProyectoForm">
                <div class="mb-3">
                    <label for="nombre_proyecto" class="form-label">Nom del projecte:</label>
                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripció:</label>
                    <textarea id="descripcion" name="descripcion" required class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="data_fi" class="form-label">Data final d'entrega: </label>
                    <input type="date" id="data_fi" name="data_fi" required class="form-control">
                </div>
                <span class="error">
                    <?php if(isset($error)) { echo $error; } ?>
                </span>
                <div class="btn-center-right">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
            <div class="btn-center-right mt-3">
            </div>
        </div>
    </div>

</body>
</html>
