<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuari</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-E1OJduYUwdi5wPTrG5nPtf/sq+xeIePuAGeZCrBJBL3TweNf7OMet/UHxRy/2j1JMsc2HTv+2+prAouTlJLing==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0; /* Fondo blanco */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            width: 400px; /* Aumentar el ancho del formulario */
            padding: 20px;
            border: 2px solid #333; /* Borde oscuro para coherencia con el menú */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9; /* Fondo claro */
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            text-decoration: none;
            margin-top: 10px;
            color: #007bff;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .enlace {
            margin-bottom: 15px;
        }

        .enlace a {
            display: block;
            padding: 10px;
            background-color: #f0f0f0;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            text-align: center;
            color: #333;
        }

        .enlace a:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Login</h1>
        <form action="../Controlador/login.php" id="form" method="post">
            <input type="text" id="email" name="email" placeholder="Email"><br><br>
            <input type="password" id="contra" name="contra" placeholder="Contrasenya"><br><br>
            <input type="submit" value="Login">
            <span class="error">
                <?php if(isset($error)) { echo $error; } ?>
            </span>
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
            <div class="enlace">
                <a href="../Controlador/recupera_contra.php" class="btn btn-danger btn-login text-uppercase fw-bold">Recupera la contrasenya</a>
            </div>
        </form>
    </div>
</body>
</html>
