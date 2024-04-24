<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .column {
            width: 200px;
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .task {
            margin-bottom: 5px;
            padding: 5px;
            background-color: #f0f0f0;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form id="newTaskForm">
        <input type="text" id="newTaskInput" placeholder="Nueva tarea">
        <button type="submit">Crear tarea</button>
    </form>

    <div class="column" id="todo">
        <h2>Por hacer</h2>
        <div id="task1" class="task" draggable="true">Tarea 1</div>
        <div id="task2" class="task" draggable="true">Tarea 2</div>
    </div>

    <div class="column" id="progres">
        <h2>En progreso</h2>
    </div>

    <div class="column" id="revisio">
        <h2>En revisio</h2>
    </div>

    <div class="column" id="complet">
        <h2>Completadas</h2>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
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
        });    </script>
</body>
</html>
