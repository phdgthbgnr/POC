<?php
  //header('Content-Security-Policy "frame-ancestors http://www.sofoot.com;"');
    $tokens = md5(rand(1000,9999));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOFOOT - NETFLIX</title>
    <link rel="stylesheet" href="_css/style.css">

    <style id="antiClickjack">body{display:none !important;}</style>
    <script type="text/javascript">
       if (self === top) {
           var antiClickjack = document.getElementById("antiClickjack");
           antiClickjack.parentNode.removeChild(antiClickjack);
       } else {
          if(location.host == 'www.sofoot.com' || location.host == 'sftntflx.entertainmentggd.com'){
            var antiClickjack = document.getElementById("antiClickjack");
            antiClickjack.parentNode.removeChild(antiClickjack);
          }
           //top.location  = self.location;
       }
    </script>
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-P4K749K');</script>
	<!-- End Google Tag Manager -->
</head>

<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4K749K"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
    <img src="_images/bg-fake.png" id="bgfake" />
    <div class="page" id="page1">
        <div class="bloctext">
            <div class="logo"><img src="_images/logo.png"/></div>
			<div class="heroes"><img src="_images/heroes.png"/></div>
            <div class="comp"><img src="_images/compose.png"/></div>
            <div class="mention"><img src="_images/texte.png"/></div>
            <a href="#start" class="start" id="start"><img src="_images/blk.png" id="ga-1-coup-envoi"/></a>
        </div>
    </div>
    
    
    <div class="page loading nodisplay" id="loading">
        <img src="_images/carre.png" class="fake"/>
        <div class="crane">
            <img src="_images/crane.png"/>
            <span id="percent">0 %</span>
        </div>
        
    </div>
    
    
    
    
    
    <div class="page novisible" id="page2">
        <img src="_images/carre.png" class="fake"/>
        <div class="titre"><img src="_images/choisis_gardien.png" id="titre01"/></div>
        <div class="carousel">
            <div id="ahref" class="slide owl-carousel">
				<?php
					for($i=1;$i<19;$i++){
						if($i<10)
						{
							echo '<div>';
							echo '	<a href="#pers0'.$i.'" id="pers0'.$i.'" class="p'.$i.'">';
							echo '		<img src="_images/slide/slide_0'.$i.'_off.png" class="retirer"/>';
							echo '		<img src="_images/slide/slide_0'.$i.'.png" class="ajouter" id="ga-2-perso-'.$i.'"/>';
							echo '	</a>';
							echo '</div>';
						}
						else
						{
							echo '<div>';
							echo '	<a href="#pers'.$i.'" id="pers'.$i.'" class="p'.$i.'">';
							echo '		<img src="_images/slide/slide_'.$i.'_off.png" class="retirer"/>';
							echo '		<img src="_images/slide/slide_'.$i.'.png" class="ajouter" id="ga-2-perso-'.$i.'"/>';
							echo '	</a>';
							echo '</div>';
						}
					}
				?>
            </div>
        </div>
        
        
        <div class="equipe">
            <img src="_images/equipe_blk.png"/>
            <div class="monequipe">
                <div class="titre"><img src="_images/monequipe.png"/></div>
                <ul>
                    <li><a href="#gardien"><span class="lay1 fullwhite" id="lgardien"></span><span class="lay2"><img src="_images/thumb_blk.png" id="gardien"/></span><img src="_images/thumb_blk.png"/></a></li>
                    <li><a href="#defenseur1"><span class="lay1" id="ldefenseur1"></span><span class="lay2"><img src="_images/thumb_blk.png" id="defenseur1"/></span><img src="_images/thumb_blk.png"/></a></li>
                    <li><a href="#defenseur2"><span class="lay1" id="ldefenseur2"></span><span class="lay2"><img src="_images/thumb_blk.png" id="defenseur2"/></span><img src="_images/thumb_blk.png"/></a></li>
                    <li><a href="#attaquant1"><span class="lay1" id="lattaquant1"></span><span class="lay2"><img src="_images/thumb_blk.png" id="attaquant1"/></span><img src="_images/thumb_blk.png"/></a></li>
                    <li><a href="#attaquant2"><span class="lay1" id="lattaquant2"></span><span class="lay2"><img src="_images/thumb_blk.png" id="attaquant2"/></span><img src="_images/thumb_blk.png"/></a></li>
                </ul>
                <ul class="labels">
                    <li><a href="#gardien"><span class="lay2 bordure fullborder" id="llagardien"><span class="texte">G</span></span><img src="_images/label_blk.png"/></a></li>
                    <li><a href="#defenseur1"><span class="lay2 bordure noright" id="lladefenseur1"><span class="texte">D</span></span><img src="_images/label_blk.png"/></a></li>
                    <li class="noleft"><a href="#defenseur2"><span class="lay2 bordure padright" id="lladefenseur2"><span class="texte">D</span></span><img src="_images/label_blk.png"/></a></li>
                    <li><a href="#attaquant1"><span class="lay2 bordure noright" id="llaattaquant1"><span class="texte">A</span></span><img src="_images/label_blk.png"/></a></li>
                    <li class="noleft"><a href="#attaquant2"><span class="lay2 bordure padright" id="llaattaquant2"><span class="texte">A</span></span><img src="_images/label_blk.png"/></a></li>
                    <!--
                    <li><a href="#gardien"><span class="lay2 bordure fullborder"><span class="texte">G</span></span><img src="_images/label_blk.png"/></a></li>
                    <li><a href="#defenseur1"><span class="lay2 bordure noright"><span class="texte">D</span></span><img src="_images/label_blk.png"/></a></li>
                    <li class="noleft"><a href="#defenseur2"><span class="lay2 bordure padright"><span class="texte">D</span></span><img src="_images/label_blk.png"/></a></li>
                    <li><a href="#attaquant1"><span class="lay2 bordure noright"><span class="texte">A</span></span><img src="_images/label_blk.png"/></a></li>
                    <li class="noleft"><a href="#attaquant2"><span class="lay2 bordure padright"><span class="texte">A</span></span><img src="_images/label_blk.png"/></a></li>-->
                </ul>
            </div>
            
        </div>
        
        <a href="#valider1" class="valider novisible" id="valider01"><img src="_images/valider_blk.png" id="ga-2-valider"/></a>
        
    </div>
    
    
    
    
    
    
    
    
    <div class="page novisible" id="page3">
        
        <img src="_images/carre.png" class="fake"/>
        
        <div class="titre"><img src="_images/choisis_capitaine.png" id="titre01"/></div>
        <div class="equipe capitaine">
            <img src="_images/capitaine_blk.png"/>
            <div class="monequipe capit">
				
				<div class="strat" id="strat-gardien">
					<ul class="etoiles">
						<li id="stgardien"><img src="_images/etoiles_blk.png"/></li>
					</ul>
					<ul>
						<li><a href="#gardien" id="cptgardien"><span class="lay1 fullwhite fullred" id="cgardien"></span><span class="lay2"><img src="_images/thumb_blk.png" id="cpgardien" class="ga-3-capitaine"/></span><img src="_images/thumb_blk.png"/></a></li>
					</ul>
					<ul class="labels">
						<li><a href="#gardien"><span class="lay2 bordure fullborder" id="lagardien"><span class="texte">G</span></span><img src="_images/label_blk.png"/></a></li>
					</ul>
				</div>
				
				<div class="strat" id="strat-defenseurs">
					<ul class="etoiles">
						<li id="stdefenseur1"><img src="_images/etoiles_blk.png"/></li>
						<li id="stdefenseur2"><img src="_images/etoiles_blk.png"/></li>
					</ul>
					<ul>
						<li><a href="#defenseur1" id="cptdefenseur1"><span class="lay1 fullwhite fullred" id="cdefenseur1"></span><span class="lay2"><img src="_images/thumb_blk.png" id="cpdefenseur1" class="ga-3-capitaine"/></span><img src="_images/thumb_blk.png"/></a></li>
						<li><a href="#defenseur2" id="cptdefenseur2"><span class="lay1 fullwhite fullred" id="cdefenseur2"></span><span class="lay2"><img src="_images/thumb_blk.png" id="cpdefenseur2" class="ga-3-capitaine"/></span><img src="_images/thumb_blk.png"/></a></li>
					</ul>
					<ul class="labels">
						<li><a href="#defenseur1"><span class="lay2 bordure fullborder noright" id="ladefenseur1"><span class="texte">D</span></span><img src="_images/label_blk.png"/></a></li>
						<li class="noleft"><a href="#defenseur2"><span class="lay2 bordure fullborder padright" id="ladefenseur2"><span class="texte">D</span></span><img src="_images/label_blk.png"/></a></li>
					</ul>
				</div>
				
				<div class="strat" id="strat-attaquants">
					<ul class="etoiles">
						<li id="stattaquant1"><img src="_images/etoiles_blk.png"/></li>
						<li id="stattaquant2"><img src="_images/etoiles_blk.png"/></li>
					</ul>
					<ul>
						<li><a href="#attaquant1" id="cptattaquant1"><span class="lay1 fullwhite fullred" id="cattaquant1"></span><span class="lay2"><img src="_images/thumb_blk.png" id="cpattaquant1" class="ga-3-capitaine"/></span><img src="_images/thumb_blk.png"/></a></li>
						<li><a href="#attaquant2" id="cptattaquant2"><span class="lay1 fullwhite fullred" id="cattaquant2"></span><span class="lay2"><img src="_images/thumb_blk.png" id="cpattaquant2" class="ga-3-capitaine"/></span><img src="_images/thumb_blk.png"/></a></li>
					</ul>
					<ul class="labels">
						<li><a href="#attaquant1"><span class="lay2 bordure fullborder noright" id="laattaquant1"><span class="texte">A</span></span><img src="_images/label_blk.png"/></a></li>
						<li class="noleft"><a href="#attaquant2"><span class="lay2 bordure fullborder padright" id="laattaquant2"><span class="texte">A</span></span><img src="_images/label_blk.png"/></a></li>
					</ul>
				</div>
				
				
            </div>
            
        </div>
        
        <a href="#valider2" class="valider novisible" id="valider02"><img src="_images/valider_blk.png" id="ga-3-valider"/></a>
    
    </div>
    
    
    
    
    
    
    
    <div class="page novisible" id="page4">
        
        <img src="_images/bgnd-f.jpg" class="fake" id="bgheight"/>
        
        <div class="titre"><img src="_images/ta_compo.png" id="titre01"/></div>
        
        <div class="joueur gard">
			<img src="_images/proto.png" id="fgardien"/>
			<img src="_images/proto.png" id="fgardien_desc" class="compo-desc"/>
		</div>
        
        <div class="joueur def1">
			<img src="_images/proto.png" id="fdefenseur1"/>
			<img src="_images/proto.png" id="fdefenseur1_desc" class="compo-desc"/>
		</div>
        <div class="joueur def2">
			<img src="_images/proto.png" id="fdefenseur2"/>
			<img src="_images/proto.png" id="fdefenseur2_desc" class="compo-desc"/>
		</div>
        
        <div class="joueur att1">
			<img src="_images/proto.png" id="fattaquant1"/>
			<img src="_images/proto.png" id="fattaquant1_desc" class="compo-desc"/>
		</div>
        <div class="joueur att2">
			<img src="_images/proto.png" id="fattaquant2"/>
			<img src="_images/proto.png" id="fattaquant2_desc" class="compo-desc"/>
		</div>
        
        
		<a href="#partagerfb" class="valider partagerfb novisible" id="partagerfb"><img src="_images/partage_blk.png" id="ga-4-partage-fb"/></a>
        <a href="#partagertwt" class="valider partagertwt novisible" id="partagertwt"><img src="_images/partage_blk.png" id="ga-4-partage-twt"/></a>
        
        <a href="#recommencer" class="valider recommencer" id="recommencer"><img src="_images/partager_blk.png" id="ga-4-recommencer"/></a>
        
        <a href="https://www.netflix.com/fr/" target="_blank" class="valider profite" id="profite"><img src="_images/valider_blk.png" id="ga-4-essai-gratuit"/></a>
        
        <a href="#dwnld" target="_blank" class="valider dwnld novisible" id="dwnld"><img src="_images/carre.png" id="ga-4-telechargement"/></a>
        
    </div>
    
    
    
    
    
    
    
    <script src="_js/jquery.min.js"></script>
	<script src="_js/owl.carousel.min.js"></script>
    <script src="_js/manageEventsfull.min.js"></script>

	<script>
	  window.fbAsyncInit = function() {
		FB.init({
		  appId      : '693046784197118',
		  xfbml      : true,
		  version    : 'v2.8'
		});
	  };

	  (function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
    
    <script>
    
        //closure
        (function(){
			
            var _mg = manageEvents,
            
            zones = ['gardien','defenseur1','defenseur2','attaquant1','attaquant2'],
            //curzone = 0,
            selects = {gardien:0,defenseur1:0,defenseur2:0,attaquant1:0,attaquant2:0},
            titres = {gardien:'_images/choisis_gardien.png',defenseur1:'_images/choisis_defenseurs.png',defenseur2:'_images/choisis_defenseurs.png',attaquant1:'_images/choisis_attaquants.png',attaquant2:'_images/choisis_attaquants.png'},
            capitaine = '',
                
            vignettes = ['_images/_vignettes/',
                         'vignette_01.png',
                         'vignette_02.png',
                         'vignette_03.png',
                         'vignette_04.png',
                         'vignette_05.png',
                         'vignette_06.png',
                         'vignette_07.png',
                         'vignette_08.png',
                         'vignette_09.png',
                         'vignette_10.png',
                         'vignette_11.png',
                         'vignette_12.png',
                         'vignette_13.png',
                         'vignette_14.png',
                         'vignette_15.png',
                         'vignette_16.png',
                         'vignette_17.png',
                         'vignette_18.png'],
            
            offset = 6.65,
            curoff = 0,
            imgload = 0,
            request = false,
            //urlfb = '',
            urlfic = '',
            imfic,
            
            $ID = function(id){
                var elem = null;
                if (document.getElementById(id) !== null) elem = document.getElementById(id);
                if(elem == null) console.log('%cERREUR : id "' + id + '" introuvable','color:#ff1d00;font-weight:bold');
                return elem;
            },

            addAclass = function (id, classe){
                $ID(id).classList ? $ID(id).classList.add(classe) : $ID(id).className += ' '+classe;
            },

            removeAclass = function(id,classe){
                $ID(id).className = $ID(id).className.replace(' ' + classe, '').replace(classe, '');
            },
                
            addNodeclass = function (n, classe){
                n.classList ? n.classList.add(classe) : n.className += ' '+classe;
            },

            removeNodeclass = function(n,classe){
                n.className = n.className.replace(' ' + classe, '').replace(classe, '');
            },

            hasAclass = function(id, cls) {
                var element = $ID(id);
                return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
            },

            //slides  = $ID('slide'),
            //nback   = $ID('fback'),
            //nfront  = $ID('ffront'),
            //ahref   = $ID('ahref'),
			//frise = $ID('frise'),
                
            testInArray = function(n){
                for (var t in selects){
                    if(selects[t] == n) return [t,n];
                }
                return 0;
            },
                
            testEmptyArray = function(n){
                for (var t in selects){
                    if(selects[t] == 0) {
                        var nn = '';
                        for (var i in zones){
                            var ii = parseInt(i)+1;
                            if(zones[i] == t && ii < zones.length) nn = zones[ii];
                            return [t,nn];
                        }
                        return [t,nn];
                    }
                }
                return 0;
            },
            
            clicf = function(e,t,ct){
                var dep = 0;
                //if(!hasAclass('slide','transit')) addAclass('slide','transit');
                switch(t.getAttribute('href')){
                    case '#next':
                        curoff++;
                        if(curoff > 17) curoff = 17;
                        break;
                    case '#prev':
                        curoff--;
                        if(curoff < 0) curoff = 0;
                        break;
                }
                
               
                //var m = curoff == 4 ? 2 : curoff;
               /* dep = -(offset*curoff); 
                dep = dep == -89 ? -77.875 : dep;
                slides.style.transform = 'translate(' + dep + '%, 0%)';
                slides.style.msTransform = 'translate(' + dep + '%, 0%)';
                slides.style.WebkitTransform = 'translate(' + dep + '%, 0%)';*/
            },
                
            reSize = function(e,t,ct){
                //removeAclass('slide','transit');
                //var wm = $ID('dims').offsetWidth;
                //slides.style.width = wm+'px';
				
                //nback.style.width = wm+'px';
                //nfront.style.width = wm+'px';
               // ahref.style.width = wm+'px';
			
				//frise.style.width = parseInt(document.body.clientWidth*9.5)+'px';
				//ahref.style.width =  parseInt(document.body.clientWidth*9.5)+'px';
				//ahref.style.paddingLeft  = parseInt(document.body.clientWidth/4)+'px';
				
				
				var wh = $ID('bgfake').clientHeight;
				$ID('page1').style.height = wh+'px';
				$ID('loading').style.height = wh+'px';
				$ID('page2').style.height = wh+'px';
				$ID('page3').style.height = wh+'px';
				$ID('page4').style.height = wh+'px';
            },
                
            rollover = function(e,t,ct){
                var id = t.getAttribute('id');
                var ind = parseInt(id.substr(-2));
                //console.log(id);
                
                // front
                var nodes = '';
               // if(ind%2 == 1) nodes = nfront;
                
                // back
               // if(ind%2 == 0) nodes = nback;
                
                var ii = Math.round(ind/2);
            
                
                if(nodes != ''){
                    switch(e.type){
                        case 'mouseover':                        
                            addNodeclass(nodes.children[ii-1],'rollv');
                            break;
                        case 'mouseout':
                            removeNodeclass(nodes.children[ii-1],'rollv');
                            break;
                    }
                }
            },
            
            clicp = function(e,t,ct){
                var id = t.getAttribute('id');
                var ind = parseInt(id.substr(-2));
    
                // front
				//nodes = nback;
                var ii = Math.round(ind/2);
                
                var d = testInArray(ind);
                var e = testEmptyArray();
                
                if ( d == 0 ){
                    
                    //if(curzone == 5) return false;
                    // tou plein
                    if(e == 0) return false;
                    
                    if(!hasAclass(id,'sp'+ind)) {
                        //addNodeclass(nodes.children[ii-1],'rolls');
                        addAclass(id,'sp'+ind);
                    }
                    //selects[zones[curzone]] = ind;
                    var z = e[0];
                    selects[z] = ind;
                    
                    //if(e[1] != '') addAclass(e[1],'fullwhite');
                    //$ID(zones[curzone]).src = vignettes[0]+vignettes[ind];
                    $ID(z).src = vignettes[0]+vignettes[ind];
                    $ID('cp'+z).src = vignettes[0]+vignettes[ind];
                    var zz = testEmptyArray();
                    
                    if(zz[0] != 0 && zz[0] !== undefined){
                        var iid = zz[0];
                        $ID('titre01').src = titres[iid];
                        addAclass('l'+iid,'fullwhite');
                        addAclass('lla'+iid,'fullborder');
                        if(!hasAclass('valider01','novisible')) addAclass('valider01','novisible');
                    }
                    
                    if(zz == 0 && hasAclass('valider01','novisible')) removeAclass('valider01','novisible');
                    //curzone++;
                    //curzone = curzone + 1 < 6 ? curzone + 1 : curzone
                    
                }else{
                    
                    $ID(d[0]).src = '_images/thumb_blk.png';
                    
                    if(hasAclass(id,'sp'+ind)) {
                        removeAclass(id,'sp'+ind);
                        //removeNodeclass(nodes.children[ii-1],'rolls');
                    }
                
                    
                    //curzone--;
                    //curzone = curzone - 1 >= 0 ? curzone-1 : curzone
                    //selects[zones[curzone]] = '';
                    selects[d[0]] = '';
                    var zz = testEmptyArray();
                    
                    if(zz[0] != 0 && zz[0] !== undefined){
                        var iid = zz[0];
                        $ID('titre01').src = titres[iid];
                        addAclass('l'+iid,'fullwhite');
                        if(!hasAclass('valider01','novisible')) addAclass('valider01','novisible');
                    }
                    if(zz == 0 && hasAclass('valider01','novisible')) removeAclass('valider01','novisible');
                    
                }
                return false;
            },
                
            imgloaded = function(e, t, ct, im, tot){
                imgload++;        
                //$ID('loading').style.width = Math.round((imgload/tot)*100)+'%';
                $ID('percent').innerHTML = Math.round((imgload/tot)*100)+'%';
                if(imgload >= tot) {
                  var mm = setTimeout(function(){
                      reSize();
                      //addAclass('loader','nodisplay');
                      removeAclass('page2','novisible');
                      addAclass('page1','nodisplay');
                      addAclass('loading','nodisplay');
                      clearTimeout(mm);
                  },1000);

                }

            },
                
            clic = function(e,t,ct){
                var h =t.getAttribute('href'); 
                switch(h){
                        
                    case '#start':
                        removeAclass('loading','nodisplay');
                        _mg.ImageLoader.listenerAdd('img','load', imgloaded, true);
						$.scrollTo('#bgfake',300);
                    break;
                    
                    case '#valider1':
                        addAclass('page2','nodisplay');
                        removeAclass('page3','novisible');
						$.scrollTo('#bgfake',300);
                    break;
                    
                    case '#valider2': 
                        // creation image partage
                        var datas = 'token=<?php echo $tokens ?>';
                        var suff;
                        //console.log(selects);
                        //console.log(capitaine);
                        for(var t in selects){
                            suff = '';
                            if(t == capitaine) suff = '_cpt';
                            var num =  selects[t];
                            var pref =  t == 'gardien' ? 'g_':(t == 'defenseur1' || t == 'defenseur2')?'d_':'a_';
                            if(num < 10 ) num = '0'+num;
                            if(datas != '') datas += '&';
                            var fic =  pref + num + suff + '.png';
							var ficdec =  pref + num + suff + '-desc.png';
                            datas += t + '=' + fic;
                            $ID('f'+t).src = '_images/stickers/'+fic;
                            $ID('f'+t+'_desc').src = '_images/stickers/'+ficdec;
                        }
                        
                        //console.log(datas);
                    
                        if (request == false){
                            request = true;
                            var url = '../_sharefb/im.php';
                            _mg.promises.httpRequest(url,'POST', datas, 10000).then(function(e){
                                try{
                                    var myjson = JSON.parse(e);
                                }catch(e){
                                    var myjson = '';
                                }
                                
								console.log(myjson);
								
                                if(typeof myjson === 'object'){
                                    
                                    if(myjson.hasOwnProperty('name')) {
                                        //console.log(myjson['name']);
                                        //urlfb = 'https://www.facebook.com/sharer/sharer.php?u=http://sftntflx.entertainmentggd.com/sharing/index.php?img=' + myjson['name'];
                                        imfic = myjson['name'];
                                        $ID('dwnld').setAttribute('href', '../sharing/dwnld.php?img=' + imfic);
                                        urlfic = 'http://sftntflx.entertainmentggd.com/sharing/images/' + imfic + '.jpg';
                                        removeAclass('partagerfb','novisible');
                                        removeAclass('partagertwt','novisible');
                                        removeAclass('dwnld','novisible');
                                    }else{
                                        // erreur 
                                    }
                                }
                                 manageEvents.promises.request = false;
                                 request = false;

                            }).fail(function(error){
                              //console.log(error);
                              //console('erreur');
                              request = false;
                            }).progress(function(progress){
                                //console.log(Math.round(progress*100) + ' %');
                            }).fin(function(){  // finally don't work on ie8 (ES5)
                              //console.log('fin');
                              request = false;
                            }); 
                        }
                           
                        addAclass('page3','nodisplay');
                        removeAclass('page4','novisible');
						
						$.scrollTo('#bgfake',300);
                    break;
                        
                    case '#partagerfb':
                        //console.log(urlfic);
                        FB.ui({
                              method: 'feed',
                              name: 'NETFLIX DREAMTEAM 5  - THE MOST BADASS',
                              link: 'http://www.sofoot.com/compose-ton-equipe-de-foot-a-5-436401.html',
                              picture: urlfic,
                              description: 'Compose ton équipe la plus badass !',
                              caption: 'SOFOOT.COM'
                          },function(d){
                              // nothing
                          });
                        /*
                        if(urlfb != ''){
                            var w = 600, h = 400,
                            t = window.innerHeight/2-h/2, l = window.innerWidth/2-w/2;
                            window.open(urlfb, 'facebook', 'width=600, height=400, top=' + t + ', left=' + l +  ' scrollbars=no');
                        }
                        */
                        return false;
                    break;
                        
					case '#partagertwt':
						var width  = 575,
						height = 320,
						left   = 300,
						top    = 200,
						text   = "J'ai%20crée%20ma%20team%20de%20foot%20à%205%20avec%20les%20persos%20des%20séries%20%23Netflix%20!%20Compose%20ton%20équipe",
						urlnflix ="http://www.sofoot.com/compose-ton-equipe-de-foot-a-5-436401.html",
						url    = 'https://twitter.com/intent/tweet/?text='+text+'&url='+urlnflix,
						opts   = 'status=1' +
						  ',width='  + width  +
						  ',height=' + height +
						  ',top='    + top    +
						  ',left='   + left;
						window.open(url, 'twitter', opts);
                        return false;
                    break;	
						
                    case '#recommencer':
                        document.location = 'index.php';
                    break;
                    
                    case '#profite':
                        
                    break;
                        
                    case '#dwnld':
                       // window.open('sharing/dwnld.php?img=' + imfic);
                        /*
                        var datas = 'img=' + imfic;
                        if (request == false){
                            request = true;
                            _mg.promises.httpRequest('sharing/dwnld.php','POST', datas, 10000).then(function(e){
                                request = false;
                            }).fail(function(error){
                              console.log(error);
                              console('erreur');
                              request = false;
                            }).progress(function(progress){
                            }).fin(function(){  // finally don't work on ie8 (ES5)
                              console.log('fin');
                              request = false;
                            }); 
                        }
                        */
                    break;
                        
                    // selection capitaine --------------------------------
                    case '#gardien':
                    case '#defenseur1':
                    case '#defenseur2':
                    case '#attaquant1':
                    case '#attaquant2':
                        capitaine = h.substring(1);
                        for(var i in selects){
                            removeAclass('st'+i,'rollov');
                            removeAclass('cpt'+i,'selectt');
                            removeAclass('la'+i,'fullbordered');
                        }
                        addAclass('st'+capitaine,'rollov');
                        addAclass('la'+capitaine,'fullbordered');
                        removeAclass('valider02','novisible');
                        //var ch = t.children[0];
                        addNodeclass(t,'selectt');
                        //console.log(ch);
                    break;
                    // ----------------------------------------------------
                }
            },
                
            overmouse = function(e,t,ct){
                var h =t.getAttribute('href').substring(1);
                if(e.type == 'mouseover'){
                    addAclass('st'+h,'rollov');
                    addAclass('la'+h,'fullbordered');
                }
                if(e.type == 'mouseout'){
                    if(capitaine != h) {
                        removeAclass('st'+h,'rollov');
                        removeAclass('la'+h,'fullbordered');
                    }
                }
            }
            
            
            _mg.listenerAdd(document,'DOMContentLoaded', function(e,t,ct){
                
                //console.log('DOMContentLoaded');
				
               // _mg.listenerAdd('next', 'click', clicf, true);
                //_mg.listenerAdd('prev', 'click', clicf, true);
				
				//_mg.listenerAdd('slide', 'click', clicf, true);
				
                _mg.listenerAdd(window, 'resize', reSize, true);
                
                _mg.listenerAdd('valider01', 'click', clic, true);
                _mg.listenerAdd('valider02', 'click', clic, true);
                _mg.listenerAdd('partagerfb', 'click', clic, true);
                _mg.listenerAdd('partagertwt', 'click', clic, true);
                _mg.listenerAdd('recommencer', 'click', clic, true);
                //_mg.listenerAdd('dwnld', 'click', clic, true);
                //_mg.listenerAdd('profite', 'click', clic, true);
				
                _mg.listenerAdd('start', 'click', clic, true);
                
                for (var t = 1; t < 19; t++){
                    var tt = t<10 ? '0'+t : t;
                    _mg.listenerAdd('pers'+ tt, 'mouseover', rollover, true);
                    _mg.listenerAdd('pers'+ tt, 'mouseout', rollover, true);
                    _mg.listenerAdd('pers'+ tt, 'click', clicp, true);
                }
                
                for (var t in selects){
                    //var i = zones[t];
                    // selection 1 pas de clic
                    _mg.listenerAdd(t,'click', function(){return false;}, true);
                    
                    // selection capitaine
                    _mg.listenerAdd('cpt'+t, 'click', clic, true);
                    _mg.listenerAdd('cpt'+t, 'mouseover', overmouse, true);
                    _mg.listenerAdd('cpt'+t, 'mouseout', overmouse, true);
                }
                
            })
			
			setTimeout(function(){
				var wh = $ID('bgfake').clientHeight;
				$ID('page1').style.height = wh+'px';
				$ID('loading').style.height = wh+'px';
				$ID('page2').style.height = wh+'px';
				$ID('page3').style.height = wh+'px';
				$ID('page4').style.height = wh+'px';
			},500);
        // end closure
        })();


		$(document).ready(function () {
			$("#ahref").owlCarousel({
				items:1,
				nav: false,
				lazyLoad: true
			});
		})
    </script>
</body>
</html>
