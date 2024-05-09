<?php
session_start(); // Iniciar la sesión
require '../Model/mainfunction.php';
$connexio = connexio();    
function obtenerImagenPerfil($email) {
    $connexio = connexio();
    
    $statement = $connexio->prepare("SELECT imatge FROM usuaris WHERE email = ?");
    $statement->bindParam(1, $email);
    $statement->execute();
    
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Verificar si se encontró la imagen de perfil
    if ($resultado && isset($resultado['imatge']) && !empty($resultado['imatge'])) {
        return $resultado['imatge'];
    } else {
        return null;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actual'])) {

    $actual = $_POST['actual'];
    $nova_contrasenya = $_POST['nova_contrasenya'];
    $nova_contrasenya2 = $_POST['nova_contrasenya2'];

    if ($actual == encontrarContrasenya($_SESSION['email']) && $nova_contrasenya == $nova_contrasenya2) {
    $connexio = connexio();
    $statement = $connexio->prepare("UPDATE usuaris SET contrasenya=? WHERE email= ?");
    $statement->bindParam(1,$nova_contrasenya);
    $statement->bindParam(2,$_SESSION['email']);
    $statement->execute();
    
    include '../Vista/perfil.vista.php';
    }else {
        echo "Algo esta mal";
        include '../Vista/perfil.vista.php';
    }
 } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_eliminar'])) {

        $email_eliminar = $_POST['email_eliminar'];
        if ($_POST['email_eliminar'] == $_SESSION['email']) {
        $connexio = connexio();
        borrarCompte($_POST['email_eliminar']);
        header("Location: ../Vista/login.vista.php");
        } else {
            echo "Error";
            include '../Vista/perfil.vista.php';
        }
        

 

 }  elseif(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $nombre_imagen = $_FILES['imagen']['name'];
    
    // Mueve la imagen a una carpeta en el servidor
    // Verifica si la carpeta 'uploads' existe, si no, créala
$carpeta_destino = '../uploads/';
if (!file_exists($carpeta_destino)) {
    if (!mkdir($carpeta_destino, 0777, true)) { // Intenta crear la carpeta con permisos de escritura
        die('Error al crear la carpeta de destino');
    }
}

    $ruta_imagen = '../uploads/' . $nombre_imagen;
    move_uploaded_file($imagen_tmp, $ruta_imagen);
    
    // Actualiza la ruta de la imagen en la base de datos
    $connexio = connexio();
    $statement = $connexio->prepare("UPDATE usuaris SET imatge=? WHERE email= ?");
    $statement->bindParam(1, $ruta_imagen);
    $statement->bindParam(2, $_SESSION['email']);
    $statement->execute();

    include '../Vista/perfil.vista.php';
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" ) {


    $nom_canviat = $_POST['usuario'];
    $email_canviat = $_POST['email'];
    
        $connexio = connexio();
        $statement = $connexio->prepare("UPDATE usuaris SET usuari=?,email = ? WHERE email= ?");
        $statement->bindParam(1,$nom_canviat);
        $statement->bindParam(2,$email_canviat);
        $statement->bindParam(3,$_SESSION['email']);
        $statement->execute();
        
        $_SESSION['usuario'] = $nom_canviat;
        $_SESSION['email'] = $email_canviat;
        
        include '../Vista/perfil.vista.php';
 

 }else {
    include '../Vista/perfil.vista.php';
 }


?>
