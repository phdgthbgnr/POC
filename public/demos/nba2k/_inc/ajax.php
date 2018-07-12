<?php
session_start();
$token = 0;
if(isset($_SESSION['nba2ktoken'])) $token = $_SESSION['nba2ktoken'];

header('Content-Type: application/json charset=utf-8');

require('connect.php');


$res = array('reponse');

$nom = '';
$prenom = '';
$mail = '';
$reglement = 0;
$fbinscr = 0;

$quest1 = 0;
$quest2 = 0;
$quest3 = 0;

if($_POST){
	
	if(!preg_match("/servermac/",$_SERVER['SERVER_NAME'])){
        
        if(!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])){
            echo json_encode(array('reponse','captcha'));
            exit;
        }
        
    }
    
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //$headers = array("Authorization: Basic MzA0NzhjZDkxNjM4NGJkZTgwMjkzZWM0YjQ5NDYzODY6NTdhOTU3ODE5NWJiNDE5NDhhYmMwZWIzNWU0MmQ5Zjk=");
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        if(preg_match("/greengardendigital.com/",$_SERVER['SERVER_NAME'])){
            $secret = '6Leg5AYUAAAAAImeW0zpj1tpsggpe8Lk6LmryFtG';
        }
        
        if(preg_match("/jeu-concoursnba2kdev.2kweb.online/",$_SERVER['SERVER_NAME']) || preg_match("/jeu-concoursnba2ktest.2kweb.online/",$_SERVER['SERVER_NAME']) || preg_match("/jeu-concoursnba2kstg.2kweb.online/",$_SERVER['SERVER_NAME']) || preg_match("/jeu-concoursnba2k.com/",$_SERVER['SERVER_NAME'])){
            $secret = '6LdP6QYUAAAAAKjQ38Xh3UoeFbZLJD65tfMT_PY3';
        }
        
        $response = $_POST['g-recaptcha-response'];
                
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "secret=".$secret."&response=".$response."&remoteip=".$remoteip);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        if(!$ret=curl_exec($ch))
        {
            curl_close($ch);
            array_push($res,'captcha2');
        }else{
            curl_close($ch);
            //print_r($ret);
            $json = json_decode($ret);
            if (property_exists($json, "success")){
                if($json->success != true) array_push($res,'captcha3');
            }else{
                array_push($res,'captcha4');
            }
        }
        
        
    }

    if(isset($_POST['action']) && $_POST['action'] == 'inscription'){
        
       //if(isset($_POST['token']) && $token !=0 && $token == $_POST['token']){
        if(isset($_POST['token'])  && $token == $_POST['token']){
        
            if(isset($_POST['nom'])) $nom = protect($_POST['nom']);
            if(isset($_POST['prenom'])) $prenom = protect($_POST['prenom']);
            if(isset($_POST['mail'])) $mail = protect($_POST['mail']);

            if(isset($_POST['reglement'])) {
                $reglement = protect($_POST['reglement']);
                $reglement = intval($reglement);
            }

            if($reglement != 1) array_push($res,'reglement');

            if(empty($nom)) array_push($res,'nom');
            if(empty($prenom)) array_push($res,'prenom');
            if(empty($mail)) array_push($res,'mail1');

            if(valid_mail($mail) == false) array_push($res,'mail2');

            if(isset($_POST['quest1'])) $quest1 = protect($_POST['quest1']);
            if(isset($_POST['quest2'])) $quest2 = protect($_POST['quest2']);
            if(isset($_POST['quest3'])) $quest3 = protect($_POST['quest3']);

            $quest1 = intval($quest1);
            $quest2 = intval($quest2);
            $quest3 = intval($quest3);

            if(isset($_POST['fbinscr'])) $fbinscr = protect($_POST['fbinscr']);
            $fbinscr = intval($fbinscr);

        /*     
           if(!empty($mail)){

                $conn = new connect();
                $sql = "SELECT id from $conn->tb1 WHERE nba_mail='$mail' LIMIT 1";
                $query = $conn->execute_query($sql);
                if($query){
                    $nb = $query->num_rows;
                    if($nb>0) array_push($res,'mail3');
                }
                $conn->close_db();

            }
            */
           $fcmail = fencrypt($mail);
           
            if(count($res) == 1){

                $conn = new connect();
                $sql = "INSERT INTO $conn->tb1 (
                    quest1,
                    quest2,
                    quest3,
                    nba_nom,
                    nba_prenom,
                    nba_mail,
                    nba_reglement,
                    nba_facebook_inscr
                    ) VALUES (
                    '$quest1',
                    '$quest2',
                    '$quest3',
                    '$nom',
                    '$prenom',
                    '$fcmail',
                    '$reglement',
                    '$fbinscr' 
                )";

                $query = $conn->execute_query($sql);
                if($query){
                    array_push($res,'ok');
                }else{
                    array_push($res,'sql');
                }

            }
        }else{
             array_push($res,'unauthorized'.$token);
       }
        
    }
    
}

