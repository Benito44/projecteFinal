<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perfil
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <form action="../Controlador/perfil.php" id="form" method="post">
                    Usuari
                    <input type="text" id="usuario" name="usuario" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>"><br><br>
                    Email
                    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"><br><br>
                    <input type="submit" value="Login">
                </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    Contra
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    Eliminar cuenta
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
