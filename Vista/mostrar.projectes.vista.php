<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
</head>
<body>
    <h1>Lista de Proyectos</h1>
    <ul>
        <?php foreach($proyectos as $proyecto): ?>
            <li><a href="http://localhost/projecteFinal/editor.php?id=<?php echo $proyecto['id']; ?>"><?php echo $proyecto['nom']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
