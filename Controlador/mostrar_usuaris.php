<?php
session_start();
require '../Model/mainfunction.php';

include '../Vista/mostrar_usuaris.php';


function obtenerTodosUsuarios() {
    $conn = connexio();
    $statement = $conn->query("SELECT * FROM usuaris");
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>