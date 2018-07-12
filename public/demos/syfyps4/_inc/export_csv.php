<?php

$today=date("d.m.Y-His");


//header('Content-Encoding: UTF-8');
//header('Content-type: text/csv; charset=UTF-8');

header('Content-Encoding: Windows-1252');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=concours_syfy_ps4".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");
//echo "\xEF\xBB\xBF"; //UTF-8 BOM

require_once('_phpclass/connect.php');

if($_GET){

	if(isset($_GET['ope'])){
		if($_GET['ope']=='syfyps4'){
			
			$conn=new connect();
			$id=0;
			$sql="SELECT * FROM $conn->tb1 WHERE ope_nom = 'syfyps4' ";
			$query=$conn->execute_query($sql);
			if($query){
				$row= mysql_fetch_row($query);
				if($row){
					$id=$row[0];
					$conn->close_db();
					if($id>0){
						$conn=new connect();
						$sql="SELECT * FROM $conn->tb2 WHERE ope_id=$id ORDER BY id_contact ASC";
						$query=$conn->execute_query($sql);
						if($query){
							$tab="\t";
							$ret="\n";
							$line='';
							$data='';
							
							$header = 'ID'.$tab.'NOM'.$tab.'PRENOM'.$tab.'MAIL'.$tab.'DATE NAISSANCE'.$tab.'CP'.$tab.'ADRESSE'.$tab.'VILLE'.$tab.'TEL'.$tab.'EMAIL SONY'.$tab.'EMAIL SYFY'.$tab.'PLAYER'.$tab.'date';
							while ($arr= mysql_fetch_array($query)){
								
								//print_r($arr);
								
								$v = str_replace('"', '""', $arr['id_contact']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                
                                $v = str_replace('"', '""', $arr['ct_nom']);
                                $v = utf8_decode($v).$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_prenom']);
                                $v = utf8_decode($v).$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_mail']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_naiss']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_cp']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_adress']);
                                $v = utf8_decode($v).$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_ville']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_tel']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['sonymail']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['syfymail']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['scoreps4']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                    
                                    
                                $v = str_replace('"', '""', $arr['curdate']);
                                $v = $v.$tab;
								$line .= $v;    
                                
                                /*
                                foreach($arr as $v){
									$v = str_replace('"', '""', $v);
									$v = $v.$tab;
									$line .= $v;
								}
                                */
								
								$data .= trim($line).$ret;
								$line='';
								//$data = str_replace("\r", "", $data);	 
							}
							
							$conn->close_db();
							//mb_convert_encoding($data, 'UCS-2LE', 'UTF-8');
							//$data = preg_replace("/\r\n|\n\r|\n|\r/", " ", $data);
							echo $header."\n".$data;
							
						}
					
					}
				}
			}
			
		}
	}
}

?>