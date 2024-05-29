<?php

session_start(); // Iniciar sesión si aún no está iniciada

require '../Model/mainfunction.php';

if (!isset($_SESSION['email'])) {
    header('Location: ../Vista/login.vista.php');
    exit();
} 

$conn = connexio();
if (isset($_POST['nombre_proyecto'])) {
    if (strtotime($_POST['data_fi']) < strtotime(date("Y-m-d"))) {
        $error = 'La data final no pot ser abans que la data actual';
        include '../Vista/creacio_projecte.vista.php';
        } 
    else {
        
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $descripcion = $_POST['descripcion'];


    $data_inici = date("Y-m-d");
    $data_fi = $_POST['data_fi'];
    $email_usuario = 'b.martinez2@sapalomera.cat';

    $statement = $conn->prepare("INSERT INTO projectes (nom, descripcio, data_inici, data_fi) VALUES (?,?,?,?)");
    $statement->bindParam(1, $nombre_proyecto);
    $statement->bindParam(2, $descripcion);
    $statement->bindParam(3, $data_inici);
    $statement->bindParam(4, $data_fi);
    $statement->execute();
    
    $id_usuari = "";
    $statement = $conn->prepare("SELECT id FROM usuaris WHERE email = ?");
    $statement->bindParam(1, $_SESSION['email']);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id_usuari = $row["id"];
    }

    $id_projecte = "";
    $statement = $conn->prepare("SELECT id FROM projectes WHERE nom = ?");
    $statement->bindParam(1, $nombre_proyecto);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id_projecte = $row["id"];
    }

    $permissos = 'editar';
    $statement = $conn->prepare("INSERT INTO proyecto_usuario (id_proyecto, id_usuario, permissos) VALUES (?,?,?)");
    $statement->bindParam(1, $id_projecte);
    $statement->bindParam(2, $id_usuari);
    $statement->bindParam(3, $permissos);
    $statement->execute();
}
} else {
    include '../Vista/creacio_projecte.vista.php';

}

?>
