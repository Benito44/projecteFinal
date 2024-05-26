<?php
session_start();
require '../Model/mainfunction.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user'])) {
        actualizarUsuario($_POST);
        header("Location: ./mostrar_usuaris.php");
        exit();
    }

    if (isset($_POST['delete_user'])) {
        eliminarUsuario($_POST['id']);
        header("Location: ./mostrar_usuaris.php");
        exit();
    }
}
function actualizarUsuario($data) {
    $conn = connexio();
    $statement = $conn->prepare("UPDATE usuaris SET usuari = :usuari, email = :email, rol = :rol WHERE id = :id");
    $statement->execute([
        'usuari' => $data['usuari'],
        'email' => $data['email'],
        'rol' => $data['rol'],
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="container">
        <h2>Editar Usuario</h2>
        <form method="post" id="editUserForm">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
            <div class="mb-3">
                <label for="usuari" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuari" name="usuari" value="<?php echo htmlspecialchars($usuario['usuari']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol de l'usuari</label>
                <select id="rol" name="rol" class="form-select">
                    <option value="admin" <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Administrador</option>
                    <option value="membre" <?php if ($usuario['rol'] === 'membre') echo 'selected'; ?>>Usuari</option>
                </select>
            </div>

            <button type="submit" name="update_user" class="btn btn-primary">Actualizar</button>
            <button type="submit" name="delete_user" class="btn btn-danger">Eliminar</button>
            <a href="mostrar_usuaris.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzBMVLOM04d64k1dXZktpM9w8a/tteS0P5c13p5lFvMd" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-9ndCyUaPLF5e1hYhLUy60mxuKc9K/DIpWkTxH01qjIcXNXxlfbsVRmZ4kfNtwC9g" crossorigin="anonymous"></script>
</body>
</html>
