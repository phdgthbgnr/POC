<?php
require ('classphp/connect.php');

$conn=new connect();

$sql="SELECT id_ope FROM $conn->tb1 WHERE ope_nom='rayban'";
$query=$conn->execute_query($sql);

if($query){
    $row= mysql_fetch_row($query);
    if($row){
        $id=$row[0];
        $sql="SELECT * FROM $conn->tb2, $conn->tb3 WHERE $conn->tb2.ope_id='$id' AND $conn->tb3.contact_id=$conn->tb2.id_contact ORDER BY $conn->tb2.dz_id, $conn->tb3.contact_id, $conn->tb3.id_playlist";
        $res=$conn->execute_query($sql);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rayban Pitchfork</title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />    
    <!--<link href="http://cdn-files.deezer.com/css/deezer-v00209297.css" rel="stylesheet" type="text/css">-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
     
    <link rel="stylesheet" href="style2.css" type="text/css" media="screen"/>
    
</head>
<body>
    <div id="dz-root"></div>
    <script src="http://cdn-files.deezer.com/js/min/dz.js"></script>
    <script type="text/javascript">
            /*
            // not asynchronous
            DZ.init({
                appId      : '145051',
                channelUrl : 'http://demo.greengardendigital.com/rayban/channel.html',
                player     : true
            });
            */

            // asynchronous
            window.dzAsyncInit = function() {
                DZ.init({
                    appId  : '145051', //'145651',
                    channelUrl : 'http://demo.greengardendigital.com/Deezer/rayban/channel.html',
                    player: {
                        onload: function(response) {
                            //console.log('DZ.player is ready', response);
                            DZ.Event.subscribe('player_position', function(track, evt_name){
                               // console.log("position in the track", track);
                                posTrack=track[0];
                            });

                            DZ.Event.subscribe('player_paused', function(track, evt_name){
                               // console.log("position in the track", track);
                                var o=DZ.player.getCurrentTrack();
                                var id=parseInt(o.id);
                                if($.inArray(id,arrAlbums)>-1)  curAlbum=0;
                                if($.inArray(id,arrPlsts)>-1)  curPlst=0;
                                //posTrack=track[0];
                            });

                        }
                    }
                });

            };

              (function() {
                var e = document.createElement('script');
                e.src = 'http://cdn-files.deezer.com/js/min/dz.js';
                e.async = true;
                document.getElementById('dz-root').appendChild(e);
              }());

        
        
        function getTracks(t){
            
             DZ.api('/track/'+t, function(response){
                    // tout dans le callback                        
                 },function(response){ 
                    $('#'+t).empty().append('<img src="'+response.album.cover+'"/>');
                 });
        }
        
	</script>
    
    <?php

    $nom='';
    $reso='';
    $particip=0;

    echo '<ul><li id="participe" class="partcp"></li>';
    while ($rows = mysql_fetch_array($res)) {
        if($nom!=$rows['ct_nom']){
            echo '</ul><ul>';
            echo '<li class="nom">'.$rows['ct_prenom'].' '.$rows['ct_nom'].'<br/>'.$rows['ct_mail'].'</li>';
            $nom=$rows['ct_nom'];
            $reso='';
            $particip++;
        }
        
        if ($rows['joueFB']=='1') $ress='<li class="reso"><img src="_images/FB-f-Logo__blue_29.png"/></li>';
        if ($rows['joueTW']=='1') $ress='<li class="reso"><img src="_images/Twitter_logo_blue.png"/></li>';
        
        if($reso!=$ress){
            echo $ress;
            $reso=$ress;
        }
        
        //echo '<li>'.$rows['dz_playlist'].'</li>';
        $rdez = file_get_contents("http://api.deezer.com/track/".$rows['dz_playlist']);
        $pdez=json_decode($rdez);
        echo '<li><a href="'.$rows['dz_playlist'].'" id="'.$rows['id_playlist'].'" class="ecoute"><img src="'.$pdez->{'album'}->{'cover'}.'"/></a></li>';
    }
    ?>
    
    <div class="bulle"></div>
    
    </body>
    

<script type="text/javascript">
    
    var curid=0;
    
    jQuery(document).ready(function($){
        
        $('#participe').append('<?php echo $particip ?> participants');
    
        $('.ecoute').each(function(){
            $(this).click(function(){
                var id=$(this).attr('id');
                var tr=$(this).attr('href');
                $(this).toggleClass('selection');
                if(curid==id){
                    DZ.player.pause();
                }else{
                    $('#'+curid).removeClass('selection');
                    DZ.player.playTracks([tr]);
                    curid=id;
                }
                return false;
            });
            
            $(this).hover(function(){
                
                var $this=$(this);
                var tr=$(this).attr('href');
                
                DZ.api('/track/'+tr, function(response){
                        // tout dans le callback
                        },function(response){
                            var msg='<ul><li class="titre">'+response.title+'</li>';
                            msg+='<li class="artiste">'+response.artist.name+'</li></ul>';
                            $('.bulle').empty().append(msg);
                        });
                
                $(this).mousemove(function(e){
                    $('.bulle').css('display','block');
                    $('.bulle').css('top',e.pageY+5+'px');
                    $('.bulle').css('left',e.pageX+5+'px');                                        
                });
            },function(){
                $('.bulle').empty();
                $('.bulle').css('display','none');
            });
        });
    
    });
    
</script>
</html>
