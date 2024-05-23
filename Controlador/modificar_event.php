<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../Model/mainfunction.php'; 
    $connection = connexio();

    $sql = "UPDATE calendari SET titol = ?, inici = ?, final = ?, color = ?, descripcio = ? WHERE id = ?";
    $statement = $connection->prepare($sql);

    $id = $_POST['modifyEventId'];
    $title = $_POST["modifyTitle"];
    $start = $_POST["modifyStart"];
    $end = $_POST["modifyEnd"];
    $color = $_POST["modifyColor"];
    $descripcio = $_POST["modifyDesc"];
    
    $statement->bindParam(1, $title);
    $statement->bindParam(2, $start);
    $statement->bindParam(3, $end);
    $statement->bindParam(4, $color);
    $statement->bindParam(5, $descripcio);
    $statement->bindParam(6, $id);
    
    try {
        $statement->execute();
        if ($statement->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo modificar el evento.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    $statement = null;
    $connection = null;
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}
?>
