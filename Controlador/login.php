<?php
session_start();
include '../Model/mainfunction.php';
include  '../Vista/login.vista.php';
$error = "";
$intents = 0;
// Sel·leccionem els intents de cada usuari, els modifiquem cada vegada que s'equivoquen i si els seus intents són més de dos sortirà el captcha per verificar
if (isset($_POST['usuari']) ||isset($_POST['contra']) ) {
  $usuari = $_POST['usuari'];
  $contra = $_POST['contra'];
  intents($usuari, $contra);
  }

  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    if ($usuari != $row["usuari"] || $_POST['usuari'] == "" || (!password_verify($contra,$row["contrasenya"]))){
      $error = "No s'ha posat l'usuari o la contrasenya correctament";
      include  '../Vista/login.vista.php';
    } else if (($usuari == $row["usuari"] && (password_verify($contra,$row["contrasenya"])))){
        $_SESSION['usuari'] = $usuari;
        $_SESSION['contra'] = $contra;
        include 'index.logat.php';
      } 
  }


?>