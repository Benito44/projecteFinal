<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario de Eventos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../js/calendari.js"></script>
  <link rel="stylesheet" href="../css/calendari.css">

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
            <a class="nav-link" href="../Controlador/mostrar.projectes.php">Projectes Propis</a>
          </li>
          <?php if ($es_admin): ?>
            <li class="nav-item">
              <a class="nav-link" href="../Controlador/crear_proyecte.php">Crear Proyecto</a>
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

      <div id='calendar'>      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Afegir Event
      </button>
      </div>



  <!-- Modal para ingresar nuevo evento -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Formulario para agregar evento -->
          <form id="eventForm">
            <div class="form-group">
              <label for="title">Título</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
              <label for="desc">Descripcio:</label>
              <input type="text" name="desc" id="desc"><br>
            </div>
            <div class="form-group">
              <label for="start">Data d'inici</label>
              <input type="datetime-local" class="form-control" id="start" name="start">
            </div>
            <div class="form-group">
              <label for="end">Data final</label>
              <input type="datetime-local" class="form-control" id="end" name="end">
            </div>
            <div class="form-group">
              <label for="color">Color: </label>
              <input type="color" name="color" id="color" required><br>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveEvent">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para mostrar los detalles del evento y el botón de eliminar -->
  <div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="eventStart"></p>
        <p id="eventEnd"></p>
        <div id="eventDescContainer">
          <p id="eventDesc"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="deleteEvent">Eliminar</button>
        <button type="button" class="btn btn-primary" id="modificarEvent">Modificar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para modificar evento -->
<div class="modal fade" id="modifyEventModal" tabindex="-1" role="dialog" aria-labelledby="modifyEventModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifyEventModalLabel">Modificar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para modificar evento -->
        <form id="modifyEventForm">
          <input type="hidden" id="modifyEventId" name="eventId">
          <div class="form-group">
            <label for="modifyTitle">Título</label>
            <input type="text" class="form-control" id="modifyTitle" name="title">
          </div>
          <div class="form-group">
            <label for="modifyDesc">Descripcio:</label>
            <input type="text" name="desc" id="modifyDesc"><br>
          </div>
          <div class="form-group">
            <label for="modifyStart">Data d'inici</label>
            <input type="datetime-local" class="form-control" id="modifyStart" name="start">
          </div>
          <div class="form-group">
            <label for="modifyEnd">Data final</label>
            <input type="datetime-local" class="form-control" id="modifyEnd" name="end">
          </div>
          <div class="form-group">
            <label for="modifyColor">Color: </label>
            <input type="color" name="color" id="modifyColor" required><br>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="saveModifiedEvent">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

  <input type="hidden" id="eventIdToDelete">
</body>
</html>
