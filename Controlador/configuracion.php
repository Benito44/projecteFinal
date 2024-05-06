<?php

  require '../vendor/autoload.php';
  $clientID = '344337029532-s0h7j1ph9le0h5gdp8thm2435k01e8ag.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/Controlador/controlargoogle.php';

  // create Client Request to access Google API
  $client = new Google\Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");


?>  