
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: '../Controlador/obtener_eventos.php',
    eventClick: function(info) {
      $('#eventTitle').text(info.event.title);
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
    locale: 'es',
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
});