<?php
session_start();
require '../Model/mainfunction.php';

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
            $_SESSION['email'] = $email;
            $_SESSION['usuario'] = encontrarPorEmail($email);
            header("Location: ../Vista/creacio_projecte.vista.php");
            exit();
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['usuario'] = encontrarPorEmail($email);
            header("Location: ./mostrar.projectes.php");
            exit();
        }
    } else {
        echo "Credenciales incorrectas";
        exit();
    }
}
?>