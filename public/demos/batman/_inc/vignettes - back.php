<?php

    $ref=$_SERVER['REFERER'];
    $host=$_SERVER['HOST'];

    if (!preg_match("/$host/", $ref)) {
        echo 'NOT ALLOWED';
        exit;
    }

    require('connect.php');
    //require('../_inc/connect.php');
    $accesstoken = '';

    $conn = new connect();

    $offset = 0;
    $result='';
    $line="\n";
    $nbv = 10; // nombres vignettes affichees
    $today=date("Y-m-d");

    if($_POST){
        if(isset($_POST['action']) && $_POST['action']=='vignettes'){
            $mwuser=protect($_POST['mwuser']);
            $offset=protect($_POST['offset']);
            $offst=$offset*$nbv;
            $sql="SELECT count(*) AS cnts FROM $conn->tb1";
            $query=$conn->execute_query($sql);
            $num = mysql_fetch_array($query);
            $nbrows = $num['cnts'];
            //echo($nbrows);
            $sql="SELECT * FROM $conn->tb1 ORDER BY mdate DESC limit $offst, $nbv";
            $query=$conn->execute_query($sql);
            
            if($query){
                $nbrow=floor($nbrows/$nbv); // or round ?
                if($nbrow>0){
                    $result='<div class="pagination">'.$line;
                    $result.='<ul class="pages">'.$line;
                    for ($i=0; $i<=$nbrow; $i++) {
                        $img=$offset==$i?'offset1.png':'offset2.png';
                        $result.='<li><a href="off-'.$i.'" class="offset"><img src="../_images/'.$img.'"/></a></li>';
                    }
                    $result.='</ul>';
                    $result.='</div>'.$line;
                }else{
                    $result='<div class="pagination"></div>'.$line;
                }
                $result.='<ul class="thumbs">'.$line;
                
                while($row = mysql_fetch_array($query)){
                    
                    $cur = $row['mw_id']==$mwuser?1:0;
                    $curss= $cur==1?' current':'';
                    
                    if($mwuser==0){
                        $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" class="popup"><img src="../_capture/'.$row['thumb'].'"/></a><div class="nolikes"><span>'.$row['mw_likes'].'</span></div></li>'.$line;
                    }else{
                        $user=$row['id_user'];
                        $sql2="SELECT id_vote FROM $conn->tb3 WHERE id_publ='$user' AND idwarner_votant='$mwuser'";
                        $query2=$conn->execute_query($sql2);
                        if($query2){
                            $n = mysql_num_rows($query2);
                            if($n==0 && $cur==0){
                                $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" class="popup"><img src="../_capture/'.$row['thumb'].'"/></a><a class="mwlikes" href="v-'.$row['id_user'].'"><span>'.$row['mw_likes'].'</span></a></li>'.$line;
                            }else{
                                
                                $sql3="SELECT id_vote FROM $conn->tb3 WHERE id_publ='$user' AND date < '$today'";
                                $query3=$conn->execute_query($sql3);
                                if($query3){
                                    $nn = mysql_num_rows($query3);
                                    if($nn==0){
                                        $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" class="popup"><img src="../_capture/'.$row['thumb'].'"/></a><a class="mwlikes" href="v-'.$row['id_user'].'"><span>'.$row['mw_likes'].'</span></a></li>'.$line;
                                    }else{
                                        $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" class="popup'.$curss.'"><img src="../_capture/'.$row['thumb'].'"/></a><div class="nolikes"><span>'.$row['mw_likes'].'</span></div></li>'.$line;
                                    }
                                    
                                }
                                
                            }
                        }
                    }

                }
                
                $result.='</ul>'.$line;
            }
            
            echo $result;
            
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