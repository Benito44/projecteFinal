<?php
include '../Vista/creacio_projecte.vista.php';
include '../Model/mainfunction.php';

$conn = connexio();

$nombre_proyecto = $_POST['nombre_proyecto'];
$descripcion = $_POST['descripcion'];
$data_inici = date("Y-m-d");
$data_fi = $_POST['data_fi'];
$email_usuario = 'b.martinez2@sapalomera.cat'; 
$id_usuari = idUsuariPerEmail($email_usuario);

if (isset($nombre_proyecto)) {
    $statement = $conn->prepare("INSERT INTO projectes (nom, descripcio, data_inici, data_fi) VALUES (?,?,?,?)");
    $statement->bindParam(1,$nombre_proyecto);
    $statement->bindParam(2,$descripcion);
    $statement->bindParam(3,$data_inici);
    $statement->bindParam(4,$data_fi);
    $statement->execute();
    
}

$nombre_proyecto_compartido = 8;
$email_compartido = 3;

if (isset($email_compartido)) {
    $statement = $conn->prepare("INSERT INTO proyecto_usuario (id_proyecto, id_usuario) VALUES (?,?)");
    $statement->bindParam(1,$nombre_proyecto_compartido);
    $statement->bindParam(2,$id_usuari);
    $statement->execute();
}


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
?>
