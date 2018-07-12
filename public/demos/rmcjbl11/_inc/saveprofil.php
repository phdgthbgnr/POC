<?php
header('Content-Type: application/json charset=utf-8');

require('utilsggd.php');
require('connect.php');

session_start();
$token=$_SESSION['token'];

$result=array();

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/entertainmentggd.com/", $_SERVER['HTTP_REFERER']) || preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.30/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
    if($_POST){
      if(isset($_POST['token']) && $_POST['token']==$token){

          if(!isset($_POST['newsletter'])) array_push($result,'newsletter');
          if(!isset($_POST['offres'])) array_push($result,'offres');
          if(!isset($_POST['reglement'])) array_push($result,'reglement');

          if(isset($_POST['nom'])) $nom = protect($_POST['nom']);
          if(isset($_POST['prenom'])) $prenom = protect($_POST['prenom']);
          if(isset($_POST['email'])) $email = protect($_POST['email']);
          if(empty($nom)) array_push($result,'nom');
          if(empty($prenom)) array_push($result,'prenom');
          if(!valid_mail($email)) array_push($result,'email');

          $conn = new connect();
          if(!in_array('email',$result)){
            $sql = "SELECT id_particip FROM $conn->tb7 WHERE email='$email'";
            $query = $conn->execute_query($sql);
            if($query){
              $nb = mysql_num_rows($query);
              if($nb>0) array_push($result,'emailr');
            }
          }
          if(count($result)==0){

            $newsletter = protect($_POST['newsletter']);
            $offres = protect($_POST['offres']);
            $reglement = protect($_POST['reglement']);


            $idjoueur = 0 ;
            if(isset($_COOKIE['rmcjbl11liste']))
            $mycook = unserialize($_COOKIE['rmcjbl11liste']);
            if(isset($mycook['idjoueur']) && $mycook['idjoueur']!='') $idjoueur = $mycook['idjoueur'];
            $sql = "INSERT INTO $conn->tb7 (
              id_joueur,
              nom,
              prenom,
              email,
              newsletter,
              offres,
              reglement
            ) VALUES (
              '$idjoueur',
              '$nom',
              '$prenom',
              '$email',
              '$newsletter',
              '$offres',
              '$reglement'
            )";

            $query = $conn->execute_query($sql);
            if($query){
              $result = array('ok');
            }else{
              $result = array('sql');
            }

          }
      }
    }
  }
}

echo json_encode($result);

?>
