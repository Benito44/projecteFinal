$(document).ready(function(){
    var urlParams = new URLSearchParams(window.location.search);
    var proyectoId = urlParams.get('id'); // Obtener el ID del proyecto de la URL
    
    
    $.ajax({
        url: 'obtener_nombre_proyecto.php', 
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
        var content = $('#editor').val();

        $.ajax({
            url: 'guardar_en_bd.php', 
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
            url: 'guardar_dades.php',
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

    var temporitzador;
    var acabat = 1; 
    var estaEscribint = false;

    $('#editor').on('input', function(){
        clearTimeout(temporitzador);
        estaEscribint = true;
        temporitzador = setTimeout(escriure, acabat);
    });

    function escriure(){
        estaEscribint = false;
        var content = $('#editor').val();
        guardarContingut(content);
    }

    function guardarContingut(content) {
        $.ajax({
            url: 'guardar_dades.php',
            type: 'POST',
            data: {content: content, nombre_proyecto: $('#nombre_proyecto').text().trim()},
            success: function(response){
                console.log(response);
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    }

    function obtenirDades(){
        if (!estaEscribint) { // Solo obtener el contenido si no hay escritura activa
            $.ajax({
                url: 'obtenir_dades.php',
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

    setInterval(obtenirDades, 1000); // Obtener contenido cada 1 segundo
// Función para cargar los comentarios del chat para un proyecto específico
function loadChatComments(projectId) {
    $.ajax({
        url: 'chat_server.php',
        method: 'GET',
        data: { projectId: projectId }, // Pasar el ID del proyecto al servidor
        success: function(response) {
            $('#chat-messages').val(response); // Mostrar los comentarios en el textarea
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar comentarios del chat:', error);
        }
    });
}

// Función para verificar si se han enviado nuevos mensajes
function checkForNewMessages(projectId) {
    loadChatComments(projectId); // Cargar los comentarios cada vez que se verifique
}

// Obtener el ID del proyecto de alguna manera
let projectId = urlParams.get('id'); // Obtener el ID del proyecto de la URL
loadChatComments(projectId); // Cargar los comentarios del chat al cargar la página

// Verificar si se han enviado nuevos mensajes cada 5 segundos (5000 milisegundos)
setInterval(function() {
    checkForNewMessages(projectId);
}, 1000);

// Enviar comentario al hacer submit en el formulario
$('#chat-form').submit(function(event) {
    event.preventDefault();
    let message = $('#message-input').val().trim();
    if (message !== '') {
        $.ajax({
            url: 'chat_server.php',
            method: 'POST',
            data: { projectId: projectId, message: message }, // Pasar el ID del proyecto al servidor junto con el mensaje
            success: function(response) {
                loadChatComments(projectId); // Recargar comentarios después de enviar un nuevo mensaje
                $('#message-input').val(''); // Limpiar el campo de entrada
            },
            error: function(xhr, status, error) {
                console.error('Error al enviar comentario:', error);
            }
        });
    }
});
});
