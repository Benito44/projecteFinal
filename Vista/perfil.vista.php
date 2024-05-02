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
    </ul>
  </div>
</nav>
<div>
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
                <form action="../Controlador/perfil.php" id="form2" method="post">
                    Email
                    <input type="email" name="email_eliminar" id="email_eliminar"><br><br>
                    <input type="submit" value="Login">
                </form>
                    <button id="closeCreateEventDialog">Cerrar</button>
                </dialog>
        </div>
    </div>
</div>
<script>
            const createEventDialog = document.getElementById('createEventDialog');
            const openCreateEventFormButton = document.getElementById('eliminarCompte');
            const cerrar_boton = document.getElementById('closeCreateEventDialog');

            openCreateEventFormButton.addEventListener('click', function() {
                createEventDialog.showModal();
            });
            cerrar_boton.addEventListener('click', function() {
                createEventDialog.close();
            });
    </script>
</body>
</html>
