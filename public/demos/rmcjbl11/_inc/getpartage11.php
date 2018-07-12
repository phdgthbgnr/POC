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
$defenseursl = array();
$defenseursc = array();
$milieuxd = array();
$milieuxo = array();
$attaquants = array();
$formation = '';

$id = 0;
$tokens = '';

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/entertainmentggd.com/", $_SERVER['HTTP_REFERER']) || preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.30/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
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
                if($arr['formation'] !=0 ) $formation = $arr['formation'];
                if($arr['id_gardiens'] !=0 ) array_push($gardiens, $arr['id_gardiens']);
                if($arr['id_defenseursc'] !=0 ) array_push($defenseursc, $arr['id_defenseursc']);
                if($arr['id_defenseursl'] !=0 ) array_push($defenseursl, $arr['id_defenseursl']);
                if($arr['id_milieuxd'] !=0 ) array_push($milieuxd, $arr['id_milieuxd']);
                if($arr['id_milieuxo'] !=0 ) array_push($milieuxo, $arr['id_milieuxo']);
                if($arr['id_attaquants'] !=0 ) array_push($attaquants, $arr['id_attaquants']);
              }
            }
            $result['gardiens'] = $gardiens;
            $result['defenseursl'] = $defenseursl;
            $result['defenseursc'] = $defenseursc;
            $result['milieuxd'] = $milieuxd;
            $result['milieuxo'] = $milieuxo;
            $result['attaquants'] = $attaquants;
            $result['formation'] = $formation;

          }
        }

      }
    }
  }
}

echo json_encode($result);

?>
