<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuari</title>
    <link rel="stylesheet" href="../Model/formulari.css">

</head>
<body>
    <h1>Recuperar contrasenya</h1>
    <form action="../Controlador/recupera_contra.php" id="form" method="post">
        Email
        <input type="email" id="contra" name="contra" placeholder="Email"><br><br>
        <input type="submit" value="Registrat">
        <a href="../Controlador/index.logat.php">Torna</a>

        <span class="error">
		<?php if(!isset($error)){
		$error;
	        }else{echo $error;}?>
	</span> 
    </form>
    

</body>
</html>