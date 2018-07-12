<?php
header('Content-Type: application/json charset=utf-8');
require('connect.php');
$conn = new connect();

$gardiens = array();
$defenseurs = array();
$milieux = array();
$attaquants = array();
$total = 0;

session_start();
$token=$_SESSION['token'];

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
  if(@isset($_SERVER['HTTP_REFERER']) && (preg_match("/smeserver9/", $_SERVER['HTTP_REFERER']) || preg_match("/servermac.local/", $_SERVER['HTTP_REFERER']) || preg_match("/192.168.1.60/", $_SERVER['HTTP_REFERER']) || preg_match("/votrelistedes23.bfmtv.com/", $_SERVER['HTTP_REFERER']))){
  //if(@isset($_SERVER['HTTP_REFERER']) && preg_match("/servermac.local/", $_SERVER['HTTP_REFERER'])){
    if($_POST){
      if(isset($_POST['token']) && $_POST['token']==$token){

        // VERSION AVEC LES VUES

        $sql ="SELECT gardiens,counts FROM choixgardiens ORDER BY counts DESC LIMIT 3";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($gardiens, array($arr['gardiens'], $arr['counts']));

        }


        $sql ="SELECT defenseurs,counts FROM choixdefenseurs ORDER BY counts DESC LIMIT 8";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($defenseurs, array($arr['defenseurs'], $arr['counts']));

        }


        $sql ="SELECT milieux,counts FROM choixmilieux ORDER BY counts DESC LIMIT 6";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($milieux, array($arr['milieux'], $arr['counts']));
        }

        $sql ="SELECT attaquants,counts FROM choixattaquants ORDER BY counts DESC LIMIT 6";
        $query = $conn->execute_query($sql);

        while ($arr= mysql_fetch_array($query)){
          array_push($attaquants, array($arr['attaquants'], $arr['counts']));
        }

        $sql = "SELECT counts from totalselectionsuniques";
        $query = $conn->execute_query($sql);
        if($query){
          $total = mysql_result($query,0);
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
$result['total'] = $total;

echo json_encode($result);

?>
