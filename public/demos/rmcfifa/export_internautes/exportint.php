<?php

    $today=date("d.m.Y-His");

    
    header('Content-type: text/html; charset=utf-8');
    //header("Content-Type: application/xls");
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=rmcfifa-fut".$today.".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    

    include('../_inc/connect.php');
    include('../_inc/utilsggd.php');

    // $idsemaine = 1;
    // $selectionEA = array(7,9,21,29,27,30,0,0,0,0,0);
    
    // $idsemaine = 2;
    // $selectionEA = array(40,41,56,65,0,0,0,0,0,0,0);
    
    //$idsemaine = 3;
    //$selectionEA = array(85,86,94,95,97,98,0,0,0,0,0);
	
	// $idsemaine = 4;
    // $selectionEA = array(100,127,121,30,0,0,0,0,0,0,0);
    
    // $idsemaine = 5;
    // $selectionEA = array(81,128,133,139,155,0,0,0,0,0,0);
    
    // $idsemaine = 6;
    // $selectionEA = array(158,159,163,168,178,0,0,0,0,0,0);
    
    // $idsemaine = 8;
    // $selectionEA = array(218,228,241,242,243,0,0,0,0,0,0);
    
    // $idsemaine = 9;
    // $selectionEA = array(217,253,257,265,268,276,0,0,0,0,0);

    // $idsemaine = 10;
    // $selectionEA = array(281,286,272,297,309,303,307,308,305,0,0);
    
    $idsemaine = 11;
    $selectionEA = array(310,317,329,336,333,337,0,0,0,0,0);

    $conn = new connect();
    $sql = "SELECT * FROM $conn->tb4 WHERE semaine_int = '$idsemaine'";
    $query = $conn->execute_query($sql);

    $tab = "\t";
	$ret = "\n";
	$line = '';
	$data = '';
    $header = 'ID'.$tab.'NOM'.$tab.'PRENOM'.$tab.'EMAIL'.$tab.'SEMAINE'.$tab.'DATE'.$tab.'DIFF';
                
    while( $row = mysqli_fetch_array($query)){

        $id = $row['id_internaute'];
        $v = $id.$tab;
		$line .= $v;

        $v = str_replace('"', '""', fdecrypt($row['nom']));
		$v = $v.$tab;
		$line .= $v;
        
        $v = str_replace('"', '""', fdecrypt($row['prenom']));
		$v = $v.$tab;
		$line .= $v;
        
        $v = str_replace('"', '""', fdecrypt($row['email']));
		$v = $v.$tab;
        $line .= $v;
        
        $v = str_replace('"', '""', $row['semaine_int']);
		$v = $v.$tab;
		$line .= $v;
        
        $v = str_replace('"', '""', $row['date_internaute']);
		$v = $v.$tab;
        $line .= $v;
        
        // $data .= $line.$ret;
		// $line = '';


        //$$data .= 'Nom joueur'.$tab.'prenom joueur'.$tab.'poste'.$tab.''.$tab.''.$ret;

       
        //$selectionEA = array(5,8,9,13,15,20,22);

        //sort($selectionEA);

        $sql2 = "SELECT int_bu, int_mc1, int_mc2, int_ag, int_ad, int_dg, int_dd, int_dc1, int_dc2, int_mdc, int_g FROM $conn->tb7 WHERE $conn->tb7.internaute_id = '$id' AND $conn->tb7.int_ssemaine = '$idsemaine'";
        $query2 = $conn->execute_query($sql2);
        while($row2 = mysqli_fetch_row($query2)){
            $tempa = array();
            foreach($row2 as $k => $ids){

                // $i = (string) $id;
                array_push($tempa,$ids);
                // test si ID est dans la sélection
                /*
                $sql3 = "SELECT $conn->tb3.nom_joueur, $conn->tb3.prenom_joueur, $conn->tb5.nom_postes FROM $conn->tb3, $conn->tb5 WHERE $conn->tb3.id_joueur = '$id' AND $conn->tb5.id_postes = $conn->tb3.poste_id";
                $query3 = $conn->execute_query($sql3);
                
                while($row3 = mysqli_fetch_array($query3)){
                    $v = str_replace('"', '""', $row3['nom_joueur']);
                    $v = $v.$tab;
                    $line .= $v;
                    
                    $v = str_replace('"', '""', $row3['prenom_joueur']);
                    $v = $v.$tab;
                    $line .= $v;
                    
                    $v = str_replace('"', '""', $row3['nom_postes']);
                    $v = $v.$tab;
                    $line .= $v;

                    $data .= $line.$ret;
		            $line = '';
                }
                */
            }
            //sort($tempa);
            //echo implode("\t", $selectionEA).$ret;
            $containsAllValues = array_diff($selectionEA, $tempa);
            $df = count($containsAllValues);
            $df -= 5; // 7 = nombre de zero dans selectionEA
            $data .= $line.$df.$ret;
            $line = '';
            // if($containsAllValues){
            //     $data .= $line.$ret;
		    //     $line = '';
            // }else{
            //     $line = '';
            // }
        }

    }

    $conn->close_db();
	//$data = preg_replace("/\r\n|\n\r|\n|\r/", " ", $data);
	echo $header."\n".$data;
?>