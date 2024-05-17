<?php
// Iniciar la sesión si no está ya iniciada
session_start();

/**
 * cerrar_sesion
 * Tanca la sessió
 */
function cerrar_sessio() {
    // Verificar si la sesión está iniciada
    if (session_status() === PHP_SESSION_ACTIVE) {
        // Destruir la sesión
        session_destroy();
    }

    // Redirigir a la página de inicio de sesión
    header('Location: ../Vista/login.vista.php');
    exit(); 
}

// Llamar a la función para cerrar la sesión
cerrar_sessio();
?>
