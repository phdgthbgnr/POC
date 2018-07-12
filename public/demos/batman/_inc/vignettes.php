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
    //$today=date("Y-m-d H:i:s");
    $today=date("Y-m-d");
    $tri='';

    if($_POST){
        if(isset($_POST['action']) && $_POST['action']=='vignettes'){
            if(isset($_POST['tri'])){
                $tri=protect($_POST['tri']);
            }
            $nom=protect($_POST['nom']);
            $prenom=protect($_POST['prenom']);
            $mwuser=protect($_POST['mwuser']);
            $offset=protect($_POST['offset']);
            $offst=$offset*$nbv;
            $sql="SELECT count(*) AS cnts FROM $conn->tb1";
            $query=$conn->execute_query($sql);
            $num = mysql_fetch_array($query);
            $nbrows = $num['cnts'];
            //echo($nbrows);
            $sql="SELECT * FROM $conn->tb1 ORDER BY mdate DESC limit $offst, $nbv";
            switch($tri){
                case 'plusrecent':
                    $sql="SELECT * FROM $conn->tb1 ORDER BY mdate DESC limit $offst, $nbv";
                break;
                case 'plusancien':
                    $sql="SELECT * FROM $conn->tb1 ORDER BY mdate ASC limit $offst, $nbv";
                break;
                case 'popudesc':
                    $sql="SELECT * FROM $conn->tb1 ORDER BY mw_likes DESC limit $offst, $nbv";
                break;
                case 'popuasc':
                    $sql="SELECT * FROM $conn->tb1 ORDER BY mw_likes asc limit $offst, $nbv";
                break;
                case 'rech':
                    if(empty($nom) && !empty($prenom)) $sql="SELECT * FROM $conn->tb1 WHERE firstname='$prenom'";
                    if(empty($prenom) && !empty($nom)) $sql="SELECT * FROM $conn->tb1 WHERE lastname='$nom'";
                    if(!empty($prenom) && !empty($nom)) $sql="SELECT * FROM $conn->tb1 WHERE lastname='$nom' AND firstname='$prenom'";
                break;
            }
            $query=$conn->execute_query($sql);
            
            if($query){
                $nbrow=floor($nbrows/$nbv); // or round ?
                if($nbrow>0){
                    $result='<div class="pagination">'.$line;
                    $result.='<ul class="pages">'.$line;
                    $avant=$offset-1<0?0:$offset-1;
                    $apres=$offset+1<=$nbrow?$offset+1:$nbrow;
                    $result.='<li><a href="off-'.$avant.'" class="offset"><img src="../_images/avant.png"/></a></li>';
                    $c=$nbrow;
                    $d=0;
                    if($nbrow>10)$c=$offset+10;
                    if($c>$nbrow) $c=$nbrow;
                    if(($c-10)>0) $d=$c-10;
                    for ($i=$d; $i<=$c; $i++) {
                        $img=$offset==$i?'offset1.png':'offset2.png';
                        $css=$offset==$i?' curr':'';
                        //$result.='<li><a href="off-'.$i.'" class="offset"><img src="../_images/'.$img.'"/></a></li>';
                        $result.='<li><a href="off-'.$i.'" class="offset'.$css.'">'.($i+1).'</a></li>';
                    }
                    $result.='<li><a href="off-'.$apres.'" class="offset"><img src="../_images/apres.png"/></a></li>';
                    $result.='</ul>';
                    $result.='</div>'.$line;
                }else{
                    $result='<div class="pagination"></div>'.$line;
                }
                $result.='<ul class="thumbs">'.$line;
                
                while($row = mysql_fetch_array($query)){
                    
                    $cur = $row['mw_id']==$mwuser?1:0;
                    $curss= $cur==1?' current':'';
                    $user=$row['id_user'];
                    if($mwuser==='0'){
                        $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" data-votes="'.$row['mw_likes'].'" data-allow="no" class="popup" data-id="'.$row['id_user'].'"><img src="../_capture/'.$row['thumb'].'"/></a><div class="nolikes"><span>'.$row['mw_likes'].'</span></div></li>'.$line;
                    }else{
                        //$sql1="SELECT id_vote, DATE_FORMAT(date(mydate), '%Y-%m-%d') FROM $conn->tb3 WHERE id_publ='$user' AND date(mydate) = date '$today'";
                        //$query1=$conn->execute_query($sql1);
                        //if($query1){
                          //  $n = mysql_num_rows($query1);
                            //echo $n;
                            //if($n==0){
                                //if(!$cur){
                                //    $result.='a <li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" data-votes="'.$row['mw_likes'].'" data-allow="yes" data-id="'.$row['id_user'].'" class="popup'.$curss.'"><img src="../_capture/'.$row['thumb'].'"/></a><a class="mwlikes" href="v-'.$row['id_user'].'"><span>'.$row['mw_likes'].'</span></a></li>'.$line;
                                //}else{
                                   //$result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" data-votes="'.$row['mw_likes'].'" data-allow="no" data-id="'.$row['id_user'].'" class="popup'.$curss.'"><img src="../_capture/'.$row['thumb'].'"/></a><div class="nolikes"><span>'.$row['mw_likes'].'</span></div></li>'.$line;
                                //}
                            //}else{

                                //$sql2="SELECT id_vote, DATE_FORMAT(date(mydate), '%Y-%m-%d') FROM $conn->tb3 WHERE id_publ='$user' AND idwarner_votant='$mwuser' AND date(mydate) = date '$today'";
                                $sql2="SELECT id_vote, DATE_FORMAT(date(mydate), '%Y-%m-%d') FROM $conn->tb3 WHERE idwarner_votant='$mwuser' AND date(mydate) = date '$today'";
                                $query2=$conn->execute_query($sql2);
                                if($query2){
                                    $n = mysql_num_rows($query2);
                                    if($n>0){
                                       $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" data-votes="'.$row['mw_likes'].'" data-allow="no" data-id="'.$row['id_user'].'" class="popup'.$curss.'"><img src="../_capture/'.$row['thumb'].'"/></a><div class="nolikes"><span>'.$row['mw_likes'].'</span></div></li>'.$line;
                                        //$result.='d <li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" data-votes="'.$row['mw_likes'].'" data-allow="yes" data-id="'.$row['id_user'].'" class="popup'.$curss.'"><img src="../_capture/'.$row['thumb'].'"/></a><a class="mwlikes" href="v-'.$row['id_user'].'"><span>'.$row['mw_likes'].'</span></a></li>'.$line;
                                    }else{
                                        if($cur){
                                            $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" data-votes="'.$row['mw_likes'].'" data-allow="no" data-id="'.$row['id_user'].'" class="popup'.$curss.'"><img src="../_capture/'.$row['thumb'].'"/></a><div class="nolikes"><span>'.$row['mw_likes'].'</span></div></li>'.$line;
                                        }else{
                                        $result.='<li class="vignette"><a href="../_capture/'.$row['namefic'].'" id="nb'.$row['id_user'].'" data-votes="'.$row['mw_likes'].'" data-allow="yes" data-id="'.$row['id_user'].'" class="popup'.$curss.'"><img src="../_capture/'.$row['thumb'].'"/></a><a class="mwlikes" href="v-'.$row['id_user'].'"><span>'.$row['mw_likes'].'</span></a></li>'.$line;
                                        }
                                    }
                                }
                           // }
                       // }
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