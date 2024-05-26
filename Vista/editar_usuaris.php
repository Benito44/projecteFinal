<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
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
        .image-preview {
            max-width: 150px;
            max-height: 150px;
            margin-bottom: 10px;
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
            $imagen_perfil = obtenerImagenPerfil($_SESSION['email']);
            if ($imagen_perfil) {
                echo '<img src="' . htmlspecialchars($imagen_perfil) . '" alt="Imagen de perfil" style="width: 100px; height: 100px; border-radius: 50%;">';
            } else {
                echo '<img src="USB.jpg" alt="Imagen de perfil por defecto" style="width: 100px; height: 100px; border-radius: 50%;">';
            }
            ?>

            </div>
        </ul>
    </div>
</nav>
<div class="content">
    <div class="container">
        <h2>Editar Usuario</h2>
        <form method="post" id="editUserForm" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
            <div class="mb-3">
                <label for="usuari" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuari" name="usuari" value="<?php echo htmlspecialchars($usuario['usuari']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol de l'usuari</label>
                <select id="rol" name="rol" class="form-select">
                    <option value="admin" <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Administrador</option>
                    <option value="membre" <?php if ($usuario['rol'] === 'membre') echo 'selected'; ?>>Usuari</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="imatge" class="form-label">Imagen de Perfil</label>
                <?php if (!empty($usuario['imatge'])): ?>
                    <div>
                        <img src="<?php echo htmlspecialchars($usuario['imatge']); ?>" alt="Imagen de Perfil" class="image-preview">
                    </div>
                <?php endif; ?>
                <input type="file" class="form-control" id="imatge" name="imatge">
            </div>
            <button type="submit" name="update_user" class="btn btn-primary">Actualizar</button>
            <button type="submit" name="delete_user" class="btn btn-danger">Eliminar</button>
            <a href="../Controlador/mostrar_usuaris.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>