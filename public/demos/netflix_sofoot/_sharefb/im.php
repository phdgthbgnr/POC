<?php

$host = $_SERVER['HTTP_HOST'];

  //$time_start = microtime(true);


  //$disabled = explode(', ', ini_get('disable_functions'));
  //print_r($disabled);
  //echo '<br/>';

  //ini_set('display_errors',1);
  //error_reporting(E_ALL);

if($_POST){

    $ret = '';
    
    if(isset($_POST['gardien']) && isset($_POST['defenseur1']) && isset($_POST['defenseur2']) && isset($_POST['attaquant1']) && isset($_POST['attaquant2'])){
    
        $tokens = md5(rand(1000,9999));

        $tz = new DateTimeZone('Europe/Paris');
        $dateT = new DateTime("now",$tz);
        $today = $dateT->format("dmY-His");

        $_jpg = '../sharing/images/'.$tokens.$today.'.jpg';
        $name = $tokens.$today;
        $path = '';
        $local = '/'.$host.'/';
          // servermac
        if(preg_match($local,'servermac.local') || preg_match($local,'192.168.1.26')){
             $path = '/opt/local/bin/convert';
        }
        //exec('/opt/local/bin/convert -quality 80 '.$_pdf.' -colorspace RGB -resize 800 '.$_jpg.' 2>&1', $output, $retvar);
        //exec('/opt/local/bin/convert -page 1200x625+1+1 sharing_bg.jpg -page +200+200 joueur02.png -page +1+1 joueur01.png -layers flatten '.$_jpg.' 2>&1', $output, $retvar);
           // ovh
        if(preg_match($local,'sftntflx.entertainmentggd.com')){
             $path = '/usr/bin/convert';
        }
        //exec('/usr/bin/convert -quality 80 '.$_pdf.' -colorspace RGB -resize 800 '.$_jpg.' 2>&1', $output, $retvar);
        //exec('/usr/bin/convert -page 1200x625+1+1 sharing_bg.jpg -page +200+200 joueur02.png -page +1+1 joueur01.png -layers flatten '.$_jpg.' 2>&1', $output, $retvar);
        $pathfic = 'sources/';
        
        $bg = $pathfic.'sharing_bg.jpg';
        $joueur1 = $pathfic.protect($_POST['gardien']);
        $joueur2 = $pathfic.protect($_POST['defenseur1']);
        $joueur3 = $pathfic.protect($_POST['defenseur2']);
        $joueur4 = $pathfic.protect($_POST['attaquant1']);
        $joueur5 = $pathfic.protect($_POST['attaquant2']);

        if(!empty($path)){
          exec($path.' -page 1200x625+0+0 '.$bg.' -page +480+5 '.$joueur1.' -page +210+115 '.$joueur2.' -page +750+115 '.$joueur3.' -page +300+370 '.$joueur4.' -page +655+370 '.$joueur5.' -layers flatten '.$_jpg.' 2>&1', $output, $retvar);
        }

        //echo $retvar;
        if($retvar == 0){
            $ret = array('name' => $name);
        }else{
            $ret = array('erreur');
        }

    }else{
        $ret = array('nodata');
    }
    
    echo json_encode($ret);
    
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

/*
  $time_end = microtime(true);
//  $execution_time = ($time_end - $time_start)/60; //Minutes
  $execution_time = ($time_end - $time_start)*1000;
  //execution time of the script

  $time = $time_end - $_SERVER["REQUEST_TIME_FLOAT"];
  echo '<br/><b>Total Execution Time 1:</b> '.($time*1000).' milliSec';
  echo '<br/><b>Total Execution Time 2:</b> '.$execution_time.' milliSec';
  //$im = new Imagick();
*/
?>
