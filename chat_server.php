<?php
session_start(); // Inicia la sesión para almacenar el array de mensajes
include './Model/mainfunction.php';

// Función para inicializar el array de mensajes si no existe
function initMessagesArray() {
    if (!isset($_SESSION['chat_messages'])) {
        $_SESSION['chat_messages'] = [];
    }
}

// Función para agregar un mensaje al array de mensajes
function addMessage($message) {
    array_push($_SESSION['chat_messages'], $message);
}

// Función para obtener el array de mensajes
function getMessages() {
    return $_SESSION['chat_messages'];
}

// Si se recibe un mensaje a través de POST, agrégalo al array de mensajes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    initMessagesArray();
    $message = $_POST['message'];
    addMessage($message);

    // Obtener el ID del proyecto desde el formulario
    $projectId = $_POST['proyectoId'];

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
}

// Devuelve el array de mensajes como JSON
echo json_encode(getMessages());
?>
