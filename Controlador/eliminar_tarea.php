<?php
session_start();
    // Verificar si se recibió el ID del evento a eliminar
    if (isset($_POST["taskId"])) {
        try {
            require '../Model/mainfunction.php';
            $connection = connexio();
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM tasques WHERE id = :taskId";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':taskId', $_POST["taskId"], PDO::PARAM_INT);
            $statement->execute();

            if ($statement->rowCount() > 0) {
                echo "Evento eliminado exitosamente";
            } else {
                echo "Error: No se encontró el evento en la base de datos";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $connection = null;
        }
    } else {
        echo "Error: No se recibió el ID del evento a eliminar";
    }
?>
