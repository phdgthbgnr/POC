<?php
  // TOKEN POUR APPEL AJAX ------------------------------------------------------------------------
  session_start();
  $token = md5(rand(1000,9999)); //you can use any encryption
  //$uniqid = md5(uniqid(rand( ), true));
  $_SESSION['token'] = $token; //store it as session variable
  // ----------------------------------------------------------------------------------------------

  $mycook = array();
  $cgardiens = array();     // gardiens
  $cdefcent = array();      // defenseurs centraux
  $cdeflat = array();       // defenseurs lateraux
  $cmildef = array();       // milieux defensifs
  $cmiloff = array();       // milieux offensifs
  $cattaquants = array();   // attaquants
  $cformation = 0;

  //$idjoue = '';
  //$tokens = '';
  // TOKEN POUR COOKIE ----------------------------------------------------------------------------
  if(!isset($_COOKIE['rmcjbl11liste'])){
    //echo 'pas cookie';
    $cook = md5(uniqid(rand(), true)); // tokenid joueur
    $datacook=array();
    $datacook['token']=$cook;
    $datacook['tokenshare']='';
    $datacook['idjoueur']='';
    $datacook['formation']='';
    $datacook['gard']=array();
    $datacook['defcent']=array();
    $datacook['deflat']=array();
    $datacook['mildef']=array();
    $datacook['miloff']=array();
    $datacook['attaq']=array();
    setcookie('rmcjbl11liste', serialize($datacook), time()+60*60*24*30, '/');
  }else{
    //echo 'cookie';
    $mycook = unserialize($_COOKIE['rmcjbl11liste']);
  }


if(count($mycook)>0){
    if(isset($mycook['gard']) && count($mycook['gard'])>0){
      $cgardiens = $mycook['gard'];
    }

    if(isset($mycook['defcent']) && count($mycook['defcent'])>0){
      $cdefcent = $mycook['defcent'];
    }

    if(isset($mycook['deflat']) && count($mycook['deflat'])>0){
      $cdeflat = $mycook['deflat'];
    }

    if(isset($mycook['mildef']) && count($mycook['mildef'])>0){
      $cmildef = $mycook['mildef'];
    }

    if(isset($mycook['miloff']) && count($mycook['miloff'])>0){
      $cmiloff = $mycook['miloff'];
    }

    if(isset($mycook['attaq']) && count($mycook['attaq'])>0){
      $cattaquants = $mycook['attaq'];
    }

    if(isset($mycook['formation']) && !empty($mycook['formation'])){
      $cformation = $mycook['formation'];
    }

    //if(isset($mycook['tokenshare']) && !empty($mycook['tokenshare'])) $tokens = $mycook['tokenshare'];
    //if(isset($mycook['idjoueur']) && !empty($mycook['idjoueur'])) $idjoue = $mycook['idjoueur'];
}
$vers=$_SERVER['HTTP_USER_AGENT'];
$iphone = false;
$mobile = false;
$ipad = false;
$hframe = 158;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Votre liste des 11</title>
    <?php
        if (strpos($vers,'iPad') && strpos($vers,'Mobile')){ //  && strpos($vers,'Version/5.1')
            $ipad = true;
            echo '<meta name="viewport" content="width=1024, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=0" />';
        }else{
            if (strpos($vers,'iPhone') && strpos($vers,'Mobile')){
              $iphone = true;
                echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >';  // iphone
            }else{
                echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >';
            }
           //
        }
        if(!strpos($vers,'iPhone') && strpos($vers,'Mobile')){
          $mobile = true;
        }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="selectionnez vos 11 joueurs pour l'euro 2016" />
    <meta name="keywords" content="euro 2016" />
    <meta property="og:url" content="http://votre11bleu.bfmtv.com/" />
    <meta property="og:title" content="Sélectionnez vos 11 joueurs avec JBL" />
    <meta property="og:description" content="Comparez votre groupe à ceux de la Dream Team RMC Sport et aux choix des internautes !" />
    <meta property="og:image" content="http://votre11bleu.bfmtv.com/partage-ton-11.jpg" />
    <link rel="stylesheet" href="_css/stylermc.css">
    <?php
    if($iphone){
      echo "<style>body{font-size:10pt;}</style>";
      $hframe = 100;
    }
    if($mobile){
      echo "<style>body{font-size:10pt;}</style>";
      $hframe = 100;
    }
    if ($ipad) $hframe = 158;
     ?>
</head>

<body>

  <div class="global" id="global">

  <div id="header" class="header">
    <iframe src="header-footer/header.html" width="100%" height="<?php echo $hframe ?>" frameborder="0" scrolling="no"></iframe>
  </div>

  <div id="screen0" class="screens">
    <div class="intro">
      <img src="_images/scr01_bg.jpg" class="bgintro"/>
      <h1><img src="_images/scr01_titre1.png" alt="selectionnez vos 11 joueurs"/></h1>
      <h2><img src="_images/scr01_titre2.png" alt="et comparez votre groupe à ceux de la Dream Team RMC Sport et aux choix des internautes"/></h2>
      <span class="demarre"><a href="#" id="demarrer" class="bouton demarrer">démarrer</a><span>
    </div>
  </div>

  <div id="screen1" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3 class="hformations">Choisissez votre formation</h3></div>
    <ul class="formations">
      <li><a href="4132"><img src="_images/4132.jpg"/><span class="formation">4-4-2<span>en losange</span></span></a></li>
      <li><a href="442"><img src="_images/442.jpg"/><span class="formation">4-4-2<span>à plat avec milieux récupérateurs</span></span></a></li>
      <li><a href="433"><img src="_images/433.jpg"/><span class="formation">4-3-3<span>pointe basse</span></span></a></li>
    </ul>
    <div class="continu"><a href="formations" class="bouton continuer disabled" id="cont_formations">Continuer</a></div>
    <br/><br/><br/><br/>
  </div>

  <div id="screen2" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3 class="hgardiens">sélectionnez 1 gardien <span class="decompte"><span id="decompte1"><?php echo count($cgardiens);?></span> / <span class="lrouge">1</span></span></h3></div>
    <div id="gardiens"></div>
  </div>

  <div id="screen3" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3 class="hdefenseurs">sélectionnez 2 défenseurs centraux<span class="decompte"><span id="decompte2"><?php echo count($cdefcent);?></span> / <span class="lrouge">2</span></span></h3></div>
    <div id="defenseursc"></div>
  </div>

  <div id="screen4" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3 class="hdefenseurs">sélectionnez 2 défenseurs latéraux<span class="decompte"><span id="decompte3"><?php echo count($cdeflat);?></span> / <span class="lrouge">2</span></span></h3></div>
    <div id="defenseursl"></div>
  </div>

  <div id="screen5" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3 class="hmilieux">sélectionnez <span id="nbmild1">0</span> <span id="textd1">milieux défensifs</span><span class="decompte"><span id="decompte4"><?php echo count($cmildef);?></span> / <span class="lrouge" id="nbmild2">0</span></span></h3></div>
    <div id="milieuxd"></div>
  </div>

  <div id="screen6" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3 class="hmilieux">sélectionnez <span id="nbmilo1">0</span> <span id="texto1">milieux offensifs</span><span class="decompte"><span id="decompte5"><?php echo count($cmiloff);?></span> / <span class="lrouge" id="nbmilo2">0</span></span></h3></div>
    <div id="milieuxo"></div>
  </div>

  <div id="screen7" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3 class="hattaquants">sélectionnez <span id="nbatt1">0</span> attaquants<span class="decompte"><span id="decompte6"><?php echo count($cattaquants);?></span> / <span class="lrouge" id="nbatt2">0</span></span></h3></div>
    <div id="attaquants"></div>
  </div>

  <div id="screen8" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3>Votre 11 bleu</h3></div>
    <div id="ton23" class="ton23"></div>
    <div id="taformation" class="taformation"></div>
    <div id="validliste" class="clearboth"></div>
  </div>

  <div id="screen9" class="screens screens7 inactif">
    <div class="schead"><a href="http://bit.ly/1Q6CCah" target="_blank"><img src="_images/logo_jbl.png" class="logo"/></a><h3>Votre 11 bleu</h3></div>
    <div class="blocs">
      <div class="recap" id ="recap"></div>
      <div class="formulaire">
        <a href="http://bit.ly/1Q6CCah" target="_blank"><img src="_images/scr07_bg.jpg"/></a>
        <div class="pub">
          <p><span class="bleue">La Charge 2+ JBL est une puissante enceinte portable Bluetooth aux basses riches et à l’autonomie longue durée,</span> elle intègre même une powerbank pour recharger votre téléphone via USB.</p>
          <p>Gagnez l’édition limitée de l’enceinte Raphaël Varane (non commercialisée) et profitez du son JBL dans un design unique.</p>
          <a href="http://bit.ly/1Q6CCah" target="_blank" class="bouton infos">Plus d'infos</a>
        </div>
        <form id="profil" class="profil">
          <input type="text" placeholder="Votre Nom" name="nom" id="nom" value="Votre nom*" class="champ"/>
          <input type="text" placeholder="Prénom" name="prenom" id="prenom" value="Votre prénom*" class="champ"/>
          <input type="email" placeholder="Votre email" name="email" id="email" value="Votre email*" class="champ"/>
          <ul>
            <li class="mention">Je souhaite recevoir chaque jour la newsletter RMC Sport *</li>
            <li class="radios"><input type="radio" name="newsletter" value="1" class="buton"><span>Oui</span><input type="radio" name="newsletter" value="0" class="buton"><span>Non</span></li>
            <li class="mention">Je souhaite recevoir les offres exclusives et les bons plans de RMC Sport et de ses partenaires *</li>
            <li class="radios"><input type="radio" name="offres" value="1" class="buton"><span>Oui</span><input type="radio" name="offres" value="0" class="buton"><span>Non</span></li>
            <li class="mention"><span>J'accepte le <a href="Reglement-cadre-2016-Jeux-NI-VD.pdf" target="_blank">règlement</a> du jeu*&nbsp;</span><input type="checkbox" value="1" name="reglement" class="checkregle"/></li>
          </ul>
          <span class="erreur" id="erreur"></span>
          <input type="submit" class="boutoni" value="Participer" id="participer">
          <input type="hidden" name="token" value="<?php echo $token?>">
        </form>
        <p class="legales" style="text-align:center">* Champs obligatoires</p>
        <p class="legales">
