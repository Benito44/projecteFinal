<?php
header('Content-Type: application/json');

require '../Model/mainfunction.php'; 

$connection = connexio();

try {
    $statement = $connection->query("SELECT id, titol, inici, final, descripcio, color FROM calendari");

    $events = array();

    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $event = array(
            'id' => $row['id'], 
            'title' => $row['titol'],
            'start' => date('Y-m-d\TH:i:s', strtotime($row['inici'])),
            'end' => date('Y-m-d\TH:i:s', strtotime($row['final'])),
            'desc' => $row['descripcio'], 
            'color' => $row['color']
        );
        array_push($events, $event);
    }

    echo json_encode($events);
} catch(PDOException $e) {
    die("Error de connexió a la base de dades: " . $e->getMessage());
}
?>
