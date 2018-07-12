<?php
require('_inc/connect.php');
$conn = new connect();
for($t=1; $t<=4; $t++){
  for($tt=1;$tt<4;$tt++){
    $gar = rand(1,6);
    $sql="INSERT INTO $conn->tb6(
      id_dt_slc,
      id_gardiens_slc
      ) VALUES (
      '$t',
      '$gar'
      )";
      $conn->execute_query($sql);
  }
  for($tt=1;$tt<9;$tt++){
    $def = rand(7,24);
    $sql="INSERT INTO $conn->tb6(
      id_dt_slc,
      id_defenseurs_slc
      ) VALUES (
      '$t',
      '$def'
      )";
      $conn->execute_query($sql);
  }
  for($tt=1;$tt<7;$tt++){
    $mil = rand(25,38);
    $sql="INSERT INTO $conn->tb6(
      id_dt_slc,
      id_milieux_slc
      ) VALUES (
      '$t',
      '$mil'
      )";
      $conn->execute_query($sql);
  }
  for($tt=1;$tt<7;$tt++){
    $att = rand(39,54);
    $sql="INSERT INTO $conn->tb6(
      id_dt_slc,
      id_attaquants_slc
      ) VALUES (
      '$t',
      '$att'
      )";
      $conn->execute_query($sql);
  }
}
?>
