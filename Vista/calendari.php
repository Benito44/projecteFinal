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
</head>
<body>
  <div id='calendar'></div>

  <!-- Botón para abrir el modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Agregar Evento
  </button>

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
              <label for="start">Fecha de inicio</label>
              <input type="datetime-local" class="form-control" id="start" name="start">
            </div>
            <div class="form-group">
              <label for="end">Fecha de fin</label>
              <input type="datetime-local" class="form-control" id="end" name="end">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger" id="deleteEvent">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="eventIdToDelete">
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'obtener_eventos.php',
        eventClick: function(info) {
          $('#eventTitle').text(info.event.title);
          $('#eventStart').text('Fecha de inicio: ' + info.event.start.toLocaleString());
          $('#eventEnd').text('Fecha de fin: ' + (info.event.end ? info.event.end.toLocaleString() : ''));
          
          $('#eventDetailsModal').modal('show');
          
        // Establecer el valor del campo oculto eventIdToDelete
        $('#eventIdToDelete').val(info.event.id);
        
        }
      });
      calendar.render();

      $('#saveEvent').click(function() {
      var formData = $('#eventForm').serialize(); // Obtener datos del formulario
      $.ajax({
        url: 'guardar_evento.php', 
        type: 'POST',
        data: formData,
        success: function(response) {
          console.log(response); 
          $('#exampleModal').modal('hide'); 
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText); 
        }
      });
    });
    $('#deleteEvent').click(function() {
      // Obtener el ID del evento a eliminar
      var eventId = $('#eventIdToDelete').val();

      $.ajax({
        url: 'eliminar_evento.php',
        type: 'POST',
        data: { id: eventId },
        success: function(response) {
          console.log(response);
          $('#eventDetailsModal').modal('hide');
          calendar.refetchEvents();
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    });
    });
  </script>
</body>
</html>
