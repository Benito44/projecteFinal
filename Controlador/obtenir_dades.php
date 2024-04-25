<?php
if(isset($_GET['nombre_proyecto'])) {
    $nombre_proyecto = $_GET['nombre_proyecto'];
    $file = $nombre_proyecto . '.txt';

    if(file_exists($file)) {
        $content = file_get_contents($file);
        echo $content;
    } else {
        // Si el archivo no existe, créalo
        $default_content = "";
        file_put_contents($file, $default_content);
        echo $default_content;
    }
} else {
    echo "Error: No se proporcionó el nombre de proyecto.";
}
?>
