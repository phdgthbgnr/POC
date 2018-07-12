<?php

header('Content-type: text/html; charset=utf-8');

require ('../_inc/connect.php');

if($_GET){
  if(isset($_GET['jour'])){
    $conn = new connect();
    $jour = $_GET['jour'];
    $joura = $jour.' 00:00:00';
    $jourb = $jour.' 23:59:59';
    $max = 1;

    $sql = "SELECT MAX(counted) FROM (SELECT COUNT(id_joueurs) AS counted, HOUR(dates) AS heure FROM $conn->tb3 WHERE dates BETWEEN '$joura' AND '$jourb' GROUP BY heure) AS counteds";
    $query =  $conn->execute_query($sql);
    if($query) $max = mysql_result($query,0);

    $sql = "SELECT dates, COUNT(id_joueurs) AS counts, HOUR(dates) AS heures FROM $conn->tb3 WHERE dates BETWEEN '$joura' AND '$jourb' GROUP BY heures";

    $query = $conn->execute_query($sql);

    if($query){
      $elems = '<li class="journee" id="jour'.$jour.'"><ul class="heures">';
      while($res = mysql_fetch_assoc($query)){
        //echo $res['heures'].'<br/>';
        $count = $res['counts'];
        $h = round(($count*100)/$max);
        $h = $h < 1 ? 1 : $h;
        $elems .= '<li><img src="../_images/squarenb.png" width="30" height="'.$h.'"/><p><span class="heure">'.$res['heures'].'</span><span class="counted">'.$count.'</span></p></li>';
      }
      $elems .= '</ul></li>';
    }
  }
}

echo $elems;

?>
