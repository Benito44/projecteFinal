<?php

session_start(); // Iniciar sesión si aún no está iniciada
include '../Vista/creacio_projecte.vista.php';
include '../Model/mainfunction.php';

$conn = connexio();


if (isset($_POST['nombre_proyecto'])) {

    $nombre_proyecto = $_POST['nombre_proyecto'];
$descripcion = $_POST['descripcion'];
$data_inici = date("Y-m-d");
$data_fi = $_POST['data_fi'];
$email_usuario = 'b.martinez2@sapalomera.cat'; 
//$id_usuari = idUsuariPerEmail($email_usuario);

    $statement = $conn->prepare("INSERT INTO projectes (nom, descripcio, data_inici, data_fi) VALUES (?,?,?,?)");
    $statement->bindParam(1,$nombre_proyecto);
    $statement->bindParam(2,$descripcion);
    $statement->bindParam(3,$data_inici);
    $statement->bindParam(4,$data_fi);
    $statement->execute();
    
    $id_usuari = "";
    $statement = $conn->prepare("SELECT id FROM usuaris WHERE email = ?");
    $statement->bindParam(1,$_SESSION['email']);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id_usuari = $row["id"];
    }


    $id_projecte = "";
    $statement = $conn->prepare("SELECT id FROM projectes WHERE nom = ?");
    $statement->bindParam(1,$nombre_proyecto);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id_projecte = $row["id"];
    }

    $permissos = 'editar';
    $statement = $conn->prepare("INSERT INTO proyecto_usuario (id_proyecto, id_usuario, permissos) VALUES (?,?,?)");
    $statement->bindParam(1,$id_projecte);
    $statement->bindParam(2,$id_usuari);
    $statement->bindParam(3,$permissos);
    $statement->execute();

}





if (isset($_POST['email_compartido'])) {

    $nombre_proyecto_compartido = $_POST['nombre_proyecto_compartido'];

    $id_projecte = "";
    $statement = $conn->prepare("SELECT id FROM projectes WHERE nom = ?");
    $statement->bindParam(1,$nombre_proyecto_compartido);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id_projecte = $row["id"];
    }


    $email_compartido = $_POST['email_compartido'];
    $id_usuari = "";
    $statement = $conn->prepare("SELECT id FROM usuaris WHERE email = ?");
    $statement->bindParam(1,$email_compartido);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id_usuari = $row["id"];
    }


    $permissos = 'editar';
    $statement = $conn->prepare("INSERT INTO proyecto_usuario (id_proyecto, id_usuario, permissos) VALUES (?,?,?)");
    $statement->bindParam(1,$id_projecte);
    $statement->bindParam(2,$id_usuari);
    $statement->bindParam(3,$permissos);
    $statement->execute();
}

/*

if ($conn) {
    $last_id = $conn->lastInsertId(); // Obtener el ID del proyecto recién insertado

    $link_proyecto = "http://localhost/projecteFinal/editor.php?id=" . $last_id;

    $usuari = encontrarPorEmail($email_usuario); 

    $text = 'Hola ' . $usuari . ',<br><br>';
    $text .= 'Este proyecto ha sido compartido contigo. Puedes acceder al editor del proyecto en el siguiente enlace:<br>';
    $text .= '<a href="' . $link_proyecto . '">' . $link_proyecto . '</a>';
    
    // Enviar el correo electrónico
    phphmailer($usuari, $email_usuario, $text);

    echo "El proyecto se ha creado y compartido correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2]; 
}
*/
?>
