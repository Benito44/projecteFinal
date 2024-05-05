<?php
include '../Model/mainfunction.php';

try {
    $pdo = connexio();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $content = $_POST['content'];
    $nombre_proyecto = $_POST['nombre_proyecto'];
    echo $content;
    // Actualizamos el contenido de la base de datos 
    $statement = $pdo->prepare("UPDATE projectes SET text = :content WHERE nom = :nombre_proyecto");
    $statement->bindParam(':content', $content);
    $statement->bindParam(':nombre_proyecto', $nombre_proyecto);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        echo 'Contenido actualizado exitosamente en la base de datos para el proyecto: ' . $nombre_proyecto;
    } else {
        echo 'No se encontró ningún proyecto con el nombre: ' . $nombre_proyecto;
    }
} catch(PDOException $e) {
    echo 'Error al actualizar el contenido en la base de datos: ' . $e->getMessage();
}
?>
