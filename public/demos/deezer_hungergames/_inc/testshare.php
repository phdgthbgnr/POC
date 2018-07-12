<?php

/*
<li class="prt1"><a href="#" id="part1" class="chance"><img src="_images/transact.png"/></a></li>
<li class="prt2"><a href="#" id="part2" class="chance"><img src="_images/transact.png"/></a></li>
<li class="prt3"><a href="#" id="part3" class="chance"><img src="_images/transact.png"/></a></li>
*/

header('Access-Control-Allow-Origin: http://demo.greengardendigital.com');
header('Access-Control-Allow-Methods: POST');

require_once('connect.php');

$ret='';

if($_POST) {

	if (isset($_POST['action']) && $_POST['action'] == 'testshare') {
        
        $dzid='';
        
        $dzid=protect($_POST['dzid']);
    
        if(!empty($dzid)){
            $conn=new connect();
            $sql="SELECT friendFB, shareTW, shareFB FROM $conn->tb2 WHERE dz_id='$dzid'";
            $query=$conn->execute_query($sql);
            if($query){
                $rows= mysql_fetch_row($query);
                if($rows){
                    
                    if($rows[0]==1){
                        $ret.='<li class="prt1"><a href="#" id="part1" class="inactif"><img src="_images/transact.png"/></a></li>';
                    }else{
                        $ret.='<li class="prt1"><a href="fba" id="part1" class="chance"><img src="_images/transact.png"/></a></li>';
                    }
                    
                    if($rows[1]==1){
                        $ret.='<li class="prt2"><a href="#" id="part2" class="inactif"><img src="_images/transact.png"/></a></li>';
                    }else{
                        $ret.='<li class="prt2"><a href="https://twitter.com/intent/tweet/?text=Entre%20dans%20la%20rébellion,%20et%20tente%20de%20gagner%20des%20invitations%20pour%20la%20sortie%20de%20@TheHungerGames%20!&url=http://bit.ly/1nrRmZV" id="part2" class="chance"><img src="_images/transact.png"/></a></li>';
                    }
                    
                    if($rows[2]==1){
                        $ret.='<li class="prt3"><a href="#" id="part3" class="inactif"><img src="_images/transact.png"/></a></li>';
                    }else{
                        $ret.='<li class="prt3"><a href="fbp" id="part3" class="chance"><img src="_images/transact.png"/></a></li>';
                    }
                    echo $ret;
                    exit;
                }else{
                    echo 'nothing';
                    exit;
                }
            }
        }
    }
    
    echo 'nothing';
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