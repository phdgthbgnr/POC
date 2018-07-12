<?php

require('../_inc/connect.php');

$crea=0;
$today=date("Y.m.d H:i:s");

/*
if($_GET){
    if(isset($_GET['batmanxme'])){
        $conn=new connect();
        $id=protect($_POST['batmanxme']);
        $sql="SELECT * FROM $conn->tb1 WHERE id_user='$id' limit 1";
        $query=$conn->execute_query($sql);
        if($query){
            if(mysql_num_rows($query)>0){
                $row=mysql_fetch_array($query);
            }
        }
    }
}
*/

 // protege $_POST
    function protect($v){
		$v=trim($v);
		//si magic_quotes pas de caractere d'echappement
		if (get_magic_quotes_gpc()==1){
			$r=$v;
		}else{
			$r=addslashes($v);
		}
		$r = htmlspecialchars($r);
		//$conn=new connect();
		//$r = mysql_real_escape_string($r);
		//$res=str_replace(array("'", '"'), "", $r);
		return $r;
    }

?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <meta property="og:title" content="Personnalisez le masque et la cape de Batman"/>
    <meta property="og:site_name" content="Batman x Me"/>
    <meta property="og:url" content="http://batmanarkhamknight.warnerbros.fr/wall" /> 
    <meta property="og:title" content="Batman x Me" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Vous aussi, libérez votre créativité en vous appropriant la célèbre armure de Batman !" /> 
    <meta property="og:image" content="http://batmanarkhamknight.warnerbros.fr/_images/batmanarkhamknight.jpg" />
    
    <link rel="canonical" href="http://batmanarkhamknight.warnerbros.fr/wall" />
    
    <title>BATMAN X ME</title>
    <link rel="stylesheet" href="../_css/wall.css">
</head>

