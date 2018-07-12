<?php
    include('_inc/connect.php');
   
    // TOKEN POUR APPEL AJAX ------------------------------------------------------------------------
    session_start();
    $tokenfs = md5(rand(1000,9999)); //you can use any encryption
    //$uniqid = md5(uniqid(rand( ), true));
    // $_SESSION['tokenn'] = $tokenfs; //store it as session variable

    $host = $_SERVER['HTTP_HOST'];
    header("Content-Security-Policy: frame-ancestors 'self'");
    header("X-Frame-Options: SAMEORIGIN");   
    
   
    // ----------------------------------------------------------------------------------------------
    // ?refresh -- force la génération du fichier json des la selection des joueurs de la semaine par ea



    $refresh = 0;
    if(isset($_GET['refresh'])){
        $refresh = 1;
    }

    // recuperer le numero de semaine en cours
    $conn = new connect();
    $semaine = 0;
    $participation = 0;
    $panik = 0;
    $fifateam = '';
    $trophee = '';
    $sql = "SELECT semaine, participation, mode_panik, fifateam_img, trophee_img FROM $conn->tb0";
    $query = $conn->execute_query($sql);
    if($query){
        if($query->num_rows > 0){
            $myrow =  mysqli_fetch_row($query);
            $semaine = $myrow[0];
            $participation = $myrow[1];
            $panik = $myrow[2];
            $fifateam = $myrow[3];
            $trophee = $myrow[4];
        }else{
            $panik = 1;
        }
    }else{
        $panik = 1;
    }

    // recupérer l'image de partage si définie
    $host = $_SERVER['HTTP_HOST'].$conn->local;
    $querystr = '';
    $imgsh = '/_img/fbimg2.jpg';
    $descr = 'Crée ton équipe FIFA ULTIMATE TEAM et tente de gagner des cartes FUT !';
    
    if($_GET){
        if(isset($_GET['imgsh']) && !empty($_GET['imgsh'])){
            $tmp = $_GET['imgsh'];
            //$reg= '/^([a-zA-Z0-9]){40}-([0-9]{6}).(jpg)$/';
            if($participation == 1){
                $reg = '/^([a-zA-Z0-9]){40}-([0-9]{6})$/';
                if(preg_match($reg,$tmp)) $imgsh = '/_sharing/'.$tmp.'.jpg';
                $descr = 'Crée ton équipe FIFA ULTIMATE TEAM et tente de gagner des cartes FUT !';
                $querystr = '?imgsh='.$tmp;
            }
            if($participation == 0){ // equipe de la semaine
                $reg = '/^([a-zA-Z0-9]){7}_([0-9]{2})$/';
                if(preg_match($reg,$tmp)) $imgsh = '/_teamfifa/'.$tmp.'.jpg';
                $imgsh = '/_teamfifa/'.$fifateam.'.jpg'; // totalement redondant
                $descr = 'Voici l\'équipe de la semaine FIFA ULTIMATE TEAM !';
               // $nb = $semaine < 10 ? $semaine : '0'.$semaine;
                $querystr = '?imgsh='.$tmp;
                
            }
            if($participation == 2){ // trophee de la semaine
                $reg = '/^([a-zA-Z0-9]){7}_([0-9]{2})$/';
                if(preg_match($reg,$tmp)) $imgsh = '/_trophee/'.$tmp.'.jpg';
                $descr = '';
               // $nb = $semaine < 10 ? $semaine : '0'.$semaine;
                $querystr = '?imgsh='.$tmp;
            }
        }
    }
    /*
    if($participation == 0){ // equipe de la semaine
        $imgsh = '/_teamfifa/'.$fifateam.'.jpg';
        $descr = 'Voici l\'équipe de la semaine FIFA ULTIMATE TEAM !';
       // $nb = $semaine < 10 ? $semaine : '0'.$semaine;
        $querystr = '?imgsh='.$fifateam;
    }
    */

    $vers = $_SERVER['HTTP_USER_AGENT'];
    $iphone = false;
    $mobile = false;
    $ipad = false;
    $hframe = 158;
    $ismobile = 0;
    $android = false;