echo json_encode($res);





function protect($v){
    
	$v=trim($v);
	//si magic_quotes pas de caractere d'echappement
	$r=htmlspecialchars($v);
	if (get_magic_quotes_gpc()==1){
		$r=$r;
	}else{
		$r=addslashes($r);
	}
	//$r = filter_var($r,FILTER_SANITIZE_STRING);
	return $r;
    
}


function valid_mail($m){
    if (!empty ($m)) {
        if(!preg_match('!^[a-z0-9]+([\._-][a-z0-9]+)*@([a-z0-9]+[\._-])*[a-z0-9_-]{2,}\.[a-z]{2,}$!i', $m)){
	       return false;
        }else{
	       return true;
        }
    }
}


function fencrypt($text){

			# http://php.net/manual/fr/function.mcrypt-encrypt.php
      # la clé devrait être un binaire aléatoire, utilisez la fonction scrypt, bcrypt
      # ou PBKDF2 pour convertir une chaîne de caractères en une clé.
      # La clé est spécifiée en utilisant une notation héxadécimale.
      // $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
      //$key = pack('H*', "A7BS5UWXMfaYNz25JJ41mKcA26Diezu9:3dYunnT06gR2fV/kUfcC0mvzJVY43Kbc");
    
      $key = pack('H*', str_replace(' ', '', sprintf('%u', CRC32("A7BS5UWXMfaYNz25JJ41mKcA26Diezu9:3dYunnT06gR2fV/kUfcC0mvzJVY43Kbc"))));

      # Montre la taille de la clé utilisée ; soit des clés sur 16, 24 ou 32 octets pour
      # AES-128, 192 et 256 respectivement.
      $key_size =  strlen($key);

		  # Crée un IV aléatoire à utiliser avec l'encodage CBC
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

      # Crée un texte cipher compatible avec AES (Rijndael block size = 128)
      # pour conserver le texte confidentiel.
      # Uniquement applicable pour les entrées encodées qui ne se terminent jamais
      # pas la valeur 00h (en raison de la suppression par défaut des zéros finaux)
      $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
      $text, MCRYPT_MODE_CBC, $iv);

      # On ajoute à la fin le IV pour le rendre disponible pour le chiffrement
      $ciphertext = $iv . $ciphertext;

      # Encode le texte du cipher résultant pouvant être représenté ainsi sous forme de chaîne de caractères
      $ciphertext_base64 = base64_encode($ciphertext);
      return  $ciphertext_base64;
}



function fdecrypt($text){

	  // $key = pack('H*', "A7BS5UWXMfaYNz25JJ41mKcA26Diezu9:3dYunnT06gR2fV/kUfcC0mvzJVY43Kbc");
      $key = pack('H*', str_replace(' ', '', sprintf('%u', CRC32("A7BS5UWXMfaYNz25JJ41mKcA26Diezu9:3dYunnT06gR2fV/kUfcC0mvzJVY43Kbc"))));
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

      $ciphertext_dec = base64_decode($text);

      # Récupère le IV, iv_size doit avoir été créé en utilisant la fonction
      # mcrypt_get_iv_size()
      $iv_dec = substr($ciphertext_dec, 0, $iv_size);

    	# Récupère le texte du cipher (tout, sauf $iv_size du début)
      $ciphertext_dec = substr($ciphertext_dec, $iv_size);

      # On doit supprimer les caractères de valeur 00h de la fin du texte plein
      $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

      return  $plaintext_dec;
}


?>