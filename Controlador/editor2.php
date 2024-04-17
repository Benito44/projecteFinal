<?php
$contraseña = '12345678';
$hash = '$2y$10$H8U/zJNrJcEiuOw79So43.fHXL9t1fGd50xNQeNrLOcDDNqhWE1yC';

if (password_verify($contraseña, $hash)) {
    echo 'La contraseña coincide.';
} else {
    echo 'La contraseña no coincide.';
}
?>