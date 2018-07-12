<?php
header('Access-Control-Allow-Origin: http://demo.greengardendigital.com');
header('Access-Control-Allow-Methods: POST');

require_once('connect.php');

$ret='';

if($_POST){
    
    if(isset($_POST['action']) && $_POST['action']=='testcall'){
    
        $dzid=protect($_POST['dzid']);
        
        $conn=new connect();
        
        $sql="SELECT id_ope FROM $conn->tb1 WHERE ope_nom='hungergames'";
        $query=$conn->execute_query($sql);
            
        if($query){
            $row= mysql_fetch_row($query);
            if($row){
                $id=$row[0];
            }
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
            }
        }
        
        $sql="SELECT friendFB, shareFB, shareTW FROM $conn->tb2 WHERE dz_id='$dzid'";
        $query=$conn->execute_query($sql);
        if($query){
            $rows= mysql_fetch_row($query);
            if($rows){
                if($rows[0]==1){
                    $ret.='<li class="inactif"><img src="_images/icnfrnd.png" class="icn"/><img src="_images/effectue.png"/></li>';
                }else{
                    $ret.='<li><img src="_images/icnfrnd.png" class="icn"/><a href="callFBf" id="callFBf"><img src="_images/invitefb.png"/></a></li>';
                }
                   
                if($rows[1]==1){
                    $ret.='<li class="inactif"><img src="_images/icnfrnd.png" class="icn"/><img src="_images/effectue.png"/></li>';
                }else{
                    $ret.='<li><img src="_images/icnfb.png" class="icn"/><a href="callFBfs" id="callFBfs"><img src="_images/invitepfb.png"/></a></li>';
                }
                   
                if($rows[2]==1){
                    $ret.='<li class="inactif"><img src="_images/icnfrnd.png" class="icn"/><img src="_images/effectue.png"/></li>';
                }else{
                    $ret.='<li><img src="_images/icntw.png" class="icn"/><a href="https://twitter.com/intent/tweet/?text=Entre%20dans%20la%20rébellion,%20et%20tente%20de%20gagner%20des%20invitations%20pour%20la%20sortie%20de%20@TheHungerGames%20!&url=http://bit.ly/1nrRmZV" id="callFBtw"><img src="_images/invitetw.png"/></a></li>';
                }
                echo $ret;
                exit;
            }else{
                echo 'nothing';
                exit;
            }
        }
    
    }
    
    echo 'nothing';
    exit;
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