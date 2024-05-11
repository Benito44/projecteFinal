<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["title"]) && isset($_POST["start"]) && isset($_POST["end"])) {
        require '../Model/mainfunction.php';
        $connection = connexio();

        $sql = "INSERT INTO calendari (titol, inici, final, usuari_id, color, descripcio) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $connection->prepare($sql);

        if (isset($_SESSION["usuario"])) {
            $usuari_id = encontrarPorUsuario($_SESSION["usuario"]);
        } else {
            die("Error: Usuario no autenticado");
        }

        $title = $_POST["title"];
        $start = $_POST["start"];
        $end = $_POST["end"];
        $color = $_POST["color"];
        $descripcio = $_POST["desc"];
        
        $statement->bindParam(1, $title);
        $statement->bindParam(2, $start);
        $statement->bindParam(3, $end);
        $statement->bindParam(4, $usuari_id);
        $statement->bindParam(5, $color);
        $statement->bindParam(6, $descripcio);
        
        $statement->execute();

        // Verificar si la inserción fue exitosa
        if ($statement->rowCount() > 0) {
            echo "Evento guardado exitosamente";
        } else {
            echo "Error al guardar el evento en la base de datos";
        }

        $statement = null;
        $connection = null;
    } else {
        echo "Error: No se recibieron todos los datos del formulario";
    }
} else {
    echo "Error: Método no permitido";
}
?>
