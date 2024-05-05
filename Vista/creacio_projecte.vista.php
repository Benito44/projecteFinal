<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      margin-top: 20px;
    }
    ul {
      list-style-type: none;
      padding: 0;
      margin: 20px auto;
      max-width: 600px;
    }
    li {
      margin-bottom: 10px;
    }
    li a {
      text-decoration: none;
      color: #333;
      display: block;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    li a:hover {
      background-color: #f0f0f0;
    }
  </style></head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Mi Sitio Web</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(actual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Acerca de</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/crear_usuari.php">crear_usuari</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
      </li>
    </ul>
  </div>
</nav>
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
    <form id="share-form" action="../Controlador/crear_proyecte.php" method="post">
    <label for="nombre_proyectos_compartidos">Nombre del Proyecto:</label><br>
    <input type="text" id="nombre_proyectos_compartidos" name="nombre_proyectos_compartidos" required><br><br>

    <div id="emails-container">
        <p>Correos añadidos:</p>
        <ul id="emails-list"></ul>
        <!-- Campo oculto para almacenar correos electrónicos -->
        <input type="hidden" id="correos-ocultos" name="correos_ocultos">
    </div>

    <label for="emails_compartidos">Correos Electrónicos:</label><br>
    <textarea id="emails_compartidos" name="emails_compartidos" rows="4"></textarea><br><br>

    <button type="button" id="agregar-correos">Agregar Correos</button><br><br>

    <label for="permisos">Permisos:</label>
    <select id="permisos" name="permisos">
        <option value="editar">Editar</option>
        <option value="comentar">Comentar</option>
        <option value="visualizar">Visualizar</option>
    </select><br><br>

    <button type="submit">Enviar Correos</button>
</form>

    <div>
        <a href="../Controlador/mostrar.projectes.php" >Mostrar projectes</a>
    </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#agregar-correos').click(function() {
        var correos = $('#emails_compartidos').val().split('\n');

        // Agregar correos al div y al campo oculto
        correos.forEach(function(correo) {
            correo = correo.trim();
            if (correo !== "") {
                $('#emails-list').append('<li>' + correo + '</li>');
            }
        });

        // Actualizar campo oculto con los correos
        var correosOcultos = correos.filter(function(correo) {
            return correo.trim() !== "";
        }).join(',');
        $('#correos-ocultos').val(correosOcultos);
    });
        // Cuando se envía el formulario
        $('#share-form').submit(function(event) {
        // Obtener los correos electrónicos del div
        var correos = [];
        $('#emails-list li').each(function() {
            correos.push($(this).text());
        });

        // Almacenar los correos electrónicos en el campo oculto
        $('#correos-ocultos').val(correos.join(','));

        // Continuar enviando el formulario
        return true;
    });
});

</script>
</body>
</html>
