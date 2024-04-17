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

$statement = $conn->prepare("INSERT INTO projectes (nom, descripcio, data_inici, data_fi, id_usuari) VALUES (?,?,?,?,?)");
$statement->bindParam(1,$nombre_proyecto);
$statement->bindParam(2,$descripcion);
$statement->bindParam(3,$data_inici);
$statement->bindParam(4,$data_fi);
$statement->bindParam(5,$id_usuari);
$statement->execute();

// Insertar el proyecto en la base de datos
$sql = "INSERT INTO projectes (nom, descripcio, data_inici, data_fi, id_usuari) VALUES ('$nombre_proyecto', '$descripcion','$data_inici' , '$data_fi' ,$id_usuari)";

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
