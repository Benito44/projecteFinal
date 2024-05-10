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
    

    $('#newTaskForm').submit(function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de forma convencional
    
        // Obtener la descripción de la nueva tarea y el ID del proyecto
        let newTaskName = $("#newTaskInput").val();
        
        let urlParams = new URLSearchParams(window.location.search);
        let projectId = urlParams.get('id'); // Obtener el ID del proyecto de la URL
    
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
                    $("#Por hacer").append(newTask); // Añadir la nueva tarea al área "Por hacer"
                    // Limpiar el campo de entrada
                    $("#newTaskInput").val(""); 
    
                    // Actualizar el estado de la tarea en la base de datos
                    updateTaskStatus(response, "Por hacer");
    
                    // Agregar la siguiente línea para hacer que la tarea sea draggable después de ser creada
                    newTask.draggable({ revert: "invalid", containment: "document", helper: "clone" });
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
