document.addEventListener('DOMContentLoaded', function() {
  let calendarEl = document.getElementById('calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: '../Controlador/obtener_eventos.php',
    eventClick: function(info) {
      $('#eventTitle').text(info.event.title);
      $('#eventDesc').text('Descripció: ' + info.event.extendedProps.desc);
      $('#eventStart').text('Fecha de inicio: ' + info.event.start.toLocaleString());
      $('#eventEnd').text('Fecha de fin: ' + (info.event.end ? info.event.end.toLocaleString() : ''));
      
      $('#eventDetailsModal').modal('show');
      
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
    let formData = $('#eventForm').serialize();
    $.ajax({
      url: '../Controlador/guardar_evento.php',
      type: 'POST',
      data: formData,
      success: function(response) {
        console.log(response);
        $('#exampleModal').modal('hide');
        calendar.refetchEvents();
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });

  $('#deleteEvent').click(function() {
    let eventId = $('#eventIdToDelete').val();
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
    let eventId = $('#eventIdToDelete').val();
    let event = calendar.getEventById(eventId);

    $('#modifyEventId').val(event.id);
    $('#modifyTitle').val(event.title);
    $('#modifyDesc').val(event.extendedProps.desc);
    let localStart = new Date(event.start.getTime() - (event.start.getTimezoneOffset() * 60000)).toISOString().slice(0, 16);
    $('#modifyStart').val(localStart);

    let localEnd = event.end ? new Date(event.end.getTime() - (event.end.getTimezoneOffset() * 60000)).toISOString().slice(0, 16) : '';
    $('#modifyEnd').val(localEnd);

    $('#modifyColor').val(event.backgroundColor);

    $('#eventDetailsModal').modal('hide');
    $('#modifyEventModal').modal('show');
  });

  $('#saveModifiedEvent').click(function() {
    let eventId = $('#modifyEventId').val();
    let title = $('#modifyTitle').val();
    let desc = $('#modifyDesc').val();
    let start = $('#modifyStart').val();
    let end = $('#modifyEnd').val();
    let color = $('#modifyColor').val();

    $.ajax({
      url: '../Controlador/modificar_event.php',
      method: 'POST',
      data: {
        modifyEventId: eventId,
        modifyTitle: title,
        modifyDesc: desc,
        modifyStart: start,
        modifyEnd: end,
        modifyColor: color
      },
      success: function(response) {
        if (response.success) {
          let event = calendar.getEventById(eventId);
          event.setProp('title', title);
          event.setStart(start);
          event.setEnd(end);
          event.setExtendedProp('desc', desc);
          event.setProp('backgroundColor', color);
          $('#modifyEventModal').modal('hide');
          alert('Evento modificado exitosamente.');
        } else {
          alert('Error al modificar el evento: ' + response.message);
        }
      },
      error: function(xhr, status, error) {
        alert('Error al modificar el evento: ' + xhr.responseText);
      }
    });
  });
});