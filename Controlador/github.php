<?php
require '../vendor/autoload.php';
require '../Model/mainfunction.php'; 

$config = [
    'callback' => 'http://localhost/Controlador/github.php',

    'keys' => ['id' => '4afd805888fe944555b4', 'secret' => '5f1bf41dab685bc91c09a51cffaae3d3dc05e074'],
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
     if (comprovarEmail($email)){
        echo "L'email ja està registrat";
        $error =  "L'email ja està registrat";
        $usuari = encontrarPorEmail($email);
        $_SESSION['usuari'] = $usuari;
        header('Location: index.logat.php');

      }else{
        insertar_usuari_Oauth2($usuari, $email);
        $_SESSION['usuari'] = $usuari;
        header('Location: index.logat.php');
      }
      }catch(Exception $e) {
        echo "Error: " . $e->getMessage();
      }
      
    $adapter->disconnect();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>