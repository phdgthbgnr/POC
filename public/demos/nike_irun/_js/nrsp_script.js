(function(){

    // ---------------------------------------------------------------------------------------------------------------------------------------------------------------

    var manageEvents = {
        myevents : new Array(),
        $dc: function (id){
            var elem = null;
            if (document.getElementById(id) !== null) elem = document.getElementById(id);
            if(elem == null) console.log('%cERREUR : id "' + id + '" introuvable','color:#ff1d00;font-weight:bold');
            return elem;
        },
        // c et t = current et total images chargées pour manageEventsImageLoader
        // e = event
        // trgt = target where the eventis applied
        // target = current target (where click is fired)
        // si capture == true : evenement est capture et n'est plus passé
        listen:function (e, trgt, callback, capture, c ,t){ // c et t = current et total images chargées pour manageEventsImageLoader
            e = e || window.event;
            if(capture){
                if(e.preventDefault){
                    e.preventDefault();
                    e.stopPropagation();
                }else{
                    e.returnValue = false;
                    e.cancelBubble = true;
                }
            }
            var target = e.target || e.srcElement;
            if (callback) callback(e, trgt, target, c, t);
        },
        listenerAdd: function(id, evt, callback, capture, c, t){
            var elem = id !== window && id !== document && id != '[object HTMLImageElement]' ? this.$dc(id) : id;
            try{
                elem.addEventListener = elem.addEventListener || function (e, f) { elem.attachEvent('on' + e, f); };
                //manageEvents.myevents._addEvt({id:id, evt:evt, event:callback});
                elem.addEventListener(evt, function _events(e){
                    manageEvents.myevents._addEvt({id:id, evt:evt, event:arguments.callee});
                    manageEvents.listen(e, this, callback, capture, c, t);
                },capture);
                elem.removeEventListener = elem.removeEventListener || function (e, f) { elem.detachEvent('on' + e, f); };
            }catch(e){
                console.log('%cERREUR : id "' + id + '" introuvable','color:#ff4e00;font-weight:bold');
                console.log(e);
                console.log('%c---------------------------','color:#ff4e00');
            }
           
        },
        listenerRemove: function (id, evt, cpt){
            var curEvt = this.myevents._remEvt({id:id, evt:evt});
            var elem = id !== window && id !== document ? this.$dc(id) : id;
            if (curEvt) {
                try{
                    if(cpt == true){
                        elem.removeEventListener(evt, curEvt, true);
                    }else{
                        elem.removeEventListener(evt, curEvt, false);
                    }
                    if(cpt === undefined) elem.removeEventListener(evt, curEvt);
                }catch(e){
                    console.log('%cERREUR : id "' + id + '" introuvable','color:#ff4e00');
                    console.log(e);
                    console.log('%c---------------------------','color:#ff4e00');
                }
            }
        },
        forceRemove: function(id, evt, func, cpt){
            var elem = id !== window && id !== document ? this.$dc(id) : id;
            try{
                if(cpt == true){
                    elem.removeEventListener(evt, func, true);
                }else{
                    elem.removeEventListener(evt, func, false);
                }
                if(cpt === undefined) elem.removeEventListener(evt, func);
            }catch(e){
                console.log('%cERREUR : id "' + id + '" introuvable','color:#ff4e00');
                console.log(e);
                console.log('%c---------------------------','color:#ff4e00');
            }
        },


        addAclass: function (id, classe){
            this.$dc(id).classList ?  this.$dc(id).classList.add(classe) :  this.$dc(id).className += ' '+classe;
        },
        removeAclass: function(id,classe){
           // if (typeof this.$dc(id).classList.remove === 'function'){
            if (this.$dc(id).classList){
                this.$dc(id).classList.remove(classe);
            }else{
                this.$dc(id).className =  this.$dc(id).className.replace(' ' + classe, '').replace(classe, '');
            }
        },
        hasAclass: function(id, cls) {
            var element =  this.$dc(id);
            return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
        }
    }
    
    
    if (!Array.prototype._addEvt){
        Array.prototype._addEvt = function(o){
            res = false;
            for(var t in this){
                if(this[t].id==o.id && this[t].evt==o.evt) res = true;
            }
            if(!res) this.push(o);
        }
    }
    
    
    if(!Array.prototype._remEvt){
        Array.prototype._remEvt = function(o){
            var res = false;
            var index = this._searchEvt(o);
            if(index != -1){
                var res = this[index];
                this.splice(index, 1);
            }
            if(typeof res === 'object'){
                return res.event;
            }else{
                return false;
            }
        }
    }
    
    
    if(!Array.prototype._searchEvt){
        Array.prototype._searchEvt = function(what, i) {
            i = i || 0;
            var L = this.length;
            while (i < L) {
                if(this[i].id === what.id && this[i].evt === what.evt) return i;
                ++i;
            }
            return -1;
        };
    }

    // ---------------------------------------------------------------------------------------------------------------------------------------------------------------


    // --------------------------------------------------------------------------------------------------------------------------
    // liens et rep à modifier
    var liensAchat = {'femme':{'pegasus':'#pegasusfemme','structure':'#structurefemme','free':'#freefemme'},
                      'homme':{'pegasus':'#pegasushomme','structure':'#structurehomme','free':'#freehomme'}},
    liensCollection = {'femme':{'soleil':'#soleilfemme','pluie':'#pluiefemme','nuit':'#nuitfemme','froid':'#froidfemme'},
                       'homme':{'soleil':'#soleilhomme','pluie':'#pluiehomme','nuit':'#nuithomme','froid':'#froidhomme'}},                    
    videoFolder = '_video/',
    imgFolder   = '_img/',
    // --------------------------------------------------------------------------------------------------------------------------
    genre = '',
    Me = manageEvents,
    typeVideo = 'video/mp4',
    videoElement,
    arrayVideo = [],
    speedSlide = 4000,
    carousel = Me.$dc('nrspcarousel'),
    carouselApparel = Me.$dc('slidapparel'),
    curslide = 0,
    totSlides = 0,
    anim = null,
    currentProduct = 'nrspcard1',
    // images thumbnails 3 products
    // hommes
    thumbh = ['nike-air-zoom-pegasus-34-shield-homme_lt.jpg','air-zoom-structure-21-shield-homme_lt.jpg','nike-free-rn-2017-shield-homme_lt.jpg'],
    // femmes
    thumbf = ['nike-air-zoom-pegasus-34-shield-femme_lt.jpg','air-zoom-structure-21-shield-femme_lt.jpg','nike-free-rn-2017-shield-femme_lt.jpg'],
    // images larges 3 products
    // hommes
    producth = ['nike-air-zoom-pegasus-34-shield-homme.jpg','air-zoom-structure-21-shield-homme.jpg','nike-free-rn-2017-shield-homme.jpg'],
    // femmes
    productf = ['nike-air-zoom-pegasus-34-shield-femme.jpg','air-zoom-structure-21-shield-femme.jpg','nike-free-rn-2017-shield-femme.jpg'],
    //images apparel
    //homme
    apparelh = ['respirabilite-homme.png','pluie-homme.png','visibilite-homme.png','chaleur-homme.png',],
    //femmes
    apparelf = ['respirabilite-femme.png','pluie-femme.png','visibilite-femme.png','chaleur-femme.png'],

    iconeclick = function(e, ct, t){
        return false;
    },
    mouseover1 = function(e, ct, t){
        // gestion clic
        if(e.type=='click'){
            Me.removeAclass('ispan1','current');
            Me.removeAclass('ispan2','current');
            Me.removeAclass('ispan3','current');
            Me.removeAclass('ispan4','current');
        }
        switch(ct.id){
            case 'icone1':
            Me.addAclass('nrspvid1','zindex');
            Me.removeAclass('nrspvid2','zindex');
            Me.removeAclass('nrspvid3','zindex');
            Me.removeAclass('nrspvid4','zindex');
            Me.$dc('nrspvid1').currentTime = 0;
            Me.$dc('nrspvid1').play();
            Me.$dc('nrspvid2').pause();
            Me.$dc('nrspvid3').pause();
            Me.$dc('nrspvid4').pause();
            if(e.type=='click') Me.addAclass('ispan1','current');
            break;
            case 'icone2':
            Me.addAclass('nrspvid2','zindex');
            Me.removeAclass('nrspvid1','zindex');
            Me.removeAclass('nrspvid3','zindex');
            Me.removeAclass('nrspvid4','zindex');
            Me.$dc('nrspvid2').currentTime = 0;
            Me.$dc('nrspvid2').play();
            Me.$dc('nrspvid1').pause();
            Me.$dc('nrspvid3').pause();
            Me.$dc('nrspvid4').pause();
            if(e.type=='click') Me.addAclass('ispan2','current');
            break;
            case 'icone3':
            Me.addAclass('nrspvid3','zindex');
            Me.removeAclass('nrspvid1','zindex');
            Me.removeAclass('nrspvid2','zindex');
            Me.removeAclass('nrspvid4','zindex');
            Me.$dc('nrspvid3').currentTime = 0;
            Me.$dc('nrspvid3').play();
            Me.$dc('nrspvid1').pause();
            Me.$dc('nrspvid2').pause();
            Me.$dc('nrspvid4').pause();
            if(e.type=='click') Me.addAclass('ispan3','current');
            break;
            case 'icone4':
            Me.addAclass('nrspvid4','zindex');
            Me.removeAclass('nrspvid1','zindex');
            Me.removeAclass('nrspvid2','zindex');
            Me.removeAclass('nrspvid3','zindex');
            Me.$dc('nrspvid4').currentTime = 0;
            Me.$dc('nrspvid4').play();
            Me.$dc('nrspvid1').pause();
            Me.$dc('nrspvid2').pause();
            Me.$dc('nrspvid3').pause();
            if(e.type=='click') Me.addAclass('ispan4','current');
            break;
        }
        if(!Me.hasAclass('nrspvid0','nodisplay')) Me.addAclass('nrspvid0','nodisplay');
        
    },
    mouseout1 = function(e, ct, t){
        videoElement.setAttribute('src', videoFolder+arrayVideo[0]);
    },
    bulletClick = function(e, ct, t){
        curslide = parseInt(e.target.hash.substr(1));
        setBullets(curslide);
        clearInterval(anim);
        if(typeof curslide === 'number') animSlider(carousel, (-1000*(curslide-1)));
        curslide--;
        sliderCarousel();
        return false;
    },
    deferImages = function(callback, dt){
        var totImgDefer = 0;
        var imgDefer = document.getElementsByTagName('img');
        var nbDefer = [];

        // dt == data-srcslide
        for (var i=0; i<imgDefer.length; i++) {
            if(imgDefer[i].getAttribute(dt)) {
                nbDefer.push(imgDefer[i]);
            }
        }
        for (var i=0; i<nbDefer.length; i++) {
            nbDefer[i].setAttribute('src',nbDefer[i].getAttribute(dt));
            if (nbDefer[i].addEventListener != undefined){
                nbDefer[i].addEventListener('load',function(e){
                    if(totImgDefer >= nbDefer.length-1) {
                        if(dt=='data-srcclide') totSlides = nbDefer.length;
                        callback();
                    }
                    totImgDefer++;
                    
                 });
            }else if (nbDefer[i].readyState){ // IE8
                nbDefer[i].onreadystatechange = function(){
                    if(nbDefer[i].readyState == 'loaded' || nbDefer[i].readyState == 'complete') {
                        if(totImgDefer >= nbDefer.length-1) {
                            if(dt=='data-srcclide') totSlides = nbDefer.length;
                            callback();
                        }
                        totImgDefer++;
                    }
                }
            }
        }    
    },
    setBullets = function(c){
        var bullet = Me.$dc('bullet');
        for (var i =0; i < bullet.children.length; i++ ){
            var id = bullet.children[i].children[0].getAttribute('id');
            if(Me.hasAclass(id,'current')) Me.removeAclass(id,'current');
        };
        //var cur = bullet.children[c].children[0].getAttribute('id');
        Me.addAclass('bullet'+c,'current');
    },
    sliderCarousel = function(){
        var bullet = Me.$dc('bullet');
        for (var i = 0; i<bullet.children.length; i++ ){
            var id = bullet.children[i].children[0].getAttribute('id');
            if(id){
                Me.listenerAdd(id,'click', bulletClick, true);
            }
        };

        // animation auto
        anim = setInterval(function(){
            var offsetx = -1000*curslide;
            curslide++;
            setBullets(curslide);
            animSlider(carousel,offsetx);
            if(curslide >= totSlides) curslide = 0; 
        },speedSlide);
    },
    animSlider = function(sl,of){
        sl.style.transform = 'translate(' + of + 'px, 0px)';
        sl.style.msTransform = 'translate(' + of + 'px, 0px)';
        sl.style.WebkitTransform = 'translate(' + of + 'px, 0px)';
    },
    carouselWeather = function(e, ct, t){
        var weather = e.target.hash.substr(1);
        var cid = e.target.getAttribute('id');
        if (Me.hasAclass(cid,'current')) return false;
        // remove cuurent class icones
        for(var i = 0; i < e.target.parentNode.parentNode.children.length; i++){
            var id = e.target.parentNode.parentNode.children[i].children[0].getAttribute('id');
            if (Me.hasAclass(id, 'current')) Me.removeAclass(id, 'current');
        }

        // remove opacity 1 silhouette
        for (var i = 0; i < carouselApparel.children.length; i++){
            var tagid = carouselApparel.children[i].getElementsByTagName('img')[0].getAttribute('id');
            if(Me.hasAclass(tagid,'disapparait')) Me.removeAclass(tagid,'disapparait');
        }

        // remove opacity 1 silhouette
        for (var i = 0; i < carouselApparel.children.length; i++){
            var tagid = carouselApparel.children[i].getElementsByTagName('img')[0].getAttribute('id');
            if(Me.hasAclass(tagid,'apparait')){
                Me.removeAclass(tagid,'apparait');
                Me.addAclass(tagid,'disapparait');
            }
        }

        // remove anim spec
        for (var i = 0; i < carouselApparel.children.length; i++){
            var specid = carouselApparel.children[i].getElementsByTagName('span')[0].getAttribute('id');
            if(Me.hasAclass(specid,'anim')) Me.removeAclass(specid,'anim');
        }

        // remove zindex
        for (var i = 0; i < carouselApparel.children.length; i++){
            var bid = carouselApparel.children[i].getAttribute('id');
            if (Me.hasAclass(bid, 'zindex')) Me.removeAclass(bid, 'zindex');
        }

        var idimg = '';
        switch(weather){
            case 'soleil':
            idimg = 'imgsoleil';
            idspec = 'specsoleil';
            idbloc = 'bsoleil'; 
            break;
            case 'pluie':
            idimg = 'imgpluie';
            idspec = 'specpluie'; 
            idbloc = 'bpluie'; 
            break;
            case 'nuit':
            idimg = 'imgnuit';
            idspec = 'specnuit'; 
            idbloc = 'bnuit'; 
            break;
            case 'froid':
            idspec = 'specfroid'; 
            idimg = 'imgfroid';
            idbloc = 'bfroid'; 
            break;
        }

        //animSlider(carouselApparel, x);
        Me.addAclass(weather, 'current');
        Me.addAclass(idimg,'apparait');
        Me.addAclass(idspec,'anim');
        Me.addAclass(idbloc,'zindex');

        return false;
    },
    showProduct = function(){
        Me.addAclass('nrspcenter','fullheight');
    },
    changeSpecApparel = function(genre){
        var a = null;
        var idh = '';
        var idf = '';
        for (var i = 1; i<=4; i++){
            idh ='apph'+i;
            idf ='appf'+i;
            if (genre == 'homme'){
                if(Me.hasAclass(idh,'nodisplay')) Me.removeAclass(idh,'nodisplay');
                if(!Me.hasAclass(idf,'nodisplay')) Me.addAclass(idf,'nodisplay');
            };
            if (genre == 'femme'){
                if(Me.hasAclass(idf,'nodisplay')) Me.removeAclass(idf,'nodisplay');
                if(!Me.hasAclass(idh,'nodisplay')) Me.addAclass(idh,'nodisplay');
            };
        }
        Me.$dc('specsoleil').getElementsByTagName('a')[0].setAttribute('href',liensCollection[genre]['soleil']);
        Me.$dc('specpluie').getElementsByTagName('a')[0].setAttribute('href',liensCollection[genre]['pluie']);
        Me.$dc('specnuit').getElementsByTagName('a')[0].setAttribute('href',liensCollection[genre]['nuit']);
        Me.$dc('specfroid').getElementsByTagName('a')[0].setAttribute('href',liensCollection[genre]['froid']);
    },
    openProduct = function(e,ct,t){
        var id = e.target.getAttribute('id');
        var arr1 = null;
        var arr2 = null;
        var apparel = null;
        switch(id){
            case 'nrsphomme':
            arr1 = thumbh;
            arr2 = producth;
            apparel = apparelh;
            if(!Me.hasAclass('nrsphomme','currentp')) Me.addAclass('nrsphomme','currentp');
            if(Me.hasAclass('nrspfemme','currentp')) Me.removeAclass('nrspfemme','currentp');
            genre = 'homme';
            break;
            case 'nrspfemme':
            arr1 = thumbf;
            arr2 = productf;
            apparel = apparelf;
            if(!Me.hasAclass('nrspfemme','currentp')) Me.addAclass('nrspfemme','currentp');
            if(Me.hasAclass('nrsphomme','currentp')) Me.removeAclass('nrsphomme','currentp');
            genre = 'femme';
            break;
        }

        changeSpecApparel(genre);

        Me.$dc('thumb1').setAttribute('data-product', imgFolder + arr1[0]);
        Me.$dc('thumb2').setAttribute('data-product', imgFolder + arr1[1]);
        Me.$dc('thumb3').setAttribute('data-product', imgFolder + arr1[2]);

        Me.$dc('product1').setAttribute('data-product', imgFolder + arr2[0]);
        Me.$dc('product2').setAttribute('data-product', imgFolder + arr2[1]);
        Me.$dc('product3').setAttribute('data-product', imgFolder + arr2[2]);
        
        Me.$dc('imgsoleil').setAttribute('data-product', imgFolder + apparel[0]);
        Me.$dc('imgpluie').setAttribute('data-product', imgFolder + apparel[1]);
        Me.$dc('imgnuit').setAttribute('data-product', imgFolder + apparel[2]);
        Me.$dc('imgfroid').setAttribute('data-product', imgFolder + apparel[3]);
        
        Me.$dc('buypegasus').setAttribute('href', liensAchat[genre]['pegasus']);
        Me.$dc('buystructure').setAttribute('href', liensAchat[genre]['structure']);
        Me.$dc('buyfree').setAttribute('href' ,liensAchat[genre]['free']);

        // premier produit selectionné (pegasus)
        currentProduct = 'nrspcard1';

        // change image spec product
        deferImages(showProduct,'data-product');
          
    },
    clickProduct = function(e,ct,t){
        var id = e.currentTarget.getAttribute('id');
        if (id == 'pegaus' && currentProduct == 'nrspcard1') return false;
        if (id == 'structure' && currentProduct == 'nrspcard2') return false;
        if (id == 'free' && currentProduct == 'nrspcard3') return false;
        Me.addAclass(id, 'noopacity');
        switch(id){
            case 'pegasus': // 1
            Me.addAclass('nrspproduct2','outofp');
            Me.addAclass('nrspspec2','outofs');

            Me.addAclass('nrspproduct3','outofp');
            Me.addAclass('nrspspec3','outofs');
            
            Me.removeAclass('nrspproduct1','outofp');
            Me.removeAclass('nrspspec1','outofs');
            
            if(Me.hasAclass('structure','noopacity')) Me.removeAclass('structure','noopacity');
            if(Me.hasAclass('free','noopacity')) Me.removeAclass('free','noopacity');

            Me.removeAclass('nrspcard2','zindex');
            Me.removeAclass('nrspcard3','zindex');
            
            currentProduct = 'nrspcard1';
            break;
            case 'structure': // 2
            Me.addAclass('nrspproduct1','outofp');
            Me.addAclass('nrspspec1','outofs');
            
            Me.addAclass('nrspproduct3','outofp');
            Me.addAclass('nrspspec3','outofs');
            
            Me.removeAclass('nrspproduct2','outofp');
            Me.removeAclass('nrspspec2','outofs');
            
            if(Me.hasAclass('pegasus','noopacity')) Me.removeAclass('pegasus','noopacity');
            if(Me.hasAclass('free','noopacity')) Me.removeAclass('free','noopacity');

            Me.removeAclass('nrspcard1','zindex');
            Me.removeAclass('nrspcard3','zindex');
            
            currentProduct = 'nrspcard2';
            break;
            case 'free': // 3
            Me.addAclass('nrspproduct1','outofp');
            Me.addAclass('nrspspec1','outofs');
            
            Me.addAclass('nrspproduct2','outofp');
            Me.addAclass('nrspspec2','outofs');
            
            Me.removeAclass('nrspproduct3','outofp');
            Me.removeAclass('nrspspec3','outofs');

            if(Me.hasAclass('pegasus','noopacity')) Me.removeAclass('pegasus','noopacity');
            if(Me.hasAclass('structure','noopacity')) Me.removeAclass('structure','noopacity');

            Me.removeAclass('nrspcard1','zindex');
            Me.removeAclass('nrspcard2','zindex');
            
            currentProduct = 'nrspcard3';
            break;
        }

        Me.addAclass(currentProduct,'zindex');

        return false;
    },
    videoLoaded = function(e,ct,t){
        // 4 icones header video
        Me.listenerAdd('icone1','mouseover', mouseover1, true);
        Me.listenerAdd('icone2','mouseover', mouseover1, true);
        Me.listenerAdd('icone3','mouseover', mouseover1, true);
        Me.listenerAdd('icone4','mouseover', mouseover1, true);
        Me.listenerAdd('icone1','click', mouseover1, true);
        Me.listenerAdd('icone2','click', mouseover1, true);
        Me.listenerAdd('icone3','click', mouseover1, true);
        Me.listenerAdd('icone4','click', mouseover1, true);
    },
    DomLoaded = function(e){

        videoElement = Me.$dc('nrspvid0');
        Me.listenerAdd('nrspvid2','loadeddata',videoLoaded, true);
        
        Me.listenerAdd('icone1','click', iconeclick, true);
        Me.listenerAdd('icone2','click', iconeclick, true);
        Me.listenerAdd('icone3','click', iconeclick, true)
        Me.listenerAdd('icone4','click', iconeclick, true)

        // 4 icones weather
        Me.listenerAdd('soleil', 'click', carouselWeather, true);
        Me.listenerAdd('pluie', 'click', carouselWeather, true);
        Me.listenerAdd('nuit', 'click', carouselWeather, true);
        Me.listenerAdd('froid', 'click', carouselWeather, true);
        

        // lien homme / femme
        Me.listenerAdd('nrsphomme', 'click', openProduct, true);
        Me.listenerAdd('nrspfemme', 'click', openProduct, true);

        // lien spec produits
        Me.listenerAdd('pegasus','click', clickProduct, true);
        Me.listenerAdd('structure','click', clickProduct, true);
        Me.listenerAdd('free','click', clickProduct, true);

        // charge images carousel footer
        deferImages(sliderCarousel,'data-srcclide');
    };


    if (window.addEventListener){
        window.addEventListener('DOMContentLoaded', function(){DomLoaded()});
    }else if (window.attachEvent){ // IE8
        window.attachEvent('onload', function() { DomLoaded(); });
    }else{
        window.onload = DomLoaded();
    }
    

})();