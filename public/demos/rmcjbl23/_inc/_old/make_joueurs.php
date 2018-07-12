<?php
require ('_inc/connect.php');
$conn = new connect();
for ($t=1;$t<100000;$t++){
  $nom = "nom".$t;
  $prenom = "prenom".$t;
  $email = "email".$t;
  $sql="INSERT INTO $conn->tb3(
    nom,
    prenom,
    email,
    partage
    ) VALUES (
    '$nom',
    '$prenom',
    '$email',
    '1'
    )";
    $conn->execute_query($sql);
}
?>
