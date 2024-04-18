<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Editor</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
    <h1 id="nombre_proyecto"></h1>

    <textarea id="editor" rows="10" cols="50"></textarea>
    <form id="editorForm">
        <button type="submit">Enviar</button>
    </form>
        
    <textarea id="chat-messages" rows="10" cols="50" readonly></textarea><br>

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Escribe un mensaje...">
        <button type="submit">Enviar</button>
    </form>

    <a href="./Controlador/login.php" target="_blank">Login</a>

    <script src="script.js"></script>
    <script>
$(document).ready(function() {
    // Función para cargar los mensajes del chat
    function loadChatMessages() {
        $.ajax({
            url: 'load_messages.php',
            method: 'GET',
            success: function(response) {
                let messagesArray = JSON.parse(response); // Convertir la cadena JSON de mensajes en un array JavaScript
                let messagesText = messagesArray.join('\n'); // Convertir el array de mensajes en una cadena de texto separada por saltos de línea
                $('#chat-messages').val(messagesText); // Actualizar el contenido del textarea
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar mensajes del chat:', error);
            }
        });
    }

    // Cargar los mensajes del chat al cargar la página
    loadChatMessages();

    // Enviar mensaje al hacer submit en el formulario
    $('#chat-form').submit(function(event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        let message = $('#message-input').val().trim();
        if (message !== '') {
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: { message: message },
                success: function(response) {
                    console.log('Mensaje enviado exitosamente:', response);
                    let currentMessages = $('#chat-messages').val(); // Obtener los mensajes actuales del textarea
                    let updatedMessages = message + '\n' + currentMessages; // Agregar el nuevo mensaje al principio del contenido existente
                    $('#chat-messages').val(updatedMessages); // Actualizar el contenido del textarea
                    $('#message-input').val(''); // Limpiar el campo de entrada

                    // Mostrar el array de mensajes en la consola
                    console.log(JSON.parse(response));
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar mensaje:', error);
                }
            });
        }
    });
});

    </script>
</body>
</html>
