$(document).ready(function() {
    $('#agregar-correos').click(function() {
        var correos = $('#emails_compartidos').val().split('\n');

        // Agregar correos al div y al campo oculto
        correos.forEach(function(correo) {
            correo = correo.trim();
            if (correo !== "") {
                $('#emails-list').append('<li>' + correo + '</li>');
            }
        });

        // Actualizar campo oculto con los correos
        var correosOcultos = correos.filter(function(correo) {
            return correo.trim() !== "";
        }).join(',');
        $('#correos-ocultos').val(correosOcultos);
    });

    $('#share-form').submit(function(event) {
        var correos = [];
        $('#emails-list li').each(function() {
            correos.push($(this).text());
        });

        // Almacenar los correos electrónicos en el campo oculto
        $('#correos-ocultos').val(correos.join(','));

        // Verificar si el campo de correos electrónicos está vacío
        if (correos.length === 0) {
            // Mostrar un mensaje de error o realizar alguna acción
            alert('Por favor, agregue al menos un correo electrónico.');
            event.preventDefault();
        }
    });
});


