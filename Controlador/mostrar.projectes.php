<?php
require '../Model/mainfunction.php';

session_start(); // Iniciar sesión si aún no está iniciada

if (!isset($_SESSION['email'])) {
    header('Location: ../Vista/login.vista.php');
    exit;
}

$connexio = connexio(); 
$sql = "SELECT id, rol FROM usuaris WHERE email = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$_SESSION['email']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    header('Location: ../Vista/login.vista.php');
    exit;
}

$connexio = connexio(); 

function obtenirProjectesUsuari($connexio, $idUsuario) {
    $sql_proyectos = "SELECT p.*, GROUP_CONCAT(u.usuari SEPARATOR ', ') AS usuarios_con_permisos 
                      FROM proyecto_usuario pu 
                      INNER JOIN projectes p ON pu.id_proyecto = p.id 
                      INNER JOIN usuaris u ON pu.id_usuario = u.id 
                      WHERE pu.id_usuario = ? 
                      GROUP BY p.id";
    $statement_proyectos = $connexio->prepare($sql_proyectos);
    $statement_proyectos->execute([$idUsuario]);
    return $statement_proyectos->fetchAll(PDO::FETCH_ASSOC);
}

function obtenirUsuarisProjectes($connexio) {
    $sql_usuarios = "SELECT pu.id_proyecto, GROUP_CONCAT(CONCAT(u.usuari, ' (', u.email, ')') SEPARATOR ', ') AS usuarios_con_permisos 
                     FROM proyecto_usuario pu 
                     INNER JOIN usuaris u ON pu.id_usuario = u.id 
                     GROUP BY pu.id_proyecto";
    $statement_usuarios = $connexio->query($sql_usuarios);
    return $statement_usuarios->fetchAll(PDO::FETCH_ASSOC);
}

// Uso de las funciones
$connexio = connexio();
$idUsuarioActual = $row['id'];

$proyectos = obtenirProjectesUsuari($connexio, $idUsuarioActual);
$usuariosProyectos = obtenirUsuarisProjectes($connexio);

$es_admin = $row['rol'] === 'admin';

include '../Vista/mostrar.projectes.vista.php'; 

?>    
<script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-project').forEach(function(button) {
                button.addEventListener('click', function() {
                    const projectId = this.getAttribute('data-project-id');
                    if (confirm("¿Estàs segur de que quieres eliminar este proyecto?")) {
                        window.location.href = '../Controlador/eliminar_projecte.php?id=' + projectId;
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
                    // Cerrar el diálogo y abrir el modal de compartir proyecto
                    document.getElementById('dialog_' + projectId).close();
                    $('#modalCompartirProyecto_' + projectId).modal('show');
                    // Actualizar el campo oculto con el ID del proyecto en el formulario dentro del modal
                    const projectIdField = document.getElementById('share-form_' + projectId).querySelector('input[name="project_id"]');
                    projectIdField.value = projectId;
                });
            });


            <?php foreach($proyectos as $proyecto): ?>
            $('#agregar-correos_<?php echo $proyecto['id']; ?>').click(function() {
                let correos = $('#emails_compartidos_<?php echo $proyecto['id']; ?>').val().split('\n');
                correos.forEach(function(correo) {
                    correo = correo.trim();
                    if (validateEmail(correo)) {
                        $('#emails-list_<?php echo $proyecto['id']; ?>').append('<li>' + correo + ' <button class="btn btn-danger btn-sm" onclick="removeEmail(this)">Eliminar</button></li>');
                    } else {
                        alert('Correo inválido: ' + correo);
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

                $('#correos-ocultos').val(correos.join(','));

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
            $('#correos-ocultos').val(correos.join(','));
        }

        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    </script>

