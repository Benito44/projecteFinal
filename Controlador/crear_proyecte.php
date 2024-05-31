<?php

session_start(); // Iniciar sessió si encara no està iniciada

require '../Model/mainfunction.php';

if (!isset($_SESSION['email'])) {
    header('Location: ../Vista/login.vista.php');
    exit();
} 

$conn = connexio();
$sql = "SELECT rol FROM usuaris WHERE email = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION['email']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

$es_admin = false;

if ($row && isset($row['rol'])) {
    $es_admin = ($row['rol'] === 'admin');
}
if (isset($_POST['nombre_proyecto'])) {
    if (strtotime($_POST['data_fi']) < strtotime(date("Y-m-d"))) {
        $error = 'La data final no pot ser abans que la data actual';
        include '../Vista/creacio_projecte.vista.php';
    } else {
        $nombre_proyecto = $_POST['nombre_proyecto'];
        $descripcio = $_POST['descripcion'];
        $data_inici = date("Y-m-d");
        $data_fi = $_POST['data_fi'];

        inserirProjecte($conn, $nombre_proyecto, $descripcio, $data_inici, $data_fi);

        $id_usuari = obtenirIdUsuariPerEmail($conn, $_SESSION['email']);
        $id_projecte = obtenirIdProjectePerNom($conn, $nombre_proyecto);

        $permisos = 'editar';
        inserirPermisosUsuariProjecte($conn, $id_projecte, $id_usuari, $permisos);
    }
} 

if (isset($_POST['correos-ocultos']) && !empty(trim($_POST['correos-ocultos']))) {
    $nombre_proyecto_compartido = $_POST['nombre_proyectos_compartidos'];
    $id_proyecto = obtenirIdProjectePerNom($conn, $nombre_proyecto_compartido);
    $emails_compartidos = explode(',', $_POST['correos-ocultos']);

    foreach ($emails_compartidos as $email) {
        $email = trim($email);
        $id_usuario = obtenirIdUsuariPerEmail($conn, $email);
        if ($id_usuario !== "") {
            if (!usuariCompartit($id_usuario, $id_proyecto)) {
                $permisos = $_POST['permisos'];
                inserirPermisosUsuariProjecte($conn, $id_proyecto, $id_usuario, $permisos);
            } else {
                $permisos = $_POST['permisos'];
                actualitzarPermisosUsuariProjecte($conn, $permisos, $id_usuario, $id_proyecto);
            }

            $link_proyecto = "http://localhost/Controlador/editor.php?id=" . $id_proyecto;
            $usuari = trobarUsuariPerEmail($conn, $email); 
            $text = 'Hola ' . $usuari . ',<br><br>';
            $text .= 'Este proyecto ha sido compartido contigo. Puedes acceder al editor del proyecto en el siguiente enlace:<br>';
            $text .= '<a href="' . $link_proyecto . '">' . $link_proyecto . '</a>';

            // Enviar el correo electrónico
            phphmailer($usuari, $email, $text);
        }
    }
    header('Location: ../Controlador/mostrar.projectes.php');
    exit();
} else {
    include '../Vista/creacio_projecte.vista.php';
}

?>
