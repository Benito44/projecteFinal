<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, mostrar un mensaje de error
    echo "Acceso denegado. Por favor, inicia sesión para acceder a este proyecto.";
    exit; // Detener la ejecución del script después de mostrar el mensaje de error
}

require '../Model/mainfunction.php';
$connexio = connexio();

// Verificar si el usuario tiene permisos para acceder al proyecto
$proyectoId = $_GET['id']; // Obtener el ID del proyecto de la URL
$usuarioActual = encontrarPorUsuario($_SESSION['usuario']); // Obtener el ID del usuario de la sesión
$sql = "SELECT * FROM proyecto_usuario WHERE id_usuario = ? AND id_proyecto = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$usuarioActual, $proyectoId]);
$row = $statement->fetch(PDO::FETCH_ASSOC);

if ($row) {
    if ($row['permissos'] === 'editar') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Editor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            color: #333;
            text-align: center;
        }

        #editor {
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
        }

        #editorForm {
            text-align: center;
        }

        #editorForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #editorForm button:hover {
            background-color: #0056b3;
        }

        #chat-container {
            margin: 20px auto;
            width: 80%;
        }

        #chat-messages {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            box-sizing: border-box;
            background-color: #fff;
            overflow-y: auto;
        }

        #chat-form {
            text-align: center;
            margin-top: 20px;
        }

        #chat-form input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-right: 10px;
        }

        #chat-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #chat-form button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
    <h1 id="nombre_proyecto"></h1>

    <textarea id="editor" rows="10" cols="50"></textarea>
    <form id="editorForm">
        <button type="submit">Enviar</button>
    </form>
            <a href="../Controlador/login.php" target="_blank">Login</a>
    


    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form>
    <script src="script.js"></script>
</body>
</html>
<?php
    } elseif($row['permissos'] === 'visualitzar'){
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Editor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            color: #333;
            text-align: center;
        }

        #editor {
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
        }

        #editorForm {
            text-align: center;
        }

        #editorForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #editorForm button:hover {
            background-color: #0056b3;
        }

        #chat-container {
            margin: 20px auto;
            width: 80%;
        }

        #chat-messages {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            box-sizing: border-box;
            background-color: #fff;
            overflow-y: auto;
        }

        #chat-form {
            text-align: center;
            margin-top: 20px;
        }

        #chat-form input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-right: 10px;
        }

        #chat-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #chat-form button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
    <h1 id="nombre_proyecto"></h1>

    <textarea id="editor" rows="10" cols="50" readonly></textarea>
    <form id="editorForm">
        <button type="submit">Enviar</button>
    </form>
            <a href="../Controlador/login.php" target="_blank">Login</a>
    


    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje..." readonly>
        <button type="submit">Enviar</button>
    </form>
    <script src="script.js"></script>
</body>
</html>
<?php
    } elseif($row['permissos'] === 'comentar'){
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Editor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin-top: 20px;
            color: #333;
            text-align: center;
        }

        #editor {
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            resize: none;
        }

        #editorForm {
            text-align: center;
        }

        #editorForm button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #editorForm button:hover {
            background-color: #0056b3;
        }

        #chat-container {
            margin: 20px auto;
            width: 80%;
        }

        #chat-messages {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
            box-sizing: border-box;
            background-color: #fff;
            overflow-y: auto;
        }

        #chat-form {
            text-align: center;
            margin-top: 20px;
        }

        #chat-form input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            margin-right: 10px;
        }

        #chat-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #chat-form button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
    <h1 id="nombre_proyecto"></h1>

    <textarea id="editor" rows="10" cols="50" readonly></textarea>
    <form id="editorForm">
        <button type="submit">Enviar</button>
    </form>
            <a href="../Controlador/login.php" target="_blank">Login</a>
    


    <div id="chat-container">
        <textarea id="chat-messages" rows="10" cols="50" readonly></textarea>
    </div>
    

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form>
    <script src="script.js"></script>
</body>
</html>
<?php
    }
    

} else {
    // El usuario no tiene permisos, mostrar un mensaje de acceso denegado
    echo 'No tienes permisos';
}