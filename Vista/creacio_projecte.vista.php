<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="../js/crear_projecte.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .btn-center-right {
            display: flex;
            justify-content: flex-end;
        }
        .profile-image {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .profile-image img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mi Sitio Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/mostrar.projectes.php">Mostrar projectes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/crear_usuari.php">Crear usuari</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/cerrar_session.php">Tancar sessió</a>
                    </li>
                </ul>
                <div class="profile-image">
                    <?php
                    // Obtener la imagen de perfil del usuario
                    $imagen_perfil = obtenerImagenPerfil($_SESSION['email']);
                    if ($imagen_perfil) {
                        echo '<img src="' . $imagen_perfil . '" alt="Imagen de perfil">';
                    } else {
                        echo '<img src="default_profile_image.jpg" alt="Imagen de perfil por defecto">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container">
            <h2>Crear Nuevo Proyecto</h2>
            <form action="../Controlador/crear_proyecte.php" method="post" id="crearProyectoForm">
                <div class="mb-3">
                    <label for="nombre_proyecto" class="form-label">Nombre del Proyecto:</label>
                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="data_fi" class="form-label">Fecha de finalización:</label>
                    <input type="date" id="data_fi" name="data_fi" required class="form-control">
                </div>
                <div class="btn-center-right">
                    <button type="submit" class="btn btn-primary">Crear Proyecto</button>
                </div>
            </form>
            <div class="btn-center-right mt-3">

            <button type="button" class="btn btn-primary text-center ms-auto" data-toggle="modal" data-target="#modalCompartirProyecto">
        Compartir Projecte
    </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalCompartirProyecto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Compartir Projecte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                    <div class="modal-body">
                        <!-- Formulario de compartir proyecto -->
                        <form action="../Controlador/crear_proyecte.php" method="post">
                            <div class="mb-3">
                                <label for="nombre_proyectos_compartidos" class="form-label">Nom del Projecte:</label>
                                <input type="text" id="nombre_proyectos_compartidos" name="nombre_proyectos_compartidos" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="emails_compartidos" class="form-label">Correus Electronics:</label>
                                <textarea id="emails_compartidos" name="emails_compartidos" rows="4" class="form-control"></textarea>
                                <div id="emails-container">
                                    <label for="emails_compartidos" class="form-label">Correus Afegits:</label>
                                    <ul id="emails-list" class="list-group"></ul>
                                    <input type="hidden" id="correos-ocultos" name="correos_ocultos">
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="button" id="agregar-correos" class="btn btn-info">Afegir Correus</button>
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
    </div>

</body>
</html>