Conformément à la Loi Informatique et Liberté du 6 janvier 1978 et de la loi
pour la confiance dans l'Economie Numérique du 21 juin 2004,
vous bénéficiez d'un droit d'accès, de rectification et de suppression des données
qui vous concernent (art.34 de la loi "Informatique et Liberté"). Pour l'exercer <a href="http://www.bfmtv.com/info/mentions-legales/" target="_blank">consultez nos mentions légales</a>.</p>
      </div>
    </div>
    <p class="clearboth"></p>
  </div>

  <div id="screen10" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3>Le 11 bleu de la Dream Team</h3></div>
    <div class="dreamteam" id="dreamteam"></div>
  </div>

  <div id="screen11" class="screens inactif">
    <div class="team23" id="team23"></div>
  </div>

  <div id="screen12" class="screens inactif">
    <div class="schead"><img src="_images/logo_jbl.png" class="logo"/><h3>Le 11 bleu des internautes</h3></div>
    <div class="legende"><span class="roundedleg"><span>%</span></span>&nbsp;&nbsp;Pourcentage de votes des internautes</div>
    <div class="internaut23" id="internaut23"></div>
  </div>

  <div id="bullets" class="bullets">
    <ul>
      <li><a href="#0" class="bull"></a></li>
      <li><a href="#1" class="bull"></a></li>
      <li><a href="#2" class="bull"></a></li>
      <li><a href="#3" class="bull"></a></li>
      <li><a href="#4" class="bull"></a></li>
      <li><a href="#5" class="bull"></a></li>
      <li><a href="#6" class="bull"></a></li>
      <li><a href="#7" class="bull"></a></li>
  </div>


  <div id="footer">
    <iframe src="header-footer/footer.html" width="100%" height="236" frameborder="0" scrolling="no"></iframe>
  </div>

