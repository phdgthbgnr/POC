<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
header('Content-Type: application/json charset=utf-8');
require('connect.php');
$conn = new connect();
$result = array();

$gardiens     = array();
$defenseursc  = array();
$defenseursl  = array();
$milieuxd     = array();
$milieuxo     = array();
$attaquants   = array();
$total = 0;
$totgard = 0;
$totdef = 0;
$totmil = 0;
$totatt = 0;

$totdefc = 0;
$totdefl = 0;
$totmilo = 0;
$totmild = 0;


session_start();
$token=$_SESSION['token'];

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/entertainmentggd.com/", $_SERVER['HTTP_REFERER']) || preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.30/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
  //if(@isset($_SERVER['HTTP_REFERER']) && preg_match("/servermac.local/", $_SERVER['HTTP_REFERER'])){
    if($_POST){
      if(isset($_POST['token']) && $_POST['token']==$token){

        if(isset($_POST['formation'])){ // pas utilisé

          $formations = 0;

          $sql = "SELECT formation FROM $conn->vw280 ORDER BY counts DESC limit 1";
          $query = $conn->execute_query($sql);
          if($query){
              $formations = mysql_result($query,0);
          }

          //print_r($formation);
          //$formation = $_POST['formation'];

          $formation = intval($formations);

          if($formation != 442 && $formation != 4132 && $formation != 433){
            array_push($result,'formation invalide');
            echo json_encode($result);
            exit();
          }

          $limimd = 2;
          $limimo = 2;
          $limatt = 2;

          switch ($formation) {

            case 433:

              $tablegard = $conn->vw13;
              $tabledefcent = $conn->vw14;
              $tabledeflat = $conn->vw15;
              $tablemild = $conn->vw16;
              $tablemilo = $conn->vw17;
              $tableatt = $conn->vw18;

              $tbtotgard = $conn->vw243;
              $tbtotdef = $conn->vw253;
              $tbtotmil = $conn->vw263;
              $tbtotatt = $conn->vw273;

              $tbtotdefc = $conn->vw303;
              $tbtotdefl = $conn->vw403;
              $tbtotmilo = $conn->vw503;
              $tbtotmild = $conn->vw603;

              $limimd = 1;
              $limatt = 3;
              break;

            case 442:

              $tablegard = $conn->vw1;
              $tabledefcent = $conn->vw2;
              $tabledeflat = $conn->vw3;
              $tablemild = $conn->vw4;
              $tablemilo = $conn->vw5;
              $tableatt = $conn->vw6;

              $tbtotgard = $conn->vw241;
              $tbtotdef = $conn->vw251;
              $tbtotmil = $conn->vw261;
              $tbtotatt = $conn->vw271;

              $tbtotdefc = $conn->vw301;
              $tbtotdefl = $conn->vw401;
              $tbtotmilo = $conn->vw501;
              $tbtotmild = $conn->vw601;

              break;

            case 4132:

              $tablegard = $conn->vw7;
              $tabledefcent = $conn->vw8;
              $tabledeflat = $conn->vw9;
              $tablemild = $conn->vw10;
              $tablemilo = $conn->vw11;
              $tableatt = $conn->vw12;

              $tbtotgard = $conn->vw242;
              $tbtotdef = $conn->vw252;
              $tbtotmil = $conn->vw262;
              $tbtotatt = $conn->vw272;

              $tbtotdefc = $conn->vw302;
              $tbtotdefl = $conn->vw402;
              $tbtotmilo = $conn->vw502;
              $tbtotmild = $conn->vw602;

              $limimd = 1;
              $limimo = 3;

              break;
          }

        // VERSION AVEC LES VUES

          $sql ="SELECT id_gardiens,counts FROM $tablegard ORDER BY counts DESC LIMIT 1";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($gardiens, array($arr['id_gardiens'], $arr['counts']));

          }

          $sql ="SELECT id_defenseursc,counts FROM $tabledefcent ORDER BY counts DESC LIMIT 2";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($defenseursc, array($arr['id_defenseursc'], $arr['counts']));

          }

          $sql ="SELECT id_defenseursl,counts FROM $tabledeflat ORDER BY counts DESC LIMIT 2";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($defenseursl, array($arr['id_defenseursl'], $arr['counts']));

          }

          $sql ="SELECT id_milieuxd,counts FROM $tablemild ORDER BY counts DESC LIMIT $limimd";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($milieuxd, array($arr['id_milieuxd'], $arr['counts']));
          }

          $sql ="SELECT id_milieuxo,counts FROM $tablemilo ORDER BY counts DESC LIMIT $limimo";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($milieuxo, array($arr['id_milieuxo'], $arr['counts']));
          }

          $sql ="SELECT id_attaquants,counts FROM $tableatt ORDER BY counts DESC LIMIT $limatt";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($attaquants, array($arr['id_attaquants'], $arr['counts']));
          }
          /*
          $sql = "SELECT counts from $conn->vw19";
          $query = $conn->execute_query($sql);
          if($query){
            $total = mysql_result($query,0);
          }
          */
          $sql = "SELECT counta from $tbtotgard";
          $query = $conn->execute_query($sql);
          if($query){
            $totgard = mysql_result($query,0);
          }

          $sql = "SELECT counta from $tbtotdefc";
          $query = $conn->execute_query($sql);
          if($query){
            $totdefc = mysql_result($query,0);
          }

          $sql = "SELECT counta from $tbtotdefl";
          $query = $conn->execute_query($sql);
          if($query){
            $totdefl = mysql_result($query,0);
          }

          $sql = "SELECT counta from $tbtotmilo";
          $query = $conn->execute_query($sql);
          if($query){
            $totmilo = mysql_result($query,0);
          }

          $sql = "SELECT counta from $tbtotmild";
          $query = $conn->execute_query($sql);
          if($query){
            $totmild = mysql_result($query,0);
          }


          /*
          $sql = "SELECT counta from $tbtotdef";
          $query = $conn->execute_query($sql);
          if($query){
            $totdef = mysql_result($query,0);
          }

          $sql = "SELECT counta from $tbtotmil";
          $query = $conn->execute_query($sql);
          if($query){
            $totmil = mysql_result($query,0);
          }
          */

          $sql = "SELECT counta from $tbtotatt";
          $query = $conn->execute_query($sql);
          if($query){
            $totatt = mysql_result($query,0);
          }

        }

        // VERSION SANS LES VUES
          /*
          $sql = "SELECT id_gardiens, COUNT(id_gardiens) count FROM $conn->tb4 WHERE id_gardiens<>0 GROUP BY id_gardiens ORDER BY count DESC LIMIT 3";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($gardiens, $arr['id_gardiens']);
          }


          $sql = "SELECT id_defenseurs, COUNT(id_defenseurs) count FROM $conn->tb4 WHERE id_defenseurs<>0 GROUP BY id_defenseurs ORDER BY count DESC LIMIT 8";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($defenseurs, $arr['id_defenseurs']);
          }

          $sql = "SELECT id_milieux, COUNT(id_milieux) count FROM $conn->tb4 WHERE id_milieux<>0 GROUP BY id_milieux ORDER BY count DESC LIMIT 6";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($milieux, $arr['id_milieux']);
          }

          $sql = "SELECT id_attaquants, COUNT(id_attaquants) count FROM $conn->tb4 WHERE id_attaquants<>0 GROUP BY id_attaquants ORDER BY count DESC LIMIT 6";
          $query = $conn->execute_query($sql);

          while ($arr= mysql_fetch_array($query)){
            array_push($attaquants, $arr['id_attaquants']);
          }


          SELECT count(id_selection) AS counta FROM rmc11_selections WHERE id_defenseursc <> 0 OR id_defenseursl <> 0

          SELECT count(id_selection) AS counta FROM rmc11_selections WHERE id_milieuxd <> 0 OR id_milieuxo <> 0

          SELECT count(id_selection) AS counta FROM rmc11_selections WHERE id_gardiens <> 0

          SELECT count(id_selection) AS counta FROM rmc11_selections WHERE id_attaquants <> 0

          */

        }
      }
    }
  }

$conn->close_db();

$result['formation'] = $formations;
$result['gardiens'] = $gardiens;
$result['defenseursc'] = $defenseursc;
$result['defenseursl'] = $defenseursl;
$result['milieuxd'] = $milieuxd;
$result['milieuxo'] = $milieuxo;
$result['attaquants'] = $attaquants;
$result['totalgard'] = $totgard;
$result['totaldefc'] = $totdefc;
$result['totaldefl'] = $totdefl;
$result['totalmilo'] = $totmilo;
$result['totalmild'] = $totmild;
$result['totalatt'] = $totatt;

echo json_encode($result);

?>
