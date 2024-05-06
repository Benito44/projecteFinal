<?php
// Check if content and project name are set in the POST data
if(isset($_POST['content']) && isset($_POST['nombre_proyecto'])) {
    $content = $_POST['content'];
    $nombre_proyecto = $_POST['nombre_proyecto'];

    include '../Model/mainfunction.php'; // Include the database connection file

    try {
        $pdo = connexio(); // Connect to the database
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare the SQL statement
        $sql = $pdo->prepare("UPDATE projectes SET text = :content WHERE nom = :nombre_proyecto");
        $sql->bindParam(':content', $content, PDO::PARAM_STR);
        $sql->bindParam(':nombre_proyecto', $nombre_proyecto, PDO::PARAM_STR);

        // Execute the SQL statement
        if($sql->execute()) {
            // Return success message as JSON
            echo json_encode(array("status" => "success", "message" => "Contenido guardado correctamente en la base de datos."));
        } else {
            // Return error message as JSON
            echo json_encode(array("status" => "error", "message" => "Error al guardar el contenido en la base de datos."));
        }
    } catch(PDOException $e) {
        // Return detailed error message as JSON
        echo json_encode(array("status" => "error", "message" => "Error: " . $e->getMessage()));
    }
} else {
    // Return error message as JSON if content or project name is not provided
    echo json_encode(array("status" => "error", "message" => "Error: No se proporcionó contenido o nombre de proyecto."));
}
?>
