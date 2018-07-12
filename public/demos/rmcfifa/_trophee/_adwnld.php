<?php
    session_start();
    $tokens=$_SESSION['token'];
    
    if($_GET){
        if(isset($_GET['token']) && $_GET['token']==$tokens){
            if(isset($_GET['shareimg'])){
                $file = protect($_GET['shareimg']);
                $reg = '/^([a-zA-Z0-9]){7}_([2]{6})$/';
                if(preg_match($reg,$file)){
                    $file = $file.'.jpg';
                    //$ffile = '../_sharing/'.$file;
                    if(file_exists($file)){
                        $err = '';
                        try{
                            $fx = file_exists ($file);
                            if(!$fx) throw new Exception("file not exists");
                        }catch(Exception $e){
                            $err = $e->getMessage();
                        }
                        if(empty($err)){
                            
                            $tz = new DateTimeZone('Europe/Paris');
                            $dateT = new DateTime("now",$tz);
                            $today = $dateT->format("dmY-His");

                            $size = filesize($file);
                            header('Content-Description: File Transfer');
                            header('Content-Type: image/jpeg');
                            // header('Content-Disposition: attachment; filename="'.$file.'"');
                            header('Content-Disposition: attachment; filename="fifa-ultimate-team-'.$today.'.jpg"');
                            header('Content-Transfer-Encoding: binary');
                            header('Expires: 0');
                            header('Cache-Control: public');
                            header('Pragma: public');
                            header('Content-Length: ' . $size);
                            readfile($file);
                        }
                    }
                }
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
    ?>