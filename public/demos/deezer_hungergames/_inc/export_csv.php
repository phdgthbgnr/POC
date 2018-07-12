<?php

$today=date("d.m.Y-His");

header('Content-Encoding: Windows-1252');
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: attachment; filename=hungergames_deezer".$today.".xls");
header("Pragma: no-cache");
header("Expires: 0");


require_once('connect.php');

if($_GET){

	if(isset($_GET['ope'])){
		if($_GET['ope']=='hungergames'){
			
			$conn=new connect();
			$id=0;
			$sql="SELECT * FROM $conn->tb1 WHERE ope_nom = 'hungergames' ";
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
							
							$header = 'ID'.$tab.'NOM'.$tab.'PRENOM'.$tab.'MAIL'.$tab.'FB'.$tab.'TW'.$tab.'DZ'.$tab.'SCORE'.$tab.'DATE';
							while ($arr= mysql_fetch_array($query)){
								
								//print_r($arr);
								
								$v = str_replace('"', '""', $arr['id_contact']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                
                                $v = str_replace('"', '""', $arr['ct_nom']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_prenom']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $v = str_replace('"', '""', $arr['ct_mail']);
                                $v = $v.$tab;
								$line .= $v;
                                
                                $fb = $arr['shareFB'];
                                $v = $fb.$tab;
								$line .= $v;
                                
                                $tw = $arr['shareTW'];
                                $v = $tw.$tab;
								$line .= $v;
                                
                                $dz = $arr['friendFB'];
                                $v = $dz.$tab;
								$line .= $v;
                                
                                if($dz==1) $dz=2;
                                
                                $sc = $arr['ct_score'];
                                
                                $score=$sc+$fb+$tw+$dz;
                                $v = $score.$tab;
								$line .= $v;
                                    
                                    
                                $v = str_replace('"', '""', $arr['cur_date']);
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