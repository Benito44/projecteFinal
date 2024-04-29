<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    </style>
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
                <form action="../Controlador/perfil.php" id="form2" method="post">
                    Contrasenya actual
                    <input type="password" name="actual" id="actual"><br><br>

                    Nova Contrasenya
                    <input type="password" name="nova_contrasenya" id="nova_contrasenya"><br><br>

                    Torna a posar la contrasenya
                    <input type="password" name="nova_contrasenya2" id="nova_contrasenya2"><br><br>
                    <input type="submit" value="Login">
                </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                <button id="eliminarCompte">Eliminar Compte</button>
                </div>
            </div>
            <dialog id="createEventDialog" class="dialeg">
                <form action="../Controlador/perfil.php" id="form2" method="post">
                    Email
                    <input type="email" name="email_eliminar" id="email_eliminar"><br><br>
                    <input type="submit" value="Login">
                </form>
                    <button id="closeCreateEventDialog">Cerrar</button>
                </dialog>
        </div>
    </div>
</div>
<script>
            const createEventDialog = document.getElementById('createEventDialog');
            const openCreateEventFormButton = document.getElementById('eliminarCompte');
            const cerrar_boton = document.getElementById('closeCreateEventDialog');

            openCreateEventFormButton.addEventListener('click', function() {
                createEventDialog.showModal();
            });
            cerrar_boton.addEventListener('click', function() {
                createEventDialog.close();
            });
    </script>
</body>
</html>
