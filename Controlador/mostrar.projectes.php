<?php
require '../Model/mainfunction.php';

session_start(); // Iniciar sesión si aún no está iniciada

if (!isset($_SESSION['email'])) {
    exit("Error: No se ha iniciado sesión");
} else {
    $connexio = connexio(); 
    $sql = "SELECT id, rol FROM usuaris WHERE email = ?";
    $statement = $connexio->prepare($sql);
    $statement->execute([$_SESSION['email']]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
}

$connexio = connexio(); 

// Consulta para obtener los proyectos del usuario actual
$sql_proyectos = "SELECT p.*, GROUP_CONCAT(u.usuari SEPARATOR ', ') AS usuarios_con_permisos 
                 FROM proyecto_usuario pu 
                 INNER JOIN projectes p ON pu.id_proyecto = p.id 
                 INNER JOIN usuaris u ON pu.id_usuario = u.id 
                 WHERE pu.id_usuario = ? 
                 GROUP BY p.id";
$statement_proyectos = $connexio->prepare($sql_proyectos);
$statement_proyectos->execute([$row['id']]);
$proyectos = $statement_proyectos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener todos los usuarios con permisos en cada proyecto
$sql_usuarios = "SELECT pu.id_proyecto, GROUP_CONCAT(u.usuari SEPARATOR ', ') AS usuarios_con_permisos 
                 FROM proyecto_usuario pu 
                 INNER JOIN usuaris u ON pu.id_usuario = u.id 
                 GROUP BY pu.id_proyecto";
$statement_usuarios = $connexio->query($sql_usuarios);
$usuarios_proyectos = $statement_usuarios->fetchAll(PDO::FETCH_ASSOC);

$es_admin = $row['rol'] === 'admin';

include '../Vista/mostrar.projectes.vista.php'; 


if (!$proyectos) {
    echo ("Error: No se encontraron proyectos para este usuario");
}
?>
    <script>
    <?php foreach($proyectos as $proyecto): ?>
      const button_<?php echo $proyecto['id']; ?> = document.getElementById('<?php echo $proyecto['id']; ?>');
      const dialog_<?php echo $proyecto['id']; ?> = document.getElementById('dialog_<?php echo $proyecto['id']; ?>');
      const tancar_<?php echo $proyecto['id']; ?> = document.getElementById('tancar_<?php echo $proyecto['id']; ?>');

      button_<?php echo $proyecto['id']; ?>.addEventListener('click', function() {
          dialog_<?php echo $proyecto['id']; ?>.showModal();
      });
      tancar_<?php echo $proyecto['id']; ?>.addEventListener('click', function() {
          dialog_<?php echo $proyecto['id']; ?>.close();
      });
    <?php endforeach; ?>
    $(document).ready(function() {
        <?php foreach($proyectos as $proyecto): ?>
        $('#agregar-correos_<?php echo $proyecto['id']; ?>').click(function() {
            var correos = $('#emails_compartidos_<?php echo $proyecto['id']; ?>').val().split('\n');

            // Agregar correos al div y al campo oculto
            correos.forEach(function(correo) {
                correo = correo.trim();
                if (correo !== "") {
                    $('#emails-list_<?php echo $proyecto['id']; ?>').append('<li>' + correo + ' <button class="btn btn-danger btn-sm" onclick="removeEmail(this)">Eliminar</button></li>');
                }
            });

            // Vaciar el textarea después de agregar los correos electrónicos
            $('#emails_compartidos_<?php echo $proyecto['id']; ?>').val('');

            // Actualizar campo oculto con los correos
            updateHiddenEmails('<?php echo $proyecto['id']; ?>');
        });

        $('#share-form_<?php echo $proyecto['id']; ?>').submit(function(event) {
            var correos = [];
            $('#emails-list_<?php echo $proyecto['id']; ?> li').each(function() {
                correos.push($(this).text().replace(' Eliminar', ''));
            });

            // Almacenar los correos electrónicos en el campo oculto
            $('#correos-ocultos_<?php echo $proyecto['id']; ?>').val(correos.join(','));

            // Verificar si el campo de correos electrónicos está vacío
            if (correos.length === 0) {
                // Mostrar un mensaje de error o realizar alguna acción
                alert('Por favor, agregue al menos un correo electrónico.');
                event.preventDefault();
            }
        });
        <?php endforeach; ?>
    });

    function showShareModal(proyectoId) {
        // Cerrar el dialog de detalles del proyecto
        document.getElementById('dialog_' + proyectoId).close();
        // Mostrar el modal de compartir proyecto
        $('#modalCompartirProyecto_' + proyectoId).modal('show');
    }

    function removeEmail(button) {
        $(button).parent().remove();
        var proyectoId = $(button).closest('ul').attr('id').split('_')[2];
        updateHiddenEmails(proyectoId);
    }

    function updateHiddenEmails(proyectoId) {
        var correos = [];
        $('#emails-list_' + proyectoId + ' li').each(function() {
            correos.push($(this).text().replace(' Eliminar', ''));
        });
        $('#correos-ocultos_' + proyectoId).val(correos.join(','));
    }
    </script>