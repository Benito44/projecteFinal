$(document).ready(function(){
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
