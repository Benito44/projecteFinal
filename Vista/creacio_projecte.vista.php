<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
</head>
<body>
    <h2>Crear Nuevo Proyecto</h2>
    <form action="../Controlador/crear_proyecte.php" method="post">
        <label for="nombre_proyecto">Nombre del Proyecto:</label><br>
        <input type="text" id="nombre_proyecto" name="nombre_proyecto" required><br><br>
        
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>
        
        <label for="data_fi">Data:</label><br>
        <input type="date" id="data_fi" name="data_fi" required></input><br><br>

        <input type="submit" value="Crear Proyecto">
    </form>
</body>
</html>
