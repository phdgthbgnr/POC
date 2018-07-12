<?php

if($_GET){
    if(isset($_GET['img'])){
        $file = protect($_GET['img']);
        $file = $file.'.jpg';
        $ffile = 'images/'.$file;
        $size = filesize($ffile);
    
        
        header('Content-Description: File Transfer');
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="'.$file.'"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Length: ' . $size);
        readfile($ffile);
        
        /*
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$file.'"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . $size);
        readfile($ffile);
        */
        
    }
}


function protect($v){

	$v=trim($v);
	//si magic_quotes pas de caractere d'echappement
	$r=htmlspecialchars($v);
	if (get_magic_quotes_gpc()==1){
		$r=$r;
	}else{
		$r=addslashes($r);
	}
	//$r = filter_var($r,FILTER_SANITIZE_STRING);
	return $r;

}

?>