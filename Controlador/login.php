<?php
session_start();
require '../Model/mainfunction.php';

function verificarCredenciales($email, $password) {
    $conn = connexio();
    // Selección de los usuarios correspondientes al email
    $query = "SELECT * FROM usuaris WHERE email = :email";
    $statement = $conn->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        if (password_verify($password,$user["contrasenya"])) {
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
            header("Location: ./crear_proyecte.php");
            exit();
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['usuario'] = encontrarPorEmail($email);
            // Redirigir al proyecto si se proporciona un ID de proyecto válido
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $proyectoId = $_GET['id'];
                header("Location: ./editor.php?id=$proyectoId");
                exit();
            } else {
                header("Location: ./mostrar.projectes.php");
                exit();
            }
        }
    } else {
        echo "Credenciales incorrectas";
        exit();
    }
}
?>
