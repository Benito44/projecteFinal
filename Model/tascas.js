$(function() {
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

    function updateTaskStatus(taskId, columnId) {
        console.log("Tarea:", taskId, "movida a la columna:", columnId);
    }


    $("#newTaskForm").submit(function(event) {
        event.preventDefault();
        var newTaskName = $("#newTaskInput").val();
        if (newTaskName.trim() !== "") {
            var newTask = $("<div class='task' draggable='true'>" + newTaskName + "</div>");
            $("#todo").append(newTask);
            $(".task").draggable({
                revert: "invalid",
                containment: "document",
                helper: "clone",
            });
            $("#newTaskInput").val(""); 
        }
    });
});    