<?php
header('Access-Control-Allow-Origin: http://demo.greengardendigital.com');
header('Access-Control-Allow-Methods: POST');

require_once('connect.php');

$ret='';

if($_POST){
    if(isset($_POST['action']) && $_POST['action']=='perdupartage'){
        
        $dzid=protect($_POST['dzid']);
        $share=protect($_POST['share']);
        
        $conn=new connect();
        
        // recup id ope
        $id=0;
        $sql="SELECT id_ope FROM $conn->tb1 WHERE ope_nom='hungergames'";
        $query=$conn->execute_query($sql);
            
        
        
        if($query){
            $row= mysql_fetch_row($query);
            if($row){
                $id=$row[0];
            }
        }
        
        if($id==0){
            echo 'errorbdd';
            exit;
        }
        
        // test si nouveau joueur
        $sql="SELECT id_contact FROM $conn->tb2 WHERE dz_id='$dzid'";
        $query=$conn->execute_query($sql);
        if($query){
            $rows= mysql_fetch_row($query);
            // rien on enregistre nouveau USER
            if(!$rows){
                $sql="INSERT INTO $conn->tb2 (
                ope_id,
                dz_id
                ) VALUES (
                '$id',
                '$dzid'
                )";
                $res=$conn->execute_query($sql);
                if(!$res){
                    echo 'errorbdd';
                    exit;
                }
            }
        }
        
        $sql="";
        switch($share){
            case 'dz':
            $sql="UPDATE $conn->tb2 SET friendFB=1 WHERE dz_id='$dzid'";
            break;
            case 'fb':
            $sql="UPDATE $conn->tb2 SET shareFB=1 WHERE dz_id='$dzid'";
            break;
            case 'tw':
            $sql="UPDATE $conn->tb2 SET shareTW=1 WHERE dz_id='$dzid'";
            break;
        }
        
        if(!empty($sql)){
            $query=$conn->execute_query($sql);
            if($query){
                echo 'ok';
                exit;
            }
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