<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    

    <style>
 body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      margin-top: 20px;
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
    .dialeg {
            position: absolute;
            margin: 0;
            padding: 2rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 32.5rem;
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 8px 8px 24px 0 rgba(0, 0, 0, 0.5);
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
      <?php if ($es_admin): ?>
            <li class="nav-item">
              <a class="nav-link" href="../Controlador/crear_proyecte.php">Crear Projecte</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Controlador/crear_usuari.php">Crear Usuari</a>
            </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar Projectes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Controlador/cerrar_session.php">Tancar sessió</a>
        </li>
    </ul>
  </div>
</nav>
<div>
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

    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perfil
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <form action="../Controlador/perfil.php" id="form" method="post">
                    Usuari
                    <input type="text" id="usuario" name="usuario" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>"><br><br>
                    Email
                    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"><br><br>
                    <input type="submit" value="Login">
                </form>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <form action="../Controlador/perfil.php" id="form" method="post" enctype="multipart/form-data">
                  Imagen de perfil: <input type="file" name="imagen"><br><br>
                  <input type="submit" value="Guardar cambios">
              </form>

                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <form action="../Controlador/perfil.php" id="form2" method="post">
                    Contrasenya actual
                    <input type="password" name="actual" id="actual"><br><br>

                    Nova Contrasenya
                    <input type="password" name="nova_contrasenya" id="nova_contrasenya"><br><br>

                    Torna a posar la contrasenya
                    <input type="password" name="nova_contrasenya2" id="nova_contrasenya2"><br><br>
                    <input type="submit" value="Login">
                </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <button id="eliminarCompte">Eliminar Compte</button>
                </div>
            </div>
            <dialog id="createEventDialog" class="dialeg">
              <p>Estas segur que vols eliminar permanentment el teu compte?</p>
                <form action="../Controlador/perfil.php" id="form2" method="post">
                    Contrasenya
                    <input type="password" name="contrasenya_eliminar" id="contrasenya_eliminar"><br><br>
                    <input type="submit" value="Login">
                </form>
                    <button id="closeCreateEventDialog">Cerrar</button>
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
