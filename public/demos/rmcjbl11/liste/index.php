<?php

  session_start();
  $tokenj = md5(rand(1000,9999)); //you can use any encryption
  //$uniqid = md5(uniqid(rand( ), true));
  $_SESSION['tokenj'] = $tokenj; //store it as session variable
  //error_reporting(E_ALL);
  //ini_set("display_errors", 1)

  require('../_inc/utilsggd.php');

  $id = 0;
  $tokens = '';

  if($_GET){
    if(isset($_GET['id'])) $id = protect($_GET['id']);
    if(isset($_GET['token'])) $tokens = protect($_GET['token']);
  }

  $root = '';

  if(preg_match("/smeserver9/",$_SERVER['SERVER_NAME']) || preg_match("/servermac/",$_SERVER['SERVER_NAME']) || preg_match("/192.168.1.30/",$_SERVER['SERVER_NAME']) ){
      $root = '/rmcjbl11';
  }
  $vers=$_SERVER['HTTP_USER_AGENT'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma liste des 11</title>
    <meta name="description" content="selectionnez vos 11 joueurs pour l'euro 2016" />
    <meta name="keywords" content="euro 2016" />
    <meta property="og:url" content="http://votre11bleu.bfmtv.com/liste/<?php echo $id?>/<?php echo $tokens?>" />
    <meta property="og:title" content="Sélectionnez vos 11 joueurs avec JBL" />
    <meta property="og:description" content="Comparez votre groupe à ceux de la Dream Team RMC Sport et aux choix des internautes !" />
    <meta property="og:image" content="http://votre11bleu.bfmtv.com/partage-ton-11-2.jpg" />
    <link rel="stylesheet" href="<?php echo $root ?>/_css/stylermc.css">
    <style>
      .partages{
        min-height: 500px;
      }
      .listeselect{
        margin-bottom: 5%;
      }
      .loading{
        font-size: 2em;
        text-align: center;
        display: block;
        height: 500px;
        line-height: 500px;
        vertical-align: middle;
        font-weight: 700;
        color: #bababa;
      }
      .buttons{
        margin-bottom: 2%;
      }
    </style>
</head>

<body>

  <div class="global" id="global">

  <div id="header">
    <iframe src="<?php echo $root ?>/header-footer/header.html" width="100%" height="158" frameborder="0" scrolling="no"></iframe>
  </div>

  <div id="screen2" class="screens">
    <div class="schead"><img src="<?php echo $root ?>/_images/logo_jbl.png" class="logo"/><h3 style="padding-left:0">Votre  11 bleu</h3></div>
    <div id="ton23" class="ton23 partages">
      <span class="loading" id="loading">Chargement du 11 bleu..</span>
    </div>
    <div id="taformation" class="taformation"></div>
    <div class="buttons clearboth"><a href="http://votre11bleu.bfmtv.com/" class="bouton">Créez votre 11 bleu</a></div>
  </div>

  <div id="footer">
    <iframe src="<?php echo $root ?>/header-footer/footer.html" width="100%" height="236" frameborder="0" scrolling="no"></iframe>
  </div>

</div>

</body>
<script src="//code.jquery.com/jquery-1.12.2.min.js"></script>
<script>

  jQuery(document).ready(function($){

    var dbjoueurs;
    var dbselect;

    var _id = <?php echo $id ?>;
    var _tokens = '<?php echo $tokens ?>';

    function findId(arr,id){
      return arr.indexOf(id);
    }


    function selectListe(){
        var elems = '<ul class="listeselect">';
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
        elems += createFromSelect('defenseursl');
        elems += '</ul>';
        elems += '</li>';
        elems += '<li class="poste"><span>Milieux de terrain</span></li>';
        elems += '<li>';
        elems += '<ul>';
        elems += createFromSelect('milieuxd');
        elems += createFromSelect('milieuxo');
        elems += '</ul>';
        elems += '<li class="poste"><span>Attaquants</span></li>';
        elems += '</li>';
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
            tab = dbselect.gardiens;
            break;
          case 'defenseursc':
            tab = dbselect.defenseursc;
            break;
          case 'defenseursl':
              tab = dbselect.defenseursl;
              break;
          case 'milieuxd':
            tab = dbselect.milieuxd;
            break;
            case 'milieuxo':
              tab = dbselect.milieuxo;
              break;
          case 'attaquants':
            tab = dbselect.attaquants;
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
          ret +='<li><span class="rounded2"><img src="<?php echo $root ?>/_footballeurs/'+fichier+'"/></span><p class="texte2"><span class="nom">'+nom+'</span></p></li>';
        }
        return ret;
    }

    $.ajax({
      url: '<?php echo $root ?>/_inc/db23_11.json',
      type: 'get',
      dataType:'json',
      success: function( res ) {
          dbjoueurs = res;
          datas = {token:'<?php echo $tokenj ?>',id:'<?php echo $id?>',tokens:'<?php echo $tokens ?>'};
          $.ajax({
            url: '<?php echo $root ?>/_inc/getpartage11.php',
            data : datas,
            type: 'post',
            dataType:'json',
            success: function( res ) {
              if(res){
                if($.isArray(res) && res.length == 0){
                  $('#loading').empty().append('Aucune sélection trouvée');
                }else{
                  if(typeof res == 'object'){
                    var prop = 'gardiens';
                    if(prop in res){
                      if(res.gardiens.length > 0){
                        dbselect = res;
                        var elems = selectListe();

                        var prop = 'formation';
                        if(prop in res){
                        var titref = '';
                        var terrain = '';

                        switch(res.formation){
                          case '442':
                            titref = '<strong>4-4-2</strong><br/>en losange';
                            terrain = '442.jpg';
                          break;
                          case '4132':
                            titref = '<strong>4-4-2</strong><br/>à plat avec milieux récupérateurs';
                            terrain = '4132.jpg';
                          break;
                          case '433':
                            titref = '<strong>4-3-3</strong><br/>pointe basse';
                            terrain = '433.jpg';
                          break;
                        }

                        $('#ton23').empty().append(elems);
                        $('#taformation').empty().append('<div class="terrain"><h4>' + titref + '</h4>' + '<img src="<?php echo $root ?>/_images/'+ terrain +'"/></div>');

                        $('#ton23').removeClass('partages');
                        }
                      }else{
                        $('#loading').empty().append('Aucune sélection trouvée');
                      }
                    }
                  }
                }
              }
              },
              error:function(res){
                console.log('error');
                //console.log(res);
              }
          });

        },
        error:function(res){
          console.log('error');
        }
    });

  })
</script>
</html>
