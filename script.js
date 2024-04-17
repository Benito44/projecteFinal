$(document).ready(function(){
        // Obtener el parámetro 'proyecto' de la URL
        var urlParams = new URLSearchParams(window.location.search);
        var proyectoId = urlParams.get('id'); // Obtener el ID del proyecto de la URL
        
        // Realizar una solicitud AJAX para obtener el nombre del proyecto
        $.ajax({
            url: 'obtener_nombre_proyecto.php', // Ruta al archivo PHP que obtiene el nombre del proyecto
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
        // Evita que el formulario se envíe de forma predeterminada
        event.preventDefault();

        // Obtiene el contenido del textarea
        var content = $('#editor').val();

        // Envía los datos al servidor usando AJAX
        $.ajax({
            url: 'guardar_en_bd.php', // Ruta al script PHP que manejará la inserción en la base de datos
            method: 'POST',
            data: { content: content }, // Datos que se enviarán al servidor
            success: function(response) {
                alert('Contenido guardado exitosamente en la base de datos.');
            },
            error: function(xhr, status, error) {
                alert('Error al guardar el contenido en la base de datos.');
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
            data: {content: content},
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
});
