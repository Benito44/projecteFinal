<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
        body {
            font-family: Arial, sans-serif;
            align-items: center;
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
        /* CSS */
        #crearProyectoForm {
            margin: 0 auto; /* Centrar el formulario horizontalmente */
            max-width: 500px; /* Definir el ancho máximo del formulario */
            padding: 20px; /* Agregar espacio alrededor del formulario */
            border: 1px solid #ccc; /* Agregar un borde alrededor del formulario */
            border-radius: 10px; /* Agregar esquinas redondeadas al formulario */
        }

        .full-width {
            width: 100%;
        }
        button {
            align-items: center;
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
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/mostrar.projectes.php" >Mostrar projectes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/calendari.php" >Calendari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/crear_usuari.php">Crear usuari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
                </li>´
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
    <div class="container">
        <h2>Crear Nuevo Proyecto</h2>
        
        <form action="../Controlador/crear_proyecte.php" method="post" id="crearProyectoForm">
            <label for="nombre_proyecto">Nombre del Proyecto:</label><br>
            <input type="text" id="nombre_proyecto" name="nombre_proyecto" required class="form-control"><br>
            
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" required class="form-control"></textarea><br>
            
            <label for="data_fi">Fecha de finalización:</label><br>
            <input type="date" id="data_fi" name="data_fi" required class="form-control"><br>

            <button type="submit" class="btn btn-primary">Crear Proyecto</button>
        </form>
        <div class="d-flex justify-content-between">
    <div></div> <!-- Este div vacío es usa para ocupar el espacio antes del botón -->
    <button type="button" class="btn btn-primary text-center ms-auto" data-toggle="modal" data-target="#modalCompartirProyecto">
        Compartir Proyecto
    </button>
</div>



    </div>

        <!-- Modal -->
        <div class="modal fade" id="modalCompartirProyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Compartir Proyecto</h5>
                  </div>
                  <div class="modal-body">
                      <!-- Formulario de compartir proyecto -->
                      <div class="container">
                          <form action="../Controlador/crear_proyecte.php" method="post">
                              <label for="nombre_proyectos_compartidos">Nombre del Proyecto:</label><br>
                              <input type="text" id="nombre_proyectos_compartidos" name="nombre_proyectos_compartidos" required><br><br>
                          
                              <div id="emails-container">
                                  <p>Correos añadidos:</p>
                                  <ul id="emails-list"></ul>
                                  <input type="hidden" id="correos-ocultos" name="correos_ocultos">
                              </div>
                          
                              <label for="emails_compartidos">Correos Electrónicos:</label><br>
                              <textarea id="emails_compartidos" name="emails_compartidos" rows="4"></textarea><br><br>
                          
                              <button type="button" id="agregar-correos">Agregar Correos</button><br><br>
                          
                              <label for="permisos">Permisos:</label>
                              <select id="permisos" name="permisos">
                                  <option value="editar">Editar</option>
                                  <option value="comentar">Comentar</option>
                                  <option value="visualitzar">Visualitzar</option>
                              </select><br><br>
                          
                              <button type="submit">Enviar Correos</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/crear_projecte.js"></script>
</body>
</html>
