<?php

session_start(); // Iniciar sesión si aún no está iniciada

require '../Model/mainfunction.php';

if (!isset($_SESSION['email'])) {
    header('Location: ../Vista/login.vista.php');
    exit();
} 

$conn = connexio();
include '../Vista/creacio_projecte.vista.php';
if (isset($_POST['nombre_proyecto'])) {
    include '../Vista/creacio_projecte.vista.php';
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
            if (!usuariCompartit($id_usuario, $id_proyecto)) {
                $permisos = $_POST['permisos'];
                $statement = $conn->prepare("INSERT INTO proyecto_usuario (id_proyecto, id_usuario, permissos) VALUES (?,?,?)");
                $statement->bindParam(1, $id_proyecto);
                $statement->bindParam(2, $id_usuario);
                $statement->bindParam(3, $permisos);
                $statement->execute();
            } else {
                $permisos = $_POST['permisos'];
                $statement = $conn->prepare("UPDATE proyecto_usuario SET permissos=? WHERE id_usuario = ? AND id_proyecto = ?");
                $statement->bindParam(1, $permisos);
                $statement->bindParam(2, $id_usuario);
                $statement->bindParam(3, $id_proyecto);
                $statement->execute();
            }

            $link_proyecto = "http://localhost/Controlador/editor.php?id=" . $id_proyecto;
            $usuari = encontrarPorEmail($email); 
            $text = 'Hola ' . $usuari . ',<br><br>';
            $text .= 'Este proyecto ha sido compartido contigo. Puedes acceder al editor del proyecto en el siguiente enlace:<br>';
            $text .= '<a href="' . $link_proyecto . '">' . $link_proyecto . '</a>';

            // Enviar el correo electrónico
            phphmailer($usuari, $email, $text);
            header("Location: ./mostrar.projectes.php");
            echo "El proyecto se ha creado y compartido correctamente.";
        } else {
            echo "Error: Usuario no encontrado.";
        }
    }

    header("Location: ./mostrar.projectes.php");
}

?>
