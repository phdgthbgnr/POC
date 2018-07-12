<?php
    // TOKEN POUR APPEL AJAX ------------------------------------------------------------------------
    session_start();
    $token = md5(rand(1000,9999)); //you can use any encryption
    $_SESSION['nba2ktoken'] = $token; //store it as session variable
    // ----------------------------------------------------------------------------------------------    
    header("X-Frame-Options: DENY");
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA2K17</title>
    <?php 
        if(preg_match("/greengardendigital.com/",$_SERVER['SERVER_NAME'])){
            $urlshare = 'http://demo.greengardendigital.com/NBA2K17/jeux/';
    ?>
        <meta property="og:url" content="http://demo.greengardendigital.com/NBA2K17/jeux/" /> 
        <meta property="og:title" content="Jouez avec NBA2K17 et partez à Miami" />
        <meta property="og:description" content="Jouez et tentez de remporter un séjour à Miami avec NBA2K17 et Hypergames #ContestNBA2K17" /> 
        <meta property="og:image" content="http://demo.greengardendigital.com/NBA2K17/jeux/NBA2K17-Coucours-Auchan-Post-Facebook-1230x630.jpg" />
    <?php
        }
    if(preg_match("/jeu-concoursnba2kdev.2kweb.online/",$_SERVER['SERVER_NAME'])){
        $urlshare = 'https://jeu-concoursnba2kdev.2kweb.online/';
    ?>
        <meta property="og:url" content="https://jeu-concoursnba2kdev.2kweb.online/" /> 
        <meta property="og:title" content="Jouez avec NBA2K17 et partez à Miami" />
        <meta property="og:description" content="Jouez et tentez de remporter un séjour à Miami avec NBA2K17 et Hypergames #ContestNBA2K17" /> 
        <meta property="og:image" content="https://jeu-concoursnba2kdev.2kweb.online/NBA2K17-Coucours-Auchan-Post-Facebook-1230x630.jpg" />    
    <?php
        }
    if(preg_match("/jeu-concoursnba2k.com/",$_SERVER['SERVER_NAME'])){
        $urlshare = 'http://jeu-concoursnba2k.com/';
    ?>
        <meta property="og:url" content="http://jeu-concoursnba2k.com/" /> 
        <meta property="og:title" content="Jouez avec NBA2K17 et partez à Miami" />
        <meta property="og:description" content="Jouez et tentez de remporter un séjour à Miami avec NBA2K17 et Hypergames #ContestNBA2K17" /> 
        <meta property="og:image" content="http://jeu-concoursnba2k.com/NBA2K17-Coucours-Auchan-Post-Facebook-1230x630.jpg" />    
    <?php
        }
    ?>
    <link rel="stylesheet" href="_styles/style.css">
    <style id="antiClickjack">body{display:none !important;}</style>
        <script type="text/javascript">
       if (self === top) {
           var antiClickjack = document.getElementById("antiClickjack");
           antiClickjack.parentNode.removeChild(antiClickjack);
       } else {
           top.location = self.location;
       }
    </script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>

    <div id="main" class="main">
        
        <div class="logo"><img src="_images/nba2k17-logo.png" alt="nba2k17"/></div>
        
        <div class="page" id="page0">
            <div class="texte bloc0">
                <p class="para1">jouez et tentez de remporter</p>
                <p class="para2">un séjour pour<br/>2 personnes à miami</p>
                <p class="para3">et assistez à un match nba !</p>
                <a href="#jouer" id="jouer" class="jouer"><img src="_images/bt-jouer-blk.gif" alt="jouer"/></a>
                <p class="reglement"><a href="http://2kgam.es/NBA2K_jeuconcours" target="_blank" class="reglement">Voir le réglement</a></p>
                <div class="nbavideo">
                    <img src="_images/videoblnk.png"/>
                    <div id="ytvideo" class="videoyt">
                        <div id="player" class="player"></div>
                        
                    </div>
                </div>
                
            </div>
        </div>

        <div class="page novisible" id="page1">
            <div class="texte bloc1">
                <p class="punch"><span>Testez vos connaissances sur notre quiz pour gagner un voyage pour</span> 2 personnes à Miami et assister à un match de NBA !</p>
                <div class="blocq">
                    <p class="numquestion">question 1/3</p>
                    <p class="question" id="question1"></p>
                    <ul class="reponses" id="reponses1"></ul>
                </div>    
                <a href="#continuer" id="continuer1" class="jouer continuer"><img src="_images/bt-jouer-blk.gif" alt="continuer"/></a>
            </div>
        </div>

        <div class="page novisible" id="page2">
            <div class="texte bloc2">
                <p class="punch"><span>Testez vos connaissances sur notre quiz pour gagner un voyage pour</span> 2 personnes à Miami et assister à un match de NBA !</p>
                <div class="blocq">
                    <p class="numquestion">question 2/3</p>
                    <p class="question" id="question2"></p>
                    <ul class="reponses" id="reponses2"></ul>
                </div>
                <a href="#continuer" id="continuer2" class="jouer continuer"><img src="_images/bt-jouer-blk.gif" alt="continuer"/></a>
            </div>
        </div>


        <div class="page novisible" id="page3">
            <div class="texte bloc3">
                <p class="punch"><span>Testez vos connaissances sur notre quiz pour gagner un voyage pour</span> 2 personnes à Miami et assister à un match de NBA !</p>
                <div class="blocq">
                    <p class="numquestion">question 3/3</p>
                    <p class="question" id="question3"></p>
                    <ul class="reponses" id="reponses3"></ul>
                </div>
                <a href="#continuer" id="continuer3" class="jouer continuer"><img src="_images/bt-jouer-blk.gif" alt="continuer"/></a>
            </div>
        </div>

        
        <div class="page novisible" id="page4">
            <div class="texte bloc4">
                <div class="blocq">
                    <p class="bravo">Bravo!</p>
                    <p class="punch2">Inscrivez-vous pour participer au tirage au sort et tenter de gagner un séjour pour 2 personnes à Miami et assister à un match de NBA.</p>
                    <a href="#" class="jouer facebook" id="loginFB"><img src="_images/bt-facebookr-blk.gif" alt="s'inscrire avec facebook"/></a>
                    <p class="erreurs" id="erreursfb"></p>
                    <p class="punch2" id="labelform">Ou en remplissant ce formulaire :</p>
                    <form id="formulaire" class="formulaire">
                        
                        <input type="text" value="" name="nom" placeholder="NOM" id="nom"/>
                        <input type="text" value="" name="prenom" placeholder="PRENOM" id="prenom"/>
                        <input type="text" value="" name="mail" placeholder="ADRESSE EMAIL" id="mail"/>
                        <label><input type="checkbox" value="1" name="reglement" class="regle" id="reglement"/>J’ai lu et j’accepte les termes et conditions du réglement</label>
                        <input type="hidden" name="action" value="inscription"/>
                        <input type="hidden" name="fbinscr" value="0" id="fbinscr"/>
                        <input type="hidden" name="token" value="<?php echo $token ?>"/>
                        <?php
                        if(preg_match("/greengardendigital.com/",$_SERVER['SERVER_NAME'])){
                        ?>
                        <div class="g-recaptcha" data-sitekey="6Leg5AYUAAAAAHGRCWlY-OaS8gPs-SogLAP_vzjw"></div>
                        <?php
                        }
                        if(preg_match("/jeu-concoursnba2kdev.2kweb.online/",$_SERVER['SERVER_NAME']) || preg_match("/jeu-concoursnba2ktest.2kweb.online/",$_SERVER['SERVER_NAME']) || preg_match("/jeu-concoursnba2kstg.2kweb.online/",$_SERVER['SERVER_NAME']) || preg_match("/jeu-concoursnba2k.com/",$_SERVER['SERVER_NAME'])){
                        ?>
                        <div class="g-recaptcha" data-sitekey="6LdP6QYUAAAAABAVbU_8JSxNXBCbQdj88ZybcCVh"></div>
                        <?php
                        }
                        ?>
                        <!-- <input type="submit" value="" value="submit" id="inscrire" class="inscrire"/> -->
                    </form>
                    
                    <p class="erreurs" id="erreurs"></p>
                    <a href="#formulaire" id="inscrire" class="inscrire"><img src="_images/bt-inscrire-blk.gif" alt="s'inscrire"/></a>
                </div>
            </div>
        </div>
        
        
        <div class="page novisible" id="page5">
            <div class="texte bloc4">
                <div class="blocq">
                    <p class="bravo">Merci!</p>
                    <p class="punch2">Partagez sur Facebook et Twitter.</p>
                    <a href="#" class="share sharefb" id="sharefb"><img src="_images/bt_share_blk.gif" alt="facebook"/></a>
                    <a href="#" target="_blank" class="share sharetwt" id="sharetwt"><img src="_images/bt_share_blk.gif" alt="twitter"/></a>
                </div>
            </div>
        </div>

        <div class="legals"><img src="_images/legals.png"/></div>

    </div>

    <script src="_js/main.js"></script>
    <script>
        var fid = '0';
        var fbhref = '';
        var token = '<?php echo $token ?>';
        <?php
            if(preg_match("/greengardendigital.com/",$_SERVER['SERVER_NAME'])){
            ?>
            fid = '680086685500035';
            fbhref = 'http://demo.greengardendigital.com/NBA2K17/jeux/';
        <?php
            }
            if(preg_match("/jeu-concoursnba2kdev.2kweb.online/",$_SERVER['SERVER_NAME'])){
            ?>
            fid = '878258412309056';
            fbhref = 'https://jeu-concoursnba2kdev.2kweb.online';
        <?php
            }
            if(preg_match("/jeu-concoursnba2k.com/",$_SERVER['SERVER_NAME'])){
            ?>
            fid = '837137913089670';
            fbhref = 'http://jeu-concoursnba2k.com';
        <?php
            }
        ?>
        // video --------------------------------------------------------------------------    

        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');
        //tag.src = "http://www.youtube.com/player_api";
        tag.src = "https://www.youtube.com/player_api";
        //tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        
        var player;
 
        function onYouTubePlayerAPIReady() {

            player = new YT.Player('player', {
                width: '100%',
                height: '100%',
                videoId: 'cQKDcMxTAfw',
                playerVars: { 'autoplay': 0, 'controls': 1, 'html5': 1 ,'enablejsapi':0,'showinfo':0,'iv_load_policy':3,'modestbranding':1,'rel':0},

                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
            
        }
        
        function onPlayerReady(event) {
            //console.log('video ready');
            //event.target.playVideo();
        }
        
        function onPlayerStateChange(event) {
        }
        
            
    </script>
</body>
</html>
