<?php
// Código para cargar los mensajes del chat desde el servidor
// Aquí deberías obtener los mensajes del chat desde tu base de datos y devolverlos en formato JSON
// Por ahora, solo agregamos algunos mensajes de ejemplo

use Google\Service\CloudControlsPartnerService\Console;

$exampleMessages = [
    "Usuario 1: Hola",
    "Usuario 2: ¡Hola! ¿Cómo estás?",
    "as",
    "asasas"
];
echo json_encode($exampleMessages);
?>
