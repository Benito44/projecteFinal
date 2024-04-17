<?php
if(isset($_POST['content']) && isset($_POST['nombre_proyecto'])) {
    $content = $_POST['content'];
    $nombre_proyecto = $_POST['nombre_proyecto'];

    $file = $nombre_proyecto . '.txt';
echo  $file ;
    file_put_contents($file, $content);
    
    echo "Contenido guardado correctamente en $file.";
} else {
    echo "Error: No se proporcionó contenido o nombre de proyecto.";
}
?>
