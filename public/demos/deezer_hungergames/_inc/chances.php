<?php
header('Access-Control-Allow-Origin: http://demo.greengardendigital.com');
header('Access-Control-Allow-Methods: POST');

require_once('connect.php');

if($_POST){
 
    if (isset($_POST['action']) && $_POST['action'] == 'chances') {
    
        if(isset($_POST['dzid']) && isset($_POST['stype'])){
        
            $dzid=protect($_POST['dzid']);
            $type=protect($_POST['stype']);
            
            $conn=new connect();
            $field='';
            switch($type){
                case 'fba':
                    $field='friendFB';
                break;
                case 'twp':
                    $field='shareTW';
                break;
                case 'fbp':
                    $field='shareFB';
                break;
            }
            
            if(!empty($field)){
            
                $sql="UPDATE $conn->tb2 SET $field=1 WHERE dz_id='$dzid'";
                $query=$conn->execute_query($sql);
                if($query){
                    $conn->close_db();
                    echo 'ok';
                    exit;
                }else{
                    echo 'error';
                    exit;
                }
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