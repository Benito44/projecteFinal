<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inici de Sessió</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-E1OJduYUwdi5wPTrG5nPtf/sq+xeIePuAGeZCrBJBL3TweNf7OMet/UHxRy/2j1JMsc2HTv+2+prAouTlJLing==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
        <div class="form-container">
            <h1>Login</h1>
            <form action="../Controlador/login.php" id="form" method="post">
                <label for="email">Correu Electronic</label>
                <input type="text" id="email" name="email" placeholder="Email"><br><br>
                <label for="contra">Contrasenya</label>
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
                            <a href="../Controlador/github.php" class="btn btn-primary btn-login text-uppercase fw-bold"><i class="fab fa-github"></i> Github</a>
                        </div>
                    </div>
                </div>
                <div class="enlace">
                    <a href="../Controlador/recupera_contra.php" class="btn btn-danger btn-login text-uppercase fw-bold">Recupera la contrasenya</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
