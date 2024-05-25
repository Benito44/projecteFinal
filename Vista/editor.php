<?php
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/editor.css">
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
      <a class="nav-link" href="../Vista/tascas.php?id=<?php echo $proyectoId; ?>">Tascas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar Projectes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/cerrar_session.php">Tancar sessió</a>
      </li>
      <div style="position: absolute; top: 20px; right: 140px;">
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

<div class="buttons-container">
  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Tasques pendents</button>
  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Chat</button>
</div>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tasques pendents</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php if ($es_admin): ?>
    <p>En revisió</p>
    <div>
      <ul>
        <?php foreach ($tasca as $usuario_tasca): ?>
          <li><?php echo $usuario_tasca['descripcio']; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>

    <!-- Separador -->
    <hr>

    <div>
      <p>Pendents:</p>
      <ul>
        <?php foreach ($tasca_progres as $usuario_tasca_2): ?>
          <li><?php echo $usuario_tasca_2['descripcio']; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Chat</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="chat-container">
      <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    <form id="chat-form">
      <input type="text" id="message-input" placeholder="Escribe un mensaje...">
      <button type="submit">Enviar</button>
    </form> 
  </div>
</div>

<div class="title-container">
    <h1 id="nombre_proyecto">Nombre del Proyecto</h1>
    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
        El proyecto se ha actualizado.
    </div>
</div>

<div id="chat-container">
  <textarea id="editor" rows="10" cols="50"></textarea>
</div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/editor.css">
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
        <a class="nav-link" href="../Vista/tascas.php?id=<?php echo $proyectoId; ?>">Tascas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar Projectes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
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
            }
            ?>
        </div>
    </ul>
  </div>
</nav>



<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Tasques pendents</button>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Chat</button>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tasques pendents</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <?php if ($es_admin): ?>
    <p>En revisió</p>
    <div>
        <ul>
            <?php foreach ($tasca as $usuario_tasca): ?>
                <li><?php echo $usuario_tasca['descripcio']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>



  <div>
  <p>Pendents:  </p>
      <ul>
          <?php foreach ($tasca_progres as $usuario_tasca_2): ?>
              <li><?php echo $usuario_tasca_2['descripcio']; ?></li>
          <?php endforeach; ?>
      </ul>
  </div>
  </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Chat</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form> 
  </div>
</div>
    </div>

    <h1 id="nombre_proyecto"></h1>
    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
      El proyecto se ha actualizado.
    </div>
    
    <div id="chat-container">
      <textarea id="editor" rows="10" cols="50"></textarea>
    </div>



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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/editor.css">
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
      <a class="nav-link" href="../Vista/tascas.php?id=<?php echo $proyectoId; ?>">Tascas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar Projectes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
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



<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Tasques pendents</button>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Chat</button>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tasques pendents</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <?php if ($es_admin): ?>
    <p>En revisió</p>
    <div>
        <ul>
            <?php foreach ($tasca as $usuario_tasca): ?>
                <li><?php echo $usuario_tasca['descripcio']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>



  <div>
  <p>Pendents:  </p>
      <ul>
          <?php foreach ($tasca_progres as $usuario_tasca_2): ?>
              <li><?php echo $usuario_tasca_2['descripcio']; ?></li>
          <?php endforeach; ?>
      </ul>
  </div>
  </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Chat</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form> 
  </div>
</div>
    </div>

    <h1 id="nombre_proyecto"></h1>
    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
      El proyecto se ha actualizado.
    </div>    
    <div id="chat-container">
      <textarea id="editor" rows="10" cols="50" readonly></textarea>
    </div>



</body>

</html>
<?php
    }
      } else {
          // El usuario no tiene permisos, mostrar un mensaje de acceso denegado
          echo 'No tienes permisos';
      }