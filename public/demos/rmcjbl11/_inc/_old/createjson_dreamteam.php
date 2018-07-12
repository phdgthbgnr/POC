<?php
//header('Content-Type: application/json charset=utf-8');
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('../utilsggd.php');
require('../connect.php');

$result = array();

$conn = new connect();

$sql = "SELECT * FROM $conn->tb5, $conn->tb6 WHERE $conn->tb6.id_dt_slc <> 6 and $conn->tb6.id_dt_slc = $conn->tb5.id_dt ORDER BY id_dt, formation_dt ASC";
$query = $conn->execute_query($sql);
if($query){
  $row = array();
  while($rows = mysql_fetch_assoc($query)){
    $form = $rows['formation_dt'];
    $iddt = $rows['id_dt']."";
    $nom = trim($rows['nom_dt']);
    $row[$iddt]['nom'] = $nom;
    if($rows['id_gardiens_slc'] !=0) $row[$iddt]['selection'][$form]['gardiens'][] = $rows['id_gardiens_slc']."";
    if($rows['id_defenseursc_slc'] !=0) $row[$iddt]['selection'][$form]['defenseursc'][] = $rows['id_defenseursc_slc']."";
    if($rows['id_defenseursl_slc'] !=0) $row[$iddt]['selection'][$form]['defenseursl'][] = $rows['id_defenseursl_slc']."";
    if($rows['id_milieuxd_slc'] !=0) $row[$iddt]['selection'][$form]['milieuxd'][] = $rows['id_milieuxd_slc']."";
    if($rows['id_milieuxo_slc'] !=0) $row[$iddt]['selection'][$form]['milieuxo'][] = $rows['id_milieuxo_slc']."";
    if($rows['id_attaquants_slc'] !=0) $row[$iddt]['selection'][$form]['attaquants'][] = $rows['id_attaquants_slc']."";

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

echo $res;

$path = dirname(__file__);

/*
if(file_exists($path.'/dbjson.json')){
  unlink($path.'/dbjson.json');
}
*/

$f = fopen($path.'/dbdt11.json','w');
fwrite($f, $res);
fclose($f);


?>
