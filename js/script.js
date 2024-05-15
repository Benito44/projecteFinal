$(document).ready(function(){
    
    
    let urlParams = new URLSearchParams(window.location.search);
    let proyectoId = urlParams.get('id'); // Obtener el ID del proyecto de la URL
    
    
    $.ajax({
        url: '../Controlador/obtener_nombre_proyecto.php', 
        method: 'GET',
        data: { id: proyectoId }, // Pasar el ID del proyecto como parámetro
        success: function(response) {
            // Actualizar el contenido del elemento #nombre_proyecto con el nombre del proyecto obtenido
            $('#nombre_proyecto').text(response);
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener el nombre del proyecto:', error);
        }
    });

    
    $('#editorForm').submit(function(event) {
       
        event.preventDefault();
        let content = $('#editor').val();

        $.ajax({
            url: '../Controlador/guardar_en_bd.php', 
            method: 'POST',
            data: { content: content, nombre_proyecto: $('#nombre_proyecto').text().trim() }, // Le pasamos el contenido y el nombre del proyecto
            success: function(response) {
                alert('Contenido guardado exitosamente en la base de datos.');
            },
            error: function(xhr, status, error) {
                alert('Error al guardar el contenido en la base de datos.');
                console.error(xhr, status, error);
            }
        });

        $.ajax({
            url: '../Controlador/guardar_dades.php',
            method: 'POST',
            data: { content: content, nombre_proyecto: $('#nombre_proyecto').text().trim() }, // Le pasamos el contenido y el nombre del proyecto
            success: function(response) {
                alert('Contenido guardado exitosamente en el archivo del proyecto.');
            },
            error: function(xhr, status, error) {
                alert('Error al guardar el contenido en el archivo del proyecto.');
                console.error(xhr, status, error);
            }
        });
    });

    let temporitzador;
    let acabat = 1; 
    let estaEscribint = false;

    let timeout; // Variable para almacenar el temporizador

    $('#editor').on('input', function(){
        clearTimeout(timeout); // Limpiar el temporizador cada vez que se detecte un evento de entrada
        estaEscribint = true;
        timeout = setTimeout(escribir, 1000); // Establecer un temporizador para llamar a la función escribir() después de 1 segundo de inactividad
    });

    function toggleDropdown() {
        var dropdown = document.getElementById("tareasDropdown");
        if (dropdown.style.display === "none") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    }

    function escribir(){
        estaEscribint = false;
        let content = $('#editor').val();
        console.log(content);
        console.log($('#nombre_proyecto').text().trim());
        guardarContingut(content); // Llamar a la función para guardar el contenido
    }

    function guardarContingut(content) {
        $.ajax({
            url: '../Controlador/guardar_dades.php',
            type: 'POST',
            data: {content: content, nombre_proyecto: $('#nombre_proyecto').text().trim()},
            success: function(response){
                console.log(response);
                // Después de realizar la actualización del proyecto, mostrar el mensaje de actualización
$('#actualizacion').show();

// Ocultar el mensaje de actualización después de 3 segundos (3000 milisegundos)
setTimeout(function() {
  $('#actualizacion').hide();
}, 3000);

            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    }

    function obtenirDades(){
        if (!estaEscribint) { // Solo obtener el contenido si no hay escritura activa
            $.ajax({
                url: '../Controlador/obtenir_dades.php',
                type: 'GET',
                data: {nombre_proyecto: $('#nombre_proyecto').text().trim()},
                success: function(response){
                    $('#editor').val(response);
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        }
    }

    setInterval(obtenirDades, 1000); 
    
// Función para cargar los comentarios del chat para un proyecto específico
function loadChatComments(projectId) {
    $.ajax({
        url: '../Controlador/chat_server.php',
        method: 'GET',
        data: { projectId: projectId }, // Pasar el ID del proyecto al servidor
        success: function(response) {
            $('#chat-messages').val(response);
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar comentarios del chat:', error);
        }
    });
}

function checkForNewMessages(projectId) {
    loadChatComments(projectId); 
}

let projectId = urlParams.get('id'); 
loadChatComments(projectId); 

setInterval(function() {
    checkForNewMessages(projectId);
}, 1000);

$('#chat-form').submit(function(event) {
    event.preventDefault();
    let message = $('#message-input').val().trim();
    if (message !== '') {
        $.ajax({
            url: '../Controlador/chat_server.php',
            method: 'POST',
            data: { projectId: projectId, message: message }, // Pasar el ID del proyecto al servidor junto con el mensaje
            success: function(response) {
                loadChatComments(projectId); 
                $('#message-input').val(''); 
                            // Enfocar el último mensaje recibido
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
            },
            error: function(xhr, status, error) {
                console.error('Error al enviar comentario:', error);
            }
        });
    }
});

});
