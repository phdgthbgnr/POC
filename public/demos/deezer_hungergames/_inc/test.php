<?php
header('Access-Control-Allow-Origin: http://demo.greengardendigital.com');
header('Access-Control-Allow-Methods: POST');
//require_once('connect.php');

$error=array();

$reponse=array('r1','r3','r6');

if($_POST) {

	if (isset($_POST['action']) && $_POST['action'] == 'test') {
		
        $resp=protect($_POST['resp']);
        if (in_array($resp,$reponse)){
            echo 'good';
        }else{
            echo 'wrong';
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