<body>
    
    <!--<div class="preloading" id="preloading">
        <img src="../_images/batman-arkham-knight-logo.jpg" width="307" height="138" alt="batman arkham knight" class="batlogo" id="logobat"/>
        <div class="percent" id="percent">0 %</div>
        <div class="levelload" id="loadlevel"></div>
    </div>
    -->
    
    <div class="contener" id="contener" style="position:absolute;top:60px;width:100%">
        
        <a href="https://twitter.com/intent/tweet/?text=Je personnalise le masque et la cape de Batman pour gagner ma création grandeur nature ! %23BeTheBatman&url=http://batmanarkhamknight.warnerbros.fr/wall" class="share tw" id="inapptw"><img src="../_images/sharetw.png"/></a>
        <div class="share gplus">  
            <div class="googlehider">
                <script type="text/javascript">
                                        
                    function shareState(p){
                        if(p){
                            if(p.type=='confirm'){
                                mwsdk.Analytics.share({
                                    socialNetwork:'google',
                                    socialAction:'share',
                                    socialTarget:'http://batmanarkhamknight.warnerbros.fr/wall',
                                    page:'http://batmanarkhamknight.warnerbros.fr/wall'
                                });
                            }
                        }
                    }
                </script>
                <g:plusone data-annotation="none" data-action="share" onendinteraction="shareState" data-href="http://batmanarkhamknight.warnerbros.fr/wall"></g:plusone>
                
            </div>  
            <img src="../_images/sharegp.png" class="mygoogle" />
        </div>
        <a href="#" id="fbshare" class="share fb"><img src="../_images/sharefb.png"/></a>
        
        <div class="header">
            <a href="http://batmanarkhamknight.warnerbros.fr/" class="backhome"><img src="../_images/batman-arkham-knight-logo.jpg" class="logobtnm"/></a>
            <ul class="liens">
                <li><a href="../" id="partager" class="bouton perso">Personnalisez votre Batman</a></li>
            </ul>
            <div class="pack">
                <img src="../_images/packs.jpg" class="packs"/>
                <a href="http://mywb.fr/FNFll2" target="_blank" class="bouton preco">Précommandez le jeu</a>
                <img src="../_images/logos.jpg" class="logo"/>
            </div>
        </div>
        
        <div id="dtri" class="dtri">
            <div class="aff"><a href="plusrecent" class="btntri current">Plus récents</a><a href="plusancien" class="btntri">Plus anciens</a><a href="popul" class="popu" id="popu">Popularité</a></div>
            <div class="rech"><input type="text" name="prenom" id="prenom" class="champ" placeholder="Rechercher un prénom"/><input type="text" name="nom" id="nom" class="champ" placeholder="Rechercher un nom"/><a href="rech" class="ok" id="rech">ok</a></div>
        </div>
        
        <div class="vignettes" id="vignettes">
            <img class="loading" src="../_images/loading.gif"/>
        </div>
        
    </div>
    
    <div id="imgbig" class="imgbig"></div>
    
    <div class="popbkg" id="popbkg2">
        <div class="popcont">
            <div class="texte">Pour voter, vous devez être connecté à MyWarner</div>
            <a href="#" id="okclose2">OK</a>
        </div>
    </div>
    
    <div class="popbkg" id="popbkg3">
        <div class="popcont">
            <div class="texte">Merci de votre vote.<br/>Vous avez droit à un vote par jour !</div>
            <a href="#" id="okclose3">OK</a>
        </div>
    </div>
    
    <?php
        //print_r($accesstoken);
        //echo 'resultats : '.$ret 
    ?>
    <p style="clear:both"></p>
    <script type="text/javascript">
        
        // Include the Twitter Library ---------------------------------------------------------------------
        
        window.twttr = (function (d,s,id) {
          var t, js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
          js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
          return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
        }(document, "script", "twitter-wjs"));
        
         twttr.ready(function (twttr) {
             twttr.events.bind('tweet', function (ev) {
                 switch(ev.target.id){
                    case 'inapptw':
                        mwsdk.Analytics.share({
                            socialNetwork:'twitter',
                            socialAction:'tweet',
                            socialTarget:'http://batmanarkhamknight.warnerbros.fr/wall',
                            page:'http://batmanarkhamknight.warnerbros.fr/wall'
                        });
                    break;
                    case 'inapptw2':
                        mwsdk.Analytics.share({
                            socialNetwork:'twitter',
                            socialAction:'tweet',
                            socialTarget:'http://batmanarkhamknight.warnerbros.fr/wall',
                            page:'http://batmanarkhamknight.warnerbros.fr/wall'
                        });
                    break;
                 }
             });
         });
        
        
        // script Warner log et analytics ------------------------------------------------------------------
        
        var idwarner=0;
        var offset=0;
        var mwsdk;
        var letri='';
        var lenom='';
        var leprenom='';
        var popu='';
        
        window.myWarnerAsyncLoad = function() {
            MyWarner.init({
            client_id: '2eb9376cf0389a63c128a9fb',
            context: 'challenge',
            topbar: {
                show: true,
                display: {
                warnerbros_website: true,
                challenges: true,
                mobile_app: false,
                harry_potter: true,
                justforfans: false,
                faq: true
                }
            },
                
            
            analytics: {context:'batmanxMe',type:'animation'}
            }).done(function(sdk) {
                // OK
                mwsdk=sdk;
                sdk.Analytics.pageView({
                    context:'batmanxMe',
                    type:'animation',
                    page:'http://batmanarkhamknight.warnerbros.fr/wall/'
                });

                sdk.Event.subscribe('sdk.connect.login', function(event, id, token) {
                // L'utilisateur est connecté.
                    //loadvignettes();
                    idwarner = id;
                   // console.log('----------------------- user connected ----------------------');
                    sdk.User.getInfos({})
                    .done(function(o){
                        //console.log('FB : '+o.facebook_id);
                        //console.log(o);
                        idwarner = o.mw_id;
                        loadvignettes();
                    }).fail(function(erreur){
                        
                        //console.log('erreur');
                        //console.log(erreur.error);
                        //console.log(erreur.code);
                    });
                });
                
                
                sdk.User.isConnected({})
                .done(function(e){
                    // e = true || false
                    if(!e) loadvignettes();
                });
           
                
                sdk.Event.subscribe('sdk.connect.logout', function(event, id, token) {
                // L'utilisateur est connecté.
                    idwarner = 0;
                    loadvignettes();
                });
                
                //console.log(profil.facebook_id);
            }).fail(function(error) {
                
                // Gestion des erreurs.
                //console.error(error);
            });
            
            
        };
    

    </script>
    <!-- staging -->
    <script src="https://mywarner-upload-preprod.s3.amazonaws.com/js-sdk/staging/sdk.min.js" type="text/javascript"></script>
    <!-- production -->
