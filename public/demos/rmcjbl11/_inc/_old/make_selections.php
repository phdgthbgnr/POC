<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require('../connect.php');
$conn=new connect();
$form = array(442,4132,433);
for($t=180000; $t<200000; $t++){
  $tokens = md5(uniqid(rand(), true));

    // formation
    $f = rand(0,2);
    $formation = $form[$f];

    // gardiens
    $ids = array(1,2,5);
    $ind = rand(0,2);
    $gar = $ids[$ind];
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      formation,
      id_gardiens,
      token_s
      ) VALUES (
      '$t',
      '$formation',
      '$gar',
      '$tokens'
      )";
      $conn->execute_query($sql);

  //defenseurs centraux
  for($tt=1;$tt<=2;$tt++){
    $ids = array(8,10,11,12);
    $ind = rand(0,3);
    $def = $ids[$ind];
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      formation,
      id_defenseursc,
      token_s
      ) VALUES (
      '$t',
      '$formation',
      '$def',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }

  //defenseurs lateraux
  for($tt=1;$tt<=2;$tt++){
    $ids = array(17,19,20,21);
    $ind = rand(0,3);
    $def = $ids[$ind];
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      formation,
      id_defenseursl,
      token_s
      ) VALUES (
      '$t',
      '$formation',
      '$def',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }

  // milieux desfensifs
  $max = $formation == 4132 ? 1 : 2;

  for($tt=1;$tt<=$max;$tt++){
    $ids = array(25,26,27);
    $ind = rand(0,2);
    $mil = $ids[$ind];
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      formation,
      id_milieuxd,
      token_s
      ) VALUES (
      '$t',
      '$formation',
      '$mil',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }

  // milieux offensifs
  $max = $formation == 4132 ? 3 : ($formation == 433 ? 1 : 2);

  for($tt=1;$tt<=$max;$tt++){
    $ids = array(28,29,31);
    $ind = rand(0,2);
    $mil = $ids[$ind];
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      formation,
      id_milieuxo,
      token_s
      ) VALUES (
      '$t',
      '$formation',
      '$mil',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }

  // attaquants
  $max = $formation == 433 ? 3 : 2;

  for($tt=1;$tt<=$max;$tt++){
    $ids = array(39,41,42,46,47,52);
    $ind = rand(0,5);
    $att = $ids[$ind];
    $sql="INSERT INTO $conn->tb4(
      id_joueurs,
      formation,
      id_attaquants,
      token_s
      ) VALUES (
      '$t',
      '$formation',
      '$att',
      '$tokens'
      )";
      $conn->execute_query($sql);
  }
}
?>
