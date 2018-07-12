<?php
header('Content-Type: application/json charset=utf-8');
require_once('../utilsggd.php');
require('../connect.php');

$result = array();

$conn = new connect();

$sql = "SELECT * FROM $conn->tb5, $conn->tb6 WHERE $conn->tb6.id_dt_slc = $conn->tb5.id_dt ORDER BY id_dt ASC";
$query = $conn->execute_query($sql);
if($query){
  $row = array();
  while($rows = mysql_fetch_assoc($query)){

    $iddt = $rows['id_dt']."";
    $nom = trim($rows['nom_dt']);
    $row[$iddt]['nom'] = $nom;
    if($rows['id_gardiens_slc'] !=0) $row[$iddt]['selection']['gardiens'][] = $rows['id_gardiens_slc']."";
    if($rows['id_defenseurs_slc'] !=0) $row[$iddt]['selection']['defenseurs'][] = $rows['id_defenseurs_slc']."";
    if($rows['id_milieux_slc'] !=0) $row[$iddt]['selection']['milieux'][] = $rows['id_milieux_slc']."";
    if($rows['id_attaquants_slc'] !=0) $row[$iddt]['selection']['attaquants'][] = $rows['id_attaquants_slc']."";

    $nom = str_replace(' ','-',$nom);
    //$nom = htmlspecialchars($nom);
    //$nom = iconv('utf-8','ISO-8859-15',$nom);
    $nom = strtolower($nom);
    $fichier = wd_remove_accents($nom);
    $row[$iddt]['fichier'] = $fichier;

  }
  $result = $row;
}

$res = json_encode($result);

$path = dirname(__file__);

/*
if(file_exists($path.'/dbjson.json')){
  unlink($path.'/dbjson.json');
}
*/

$f = fopen($path.'/dbdtjson.json','w+');
fwrite($f, $res);
fclose($f);


?>
