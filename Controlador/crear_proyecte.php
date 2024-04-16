<?php
include '../Vista/creacio_projecte.vista.php';
include '../Model/mainfunction.php';

$conn = connexio();

// Obtener los datos del formulario (puedes agregar más campos si es necesario)
$nombre_proyecto = $_POST['nombre_proyecto'];
$descripcion = $_POST['descripcion'];
$data_inici = date("Y-m-d");
$data_fi = $_POST['data_fi'];
$email_usuario = 'd.vallmanya@sapalomera.cat'; // Email del usuario al que se compartirá el proyecto
$id_usuari = idUsuariPerEmail($email_usuario);

// Insertar el proyecto en la base de datos
$sql = "INSERT INTO projectes (nom, descripcio, data_inici, data_fi, id_usuari) VALUES ('$nombre_proyecto', '$descripcion','$data_inici' , '$data_fi' ,$id_usuari)";

if ($conn) {
    $last_id = $conn->lastInsertId(); // Obtener el ID del proyecto recién insertado

    // Obtener el nombre del usuario
    $usuari = encontrarPorEmail($email_usuario); // Suponiendo que esta función devuelve el nombre de usuario

    // Configurar el texto del correo electrónico
    $text = 'Hola ' . $usuari . '<br>' . 'Este proyecto ha sido compartido contigo.';

    // Enviar el correo electrónico
    phphmailer($usuari, $email_usuario, $text);

    echo "El proyecto se ha creado y compartido correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2]; // Obtén el mensaje de error
}
?>
