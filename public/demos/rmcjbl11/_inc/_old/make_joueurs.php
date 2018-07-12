<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require ('../connect.php');

$conn = new connect();

for ($t=100000;$t<200000;$t++){
  $token = md5(rand(1000,9999));
  $nom = "nom".$t;
  $prenom = "prenom".$t;
  $email = "email".$t;
  $sql="INSERT INTO $conn->tb3(
    nom,
    prenom,
    email,
    partage,
    tokenid
    ) VALUES (
    '$nom',
    '$prenom',
    '$email',
    '1',
    '$token'
    )";
    $conn->execute_query($sql);
}
?>
