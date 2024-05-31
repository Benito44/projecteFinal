<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dialeg.css">
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
    <h1 class="text-center mt-5">Llista de projectes</h1>
    <div class="container mt-5">
        <div class="row">
            <?php foreach($proyectos as $proyecto): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo $proyecto['nom']; ?></h2>
                            <p class="card-text">Descripció: <?php echo $proyecto['descripcio']; ?></p>
                            <button class="btn btn-primary open-dialog" data-project-id="<?php echo $proyecto['id']; ?>">
                               Informació
                            </button>
                            <?php if ($es_admin): ?>
                                <button class="btn btn-danger float-end delete-project" data-project-id="<?php echo $proyecto['id']; ?>">Eliminar</button>
                            <?php endif; ?>
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
                    <div class="d-flex justify-content-between">
                        <?php if ($es_admin): ?>
                            <button type="button" class="btn btn-primary share-project" data-project-id="<?php echo $proyecto['id']; ?>">
                                Compartir Projecte
                            </button>
                        <?php endif; ?>
                        <button class="btn btn-secondary close-dialog" data-project-id="<?php echo $proyecto['id']; ?>">Cerrar</button>
                        <a href="../Controlador/editor.php?id=<?php echo $proyecto['id']; ?>" class="btn btn-success">Entrar</a>
                    </div>
                </dialog>

                <!-- Modal -->
                <div class="modal fade" id="modalCompartirProyecto_<?php echo $proyecto['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Compartir Projecte</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="share-form_<?php echo $proyecto['id']; ?>" action="../Controlador/crear_proyecte.php" method="post">
                                <div class="mb-3">
                                    <label for="nombre_proyectos_compartidos" class="form-label">Nom del Projecte:</label>
                                    <input type="text" id="nombre_proyectos_compartidos" name="nombre_proyectos_compartidos" readonly value="<?php echo $proyecto['nom']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="emails_compartidos_<?php echo $proyecto['id']; ?>" class="form-label">Correus Electronics:</label>
                                    <textarea id="emails_compartidos_<?php echo $proyecto['id']; ?>" name="emails_compartidos_<?php echo $proyecto['id']; ?>" rows="4" class="form-control"></textarea>
                                    <div id="emails-container_<?php echo $proyecto['id']; ?>">
                                        <label for="correos-ocultos" class="form-label">Correus Afegits:</label>
                                        <input type="hidden" id="correos-ocultos" name="correos-ocultos">
                                        <input type="hidden" name="project_id" value="<?php echo $proyecto['id']; ?>"> <!-- Campo oculto para almacenar el ID del proyecto -->
                                        <ul id="emails-list_<?php echo $proyecto['id']; ?>" class="list-group"></ul>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="button" id="agregar-correos_<?php echo $proyecto['id']; ?>" class="btn btn-info">Afegir Correus</button>
                                </div>
                                <div class="mb-3">
                                    <label for="permisos" class="form-label">Permissos:</label>
                                    <select id="permisos" name="permisos" class="form-select">
                                        <option value="editar">Editar</option>
                                        <option value="comentar">Comentar</option>
                                        <option value="visualitzar">Visualitzar</option>
                                    </select>
                                </div>
                                <div class="btn-center-right">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
