<?php
header('Content-Type: application/json charset=utf-8');
require_once('../utilsggd.php');
require('../connect.php');

$result = array();

$conn = new connect();

$sql = "SELECT * FROM $conn->tb1, $conn->tb2 WHERE $conn->tb2.id_poste = $conn->tb1.type ORDER BY id_joueur ASC";
$query = $conn->execute_query($sql);
if($query){
  while($rows = mysql_fetch_assoc($query)){
    $row = array();
    $row['poste'] = $rows['type'];
    $row['nameposte'] = $rows['nom_poste'];
    $nomm = trim($rows['nom']);
    $nom = htmlspecialchars($nomm);
    $nom = iconv('utf-8','ISO-8859-15',$nom);
    $row['nom'] = utf8_encode($nom);
    $prenomm = trim($rows['prenom']);
    $prenom = htmlspecialchars($prenomm);
    $prenom = iconv('utf-8','ISO-8859-15',$prenom);
    $row['prenom'] = utf8_encode($prenom);
    $row['select'] = $rows['selections'];
    $row['age'] = $rows['age'];
    $nomm = strtolower($nomm);
    $prenomm = strtolower($prenomm);
    $row['fichier'] = wd_remove_accents($nomm.'-'.$prenomm);
    $id = $rows['id_joueur'];
    $result[$id] = $row;
  }
}

$res = json_encode($result);

$path = dirname(__file__);

/*
if(file_exists($path.'/dbjson.json')){
  unlink($path.'/dbjson.json');
}
*/

$f = fopen($path.'/dbjson.json','w+');
fwrite($f, $res);
fclose($f);


?>
