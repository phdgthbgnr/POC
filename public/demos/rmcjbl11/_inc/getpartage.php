<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

session_start();
$tokenj=$_SESSION['tokenj'];

header('Content-Type: application/json charset=utf-8');
require('utilsggd.php');
require('connect.php');

$result = array();
$gardiens = array();
$defenseurs = array();
$milieux = array();
$attaquants = array();

$id = 0;
$tokens = '';

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/entertainmentggd.com/", $_SERVER['HTTP_REFERER']) || preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.60/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
    if($_POST){
      if(isset($_POST['token']) && $_POST['token']==$tokenj){

        if(isset($_POST['id'])) $id = protect($_POST['id']);
        if(isset($_POST['tokens'])) $tokens = protect($_POST['tokens']);

        if($id != 0 && !empty($tokens)){
          $conn = new connect();
          $sql = "SELECT * FROM $conn->tb4 WHERE id_joueurs='$id' AND token_s='$tokens'";
          $query = $conn->execute_query($sql);
          if($query){
            if(mysql_num_rows($query)>0){
              while($arr = mysql_fetch_array($query)){
                if($arr['id_gardiens'] !=0 ) array_push($gardiens, $arr['id_gardiens']);
                if($arr['id_defenseurs'] !=0 ) array_push($defenseurs, $arr['id_defenseurs']);
                if($arr['id_milieux'] !=0 ) array_push($milieux, $arr['id_milieux']);
                if($arr['id_attaquants'] !=0 ) array_push($attaquants, $arr['id_attaquants']);
              }
            }
            $result['gardiens'] = $gardiens;
            $result['defenseurs'] = $defenseurs;
            $result['milieux'] = $milieux;
            $result['attaquants'] = $attaquants;

          }
        }

      }
    }
  }
}

echo json_encode($result);

?>
