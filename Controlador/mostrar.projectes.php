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
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-project').forEach(function(button) {
                button.addEventListener('click', function() {
                    const projectId = this.getAttribute('data-project-id');
                    if (confirm("¿Estás seguro de que quieres eliminar este proyecto?")) {
                        window.location.href = '../Controlador/eliminar_proyecto.php?id=' + projectId;
                    }
                });
            });

            document.querySelectorAll('.open-dialog').forEach(function(button) {
                button.addEventListener('click', function() {
                    const projectId = this.getAttribute('data-project-id');
                    document.getElementById('dialog_' + projectId).showModal();
                });
            });

            document.querySelectorAll('.close-dialog').forEach(function(button) {
                button.addEventListener('click', function() {
                    const projectId = this.getAttribute('data-project-id');
                    document.getElementById('dialog_' + projectId).close();
                });
            });

            document.querySelectorAll('.share-project').forEach(function(button) {
                button.addEventListener('click', function() {
                    const projectId = this.getAttribute('data-project-id');
                    document.getElementById('dialog_' + projectId).close();
                    $('#modalCompartirProyecto_' + projectId).modal('show');
                });
            });

            <?php foreach($proyectos as $proyecto): ?>
            $('#agregar-correos_<?php echo $proyecto['id']; ?>').click(function() {
                let correos = $('#emails_compartidos_<?php echo $proyecto['id']; ?>').val().split('\n');

                correos.forEach(function(correo) {
                    correo = correo.trim();
                    if (correo !== "") {
                        $('#emails-list_<?php echo $proyecto['id']; ?>').append('<li>' + correo + ' <button class="btn btn-danger btn-sm" onclick="removeEmail(this)">Eliminar</button></li>');
                    }
                });

                $('#emails_compartidos_<?php echo $proyecto['id']; ?>').val('');

                updateHiddenEmails('<?php echo $proyecto['id']; ?>');
            });

            $('#share-form_<?php echo $proyecto['id']; ?>').submit(function(event) {
                let correos = [];
                $('#emails-list_<?php echo $proyecto['id']; ?> li').each(function() {
                    correos.push($(this).text().replace(' Eliminar', ''));
                });

                $('#correos-ocultos_<?php echo $proyecto['id']; ?>').val(correos.join(','));

                if (correos.length === 0) {
                    alert('Por favor, agregue al menos un correo electrónico.');
                    event.preventDefault();
                }
            });
            <?php endforeach; ?>
        });

        function removeEmail(button) {
            $(button).parent().remove();
            let proyectoId = $(button).closest('ul').attr('id').split('_')[2];
            updateHiddenEmails(proyectoId);
        }

        function updateHiddenEmails(proyectoId) {
            let correos = [];
            $('#emails-list_' + proyectoId + ' li').each(function() {
                correos.push($(this).text().replace(' Eliminar', ''));
            });
            $('#correos-ocultos_' + proyectoId).val(correos.join(','));
        }
    </script>