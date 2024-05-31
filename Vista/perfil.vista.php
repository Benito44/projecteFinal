<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/perfil.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../uploads/ruberga.png" alt="Logo Gestió de Projectes">
                </a>
                <a class="navbar-brand d-flex align-items-center" href="#">
                Mi Sitio Web
                </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar projectes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/mostrar_usuaris.php">Mostrar Usuaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/cerrar_session.php">Tancar sessió</a>
                    </li>
                </ul>
                <!-- <div class="profile-image ms-3">
                    <?php
                    $imagen_perfil = obtenerImagenPerfil($_SESSION['email']);
                    if ($imagen_perfil) {
                        echo '<img src="' . $imagen_perfil . '" alt="Imagen de perfil">';
                    } else {
                        echo '<img src="default_profile_image.jpg" alt="Imagen de perfil por defecto">';
                    }
                    ?>
                </div> -->
            </div>
        </div>
    </nav>


<div class="container">
    <div class="py-12">
        <h1>Perfil de l'usuari</h1>
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <form action="../Controlador/perfil.php" id="form" method="post" enctype="multipart/form-data">
                                <h2>Imatge de perfil</h2>
                                <div class="profile-picture text-center mt-4">
                                    <?php
                                    // Obtener la imagen de perfil del usuario
                                    $imagen_perfil = obtenerImagenPerfil($_SESSION['email']);
                                    if($imagen_perfil) {
                                        echo '<img src="' . $imagen_perfil . '" alt="Imagen de perfil" style="width: 250px; height: 250px; border-radius: 50%;">';
                                    }
                                    ?>
                                </div>
                                <label for="imagen">Imatge</label>
                                <input type="file" id="imagen" name="imagen" class="form-control mb-3">
                                <input type="submit" value="Actualitzar informació" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
                        <div class="max-w-xl">
                            <form action="../Controlador/perfil.php" id="form" method="post">
                                <h3>Informació d'usuari</h3>

                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuari</label>
                                    <input type="text" id="usuario" name="usuario" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" class="form-control">
                                </div>
                                <input type="submit" value="Actualitzar informació" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <form action="../Controlador/perfil.php" id="form" method="post">
                                <h3>Cambiar contraseña</h3>
                                <div class="mb-3">
                                    <label for="actual" class="form-label">Contrasenya actual</label>
                                    <input type="password" name="actual" id="actual" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="nova_contrasenya" class="form-label">Nova Contrasenya</label>
                                    <input type="password" name="nova_contrasenya" id="nova_contrasenya" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="nova_contrasenya2" class="form-label">Torna a posar la contrasenya</label>
                                    <input type="password" name="nova_contrasenya2" id="nova_contrasenya2" class="form-control">
                                </div>
                                <span class="error">
                                    <?php if(isset($error)) { echo $error; } ?>
                                </span>
                                <input type="submit" value="Actualizar contraseña" class="btn btn-primary">
                            </form>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h3>Eliminar cuenta</h3>
                            <button id="eliminarCompte" class="btn btn-danger">Eliminar Compte</button>
                        </div>
                    </div>
                </div>
            </div>
            <dialog id="createEventDialog" class="dialeg">
                <p>Estas segur que vols eliminar permanentment el teu compte?</p>
                <form action="../Controlador/perfil.php" id="form2" method="post">
                    Contrasenya
                    <input type="password" name="contrasenya_eliminar" id="contrasenya_eliminar" class="form-control mb-3">
                    <input type="submit" value="Confirmar eliminación" class="btn btn-danger">
                </form>
                <button id="closeCreateEventDialog" class="btn btn-secondary">Cerrar</button>
            </dialog>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/perfil.js"></script>
</body>
</html>
