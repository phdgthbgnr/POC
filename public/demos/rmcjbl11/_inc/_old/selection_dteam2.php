<?php
require_once('../utilsggd.php');
require('../connect.php');

$conn = new connect();

$sql="SELECT * FROM rmc11_dt_selection_temp ORDER BY formation ASC";
$query = $conn->execute_query($sql);
if($query){
  while($row = mysql_fetch_assoc($query)){
    $formation = $row['formation'];
    $id = $row['id_dt'];
    if( $formation == 442){

      // gardiens
        $gar = strtolower(trim($row['joueur1']));
        if(!empty($gar)){
          $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$gar'";
          $query2 = $conn->execute_query($sql);
          if($query2){
            $idj = mysql_result($query2,0);
            if($idj){
              $sql = "INSERT INTO rmc11_dreamteam_selection (
                id_dt_slc,
                formation_dt,
                id_gardiens_slc
              )
              VALUES (
                '$id',
                '$formation',
                '$idj'
              )
              ";
              $conn->execute_query($sql);
            }else{
              echo $gar;
            }
          }
        }

        // defenseurs centraux
        for($t=2;$t<=3;$t++){
          $def = strtolower(trim($row['joueur'.$t]));
          if(!empty($def)){
            $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
            $query2 = $conn->execute_query($sql);
            if($query2){
              $idj=mysql_result($query2,0);
              if($idj){
                $sql = "INSERT INTO rmc11_dreamteam_selection (
                  id_dt_slc,
                  formation_dt,
                  id_defenseursc_slc
                )
                VALUES (
                  '$id',
                  '$formation',
                  '$idj'
                )
                ";
                $conn->execute_query($sql);
              }else{
                echo $def;
              }
            }
          }
        }

        // defenseurs lateraux
        for($t=4;$t<=5;$t++){
          $def = strtolower(trim($row['joueur'.$t]));
          if(!empty($def)){
            $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
            $query2 = $conn->execute_query($sql);
            if($query2){
              $idj=mysql_result($query2,0);
              if($idj){
                $sql = "INSERT INTO rmc11_dreamteam_selection (
                  id_dt_slc,
                  formation_dt,
                  id_defenseursl_slc
                )
                VALUES (
                  '$id',
                  '$formation',
                  '$idj'
                )
                ";
                $conn->execute_query($sql);
              }else{
                echo $def;
              }
            }
          }
        }

        // defenseurs milieux defensifs
        for($t=6;$t<=7;$t++){
          $def = strtolower(trim($row['joueur'.$t]));
          if(!empty($def)){
            $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
            $query2 = $conn->execute_query($sql);
            if($query2){
              $idj=mysql_result($query2,0);
              if($idj){
                $sql = "INSERT INTO rmc11_dreamteam_selection (
                  id_dt_slc,
                  formation_dt,
                  id_milieuxd_slc
                )
                VALUES (
                  '$id',
                  '$formation',
                  '$idj'
                )
                ";
                $conn->execute_query($sql);
              }else{
                echo $def;
              }
            }
          }
        }

        // defenseurs milieux offensifs
        for($t=8;$t<=9;$t++){
          $def = strtolower(trim($row['joueur'.$t]));
          if(!empty($def)){
            $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
            $query2 = $conn->execute_query($sql);
            if($query2){
              $idj=mysql_result($query2,0);
              if($idj){
                $sql = "INSERT INTO rmc11_dreamteam_selection (
                  id_dt_slc,
                  formation_dt,
                  id_milieuxo_slc
                )
                VALUES (
                  '$id',
                  '$formation',
                  '$idj'
                )
                ";
                $conn->execute_query($sql);
              }else{
                echo $def;
              }
            }
          }
        }


        // attaquants
        for($t=10;$t<=11;$t++){
          $def = strtolower(trim($row['joueur'.$t]));
          if(!empty($def)){
            $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
            $query2 = $conn->execute_query($sql);
            if($query2){
              $idj=mysql_result($query2,0);
              if($idj){
                $sql = "INSERT INTO rmc11_dreamteam_selection (
                  id_dt_slc,
                  formation_dt,
                  id_attaquants_slc
                )
                VALUES (
                  '$id',
                  '$formation',
                  '$idj'
                )
                ";
                $conn->execute_query($sql);
              }else{
                echo $def;
              }
            }
          }
        }
      }

    if( $formation == 4132){

        // gardiens
          $gar = strtolower(trim($row['joueur1']));
          if(!empty($gar)){
            $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$gar'";
            $query2 = $conn->execute_query($sql);
            if($query2){
              $idj = mysql_result($query2,0);
              if($idj){
                $sql = "INSERT INTO rmc11_dreamteam_selection (
                  id_dt_slc,
                  formation_dt,
                  id_gardiens_slc
                )
                VALUES (
                  '$id',
                  '$formation',
                  '$idj'
                )
                ";
                $conn->execute_query($sql);
              }else{
                echo $gar;
              }
            }
          }

          // defenseurs centraux
          for($t=2;$t<=3;$t++){
            $def = strtolower(trim($row['joueur'.$t]));
            if(!empty($def)){
              $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
              $query2 = $conn->execute_query($sql);
              if($query2){
                $idj=mysql_result($query2,0);
                if($idj){
                  $sql = "INSERT INTO rmc11_dreamteam_selection (
                    id_dt_slc,
                    formation_dt,
                    id_defenseursc_slc
                  )
                  VALUES (
                    '$id',
                    '$formation',
                    '$idj'
                  )
                  ";
                  $conn->execute_query($sql);
                }else{
                  echo $def;
                }
              }
            }
          }

          // defenseurs lateraux
          for($t=4;$t<=5;$t++){
            $def = strtolower(trim($row['joueur'.$t]));
            if(!empty($def)){
              $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
              $query2 = $conn->execute_query($sql);
              if($query2){
                $idj=mysql_result($query2,0);
                if($idj){
                  $sql = "INSERT INTO rmc11_dreamteam_selection (
                    id_dt_slc,
                    formation_dt,
                    id_defenseursl_slc
                  )
                  VALUES (
                    '$id',
                    '$formation',
                    '$idj'
                  )
                  ";
                  $conn->execute_query($sql);
                }else{
                  echo $def;
                }
              }
            }
          }

          // defenseurs milieux defensifs
            $def = strtolower(trim($row['joueur6']));
            if(!empty($def)){
              $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
              $query2 = $conn->execute_query($sql);
              if($query2){
                $idj=mysql_result($query2,0);
                if($idj){
                  $sql = "INSERT INTO rmc11_dreamteam_selection (
                    id_dt_slc,
                    formation_dt,
                    id_milieuxd_slc
                  )
                  VALUES (
                    '$id',
                    '$formation',
                    '$idj'
                  )
                  ";
                  $conn->execute_query($sql);
                }else{
                  echo $def;
                }
              }
            }


          // defenseurs milieux offensifs
          for($t=7;$t<=9;$t++){
            $def = strtolower(trim($row['joueur'.$t]));
            if(!empty($def)){
              $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
              $query2 = $conn->execute_query($sql);
              if($query2){
                $idj=mysql_result($query2,0);
                if($idj){
                  $sql = "INSERT INTO rmc11_dreamteam_selection (
                    id_dt_slc,
                    formation_dt,
                    id_milieuxo_slc
                  )
                  VALUES (
                    '$id',
                    '$formation',
                    '$idj'
                  )
                  ";
                  $conn->execute_query($sql);
                }else{
                  echo $def;
                }
              }
            }
          }


          // attaquants
          for($t=10;$t<=11;$t++){
            $def = strtolower(trim($row['joueur'.$t]));
            if(!empty($def)){
              $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
              $query2 = $conn->execute_query($sql);
              if($query2){
                $idj=mysql_result($query2,0);
                if($idj){
                  $sql = "INSERT INTO rmc11_dreamteam_selection (
                    id_dt_slc,
                    formation_dt,
                    id_attaquants_slc
                  )
                  VALUES (
                    '$id',
                    '$formation',
                    '$idj'
                  )
                  ";
                  $conn->execute_query($sql);
                }else{
                  echo $def;
                }
              }
            }
          }
        }

    if( $formation == 433){

            // gardiens
              $gar = strtolower(trim($row['joueur1']));
              if(!empty($gar)){
                $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$gar'";
                $query2 = $conn->execute_query($sql);
                if($query2){
                  $idj = mysql_result($query2,0);
                  if($idj){
                    $sql = "INSERT INTO rmc11_dreamteam_selection (
                      id_dt_slc,
                      formation_dt,
                      id_gardiens_slc
                    )
                    VALUES (
                      '$id',
                      '$formation',
                      '$idj'
                    )
                    ";
                    $conn->execute_query($sql);
                  }else{
                    echo $gar;
                  }
                }
              }

              // defenseurs centraux
              for($t=2;$t<=3;$t++){
                $def = strtolower(trim($row['joueur'.$t]));
                if(!empty($def)){
                  $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
                  $query2 = $conn->execute_query($sql);
                  if($query2){
                    $idj=mysql_result($query2,0);
                    if($idj){
                      $sql = "INSERT INTO rmc11_dreamteam_selection (
                        id_dt_slc,
                        formation_dt,
                        id_defenseursc_slc
                      )
                      VALUES (
                        '$id',
                        '$formation',
                        '$idj'
                      )
                      ";
                      $conn->execute_query($sql);
                    }else{
                      echo $def;
                    }
                  }
                }
              }

              // defenseurs lateraux
              for($t=4;$t<=5;$t++){
                $def = strtolower(trim($row['joueur'.$t]));
                if(!empty($def)){
                  $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
                  $query2 = $conn->execute_query($sql);
                  if($query2){
                    $idj=mysql_result($query2,0);
                    if($idj){
                      $sql = "INSERT INTO rmc11_dreamteam_selection (
                        id_dt_slc,
                        formation_dt,
                        id_defenseursl_slc
                      )
                      VALUES (
                        '$id',
                        '$formation',
                        '$idj'
                      )
                      ";
                      $conn->execute_query($sql);
                    }else{
                      echo $def;
                    }
                  }
                }
              }

              // defenseurs milieux defensifs
              for($t=6;$t<=7;$t++){
                $def = strtolower(trim($row['joueur'.$t]));
                if(!empty($def)){
                  $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
                  $query2 = $conn->execute_query($sql);
                  if($query2){
                    $idj=mysql_result($query2,0);
                    if($idj){
                      $sql = "INSERT INTO rmc11_dreamteam_selection (
                        id_dt_slc,
                        formation_dt,
                        id_milieuxd_slc
                      )
                      VALUES (
                        '$id',
                        '$formation',
                        '$idj'
                      )
                      ";
                      $conn->execute_query($sql);
                    }else{
                      echo $def;
                    }
                  }
                }
              }


              // defenseurs milieux offensifs
                $def = strtolower(trim($row['joueur8']));
                if(!empty($def)){
                  $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
                  $query2 = $conn->execute_query($sql);
                  if($query2){
                    $idj=mysql_result($query2,0);
                    if($idj){
                      $sql = "INSERT INTO rmc11_dreamteam_selection (
                        id_dt_slc,
                        formation_dt,
                        id_milieuxo_slc
                      )
                      VALUES (
                        '$id',
                        '$formation',
                        '$idj'
                      )
                      ";
                      $conn->execute_query($sql);
                    }else{
                      echo $def;
                    }
                  }
                }



              // attaquants
              for($t=9;$t<=11;$t++){
                $def = strtolower(trim($row['joueur'.$t]));
                if(!empty($def)){
                  $sql = "SELECT id_joueur FROM $conn->tb1 WHERE LOWER($conn->tb1.nom) = '$def'";
                  $query2 = $conn->execute_query($sql);
                  if($query2){
                    $idj=mysql_result($query2,0);
                    if($idj){
                      $sql = "INSERT INTO rmc11_dreamteam_selection (
                        id_dt_slc,
                        formation_dt,
                        id_attaquants_slc
                      )
                      VALUES (
                        '$id',
                        '$formation',
                        '$idj'
                      )
                      ";
                      $conn->execute_query($sql);
                    }else{
                      echo $def;
                    }
                  }
                }
              }
            }




  }
}


?>
