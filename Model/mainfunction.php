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
    $password = '';
    $connexio = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
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
 * borrarArticles
 * Borrem els articles depenent de l'id de l'usuari
 * @param  mixed $id
 * @param  mixed $usuari_id
 * @return void
 */
function borrarArticles($id, $usuari_id){
    $connexio = connexio();
    $statement = $connexio->prepare("DELETE FROM articles WHERE id = ? AND usuari_id = ?");
    $statement->bindParam(1,$id);
    $statement->bindParam(2,$usuari_id);
    $statement->execute();
}
/**
 * seleccionarArticles
 * Sel·leccionem tots els articles de l'usuari 
 * @param  mixed $usuari_id
 * @return void
 */
function seleccionarArticles($usuari_id){
    $connexio = connexio();
    $statement = $connexio->prepare("SELECT * FROM articles WHERE usuari_id = ?");
    $statement->bindParam(1,$usuari_id);
    $statement->execute();
    echo '<section><ul>';
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo '<li>' . $row["id"] . " - " . $row["article"] . '</li>';
    }
    echo '</ul></section>';
 } 
 /**
  * insertartArticles
  * Insertem els articles depenent de l'id de l'usuari on abans verifiquem que l'article no estigui repetit 
  * @param  mixed $article
  * @param  mixed $usuari_id
  * @return void
  */
 function insertartArticles($article,$usuari_id){
    $connexio = connexio();
    if ($article != null) {
        $existingArticleQuery = $connexio->prepare("SELECT COUNT(*) FROM articles WHERE article = ? AND usuari_id = ?");
        $existingArticleQuery->bindParam(1, $article);
        $existingArticleQuery->bindParam(2, $usuari_id);
        $existingArticleQuery->execute();
        $existingArticleCount = $existingArticleQuery->fetchColumn();
    
        if ($existingArticleCount == 0) {
            // L'article no existeix, ho insertem
            $insertStatement = $connexio->prepare("INSERT INTO articles (article, usuari_id) VALUES (?, ?)");
            $insertStatement->bindParam(1, $article);
            $insertStatement->bindParam(2, $usuari_id);
            $insertStatement->execute();
            $_POST['article'] = null;
        } else {
            echo "L'article ja existeix.";
        }
    }
 } 
 /**
  * intents
  * Sel·leccionem els intents de cada usuari, els modifiquem cada vegada que s'equivoquen i si els seus intents són més de dos sortirà el captcha per
  * verificar
  * @param  mixed $usuari
  * @param  mixed $contra
  * @return void
  */
 function intents($usuari, $contra){
    $error = "";
    $connexio_real = connexio();
    $statement = $connexio_real->prepare("SELECT intents FROM usuaris WHERE usuari = ?");
    $statement->bindParam(1, $usuari);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $intents = $row["intents"];
    }
    $statement = $connexio_real->prepare("SELECT * FROM usuaris WHERE usuari = ?");
    $statement->bindParam(1, $usuari);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        if ($usuari != $row["usuari"] || !isset($_POST['usuari']) || (!password_verify($contra, $row["contrasenya"]))) {
            $error = "No s'ha posat l'usuari o la contrasenya correctament";
            $intents = $intents + 1; 
            $connexio_real = connexio();
            $statement = $connexio_real->prepare("UPDATE usuaris SET intents = ? WHERE usuari = ?");
            $statement->bindParam(1, $intents);
            $statement->bindParam(2, $usuari);
            $statement->execute();
        } if ($intents > 2) {
        $statement = $connexio_real->prepare("UPDATE usuaris SET intents = 0 WHERE usuari = ?");
            $statement->bindParam(1, $usuari);
            $statement->execute();
            header('Location: ../Vista/captcha.php');
        } else if ($usuari == $row["usuari"] && (password_verify($contra, $row["contrasenya"]))) {
            $_SESSION['usuari'] = $usuari;
            $_SESSION['contra'] = $contra;
            $statement = $connexio_real->prepare("UPDATE usuaris SET intents = 0 WHERE usuari = ?");
            $statement->bindParam(1, $usuari);
            $statement->execute();
            header('Location: index.logat.php');
        }
    }
    }
/**
 * actualitzarArticles
 * Actulitzem els articles depenent de l'id de l'usuari
 * @param  mixed $article_nou
 * @param  mixed $id_vell
 * @param  mixed $usuari_id
 * @return void
 */
function actualitzarArticles($article_nou, $id_vell, $usuari_id) {
    $connexio = connexio();
    $statement = $connexio->prepare("UPDATE articles SET article=? WHERE id=? AND usuari_id= ?");
    $statement->bindParam(1,$article_nou);
    $statement->bindParam(2,$id_vell);
    $statement->bindParam(3,$usuari_id);
    $statement->execute();

}
/**
 * insertartUsuaris
 * Insertem els usuaris amb la seva contrasenya i l'email
 * @param  mixed $usuari
 * @param  mixed $email
 * @param  mixed $contra
 * @return void
 */
function insertartUsuaris($usuari, $email, $contra){
    $connexio_real = connexio();
    $statement = $connexio_real->prepare("INSERT INTO usuaris (usuari, email, contrasenya) VALUES (?,?,?)");
    $statement->bindParam(1,$usuari);
    $statement->bindParam(2,$email);
    $statement->bindParam(3,$contra);
    $statement->execute();
}
?>