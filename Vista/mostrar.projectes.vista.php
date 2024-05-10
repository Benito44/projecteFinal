<?php
session_start(); // Iniciar sesión si aún no está iniciada

if (!isset($_SESSION['email'])) {
    exit("Error: No se ha iniciado sesión");
} else {
    $connexio = connexio(); 
    $sql = "SELECT id, rol FROM usuaris WHERE email = ?";
    $statement = $connexio->prepare($sql);
    $statement->execute([$_SESSION['email']]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
}

$connexio = connexio(); 
$sql = "SELECT p.* FROM proyecto_usuario pu INNER JOIN projectes p ON pu.id_proyecto = p.id WHERE pu.id_usuario = ?";
$statement = $connexio->prepare($sql);
$statement->execute([$row['id']]);
$proyectos = $statement->fetchAll(PDO::FETCH_ASSOC);

$es_admin = $row['rol'] === 'admin';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <style>
              .dialeg {
            position: absolute;
            margin: 0;
            padding: 2rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 32.5rem;
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 8px 8px 24px 0 rgba(0, 0, 0, 0.5);
        }
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
    li button {
      text-decoration: none;
      color: #333;
      display: block;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }
    li button:hover {
      background-color: #f0f0f0;
    }
    dialog {
      border: none;
      padding: 10px;
      margin: 0;
    }
  </style>

</head>
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
            <a class="nav-link" href="../Vista/calendari.php">calendario</a>
          </li>
          <?php if ($es_admin): ?>
            <li class="nav-item">
              <a class="nav-link" href="../Controlador/crear_proyecte.php">Crear Proyecto</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="../Controlador/perfil.php">Perfil</a>
          </li>
        </ul>
      </div>
    </nav>
    <h1>Lista de Proyectos</h1>
    <ul>
        <?php foreach($proyectos as $proyecto): ?>
          <li>
            <button id="<?php echo $proyecto['id']; ?>">
              <?php echo $proyecto['nom']; ?>
            </button>
          </li>
          <dialog id="dialog_<?php echo $proyecto['id']; ?>" class="dialeg">
            <li>
            Nom: 
              <a href="http://localhost/Vista/editor.php?id=<?php echo $proyecto['id']; ?>">
              <?php echo $proyecto['nom']; ?><br>
              </a>
              Descripció de projecte: <?php echo $proyecto['descripcio']; ?><br><br>
              Data de finalització: <?php echo $proyecto['data_fi']; ?><br>
            </li>
            <button id="tancar_<?php echo $proyecto['id']; ?>">Cerrar</button>
          </dialog>
        <?php endforeach; ?>
    </ul>

    <script>
    <?php foreach($proyectos as $proyecto): ?>
      const button_<?php echo $proyecto['id']; ?> = document.getElementById('<?php echo $proyecto['id']; ?>');
      const dialog_<?php echo $proyecto['id']; ?> = document.getElementById('dialog_<?php echo $proyecto['id']; ?>');
      const tancar_<?php echo $proyecto['id']; ?> = document.getElementById('tancar_<?php echo $proyecto['id']; ?>');

      button_<?php echo $proyecto['id']; ?>.addEventListener('click', function() {
          dialog_<?php echo $proyecto['id']; ?>.showModal();
      });
      tancar_<?php echo $proyecto['id']; ?>.addEventListener('click', function() {
          dialog_<?php echo $proyecto['id']; ?>.close();
      });
    <?php endforeach; ?>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