<!--     <script src="https://mywarner-upload.s3.amazonaws.com/js-sdk/sdk.min.js" type="text/javascript"></script> -->
    
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        
        var request=null;
        
        
         jQuery(document).ready(function($){
        
            $('#fbshare').click(function(e){
                e.preventDefault();
                FB.ui({
                    //app_id:230954650284744,
                    //method: 'share',
                    //href:'http://batmanarkhamknight.warnerbros.fr?u=1'
                    method:'feed',
                    name: 'Batman x Me',
                    link: 'http://batmanarkhamknight.warnerbros.fr/wall',
                    picture: 'http://batmanarkhamknight.warnerbros.fr/_images/batmanarkhamknight.jpg',
                    description: 'Vous aussi, libérez votre créativité en vous appropriant la célèbre armure de Batman !',
                    caption: 'Personnalisez le masque et la cape de Batman'

                    },function(d){
                    
                    if(d!=null) {
                        // analytics share
                        mwsdk.Analytics.share({
                            socialNetwork:'facebook',
                            socialAction:'feed',
                            socialTarget:'http://batmanarkhamknight.warnerbros.fr/wall',
                            page:'http://batmanarkhamknight.warnerbros.fr/wall'
                        });                   
                    }; 
                });
                return false;
            });
             
             $('.btntri').each(function(){
                $(this).click(function(){
                    letri=$(this).attr('href');
                    offset=0;
                    loadvignettes();
                    $('.btntri').each(function(){
                        if($(this).hasClass('current')) $(this).removeClass('current');
                    });
                    if($('#popu').hasClass('current')) $('#popu').removeClass('current');
                    $(this).addClass('current');
                    popu = '';
                    return false;
                });
             });
             
             $('#popu').click(function(){
                 offset=0;
                 if(popu==''){
                     popu='desc';
                 }else{
                    popu=popu=='desc'?'asc':'desc';
                 }
                 if($(this).hasClass('desc')) $(this).removeClass('desc');
                 if($(this).hasClass('asc')) $(this).removeClass('asc');
                 $(this).addClass(popu);
                 letri=popu=='desc'?'popudesc':'popuasc';
                 $(this).addClass('current');
                 $('.btntri').each(function(){
                        if($(this).hasClass('current')) $(this).removeClass('current');
                 });
                 loadvignettes();
                return false; 
            });
             
             $('#rech').click(function(){
                 offset=0;
                 letri = 'rech';
                 lenom = $('#nom').val();
                 leprenom = $('#prenom').val();
                 $('.btntri').each(function(){
                        if($(this).hasClass('current')) $(this).removeClass('current');
                 });
                 if($('#popu').hasClass('current')) $('#popu').removeClass('current');
                 loadvignettes();
                return false;
             });
             
            $('#okclose2').click(function(e){
                $('#popbkg2').css('visibility','hidden');
                mwsdk.Connect.login('generic', {
                    success: function(id, token) {
                    // L'utilisateur est connecté.
                        mwsdk.User.getInfos({})
                        .done(function(o){
                            //console.log('FB : '+o.facebook_id);
                            //console.log(o);
                            idwarner = o.mw_id;
                            loadvignettes();
                        }).fail(function(erreur){
                            //console.log(erreur);
                            //console.log(erreur.error);
                            //console.log(erreur.code);
                        });
                    },
                    error: function(e){
                    // Erreur
                    console.log(e);
                    }
                });
                return false; 
            });
             
             
            $('#okclose3').click(function(e){
                $('#popbkg3').css('visibility','hidden');
                return false;
             });
             
             
            
        }); // fin document ready
        
        
        function pagination(){

            $('.offset').each(function(){
                $(this).click(function(){
                    var tmp=$(this).attr('href');
                    offset = parseInt(tmp.substr(4,tmp.length));
                    loadvignettes();
                    return false;
                });    
            });

            $('.popup').each(function(){
                $(this).click(function(){
                    var top = $(document).scrollTop();
                    var hght = $(window).height();
                    var doch = $(document).height();
                    var bott = doch-hght;
                    var id = $(this).attr('id');
                    var points = $(this).data('votes');
                    var allow = $(this).data('allow');
                    var iddb=$(this).data('id');
                    $('#imgbig').height(doch);
                    $('#imgbig').css('padding-top', top+'px');
                    //$('#imgbig').css('padding-bottom', bott+'px');
                    $('#imgbig').css('display','block');
                    $('#imgbig').empty().html('<img class="loading mddle" src="../_images/loading.gif"/>');
                    //var img = $(this).attr('href');
                    //if(allow=='yes') $('#imgbig').empty().html('<div href="#" id="closing" class="closing"><span><img src="'+img+'" id="bigimg" class="invisible"/><a class="poplikes" id="likepop" href="v-'+iddb+'"><span id="points">'+points+'</span></a></span></div>');
                    //if(allow=='no') $('#imgbig').empty().html('<div href="#" id="closing" class="closing"><span><img src="'+img+'" id="bigimg" class="invisible"/><div class="nolikes popno"><span>'+points+'</span></div></span></div>');
                    
                    if(request) request.abort();
                    request=$.ajax({
                        url:'../_inc/zoom.php',
                        data:{action:'zoom',id:iddb,allow:allow},
                        type:'post',
                        dataType:'html',
                        success:function (result){
                            $('#imgbig').empty().html(result);
                            $('#bigimg').height(hght);
                            $('.poplikes').css('visibility','visible');
                            $('#bigimg').removeClass('invisible');
                            request=null;  
                        }, 
                        error:function(result){
                            request=null;
                        }
                    });

                    return false;
                });
            });


            $('.mwlikes').each(function(){
                $(this).click(function(e){
                    var vid=$(this).attr('href');
                    if(request) request.abort();
                    request=$.ajax({
                        url:'../_inc/votes.php',
                        data:{action:'vote',mwuser:idwarner,thumb:vid},
                        type:'post',
                        success:function (result){
                            loadvignettes();
                            request=null;
                            $('#popbkg3').css('visibility','visible');
                        }, 
                        error:function(result){
                            request=null;
                        }
                    });
                    return false;
                });
                
                $(this).hover(function(){
                    $(this).parent().find('a.popup').addClass('bordure');
                },function(){
                    $(this).parent().find('a.popup').removeClass('bordure'); 
                });
                
            });
            
            
            $('.nolikes').each(function(){
                $(this).hover(function(){
                    $(this).parent().find('a.popup').addClass('bordure');
                },function(){
                    $(this).parent().find('a.popup').removeClass('bordure'); 
                });
            });
        }
        
        
        
        function loadvignettes(){
            $('#vignettes').empty().html('<img class="loading" src="../_images/loading.gif"/>');
            $.ajax({
                url: "../_inc/vignettes.php",
                data: {action:'vignettes',offset:offset,mwuser:idwarner,tri:letri,nom:lenom,prenom:leprenom}, //capture.data,
                type: 'post',
                success: function( result ) {
                    //console.log(result);
                    $('#vignettes').html(result);
                    pagination();
                    if(idwarner==0){
                        $('.nolikes').each(function(){
                            $(this).click(function(e){
                                e.preventDefault();
                                $('#popbkg2').css('visibility','visible');
                                return false;
                            });
                        });
                    }
                },
                error:function(result){
                    //console.log('error : '+result);
                }
            });
        }
    
    </script>
    
    <!-- google + api ------------------------------------------------------------------- -->
    <script type="text/javascript">
        
            window.___gcfg = {
                lang: 'fr-FR'
            };

            (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();
        
    </script>
    
</body>
</html>
