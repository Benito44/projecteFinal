<?php
session_start();
require '../Model/mainfunction.php';
$conn = connexio();
$sql = "SELECT rol FROM usuaris WHERE email = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_SESSION['email']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

$es_admin = false;

if ($row && isset($row['rol'])) {
    $es_admin = ($row['rol'] === 'admin');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user'])) {
        actualizarUsuario($_POST, $_FILES);
        header("Location: ./mostrar_usuaris.php");
        exit();
    }

    if (isset($_POST['delete_user'])) {
        eliminarUsuario($_POST['id']);
        header("Location: ./mostrar_usuaris.php");
        exit();
    }
}

function actualizarUsuario($data, $files) {
    $conn = connexio();
    if ($data['contra'] == ''){
        $statement = $conn->prepare("UPDATE usuaris SET usuari = :usuari, email = :email, rol = :rol, imatge = :imatge WHERE id = :id");

        $imatge = null;
        if (isset($files['imatge']) && $files['imatge']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $uploadFile = $uploadDir . basename($files['imatge']['name']);
            if (move_uploaded_file($files['imatge']['tmp_name'], $uploadFile)) {
                $imatge = $uploadFile;
            }
        } else {
            $usuario = obtenerUsuarioPorId($data['id']);
            $imatge = $usuario['imatge'];
        }
    
        $statement->execute([
            'usuari' => $data['usuari'],
            'email' => $data['email'],
            'rol' => $data['rol'],
            'imatge' => $imatge,
            'id' => $data['id']
        ]);
    } else {
        $statement = $conn->prepare("UPDATE usuaris SET usuari = :usuari, email = :email, contrasenya = :contrasenya, rol = :rol, imatge = :imatge WHERE id = :id");

        $imatge = null;
        if (isset($files['imatge']) && $files['imatge']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $uploadFile = $uploadDir . basename($files['imatge']['name']);
            if (move_uploaded_file($files['imatge']['tmp_name'], $uploadFile)) {
                $imatge = $uploadFile;
            }
        } else {
            $usuario = obtenerUsuarioPorId($data['id']);
            $imatge = $usuario['imatge'];
        }
        $encriptada = password_hash($data['contra'], PASSWORD_BCRYPT);
        $statement->execute([
            'usuari' => $data['usuari'],
            'email' => $data['email'],
            'contrasenya' => $encriptada,
            'rol' => $data['rol'],
            'imatge' => $imatge,
            'id' => $data['id']
        ]);
    }

}

function eliminarUsuario($id) {
    $conn = connexio();
    $statement = $conn->prepare("DELETE FROM usuaris WHERE id = :id");
    $statement->execute(['id' => $id]);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = obtenerUsuarioPorId($id);
} else {
    header("Location: ./mostrar_usuaris.php");
    exit();
}

function obtenerUsuarioPorId($id) {
    $conn = connexio();
    $statement = $conn->prepare("SELECT * FROM usuaris WHERE id = :id");
    $statement->execute(['id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}


include '../Vista/editar_usuaris.php';
?>

