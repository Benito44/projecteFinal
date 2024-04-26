<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
    <style>
/* Style for the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    max-width: 500px;
    width: 100%;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

h2 {
    color: #333;
    margin-bottom: 20px; /* Add space between title and form */
}

label {
    font-weight: bold;
}
input[type="text"],
input[type="date"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}


input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

input:invalid {
    border-color: #dc3545;
}

@media only screen and (max-width: 600px) {
    body {
        padding: 10px;
    }
}

.container {
    max-width: 800px; 
    margin: 0 auto; 
}


.forms-container {
    display: flex; 
}


form {
    flex: 1;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    margin: 0 10px; /* Espacio entre los formularios */
}

/* Estilo para el título */
h2 {
    text-align: center; /* Centra el título horizontalmente */
    margin-bottom: 20px; /* Espacio entre el título y los formularios */
}

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
        <input type="text" id="nombre_proyecto_compartido" name="nombre_proyecto_compartido" required value="DVD2"><br><br>
        
        <label for="email_compartido">email:</label><br>
        <input type="text" id="email_compartido" name="email_compartido" required><br><br>
        
        <input type="submit" value="Compartir">
    </form>
        </div>
    </div>
</body>
</html>
