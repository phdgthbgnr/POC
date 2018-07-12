<?php
require('../connect.php');
$conn=new connect();
for($t=80000; $t<100000; $t++){
  $tokens = md5(uniqid(rand(), true));
  for($tt=1;$tt<4;$tt++){
    $gar = rand(1,6);
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      id_gardiens,
      token_s
      ) VALUES (
      '$t',
      '$gar',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }
  for($tt=1;$tt<9;$tt++){
    $def = rand(7,24);
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      id_defenseurs,
      token_s
      ) VALUES (
      '$t',
      '$def',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }
  for($tt=1;$tt<7;$tt++){
    $mil = rand(25,38);
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      id_milieux,
      token_s
      ) VALUES (
      '$t',
      '$mil',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }
  for($tt=1;$tt<7;$tt++){
    $att = rand(39,54);
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      id_attaquants,
      token_s
      ) VALUES (
      '$t',
      '$att',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }
}
?>
