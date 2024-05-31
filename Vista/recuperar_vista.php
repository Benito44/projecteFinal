<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contrasenya</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <main>
        <div class="form-container">
            <h1>Recuperar Contrasenya</h1>
            <form action="../Controlador/recupera_contra.php" id="form" method="post">
                <label for="email">Correu Electronic</label>
                <input type="email" id="email" name="email" placeholder="Email">
                <input type="submit" value="Recuperar">
                <a href="../Vista/login.vista.php">Torna</a>
                <span class="error">
                    <?php if (isset($error)) { echo $error; } ?>
                </span>
            </form>
        </div> 
    </main>
</body>
</html>
