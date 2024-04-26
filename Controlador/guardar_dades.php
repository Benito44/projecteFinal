<?php
if(isset($_POST['content']) && isset($_POST['nombre_proyecto'])) {
    $content = $_POST['content'];
    $nombre_proyecto = $_POST['nombre_proyecto'];

    include '../Model/mainfunction.php'; // Incluir el archivo de conexión a la base de datos

    $pdo = connexio(); // Conectar a la base de datos
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Preparar la consulta SQL
    $sql = $pdo->prepare("UPDATE projectes SET text = :content WHERE nom = :nombre_proyecto");
    $sql->bindParam(':content', $content, PDO::PARAM_STR);
    $sql->bindParam(':nombre_proyecto', $nombre_proyecto, PDO::PARAM_STR);

    // Ejecutar la consulta
    if($sql->execute()) {
        echo "Contenido guardado correctamente en la base de datos.";
    } else {
        echo "Error al guardar el contenido en la base de datos.";
    }
} else {
    echo "Error: No se proporcionó contenido o nombre de proyecto.";
}
?>

