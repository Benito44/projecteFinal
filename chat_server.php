<?php
session_start(); // Inicia la sesión para almacenar el array de mensajes

// Función para inicializar el array de mensajes si no existe
function initMessagesArray() {
    if (!isset($_SESSION['chat_messages'])) {
        $_SESSION['chat_messages'] = [];
    }
}

// Función para agregar un mensaje al array de mensajes
function addMessage($message) {
    array_push($_SESSION['chat_messages'], $message);
}

// Función para obtener el array de mensajes
function getMessages() {
    return $_SESSION['chat_messages'];
}

// Si se recibe un mensaje a través de POST, agrégalo al array de mensajes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    initMessagesArray();
    $message = $_POST['message'];
    addMessage($message);
}

// Devuelve el array de mensajes como JSON
echo json_encode(getMessages());
?>
