<?php

session_start(); // Iniciar sesión si aún no está iniciada

require '../Model/mainfunction.php';
include '../Vista/creacio_projecte.vista.php';
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


if (isset($_POST['nombre_proyectos_compartidos']) && isset($_POST['correos_ocultos'])) {
    $nombre_proyecto_compartido = $_POST['nombre_proyectos_compartidos'];

    $id_proyecto = "";
    $statement = $conn->prepare("SELECT id FROM projectes WHERE nom = ?");
    $statement->bindParam(1, $nombre_proyecto_compartido);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id_proyecto = $row["id"];
    }

    $emails_compartidos = explode(',', $_POST['correos_ocultos']);

    foreach ($emails_compartidos as $email) {
        $email = trim($email);

        $id_usuario = "";
        $statement = $conn->prepare("SELECT id FROM usuaris WHERE email = ?");
        $statement->bindParam(1, $email);
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $id_usuario = $row["id"];
        }

        if ($id_usuario !== "") {
            $permisos = $_POST['permisos'];
            $statement = $conn->prepare("INSERT INTO proyecto_usuario (id_proyecto, id_usuario, permissos) VALUES (?,?,?)");
            $statement->bindParam(1, $id_proyecto);
            $statement->bindParam(2, $id_usuario);
            $statement->bindParam(3, $permisos);
            $statement->execute();
        } else {
            echo "Error:";
        }
        $last_id = $id_proyecto;

        $link_proyecto = "http://localhost/Vista/editor.php?id=" . $last_id;
    
        $usuari = encontrarPorEmail($email); 
    
        $text = 'Hola ' . $usuari . ',<br><br>';
        $text .= 'Este proyecto ha sido compartido contigo. Puedes acceder al editor del proyecto en el siguiente enlace:<br>';
        $text .= '<a href="' . $link_proyecto . '">' . $link_proyecto . '</a>';
        
        // Enviar el correo electrónico
        phphmailer($usuari, $email, $text);
    
        echo "El proyecto se ha creado y compartido correctamente.";
    }
}

?>
