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