</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6&appId=325464954309020";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script src="//code.jquery.com/jquery-1.12.2.min.js"></script>
<script>
// (function(){

        var _idjoueur;
        var _tokens;

        var hh;
        var wh;
        var whn;
        var request = null; // pour les footballeurs
        var _formation = <?php echo $cformation ?>;

        var _mg = 1;      // max array gardiens
        var _dfc = 2;     // max array defenseurs centraux
        var _dfl = 2;     // max array defenseurs lateraux
        // redefinis apres clic sur les 2 formations
        var _mldf = -1;   // max array milieux defensifs
        var _mloff = -1;  // max array milieux offensifs
        var _at = -1;     // max array attaquants

        //var request3 = null; // pour le recap de ton 23
        var _gardiens = [<?php echo implode(',',$cgardiens) ?>];
        var _defenseursc = [<?php echo implode(',',$cdefcent) ?>];
        var _defenseursl = [<?php echo implode(',',$cdeflat) ?>];
        var _milieuxd = [<?php echo implode(',',$cmildef) ?>];
        var _milieuxo = [<?php echo implode(',',$cmiloff) ?>];
        var _attaquants = [<?php echo implode(',',$cattaquants) ?>];
        var dbjoueurs;
        var dbteam;


        function findId(arr,id){
          return arr.indexOf(id);
        }


        function removeId(arr,id){
          var ind = arr.indexOf(id);
          if(ind >-1){
            arr.splice(ind,1);
          }
          //console.log(arr);
        }

        // redefinit max array suivant formation
        setMaxArrays();

        function createliste(property,idposte,elem,scrol){
          scrol = scrol === undefined ? true : scrol;
          var scr = 0;
          var elems = '<ul class="listejoueurs">';
          for(var t in dbjoueurs){
            if(dbjoueurs[t][property] == idposte){
              var id = parseInt(t);
              if(elem == 'defenseursl' && findId(_defenseursc,id) != -1){
                continue;
              }
              if(elem == 'milieuxo' && findId(_milieuxd,id) != -1){
                continue;
              }
                var nom = dbjoueurs[t].nom;
                var prenom = dbjoueurs[t].prenom;
                var fichier = dbjoueurs[t].fichier+'.jpg';
                var age =  dbjoueurs[t].age;
                var sel = dbjoueurs[t].select;
                var seltxt =  parseInt(sel) > 1? 'sélections':'sélection';
                var select;
                switch(elem){
                  case 'gardiens':
                  select = findId(_gardiens,id) == -1 ? '' : 'selectjoueur';
                  src = 2;
                  break;
                  case 'defenseursc':
                  select = findId(_defenseursc,id) == -1 ? '' : 'selectjoueur';
                  src = 3;
                  break;
                  case 'defenseursl':
                  select = findId(_defenseursl,id) == -1 ? '' : 'selectjoueur';
                  src = 4;
                  break;
                  case 'milieuxd':
                  select = findId(_milieuxd,id) == -1 ? '' : 'selectjoueur';
                  src = 5;
                  break;
                  case 'milieuxo':
                  select = findId(_milieuxo,id) == -1 ? '' : 'selectjoueur';
                  src = 6;
                  break;
                  case 'attaquants':
                  select = findId(_attaquants,id) == -1 ? '' : 'selectjoueur';
                  src = 7;
                  break;
                }
                elems +='<li><a href="'+id+'" class="rounded seljoueur '+elem+' '+select+'" data-joueurid="'+id+'"><img src="_footballeurs/'+fichier+'"/></a><p class="texte"><span class="nom"><span class="prenom">'+prenom+'</span> '+nom+'</span><br/><span class="age">'+age+' ans | '+sel+' '+seltxt+'</span></p></li>';
            }
          }
          elems += '</ul>';
          elems += '<div class="continu"><a href="'+elem+'" class="bouton continuer disabled" id="cont_'+elem+'">Continuer</a></div>';
          $('#'+elem).empty().append(elems);
          renewhref('.seljoueur');
          renewhref('.continuer');
          switch (elem) {
            case 'gardiens':
              if(_gardiens.length == _mg) $('#cont_'+elem).removeClass('disabled');
              break;
            case 'milieuxd':
              if(_milieuxd.length == _mldf) $('#cont_'+elem).removeClass('disabled');
              break;
            case 'milieuxo':
                if(_milieuxo.length == _mloff) $('#cont_'+elem).removeClass('disabled');
                break;
            case 'defenseursc':
              if(_defenseursc.length == _dfc) $('#cont_'+elem).removeClass('disabled');
              break;
            case 'defenseursl':
                if(_defenseursl.length == _dfl) $('#cont_'+elem).removeClass('disabled');
                break;
            case 'attaquants':
              if(_attaquants.length == _at) $('#cont_'+elem).removeClass('disabled');
              break;
          }
          if(scrol) scrollPage(src);
        }


        function setcookie(callback,sc){
          //console.log('set cookie');
          if(request) request.abort();
          request=$.ajax({
            url: '_inc/cookiejoueur.php',
            data: {'token': '<?php echo $token?>','formation':_formation,'gardiens':_gardiens,'defcent':_defenseursc,'deflat':_defenseursl,'mildef':_milieuxd,'miloff':_milieuxo,'attaq':_attaquants}, //capture.data,
            type: 'post',
            dataType:'json',
            success: function( res ) {
              if(callback) callback(sc);
              request=null;
            },
            error:function(result){
              console.log('error');
              request=null;
            }
          })
        }

        function scrollPage(i){
          var target;
           switch(i){
             case 0:
             target = $('#screen0');
             break;
             case 1:
             target = $('#screen1');
             break;
             case 2:
             target = $('#screen2');
             break;
             case 3:
             target = $('#screen3');
             break;
             case 4:
             target = $('#screen4');
             break;
             case 5:
             target = $('#screen5');
             break;
             case 6:
             target = $('#screen6');
             break;
             case 7:
             target = $('#screen7');
             break;
             case 8:
             target = $('#screen8');
             break;
             case 9:
             target = $('#screen9');
             break;
             case 10:
             target = $('#screen10');
             break;
             case 11:
             target = $('#screen11');
             break;
             case 12:
             target = $('#screen12');
             break;

           }
           if(target){
             $('html, body').animate({
                scrollTop: target.offset().top+2
              }, 400);
            }
            return false;
        }


        function checkBullet(c){
            $('#bullets ul li a').each(function(i){
                var _t = $(this);
                if(_t.hasClass('current')) _t.removeClass('current');
                if(_t.hasClass('played')) _t.removeClass('played');

                switch(i){
                  case 0:
                  if(c==0) _t.addClass('current');
                  if(_gardiens.length == _mg && c!=0)  _t.addClass('played');
                  break;
                  case 1:
                  if(c==1) _t.addClass('current');
                  if(_gardiens.length == _mg && c!=1)  _t.addClass('played');
                  break;
                  case 2:
                  if(c==2) _t.addClass('current');
                  if(_gardiens.length == _mg && c!=2)  _t.addClass('played');
                  break;
                  case 3:
                  if(c==3) _t.addClass('current');
                  if(_defenseursc.length == _dfc && c!=3)  _t.addClass('played');
                  break;
                  case 4:
                  if(c==4) _t.addClass('current');
                  if(_defenseursl.length == _dfl && c!=4)  _t.addClass('played');
                  break;
                  case 5:
                  if(c==5) _t.addClass('current');
                  if(_milieuxd.length == _mldf && c!=5)  _t.addClass('played');
                  break;
                  case 6:
                  if(c==6) _t.addClass('current');
                  if(_milieuxo.length == _mloff && c!=6)  _t.addClass('played');
                  break;
                  case 7:
                  if(c==7) _t.addClass('current');
                  if(_attaquants.length == _at && c!=7)  _t.addClass('played');
                  break;


                  //if(_gardiens.length == _mg && _defenseurs.length == _df && _milieux.length == _ml && _attaquants.length == _at && c!=5)  _t.addClass('played');
                }
            })
          }

        function selectListe(clss){
            var elems = '<ul class="'+clss+'">';
            elems += '<li class="poste"><span>Gardiens</span></li>';
            elems += '<li>';
            elems += '<ul>';
            elems += createFromSelect('gardiens');
            elems += '</ul>';
            elems += '</li>';
            elems += '<li class="poste"><span>Défenseurs</span></li>';
            elems += '<li>';
            elems += '<ul>';
            elems += createFromSelect('defenseursc');
            //elems += '</ul>';
            //elems += '</li>';
            //elems += '<li class="poste"><span>Défenseurs latéraux</span></li>';
            //elems += '<li>';
            //elems += '<ul>';
            elems += createFromSelect('defenseursl');
            elems += '</ul>';
            elems += '</li>';
            elems += '<li class="poste"><span>Milieux de terrains</span></li>';
            elems += '<li>';
            elems += '<ul>';
            elems += createFromSelect('milieuxd');
            //elems += '</ul>';
            //elems += '</li>';
            //elems += '<li class="poste"><span>Milieux offensifs</span></li>';
            //elems += '<li>';
          //  elems += '<ul>';
            elems += createFromSelect('milieuxo');
            elems += '</ul>';
            elems += '</li>';
            elems += '<li class="poste"><span>Attaquants</span></li>';
            elems += '<li>';
            elems += '<ul>';
            elems += createFromSelect('attaquants');
            elems += '</ul>';
            elems += '</li>';
            elems += '</ul>';
            return elems;
        }



        function createFromSelect(arr){
            var tab;
            var ret = '';
            switch (arr) {
              case 'gardiens':
                tab = _gardiens;
                break;
              case 'defenseursc':
                tab = _defenseursc;
                break;
              case 'defenseursl':
                  tab = _defenseursl;
                  break;
              case 'milieuxd':
                tab = _milieuxd;
                break;
              case 'milieuxo':
                  tab = _milieuxo;
                  break;
              case 'attaquants':
                tab = _attaquants;
                break;
            }
            for(var t in tab){
              var indx = tab[t];
              var nom = dbjoueurs[indx].nom;
              var prenom = dbjoueurs[indx].prenom;
              var id = t;
              var fichier = dbjoueurs[indx].fichier+'.jpg';
              var age = dbjoueurs[indx].age;
              var sel = dbjoueurs[indx].select;
              var seltxt =  parseInt(sel) > 1 ? 'sélections' : 'sélection';
              //ret +='<li><span class="rounded"><img src="_footballeurs/'+fichier+'"/></span><p class="texte2"><span class="nom">'+nom+' '+prenom+'</span><br/><span class="age">'+age+' ans | '+sel+' '+seltxt+'</span></p></li>';
              ret +='<li><span class="rounded2"><img src="_footballeurs/'+fichier+'"/></span><p class="texte2"><span class="nom">'+nom+'</span></p></li>';
            }
            return ret;
        }


        function setMaxArrays(){
          _mldf = _formation == 4132 ? 1 : 2;                           // max array milieux defensifs
          _mloff = _formation == 4132 ? 3 :(_formation == 433 ? 1 :2);  // max array milieux offensifs
          _at = _formation == 433 ? 3 : 2;                              // max attaquants

          switch(_formation){
            case 442:
            $('#nbmild1').empty().append(2);
            $('#nbmild2').empty().append(2);
            $('#nbmilo1').empty().append(2);
            $('#nbmilo2').empty().append(2);
            $('#nbatt1').empty().append(2);
            $('#nbatt2').empty().append(2);
            $('#textd1').empty().append('milieux défensifs');
            $('#texto1').empty().append('milieux offensifs');
            break;
            case 4132:
            $('#nbmild1').empty().append(1);
            $('#nbmild2').empty().append(1);
            $('#nbmilo1').empty().append(3);
            $('#nbmilo2').empty().append(3);
            $('#nbatt1').empty().append(2);
            $('#nbatt2').empty().append(2);
            $('#textd1').empty().append('milieu défensif');
            $('#texto1').empty().append('milieux offensifs');
            break;
            case 433:
            $('#nbmild1').empty().append(2);
            $('#nbmild2').empty().append(2);
            $('#nbmilo1').empty().append(1);
            $('#nbmilo2').empty().append(1);
            $('#nbatt1').empty().append(3);
            $('#nbatt2').empty().append(3);
            $('#textd1').empty().append('milieux défensifs');
            $('#texto1').empty().append('milieu offensif');
            break;
          }

        }


        function init_formation(){
          $('.formations li a').each(function(e){
            var _t=$(this);
            if(_t.hasClass('sformation')) _t.removeClass('sformation');

            if(_formation == _t.attr('href')) _t.addClass('sformation');

            _t.click(function(e){
              $('.formations li a').each(function(e){
                if($(this).hasClass('sformation')) $(this).removeClass('sformation');
              });
              _t.addClass('sformation');
              var f = _t.attr('href');
              if(f == _formation){
                return false;
              } else{
                  // changement formation reinit total;
                  _gardiens = new Array();
                  _defenseursc = new Array();
                  _defenseursl = new Array();
                  _milieuxd = new Array();
                  _milieuxo = new Array();
                  _attaquants = new Array();

                  $('#internaut23').empty();
                  $('#team23').empty();
                  $('#dreamteam').empty();
                  $('#ton23').empty();
                  $('#taformation').empty();
                  $('#validliste').empty();
                  $('#attaquants').empty();
                  $('#milieuxo').empty();
                  $('#milieuxd').empty();
                  $('#defenseursl').empty();
                  $('#defenseursc').empty();
                  $('#gardiens').empty();

                  for (var i=2;i<=12;i++){
                    var scr = $('#screen'+i);
                    if(!scr.hasClass('inactif')) scr.addClass('inactif');
                  }

                  for (var ii=1;ii<=6;ii++){
                      $('#decompte'+ii).empty().append(0);
                  }

                  switch(f){
                    case '442':
                    _formation = 442;
                    $('#nbmild1').empty().append(2);
                    $('#nbmild2').empty().append(2);
                    $('#nbmilo1').empty().append(2);
                    $('#nbmilo2').empty().append(2);
                    $('#nbatt1').empty().append(2);
                    $('#nbatt2').empty().append(2);
                    $('#textd1').empty().append('milieux défensifs');
                    $('#texto1').empty().append('milieux offensifs');
                    break;
                    case '4132':
                    _formation = 4132;
                    $('#nbmild1').empty().append(1);
                    $('#nbmild2').empty().append(1);
                    $('#nbmilo1').empty().append(3);
                    $('#nbmilo2').empty().append(3);
                    $('#nbatt1').empty().append(2);
                    $('#nbatt2').empty().append(2);
                    $('#textd1').empty().append('milieu défensif');
                    $('#texto1').empty().append('milieux offensifs');
                    break;
                    case '433':
                    _formation = 433;
                    $('#nbmild1').empty().append(2);
                    $('#nbmild2').empty().append(2);
                    $('#nbmilo1').empty().append(1);
                    $('#nbmilo2').empty().append(1);
                    $('#nbatt1').empty().append(3);
                    $('#nbatt2').empty().append(3);
                    $('#textd1').empty().append('milieux défensifs');
                    $('#texto1').empty().append('milieu offensif');
                    break;
                  }

                  if(_formation !=0){
                    setMaxArrays();
                    if($('#cont_formations').hasClass('disabled')) $('#cont_formations').removeClass('disabled');
                    //renewhref('#cont_formations');
                  }

                  setcookie(false,0);
              }
                                           // max array attaquants
              return false;
            })
          })
          renewhref('#cont_formations');
        }


        jQuery(document).ready(function($){

          init_formation();

          $('.champ').focusin(function(){
            $(this).val('');
          })

          $('.champ').focusout(function(){
            switch ($(this).attr('id')) {
              case 'nom':
                if($(this).val() == '') $(this).val('Votre nom*')
                break;
              case 'prenom':
                if($(this).val() == '') $(this).val('Votre prénom*')
                break;
              case 'email':
                if($(this).val() == '') $(this).val('Votre email*')
                break;
            }
          })

          // chargement json footballeurs ----------------------------------------------------------------------------
          $.ajax({
            url: '_inc/db23_11.json',
            type: 'get',
            dataType:'json',
            success: function( res ) {
                dbjoueurs = res;
                $.ajax({
                  url: '_inc/dbdt11.json',
                  type: 'get',
                  dataType:'json',
                  success: function( res ) {
                      dbteam = res;
                      fromCookie();
                    },
                    error:function(res){
                      console.log('error');
                    }
                });
              },
              error:function(res){
                console.log('error');
              }
          });



          $('#demarrer').click(function(e){
            //var id = $(this).attr('id');
            //switch(id){
              //case 'demarrer':
              //chargeEcran(1);
              $('#screen1').removeClass('inactif');
              init_formation();
              scrollPage(1);
              //break;
            //}
            return false;
          });



          function chekScroll(){

            var sb = $(window).scrollTop();
            var disp;

            // intro
            var sc0 = $('#screen0').offset().top;
            var ht0 = sc0+$('#screen0').height();
            if(sc0-sb <=190 && ht0-sb >0) checkBullet(0);

            // formation
            var sc1 = $('#screen1').offset().top;
            var ht1 = sc1+$('#screen1').height();
            disp = $('#screen1').hasClass('inactif');
            if(sc1-sb <=0 && ht1-sb >0 && !disp) checkBullet(1);

            // gardiens
            var sc2 = $('#screen2').offset().top;
            var ht2 = sc2+$('#screen2').height();
            disp = $('#screen2').hasClass('inactif');
            if(sc2-sb <=0 && ht2-sb >0 && !disp) checkBullet(2);

            // defenseurs centraux
            var sc3 = $('#screen3').offset().top;
            var ht3 = sc3+$('#screen3').height();
            disp = $('#screen3').hasClass('inactif');
            if(sc3-sb <=0 && ht3-sb >0 && !disp) checkBullet(3);

            // defenseurs lateraux
            var sc4 = $('#screen4').offset().top;
            var ht4 = sc4+$('#screen4').height();
            disp = $('#screen4').hasClass('inactif');
            if(sc4-sb <=0 && ht4-sb >0 && !disp) checkBullet(4);

            // milieux defensifs
            var sc5 = $('#screen5').offset().top;
            var ht5 = sc5+$('#screen5').height();
            disp = $('#screen5').hasClass('inactif');
            if(sc5-sb <=0 && ht5-sb >0 && !disp) checkBullet(5);

            // milieux offensifs
            var sc6 = $('#screen6').offset().top;
            var ht6 = sc6+$('#screen6').height();
            disp = $('#screen6').hasClass('inactif');
            if(sc6-sb <=0 && ht6-sb >0 && !disp) checkBullet(6);

            // attaquants
            var sc7 = $('#screen7').offset().top;
            var ht7 = sc7+$('#screen7').height();
            disp = $('#screen7').hasClass('inactif');
            if(sc7-sb <=0 && ht7-sb >0 && !disp) checkBullet(7);

          }

          $(window).scroll(function(e){
            chekScroll();
          })


          // ---------------------------------------------------------------------------------------------------------

          //resize();

          /*
          $(window).resize(function(){
            resize();
          });
          */

          function resize(){
            hh = 158; // hauteur header
            wh = $(window).height();
            whn = wh*-1;
            $('.screens').height(wh);
          };

          chargeEcran = function(sc){
            switch(sc){
              case 1:
              createliste('poste',1,'gardiens');
              break;
              case 2:
              createliste('poste',2,'defenseursc');
              break;
              case 3:
              createliste('poste',2,'defenseursl');
              break;
              case 4:
              createliste('poste',3,'milieuxd');
              break;
              case 5:
              createliste('poste',3,'milieuxo');
              break;
              case 6:
              createliste('poste',4,'attaquants');
              break;
            }
          };


          chargeSelect = function(){
            var elems = selectListe('listeselect');
            $('#ton23').empty().append(elems);
            var titref = '';
            var terrain = '';
            switch(_formation){
              case 442:
                titref = '<strong>4-4-2</strong><br/>en losange';
                terrain = '442.jpg';
              break;
              case 4132:
                titref = '<strong>4-4-2</strong><br/>à plat avec milieux récupérateurs';
                terrain = '4132.jpg';
              break;
              case 433:
                titref = '<strong>4-3-3</strong><br/>pointe basse';
                terrain = '433.jpg';
              break;
            }
            $('#taformation').empty().append('<div class="terrain"><h4>' + titref + '</h4>' + '<img src="_images/'+ terrain +'"/></div>');
            elems = '<div class="validpartag" ><a href="#" class="bouton valider" id="valider">Valider ma liste des 11</a></div>';
            $('#validliste').empty().append(elems);
            renewhref('#valider');
            scrollPage(8);
            //renewhref('#partager');
          }


            // recharge depuis cookies
            function fromCookie(){

              if(_formation == 442 || _formation == 4132 || _formation == 433){
                $('#screen1').removeClass('inactif');
                $('#cont_formations').removeClass('disabled');
              }

              if(_gardiens.length > 0){
                chargeEcran(1);
                $('#screen2').removeClass('inactif');
              }

              if(_defenseursc.length > 0){
                chargeEcran(2);
                $('#screen3').removeClass('inactif');
              }

              if(_defenseursl.length > 0){
                chargeEcran(3);
                $('#screen4').removeClass('inactif');
              }

              if(_milieuxd.length > 0){
                chargeEcran(4);
                $('#screen5').removeClass('inactif');
              }

              if(_milieuxo.length > 0){
                chargeEcran(5);
                $('#screen6').removeClass('inactif');
              }

              if(_attaquants.length > 0){
                chargeEcran(6);
                $('#screen7').removeClass('inactif');
              }

              if(_gardiens.length == _mg && _defenseursc.length == _dfc && _defenseursl.length == _dfl && _milieuxd.length == _mldf && _milieuxo.length == _mloff && _attaquants.length == _at){
                chargeSelect();
                $('#screen8').removeClass('inactif');
              }
            }


            $('.bull').click(function(e){
              var _t=$(this);
              switch (_t.attr('href')) {
                case '#0':
                  scrollPage(0);
                break;
                case '#1':
                  scrollPage(1);
                break;
                case '#2':
                  scrollPage(2);
                break;
                case '#3':
                  scrollPage(3);
                break;
                case '#4':
                  scrollPage(4);
                break;
                case '#5':
                  scrollPage(5);
                break;
                case '#6':
                  scrollPage(6);
                break;
                case '#7':
                  scrollPage(7);
                break;
              }
              return false;
          })

            chekScroll();

            $('#participer').click(function(e){
              if (request) request.abort();
              $('#erreur').empty();
              var datas = $('#profil').serialize();
              request=$.ajax({
                url: '_inc/saveprofil.php',
                data: datas, //capture.data,
                type: 'post',
                dataType:'json',
                success: function( res ) {
                  if(res){
                    for(var t in res){
                      switch (res[t]) {
                        case 'ok':
                          $('#erreur').empty().append('Merci de votre participation');
                          break;
                        case 'sql':
                          $('#erreur').empty().append('Une erreur est survenue. <br/>Merci de réessayer');
                        break;
                        case 'email':
                          $('#email').val('Votre email*');
                          break;
                          case 'emailr':
                          $('#email').val('');
                          $('#erreur').empty().append('Erreur dans l\'adresse mail ou adresse mail déjà présente');
                        break;
                        default:
                          $('#erreur').empty().append('Merci de renseigner tous les champs marqués d\'une étoile (*)');
                      }
                    }
                  }
                  request=null;
                },
                error:function(result){
                  console.log('error');
                  request=null;
                }
              })
              return false;
            })


        }); // document readyu



        function renewhref(id){
          $(id).unbind('click');
          $(id).click(function(e){
            var _t = $(this);

            if(_t.hasClass('gardiens')){
              var id = parseInt(_t.attr('href'));
              //console.log(findId(_gardiens,id));
              if(findId(_gardiens,id)==-1){
                if(_gardiens.length<_mg){
                  _gardiens.push(id);
                  _t.addClass('selectjoueur');
                  //setcookie(false,0);
                  if(_gardiens.length==_mg){
                    if($('#cont_gardiens').hasClass('disabled')) $('#cont_gardiens').removeClass('disabled');
                    //$('#screen3').removeClass('inactif');
                    //scrollPage(3);
                  }
                }
              }else{ //if (_t.hasClass('selectjoueur'))
                removeId(_gardiens,id);
                _t.removeClass('selectjoueur');
                if(!$('#cont_gardiens').hasClass('disabled')) $('#cont_gardiens').addClass('disabled');
                setcookie(false,0);
              }
              $('#decompte1').html(_gardiens.length);
            }


            if(_t.hasClass('defenseursc')){
              var id = parseInt(_t.attr('href'));
              if(findId(_defenseursc,id)==-1){
                if(_defenseursc.length < _dfc){
                  _defenseursc.push(id);
                  _t.addClass('selectjoueur');
                  // recherche dans _defenseursl
                  if(findId(_defenseursl,id) > -1){
                    removeId(_defenseursl,id);
                  }

                  if(_defenseursc.length == _dfc){

                    if($('#cont_defenseursc').hasClass('disabled')) $('#cont_defenseursc').removeClass('disabled');
                    //$('#screen4').removeClass('inactif');
                    //scrollPage(4);
                  }
                }
              }else{  //if (_t.hasClass('selectjoueur'))
                removeId(_defenseursc,id);
                if(!$('#cont_defenseursc').hasClass('disabled')) $('#cont_defenseursc').addClass('disabled');
                _t.removeClass('selectjoueur');
                setcookie(false,0);
              }
              $('#decompte2').html(_defenseursc.length);
              // reaffichage defenseursl
              createliste('poste',2,'defenseursl',false);
              $('#decompte3').html(_defenseursl.length);
            }

            if(_t.hasClass('defenseursl')){
              var id = parseInt(_t.attr('href'));
              if(findId(_defenseursl,id)==-1){
                if(_defenseursl.length<_dfl){
                  _defenseursl.push(id);
                  _t.addClass('selectjoueur');
                  //setcookie(false,0);
                  if(_defenseursl.length==_dfl){
                    if($('#cont_defenseursl').hasClass('disabled')) $('#cont_defenseursl').removeClass('disabled');
                    //$('#screen4').removeClass('inactif');
                    //scrollPage(4);
                  }
                }
              }else{  //if (_t.hasClass('selectjoueur'))
                removeId(_defenseursl,id);
                if(!$('#cont_defenseursl').hasClass('disabled')) $('#cont_defenseursl').addClass('disabled');
                _t.removeClass('selectjoueur');
                setcookie(false,0);
              }
              $('#decompte3').html(_defenseursl.length);
            }


            if(_t.hasClass('milieuxd')){
              var id = parseInt(_t.attr('href'));
              if(findId(_milieuxd,id)==-1){
                if(_milieuxd.length<_mldf){
                  _milieuxd.push(id);
                  _t.addClass('selectjoueur');

                  // recherche dans _defenseursl
                  if(findId(_milieuxo,id) > -1){
                    removeId(_milieuxo,id);
                  }
                  //setcookie(false,0);
                  if(_milieuxd.length==_mldf){
                    if($('#cont_milieuxd').hasClass('disabled')) $('#cont_milieuxd').removeClass('disabled');
                    //$('#screen5').removeClass('inactif');
                    //scrollPage(5);
                  }
                }
              }else{ //if (_t.hasClass('selectjoueur'))
                removeId(_milieuxd,id);
                if(!$('#cont_milieuxd').hasClass('disabled')) $('#cont_milieuxd').addClass('disabled');
                _t.removeClass('selectjoueur');
                setcookie(false,0);
              }
              $('#decompte4').html(_milieuxd.length);
              createliste('poste',3,'milieuxo',false);
              $('#decompte5').html(_milieuxo.length);
            }

            if(_t.hasClass('milieuxo')){
              var id = parseInt(_t.attr('href'));
              if(findId(_milieuxo,id)==-1){
                if(_milieuxo.length<_mloff){
                  _milieuxo.push(id);
                  _t.addClass('selectjoueur');
                  //setcookie(false,0);
                  if(_milieuxo.length==_mloff){
                    if($('#cont_milieuxo').hasClass('disabled')) $('#cont_milieuxo').removeClass('disabled');
                    //$('#screen5').removeClass('inactif');
                    //scrollPage(5);
                  }
                }
              }else{ //if (_t.hasClass('selectjoueur'))
                removeId(_milieuxo,id);
                if(!$('#cont_milieuxo').hasClass('disabled')) $('#cont_milieuxo').addClass('disabled');
                _t.removeClass('selectjoueur');
                setcookie(false,0);
              }
              $('#decompte5').html(_milieuxo.length);
            }


            if(_t.hasClass('attaquants')){
              var id = parseInt(_t.attr('href'));
              if(findId(_attaquants,id)==-1){
                if(_attaquants.length<_at){
                  _attaquants.push(id);
                  _t.addClass('selectjoueur');
                  //setcookie(false,0);
                  if(_attaquants.length==_at){
                    if($('#cont_attaquants').hasClass('disabled')) $('#cont_attaquants').removeClass('disabled');
                    //setcookie(chargeSelect,0);
                    //$('#screen6').removeClass('inactif');
                    //scrollPage(6);
                  }
                }
              }else{ // if (_t.hasClass('selectjoueur'))
                removeId(_attaquants,id);
                if(!$('#cont_attaquants').hasClass('disabled')) $('#cont_attaquants').addClass('disabled');
                _t.removeClass('selectjoueur');
                setcookie(false,0);
              }
              $('#decompte6').html(_attaquants.length);
            }

            if(_t.hasClass('valider')){
              if(_gardiens.length == _mg && _defenseursc.length == _dfc && _defenseursl.length == _dfl && _milieuxd.length == _mldf && _milieuxo.length == _mloff && _attaquants.length == _at){
                if(request) request.abort();
                request=$.ajax({
                  url: '_inc/valide_selection.php',
                  data: {'token': '<?php echo $token?>','formation':_formation,'gard':_gardiens,'defcent':_defenseursc,'deflat':_defenseursl,'mildef':_milieuxd,'miloff':_milieuxo,'attaq':_attaquants}, //capture.data,
                  type: 'post',
                  dataType:'json',
                  success: function( res ) {
                    //if(callback) callback(sc);
                    var percent = 0;
                    var nom = '';
                    if(typeof res == 'object'){
                      var prop = 'nom';
                      if(prop in res){
                        nom = res['nom'];
                        var prop2 = 'rank';
                        if(prop2 in res){
                          var rank = '';
                          var nb = -1;

                          try{
                            rank = res.rank;
                          }finally{
                            if(typeof rank == 'object'){
                              for(var r in rank){
                                  if(nb==-1) nb = rank[r];
                              }
                              percent = Math.round((parseInt(nb)*100)/11);
                            }
                          }
                        }
                      }
                      var idjoueur = 0;
                      var prop = 'idjoueur';
                      if(prop in res){
                        idjoueur = res['idjoueur'];
                        _idjoueur = idjoueur;
                      }

                      var tokens = 0;
                      var prop = 'tokenshare';
                      if(prop in res){
                        tokens = res['tokenshare'];
                        _tokens = tokens;
                      }

                      var iddt = 0
                      var prop = 'iddt';
                      if(prop in res){
                        iddt = res[prop];
                      }
                      var fichier = '';
                      if(iddt != 0){
                          if(iddt in dbteam) fichier = dbteam[iddt].fichier+'.jpg';
                      }
                    }

                    var titref = '';
                    switch (_formation) {
                      case 442:
                        titref = '<strong>4-4-2</strong> en losange';
                        break;
                      case 433:
                        titref = '<strong>4-3-3</strong> pointe basse';
                        break;
                      case 4132:
                      titref = '<strong>4-4-2</strong> à plat avec milieux récupérateurs';
                        break;
                    }
                    var elems = '<h4>' + titref + '</h4>';
                    elems += selectListe('listeselect2');
                    $('#recap').empty().append(elems);
                    elems = '<div class="buttons">';
                    elems += '<a href="#" class="bouton partage facebook" id="facebook" data-idjoueur="'+idjoueur+'" data-tokens="'+tokens+'">Partager sur Facebook</a>';
                    elems += '<a href="https://twitter.com/intent/tweet/?text=Tentez%20de%20gagner%20une%20rencontre%20avec%20Raphaël%20Varane%20ou%20une%20enceinte%20JBL%20!%20Voici%20ma%20liste%20des%2023%20!&url=http://votre11bleu.bfmtv.com/liste/'+idjoueur+'/'+tokens+'" class="bouton partage twitter" id="twitter" data-idjoueur="'+idjoueur+'" data-tokens="'+tokens+'">Partager sur Twitter</a>';
                    //elems += '<a href="#" class="bouton partage twitter" id="twitter" data-idjoueur="'+idjoueur+'" data-tokens="'+tokens+'">Partager Twitter</a>';
                    elems += '</div>';
                    elems += '<div class="percent"><span class="chiffre">'+percent+'%</span> c\'est le pourcentage de ressemblance de votre sélection avec celle de <span class="rounded3"><img src="_dreamteam/'+fichier+'"/></span><span class="chiffre">'+nom+'</span></div>';
                    elems += '<div class="buttons">';
                    elems += '<a href="#" class="bouton dream23" id="dream23">Le&nbsp;11&nbsp;bleu&nbsp;de&nbsp;la&nbsp;Dream&nbsp;Team</a>';
                    elems += '<a href="#" class="bouton intern23" id="intern23">Le&nbsp;11&nbsp;bleu&nbsp;des&nbsp;internautes</a>';
                    elems += '<div class="loadingint nodisplay" id="loadingint">Chargement...</div>'
                    elems += '</div>';
                    $('#recap').append(elems);
                    $('#screen9').removeClass('inactif');

                    //renewhref('.twitter');
                    renewhref('.intern23');
                    renewhref('.dream23');
                    renewhref('.facebook');
                    //renewtwitt();
                    scrollPage(9);

                    request=null;
                  },
                  error:function(result){
                    console.log('error');
                    request=null;
                  }
                })
              }else{
                // retour sur ecran non rempli
                if(_gardiens.length<_mg) scrollPage(2);
                if(_defenseursc.length<_dfc) scrollPage(3);
                if(_defenseursl.length<_dfl) scrollPage(4);
                if(_milieuxd.length<_mldf) scrollPage(5);
                if(_milieuxo.length<_mloff) scrollPage(6);
                if(_attaquants.length<_at) scrollPage(7);
              }
            }

            if(_t.hasClass('dream23')){
              $('#internaut23').empty();
              if(!$('#screen10').hasClass('inactif')) $('#screen10').addClass('inactif');
              var elems = '<ul class="listedream" id="listedream">';
              for(var t in dbteam){
                  var fichier = dbteam[t].fichier+'.jpg';
                  var id = t;
                  var nom = dbteam[t].nom;
                  elems +='<li><a href="'+id+'" class="rounded selteam" data-teamid="'+id+'"><img src="_dreamteam/'+fichier+'"/></a><p class="texte"><span class="nom">'+nom+'</span</p></li>';
              }
              //elems +='<li><a href="#"></a></li>';
              elems += '</ul>';
              elems += '<div class="buttons">';
              elems += '<a href="#" class="bouton2 intern23" id="intern23c">Le&nbsp;11&nbsp;bleu&nbsp;des&nbsp;internautes</a>';
              elems += '<a href="http://rmcsport.bfmtv.com/" class="bouton2 rmcsport">Retour&nbsp;sur&nbsp;RMC&nbsp;Sport</a>'
              elems += '</div>';
              $('#dreamteam').empty().append(elems);
              //$.when($('#dreamteam').empty().append(elems)).then(renewhref('.selteam'));
              $('#screen10').removeClass('inactif');
              if(!$('#screen12').hasClass('inactif')) $('#screen12').addClass('inactif');
              renewhref('.selteam');
              renewhref('.intern23');
              scrollPage(10);
            }


            if(_t.hasClass('selteam')){
              if(!_t.hasClass('selecteam')){
                $('#listedream li a').each(function(e){
                  if($(this).hasClass('selecteam')) $(this).removeClass('selecteam');
                })

                _t.addClass('selecteam');
                var id = _t.attr('href');
                var data = dbteam[id];
                var elems = '<div class="schead"><img src="_images/logo_jbl.png" class="logo"/>';
                elems += '<h4><span class="titre">La liste des 11 de '+dbteam[id].nom+'</span><span class="rounded2"><img src="_dreamteam/'+dbteam[id].fichier+'.jpg"/></span></h4>';
                elems += '</div>';
                elems += '<div class="ltdt11">';
                elems += '<ul class="listeselectdt">';

                elems += '<li class="poste"><span>Gardiens</span>';
                elems += '<ul>';
                elems += makeListeteam(dbteam[id].selection[_formation], 'gardiens');
                elems += '</ul>';
                elems += '</li>';

                elems += '<li class="poste"><span>Défenseurs</span>';
                elems += '<ul>';
                elems += makeListeteam(dbteam[id].selection[_formation], 'defenseursc');
                elems += makeListeteam(dbteam[id].selection[_formation], 'defenseursl');
                elems += '</ul>';
                elems += '</li>';

                elems += '<li class="poste"><span>Milieux de terrain</span>';
                elems += '<ul>';
                elems += makeListeteam(dbteam[id].selection[_formation], 'milieuxd');
                elems += makeListeteam(dbteam[id].selection[_formation], 'milieuxo');
                elems += '</ul>';
                elems += '</li>';

                elems += '<li class="poste"><span>Attaquants</span>';
                elems += '<ul>';
                elems += makeListeteam(dbteam[id].selection[_formation], 'attaquants');
                elems += '</ul>';
                elems += '</li>';

                elems += '</ul>';
                elems += '</div>';
                elems += '<div class="taformation">';

                var titref = '';
                var terrain = '';
                switch(_formation){
                  case 442:
                    titref = '<strong>4-4-2</strong><br/>en losange';
                    terrain = '442.jpg';
                  break;
                  case 4132:
                    titref = '<strong>4-4-2</strong><br/>à plat avec milieux récupérateurs';
                    terrain = '4132.jpg';
                  break;
                  case 433:
                    titref = '<strong>4-3-3</strong><br/>pointe basse';
                    terrain = '433.jpg';
                  break;
                }
                elems += '<div class="terrain"><h4>' + titref + '</h4>' + '<img src="_images/'+ terrain +'"/></div>';

                elems += '</div>';
                elems += '<div class="buttons clearboth margtop">';
                elems += '<a href="#" class="bouton2 intern23" id="intern23b">Le&nbsp;11&nbsp;des&nbsp;internautes</a>';
                elems += '<a href="http://rmcsport.bfmtv.com/" class="bouton2 rmcsport">Retour&nbsp;sur&nbsp;RMC&nbsp;Sport</a>';
                elems += '</div>';

                $('#team23').empty().append(elems);
                $('#screen11').removeClass('inactif');
                renewhref('.intern23');
                scrollPage(11);
              }
            }

            if(_t.hasClass('intern23')){
              $('#loadingint').removeClass('nodisplay');
              $('#dreamteam').empty();
              $('#team23').empty();
              if(!$('#screen10').hasClass('inactif')) $('#screen10').addClass('inactif');
              if(!$('#screen11').hasClass('inactif')) $('#screen11').addClass('inactif');
              if(request) request.abort();
              request=$.ajax({
                url: '_inc/selection_internautes.php',
                data: {'token': '<?php echo $token?>','action':'internautes','formation':_formation}, //capture.data,
                type: 'post',
                dataType:'json',
                success: function( res ) {
                  //if(callback) callback(sc);
                  if(typeof res == 'object'){
                    var elems = '<ul class="listeinternautes">';

                    var totalgard = 0;
                    var prop = 'totalgard';
                    if(prop in res) totalgard = res.totalgard;

                    var totaldef = 0;
                    var prop = 'totaldef';
                    if(prop in res) totaldef = res.totaldef;

                    var totalmil = 0;
                    var prop = 'totalmil';
                    if(prop in res) totalmil = res.totalmil;

                    var totalatt = 0;
                    var prop = 'totalatt';
                    if(prop in res) totalatt = res.totalatt;

                    for(var t in res){
                      switch (t) {
                        case 'gardiens':
                          elems += '<li>Gardiens'+makeListeintern(res, 'gardiens', totalgard)+'</li>';
                          break;
                        case 'defenseursc':
                          elems += '<li>Défenseurs centraux'+makeListeintern(res, 'defenseursc', totaldef)+'</li>';
                          break;
                        case 'defenseursl':
                            elems += '<li>Défenseurs latéraux'+makeListeintern(res, 'defenseursl', totaldef)+'</li>';
                            break;
                        case 'milieuxd':
                          elems += '<li>Milieux défensifs'+makeListeintern(res, 'milieuxd', totalmil)+'</li>';
                          break;
                        case 'milieuxo':
                            elems += '<li>Milieux offensifs'+makeListeintern(res, 'milieuxo', totalmil)+'</li>';
                            break;
                        case 'attaquants':
                          elems += '<li>Attaquants'+makeListeintern(res, 'attaquants', totalatt)+'</li>';
                          break;
                      }
                    }
                    elems += '</ul>';
                    elems += '<div class="buttons">';
                    elems += '<a href="#" class="bouton2 dream23" id="intern23b">Les&nbsp;11&nbsp;bleu&nbsp;de&nbsp;la&nbsp;Dream&nbsp;Team</a>';
                    elems += '<a href="http://rmcsport.bfmtv.com/" class="bouton2 rmcsport">Retour&nbsp;sur&nbsp;RMC&nbsp;Sport</a>';
                    elems += '</div>';
                    $('#internaut23').empty().append(elems);
                    $('#screen12').removeClass('inactif');
                    if(!$('#loadingint').hasClass('nodisplay')) $('#loadingint').addClass('nodisplay');
                    renewhref('.dream23');
                    scrollPage(12);
                  }

                  request=null;
                },
                error:function(result){
                  console.log('error');
                  request=null;
                }
              })
            }


            if(_t.hasClass('facebook')){
              FB.ui({
                  method: 'feed',
                  name: 'Voici ma liste des 23 !',
                  link: 'http://votre11bleu.bfmtv.com/liste/'+_idjoueur+'/'+_tokens,
                  picture: 'http://votre11bleu.bfmtv.com/partage-ton-23-2.jpg',
                  description: 'A vous de sélectionner vos 23 pour tenter de gagner une rencontre avec Raphaël Varane à Madrid ou une enceinte JBL édition limitée !',
                  caption: 'Votre liste des 23'
              },function(d){
                  if(d!=null) {
                    //console.log('d : '+d);
                    if(request) request.abort();
                    request=jQuery.ajax({
                      url: '_inc/facebook.php',
                      data: {'token': '<?php echo $token?>','idjoueur':_idjoueur}, //capture.data,
                      type: 'post',
                      dataType:'json',
                      success: function( res ) {
                        console.log('ok facebook');
                        request=null;
                      },
                      error:function(result){
                        console.log('error facebook');
                        request=null;
                      }
                    })
                  }
              });
            }

            if(_t.hasClass('continuer')){
              var id = _t.attr('href');
              switch(id){

                case 'formations':
                  setcookie(chargeEcran,1);
                  $('#screen2').removeClass('inactif');
                break;

                case 'gardiens':
                  if (_gardiens.length == _mg){
                    //scrollPage(3);
                    setcookie(chargeEcran,2);
                    $('#screen3').removeClass('inactif');
                  }
                  break;
                case 'defenseursc':
                  if (_defenseursc.length == _dfc){
                   //scrollPage(4);
                   setcookie(chargeEcran,3);
                   $('#screen4').removeClass('inactif');
                  }
                  break;
                  case 'defenseursl':
                    if (_defenseursl.length == _dfl){
                     //scrollPage(4);
                     setcookie(chargeEcran,4);
                     $('#screen5').removeClass('inactif');
                    }
                    break;
                case 'milieuxd':
                  if (_milieuxd.length == _mldf){
                    //scrollPage(5);
                    setcookie(chargeEcran,5);
                    $('#screen6').removeClass('inactif');
                  }
                  break;
                case 'milieuxo':
                    if (_milieuxo.length == _mloff){
                      //scrollPage(5);
                      setcookie(chargeEcran,6);
                      $('#screen7').removeClass('inactif');
                    }
                    break;
                case 'attaquants':
                  if (_attaquants.length == _at){
                    //scrollPage(6);
                    setcookie(chargeSelect,0);
                    $('#screen8').removeClass('inactif');
                  }
                  break;
              }
            }


            if(_t.hasClass('twitter')){
              var width  = 575,
              height = 320,
              left   = ($(window).width()  - width)  / 2,
              top    = ($(window).height() - height) / 2,
              url    = 'https://twitter.com/intent/tweet/?text=Tentez%20de%20gagner%20une%20rencontre%20avec%20Raphaël%20Varane%20ou%20une%20enceinte%20JBL%20!%20Voici%20ma%20liste%20des%2023%20!&url=http://votre11bleu.bfmtv.com/liste/'+_idjoueur+'/'+_tokens,
              opts   = 'status=1' +
              ',width='  + width  +
              ',height=' + height +
              ',top='    + top    +
              ',left='   + left;
              window.open(url, 'twitter', opts);
            }
              return false;

          });
        }


        function makeListeteam(dt,poste){
          var elems = ''; //'<ul>';
            for(var t in dt[poste]){
              var id = dt[poste][t];
                if(id in dbjoueurs){
                  elems += '<li><span class="rounded2"><img src="_footballeurs/'+dbjoueurs[id].fichier+'.jpg" /></span><p class="texte"><span class="nom">'+dbjoueurs[id].nom+'</span</p></li>';
                }
            }
          //elems += '</ul>';
          return elems;
        }

        function makeListeintern(dt,poste,tot){
          var elems = '<ul>';
            for(var t in dt[poste]){
              var id = dt[poste][t][0];
              var cnt = dt[poste][t][1]; // nb selection
              var pcnt = Math.floor((cnt*100)/tot); // pourcentatge selection
                if(id in dbjoueurs){
                  //console.log(dbjoueurs[id].nom + ' / ' + cnt + ' / ' + pcnt);
                  elems += '<li><span class="percent"><span>'+pcnt+'%</span></span><span class="rounded2"><img src="_footballeurs/'+dbjoueurs[id].fichier+'.jpg" /></span><p class="texte"><span class="nom">'+dbjoueurs[id].nom+'</span</p></li>';
                }
            }
          elems += '</ul>';
          return elems;
        }

     // TWITTER ------------------------------------------------------------------------------------------------
      window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);
      t._e = [];
      t.ready = function(f) {
        t._e.push(f);
      };
      return t;
    }(document, "script", "twitter-wjs"));

         // On ready, register the callback...

         twttr.ready(function (twttr) {
           //console.log('twitter ready');
             twttr.events.bind('tweet', function (ev) {
                      if(request) request.abort();
                      request=jQuery.ajax({
                        url: '_inc/twitter.php',
                        data: {'token': '<?php echo $token?>','idjoueur':_idjoueur}, //capture.data,
                        type: 'post',
                        dataType:'json',
                        success: function( res ) {
                          //console.lo('ok twitter');
                          request=null;
                        },
                        error:function(result){
                          console.log('error twitter');
                          request=null;
                        }
                      })
             });
         });



        // indeOf ie<9 ---------------------------------------------------------------------------------------------------------------
        if (!Array.prototype.indexOf){
          Array.prototype.indexOf = function(searchElement /*, fromIndex */){
            "use strict";

            if (this === void 0 || this === null)
              throw new TypeError();

            var t = Object(this);
            var len = t.length >>> 0;
            if (len === 0)
              return -1;

            var n = 0;
            if (arguments.length > 0){
              n = Number(arguments[1]);
              if (n !== n) // shortcut for verifying if it's NaN
                n = 0;
              else if (n !== 0 && n !== (1 / 0) && n !== -(1 / 0))
                n = (n > 0 || -1) * Math.floor(Math.abs(n));
            }

            if (n >= len)
              return -1;

            var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);

            for (; k < len; k++){
              if (k in t && t[k] === searchElement)
                return k;
            }
            return -1;
          };
        }
        // -------------------------------------------------------------------------------------------------------------------------------


