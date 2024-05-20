<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .dialeg {
            position: absolute;
            margin: 0;
            padding: 2rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 32.5rem;
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 8px 8px 24px 0 rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand">Gestió de Projectes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/calendari.php">Calendari</a>
                </li>
                <?php if ($es_admin): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/crear_proyecte.php">Crear Projecte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Controlador/crear_usuari.php">Crear Usuari</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Controlador/cerrar_session.php">Tancar sessió</a>
                </li>
            </ul>
        </div>
    </nav>
    <h1 class="text-center mt-5">Llista de projectes</h1>
    <div class="container mt-5">
        <div class="row">
            <?php foreach($proyectos as $proyecto): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $proyecto['nom']; ?></h5>
                            Descripció:<p class="card-text"><?php echo $proyecto['descripcio']; ?></p>
                            <button class="btn btn-primary" onclick="document.getElementById('dialog_<?php echo $proyecto['id']; ?>').showModal();">
                                <?php echo $proyecto['nom']; ?>
                            </button>
                        </div>
                    </div>
                </div>

                <dialog id="dialog_<?php echo $proyecto['id']; ?>" class="dialeg">
                    <ul>
                        <li><strong>Nom del Projecte:</strong> <?php echo $proyecto['nom']; ?></li>
                        <li><strong>Descripció del projecte:</strong> <?php echo $proyecto['descripcio']; ?></li>
                        <li><strong>Data de finalizació:</strong> <?php echo $proyecto['data_fi']; ?></li>
                        <li><strong>Usuaris amb permis:</strong>
                            <ul>
                                <?php
                                    foreach ($usuarios_proyectos as $usuario_proyecto) {
                                        if ($usuario_proyecto['id_proyecto'] == $proyecto['id']) {
                                            $usuarios_con_permisos = explode(", ", $usuario_proyecto['usuarios_con_permisos']);
                                            foreach ($usuarios_con_permisos as $usuario) {
                                                echo "<li>$usuario</li>";
                                            }
                                        }
                                    }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" onclick="showShareModal('<?php echo $proyecto['id']; ?>')">
                            Compartir Projecte
                        </button>
                        <button id="tancar_<?php echo $proyecto['id']; ?>" class="btn btn-secondary" onclick="document.getElementById('dialog_<?php echo $proyecto['id']; ?>').close();">Cerrar</button>
                        <a href="../Controlador/editor.php?id=<?php echo $proyecto['id']; ?>" class="btn btn-success">Projecte</a>
                    </div>
                </dialog>

                <!-- Modal -->
                <div class="modal fade" id="modalCompartirProyecto_<?php echo $proyecto['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Compartir Projecte</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="share-form_<?php echo $proyecto['id']; ?>" action="../Controlador/crear_proyecte.php" method="post">
                                    <div class="mb-3">
                                        <label for="nombre_proyectos_compartidos_<?php echo $proyecto['id']; ?>" class="form-label">Nom del Projecte:</label>
                                        <input type="text" id="nombre_proyectos_compartidos_<?php echo $proyecto['id']; ?>" name="nombre_proyectos_compartidos" readonly value="<?php echo $proyecto['nom']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="emails_compartidos_<?php echo $proyecto['id']; ?>" class="form-label">Correus Electronics:</label>
                                        <textarea id="emails_compartidos_<?php echo $proyecto['id']; ?>" name="emails_compartidos" rows="4" class="form-control"></textarea>
                                        <div id="emails-container_<?php echo $proyecto['id']; ?>">
                                            <label for="emails_compartidos_<?php echo $proyecto['id']; ?>" class="form-label">Correus Afegits:</label>
                                            <ul id="emails-list_<?php echo $proyecto['id']; ?>" class="list-group"></ul>
                                            <input type="hidden" id="correos-ocultos_<?php echo $proyecto['id']; ?>" name="correos_ocultos">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" id="agregar-correos_<?php echo $proyecto['id']; ?>" class="btn btn-info">Afegir Correus</button>
                                    </div>
                                    <div class="mb-3">
                                        <label for="permisos_<?php echo $proyecto['id']; ?>" class="form-label">Permissos:</label>
                                        <select id="permisos_<?php echo $proyecto['id']; ?>" name="permisos" class="form-select">
                                            <option value="editar">Editar</option>
                                            <option value="comentar">Comentar</option>
                                            <option value="visualitzar">Visualitzar</option>
                                        </select>
                                    </div>
                                    <div class="btn-center-right">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
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
</body>
</html>
