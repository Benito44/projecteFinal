<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, mostrar un mensaje de error
        header('Location: ./login.vista.php');
    exit(); // Detener la ejecución del script después de mostrar el mensaje de error
}

require '../Model/mainfunction.php';
$connexio = connexio();

// Verificar si el usuario tiene permisos para acceder al proyecto
$proyectoId = $_GET['id']; // Obtener el ID del proyecto de la URL
//echo $proyectoId;
$usuarioActual = encontrarPorUsuario($_SESSION['usuario']); // Obtener el ID del usuario de la sesión
//echo $usuarioActual;
$sql = "SELECT * FROM proyecto_usuario WHERE id_usuario = ? AND id_proyecto = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$usuarioActual, $proyectoId]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

// Consulta para obtener los usuarios con permisos en el proyecto
$sql_usuarios_permisos = "SELECT u.usuari, u.imatge, u.email 
                          FROM usuaris u
                          INNER JOIN proyecto_usuario pu ON u.id = pu.id_usuario
                          WHERE pu.id_proyecto = ?";
$statement_usuarios_permisos = $connexio->prepare($sql_usuarios_permisos);
$statement_usuarios_permisos->execute([$proyectoId]);
$usuarios_permisos = $statement_usuarios_permisos->fetchAll(PDO::FETCH_ASSOC);

if ($row) {
    if ($row['permissos'] === 'editar') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            color: #333;
            text-align: center;
        }


        #editor {
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
        }

        #editorForm {
            text-align: center;
        }

        #editorForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #editorForm button:hover {
            background-color: #0056b3;
        }

        #chat-container {
            margin: 20px auto;
            width: 80%;
        }

        #chat-messages {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            box-sizing: border-box;
            background-color: #fff;
            overflow-y: auto;
        }

        #chat-form {
            text-align: center;
            margin-top: 20px;
        }

        #chat-form input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-right: 10px;
        }

        #chat-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #chat-form button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
        <a class="nav-link" href="./tascas.php?id=<?php echo $proyectoId; ?>">Tascas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Servicios</a>
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
    <h1 id="nombre_proyecto"></h1>
    <ul style="float: right;">
        <?php foreach ($usuarios_permisos as $usuario_permiso): ?>
            <?php echo '<img src="' . $usuario_permiso['imatge'] . '" title="'. $usuario_permiso['usuari'] . '" style="width: 50px; height: 50px; border-radius: 50%;">'; ?>
        <?php endforeach; ?>
    </ul>
    <a href="./tascas.php?id=<?php echo $proyectoId; ?>">Ver tareas</a>
    <a href="../Controlador/cerrar_session.php">Cerrar sesión</a>
    <textarea id="editor" rows="10" cols="50"></textarea>
    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
  El proyecto se ha actualizado.
</div>
<h2>Usuarios con permisos en el proyecto:</h2>
    <ul>
        <?php foreach ($usuarios_permisos as $usuario_permiso): ?>
            <li><?php echo $usuario_permiso['nombre'] . ' (' . $usuario_permiso['email'] . ')'; ?></li>
        <?php endforeach; ?>
    </ul>
            <a href="../Controlador/login.php" target="_blank">Login</a>
    


    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form>
    <script src="../js/script.js"></script>

</body>

</html>
<?php
    } elseif($row['permissos'] === 'visualitzar'){
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    

    <title>Collaborative Editor</title>
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            color: #333;
            text-align: center;
        }

        #editor {
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
        }

        #editorForm {
            text-align: center;
        }

        #editorForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #editorForm button:hover {
            background-color: #0056b3;
        }

        #chat-container {
            margin: 20px auto;
            width: 80%;
        }

        #chat-messages {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            box-sizing: border-box;
            background-color: #fff;
            overflow-y: auto;
        }

        #chat-form {
            text-align: center;
            margin-top: 20px;
        }

        #chat-form input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-right: 10px;
        }

        #chat-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #chat-form button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
      <a class="nav-link" href="./tascas.php?id=<?php echo $proyectoId; ?>">Tascas</a>
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

    <h1 id="nombre_proyecto"></h1>
    <ul style="float: right;">
        <?php foreach ($usuarios_permisos as $usuario_permiso): ?>
            <?php echo '<img src="' . $usuario_permiso['imatge'] . '" title="'. $usuario_permiso['usuari'] . '" style="width: 50px; height: 50px; border-radius: 50%;">'; ?>
        <?php endforeach; ?>
    </ul>
    <textarea id="editor" rows="10" cols="50" readonly></textarea>
    


    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>


    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje..." readonly>
        <button type="submit">Enviar</button>
    </form>
    <script src="../js/script.js"></script>
</body>
</html>
<?php
    } elseif($row['permissos'] === 'comentar'){
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Editor</title>
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            color: #333;
            text-align: center;
        }
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

        #editor {
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
        }

        #editorForm {
            text-align: center;
        }

        #editorForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #editorForm button:hover {
            background-color: #0056b3;
        }

        #chat-container {
            margin: 20px auto;
            width: 80%;
        }

        #chat-messages {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            box-sizing: border-box;
            background-color: #fff;
            overflow-y: auto;
        }

        #chat-form {
            text-align: center;
            margin-top: 20px;
        }

        #chat-form input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-right: 10px;
        }

        #chat-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #chat-form button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
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
      <a class="nav-link" href="./tascas.php?id=<?php echo $proyectoId; ?>">Tascas</a>
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
    <h1 id="nombre_proyecto"></h1>
    <ul style="float: right;">
        <?php foreach ($usuarios_permisos as $usuario_permiso): ?>
            <?php echo '<img src="' . $usuario_permiso['imatge'] . '" title="'. $usuario_permiso['usuari'] . '" style="width: 50px; height: 50px; border-radius: 50%;">'; ?>
        <?php endforeach; ?>
    </ul>
    <textarea id="editor" rows="10" cols="50" readonly></textarea>


    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form>
    <script src="../js/script.js"></script>
    
</body>
</html>
<?php
    }
  
} else {
    // El usuario no tiene permisos, mostrar un mensaje de acceso denegado
    echo 'No tienes permisos';
}