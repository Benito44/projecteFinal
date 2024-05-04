<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el ID del evento a eliminar
    if (isset($_POST["id"])) {
        try {
            require '../Model/mainfunction.php';
            $connection = connexio();
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $id_usuario = encontrarPorUsuario($_SESSION["usuario"]);

            $sql = "DELETE FROM calendari WHERE id = :id AND usuari_id = :usuari_id";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':id', $_POST["id"], PDO::PARAM_INT);
            $statement->bindParam(':usuari_id', $id_usuario, PDO::PARAM_INT);
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
} else {
    echo "Error: Método no permitido";
}
?>
