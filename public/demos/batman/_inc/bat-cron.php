#!/usr/local/php5.4/bin/php
<?php

   // chemain de la commande CRON : batmancapandcowldev/_inc/bat-cron.php
    $path = dirname(__FILE__);
    //echo $path;
    require($path.'/connect-cron.php');
    //require('../_inc/connect.php');
    $accesstoken = '';

    $conn = new connect();

    $sql="SELECT * FROM $conn->tb2";
    $query=$conn->execute_query($sql);
    if($query){
        $row = mysql_fetch_array($query);
        $timest = $row['date'];
        $time = strtotime($timest);
        $curtime = time();
        if(($curtime-$time) > 86400) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?client_id=230954650284744&client_secret=3525679926bdc991742a51a7bc8d5479&grant_type=client_credentials");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

            if(!$ret=curl_exec($ch))
            {
                //error
            }

            curl_close($ch);

            if(substr($ret,0,12)=='access_token'){
                $accesstoken=substr($ret,13);
                $today=date("Y-m-d H:i:s");
                $sql="UPDATE $conn->tb2 SET 
                    token='$accesstoken',
                    date='$today'
                    WHERE 
                    id='1'
                    ";
                    $query=$conn->execute_query($sql);
            }

        }else{
            $accesstoken=$row['token'];
        }
    }
    
    
    //$postid = '1586110291645374_1587527631503640';
    $fbpid = 1586110291645374; 
    $appid = 838393766207493; // My Warner - DEV
    $appsecret = 'b5b5e6b6256a0653c1fa965152263fb9'; // My Warner - DEV

    //echo($nbrows);
    $sql="SELECT * FROM $conn->tb1 ORDER BY mdate DESC ";
    $query=$conn->execute_query($sql);

    if($query){
        //$nbrow=floor($nbrows/$nbv); // or round ?
        
        while($row = mysql_fetch_array($query)){
                
            // get nb likes
            
            $likes='';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/".$row['fbidpost']."/likes?summary=true&limit=1000&access_token=".$accesstoken);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true); 
            
            if(!$likes=curl_exec($ch))
            {
                //error
                $likes='';
            }
            if(!empty($likes)) $like=json_decode($likes,true);
            $ll=intval($like['summary']['total_count']);
            
            
            if($ll!=$row['nblikesfb']){
                $iduser=$row['id_user'];
                $sql="UPDATE $conn->tb1 SET 
                    nblikesfb='$ll' 
                    WHERE 
                    id_user='$iduser'
                    ";
                    $query=$conn->execute_query($sql);
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