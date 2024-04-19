<?php
include './Model/mainfunction.php';

// Función para obtener los comentarios de un proyecto específico desde la base de datos
function getProjectComments($projectId) {
    try {
        $pdo = connexio(); // Conectar a la base de datos
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener los comentarios del proyecto desde la base de datos
        $commentQuery = $pdo->prepare("SELECT comentari FROM projectes WHERE id = :project_id");
        $commentQuery->bindParam(':project_id', $projectId);
        $commentQuery->execute();
        $commentResult = $commentQuery->fetch(PDO::FETCH_ASSOC);

        return $commentResult['comentari']; // Devolver los comentarios del proyecto
    } catch(PDOException $e) {
        return "Error al obtener comentarios: " . $e->getMessage();
    } finally {
        // Cerrar la conexión PDO
        $pdo = null;
    }
}

// Si se recibe un ID de proyecto a través de GET, cargar los comentarios de ese proyecto
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['projectId'])) {
    // Obtener el ID del proyecto desde la solicitud
    $projectId = $_GET['projectId'];
    // Obtener los comentarios del proyecto y devolverlos como respuesta
    echo getProjectComments($projectId);
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['projectId'])) {
    // Si se recibe un mensaje y un ID de proyecto a través de POST, agregar el comentario a la base de datos
    $projectId = $_POST['projectId'];
    $message = $_POST['message'];

    try {
        $pdo = connexio(); // Conectar a la base de datos
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener el comentario actual del proyecto
        $existingCommentQuery = $pdo->prepare("SELECT comentari FROM projectes WHERE id = :project_id");
        $existingCommentQuery->bindParam(':project_id', $projectId);
        $existingCommentQuery->execute();
        $existingCommentResult = $existingCommentQuery->fetch(PDO::FETCH_ASSOC);
        $existingComment = $existingCommentResult['comentari'];

        // Concatenar el nuevo comentario al existente (con un salto de línea)
        $updatedComment = $existingComment . "\n" . $message;

        // Actualizar el campo de comentarios en la tabla de proyectos
        $updateStatement = $pdo->prepare("UPDATE projectes SET comentari = :comment WHERE id = :project_id");
        $updateStatement->bindParam(':comment', $updatedComment);
        $updateStatement->bindParam(':project_id', $projectId);
        $updateStatement->execute();

        echo "Comentario agregado correctamente al proyecto con ID: $projectId";
    } catch(PDOException $e) {
        echo "Error al agregar comentario: " . $e->getMessage();
    }

    // Cerrar la conexión PDO
    $pdo = null;
} else {
    // Si no se recibe un ID de proyecto válido o un mensaje válido, devolver un mensaje de error
    echo "ID de proyecto o mensaje no válido.";
}
?>
