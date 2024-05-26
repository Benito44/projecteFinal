<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuari</title>
    <link rel="stylesheet" href="../Model/formulari.css">
    <style>

* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url(../uploads/fondo.gif); /* Fondo blanco */
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

        input[type="text"], input[type="password"], input[type="email"] {
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
        }    </style>
</head>

<body>
    <div class="form-container">
        <h1>Recuperar contrasenya</h1>
        <form action="../Controlador/recupera_contra.php" id="form" method="post">
            <input type="email" id="contra" name="contra" placeholder="Email">
            <input type="submit" value="Registrat">
            <a href="../Vista/login.vista.php">Torna</a>

            <span class="error">
            <?php if(!isset($error)){
            $error;
                }else{echo $error;}?>
        </span> 
        </form>
    </div>

</body>
</html>