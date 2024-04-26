<?php
include '../Model/mainfunction.php'; // Incluir el archivo de conexión a la base de datos
$connection = connexio();
if(isset($_GET['nombre_proyecto'])) {
    $nombre_proyecto = $_GET['nombre_proyecto'];

    // Realizar una consulta SQL para obtener el contenido del proyecto desde la base de datos
    $sql = "SELECT text FROM projectes WHERE nom = :nombre_proyecto";
    
    // Preparar la consulta
    $statement = $connection->prepare($sql);
    
    // Vincular parámetros
    $statement->bindParam(':nombre_proyecto', $nombre_proyecto, PDO::PARAM_STR);
    
    // Ejecutar la consulta
    $statement->execute();
    
    // Obtener el resultado
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) > 0) {
        echo $result[0]['text'];
    } else {
        // Si no se encuentra el proyecto en la base de datos, puedes mostrar un mensaje predeterminado o realizar alguna acción adicional
        echo "No se encontraron datos para el proyecto $nombre_proyecto en la base de datos.";
    }
    // Cerrar la cursor
    $statement->closeCursor();
} else {
    echo "Error: No se proporcionó el nombre del proyecto.";
}
?>
