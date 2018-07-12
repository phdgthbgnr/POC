<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$today=date("d.m.Y-His");


/*
header('Content-Encoding: Windows-1252');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=votrelistedes23".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");
*/
//header('Content-Encoding: Windows-1252');
//header('Content-Encoding: UTF-8');
header('Content-type: text/html; charset=utf-8');
//header("Content-Type: application/xls");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=votrelistedes23".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");

require('../_inc/connect.php');
require ('../_inc/utilsggd.php');

$conn = new connect();

if($_GET){

  if(isset($_GET['code']) && $_GET['code'] == '5K2pGzAv'){

    $sql = "SELECT * FROM $conn->tb7 ORDER BY id_particip ASC";
    $query = $conn->execute_query($sql);
    if($query){
      $tab = "\t";
			$ret = "\n";
			$line = '';
			$data = '';

				$header = 'ID JOUEUR'.$tab.'NOM'.$tab.'PRENOM'.$tab.'EMAIL'.$tab.'NEWSLETTER'.$tab.'OFFRES'.$tab.'REGLEMENT'.$tab.'DATE';
				while ($arr= mysql_fetch_array($query)){

					//print_r($arr);

					$v = str_replace('"', '""', $arr['id_joueur']);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['nom']);
          //$v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
          //$v = utf8_decode($v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['prenom']);
          $v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
          //$v = utf8_decode($v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['email']);
					$v = $v.$tab;
					$line .= $v;

          $v = str_replace('"', '""', $arr['newsletter']);
					$v = $v.$tab;
					$line .= $v;

          $v = str_replace('"', '""', $arr['offres']);
					$v = $v.$tab;
					$line .= $v;

          $v = str_replace('"', '""', $arr['reglement']);
					$v = $v.$tab;
					$line .= $v;

          $v = str_replace('"', '""', $arr['pdate']);
					$v = $v.$tab;
					$line .= $v;

					//$data .= trim($line).$ret;
          $data .= $line.$ret;
					$line='';
								//$data = str_replace("\r", "", $data);
				}

				$conn->close_db();

							//$data = preg_replace("/\r\n|\n\r|\n|\r/", " ", $data);
				echo $header."\n".$data;
    }

  }

}

?>