// })();



       //

      </script>
      <script type="text/javascript">

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iPhone: function() {
        return navigator.userAgent.match(/iPhone|iPod/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

var xtSiteXiti, xtn2xiti;

if (isMobile.any()) {
    // setting xtSiteXiti mobile
    xtSiteXiti = "552328";
            xtn2xiti = "";

        if (xtn2xiti == '') {
            xtn2xiti = "5";
        }

} else {
    // setting xtSiteXiti desktop
    xtSiteXiti = "548539";
            xtn2xiti = "5";
    }

// setting xtSiteXiti && xtn2xiti desktop to noscript



<!--

xtnv = document;                                                                                                         //parent.document or top.document or document
xtsd = "http://logc202";
xtsite = xtSiteXiti;
xtn2 = xtn2xiti;
xtpage = "rmcsport::liste-des-23";         //page name (with the use of :: to create chapters)
xtdi = "";                                                                                                                                                           //implication degree
xt_multc = "";                                                                                                                 //all the xi indicators (like "&x1=...&x2=....&x3=...")
xt_an = "";                                                                                                                                                       //user ID
xt_ac = "";                                                                                                                                                       //category ID

//do not modify below
if (window.xtparam!=null){window.xtparam+="&ac="+xt_ac+"&an="+xt_an+xt_multc;}
else{window.xtparam="&ac="+xt_ac+"&an="+xt_an+xt_multc;}

//-->

</script>

<script type="text/javascript" src="http://static.bfmtv.com/ressources/js/external/bfmtv/xtcore.js"></script>

<noscript>

<img width="1" height="1" alt="" src="http://logc202.xiti.com/hit.xiti?s=548539&s2=4&p=rmcsport::liste-des-23&di=&an=&ac=" />

</noscript>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    var virtualURL = '/liste-des-23/' + '##' + encodeURIComponent(document.location.pathname + document.location.search);
  ga('create', 'UA-51352716-1', 'bfmtv.com');
  ga('send', 'pageview', virtualURL);
</script>

</body>
</html>
