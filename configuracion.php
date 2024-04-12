<?php

  require '../vendor/autoload.php';
  $clientID = '212855023826-2h5jq7reovdeva6m6e6ourdlbc067c4t.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/Backend/UF2/pt05/Controlador/controlargoogle.php';

  // create Client Request to access Google API
  $client = new Google\Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");


?>  