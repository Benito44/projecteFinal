<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuari</title>
    <link rel="stylesheet" href="../Model/formulari.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-E1OJduYUwdi5wPTrG5nPtf/sq+xeIePuAGeZCrBJBL3TweNf7OMet/UHxRy/2j1JMsc2HTv+2+prAouTlJLing==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilos para los botones */
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .button i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form action="../Controlador/login.php" id="form" method="post">
        Usuari
        <input type="text"  id="email" name="email" placeholder="Email"><br><br>
        Contrasenya
        <input type="password" id="contra" name="contra" placeholder="Contrasenya"><br><br>
        <input type="submit" value="Login">
        <a href="../Controlador/index.php">Torna</a>
        <span class="error">
            <?php if(isset($error)) { echo $error; } ?>
        </span> 
    </form>
    <div class="d-grid text-center">
        <div class="btn-group-vertical">
        <div class="enlace">
        <?php require ('../Controlador/autentificacion.php'); ?>
            <a href="<?php echo $client->createAuthUrl(); ?>" class="btn btn-danger btn-login text-uppercase fw-bold"><i class="fab fa-google"></i> Google</a>
            </div>
    <div class="enlace">
            <a href="../Controlador/github.php" class="btn btn-primary btn-login text-uppercase fw-bold"><i class="fab fa-facebook-f"></i> Github</a>
    </div>
        </div>
    </div>
    <div>
        <a href="../Controlador/recupera_contra.php" class="btn btn-danger btn-login text-uppercase fw-bold"> Recupera la contrasenya</a>
    </div>
</body>
</html>
