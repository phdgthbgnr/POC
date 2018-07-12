<?php
header('Access-Control-Allow-Origin: *');
require_once('connect.php');

$error=array();


if($_POST) {

	if (isset($_POST['action']) && $_POST['action'] == 'inscription') {
		
        $nom=protect($_POST['nom']);
        $prenom=protect($_POST['prenom']);
        $mail=protect($_POST['mail']);
		$dzid=protect($_POST['dzid']);
        $reso=$_POST['reso'];
        $playlst=$_POST['playlist'];
        $tw=0;
        $fb=0;
        if($reso=='tweet') $tw=1;
        if($reso=='faceb') $fb=1;
        //if (empty($nom)) array_push($error,'nom');
        //if (empty($prenom)) array_push($error,'prenom');
        if (!isset($_POST['accepte']) || $_POST['accepte']=='0') {
            array_push($error,'accepte');
            echo 'accepte';
            exit;
        }
        
        
        // test FB
        if($fb==1){
            $conn=new connect();
            $sql="SELECT id_contact FROM $conn->tb2 WHERE dz_id='$dzid' AND joueFB='1'";
            
            $query=$conn->execute_query($sql);
            if($query){
              $row= mysql_fetch_row($query);
              if($row){
                  $error=array('dejajoue1');
                  echo 'dejajoue1';
                        exit;
                    }
            }
        }
        
        // test tweet
        if($tw==1){
        $conn=new connect();
        $sql="SELECT id_contact FROM $conn->tb2 WHERE dz_id='$dzid' AND joueTW='1'";
        
        $query=$conn->execute_query($sql);
        if($query){
		  $row= mysql_fetch_row($query);
		  if($row){
              $error=array('dejajoue2');
              echo 'dejajoue2';
					exit;
				}
            }
        }
        
        /*
        if (!valid_mail($mail)) {
			array_push($error,'mail');
            echo 'mail';
            exit;
		}
		*/
		
        if(count($error)==0){
            $conn=new connect();
            
            // recup ID ope
            $sql="SELECT id_ope FROM $conn->tb1 WHERE ope_nom='rayban'";
            $query=$conn->execute_query($sql);
            
            if($query){
                $row= mysql_fetch_row($query);
                if($row){
                    $id=$row[0];
                    
                    // enregistre donnees
                    
                     $sql="INSERT INTO $conn->tb2 (
                            ope_id,
                            ct_nom,
                            ct_prenom,
                            ct_mail,
							dz_id,
                            joueFB,
                            joueTW
                            ) VALUES (
                            '$id',
                            '$nom',
                            '$prenom',
                            '$mail',
							'$dzid',
                            '$fb',
                            '$tw'
                            )";
                    $query=$conn->execute_query($sql);
                    
                    if($query){
                        
                        $mid=mysql_insert_id();
						foreach($playlst as $trck){
                            $sql="INSERT into $conn->tb3(
                            contact_id,
                            dz_playlist
                            ) VALUES (
                            '$mid',
                            '$trck'
                            )";
                            $query=$conn->execute_query($sql);
                        }    
                        $conn->close_db();
                         $error=array('ok');
                        echo 'ok';
                    }else{
                        $error=array('error_bdd');
                    }
                }else{
					$error=array('error_bdd');
				}
            
            }else{
				$error=array('error_bdd');
			}
           
        
        }
        
    }
	
    
}

/*
if(count($error)==0) array_push($error,'nodata');
echo json_encode($error);
*/

// valide email
function valid_mail($m){
		if (!empty ($m)) {
			// if (!eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+))*$", $m, $regs)) {
			//if(!eregi('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'.'@'.'[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.'.'[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $m)){
			if(!preg_match('!^[a-z0-9]+([\._-][a-z0-9]+)*@([a-z0-9]+[\._-])*[a-z0-9_-]{2,}\.[a-z]{2,}$!i', $m)){
				return false;
			}else{
				return true;
			}
		}
}


// protege $_POST
function protect($v){
		$v=trim($v);
		//si magic_quotes pas de caractere d'echappement
		if (get_magic_quotes_gpc()==1){
			$r=$v;
		}else{
			$r=addslashes($v);
		}
		$r = htmlspecialchars($r);
		//$conn=new connect();
		//$r = mysql_real_escape_string($r);
		//$res=str_replace(array("'", '"'), "", $r);
		return $r;
}

?>