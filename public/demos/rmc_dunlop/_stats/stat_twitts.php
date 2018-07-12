<?php

  require ('../_inc/connect.php');

  $conn = new connect();

  $lmois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
  $ljours = array('Monday'=>'Lundi','Tuesday'=>'Mardi','Wednesday'=>'Mercredi','Thursday'=>'Jeudi','Friday'=>'Vendredi','Saturday'=>'Samedi','Sunday'=>'Dimanche');

  $max = 0;

  $sql = "SELECT MAX(counted) FROM (SELECT COUNT(id) AS counted, EXTRACT(DAY FROM tdate) AS daye, EXTRACT(MONTH FROM tdate) AS monthe FROM $conn->tb1 GROUP BY daye, monthe) AS counteds";
  $query = $conn->execute_query($sql);
  if($query){
    $max = mysql_result($query,0);
  }

  $sql = "SELECT tdate, COUNT(id) AS counts, hashtagdefia, hashtagdefib, SUM(IF(hashtag = '', 0, 1)) AS hasht, SUM(IF(hashtagdefia = '', 0, 1)) AS hashta, SUM(IF(hashtagdefib = '', 0, 1)) AS hashtb, EXTRACT(DAY FROM tdate) AS days, EXTRACT(MONTH FROM tdate) AS months, DAYNAME(tdate) AS jour FROM $conn->tb1 GROUP BY days, months ORDER BY tdate ASC";
  $query = $conn->execute_query($sql);

  $total = 0;
  $total0 = 0;
  $total1 = 0;
  $total2 = 0;
  $elems = '<ul class="grapha">';
  $counts = 0;
  $countsh = 0;
  $countsa = 0;
  $countsb = 0;

  while($arr = mysql_fetch_assoc($query)){
    $counts = $arr['counts'];
    $countsh = $arr['hasht']; // empty($arr['hasht']) ? 0 : 1;
    $countsa = $arr['hashta'];
    $countsb = $arr['hashtb'];
    $total += $counts;
    $total0 += $countsh;
    $total1 += $countsa;
    $total2 += $countsb;
    $jour = $arr['jour'];
    //$max = $counts > $max ? $counts : $max;
    $mois = $arr['months'];
    $mois--;
    $curmois = $lmois[$mois];
    //echo 'day : '.$arr['days'].' '.$curmois.' / '.$counts.' - '.$arr['mdates'].'<br/>';

    $h = round(($counts*500)/$max);
    $h = $h < 1 ? 1 : $h;
    $elems .= '<li><span class="dates">'.$ljours[$jour].' '.$arr['days'].' '.$curmois.'</span><img src="../_img/square.png" width="'.$h.'" height="35"/><p class="counted"><strong>#24hdementes : '.$countsh.'  /  #24hdementes1 : '.$countsa.'  / #24hdementes2 : '.$countsb.'</strong></p></li>';
  }

  $elems .= '</ul>';

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques 24hdementes</title>
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
    <h1>Statistiques 24hdementes</h1>
    <?php
    echo $elems;

    echo '<br/>';
    echo 'Nombre total de twitts : <strong>'.$total.'</strong>';
    echo '<br/>';
    echo 'Nombre total de #24hdementes : <strong>'.$total0.'</strong>';
    echo '<br/>';
    echo 'Nombre total de #24hdementes1 : <strong>'.$total1.'</strong>';
    echo '<br/>';
    echo 'Nombre total de #24hdementes2 : <strong>'.$total2.'</strong>';
    ?>
  </body>
</html>
