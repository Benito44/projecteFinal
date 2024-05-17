<?php
require '../Model/mainfunction.php';

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

// Consulta para obtener los proyectos del usuario actual
$sql_proyectos = "SELECT p.*, GROUP_CONCAT(u.usuari SEPARATOR ', ') AS usuarios_con_permisos 
                 FROM proyecto_usuario pu 
                 INNER JOIN projectes p ON pu.id_proyecto = p.id 
                 INNER JOIN usuaris u ON pu.id_usuario = u.id 
                 WHERE pu.id_usuario = ? 
                 GROUP BY p.id";
$statement_proyectos = $connexio->prepare($sql_proyectos);
$statement_proyectos->execute([$row['id']]);
$proyectos = $statement_proyectos->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener todos los usuarios con permisos en cada proyecto
$sql_usuarios = "SELECT pu.id_proyecto, GROUP_CONCAT(u.usuari SEPARATOR ', ') AS usuarios_con_permisos 
                 FROM proyecto_usuario pu 
                 INNER JOIN usuaris u ON pu.id_usuario = u.id 
                 GROUP BY pu.id_proyecto";
$statement_usuarios = $connexio->query($sql_usuarios);
$usuarios_proyectos = $statement_usuarios->fetchAll(PDO::FETCH_ASSOC);

$es_admin = $row['rol'] === 'admin';

include '../Vista/mostrar.projectes.vista.php'; 


if (!$proyectos) {
    echo ("Error: No se encontraron proyectos para este usuario");
}
?>
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