?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>rmc fifa fut 2017</title>
        <?php
        if (strpos($vers,'iPad') && strpos($vers,'Mobile')){ //  && strpos($vers,'Version/5.1')
            $ipad = true;
            echo '<meta name="viewport" content="width=1024, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />';
        }else{
            if (strpos($vers,'iPhone') && strpos($vers,'Mobile')){
              $iphone = true;
                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >';  // iphone
            }else{
                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">';
            }
           //
        }

        if(strpos($vers,'Android')) $android = true;
        
        // if(!strpos($vers,'iPhone') && strpos($vers,'Mobile')){
        if(strpos($vers,'Mobile')){
          $mobile = true;
          $ismobile = $mobile === true ? 1 : 0;
        }
        $isipad = $ipad === true ? 1 : 0;
        ?>

        <meta name="description" content="crée ton équipe fifa ultimate team pendant 10 semaines">
        <meta name="keywords" content="rmc fifa ultimate team, Equipe de la semaine">

        <link rel="apple-touch-icon-precomposed" href="https://static.bfmtv.com/ressources/favicon/rmcsport/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://static.bfmtv.com/ressources/favicon/rmcsport/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://static.bfmtv.com/ressources/favicon/rmcsport/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://static.bfmtv.com/ressources/favicon/rmcsport/apple-touch-icon-144x144.png">
        <link rel="icon" href="https://static.bfmtv.com/ressources/favicon/rmcsport/favicon.ico">
        <link rel="icon" type="image/png" href="https://static.bfmtv.com/ressources/favicon/rmcsport/favicon.png" />

        <meta property="og:url" content="<?php echo 'http://'.$host.$querystr; ?>" />
        <meta property="og:title" content="RMCSPORT FIFA ULTIMATE TEAM" />
        <meta property="og:description" content="<?php echo $descr ?>" />
        <meta property="og:image" content="http://<?php echo $host.$imgsh; ?>" />
        <meta property="og:image:width" content="1200"/>
        <meta property="og:image:height" content="630"/>
        <meta property="og:type" content="website"/>
        <meta property="fb:app_id" content="2096630937235188" />

        <link rel="stylesheet" href="_css/rmcfifia_style.css" type="text/css"/>

        <style id="antiClickjack">body{display:none !important;}</style>
        <script type="text/javascript">
            if (self === top) {
                var antiClickjack = document.getElementById("antiClickjack");
                antiClickjack.parentNode.removeChild(antiClickjack);
            } else {
                if(location.host == 'trophee-fut-rmcsport.bfmtv.com'){
                    var antiClickjack = document.getElementById("antiClickjack");
                    antiClickjack.parentNode.removeChild(antiClickjack);
                }
                top.location  = self.location;
            }
        </script>
    </head>

    <body>

    <div class="lanscpmob"><p>Merci de retourner votre écran</p></div>

    <div class="header" id="header"><iframe src="https://demo.greengardendigital.com/headerfooterrmc/hf/header.html" frameborder="0" scrolling="no" name="frame1" title="menuheader"></iframe></div>
    
        
        <div class="contener">

        <canvas id="sharecanvas" style="border: 0" width="1200" height="630"></canvas>
            
        <?php if($participation == 1) { ?>
        <!-- du lundi au mercredi -->
        <div id="intro" class="intro">
            <img scr="_img/blank.gif" with="1332" height="795" data-src="_img/dt_bkg.jpg" class="bg" alt="bg"/>
            <img src="_img/blank.gif" width="427" height="328" data-src="_img/coin-gauche.png" class="cg" alt="coin"/>
            <img src="_img/blank.gif" width="438" height="428" data-src="_img/cercle.png" class="cercle nomobile" alt="cercle"/>
            <img src="_img/blank.gif" width="392" height="597" data-src="_img/3joueurs.png" class="joueurs nomobile" alt="3joueurs"/>
            <img src="_img/blank.gif" width="357" height="201" data-src="_img/coin-droit.png" class="cd" alt="coin"/>
            <img src="_img/fakelogo.gif" width="335" height="84" data-src="_img/logo_fifa18.png" class="logo" alt="logo fifa 18"/>
            <h1>crée ton équipe<br/>FIFA ULTIMATE TEAM<br/>pendant 10 semaines</h1>
            <ol>
                <li><span><strong>Tous les lundis</strong>, viens nous proposer ton équipe de la semaine FIFA Ultimate Team avec les 11 joueurs qui, selon toi, méritent d’en faire partie&nbsp;!</span></li>
                <li><span><strong>Tous les mercredis</strong>, découvre l’équipe de la semaine FIFA Ultimate Team et compare-la à ton équipe.</span></li>
                <li><span><strong>Tous les vendredis</strong>, découvre un contenu exclusif avec l’un des joueurs présents dans l’équipe de la semaine FIFA Ultimate Team. Un tirage au sort sera effectué pour découvrir le grand gagnant de la semaine&nbsp;!</span></li>
            </ol>
            <a href="#participer" id="participer" class="bouton joue nodisplay"><span>joue</span></a>
            <a href="http://po.st/fut-webapp" id="appli" class="bouton noskew applih" target="_blank" rel="noopener noreferrer"><span>Accéder à la Web App</span></a>
            <!--
            <?php if(!$mobile) { ?>
            <a href="http://po.st/fut-webapp" id="appli" class="bouton noskew applih" target="_blank" rel="noopener noreferrer"><span>Accéder à la Web App</span></a>
            <?php } else {?>
                
                <h3 class="ttfifa">Télécharge l'appli<br/>EA SPORTS FIFA 18 Companion</h3>
            <?php } ?>
            <?php if($android){ ?>
                <ul><li class="playstore"><a href="http://po.st/fut-playstore" id="playstore" target="_blank" rel="noopener noreferrer"><img src="_img/blank.gif" width="53" height="53"/></a></li></ul>
            <?php };
            if($ipad || $iphone){ ?>
                <ul><li class="appstore"><a href="http://po.st/fut-appstore" id="appstore" target="_blank" rel="noopener noreferrer"><img src="_img/blank.gif" width="53" height="53"/></a></li></ul>
            <?php } ?> 
            -->
            <a href="http://po.st/fut-features" id="savoirplus" class="bouton noskew savoir" target="_blank" rel="noopener noreferrer"><span>En savoir plus sur FIFA Ultimate Team</span></a>
            <div class="dotation"><span class="xbold">à gagner</span><br/>chaque semaine<img src="_img/blank.gif" width="364" height="278" data-src="_img/dotation.png" class="dot"/>Un joueur de l’équipe de la semaine<br/>FIFA Ultimate Team</div>
        </div>
        
        <div class="selection nodisplay" id="selection">
            <img scr="_img/blank.gif" with="1332" height="795" data-src="_img/dt_bkg_terrain.jpg" class="bg"/>
            <img src="_img/blank.gif" width="427" height="328" data-src="_img/coin-gauche.png" class="cg"/>
            <img src="_img/blank.gif" width="357" height="201" data-src="_img/coin-droit.png" class="cd"/>
            <div class="divlogo"><img src="_img/fakelogo.gif" width="335" height="84" data-src="_img/logo_fifa18.png" class="logosl"/></div>
            <ul>
                <!-- buteur-->
                <li class="buteur buteur1"><img src="_img/tb_bu.png"/><a href="#buteur1" class="poste" id="buteur1"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jbu"/></a></li>

                <!-- ailier -->
                <!-- gauche -->
                <li class="ailier ailierg"><img src="_img/tb_ag.png"/><a href="#ailier1" class="poste" id="ailier1"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jag"/></a></li>
                <!-- droit -->
                <li class="ailier ailierd"><img src="_img/tb_ad.png"/><a href="#ailier2" class="poste" id="ailier2"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jad"/></a></li>

                <!-- milieux centraux-->
                <li class="milieu milieu1"><img src="_img/tb_mc.png"/><a href="#milieu1" class="poste" id="milieu1"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jmc1"/></a></li>
                <li class="milieu milieu2"><img src="_img/tb_mc.png"/><a href="#milieu2" class="poste" id="milieu2"><img src="_img/nojoueur.png"  alt="" data-ssrc="" id="jmc2"/></a></li>
                <!-- milieu défensif -->
                <li class="milieu milieu3"><img src="_img/tb_mdc.png"/><a href="#milieu3" class="poste" id="milieu3"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jmdc"/></a></li>

                <!-- defenseurs -->
                <!-- gauche -->
                <li class="defenseur defenseur1"><img src="_img/tb_dg.png"/><a href="#defenseur1" class="poste" id="defenseur1"><img src="_img/nojoueur.png" alt="" data-ssr="" id="jdg"/></a></li>
                <!-- centraux -->
                <li class="defenseur defenseur2"><img src="_img/tb_dc.png"/><a href="#defenseur2" class="poste" id="defenseur2"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jdc1"/></a></li>
                <li class="defenseur defenseur3"><img src="_img/tb_dc.png"/><a href="#defenseur3" class="poste" id="defenseur3"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jdc2"/></a></li>
                <!-- droit -->
                <li class="defenseur defenseur4"><img src="_img/tb_dd.png"/><a href="#defenseur4" class="poste" id="defenseur4"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jdd"/></a></li>
                <!-- gardien -->
                <li class="gardien"><img src="_img/tb_g.png"/><a href="#gardien1" class="poste" id="gardien1"><img src="_img/nojoueur.png" alt="" data-ssrc="" id="jg"/></a></li>
            </ul>
            <h3 id="legende">Sélectionne les 11 joueurs<br/>de ton équipe de la semaine !</h3>
            <a href="#continuer" id="continuer" class="bouton continuer nodisplay"><span>continue</span></a>
        </div>

        <!-- popup gardien -->
        <div class="popup nodisplay" id="gardien">
            <div class="modal">
                <div class="bordure">gardien<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#gardien" id="id-1"><img src="_img/nojoueur.png" alt="" data-src-g=""/></a></li><!--
                 --><li><a href="#gardien" id="id-2"><img src="_img/nojoueur.png" alt="" data-src-g=""/></a></li><!--
                 --><li><a href="#gardien" id="id-3"><img src="_img/nojoueur.png" alt="" data-src-g=""/></a></li>
                </ul>
            </div>
        </div>

        <!-- popup defenseurs centraux -->
        <div class="popup nodisplay" id="defenseurc">
            <div class="modal">
                <div class="bordure">défenseur central<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#defenseursc" id="id-4"><img src="_img/nojoueur.png" alt="" data-src-dc=""/></a></li><!--
                 --><li><a href="#defenseursc" id="id-5"><img src="_img/nojoueur.png" alt="" data-src-dc=""/></a></li><!--
                 --><li><a href="#defenseursc" id="id-6"><img src="_img/nojoueur.png" alt="" data-src-dc=""/></a></li><!--
                 --><li><a href="#defenseursc" id="id-7"><img src="_img/nojoueur.png" alt="" data-src-dc=""/></a></li><!--
                 --><li><a href="#defenseursc" id="id-8"><img src="_img/nojoueur.png" alt="" data-src-dc=""/></a></li><!--
                 --><li><a href="#defenseursc" id="id-9"><img src="_img/nojoueur.png" alt="" data-src-dc=""/></a></li>
                </ul>
            </div>
        </div>
        
        <!-- popup defenseurs gauche -->
        <div class="popup nodisplay" id="defenseurg">
            <div class="modal">
                <div class="bordure">défenseur gauche<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#defenseurg" id="id-10"><img src="_img/nojoueur.png" alt="" data-src-dg=""/></a></li><!--
                 --><li><a href="#defenseurg" id="id-11"><img src="_img/nojoueur.png" alt="" data-src-dg=""/></a></li><!--
                 --><li><a href="#defenseurg" id="id-12"><img src="_img/nojoueur.png" alt="" data-src-dg=""/></a></li>
                </ul>
            </div>
        </div>
       
        <!-- popup defenseurs droit -->
        <div class="popup nodisplay" id="defenseurd">
            <div class="modal">
                <div class="bordure">défenseur droit<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#defenseurd" id="id-13"><img src="_img/nojoueur.png" alt="" data-src-dd=""/></a></li><!--
                 --><li><a href="#defenseurd" id="id-14"><img src="_img/nojoueur.png" alt="" data-src-dd=""/></a></li><!--
                 --><li><a href="#defenseurd" id="id-15"><img src="_img/nojoueur.png" alt="" data-src-dd=""/></a></li>
                </ul>
            </div>
        </div>
        
        <!-- popup milieu defensif central -->
        <div class="popup nodisplay" id="milieudc">
            <div class="modal">
                <div class="bordure">milieu défensif central<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#milieudc" id="id-16"><img src="_img/nojoueur.png" alt="" data-src-mdc=""/></a></li><!--
                 --><li><a href="#milieudc" id="id-17"><img src="_img/nojoueur.png" alt="" data-src-mdc=""/></a></li><!--
                 --><li><a href="#milieudc" id="id-18"><img src="_img/nojoueur.png" alt="" data-src-mdc=""/></a></li>
                </ul>
            </div>
        </div>

        <!-- popup milieu central -->
        <div class="popup nodisplay" id="milieuc">
            <div class="modal">
                <div class="bordure">milieu central<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#milieuc" id="id-19"><img src="_img/nojoueur.png" alt="" data-src-mc=""/></a></li><!--
                 --><li><a href="#milieuc" id="id-20"><img src="_img/nojoueur.png" alt="" data-src-mc=""/></a></li><!--
                 --><li><a href="#milieuc" id="id-21"><img src="_img/nojoueur.png" alt="" data-src-mc=""/></a></li><!--
                 --><li><a href="#milieuc" id="id-22"><img src="_img/nojoueur.png" alt="" data-src-mc=""/></a></li><!--
                 --><li><a href="#milieuc" id="id-23"><img src="_img/nojoueur.png" alt="" data-src-mc=""/></a></li><!--
                 --><li><a href="#milieuc" id="id-24"><img src="_img/nojoueur.png" alt="" data-src-mc=""/></a></li>
                </ul>
            </div>
        </div>

        <!-- popup ailier gauche -->
        <div class="popup nodisplay" id="ailierg">
            <div class="modal">
                <div class="bordure">ailier gauche<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#ailierg" id="id-25"><img src="_img/nojoueur.png" alt="" data-src-ag=""/></a></li><!--
                 --><li><a href="#ailierg" id="id-26"><img src="_img/nojoueur.png" alt="" data-src-ag=""/></a></li><!--
                 --><li><a href="#ailierg" id="id-27"><img src="_img/nojoueur.png" alt="" data-src-ag=""/></a></li>
                </ul>
            </div>
        </div>

        <!-- popup ailier droit -->
        <div class="popup nodisplay" id="ailierd">
            <div class="modal">
                <div class="bordure">ailier droit<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#ailierd" id="id-28"><img src="_img/nojoueur.png" alt="" data-src-ad=""/></a></li><!--
                 --><li><a href="#ailierd" id="id-29"><img src="_img/nojoueur.png" alt="" data-src-ad=""/></a></li><!--
                 --><li><a href="#ailierd" id="id-30"><img src="_img/nojoueur.png" alt="" data-src-ad=""/></a></li>
                </ul>
            </div>
        </div>
        
        <!-- popup buteur -->
        <div class="popup nodisplay" id="buteur">
            <div class="modal">
                <div class="bordure">buteur<a href="#closepopup" class="closepopup"></a></div>
                <ul>
                    <li><a href="#buteur" id="id-31"><img src="_img/nojoueur.png" alt="" data-src-du=""/></a></li><!--
                 --><li><a href="#buteur" id="id-32"><img src="_img/nojoueur.png" alt="" data-src-du=""/></a></li><!--
                 --><li><a href="#buteur" id="id-33"><img src="_img/nojoueur.png" alt="" data-src-du=""/></a></li>
                </ul>
            </div>
        </div>

        <!-- formulaire -->
        <div class="formulaire nodisplay" id="formulaire">
            <img scr="_img/blank.gif" with="1332" height="795" data-src="_img/dt_bkg.jpg" class="bg"/>
            <img src="_img/blank.gif" width="427" height="328" data-src="_img/coin-gauche.png" class="cg"/>
            <img src="_img/blank.gif" width="438" height="428" data-src="_img/cercle.png" class="cercle nomobile"/>
            <img src="_img/blank.gif" width="392" height="597" data-src="_img/3joueurs.png" class="joueurs nomobile"/>
            <img src="_img/blank.gif" width="357" height="201" data-src="_img/coin-droit.png" class="cd"/>
            <img src="_img/blank.gif" width="252" height="180" data-src="_img/logo_fifa18.png" class="logo"/>
            <h2>Soumets-nous ta composition d’équipe<br/>et découvre, dès mercredi, si tu as vu juste&nbsp;!</h2>
            <div class="monequipe"><img src="_img/blnkequipe.gif" width="600" height="315" id="shareimg"/></div>
            <div class="saveprofil">
                <form id="saveprofil">
                    <ul>
                        <li><input type="text" name="nom" id="nom" value="" placeholder="Nom" maxlength="50"/></li>
                        <li><input type="text" name="prenom" id="prenom" value="" placeholder="Prénom" maxlength="50"/></li>
                        <li><input type="email" name="email" id="email" value="" placeholder="E-mail" maxlength="50"/></li>
                        <li class="mention" id="mention"><span>J'accepte le <a href="_pdf/jeu-EA-FIFAFUT.pdf" target="_blank">règlement</a> du jeu*&nbsp;</span><input type="checkbox" value="1" name="reglement" class="checkregle" id="reglement"/></li>
                    </ul>
                    <input name="token" type="hidden" value="<?php echo $tokenfs ?>"/>
                    <input name="action" type="hidden" value="saveprofil"/>
                    <input name="dataimg" type="hidden" value="" id="dataimg"/>
                </form>
            </div>
            <a href="#valider" class="bouton valide" id="valider"><span>Valide</span></a>
            <a href="#retour" class="retour" id="retour"><span>Retour</span></a>
            <p class="patienter nodisplay" id="patienter">Envoi des infos...<br/>Merci de patienter</p>
            <div class="dotation"><span class="xbold">à gagner</span><br/>chaque semaine<img src="_img/blank.gif" width="364" height="278" data-src="_img/dotation.png" class="dot"/>Un joueur de l’équipe de la semaine<br/>FIFA Ultimate Team</div>
        </div>

        <!-- partage -->
        <div class="partages nodisplay" id="partages">
            <img scr="_img/blank.gif" with="1332" height="795" data-src="_img/dt_bkg.jpg" class="bg"/>
            <img src="_img/blank.gif" width="427" height="328" data-src="_img/coin-gauche.png" class="cg"/>
            <img src="_img/blank.gif" width="438" height="428" data-src="_img/cercle.png" class="cercle nomobile"/>
            <img src="_img/blank.gif" width="392" height="597" data-src="_img/3joueurs.png" class="joueurs nomobile"/>
            <img src="_img/blank.gif" width="357" height="201" data-src="_img/coin-droit.png" class="cd"/>
            <img src="_img/blank.gif" width="252" height="180" data-src="_img/logo_fifa18.png" class="logo"/>
            <h2><span class="xbold">Merci de ta participation&nbsp;!</span><br/><br/>Rendez-vous mercredi pour découvrir l’équipe <br class="portrait"/>de la semaine FIFA Ultimate Team et <br class="portrait"/>voir si tu as eu le nez creux dans ta sélection&nbsp;!</h2>
            <div class="monequipe partage"><img src="_img/blnkequipe.gif" width="600" height="315" id="imgshare" data-shrc=""/></div>
            <h3><span class="hbold">Tu penses être l’expert absolu du football&nbsp;?</span><br/>Partage ta sélection avec tes amis<br/>et vois s'ils pensent la même chose&nbsp;:</h3>
            <ul class="partageliens">
                <li class="facebook"><a href="#facebook" id="facebook"><img src="_img/blank.gif" width="53" height="53"/></a></li><!--
             --><li class="twitter"><a href="#twitter" id="twitter"><img src="_img/blank.gif" width="53" height="53"/></a></li><!--
             --><li class="download"><a href="#download" id="download" data-dl="" target="_blank"><img src="_img/blank.gif" width="53" height="53"/></a></li>
            </ul>
            <div class="dotation"><span class="xbold">à gagner</span><br/>chaque semaine<img src="_img/blank.gif" width="364" height="278" data-src="_img/dotation.png" class="dot"/>Un joueur de l’équipe de la semaine<br/>FIFA Ultimate Team</div>
        </div>
        
        <?php } elseif ($participation == 0) { ?>
        <!-- du mercredi au vendredi (equipe de la semaine) -->
        <div class="partages" id="semainefifa">
            <img scr="_img/blank.gif" with="1332" height="795" data-src="_img/dt_bkg.jpg" class="bg"/>
            <img src="_img/blank.gif" width="427" height="328" data-src="_img/coin-gauche.png" class="cg"/>
            <img src="_img/blank.gif" width="438" height="428" data-src="_img/cercle.png" class="cercle"/>
            <img src="_img/blank.gif" width="392" height="597" data-src="_img/3joueurs.png" class="joueurs"/>
            <img src="_img/blank.gif" width="357" height="201" data-src="_img/coin-droit.png" class="cd"/>
            <img src="_img/blank.gif" width="252" height="180" data-src="_img/logo_fifa18.png" class="logo"/>
            <h2><span class="xbold">Voici l’équipe de la semaine<br/>FIFA Ultimate Team</h2>
            <div class="monequipe semainefifa"><a href="#zoom" id="zoom" class="zoom"><img src="_img/blnkequipe.gif" width="1200" height="630" id="imgshare" data-src="_teamfifa/<?php echo $fifateam ?>.jpg"/></a></div>
            <h3 class="ttfifa">Partage-la et dis-nous ce que tu en penses&nbsp;:</h3>
            <ul class="partageliens ptfifa">
                <li class="facebook"><a href="#facebook" id="facebook"><img src="_img/blank.gif" width="53" height="53"/></a></li><!--
             --><li class="twitter"><a href="#twitter" id="twitter"><img src="_img/blank.gif" width="53" height="53"/></a></li><!--
             --><li class="download"><a href="#download" id="download" data-dl="" target="_blank"><img src="_img/blank.gif" width="53" height="53"/></a></li>
            </ul>
            <?php if(!$mobile) { ?>
            <a href="http://po.st/fut-webapp" id="appli" class="bouton appli" target="_blank" rel="noopener noreferrer"><span>Accéder à la Web App</span></a>
            <?php } else {?>
                <h3 class="ttfifa">Télécharge l'appli<br/>EA SPORTS FIFA 18 Companion</h3>
            <?php } ?>
            <?php if($android){ ?>
                <ul><li class="playstore"><a href="http://po.st/fut-playstore" id="playstore" target="_blank" rel="noopener noreferrer"><img src="_img/blank.gif" width="53" height="53"/></a></li></ul>
            <?php };
            if($ipad || $iphone){ ?>
                <ul><li class="appstore"><a href="http://po.st/fut-appstore" id="appstore" target="_blank" rel="noopener noreferrer"><img src="_img/blank.gif" width="53" height="53"/></a></li></ul>
            <?php } ?> 
            <a href="http://po.st/fut-features" id="savoirplus" class="bouton noskew savoir" target="_blank" rel="noopener noreferrer"><span>En savoir plus sur FIFA Ultimate Team</span></a>
            <div class="dotation"><span class="xbold">à gagner</span><br/>chaque semaine<img src="_img/blank.gif" width="364" height="278" data-src="_img/dotation.png" class="dot"/>Un joueur de l’équipe de la semaine<br/>FIFA Ultimate Team</div>
        </div>

        <div class="popup nodisplay" id="zoomphot">
            <div class="modal modalzoom">
                <div class="bordure">FIFA Utimate Team<a href="#closepopup" class="closepopup"></a></div>
                <div class="zoomphot"><img src="_teamfifa/<?php echo $fifateam ?>.jpg" /></div>
            </div>
        </div>

        <?php } elseif ($participation == 2) {?>
        <!-- du vendredi au lundi (trophee de la semaine) -->
        <div class="partages" id="semainefifa">
            <img scr="_img/blank.gif" with="1332" height="795" data-src="_img/dt_bkg.jpg" class="bg"/>
            <img src="_img/blank.gif" width="427" height="328" data-src="_img/coin-gauche.png" class="cg"/>
            <img src="_img/blank.gif" width="438" height="428" data-src="_img/cercle.png" class="cercle"/>
            <img src="_img/blank.gif" width="392" height="597" data-src="_img/3joueurs.png" class="joueurs"/>
            <img src="_img/blank.gif" width="357" height="201" data-src="_img/coin-droit.png" class="cd"/>
            <img src="_img/blank.gif" width="252" height="180" data-src="_img/logo_fifa18.png" class="logo"/>
            <h2><span class="xbold">Trophée de l’équipe de la semaine<br/>RMC x FIFA Ultimate Team #1</h2>
            <div class="monequipe trophee"><img src="_img/blnkequipe.gif" width="1200" height="630" id="imgshare" data-src="_trophee/<?php echo $trophee ?>.jpg"/></div>
            <h3 class="tttrophee"><span class="hbold">Thomas MEUNIER</span><br/>Défenseur central au PSG - Ligue 1</h3>
            <ul class="partageliens pttrophee">
                <li class="facebook"><a href="#facebook" id="facebook"><img src="_img/blank.gif" width="53" height="53"/></a></li><!--
             --><li class="twitter"><a href="#twitter" id="twitter"><img src="_img/blank.gif" width="53" height="53"/></a></li>
            </ul>
            <div class="dotation"><span class="xbold">à gagner</span><br/>chaque semaine<img src="_img/blank.gif" width="364" height="278" data-src="_img/dotation.png" class="dot"/>Un joueur de l’équipe de la semaine<br/>FIFA Ultimate Team</div>
        </div>
        <?php } ?>

    </div> <!-- fin cotener -->

    <div class="footer"><iframe src="https://demo.greengardendigital.com/headerfooterrmc/hf/footer.html" frameborder="0" scrolling="no" name="frame2" title="menufooter"></iframe></div>

        <script type="text/javascript"> var ie9 = false; </script>
        <!--[if IE 8]> <script> ie9 = true </script><![endif]-->
        <!--[if IE 9]> <script> ie9 = true </script><![endif]-->

        <script>
            window.fbAsyncInit = function() {
                FB.init({
                appId      : '2096630937235188',
                xfbml      : true,
                version    : 'v2.11'
                });
                FB.AppEvents.logPageView();
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <script type="text/javascript">

            (function(){

                window.semaine = <?php echo $semaine ?>;
                window.token = '<?php echo $tokenfs ?>';
                window.refreshjson = <?php echo $refresh ?>;
                window.participation = <?php echo $participation ?>;
                window.fifateam = '<?php echo $fifateam ?>';
                window.trophee = '<?php echo $trophee ?>';
                window.ismobil = <?php echo $ismobile ?>;
                window.isipad = <?php echo $isipad ?>;
                window.panik = <?php echo $panik ?>;

                <?php 
                    if($participation == 1){
                ?>  
                var deferjs = [
                    '_js/manageEvents14.js',
                    '_js/q2.js',
                    '_js/manageEventsPromises11.js',
                    '_js/logic_p14.js'
                ],
                <?php } elseif($participation == 0) { ?>
                    var deferjs = [
                        '_js/manageEvents14.js',
                        '_js/logic_p02.js'
                    ],
                <?php } elseif($participation == 2) { ?>
                    var deferjs = [
                        '_js/manageEvents14.js',
                        '_js/logic_p21.js'
                    ],
                <?php } ?>
                initAfter = function(){
                    console.log('all js loaded');
                },
                i = 0,
                downloadJSAtOnload = function(callback) {
                    // charge JS et CSS
                    var t = deferjs.length-1;
                    // chargement JS
                    //if (deferjs[i].match('^(.*\.js)$')){
                    if (deferjs[i].match('^(.*\.js)')){
                    var element = document.createElement('script');
                        element.setAttribute('type','text/javascript');
                        element.setAttribute('src',deferjs[i]);
                        if (element.addEventListener != undefined){
                        element.addEventListener('load',function(e){
                        //console.log('LOADED : ' + deferjs[i]);
                            i++;
                            if(i <= t) downloadJSAtOnload(callback);
                            if(i > t) {
                                //console.log('JS chargés');
                                callback();
                            }
                        });
                        }else if (element.readyState){ // IE8
                            element.onreadystatechange = function(){
                                if(element.readyState == 'loaded' || element.readyState == 'complete') {
                                    //console.log('LOADED : ' + deferjs[i]);
                                    i++;
                                if(i <= t) downloadJSAtOnload(callback);
                                    if(i > t) {
                                        //console.log('JS chargés ie8');
                                        callback();
                                    }
                                }
                            }
                        }

                        if(i <= t) document.body.appendChild(element);

                    };

                    // chargement CSS
                        if (deferjs[i].match('^(.*\.css)$')){
                        loadStylesheet(deferjs[i]);
                            i++;
                            if(i <= t) downloadJSAtOnload();
                            //if(i > t) console.log('CSS chargées');

                        }
                },

                DomLoaded = function(e){
                    if(ie9) deferjs.push('_js/pointereventspolyfill.js');
                    downloadJSAtOnload(initAfter);
                }

                if (window.addEventListener){
                    window.addEventListener('DOMContentLoaded', function(){DomLoaded()});
                }else if (window.attachEvent){ // IE8
                    window.attachEvent('onload', function() { DomLoaded(); });
                }else{
                    window.onload = DomLoaded();
                }

            })();

          // console.log( window.frames['frame1'].document.getElementsByTagName('a'));
        </script>

   
    </body>

</html>