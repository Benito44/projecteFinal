<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuari</title>
    <link rel="stylesheet" href="../Model/formulari.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e0f7fa;
        }
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .btn-center-right {
            display: flex;
            justify-content: flex-end;
        }
        .profile-image {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .profile-image img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
<div class="content">
    <div class="container">
    <h2>Recuperar contrasenya</h2>
    <form action="../Controlador/recupera_contra.php" id="form" method="post">
        Email
        <input type="email" id="contra" name="contra" placeholder="Email"><br><br>
        <input type="submit" value="Registrat">
        <a href="../Vista/login.vista.php">Torna</a>

        <span class="error">
		<?php if(!isset($error)){
		$error;
	        }else{echo $error;}?>
	</span> 
    </form>
    </div></div>

</body>
</html>