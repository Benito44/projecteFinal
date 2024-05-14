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

$sql_tasca = "SELECT descripcio FROM tasques WHERE estat = 'Completades' AND id_projecte = ?";
$statement_tasques = $connexio->prepare($sql_tasca);
$statement_tasques->execute([$proyectoId]);
$tasca = $statement_tasques->fetchAll(PDO::FETCH_ASSOC);


$sql_progres = "SELECT descripcio FROM tasques WHERE estat = 'Por hacer' AND id_projecte = ?";
$statement_tasques_2 = $connexio->prepare($sql_progres);
$statement_tasques_2->execute([$proyectoId]);
$tasca_progres = $statement_tasques_2->fetchAll(PDO::FETCH_ASSOC);

$es_admin = true;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/editor.css">
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
<ul style="float: right;">
        <?php foreach ($usuarios_permisos as $usuario_permiso): ?>
            <?php echo '<img src="' . $usuario_permiso['imatge'] . '" title="'. $usuario_permiso['usuari'] . '" style="width: 50px; height: 50px; border-radius: 50%;">'; ?>
        <?php endforeach; ?>
    </ul>

    <?php if ($es_admin): ?>
      <ul style="float: right;">
        <?php foreach ($tasca as $usuario_tasca): ?>
            <?php echo $usuario_tasca['descripcio']; ?>
        <?php endforeach; ?>
    </ul>
          <?php endif; ?>

      <ul style="float: right;">
        <?php foreach ($tasca_progres as $usuario_tasca_2): ?>
            <?php echo $usuario_tasca_2['descripcio']; ?>
        <?php endforeach; ?>
    </ul>

    <h1 id="nombre_proyecto"></h1>
    <a href="../Controlador/cerrar_session.php">Cerrar sesión</a>
    
    <div id="chat-container">
      <textarea id="editor" rows="10" cols="50"></textarea>
    </div>

    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
      El proyecto se ha actualizado.
    </div> 
     <!--     
  <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form> -->
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
    <title>Collaborative Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/editor.css">
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

    <div id="chat-container">
    <textarea id="editor" rows="10" cols="50" readonly></textarea>
    </div>

    <form id="editorForm">
        <button type="submit">Enviar</button>
    </form>
    


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/editor.css">
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

    <textarea id="editor" rows="10" cols="50" readonly></textarea>
    <form id="editorForm">
        <button type="submit">Enviar</button>
    </form>
    


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