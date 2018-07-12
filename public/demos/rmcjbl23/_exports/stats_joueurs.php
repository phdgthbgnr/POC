<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

$today=date("d.m.Y-His");

header('Content-Encoding: Windows-1252');
//header('Content-Encoding: utf-8');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=rmcjbl_joueurs".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");

require('../_inc/connect.php');
require ('../_inc/utilsggd.php');

$conn = new connect();

if($_GET){

  if(isset($_GET['code']) && $_GET['code'] == '5K2pGzAv'){

    $tab = "\t";
    $ret = "\n";
    $line = '';
    $data = '';
    $header = 'NOM'.$tab.'PRENOM'.$tab.'SELECTIONS';

    $data .= 'GARDIENS'.$tab.''.$tab.''.$tab.$ret;
    $sql = "SELECT * FROM choixgardiens, $conn->tb1 WHERE choixgardiens.gardiens = id_joueur ORDER BY counts DESC";
    $query = $conn->execute_query($sql);
    if($query){


				while ($arr= mysql_fetch_array($query)){

					//print_r($arr);

					$v = str_replace('"', '""', $arr['nom']);
          $v = htmlspecialchars($v);
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

					$v = str_replace('"', '""', $arr['counts']);
					$v = $v.$tab;
					$line .= $v;

					$data .= trim($line).$ret;
					$line='';
				}

				//$conn->close_db();

				//echo $header."\n".$data;
    }

    $data .= 'MILIEUX'.$tab.''.$tab.''.$ret;
    $sql = "SELECT * FROM choixmilieux, $conn->tb1 WHERE choixmilieux.milieux = id_joueur ORDER BY counts DESC";
    $query = $conn->execute_query($sql);
    if($query){

				while ($arr= mysql_fetch_array($query)){

					//print_r($arr);

					$v = str_replace('"', '""', $arr['nom']);
          $v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['prenom']);
          $v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
          //$v = utf8_decode($v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['counts']);
					$v = $v.$tab;
					$line .= $v;

					$data .= trim($line).$ret;
					$line='';
				}

    }


    $data .= 'DEFENSEURS'.$tab.''.$tab.''.$ret;
    $sql = "SELECT * FROM choixdefenseurs, $conn->tb1 WHERE choixdefenseurs.defenseurs = id_joueur ORDER BY counts DESC";
    $query = $conn->execute_query($sql);
    if($query){

				while ($arr= mysql_fetch_array($query)){

					//print_r($arr);

					$v = str_replace('"', '""', $arr['nom']);
          $v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['prenom']);
          $v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
          //$v = utf8_decode($v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['counts']);
					$v = $v.$tab;
					$line .= $v;

					$data .= trim($line).$ret;
					$line='';
				}

    }


    $data .= 'ATTAQUANTS'.$tab.''.$tab.''.$ret;
    $sql = "SELECT * FROM choixattaquants, $conn->tb1 WHERE choixattaquants.attaquants = id_joueur ORDER BY counts DESC";
    $query = $conn->execute_query($sql);
    if($query){

				while ($arr= mysql_fetch_array($query)){

					//print_r($arr);

					$v = str_replace('"', '""', $arr['nom']);
          $v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['prenom']);
          $v = htmlspecialchars($v);
          //$v = iconv('utf-8','ISO-8859-15',$v);
          //$v = utf8_decode($v);
					$v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['counts']);
					$v = $v.$tab;
					$line .= $v;

					$data .= trim($line).$ret;
					$line='';
				}

    }

    $conn->close_db();

    echo $header."\n".$data;

  }

}

?>
