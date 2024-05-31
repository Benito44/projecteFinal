<?php
require '../Model/mainfunction.php';

session_start(); // Iniciar sesión si aún no está iniciada

if (!isset($_SESSION['email'])) {
    header ('Location: ../Vista/login.vista.php');
} else {
    $connexio = connexio(); 
    $sql = "SELECT id, rol FROM usuaris WHERE email = ?";
    $statement = $connexio->prepare($sql);
    $statement->execute([$_SESSION['email']]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
}
$es_admin = $row['rol'] === 'admin';
$connexio = connexio();    

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actual'])) {

    $actual = $_POST['actual'];
    $nova_contrasenya = $_POST['nova_contrasenya'];
    $nova_contrasenya2 = $_POST['nova_contrasenya2'];

    if (password_verify($_POST['actual'],encontrarContrasenya($_SESSION['email'])) && $nova_contrasenya == $nova_contrasenya2) {
    $connexio = connexio();
    $encriptada = password_hash($nova_contrasenya, PASSWORD_BCRYPT);
    $statement = $connexio->prepare("UPDATE usuaris SET contrasenya=? WHERE email= ?");
    $statement->bindParam(1,$encriptada);
    $statement->bindParam(2,$_SESSION['email']);
    $statement->execute();
    
    include '../Vista/perfil.vista.php';
    }else {
        $error = "La contrsenya no és la correcta";
        include '../Vista/perfil.vista.php';
    }
 } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contrasenya_eliminar'])) {

        $contrasenya_eliminar = $_POST['contrasenya_eliminar'];
        if (password_verify($_POST['contrasenya_eliminar'],encontrarContrasenya($_SESSION['email']))) {
        $connexio = connexio();
        borrarCompte($_SESSION['email']);
        header("Location: ../Vista/login.vista.php");
        } else {
            $error = "La contrsenya no és la correcta";
            include '../Vista/perfil.vista.php';
        }
        

 

 }  elseif(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen_tmp = $_FILES['imagen']['tmp_name'];
    $nombre_imagen = $_FILES['imagen']['name'];

$carpeta_destino = '../uploads/';
if (!file_exists($carpeta_destino)) {
    if (!mkdir($carpeta_destino, 0777, true)) {
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
