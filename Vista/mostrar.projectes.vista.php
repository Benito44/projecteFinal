<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
          </li>
          <?php if ($es_admin): ?>
            <li class="nav-item">
              <a class="nav-link" href="../Controlador/crear_proyecte.php">Crear Projecte</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../Controlador/crear_usuari.php">Crear Usuari</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Controlador/cerrar_session.php">Tancar sessió</a>
          </li>
        </ul>
      </div>
    </nav>
    <h1 class="text-center mt-5">Llista de projectes</h1>
    <div class="container mt-5">
        <div class="row">
        <?php foreach($proyectos as $proyecto): ?>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $proyecto['nom']; ?></h5>
                Descripció:<p class="card-text"><?php echo $proyecto['descripcio']; ?></p>
                <button class="btn btn-primary" id="<?php echo $proyecto['id']; ?>">
                    <?php echo $proyecto['nom']; ?>
                </button>
            </div>
        </div>
    </div>
    <dialog id="dialog_<?php echo $proyecto['id']; ?>" class="dialeg">
        <ul>
            <li><strong>Nom del Projecte:</strong> <?php echo $proyecto['nom']; ?></li>
            <li><strong>Descripció del projecte:</strong> <?php echo $proyecto['descripcio']; ?></li>
            <li><strong>Data de finalizació:</strong> <?php echo $proyecto['data_fi']; ?></li>
            <li><strong>Usuaris amb permis:</strong>
                <ul>
                    <?php
                        // Obtener los nombres de los usuarios con permiso en el proyecto actual
                        foreach ($usuarios_proyectos as $usuario_proyecto) {
                            if ($usuario_proyecto['id_proyecto'] == $proyecto['id']) {
                                $usuarios_con_permisos = explode(", ", $usuario_proyecto['usuarios_con_permisos']);
                                foreach ($usuarios_con_permisos as $usuario) {
                                    echo "<li>$usuario</li>";
                                }
                            }
                        }
                    ?>
                </ul>
            </li>
        </ul>
        <button id="tancar_<?php echo $proyecto['id']; ?>">Cerrar</button>
        <a href="../Controlador/editor.php?id=<?php echo $proyecto['id']; ?>">Projecte</a>
    </dialog>
<?php endforeach; ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>