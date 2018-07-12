<?php
header('Access-Control-Allow-Origin: *');
require_once('_phpclass/connect.php');

$error=array();


if($_POST) {

	if (isset($_POST['action']) && $_POST['action'] == 'inscription') {
		
		$cp='';
		$adress='';
		$ville='';
		$naiss='';
		
		
        $nom=protect($_POST['nom']);
        $prenom=protect($_POST['prenom']);
        $mail=protect($_POST['mail']);
		$score=protect($_POST['score']);
		$naiss=protect($_POST['naiss']);
		$cp=protect($_POST['cp']);
		$adress=protect($_POST['adress']);
		$ville=protect($_POST['ville']);
		$tel=protect($_POST['tel']);
		
		
		$sonymail=0;
        if(isset($_POST['sonymail']) && $_POST['sonymail']==1) $sonymail=1;
		
		
		$syfymail=0;
        if(isset($_POST['syfymail']) && $_POST['syfymail']==1) $syfymail=1;
		
		$accept=0;
		if(isset($_POST['accept']) && $_POST['accept']==1) $accept=1;
		
		
		$scoreps4='';
		$scoreps4=protect($_POST['scoreps4']);

		
		
        if (empty($nom)) array_push($error,'nom');
        if (empty($prenom)) array_push($error,'prenom');
		if (empty($naiss)) array_push($error,'date de naissance');
        if (empty($cp)) array_push($error,'code postal');
		if ($accept==0) array_push($error,'accepter les termes et conditions de jeux');
		
        if (!valid_mail($mail)) {
			array_push($error,'mail');
		}else{
			// check si mail deja present
			$conn=new connect();
			$sql="SELECT id_contact FROM $conn->tb2 WHERE ct_mail='$mail'";
			$query=$conn->execute_query($sql);
			if($query){
				$row= mysql_fetch_row($query);
				if($row){
					$error=array('mailinbdd');
					echo json_encode($error);
					exit;
				}
			}
		}
		
        
		
        if(count($error)==0){
            $conn=new connect();
            
            // recup ID ope
            $sql="SELECT id_ope FROM $conn->tb1 WHERE ope_nom='syfyps4'";
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
							ct_naiss,
							ct_cp,
							ct_adress,
							ct_ville,
							ct_tel,
							sonymail,
							syfymail,
							termaccept,
							scoreps4
                            ) VALUES (
                            '$id',
                            '$nom',
                            '$prenom',
                            '$mail',
							'$naiss',
							'$cp',
							'$adress',
							'$ville',
							'$tel',
							'$sonymail',
							'$syfymail',
							'$accept',
							'$scoreps4'
                            )";
                    $query=$conn->execute_query($sql);
                    if($query){
                         $error=array('ok');
						 $conn->close_db();
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

if(count($error)==0) array_push($error,'nodata');
echo json_encode($error);

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