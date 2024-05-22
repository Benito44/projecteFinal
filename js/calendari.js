
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: '../Controlador/obtener_eventos.php',
    eventClick: function(info) {
      $('#eventTitle').text(info.event.title);
      $('#eventDesc').text('Descripció: ' + info.event.extendedProps.desc);
      $('#eventStart').text('Fecha de inicio: ' + info.event.start.toLocaleString());
      $('#eventEnd').text('Fecha de fin: ' + (info.event.end ? info.event.end.toLocaleString() : ''));
      
      $('#eventDetailsModal').modal('show');
      
    // Establecer el valor del campo oculto eventIdToDelete
    $('#eventIdToDelete').val(info.event.id);
    
    },
    headerToolbar: {
      left: 'prev,today,next',
      center: 'title',
      right: 'dayGridDay,dayGridMonth,dayGridWeek,dayGridYear'
    },
    locale: 'es'
  });
  calendar.render();

  $('#saveEvent').click(function() {
    var formData = $('#eventForm').serialize(); // Obtener datos del formulario
    $.ajax({
      url: '../Controlador/guardar_evento.php', 
      type: 'POST',
      data: formData,
      success: function(response) {
        console.log(response); 
        $('#exampleModal').modal('hide'); 
  
        // Después de guardar el evento, recargar los eventos en el calendario
        calendar.refetchEvents();
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
    url: '../Controlador/eliminar_evento.php',
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

$('#modificarEvent').click(function() {
    var eventId = $('#eventIdToDelete').val();
    var event = calendar.getEventById(eventId);

    $('#modifyEventId').val(event.id);
    $('#modifyTitle').val(event.title);
    $('#modifyDesc').val(event.extendedProps.desc);
    $('#modifyStart').val(event.start.toISOString().slice(0, 16));
    $('#modifyEnd').val(event.end ? event.end.toISOString().slice(0, 16) : '');
    $('#modifyColor').val(event.backgroundColor);

    $('#eventDetailsModal').modal('hide');
    $('#modifyEventModal').modal('show');
});

// Guardar los cambios del evento modificado
$('#saveModifiedEvent').click(function() {
    var eventId = $('#modifyEventId').val();
    var title = $('#modifyTitle').val();
    var desc = $('#modifyDesc').val();
    var start = $('#modifyStart').val();
    var end = $('#modifyEnd').val();
    var color = $('#modifyColor').val();

    $.ajax({
        url: '/path/to/update/event', // URL para actualizar el evento
        method: 'POST',
        data: {
            eventId: eventId,
            title: title,
            desc: desc,
            start: start,
            end: end,
            color: color
        },
        success: function(response) {
            if (response.success) {
                var event = calendar.getEventById(eventId);
                event.setProp('title', title);
                event.setStart(start);
                event.setEnd(end);
                event.setExtendedProp('desc', desc);
                event.setProp('backgroundColor', color);
                event.setProp('borderColor', color);

                $('#modifyEventModal').modal('hide');
                alert('Evento modificado exitosamente.');
            } else {
                alert('Error al modificar el evento.');
            }
        },
        error: function() {
            alert('Error al modificar el evento.');
        }
    });
});







});