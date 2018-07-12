<?php
    // session_start();
    // $tokens=$_SESSION['token'];

    include('../_inc/connect.php');
    include('../_inc/utilsggd.php');

    $result=array();
    $res=array();
  

    if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
        if($_POST){
            // if(isset($_POST['token']) && $_POST['token']==$tokens){
                
                $conn = new connect();

                if(isset($_POST['action'])){

                    switch($_POST['action']){
                        // REFRESH FICHIER JSON
                        // selection des joueurs  de la semaine
                        case 'semfifajoueur':
                            $semaine = 0;
                            $sql = "SELECT semaine FROM $conn->tb0";
                            $query = $conn->execute_query($sql);
                            if($query){
                                $myrow =  mysqli_fetch_row($query);
                                $semaine = $myrow[0];
                                if($semaine >= 0){
                                    // s = table joueurs de la semaine
                                    // j = table joueurs
                                    // p = table poste
                                    // c = table clubs
                                    $sql = "SELECT * FROM $conn->tb9 AS s, $conn->tb3 AS j, $conn->tb5 AS p, $conn->tb2 AS c WHERE s.joueur_id=j.id_joueur AND s.poste_id=p.id_postes AND s.club_id=c.id_club AND s.semaine='$semaine' ORDER BY s.joueur_id, j.nom_joueur";
                                    $query = $conn->execute_query($sql);
                                    if($query){
                                        $temp = array();
                                        while( $row = mysqli_fetch_array($query)){
                                            $poste = $row['abbrv_poste'];
                                            $res['id'] = $row['id_joueur'];
                                            $res['nom'] = $row['nom_joueur'];
                                            $res['prenom'] = $row['prenom_joueur'];
                                            $res['image'] = $row['image_joueur'];
                                            $res['image'] = $row['image_joueur'];
                                            $res['club'] = $row['nom_club'];
                                            $res['clubid'] = $row['id_club'];
                                            $res['poste'] = $row['abbrv_poste'];
                                            $res['posteid'] = $row['id_postes'];
                                            $res['performance'] = $row['performance'];
                                            if(!array_key_exists($poste,$temp)) $temp[$poste] = array();
                                            array_push($temp[$poste],$res);
                                        }
                                        $result = array('error'=>'','data'=>$temp);
                                        $file = '../_json/selectionfifa-'.$semaine.'.json';
                                        $sf = file_put_contents($file,json_encode($result));
                                        if($sf == false){
                                            $result=array('error'=>'save json file');
                                            returnJson($result);
                                        }else{
                                            $result=array('error'=>'','json'=>'ok');
                                            returnJson($result);
                                        }
                                    }else{
                                        $result=array('error'=>'bad query selection fifa semaine');
                                        returnJson($result);
                                    }
                                }else{
                                    $result=array('error'=>'bad week number');
                                    returnJson($result);
                                }
                            } 
                            

                        break;

                        case 'saveprofil':
                            // token image
                            $tokenim = md5(rand(1000,9999));
                        
                            $tz = new DateTimeZone('Europe/Paris');
                            $dateT = new DateTime("now",$tz);
                            $today = $dateT->format("dmY-His");
                            $nomfic = $tokenim.$today;


                            if(!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email']) || !isset($_POST['dataimg'])  || !isset($_POST['reglement'])){
                                $result = array('error'=>'nodata');
                                returnJson($result);
                            }else{
                                $imgdata = substr($_POST['dataimg'],23);
                                $imgdata = str_replace(' ', '+',$imgdata);
                                $data = base64_decode($imgdata);
                                $formImage = imagecreatefromstring($data);
                                // $imgdata = substr($_POST['dataimg'],21);
                                // $data = base64_decode($imgdata);
                                // $formImage = imagecreatefromstring($data);
                                $imgfic = '../_sharing/'.$nomfic.'.jpg';

                                $err = imagejpeg($formImage,$imgfic,90);

                                if(!$err){
                                    $result = array('error'=>'error saving jpeg','data'=> $nomfic);
                                    returnJson($result);
                                    die();
                                }

                                $err = '';
                                try{
                                    $selection = json_decode($_POST['selection']);
                                    if(is_null($selection)) throw new Exception("json selection null");
                                }catch (Exception $e){
                                    $err = $e->getMessage(); 
                                }
                                if(!empty($err)){
                                    $result = array('error'=>'json bad formed','data'=>$err);
                                    returnJson($result);
                                }else{
                                    $nom        = fencrypt(protect($_POST['nom']));
                                    $prenom     = fencrypt(protect($_POST['prenom']));
                                    $email      = fencrypt(protect($_POST['email']));
                                    $semaine    = @intval($_POST['semaine']);
                                    $sql = "INSERT INTO $conn->tb4 (
                                        nom,
                                        prenom,
                                        email,
                                        semaine_int
                                    ) VALUES (
                                        '$nom',
                                        '$prenom',
                                        '$email',
                                        '$semaine'
                                    )";

                                    $query = $conn->execute_query($sql);

                                    if($query){
                                        $idint = mysqli_insert_id($conn->connt);
                                        // enregistre la selection de l'internaute
                                        $bu     = @intval($selection->bu->joueurid);
                                        $mc1    = @intval($selection->mc1->joueurid);
                                        $mc2    = @intval($selection->mc2->joueurid);
                                        $ag     = @intval($selection->ag->joueurid);
                                        $ad     = @intval($selection->ad->joueurid);
                                        $dg     = @intval($selection->dg->joueurid);
                                        $dd     = @intval($selection->dd->joueurid);
                                        $dc1    = @intval($selection->dc1->joueurid);
                                        $dc2    = @intval($selection->dc2->joueurid);
                                        $mdc    = @intval($selection->mdc->joueurid);
                                        $g      = @intval($selection->g->joueurid);

                                        $sql = "INSERT INTO $conn->tb7 (
                                            internaute_id,
                                            int_ssemaine,
                                            int_bu,
                                            int_mc1,
                                            int_mc2,
                                            int_ag,
                                            int_ad,
                                            int_dg,
                                            int_dd,
                                            int_dc1,
                                            int_dc2,
                                            int_mdc,
                                            int_g,
                                            token_image
                                        ) VALUES (
                                            '$idint',
                                            '$semaine',
                                            '$bu',
                                            '$mc1',
                                            '$mc2',
                                            '$ag',
                                            '$ad',
                                            '$dg',
                                            '$dd',
                                            '$dc1',
                                            '$dc2',
                                            '$mdc',
                                            '$g',
                                            '$nomfic'
                                        )";

                                        $query = $conn->execute_query($sql);
                                        if($query){
                                            $idsel = mysqli_insert_id($conn->connt);
                                            $result = array('error'=>'ok','data'=>$nomfic,'id'=>$idsel);
                                            returnJson($result);
                                        }else{
                                            $result = array('error'=>'error saving selection','data'=>'');
                                            returnJson($result);
                                        }

                                    }else{
                                        $result = array('error'=>'error saving profil','data'=>'');
                                        returnJson($result);
                                    }
                                    // enregistre profil joueur
                                }
                            }
                        break;

                        case 'download':
                            if(isset($_POST['shareimg'])){
                                $file = protect($_POST['shareimg']);
                                $reg = '/^([a-zA-Z0-9]){40}-([0-9]{6})$/';
                                if(preg_match($reg,$file)){
                                    $file = $file.'.jpg';
                                    $ffile = '../_sharing/'.$file;
                                    if(file_exists($ffile)){
                                        $err = '';
                                        try{
                                            $fx = file_exists ($ffile);
                                            if(!$fx) throw new Exception("file not exists");
                                        }catch(Exception $e){
                                            $err = $e->getMessage();
                                        }
                                        if(empty($err)){
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
                                        }else{
                                            $result = array('error'=>'error downloading share img','data'=>$err);
                                            returnJson($result);
                                        }
                                    }else{
                                        $result = array('error'=>'file not present','data'=>$file);
                                        returnJson($result);
                                    }
                                }else{
                                    $result = array('error'=>'file name no matching','data'=>$file);
                                    returnJson($result);
                                }
                            }else{
                                $result = array('error'=>'error downloading share img','data'=>'no post string');
                                returnJson($result);
                            }
                        break;

                        case 'sharefacebook':
                            if(isset($_POST['curid']) && $_POST['curid'] != '0'){
                                $idf = protect($_POST['curid']);
                                $sql = "UPDATE $conn->tb7 SET facebook=1 WHERE id_selection_int='$df'";
                                $query = $conn->execute_query($sql);
                                if($query){
                                    $result = array('error'=>'','data'=>'update OK');
                                }else{
                                    $result = array('error'=>'error update table','data'=>'facebbok');
                                } 
                            }
                        
                        break;
                    }

                }else{
                    returnJson('erreuraction');
                }
            // }else{
            //     $err = empty($tokens) ? 'empty token' : 'token not matching';
            //     $result = array('error'=>'token error','data'=>$err);
            //     returnJson($result);   
            // }
        }else{
            returnJson('post error');
        }
    }else{
        returnJson('httprequest error');
    }

    function returnJson($rslt){
        header('Content-Type: application/json charset=utf-8');
        echo json_encode($rslt);
    }

    /*
    function lzw_decode($s) {
        mb_internal_encoding('UTF-8');
      
        $dict = array();
        $currChar = mb_substr($s, 0, 1);
        $oldPhrase = $currChar;
        $out = array($currChar);
        $code = 256;
        $phrase = '';
      
        for ($i=1; $i < mb_strlen($s); $i++) {
            $currCode = implode(unpack('N*', str_pad(iconv('UTF-8', 'UTF-16BE', mb_substr($s, $i, 1)), 4, "\x00", STR_PAD_LEFT)));
            if($currCode < 256) {
                $phrase = mb_substr($s, $i, 1);
            } else {
               $phrase = $dict[$currCode] ? $dict[$currCode] : ($oldPhrase.$currChar);
            }
            $out[] = $phrase;
            $currChar = mb_substr($phrase, 0, 1);
            $dict[$code] = $oldPhrase.$currChar;
            $code++;
            $oldPhrase = $phrase;
        }
        var_dump($dict);
        return(implode($out));
      }
      */
?>