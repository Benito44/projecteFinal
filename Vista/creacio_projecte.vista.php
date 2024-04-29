<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
    <style>
/* Style for the body */
    </style></head>
<body>
<div class="container">
        <h2>Crear Nuevo Proyecto</h2>
        <div class="forms-container">
    <form action="../Controlador/crear_proyecte.php" method="post">
        <label for="nombre_proyecto">Nombre del Proyecto:</label><br>
        <input type="text" id="nombre_proyecto" name="nombre_proyecto" required><br><br>
        
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>
        
        <label for="data_fi">Data:</label><br>
        <input type="date" id="data_fi" name="data_fi" required></input><br><br>

        <input type="submit" value="Crear Proyecto">
    </form>
    <form id="second-form" action="../Controlador/crear_proyecte.php" method="post">
        <label for="nombre_proyecto_compartido">Nombre del Proyecto:</label><br>
        <input type="text" id="nombre_proyecto_compartido" name="nombre_proyecto_compartido" required><br><br>
        
        <label for="email_compartido">email:</label><br>
        <input type="text" id="email_compartido" name="email_compartido" required><br><br>
        
        <input type="submit" value="Compartir">
    </form>
        </div>
    </div>
</body>
</html>
