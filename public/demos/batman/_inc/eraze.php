<?php
    
    $ref=$_SERVER['REFERER'];
    $host=$_SERVER['HOST'];

    if (!preg_match("/$host/", $ref)) {
        echo 'NOT ALLOWED';
        exit;
    }

    if($_POST){

        if($_POST['action']=='eraze'){
            
            $img = protect($_POST['image']);
            $thumb = protect($_POST['thumb']);
            
            if (file_exists('../_capture/'.$img)) unlink('../_capture/'.$img);
            if (file_exists('../_capture/'.$thumb)) unlink('../_capture/'.$thumb);

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