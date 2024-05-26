<?php 
require '../src/PHPMailer.php';
require '../src/Exception.php';
require '../src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * phphmailer
 * Enviem l'email de recuperació de contrasenya
 * @param  mixed $nom
 * @param  mixed $adreca
 * @param  mixed $text
 * @return void
 */
if (!function_exists('phphmailer')) {
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
}

// Función para obtener el nombre del proyecto basado en su ID
function obtenerNombreProyecto($id) {
    $conn = connexio(); // Conexión a la base de datos

    // Consulta para obtener el nombre del proyecto
    $sql = "SELECT nom FROM projectes WHERE id = ?";
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Devolver el nombre del proyecto
    return $row['nom'];
}
/**
 * connexio
 * Retornem la connexió a la base de dades
 * @return object
 */
function connexio(){
    $dbname = 'projecte';
    $username = 'root';
    $password = 'final';
    $connexio = new PDO("mysql:host=db;dbname=$dbname", $username, $password);
    return $connexio;
}


/**
 * encontrarPorEmail
 *  Retornem l'usuari filtrant per l'email
 * @param  mixed $email
 * @return void
 */
function idUsuariPerEmail($email){
    $usuari = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT id FROM usuaris WHERE email = ?");
    $statement->bindParam(1,$email);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $usuari = $row["id"];
    }
    return $usuari;
}
/**
 * encontrarPorEmail
 *  Retornem l'usuari filtrant per l'email
 * @param  mixed $email
 * @return void
 */
function encontrarPorEmail($email){
    $usuari = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT usuari FROM usuaris WHERE email = ?");
    $statement->bindParam(1,$email);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $usuari = $row["usuari"];
    }
    return $usuari;
}
function encontrarPorUsuario($usuari){
    $id = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT id FROM usuaris WHERE usuari = ?");
    $statement->bindParam(1,$usuari);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $id = $row["id"];
    }
    return $id;
}
/**
 * usuari
 * Retornem l'id de l'usuari
 * @param  mixed $usuari
 * @return void
 */
function usuari($usuari){
    $usuari_id = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT usuari_id FROM usuaris WHERE usuari = ?");
    $statement->bindParam(1,$usuari);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $usuari_id = $row["usuari_id"];
    }
    return $usuari_id;
}

function usuariCompartit($usuari, $projecte) {
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT id FROM proyecto_usuario WHERE id_usuario = ? AND id_proyecto = ?");
    $statement->bindParam(1, $usuari);
    $statement->bindParam(2, $projecte);
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC) !== false;
}

/**
 * insertar_token
 * Retornem el token actualitzat a la base de dades filtrant amb l'email 
 * @param  mixed $token
 * @param  mixed $email
 * @param  mixed $temps
 * @return void
 */
function insertar_token($token,$email,$temps){
    
    $connexio = connexio();
    $statement = $connexio->prepare("UPDATE usuaris SET token=?,temps = ? WHERE email= ?");
    $statement->bindParam(1,$token);
    $statement->bindParam(2,$temps);
    $statement->bindParam(3,$email);
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $token = $row["token"];
    }
    return $token;
}
/**
 * insertar_usuari_Oauth2
 * Insertem els usuaris que s'autentifiquin amb Oauth2/HybridAuth
 * @param  mixed $usuari
 * @param  mixed $email
 * @return void
 */
function insertar_usuari_Oauth2($usuari, $email){
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("INSERT INTO usuaris (usuari, email) VALUES (?, ?)");
    $statement->bindParam(1, $usuari);
    $statement->bindParam(2, $email);
    $statement->execute();
}
function obtenerImagenPerfil($email) {
    $connexio = connexio();
    
    $statement = $connexio->prepare("SELECT imatge FROM usuaris WHERE email = ?");
    $statement->bindParam(1, $email);
    $statement->execute();
    
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Verificar si se encontró la imagen de perfil
    if ($resultado && isset($resultado['imatge']) && !empty($resultado['imatge'])) {
        return $resultado['imatge'];
    } else {
        return null;
    }
}

/**
 * comprovarEmail
 * Retornem l'email de l'usuari de la base de dades
 * @param  mixed $email
 * @return void
 */
function comprovarEmail($email){
    $email_registrat = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT email FROM usuaris WHERE email = ?");
    $statement->bindParam(1, $email);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $email_registrat = $row["email"];
    }
    return $email_registrat;
}
function encontrarContrasenya($email){
    $contrasenya = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT contrasenya FROM usuaris WHERE email = ?");
    $statement->bindParam(1, $email);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $contrasenya = $row["contrasenya"];
    }
    return $contrasenya;
}
/**
 * comprovarNom
 * Retornem el nom de l'usuari de la base de dades
 * @param  mixed $usuari
 * @return void
 */
function comprovarNom($usuari){
    $usuari_registrat = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT usuari FROM usuaris WHERE usuari = ?");
    $statement->bindParam(1, $usuari);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $usuari_registrat = $row["usuari"];
    }
    return $usuari_registrat;
}
/**
 * tempsPerEmail
 * Mirem el temps que queda perque el token expiri filtrant per l'email
 * @param  mixed $email
 * @return void
 */
function tempsPerEmail($email){
    $temps = "";
    $connexio = "";
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT temps FROM usuaris WHERE email = ?");
    $statement->bindParam(1,$email);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $temps = $row["temps"];
    }
    return $temps;
}
/**
 * actualitzarUsuari
 * Actualitzem la contrasenya de l'usuari
 * @param  mixed $contra
 * @param  mixed $usuari
 * @return void
 */
function actualitzarUsuari($contra, $usuari){
    $connexio_real = connexio();
    $statement = $connexio_real->prepare("UPDATE usuaris SET contrasenya = ? WHERE usuari = ?");
    $statement->bindParam(1, $contra);
    $statement->bindParam(2, $usuari);
    $statement->execute();
}

/**
 * borrarCompte
 *
 * @param  mixed $email
 * @return void
 */
function borrarCompte($email){
    $connexio = connexio();
    $statement = $connexio->prepare("DELETE FROM usuaris WHERE email = ?");
    $statement->bindParam(1,$email);
    $statement->execute();
}