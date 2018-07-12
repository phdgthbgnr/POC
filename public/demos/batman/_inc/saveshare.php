<?php
    $ref=$_SERVER['REFERER'];
    $host=$_SERVER['HOST'];

    if (!preg_match("/$host/", $ref)) {
        echo 'NOT ALLOWED';
        exit;
    }

    require('connect.php');

    $ret = '';
    $dejajoue='';

    $postid = '';
    $namefic = '';
    $wmid = '';
    $firstname = '';
    $lastname = '';
    $email = '';
    $thumb = '';

    if($_POST){

        if($_POST['action'] == 'publication'){
            
            $postid = protect($_POST['fbpostid']);
            $namefic = protect($_POST['image']);
            $wmid = protect($_POST['mwid']);
            $firstname = protect($_POST['firstname']);
            $lastname = protect($_POST['lastname']);
            $email = $_POST['email'];
            $thumb = protect($_POST['thumb']);
            
            // test si joueur a déjà joué
            
            $conn = new connect();
            
            $sql = "SELECT id_user FROM $conn->tb1 WHERE mw_id='$wmid'";
            $query = $conn->execute_query($sql);
            if($query){
                if (mysql_num_rows($query)){
                    $dejajoue = 'deja_joue';
                }
            }
            
            if (!valid_mail($email)) {
                $ret='mail';
            }
            
            if(empty($ret)){
                $sql="INSERT INTO $conn->tb1 (
                mw_id,
                email,
                firstname,
                lastname,
                fbidpost,
                namefic,
                thumb
                ) VALUES (
                '$wmid',
                '$email',
                '$firstname',
                '$lastname',
                '$postid',
                '$namefic',
                '$thumb'
                )";

                $query=$conn->execute_query($sql);

                if(!$query) {
                    $ret = 'errorbdd4';
                }else{
                    $ret= 'ok';
                }
            
            }
            if(!empty($dejajoue)){
                echo $dejajoue;
            }else{
                echo $ret;
            }
        }

    }


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