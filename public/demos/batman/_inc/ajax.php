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

    $today=date("dmY-His");

    if(isset($_POST)){

        $id=0;
        
        if(isset($_POST['id'])) $id=$_POST['id'];

        $save = str_replace('data:image/jpeg;base64,', '', $_POST['image'] );
        // resize & crop
        
        /*
        $img=base64_decode( $save );
        
        
        $width     = imagesx($save);
        $height    = imagesy($img);
        $newwidth  = 600;
        $newheight = 730;
        $tmp       = imagecreatetruecolor($newwidth, $newheight);
        $x=0;
        $y=0;

        $widthProportion  = $width / $newwidth;
        $heightProportion = $height / $newheight;

        if ($widthProportion > $heightProportion) {
            // width proportion is greater than height proportion
            // figure out adjustment we need to make to width
            $widthAdjustment = ($width * ($widthProportion - $heightProportion));

            // Shrink width to proper proportion
            $width = $width - $widthAdjustment;

            $x = 0; // No adjusting height position
            $y = $y + ($widthAdjustment / 2); // Center the adjustment
        } else {
            // height proportion is greater than width proportion
            // figure out adjustment we need to make to width
            $heightAdjustment = ($height * ($heightProportion - $widthProportion));

            // Shrink height to proper proportion
            $height = $height - $heightAdjustment;

            $x = $x + ($heightAdjustment / 2); // Center the ajustment
            $y = 0; // No adjusting width position
        }

        imagecopyresampled($tmp, $img, 0, 0, $x, $y, $newwidth, $newheight, $width, $height);
        */
        
        $tmp= base64_decode( $save );
        
        $res=file_put_contents( '../_capture/'.$today.'image'.$id.'.jpg', $tmp );
        
        /*
        $f=dirname(__file__);
        $pos=strrpos($f,'/',-1);
        $path=substr($f,0,$pos);
        
        $temp = imagecreatefromjpeg($path.'/_capture/'.$today.'image'.$id.'.jpg');
        */
        $taille = getimagesizefromstring($tmp);
        
        $nwidth = 200;
        $reduction = ( ($nwidth * 100)/$taille[0] );
        $nheight = ( ($taille[1] * $reduction)/100 );
        
        $thumb = imagecreatetruecolor($nwidth, $nheight);
        
        $temp = imagecreatefromstring($tmp);
        
        imagecopyresampled($thumb , $temp, 0, 0, 0, 0, $nwidth, $nheight, $taille[0], $taille[1]);
        
       // $to_crop_array = array('x' =>0 , 'y' => 0, 'width' => 200, 'height'=> 260);
        
        //$crops = imagecrop($thumb, $to_crop_array);
        
        $r = imagejpeg($thumb , '../_capture/'.$today.'thmb'.$id.'.jpg', 75);
        
        $ret = array($today.'image'.$id.'.jpg',$today.'thmb'.$id.'.jpg');
    }

    echo json_encode($ret);


?>