$(document).ready(function(){
    $(".task").draggable({
        revert: "invalid",
        containment: "document",
        helper: "clone",
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
            url: 'actualizar_tarea.php',
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
    

    $('#newTaskForm').submit(function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de forma convencional

        // Obtener la descripción de la nueva tarea y el ID del proyecto
        var newTaskName = $("#newTaskInput").val();
        var projectId = 31; // Obtener el ID del proyecto de la URL

        // Verificar que la descripción no esté vacía
        if (newTaskName.trim() !== "") {
            // Enviar una solicitud AJAX para insertar la tarea en la base de datos
            $.ajax({
                url: '../Controlador/crear_tarea.php',
                method: 'POST',
                data: { taskName: newTaskName, projectId: projectId },
                success: function(response) {
                    // Tarea creada exitosamente
                    console.log("Nueva tarea creada exitosamente con ID:", response);
                    // Actualizar la interfaz de usuario si es necesario
                    var newTask = $("<div class='task' draggable='true' id='" + response + "'>" + newTaskName + "</div>");
                    $("#todo").append(newTask);
                    // Limpiar el campo de entrada
                    $("#newTaskInput").val(""); 
                },
                error: function(xhr, status, error) {
                    // Error al crear la tarea
                    console.error("Error al crear la nueva tarea:", error);
                }
            });
        } else {
            // Mostrar un mensaje de error si la descripción está vacía
            alert("Por favor ingrese una descripción para la tarea.");
        }
    });
});
