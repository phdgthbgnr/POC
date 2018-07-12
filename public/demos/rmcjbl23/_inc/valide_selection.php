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
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.60/", $_SERVER['HTTP_REFERER']) || preg_match("/votrelistedes23.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
    if($_POST){

      if(!isset($_POST['gardiens']) || !isset($_POST['milieux']) || !isset($_POST['defenseurs']) || !isset($_POST['attaquants'])){
        array_push($result,'selection invalide');
        //exit();
      }

      if(!is_array($_POST['gardiens']) || !is_array($_POST['milieux']) || !is_array($_POST['defenseurs']) || !is_array($_POST['attaquants'])){
        array_push($result,'format selection invalide');
        //exit();
      }

      if(isset($_POST['token']) && $_POST['token']==$token && count($result)==0){
          $mycook = unserialize($_COOKIE['rmcjbl23x']);
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
            setcookie('rmcjbl23x', serialize($mycook), time()+60*60*24*30, '/');
            foreach ($_POST['gardiens'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                id_gardiens,
                token_s
              ) VALUES (
                '$idj',
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
            foreach ($_POST['defenseurs'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                id_defenseurs,
                token_s
              ) VALUES (
                '$idj',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement defenseurs');
                //exit();
              }
            }

            // milieux
            foreach ($_POST['milieux'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                id_milieux,
                token_s
              ) VALUES (
                '$idj',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement milieux');
                //exit();
              }
            }

            // attaquants
            foreach ($_POST['attaquants'] as $val) {
              $sql = "INSERT INTO $conn->tb4 (
                id_joueurs,
                id_attaquants,
                token_s
              ) VALUES (
                '$idj',
                '$val',
                '$tokens'
              )";
              $query = $conn->execute_query($sql);
              if(!$query){
                array_push($result,'erreur enregistrement attaquants');
                //exit();
              }
            }

          // match width dream team
          $sql="SELECT id_dt_slc FROM dreamteam_selection
            WHERE (id_gardiens_slc, id_defenseurs_slc, id_milieux_slc, id_attaquants_slc)  IN (
            SELECT  id_gardiens, id_defenseurs, id_milieux, id_attaquants FROM selections WHERE id_joueurs='$idj')";

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


function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}

?>
