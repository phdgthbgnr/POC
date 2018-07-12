<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

require('utilsggd.php');
require('connect.php');

$result=array('ok');

session_start();
$token=$_SESSION['token'];
$idjoueur = 0;

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.30/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
    if($_POST){
      if(isset($_POST['token']) && $_POST['token']==$token){
        if(isset($_POST['idjoueur'])) $idjoueur = protect($_POST['idjoueur']);
          if($idjoueur != 0){
            $conn = new connect();
            $sql = "UPDATE $conn->tb3 SET nb_fb=nb_fb+1 WHERE id_joueurs='$idjoueur'";
            $query = $conn->execute_query($sql);
          }
      }
    }
  }
}

echo json_encode($result);
