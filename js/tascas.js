$(document).ready(function(){
    // Función para hacer que los elementos sean draggable
    function makeTaskDraggable(task) {
        task.draggable({
            revert: "invalid",
            containment: "document",
            helper: "clone",
        });
    }

    $(".task").each(function() {
        makeTaskDraggable($(this));
    });

    $(".column").droppable({
        accept: ".task",
        drop: function(event, ui) {
            var draggable = ui.draggable;
            var droppable = $(this);

            draggable.detach().appendTo(droppable);

            updateTaskStatus(draggable.attr("id"), droppable.attr("id"));
        }
    });

    function updateTaskStatus(taskId, newState) {
        $.ajax({
            url: '../Controlador/actualizar_tarea.php',
            method: 'POST',
            data: { taskId: taskId, newState: newState }, // Pasar el nuevo estado de la tarea
            success: function(response) {
                console.log("Tarea actualizada exitosamente:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error al actualizar la tarea:", error);
            }
        });
    }
    $(document).on('click', '.deleteTaskBtn', function() {
        let taskId = $(this).data('task-id');
    
        // Envía una solicitud AJAX para eliminar la tarea
        $.ajax({
            url: '../Controlador/eliminar_tarea.php',
            method: 'POST',
            data: { taskId: taskId },
            success: function(response) {
                console.log("Tarea eliminada exitosamente:", response);
                // Recargar la página para reflejar los cambios
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error("Error al eliminar la tarea:", taskId);
            }
        });
    });
    
    $('#newTaskForm').submit(function(event) {
        event.preventDefault();
        let newTaskName = $("#newTaskInput").val();
        
        let urlParams = new URLSearchParams(window.location.search);
        let projectId = urlParams.get('id');

        if (newTaskName.trim() !== "") {
            // Enviar una solicitud AJAX para insertar la tarea en la base de datos
            $.ajax({
                url: '../Controlador/crear_tarea.php',
                method: 'POST',
                data: { taskName: newTaskName, projectId: projectId },
                success: function(response) {
                    console.log("Nueva tarea creada exitosamente con ID:", response);
                    location.reload(); // Recargar la página para reflejar los cambios
                },
                error: function(xhr, status, error) {
                    console.error("Error al crear la nueva tarea:", error);
                }
            });
        } else {
            // Mostrar un mensaje de error si la descripción está vacía
            alert("Por favor ingrese una descripción para la tarea.");
        }
    });
});
