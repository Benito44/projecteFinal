<?php


ob_start(); // Start output buffering
require '../vendor/autoload.php';
require '../Model/mainfunction.php'; 

$config = [
    'callback' => 'http://bmartinez2.dawprojectes.sapalomera.cat/Controlador/github.php',

    'keys' => ['id' => 'Ov23lijKPpfqthUlYDif', 'secret' => '2eb3ff7700df8d748c31ddb1852a9a676d24cf19'],
];

try {
    $adapter = new Hybridauth\Provider\Github($config);

    $adapter->authenticate();
    // Usuari i email de l'autentificació
    $tokens = $adapter->getAccessToken();
    $userProfile = $adapter->getUserProfile();
    $usuari = $userProfile->displayName;
    $email = $userProfile->email;

     try {
      if (comprovarEmail($email)) {
        $error = "L'email ja està registrat";
        $usuari = encontrarPorEmail($email);
        $_SESSION['usuario'] = $usuari;
        $_SESSION['email'] = $email;
        header("Location: ./mostrar.projectes.php");
        exit; // Ensure script stops after redirection
      }else{
        insertar_usuari_Oauth2($usuari, $email);
        $_SESSION['usuario'] = $usuari;
        $_SESSION['email'] = $email;
        header("Location: ./mostrar.projectes.php");
        exit; // Ensure script stops after redirection
      }
      }catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
      
    $adapter->disconnect();
} catch (Exception $e) {
    echo $e->getMessage();
}
ob_end_flush(); // Flush the output buffer
?>