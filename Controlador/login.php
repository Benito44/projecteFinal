<?php
session_start();
include '../Model/mainfunction.php';
include '../Vista/login.vista.php';

function verificarCredenciales($email, $password) {
    $conn = connexio();

    // Sel·leccionar els usuaris corresponents a l'email
    $query = "SELECT * FROM usuaris WHERE email = :email";
    $statement = $conn->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    
    if ($user) {
        if ($password == $user['contrasenya']) {
            return $user['rol'];
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['contra'];

    // Verificar las credenciales
    $rol = verificarCredenciales($email, $password);

    if ($rol !== false) {
        if ($rol === 'admin') {
            header("Location: ../Vista/creacio_projecte.vista.php");
            exit();
        } else {
            header("Location: editor2.php");
            exit();
        }
    } else {
        echo "Credencials erroneas";
        exit();
    }
}

?>
