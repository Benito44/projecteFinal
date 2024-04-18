<?php
include './Model/mainfunction.php';

// Código para guardar el mensaje enviado por el usuario en el servidor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    // Obtener el mensaje enviado por el usuario
    $message = $_POST['message'];

    $pdo = connexio();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si ya existe un registro con el nombre del proyecto 'DVD2'
    $checkStatement = $pdo->prepare("SELECT * FROM projectes WHERE nom = 'DVD2'");
    $checkStatement->execute();
    $existingRecord = $checkStatement->fetch(PDO::FETCH_ASSOC);

    if ($existingRecord) {
        // Si existe un registro, actualizamos el campo 'comentari' concatenando el nuevo comentario
        $existingComment = $existingRecord['comentari'];
        $updatedComment = $existingComment . "\n" . $message; // Concatenar el nuevo comentario al existente
        $updateStatement = $pdo->prepare("UPDATE projectes SET comentari = :comment WHERE nom = 'DVD2'");
        $updateStatement->bindValue(':comment', $updatedComment);
        $updateStatement->execute();

        // Verificar si la consulta de actualización fue exitosa
        if ($updateStatement->rowCount() > 0) {
            // Devolver un mensaje de éxito
            echo "Mensaje agregado exitosamente";
        } else {
            // Si la consulta falla, devolver un mensaje de error
            http_response_code(500); // Internal Server Error
            echo "Error: No se pudo agregar el mensaje a la base de datos";
        }
    } else {
        // Si no existe un registro con el nombre de proyecto 'DVD2', mostrar un mensaje de error
        http_response_code(404); // Not Found
        echo "Error: No se encontró el proyecto 'DVD2' en la base de datos";
    }
    // Obtener los mensajes actualizados del chat (simulado aquí como un array de mensajes)
    $updatedMessages = [
        "Usuario 1: Hola",
        "Usuario 2: ¡Hola! ¿Cómo estás?",
        'as',
        $message // Agregar el nuevo mensaje al array de mensajes
    ];

    // Devolver los mensajes actualizados como una cadena JSON
    echo json_encode($updatedMessages);
} else {
    // Si no se proporcionó un mensaje en la solicitud POST, devolver un mensaje de error
    http_response_code(400); // Bad Request
    echo "Error: No se proporcionó un mensaje válido";
}



?>