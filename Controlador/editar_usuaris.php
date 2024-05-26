<?php
session_start();
require '../Model/mainfunction.php';


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

