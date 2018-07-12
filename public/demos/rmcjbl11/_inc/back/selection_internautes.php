<?php
header('Content-Type: application/json charset=utf-8');
require('connect.php');
$conn = new connect();

$gardiens = array();
$defenseurs = array();
$milieux = array();
$attaquants = array();

session_start();
$token=$_SESSION['token'];

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.30/", $_SERVER['HTTP_REFERER']) || preg_match("/votre11bleu.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
  //if(@isset($_SERVER['HTTP_REFERER']) && preg_match("/servermac.local/", $_SERVER['HTTP_REFERER'])){
    if($_POST){
      if(isset($_POST['token']) && $_POST['token']==$token){

        // VERSION AVEC LES VUES

        $sql ="SELECT gardiens FROM choixgardiens ORDER BY counts DESC LIMIT 3";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($gardiens, $arr['gardiens']);
        }


        $sql ="SELECT defenseurs FROM choixdefenseurs ORDER BY counts DESC LIMIT 8";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($defenseurs, $arr['defenseurs']);
        }


        $sql ="SELECT milieux FROM choixmilieux ORDER BY counts DESC LIMIT 6";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($milieux, $arr['milieux']);
        }

        $sql ="SELECT attaquants FROM choixattaquants ORDER BY counts DESC LIMIT 6";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($attaquants, $arr['attaquants']);
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
          */
        }
      }
    }
  }

$conn->close_db();

$result['gardiens'] = $gardiens;
$result['defenseurs'] = $defenseurs;
$result['milieux'] = $milieux;
$result['attaquants'] = $attaquants;

echo json_encode($result);

?>
