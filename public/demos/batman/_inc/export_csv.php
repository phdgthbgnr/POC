<?php

$today=date("d.m.Y-His");

header('Content-Encoding: Windows-1252');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=batmanarkhamknight-".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");

require('connect.php');


if($_GET){

	if(isset($_GET['ope'])){
		if($_GET['ope']=='batmanarkhamknight'){

			$conn=new connect();
			$sql="SELECT * FROM $conn->tb1 ORDER BY mw_likes DESC";
			$query=$conn->execute_query($sql);
			if($query){
				$tab="\t";
				$ret="\n";
				$line='';
				$data='';

				$header = 'ID'.$tab.'MYWARNER ID'.$tab.'MAIL'.$tab.'NOM'.$tab.'PRENOM'.$tab.'DATE'.$tab.'IMAGE'.$tab.'VIGNETTE'.$tab.'LIKES';
				while ($arr= mysql_fetch_array($query)){

					//print_r($arr);

					$v = str_replace('"', '""', $arr['id_user']);
                    $v = $v.$tab;
					$line .= $v;

                    $v = str_replace('"', '""', $arr['mw_id']);
                    $v = $v.$tab;
					$line .= $v;

					$v = str_replace('"', '""', $arr['email']);
                    $v = $v.$tab;
					$line .= $v;

                    $v = str_replace('"', '""', $arr['firstname']);
                    $v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['lastname']);
                    $v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['mdate']);
                    $v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['namefic']);
                    $v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['thumb']);
                    $v = $v.$tab;
					$line .= $v;
                    
                    $v = str_replace('"', '""', $arr['mw_likes']);
                    $v = $v.$tab;
					$line .= $v;


					$data .= trim($line).$ret;
					$line='';
								//$data = str_replace("\r", "", $data);
				}

				$conn->close_db();

							//$data = preg_replace("/\r\n|\n\r|\n|\r/", " ", $data);
				echo $header."\n".$data;

			}
		}
	}
}

?>