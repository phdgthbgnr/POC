<?php
header('Access-Control-Allow-Origin: http://demo.greengardendigital.com');
header('Access-Control-Allow-Methods: POST');

require_once('connect.php');

$error=array();


if($_POST) {

	if (isset($_POST['action']) && $_POST['action'] == 'inscription') {
		
        $dzid='';
        $nom=protect($_POST['nom']);
        $prenom=protect($_POST['prenom']);
        $mail=protect($_POST['mail']);
        $dzmail=protect($_POST['dzmail']);
		$dzid=protect($_POST['dzid']);
        $score=protect($_POST['score']);
        //if (empty($nom)) array_push($error,'nom');
        //if (empty($prenom)) array_push($error,'prenom');
        if (!isset($_POST['accepte']) || $_POST['accepte']=='0') {
            array_push($error,'accepte');
            echo 'accepte';
            exit;
        }
              
        if (!valid_mail($mail)) {
			array_push($error,'mail');
            echo 'mail';
            exit;
		}
        
        
        if(empty($dzid)){
            array_push($error,'dzid');
            echo 'dzid';
            exit;
        }
		
        if(count($error)==0){
            
            $conn=new connect();
            
            // recup ID ope
            $sql="SELECT id_ope FROM $conn->tb1 WHERE ope_nom='hungergames'";
            $query=$conn->execute_query($sql);
            
            if($query){
                $row= mysql_fetch_row($query);
                if($row){
                    $id=$row[0];
                    
                    // test si déjà enregistré (perdu mais a partagé le jeux
                    $sql="SELECT id_contact FROM $conn->tb2 WHERE dz_id='$dzid'";
                    $test=$conn->execute_query($sql);
                    
                    if($test){
                        
                        $rtest= mysql_fetch_row($test);
                        
                        if($rtest){
                            $idc=$id=$rtest[0];
                            $sql="UPDATE $conn->tb2 SET
                                ct_nom='$nom',
                                ct_prenom='$prenom',
                                ct_mail='$mail',
                                dz_mail='$dzmail',
                                ct_score='$score' 
                                WHERE 
                                id_contact='$idc'
                                ";          

                                $query=$conn->execute_query($sql); 

                                if(!$query) {
                                    echo 'errorbdd3';
                                    exit;
                                }


                            }else{
                                // enregistre donnees
                                $sql="INSERT INTO $conn->tb2 (
                                ope_id,
                                ct_nom,
                                ct_prenom,
                                ct_mail,
                                dz_id,
                                dz_mail,
                                ct_score
                                ) VALUES (
                                '$id',
                                '$nom',
                                '$prenom',
                                '$mail',
                                '$dzid',
                                '$dzmail',
                                '$score'
                                )";

                                $query=$conn->execute_query($sql);

                                if(!$query) {
                                    echo 'errorbdd4';
                                    exit;
                                }
                            
                        }
                        
                    }
                }else{
                    echo 'errorbdd1';
                    exit;
				}
            
            }else{
                echo 'errorbdd2';
                exit;
			}
            
            echo 'ok';
            exit;
        
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