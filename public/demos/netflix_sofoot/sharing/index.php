<?php

/*
$imag = 'defaut.jpg';
if($_GET){
    if(isset($_GET['img'])){
        $im = protect($_GET['img']);
        $fl = $im.'jpg';
        $fext = '/sharing/images/'.$fl;
        if(file_exists($fext)) {
            $imag = $fl;
            echo $imag;
        }
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


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DREAMTEAM 5 NETFLIX</title>
    <meta property="og:url" content="http://sftntflx.entertainmentggd.com/sharing/index.php?img=<?php echo $imag?>" />
    <meta property="og:title" content="DREAMTEAM 5 NETFLIX - THE MOST BADASS" />
    <meta property="og:description" content="COMPOSE TON EQUIPE" />
    <meta property="og:image" content="http://sftntflx.entertainmentggd.com/sharing/images/<?php echo $imag ?>" />
    <link rel="canonical" href="http://www.sofoot.com/netflix-436401.html" />
</head>

<body>
    <p>DREAMTEAM 5 NETFLIX - THE MOST BADASS</p>
    <p>COMPOSE TON EQUIPE</p>
</body>
</html>
*/
?>