
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="container">
        <h2>Ver Usuarios</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre de Usuario</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $usuarios = obtenerTodosUsuarios();
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>{$usuario['usuari']}</td>";
                    echo "<td>{$usuario['email']}</td>";
                    echo "<td>{$usuario['rol']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
