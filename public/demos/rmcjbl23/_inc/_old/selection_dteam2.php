<?php
require_once('../utilsggd.php');
require('../connect.php');

$conn = new connect();

$sql="SELECT * FROM dt_selection_temp";
$query = $conn->execute_query($sql);
if($query){
  while($row = mysql_fetch_assoc($query)){
    $id = $row['id'];
    for($t=1;$t<4;$t++){
      $gar = strtolower(trim($row['gardien'.$t]));
      if(!empty($gar)){
        $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$gar'";
        $query2 = $conn->execute_query($sql);
        if($query2){
          $idj = mysql_result($query2,0);
          if($idj){
            $sql = "INSERT INTO dreamteam_selection (
              id_dt_slc,
              id_gardiens_slc
            )
            VALUES (
              '$id',
              '$idj'
            )
            ";
            $conn->execute_query($sql);
          }else{
            echo $gar;
          }
        }
      }
    }

    for($t=1;$t<9;$t++){
      $def = strtolower(trim($row['defenseur'.$t]));
      if(!empty($def)){
        $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
        $query2 = $conn->execute_query($sql);
        if($query2){
          $idj=mysql_result($query2,0);
          if($idj){
            $sql = "INSERT INTO dreamteam_selection (
              id_dt_slc,
              id_defenseurs_slc
            )
            VALUES (
              '$id',
              '$idj'
            )
            ";
            $conn->execute_query($sql);
          }else{
            echo $def;
          }
        }
      }
    }

    for($t=1;$t<7;$t++){
      $mil = strtolower(trim($row['milieux'.$t]));
      if(!empty($mil)){
        $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$mil'";
        $query2 = $conn->execute_query($sql);
        if($query2){
          $idj = mysql_result($query2,0);
          if($idj){
            $sql = "INSERT INTO dreamteam_selection (
              id_dt_slc,
              id_milieux_slc
            )
            VALUES (
              '$id',
              '$idj'
            )
            ";
            $conn->execute_query($sql);
          }else{
            echo $mil;
          }
        }
      }
    }

    for($t=1;$t<7;$t++){
      $att = strtolower(trim($row['attaquants'.$t]));
      if(!empty($att)){
        $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$att'";
        $query2 = $conn->execute_query($sql);
        if($query2){
          $idj = mysql_result($query2,0);
          if($idj){
            $sql = "INSERT INTO dreamteam_selection (
              id_dt_slc,
              id_attaquants_slc
            )
            VALUES (
              '$id',
              '$idj'
            )
            ";
            $conn->execute_query($sql);
          }else{
            echo $att;
          }
        }
      }
    }

  }
}


?>
