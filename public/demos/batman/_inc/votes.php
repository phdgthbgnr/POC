<?php

    $ref=$_SERVER['REFERER'];
    $host=$_SERVER['HOST'];

    if (!preg_match("/$host/", $ref)) {
        echo 'NOT ALLOWED';
        exit;
    }
    
    require('connect.php');
    
    $conn=new connect();
    $ret='error';
    $today=date("Y-m-d H:i:s");

     if($_POST){
        if(isset($_POST['action']) && $_POST['action']=='vote'){
            $mwuser=protect($_POST['mwuser']);
            $idthumb=protect($_POST['thumb']);
            $id=intval(substr($idthumb,2));
            $sql="SELECT id_vote FROM $conn->tb3 WHERE idwarner_votant='$mwuser' AND id_publ='$id'";
            $query=$conn->execute_query($sql);
            if($query){
                if(mysql_num_rows($query)==0){
                    $sql2="INSERT INTO $conn->tb3 (
                    idwarner_votant,
                    id_publ
                    ) VALUES (
                    '$mwuser',
                    '$id'
                    )";
                    $query2=$conn->execute_query($sql2);
                    if($query2){
                        $sql3="UPDATE $conn->tb1 SET mw_likes=mw_likes+1 WHERE id_user='$id'";
                        $query3=$conn->execute_query($sql3);
                        if($query3) $ret='ok';
                    }
                }else{
                    $sql2="UPDATE $conn->tb3 SET mydate='$today' WHERE idwarner_votant='$mwuser' AND id_publ='$id'";
                    $query2=$conn->execute_query($sql2);
                    if($query2){
                        $sql3="UPDATE $conn->tb1 SET mw_likes=mw_likes+1 WHERE id_user='$id'";
                        $query3=$conn->execute_query($sql3);
                        if($query3) $ret='ok';
                    }
            }
        }
     }
     }

    echo $ret;


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