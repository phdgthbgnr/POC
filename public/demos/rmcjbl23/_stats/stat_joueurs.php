<?php

  require ('../_inc/connect.php');

  $title =  preg_match("/votre11bleu.bfmtv.com/",$_SERVER['SERVER_NAME']) == true ? ' votre 11 bleu' : (preg_match("/votrelistedes23.bfmtv.com/",$_SERVER['SERVER_NAME']) == true  ? ' votre liste des 23' : '');

  $lmois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
  $ljours = array('Monday'=>'Lundi','Tuesday'=>'Mardi','Wednesday'=>'Mercredi','Thursday'=>'Jeudi','Friday'=>'Vendredi','Saturday'=>'Samedi','Sunday'=>'Dimanche');
  $conn = new connect();

  $max = 0;

  $sql = "SELECT MAX(counted) FROM (SELECT COUNT(id_joueurs) AS counted, EXTRACT(DAY FROM dates) AS daye, EXTRACT(MONTH FROM dates) AS monthe FROM $conn->tb3 GROUP BY daye, monthe) AS counteds";
  $query = $conn->execute_query($sql);
  if($query){
    $max = mysql_result($query,0);
  }

  $sql = "SELECT  dates, COUNT(id_joueurs) AS counts, SUM(nb_fb) AS fbks, SUM(bt_twt) AS twts,
  EXTRACT(DAY FROM dates) AS days, EXTRACT(MONTH FROM dates) AS months, DAYNAME(dates) AS jour FROM $conn->tb3 GROUP BY days, months ORDER BY dates ASC";
  $query = $conn->execute_query($sql);

  $total = 0;
  $fbs = 0;
  $tws = 0;

  $elems = '<ul class="grapha">';
  $counts = 0;

  while($arr = mysql_fetch_assoc($query)){
    $counts = $arr['counts'];
    $total += $counts;
    $fbs += $arr['fbks'];
    $tws += $arr['twts'];
    $jour = $arr['jour'];
    //$max = $counts > $max ? $counts : $max;
    $mois = $arr['months'];
    $mois--;
    $curmois = $lmois[$mois];
    //echo 'day : '.$arr['days'].' '.$curmois.' / '.$counts.' - '.$arr['mdates'].'<br/>';

    $h = round(($counts*500)/$max);
    $h = $h < 1 ? 1 : $h;
    $elems .= '<li><span class="dates">'.$ljours[$jour].' '.$arr['days'].' '.$curmois.'</span><img src="../_images/square.png" width="'.$h.'" height="35"/><p class="counted"><strong>'.$counts.'</strong> / F : '.$arr['fbks'].' / T : '.$arr['twts'].'</p></li>';
  }

  $elems .= '</ul>';

  $selections = 0;
  $sql = "SELECT counts FROM $conn->tb8";
  $query = $conn->execute_query($sql);
  if($query){
    $selections = mysql_result($query,0);
  }

  $particip = 0;
  $sql = "SELECT count(id_particip) as countp FROM $conn->tb7";
  $query = $conn->execute_query($sql);
  if($query){
    $particip = mysql_result($query, 0);
  }

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques <?php echo $title ?></title>
    <style>
      html, body{
        font-family: Arial, sans-serif;
        font-size: 12pt;
      }
      h1{
        text-align: center;
      }
      .grapha{
        list-style: none;
        width: 100%;
      }
      .grapha li{
        display: block;
        margin: .5% 0;
      }
      .grapha li img{
        display: inline-block;
        margin: 0 1% 0 0;
        float: left;
      }
      .grapha li p.counted{
        margin: 0;
        display:inline-block;
        height:35px;
        width: auto;
        line-height: 35px;
        vertical-align: middle;
        font-size: .8em;
      }

      .grapha li span.dates{
        display:inline-block;
        height:35px;
        width: 160px;
        line-height: 35px;
        vertical-align: middle;
        float: left;
        text-align: right;
        padding: 0 1% 0 0;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <h1>Statistiques <?php echo $title ?></h1>
    <?php
    echo $elems;

    echo '<br/>';
    echo 'Nombre total de joueurs : <strong>'.$total.'</strong>';
    echo '<br/>';
    echo 'Nombre total de sélections : <strong>'.$selections.'</strong>';
    echo '<br/>';
    echo 'Nombre total de participations : <strong>'.$particip.'</strong>';
    echo '<br/>';
    echo 'Nombre total de partages Facebook (F) : <strong>'.$fbs.'</strong>';
    echo '<br/>';
    echo 'Nombre total de partages Twitter (T) : <strong>'.$tws.'</strong>';
    ?>
    <br/>
    <br/>
    <a href="../_exports/export_participants.php?code=5K2pGzAv" target="_blank">Liste excel des participants</a>
  </body>
</html>
