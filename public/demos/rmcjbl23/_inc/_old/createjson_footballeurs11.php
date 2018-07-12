﻿<?php
/*
 creation de la liste des 23 pour le 11
*/
header('Content-Type: application/json charset=utf-8');
require_once('../utilsggd.php');
require('../connect.php');

$result = array();

$conn = new connect();

$sql = "SELECT * FROM $conn->tb2, $conn->tb1, liste23_11_temp  WHERE $conn->tb2.poste = liste23_11_temp.poste AND $conn->tb1.nom = liste23_11_temp.nom ORDER BY $conn->tb1.id_joueur ASC";
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

$f = fopen($path.'/db23_11.json','w+');
fwrite($f, $res);
fclose($f);


?>
