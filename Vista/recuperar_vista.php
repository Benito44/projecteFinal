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
    <form action="../Controlador/canviar_contra.php" id="form" method="post">
        Contrasenya
        <input type="password" id="contra" name="contra" placeholder="Usuari1@1234"><br><br>
        Torna a posar la contrasenya
        <input type="password" id="contra2" name="contra2" placeholder="Usuari1@1234"><br><br>

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