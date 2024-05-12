<?php

require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function connexio(){
    $dbname = 'projecte';
    $username = 'root';
    $password = 'final';
    $connexio = new PDO("mysql:host=db;dbname=$dbname", $username, $password);
    return $connexio;
}
function phphmailer($nom, $adreca, $text) {
    $mail = new PHPMailer(true);
    try {
      $nom; $adreca;
      // Canviar les opcions del SMTP
      $mail->SMTPDebug =0;
      $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );                      
      $mail->isSMTP();                                            //Enviar utilitzant SMTP
      $mail->Host       = 'smtp.gmail.com';                    
      $mail->SMTPAuth   = true;                                   //Activem l'autenticació SMTP
      $mail->Username   = 'xamppbmartinez@gmail.com';                     //Email on creem la clau
      $mail->Password   = 'jvrg fwih oxgm ncwm';                          //Clau d'acces
      $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    // Utilitzem el port 587
    
      //Recipients
      $mail->setFrom('xamppbmartinez@gmail.com', $nom); 
      $mail->addAddress($adreca);     
    
      //Content
      $mail->isHTML(true); //Enviar l'email en format HTML
      $mail->Subject = 'Projecte Compartit'; // Assumpte
      $mail->Body    = $text;  
    
      $mail->send(); // Enviem l'email
    } catch (Exception $e) {
      // Si hi ha cap error ens mostrarà el tipus d'error que sigui
      
    }
  }

  $dbname = 'projecte';
  $username = 'root';
  $password = 'final';
  $connexio = new PDO("mysql:host=db;dbname=$dbname", $username, $password);

$now = date('Y-m-d H:i:s');
$statement = $connexio->prepare("SELECT * FROM calendari WHERE inici BETWEEN :now AND DATE_ADD(:now, INTERVAL 1 HOUR)");
$statement->bindParam(':now', $now);
$statement->execute();
$eventos = $statement->fetchAll(PDO::FETCH_ASSOC);

// Iterar sobre los eventos y enviar correos electrónicos
foreach ($eventos as $evento) {
    $destinatario = $evento['email']; // Suponiendo que hay un campo 'email' en tu tabla de eventos
    $asunto = 'Recordatorio de evento próximo';
    $mensaje = 'Tienes un evento próximo: ' . $evento['titol'] . ' el ' . $evento['inici'];
    phphmailer($asunto, 'b.martinez2@sapalomera.cat', $mensaje);
}
?>