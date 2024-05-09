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
  </style></head>
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
      <a class="nav-link" href="../Controlador/login.php">login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
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
<div class="container">
        <h2>Crear Nuevo Usuario</h2>
        <div class="forms-container">
    <form id="second-form" action="../Controlador/crear_usuari.php" method="post">
        <label for="usuari">Nombre del usuario:</label><br>
        <input type="text" id="usuari" name="usuari" required><br><br>
        
        <label for="email">email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        

        <label for="contrasenya">Contrasenya:</label><br>
        <input type="password" id="contrasenya" name="contrasenya" required><br><br>


        <label for="contrasenya_2">Nova Contrasenya</label><br>
        <input type="password" id="contrasenya_2" name="contrasenya_2" required><br><br>

        <label for="rol">ROL:</label>
        <select id="rol" name="rol">
            <option value="admin">admin</option>
            <option value="membre">membre</option>
        </select>

        <input type="submit" value="Crear">
    </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
