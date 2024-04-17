<?php
session_start();
include '../Model/mainfunction.php';
include '../Vista/login.vista.php';

function verificarCredenciales($email, $password) {
    // Obtener la conexión a la base de datos
    $conn = connexio();

    // Preparar la consulta SQL
    $query = "SELECT * FROM usuaris WHERE email = :email";

    // Preparar la sentencia
    $statement = $conn->prepare($query);

    // Bind de los parámetros
    $statement->bindParam(':email', $email);

    // Ejecutar la sentencia
    $statement->execute();

    // Obtener el resultado
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró un usuario con el correo electrónico proporcionado
    if ($user) {
        // Verificar si la contraseña coincide
        if ($password == $user['contrasenya']) {
            // La contraseña es correcta
            // Retornar el tipo de usuario
            return $user['rol'];
        }
    }

    // Las credenciales son incorrectas
    return false;
}

// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener las credenciales del formulario
    $email = $_POST['email'];
    $password = $_POST['contra'];

    // Verificar las credenciales
    $rol = verificarCredenciales($email, $password);

    if ($rol !== false) {
        // Las credenciales son correctas
        // Verificar el tipo de usuario y redirigir a la página correspondiente
        if ($rol === 'admin') {
            header("Location: ../Vista/creacio_projecte.vista.php");
            exit();
        } else {
            header("Location: editor2.php");
            exit();
        }
    } else {
        // Las credenciales son incorrectas
        header("Location: login.php?error=credenciales_invalidas");
        exit();
    }
}

?>
