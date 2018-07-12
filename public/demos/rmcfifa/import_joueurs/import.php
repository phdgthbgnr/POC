<?php
/*
Met à jour la BDD avec les  33 joueurs de la semaine
aucune dépendance



le fichier txt (UTF-8) doit être correctement structuré :

nom <tab> prenom <tab> poste <tab>  club <tab> description <tab> image <tab> n° semaine </n>



regénérer le fichier json :

trophee-fut-rmcsport.bfmtv.com/?refresh


*/
include('../_inc/connect.php');
include('../_inc/utilsggd.php');

$conn = new connect();

$file = 'liste_joueur.txt';

$handle = fopen($file, "r");


if ($handle) {
    while (($line = fgets($handle)) !== false) {
        //$tmp            = explode('\t',$line);
        $tmp            = preg_split("/[\t]/", $line);
        $nom            = strtolower(trim($tmp[0]));
        $prenom         = strtolower(trim($tmp[1]));
        $poste          = strtolower(trim($tmp[2]));
        $club           = strtolower(trim($tmp[3]));
        $performance    = protect(trim($tmp[4]));
        $image          = strtolower(trim($tmp[5]));
        $semaine        = strtolower(trim($tmp[6]));

        print_r($tmp);

        echo $nom.'<br/>';
        echo $prenom.'<br/>';
        echo $poste.'<br/>';
        echo $club.'<br/>';
        echo $performance.'<br/>';
        echo $image.'<br/>';
        echo $semaine.'<br/>';
        echo '----------------------------'.'<br/>';

        // get club id
        $idclub = 0;
        $sql = "SELECT id_club FROM $conn->tb2 WHERE $conn->tb2.nom_club = '$club'";
        $query = $conn->execute_query($sql);
        if($query){
            $nb = $query->num_rows;
                // club pas encore enregistre
            if($nb == 0){
                $sql = "INSERT INTO $conn->tb2 (nom_club) VALUES ('$club')";
                $query = $conn->execute_query($sql);
                if($query) $idclub = mysqli_insert_id($conn->connt);
            }else{
                // recupere id club
                mysqli_data_seek($query,0);
                $myrow =  mysqli_fetch_row($query);
                $idclub = $myrow[0];
            }
        }

        // get poste id
        $idposte = 0;
        $sql = "SELECT id_postes FROM $conn->tb5 WHERE abbrv_poste = '$poste'";
        $query = $conn->execute_query($sql);
        if($query){
            if($query->num_rows > 0){
                mysqli_data_seek($query,0);
                $myrow =  mysqli_fetch_row($query);
                $idposte = $myrow[0];
            }else{
                die('CE POSTE N\'EXISTE PAS !');
            }
        }

        // get ID JOUEUR
        $idjoueur = 0;
        $sql = "SELECT id_joueur FROM $conn->tb3 WHERE $conn->tb3.nom_joueur = '$nom' AND $conn->tb3.prenom_joueur = '$prenom' AND $conn->tb3.club_id = '$idclub'";
        $query = $conn->execute_query($sql);
        if($query){
            $nb = $query->num_rows;
            // joueur pas encore enregistre
            if($nb == 0){
                $sql = "INSERT INTO $conn->tb3 (nom_joueur,prenom_joueur,image_joueur,poste_id,club_id) VALUES ('$nom','$prenom','$image','$idposte','$idclub')";
                $query = $conn->execute_query($sql);
                if($query){
                    $idjoueur = mysqli_insert_id($conn->connt);
                }
            }else{
                mysqli_data_seek($query,0);
                $myrow =  mysqli_fetch_row($query);
                $idjoueur = $myrow[0];
            }
        }

        if($idclub > 0 && $idposte > 0 && $idjoueur > 0){
            $sql = "INSERT INTO $conn->tb9 (
                joueur_id,
                poste_id,
                club_id,
                semaine,
                performance
                ) VALUES (
                '$idjoueur',
                '$idposte',
                '$idclub',
                '$semaine',
                '$performance'    
                )";
            $query = $conn->execute_query($sql);
            if(!$query) die('ERREUR A L\'ENREGISTRER LA LIGNE : '.$line);
        }else{
            die('IMPOSSIBLE D\'ENREGISTRER LA LIGNE : '.$line);
        }

    }

    fclose($handle);

} else {
    // error opening the file.
} 

?>