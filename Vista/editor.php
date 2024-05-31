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
<?php
if ($row) {
    if ($row['permissos'] === 'editar') {
?>

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
                    <a class="nav-link" href="../Vista/tascas.php?id=<?php echo $proyectoId; ?>">Tasques</a>
                </li>
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

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tasques pendents</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php if ($es_admin): ?>
    <p>En revisió:</p>
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
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Comentaris</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="chat-container">
      <label for="comentaris">Comentaris</label>
      <textarea id="comentaris" name="comentaris" rows="10" cols="50" readonly></textarea>
    </div>
    <form id="chat-form">
      <label for="enviar_missatge">Enviar Missatge</label>
      <input type="text" id="enviar_missatge" name="enviar_missatge" placeholder="Escribe un mensaje...">
      <button type="submit">Enviar</button>
    </form> 
  </div>
</div>

<div class="title-container">
    <h1 id="nombre_proyecto">Nombre del Proyecto</h1>
    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
        El projecte s'ha actualitzat
    </div>
</div>
<div class="buttons-container d-flex justify-content-center">
  <button class="btn btn-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Tasques pendents</button>
  <button class="btn btn-primary ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Chat</button>
</div>


<div id="chat-container">
  <label for="editor">Contingut Editable</label>
  <textarea id="editor" name="editor" rows="10" cols="50" title="Contingut editable del projecte"></textarea>
</div>
</body>
</html>

<?php
    } elseif($row['permissos'] === 'visualitzar'){
        ?>
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
                    <a class="nav-link" href="../Vista/tascas.php?id=<?php echo $proyectoId; ?>">Tasques</a>
                </li>
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

<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tasques pendents</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php if ($es_admin): ?>
    <p>En revisió:</p>
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
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Comentaris</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div id="chat-container">
      <label for="comentaris">Comentaris</label>
      <textarea id="comentaris" name="comentaris" rows="10" cols="50" readonly></textarea>
    </div>
    <form id="chat-form">
      <label for="enviar_missatge">Enviar Missatge</label>
      <input type="text" id="enviar_missatge" name="enviar_missatge" placeholder="Escribe un mensaje..." readonly>
      <button type="submit">Enviar</button>
    </form> 
  </div>
</div>

<div class="title-container">
    <h1 id="nombre_proyecto">Nombre del Proyecto</h1>
    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
        El projecte s'ha actualitzat
    </div>
</div>
<div class="buttons-container d-flex justify-content-center">
  <button class="btn btn-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Tasques pendents</button>
  <button class="btn btn-primary ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Chat</button>
</div>


<div id="chat-container">
<label for="editor">Contingut No Editable</label>
  <textarea id="editor" name="editor" rows="10" cols="50" title="Contingut editable del projecte" readonly></textarea>
</div>
</body>
</html>

<?php
    } elseif($row['permissos'] === 'comentar'){
        ?>
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
                    <a class="nav-link" href="../Vista/tascas.php?id=<?php echo $proyectoId; ?>">Tasques</a>
                </li>
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


<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Tasques pendents</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <?php if ($es_admin): ?>
    <p>En revisió:</p>
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
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Comentaris</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <div id="chat-container">
      <label for="comentaris">Comentaris</label>
      <textarea id="comentaris" name="comentaris" rows="10" cols="50" readonly></textarea>
    </div>
    <form id="chat-form">
      <label for="enviar_missatge">Enviar Missatge</label>
      <input type="text" id="enviar_missatge" name="enviar_missatge" placeholder="Escribe un mensaje...">
      <button type="submit">Enviar</button>
    </form> 
  </div>
</div>

<div class="title-container">
    <h1 id="nombre_proyecto">Nombre del Proyecto</h1>
    <div id="actualizacion" style="display: none;" class="alert alert-success" role="alert">
        El projecte s'ha actualitzat
    </div>
</div>
<div class="buttons-container d-flex justify-content-center">
  <button class="btn btn-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Tasques pendents</button>
  <button class="btn btn-primary ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Chat</button>
</div>


<div id="chat-container">
<label for="editor">Contingut No Editable</label>
  <textarea id="editor" name="editor" rows="10" cols="50" title="Contingut editable del projecte" readonly></textarea>
</div>
</body>
</html>
<?php
    }
      } else {
          header('Location: ../Controlador/mostrar.projectes.php');
      }