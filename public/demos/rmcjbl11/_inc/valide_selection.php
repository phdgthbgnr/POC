<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

require('utilsggd.php');
require('connect.php');

$result=array();
$res=array();
$resp = 'ok';

session_start();
$token=$_SESSION['token'];

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  //if(@isset($_SERVER['HTTP_REFERER']) && preg_match("/servermac.local/", $_SERVER['HTTP_REFERER'])){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/entertainmentggd.com/", $_SERVER['HTTP_REFERER']) || preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.30/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
    if($_POST){

      if(!isset($_POST['formation']) || !isset($_POST['gard']) || !isset($_POST['mildef']) || !isset($_POST['miloff']) || !isset($_POST['deflat']) || !isset($_POST['defcent']) || !isset($_POST['attaq'])){
        array_push($result,'selection invalide');
        //echo json_encode($result);
        //exit();
      }

      if(!is_array($_POST['gard']) || !is_array($_POST['mildef']) || !is_array($_POST['miloff']) || !is_array($_POST['deflat']) || !is_array($_POST['defcent']) || !is_array($_POST['attaq'])){
        array_push($result,'format selection invalide');
        //echo json_encode($result);
        //exit();
      }

      $formation = $_POST['formation'];

      $formation = intval($formation);

      if($formation != 442 && $formation != 4132 && $formation != 433){
        array_push($result,'formation invalide');
      }



      if(isset($_POST['token']) && $_POST['token']==$token && count($result)==0){
          $mycook = unserialize($_COOKIE['rmcjbl11liste']);
          $tokenid = $mycook['token'];
          $idj = 0;
          //$sv = tokenFromDb($tokenid);
          $conn = new connect();
          $ret = 0;
          $sql = "SELECT id_joueurs FROM $conn->tb3 WHERE tokenid='$tokenid'";
          $query = $conn->execute_query($sql);
          if($query){
            $nbrows = mysql_num_rows($query);
            if($nbrows > 0){
              $ret =  mysql_result($query,0);
            }
          }
          $sv = $ret;

          // insertion
          if($sv == 0){
            $sql = "INSERT INTO $conn->tb3 (
              tokenid
            ) VALUES (
              '$tokenid'
            )";
            $query = $conn->execute_query($sql);
            if($query) $idj = mysql_insert_id();
          }else{
            $idj = $sv;
          }

          if($idj != 0){
            // gardiens
            $tokens = md5(uniqid(rand(), true)); // to
            $mycook['tokenshare'] = $tokens;
            $mycook['idjoueur'] = $idj;
            setcookie('rmcjbl11liste', serialize($mycook), time()+60*60*24*30, '/');
            foreach ($_POST['gard'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                formation,
                id_gardiens,
                token_s
              ) VALUES (
                '$idj',
                '$formation',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement gardiens');
                //exit();
              }
            }


            // defenseurs
            foreach ($_POST['defcent'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                formation,
                id_defenseursc,
                token_s
              ) VALUES (
                '$idj',
                '$formation',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement defenseurs centraux');
                //exit();
              }
            }

            // defenseurs
            foreach ($_POST['deflat'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                formation,
                id_defenseursl,
                token_s
              ) VALUES (
                '$idj',
                '$formation',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement defenseurs lateraux');
                //exit();
              }
            }

            // milieux defensifs
            foreach ($_POST['mildef'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                formation,
                id_milieuxd,
                token_s
              ) VALUES (
                '$idj',
                '$formation',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement milieux defensifs');
                //exit();
              }
            }

            // milieux defensifs
            foreach ($_POST['miloff'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                formation,
                id_milieuxo,
                token_s
              ) VALUES (
                '$idj',
                '$formation',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement milieux offensifs');
                //exit();
              }
            }

            // attaquants
            foreach ($_POST['attaq'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                formation,
                id_attaquants,
                token_s
              ) VALUES (
                '$idj',
                '$formation',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement attaquants');
                //exit();
              }
            }

          // match width dream team id_dt_slc
          /*
          $sql="SELECT id_dt_slc FROM $conn->tb6
            WHERE (id_gardiens_slc, id_defenseursc_slc, id_defenseursl_slc, id_milieuxd_slc, id_milieuxo_slc, id_attaquants_slc) IN (
            SELECT  id_gardiens, id_defenseursc, id_defenseursl, id_milieuxd, id_milieuxo, id_attaquants FROM $conn->tb4 WHERE id_joueurs='$idj' AND formation='$formation' AND token_s='$tokens')";
*/

            $sql="SELECT id_dt_slc FROM $conn->tb6
            LEFT JOIN $conn->tb4
            ON id_gardiens=id_gardiens_slc AND id_defenseursc=id_defenseursc_slc AND id_defenseursl=id_defenseursl_slc AND id_milieuxd=id_milieuxd_slc AND id_milieuxo=id_milieuxo_slc AND id_attaquants=id_attaquants_slc
            WHERE id_joueurs='$idj'  AND formation='$formation' AND token_s='$tokens'";


            /*
            WHERE (formation_dt, id_gardiens_slc, id_defenseursc_slc, id_defenseursl_slc, id_milieuxd_slc, id_milieuxo_slc, id_attaquants_slc)  IN (
            SELECT  formation, id_gardiens, id_defenseursc, id_defenseursl, id_milieuxd, id_milieuxo, id_attaquants FROM $conn->tb4 WHERE id_joueurs='$idj' AND formation='$formation' AND token_s='$tokens')";
            */

          $query = $conn->execute_query($sql);
          if($query){
            $res = array();
            $temp = array();
            if(mysql_num_rows($query)>0){
              while ($arr= mysql_fetch_assoc($query)){
                foreach($arr as $key => $val){
                    array_push($res,'id_'.$val);
                    array_push($temp, $val);
                }
              }

              $class = array_count_values($res);
              $class2 = array_count_values($temp);
              uasort($class, 'cmp');
              uasort($class2, 'cmp');

              $keys = array_keys($class2);
              $idt = $keys[0];
              $result = array();
              $sql = "SELECT nom_dt FROM $conn->tb5 WHERE id_dt='$idt'";
              $query = $conn->execute_query($sql);
              if($query){
                $nom = mysql_result($query,0);
                $result['nom'] = $nom;
              }
              $result['iddt'] = $idt;
              $result['rank'] = $class;
              $result['idjoueur'] = $idj;
              $result['tokenshare'] = $tokens;
            }
          }else{
            array_push($result,'erreur calcul ressemblance');
            //exit();
          }

          }else{
              array_push($result,'id joueurs non conforme');
              //exit();
          }

      }

    }
  }
}

//$conn->close_db();
echo json_encode($result);

/*
function tokenFromDb($t){
  $conn2 = new connect();
  $ret = 0;
  $sql = "SELECT id_joueurs FROM $conn2->tb3 WHERE tokenid='$t'";
  $query = $conn2->execute_query($sql);
  if($query){
    $nbrows = mysql_num_rows($query);
    if($nbrows > 0){
      $ret =  mysql_result($query,0);
    }
  }
  //$conn2->close_db();
  return $ret;
}
*/


function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}

?>
