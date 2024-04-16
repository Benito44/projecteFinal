<?php
// Establece la conexión con la base de datos (reemplaza estos valores con los tuyos)
$dsn = 'mysql:host=localhost;dbname=projecte';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $content = $_POST['content'];
    $nombre = 'asd';

    // Prepara la consulta para actualizar el contenido en la base de datos basado en el nombre
    $statement = $pdo->prepare("UPDATE projectes SET text = :content WHERE nom = :nombre");
    $statement->bindParam(':content', $content);
    $statement->bindParam(':nombre', $nombre);
    $statement->execute();

    // Verifica si se realizó una actualización
    if ($statement->rowCount() > 0) {
        // Envía una respuesta de éxito al cliente
        echo 'Contenido actualizado exitosamente en la base de datos para el nombre: ' . $nombre;
    } else {
        // Envía un mensaje de error si no se encontró el nombre en la base de datos
        echo 'No se encontró ningún registro con el nombre: ' . $nombre;
    }
} catch(PDOException $e) {
    // En caso de error, envía un mensaje de error al cliente
    echo 'Error al actualizar el contenido en la base de datos: ' . $e->getMessage();
}
?>