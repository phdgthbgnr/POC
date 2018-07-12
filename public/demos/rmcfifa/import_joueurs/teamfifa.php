<?php
    $time_start = microtime(true);
    
    include('../_inc/connect.php');
    include('../_inc/utilsggd.php');

    $conn = new connect();

    // recuperation liste txt
    $file = 'team_selection_fifa.txt';
    $handle = fopen($file, "r");

    $res = array();
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            //$tmp            = explode('\t',$line);
            $tmp            = preg_split("/[\t]/", $line);
            $nom            = strtolower(trim($tmp[0]));
            $prenom         = strtolower(trim($tmp[1]));
            $tposte         = strtolower(trim($tmp[2]));
            $semaine        = strtolower(trim($tmp[3]));

            /*
            print_r($tmp);
            echo $nom.'<br/>';
            echo $prenom.'<br/>';
            echo $tposte.'<br/>';
            echo $semaine.'<br/>';
            echo '----------------------------'.'<br/>';
            */

            $coords = array(
                'bu'  => array('x'=>537,'y'=>1),
                'mc1' => array('x'=>404,'y'=>120),
                'mc2' => array('x'=>676,'y'=>120),
                'mdc' => array('x'=>540,'y'=>190),
                'dg'  => array('x'=>209,'y'=>248),
                'dd'  => array('x'=>870,'y'=>248),
                'dc1' => array('x'=>385,'y'=>313),
                'dc2' => array('x'=>680,'y'=>313),
                'ag'  => array('x'=>264,'y'=>44),
                'ad'  => array('x'=>820,'y'=>44),
                'g'   => array('x'=>536,'y'=>440),
            );

            $poste = $tposte;
            if($tposte == 'mc1' || $tposte == 'mc2') $poste = 'mc';
            if($tposte == 'dc1' || $tposte == 'dc2') $poste = 'dc';

            $sql = "SELECT id_postes FROM $conn->tb5 WHERE $conn->tb5.abbrv_poste = '$poste'";
            $query = $conn->execute_query($sql);

            if($query){
                $myrow =  mysqli_fetch_row($query);
                $idposte = $myrow[0];
                $sql = "SELECT * FROM $conn->tb3 WHERE $conn->tb3.nom_joueur = '$nom' AND $conn->tb3.prenom_joueur = '$prenom' AND $conn->tb3.poste_id = '$idposte'";
                $query = $conn->execute_query($sql);
                if($query){
                    if($query->num_rows > 0){
                        mysqli_data_seek($query,0);
                        while( $row = mysqli_fetch_array($query)){
                            $r = array('poste'=>$tposte,'idposte'=>$row['poste_id'],'idjoueur'=>$row['id_joueur'],'nom'=>$row['nom_joueur'],'x'=>$coords[$tposte]['x'],'y'=>$coords[$tposte]['y'],'image'=>'');
                            $res[$tposte] = $r;
                        }
                    }else{
                        die('erreur joueur '.$nom.' - '.$prenom.' - '.$idposte);
                    }
                }else{
                    die('erreur requete joueur');
                } 
            }else{
                die('poste introuvable : '.$poste);
            }


        }
    }

    if(count($res) != 11) die('nombre de joueurs inexact'); 

    $bu     = $res['bu']['idjoueur'];
    $mc1    = $res['mc1']['idjoueur'];
    $mc2    = $res['mc2']['idjoueur'];
    $dc1    = $res['dc1']['idjoueur'];
    $dc2    = $res['dc2']['idjoueur'];
    $ag     = $res['ag']['idjoueur'];
    $ad     = $res['ad']['idjoueur'];
    $dg     = $res['dg']['idjoueur'];
    $dd     = $res['dd']['idjoueur'];
    $mdc    = $res['mdc']['idjoueur'];
    $g      = $res['g']['idjoueur'];

    $smn = 0;
    $sql = "SELECT id_selection_int FROM $conn->tb6 WHERE ssemaine = '$semaine'";
    $query = $conn->execute_query($sql);
    if(!$query) die('impossible de verifier la semaine');

    // remplissage table rmc_selection_fifa

    if($query->num_rows == 0){
    
        $sql = "INSERT INTO $conn->tb6 (
            ssemaine,
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
            int_g
        ) VALUES (
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
            '$g'
        )";
    }else{
        $sql = "UPDATE $conn->tb6 SET 
            int_bu = '$bu',
            int_mc1 = '$mc1',
            int_mc2= '$mc2',
            int_ag = '$ag',
            int_ad = '$ad',
            int_dg = '$dg',
            int_dd = '$dd',
            int_dc1 = '$dc1',
            int_dc2 = '$dc2',
            int_mdc = '$mdc',
            int_g = '$g' 
            WHERE ssemaine='$semaine'";
    }

    $query = $conn->execute_query($sql);
    if(!$query) die('erreur insert ou update equipe');
    
    // creation images d'après rmcfifa_joueurs
    $semaine = 0;
    // verification cohérence 
    $sql = "SELECT semaine FROM $conn->tb0";
    $query = $conn->execute_query($sql);
    if($query){
        $myrow =  mysqli_fetch_row($query);
        $semaine = $myrow[0];
        if($semaine > 0){
            
            $sql = "SELECT 
            int_bu as bu,
            int_mc1 as mc1,
            int_mc2 as mc2,
            int_ag as ag,
            int_ad as ad,
            int_dg as dg,
            int_dd as dd,
            int_dc1 as dc1,
            int_dc2 as dc2,
            int_mdc as mdc,
            int_g as g 
            FROM $conn->tb6 WHERE ssemaine='$semaine'";
            $query = $conn->execute_query($sql);
            if($query){
                $rows = mysqli_fetch_assoc($query);
                foreach($rows as $key => $val){
                    if($res[$key]['idjoueur'] != $val) die('erreur joueur '.$key.' '.$val);
                }             
                
            }else{
                die('erreur recuperation selection fifa');        
            }
        }
    }else{
        die('erreur recuperation num semaine');
    }
    echo '<p>Nouvelle team enregistrée - semaine : '.$semaine.'</p>';
    
    // ajout images
    foreach($res as $key => $val){
        $idj = $val['idjoueur'];
        $sql = "SELECT image_joueur FROM $conn->tb3 WHERE id_joueur='$idj'";
        $query = $conn->execute_query($sql);
        if($query){
            $myrow =  mysqli_fetch_row($query);
            $res[$key]['image'] = $myrow[0];
        }else{
            die('erreur selection image - id_joueur'.$idj);
        }
    }

    echo '<p>Tableau pour la création de l\'image</p>';
    print_r($res);
    // construction de l'image (1200x630)
    
    $host = $_SERVER['HTTP_HOST'];
    $strsmen = $semaine < 10 ? '0'.$semaine : $semaine;
    $_jpg = '../_teamfifa/semaine_'.$strsmen.'.jpg';
    $path = ''; 
    $local = '/'.$host.'/';
    
    if(preg_match($local,'trophee-fut-rmcsport.bfmtv.com')){
        $path = '/usr/bin/convert';
    }elseif (preg_match($local,'centos2') || preg_match($local,'192.168.1.26') || preg_match($local,'192.168.1.53') || preg_match($local,'debian')){
        $path = '/usr/local/bin/convert';
    }

    $bg = '../_img/_joueurs/bg_share.jpg';
    $repjoueur = '../_img/_joueurs/';    
    //script pour exec (convert)
    $execconvert = $path.' -page 1200x630+0+0 '.$bg;
    foreach($res as $key => $val){
        $execconvert.=' -page +'.$val['x'].'+'.$val['y'].' '.$repjoueur.$val['image'];
    }
    $execconvert.=' -layers flatten '.$_jpg.' 2>&1';
    echo '<p>Création de l\'image</p>';
    echo '<p>Commande exécutée : </p>';
    echo '<p>'.$execconvert.'</p>';

    if(!empty($path)){
        exec($execconvert, $output, $retvar);
    }

    if($retvar == 0){
        echo '<p>OK</p>';
        echo '<p>Vérifier l\'image [ '.$_jpg.' ]</p>';
    }else{
        echo '<p>'.$retvar.'</p>';
        print_r($output);
    }

    $time_end = microtime(true);
    //  $execution_time = ($time_end - $time_start)/60; //Minutes
    $execution_time = ($time_end - $time_start)*1000;
    //execution time of the script
    
    $time = $time_end - $_SERVER["REQUEST_TIME_FLOAT"];
    echo '<br/><b>Total Execution Time 1:</b> '.($time).' milliSec';
    echo '<br/><b>Total Execution Time 2:</b> '.$execution_time.' milliSec';

?>