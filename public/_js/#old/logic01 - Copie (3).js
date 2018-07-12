!function(i,t,m){

    
    const _m = m;
    const _ieVers = i;
    const _isTouch = t;
    const _pathThumb = 'vignettes/300x300/';
    const _rootZoom = 'zooms/';
    const _content = _m.$dc('content');
    const _forscroll = _m.$dc('forscroll');
    const _header = _m.$dc('header');

    let  observer;

    let _currentParent = '';        // node parent a (div .thumb)
    let _currentNode = '';          // node  a
    let _currentTargetId = '';      // id a
    let _base = {};                 // objet JSON des élements
    let _indexdb = 0;               // index où commencer l'insertion des éléments de la base
    // let requestID;                  // id requestanimationframe
    let clickNotAllow = false;      // empeche de cliquer si anim zomm pas terminée
    let _vueliste = false;

    // let n = 0;

    // let sY, sby, sty, bY, bsY, ty, hh = 0;

    const requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

    const cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;


    window.addEventListener('startLogic', function(e){
        console.log('start 1');
        // grid = document.querySelector(".content");
        loadJSON(e.detail.payload);
        console.log(e.detail.payload);
    });



    const  loadJSON = function(j){
        let  datas = '';
        _m.promises.httpRequest(j, 'GET', datas, 9000, null, null).then(function(e){
            let resjson = JSON.parse(e);
            _base = resjson;
            createBurger();
            start();
        }).fail(function(error){
            if(error) console('erreur');
        }).progress(function(progress){
            // console.log(progress);
        }).fin(function(){  // finally don't work on ie8 (ES5)

        });
    };



    // clic sur une vignette ----------------------------------------------------------------------------------
    const displayInfo = function(e,c,t){
        if(clickNotAllow) return;

        clickNotAllow = true;

        if(_vueliste){

            if(_currentParent !== '' && _currentParent != e.currentTarget.parentNode ) {
                _m.removeAclass(_currentParent,'zoom');
                // let img = _currentNode.querySelector('.imgthumb');
                // _m.removeAclass(img,'blurry');
                _m.removeAclass(_currentParent.querySelector('.spanthumb'),'backwhite');
                _m.removeAclass(_currentParent.querySelector('.imgthumb'),'blurry');

                let zooms = _currentParent.querySelector('.carousel');
                if(zooms)_currentParent.removeChild(zooms);

                let progbar = _currentParent.querySelector('.progbar');
                let details = _currentParent.querySelector('.details');
                // console.log(progbar);
                if(progbar) details.removeChild(progbar);

                _m.removeAclass(_currentNode,'endzoom');

            }

            // _currentParent = e.currentTarget.parentNode;
            // _currentNode = e.currentTarget;

            // _m.addAclass(_currentParent,'zoom');
            
        }else{
            // let img;
            // let imgfake;
            if(_currentParent !== '' && _currentParent != e.currentTarget.parentNode ) {
                // cancelAnimationFrame(requestID);
                // requestID = null;
                _m.removeAclass(_currentParent,'zoom');
                // let img = _currentNode.querySelector('.imgthumb');
                // _m.removeAclass(img,'blurry');
                _m.removeAclass(_currentParent.querySelector('.spanthumb'),'backwhite');
                _m.removeAclass(_currentParent.querySelector('.imgthumb'),'blurry');
                // supprime l'ancien bloc texte
                let det = _currentParent.querySelector('.details');
                if (det)_currentParent.removeChild(det);
                
                let zooms = _currentParent.querySelector('.carousel');
                if(zooms)_currentParent.removeChild(zooms);
                _m.removeAclass(_currentNode,'endzoom');
            }
            
        }
            // imgfake = e.currentTarget.querySelector('.fake');
            // _m.addAclass(e.currentTarget,'opened');

            _currentParent = e.currentTarget.parentNode;
            _currentNode = e.currentTarget;

            _currentTargetId = e.currentTarget.getAttribute('id');

            let idbase = e.currentTarget.getAttribute('href').substring(1);
            // console.log('idbase ', _base.datas[idbase]);

            
            _m.addAclass(_currentParent,'zoom');

            setAnimZoom(idbase)

        // }

    };
    // --------------------------------------------------------------------------------------------------------


    const setAnimZoom = function(idbase){
        // FIN de l'animation ZOOM AVANT
        _m.listenerAnimAdd(_currentTargetId,'animationend', function(e,t){
            // vue en damier on insert tous le contenus du zoom
            if(!_vueliste){
                let fragment = new DocumentFragment();
                let div = document.createElement('div');
                div.classList.add('details');


                let progbar = document.createElement('div');
                _m.addAclass(progbar,'progbar');
                progbar.setAttribute('id','progbar');

                let bprogbar = document.createElement('div');
                _m.addAclass(bprogbar,'progssbar');
                bprogbar.setAttribute('id','progssbar');
                progbar.append(bprogbar);
                div.append(progbar);


                let h3 = document.createElement('h3');
                h3.append(_base.datas[idbase]['name']); 
                div.append(h3);

                let ul = document.createElement('ul');            
                
                let li = document.createElement('li');
                li.append(_base.datas[idbase]['text']);
                ul.append(li);

                li = document.createElement('li');
                let span = document.createElement('span');
                span.append('Type : ');
                li.append(span, _base.datas[idbase]['type']);
                ul.append(li);
                
                li = document.createElement('li');
                span = document.createElement('span');
                span.append('OP : ');
                li.append(span, _base.datas[idbase]['type_op']),
                ul.append(li);

                li = document.createElement('li');
                span = document.createElement('span');
                span.append('Tech : ');
                li.append(span, _base.datas[idbase]['techno'].join(' / '));
                ul.append(li);

                div.append(ul);

                fragment.append(div);

                _currentParent.append(fragment);
            }else{
                // vue en ligne on insère seulement la barre de progression
                let div = _currentParent.querySelector('.details');
                let progbar = document.createElement('div');
                _m.addAclass(progbar,'progbar');
                progbar.setAttribute('id','progbar');

                let bprogbar = document.createElement('div');
                _m.addAclass(bprogbar,'progssbar');
                bprogbar.setAttribute('id','progssbar');
                progbar.append(bprogbar);
                div.insertAdjacentElement('afterbegin',progbar);

            }
            // filter sur l'image
            _m.addAclass(_currentParent.querySelector('.spanthumb'),'backwhite');
            _m.addAclass(_currentParent.querySelector('.imgthumb'),'blurry');


            // Coordonnées pour centrage vertical -----------------------------------------------------------------------------
            let bound = _currentParent.getBoundingClientRect();
            let bY = bound.top;
            let bH = bound.height;
            // let hh = _content.getBoundingClientRect().height;
            let hh = _forscroll.getBoundingClientRect().height;
            // centrage
            let sby = Math.round((hh-bH)/2)+_header.getBoundingClientRect().height;

            // let sY = _content.scrollY === undefined ? _content.scrollTop : _content.scrollY;
            let sY = _forscroll.scrollY === undefined ? _forscroll.scrollTop : _forscroll.scrollY;
            // console.log('sY', sY)
            let bsY = Math.round(sY+bY);
            // -------------------------------------------------------------------------------------------------------------------

            _m.addAclass(_currentNode,'endzoom');
            
            _m.listenerRemove(_currentTargetId, 'animationend');
            // requestFrameAnimation + callback fin centrage
            scrollContentCenter(0, bsY, sY, sby, function(){
                clickNotAllow = false;
                console.log('callback scrollcontent');
                if(_base.datas[idbase]['images'].length > 0) {
                    // creation carousel image
                    fragment = new DocumentFragment();
                    div = document.createElement('div');
                    _m.addAclass(div,'carousel');
                    div.setAttribute('id', 'carousel');
                    ul = document.createElement('ul');
                    div.append(ul);
                    _currentParent.append(div);
                    _m.removeAclass('progbar','bardissolve');
                    // fin centtrage : chargement des images zooms + callback fin chargement de TOUS les zooms
                    console.log('chargement zoom');
                    loadZoom(0,idbase, ul, function(){
                        _m.addAclass('progbar','bardissolve');
                        console.log('fin chargement');
                        
                    });
                }else{
                    // console.log(idbase)
                    loadVideos(idbase);

                }
            });

            
    
        },true);
    };


    // toggle vue  liste  / damier
    const changeVue = function(e,c,t){
        _vueliste = !_vueliste;
        if(!_vueliste){
            let nodes = document.querySelectorAll('.details');
            nodes.forEach(function(el){
                // let garbage = el.parentNode.removeChild(el);
                el.parentNode.removeChild(el);
            });
        }
        if(_vueliste) {
            if(_currentParent){
                _currentParent.removeChild(_currentParent.querySelector('.details'));
                _currentParent.removeChild(_currentParent.querySelector('.carousel'));
                _m.removeAclass(_currentParent,'zoom');
                _m.removeAclass(_currentNode,'endzoom');
                let img = _currentNode.querySelector('.imgthumb');
                _m.removeAclass(img,'blurry');
                _currentParent = '';
                _currentNode = '';
            }
            
            populateListe();
        }
        _content.classList.toggle("imagetexte");
    };




    // créé element carousel avec une video --------------------------------------------------------------------
    const loadVideos = function(b){
        _m.addAclass('progbar','bardissolve');
        if(_base.datas[b]['videos'].length > 0) {

            let fragment = new DocumentFragment();
            let div = document.createElement('div');
            _m.addAclass(div,'carousel');
            div.setAttribute('id', 'carousel');
            let ul = document.createElement('ul');
            div.append(ul);
            _base.datas[b]['videos'].forEach(function(el,i,arr){
                let li = document.createElement('li');
                let w = el.split('_')[1].split('x')[0];
                let h = el.split('_')[1].split('x')[1];
                let videos = document.createElement('video');
                videos.setAttribute('playsinline','');
                videos.setAttribute('preload','auto');
                // videos.setAttribute('controls','controls');
                videos.setAttribute('width',w);
                videos.setAttribute('height',h);
                if(arr.length == 1) _m.addAclass(ul,'unique');

                let source = document.createElement('source');
                source.setAttribute('src',_rootZoom+_base.datas[b]['rep_images']+'/'+el+'.mp4');
                source.setAttribute('type','video/mp4');
                videos.append(source);

                source = document.createElement('source');
                source.setAttribute('src',_rootZoom+_base.datas[b]['rep_images']+'/'+el+'.webm');
                source.setAttribute('type','video/webm');
                videos.append(source);

                source = document.createElement('source');
                source.setAttribute('src',_rootZoom+_base.datas[b]['rep_images']+'/'+el+'.ogv');
                source.setAttribute('type','video/ogg');
                videos.append(source);
                li.append(videos)
                ul.append(li);
            });
            div.append(ul);
            fragment.append(div)

            _currentParent.append(fragment);

        }
    }
    // ---------------------------------------------------------------------------------------------------------




    // charge les images du carousel
    // appelé dans le callback de l'appel à scrollContentCenter
    // TODO mettre les blobs en cache ---------------------------------------------------------------------------
    // https://developers.google.com/web/fundamentals/instant-and-offline/web-storage/cache-api
    const loadZoom = function(i, idb, ul, callback){
        let datas = '' ;
        var idbase = idb;
        let cur_img = _rootZoom + _base.datas[idbase]['rep_images'] + '/' + _base.datas[idbase]['images'][i];
        _m.promises.httpRequest( cur_img, 'GET', datas, 30000, "text/plain", 'arraybuffer').then(function(e){
            i++
            let li = document.createElement('li'),
            img = document.createElement('img'),
            arrayBufferView = new Uint8Array(e.response),
            blob = new Blob([arrayBufferView], {'type': 'image\/jpeg'}),
            objectURL = window.URL.createObjectURL(blob);

            img.setAttribute('src', objectURL);
            li.append(img);
            ul.append(li);
            if(i < _base.datas[idbase]['images'].length){
                loadZoom(i,idbase, ul, callback);
            }else{
                callback(); // fin chargement de toutes les images <<<<<<<
            } 
               
        }).fail(function(error){
            console.log('error ', error);
            callback();
        }).progress(function(progress){
            // console.log('progress ', progress);
            moveProgressBar(i,_base.datas[idbase]['images'].length,progress)
        }).fin(function(){
        });
    }
    // ----------------------------------------------------------------------------------------------------------




    // barre de progression de chargement des images ------------------------------------------------------------
    const moveProgressBar = function(i, l, p){
        let w1 = 0
        try{
            let pb = _m.$dc('progbar');
            if(pb !== null) w1 = pb.getBoundingClientRect().width;
        }catch(e){
            console.error(e);
        }
        if(w1 > 0){
            let sl = (w1/l); // portion à remplir
            p = p < 1 ? p:0; // au démarrage du suivant p est à 1;
            let w2 = (sl*i)+(sl*p);
            _m.$dc('progssbar').style.width = w2+"px";
        }
    };
    // ----------------------------------------------------------------------------------------------------------




    // attend qu'une image soit chargée pour ajouter observer et [animate-grid : supprimé bug] ------------------
    // appelé au chargement de la vignette fake
    const firstImgLoad = function(e){
        _m.addAclass(e.currentTarget.parentNode,'loaded');
        observer.observe(e.currentTarget.parentNode.parentNode);
        e.currentTarget.removeEventListener('load', firstImgLoad, true);
    };
    // -----------------------------------------------------------------------------------------------------------
    



    // appelé au chargement de la vignette -----------------------------------------------------------------------
    // déclenche l'animation à la fin du chargement de l'image
    const imgThumbLoaded = function(e){
        _m.removeAclass(e.currentTarget.parentNode,'outofright');
        _m.addAclass(e.currentTarget.parentNode,'spanthumb');
        e.currentTarget.removeEventListener('load', imgThumbLoaded, true);
        // on supprime les anciennes images de placement
        let fake = e.currentTarget.parentNode.parentNode.querySelector('.fake');
        _m.addAclass(fake,'invisible');
    };
    //------------------------------------------------------------------------------------------------------------




    // clic sur menu et autres sans ref à la base ----------------------------------------------------------------
    const clickaHref = function(e,c,t){
        let ahref = e.currentTarget.getAttribute('href');
        switch(ahref){
            case '#vue':
            _vueliste = !_vueliste;
            if(!_vueliste){
                let nodes = document.querySelectorAll('.abstracts');
                nodes.forEach(function(el){
                    let garbage = el.parentNode.removeChild(el);
                });
            }
            if(_vueliste) populateListe();
            _content.classList.toggle("imagetexte");
            break;
        }
        return false;
    };
    // -----------------------------------------------------------------------------------------------------------




    // clic sur les items du burger -----------------------------------------------------------------------------
    const clickBurger = function(e,c,t){
        let ahref = e.currentTarget.getAttribute('href').substring(1);
        let re = new RegExp('^'+ahref+'$', 'g');
        // tout voir
        _base.datas.forEach(function(el,i,arr){
            if(ahref=='animation' && (el['videos'].length > 0 || el['banner'].length > 0)){
                _m.removeAclass('thumb-'+i,'nodisplay');
            }else if(ahref == 'demo' && el['link'] != '' && el['banner'].length == 0 && el['videos'].length == 0){
                _m.removeAclass('thumb-'+i,'nodisplay');
            }else if(el['type'].match(re)){
                _m.removeAclass('thumb-'+i,'nodisplay');
            }else if (ahref=='all'){
                _m.removeAclass('thumb-'+i,'nodisplay');
            }else{
                _m.addAclass('thumb-'+i,'nodisplay');
            }
            

        });
        _header.querySelectorAll('.itemburger').forEach(function(el,i,arr){
            if(el !== e.currentTarget) _m.removeAclass(el,'current');
        });
        _m.addAclass(e.currentTarget,'current');
        _m.$dc('titre').innerHTML = e.currentTarget.getAttribute('data-text');
        // _header.classList.toggle("headerheight");
    };
    // --------------------------------------------------------------------------------------------------------




    // cree GRID vignettes & observer -------------------------------------------------------------------------
    // event clic sur vignettes 
    const start = function(){
        console.log('start 2');
        // observer pour div thumb
        observer = new IntersectionObserver(function(observables){
            observables.forEach(function(observable){
                if(observable.intersectionRatio > .2){
                    let queryNode;
                    try{
                        queryNode = observable.target.querySelector('.imgtoload');
                        let imgtoload = queryNode.getAttribute('data-src');
                        queryNode.setAttribute('src',imgtoload);
                        _m.removeAclass(queryNode,'imgtoload');
                        queryNode.addEventListener('load',imgThumbLoaded,true);

                        let i = observable.target.getAttribute('id').substring(6);
                        if(_vueliste) populateItemListe(observable.target,i);
                    }catch(e){
                    }
                    // n++
                    // console.log(n);
                }
            })
        },{
            threshold: [.2]
        });

        // TODO ie 11 : createDocumentFragment
        // https://developer.mozilla.org/en-US/docs/Web/API/Document/createDocumentFragment
        let fragment = new DocumentFragment();

        _base.datas.forEach(function(el,i,arr){
            // div thumb
            var div = document.createElement('div');
            // div.classList.add('thumb');
            _m.addAclass(div,'thumb');
            div.setAttribute('id','thumb-'+i);
            
            // a
            var a = document.createElement('a');
            a.setAttribute('id','th'+i);
            a.setAttribute('href','#'+i);
            a.classList.add('athumb');

            // span avec l'image à charger
            var span = document.createElement('span');
            // console.log('i%3 ',i%3);
            span.classList.add('outofright');
            // if(i%3 == 0) span.classList.add('fromleft');
            // if(i%3 == 1) span.classList.add('fromcenter');
            // if(i%3 == 2) span.classList.add('fromright');
            var i2 = document.createElement('img');
            i2.setAttribute('data-src', _pathThumb + el['thumb']);
            i2.setAttribute('src', '_img/blk300x300.png');
            i2.setAttribute('alt', el['name']);
            i2.classList.add('imgtoload');
            i2.classList.add('imgthumb');
            span.append(i2);

            // img placeholder
            var i = document.createElement('img');
            i.setAttribute('src', '_img/blk300x300.png');
            i.addEventListener('load', firstImgLoad, true);
            i.classList.add('fake');
            // a.classList.add('imgtoload');
            // add node
            a.append(i);
            a.append(span);
            div.append(a);
            fragment.append(div);
        });
        content.append(fragment);

        _m.listenClass('athumb', 'click', displayInfo, true);
        // _m.listenerAdd('vues', 'click', clickaHref, true);
        _m.listenerAdd('vues', 'change', changeVue, true);

    };
    // -----------------------------------------------------------------------------------------------------------



    // cree BURGER MENU -------------------------------------------------------------------------------------------
    const createBurger = function(){
        let temp = [];
        _base.datas.forEach(function(el,i,arr){
            if(temp.indexOf(el['type']) == -1) temp.push(el['type']);
        });
        temp.sort();
        let ul = document.createElement('ul');
        _m.addAclass(ul,'itemsburger');
        ul.setAttribute('id','itemsburger');

        let fragment = new DocumentFragment();
        //voir tout
        let li = document.createElement('li');
        let a = document.createElement('a');
        a.setAttribute('href','#all');
        a.setAttribute('data-text','Tous les projets');
        _m.addAclass(a,'itemburger');
        a.append('Voir tout');
        li.append(a);
        fragment.append(li);
        
        // recuperation des criteres en base
        temp.forEach(function(el,i,arr){
            let li = document.createElement('li');
            let a = document.createElement('a');
            a.setAttribute('href', '#'+el);
            a.setAttribute('data-text', el);
            _m.addAclass(a,'itemburger');
            a.append(el);
            li.append(a);
            fragment.append(li);
        });

        // exemples avec animation
        li = document.createElement('li');
        a =  document.createElement('a');
        a.setAttribute('href','#animation');
        a.setAttribute('data-text','Animations');
        _m.addAclass(a,'itemburger');
        a.append('Animations');
        li.append(a);
        fragment.append(li);

        // exemples avec demos fonctionnelles
        li = document.createElement('li');
        a =  document.createElement('a');
        a.setAttribute('href','#demo');
        a.setAttribute('data-text','Démos');
        _m.addAclass(a,'itemburger');
        a.append('Démos');
        li.append(a);
        fragment.append(li);

        ul.append(fragment);

        _m.$dc('header').append(ul);

        _m.listenClass('itemburger', 'click', clickBurger, false);

    };


    // 
    // const  scrollContentTop = function(callback){
    //     let ny  = bsY-sY-sby;
    //     if(requestID !== null){
    //         ty = EasingFunctions.easeOutQuad(sty) * (ny);
    //         sty += 0.03;
    //         if (ny/ty < 1.01){
    //             cancelAnimationFrame(requestID);
    //         }else{
    //             // _currentNode.scrollTo(0, (ty+sY));
    //             // console.log(ny/ty);
    //             // console.log(ny);
    //             _content.scrollTop = (ty+sY);
    //             requestAnimationFrame(scrollContentTop);
    //         }
    //     }
    // };

    
    
    // requestAnimationFrame pour centrage vertical --------------------------------------------------------
    const  scrollContentCenter = function(sty, bsY, sY, sby, callback){
        let ny = bsY-sY-sby;
        if(ny == 0) ny = 0.1; // eviter boucle sans fin
        ty = EasingFunctions.easeOutQuad(sty) * (ny);
        sty += 0.035;
        if (ny/ty < 1.01){
            callback();
        }else{
            _forscroll.scrollTop = (ty+sY);
            requestAnimationFrame(function(){
                scrollContentCenter(sty, bsY, sY, sby, callback)
            });
        }
    };
    // -----------------------------------------------------------------------------------------------------
   

    const populateListe = function(){
        let nodes = document.querySelectorAll('.thumb');
        nodes.forEach(function(el,i,arr){
            let idbase = el.getAttribute('id').substring(6);
            let im = el.querySelector('img');
            // n'affiche les infos que pour les images chargées
            if(_m.hasAclass(im,'invisible')){
                populateItemListe(el,idbase);
            }
        });
    };

    const populateItemListe = function(node, i){
        let fragment = new DocumentFragment();

        let div = document.createElement('div');
        div.classList.add('details')
        let h3 = document.createElement('h3');
        h3.append(_base.datas[i]['name']); 
        div.append(h3)
        let ul = document.createElement('ul');            
    
        let li = document.createElement('li');
        li.append(_base.datas[i]['text']);
        ul.append(li)
        li = document.createElement('li');
        let span = document.createElement('span');
        span.append('Type : ');
        li.append(span, _base.datas[i]['type']);
        ul.append(li);
        
        li = document.createElement('li');
        span = document.createElement('span');
        span.append('OP : ');
        li.append(span, _base.datas[i]['type_op']),
        ul.append(li)
        li = document.createElement('li');
        span = document.createElement('span');
        span.append('Tech : ');
        li.append(span, _base.datas[i]['techno'].join(' / '));
        ul.append(li)
        div.append(ul)
        fragment.append(div)
        node.append(fragment);
    };
    // populateItemListe = function(i){

    // }

    // 
    // const  scrollContentCenter_old = function(){
    //     let ny  = bsY-sY-sby;
    //     if(requestID !== null){
    //         ty = EasingFunctions.easeOutQuad(sty) * (ny);
    //         sty += 0.03;
    //         if (ny/ty < 1.01){
    //             // endAnimFrame();
    //             cancelAnimationFrame(requestID);
    //         }else{
    //             // _currentNode.scrollTo(0, (ty+sY));
    //             // console.log(ny/ty);
    //             // console.log(ny);
    //             _content.scrollTop = (ty+sY);
    //             requestAnimationFrame(scrollContentTop);
    //         }
    //     }
    // };




    // easing for requestAnimationFrame  -------------------------------------------------------------------------------
    const EasingFunctions = {
        linear: function (t) {
            return t
        },
        easeInQuad: function (t) {
            return t * t
        },
        easeOutQuad: function (t) {
            return t * (2 - t)
        },
        easeInOutQuad: function (t) {
            return t < .5 ? 2 * t * t : -1 + (4 - 2 * t) * t
        },
        easeInCubic: function (t) {
            return t * t * t
        },
        easeOutCubic: function (t) {
            return (--t) * t * t + 1
        },
        easeInOutCubic: function (t) {
            return t < .5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1
        },
        easeInQuart: function (t) {
            return t * t * t * t
        },
        easeOutQuart: function (t) {
            return 1 - (--t) * t * t * t
        },
        easeInOutQuart: function (t) {
            return t < .5 ? 8 * t * t * t * t : 1 - 8 * (--t) * t * t * t
        },
        easeInQuint: function (t) {
            return t * t * t * t * t
        },
        easeOutQuint: function (t) {
            return 1 + (--t) * t * t * t * t
        },
        easeInOutQuint: function (t) {
            return t < .5 ? 16 * t * t * t * t * t : 1 + 16 * (--t) * t * t * t * t
        }
    };
    // ----------------------------------------------------------------------------------------------------------------



    //convert binary jpeg [pas utilisé ]-------------------------------------------------------------------------------
    const customBase64Encode = function (inputStr) {
        var
            bbLen               = 3,
            enCharLen           = 4,
            inpLen              = inputStr.length,
            inx                 = 0,
            jnx,
            keyStr              = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"
                                + "0123456789+/=",
            output              = "",
            paddingBytes        = 0;
        var
            bytebuffer          = new Array (bbLen),
            encodedCharIndexes  = new Array (enCharLen);
    
        while (inx < inpLen) {
            for (jnx = 0;  jnx < bbLen;  ++jnx) {
                /*--- Throw away high-order byte, as documented at:
                  https://developer.mozilla.org/En/Using_XMLHttpRequest#Handling_binary_data
                */
                if (inx < inpLen)
                    bytebuffer[jnx] = inputStr.charCodeAt (inx++) & 0xff;
                else
                    bytebuffer[jnx] = 0;
            }
    
            /*--- Get each encoded character, 6 bits at a time.
                index 0: first  6 bits
                index 1: second 6 bits
                            (2 least significant bits from inputStr byte 1
                             + 4 most significant bits from byte 2)
                index 2: third  6 bits
                            (4 least significant bits from inputStr byte 2
                             + 2 most significant bits from byte 3)
                index 3: forth  6 bits (6 least significant bits from inputStr byte 3)
            */
            encodedCharIndexes[0] = bytebuffer[0] >> 2;
            encodedCharIndexes[1] = ( (bytebuffer[0] & 0x3) << 4)   |  (bytebuffer[1] >> 4);
            encodedCharIndexes[2] = ( (bytebuffer[1] & 0x0f) << 2)  |  (bytebuffer[2] >> 6);
            encodedCharIndexes[3] = bytebuffer[2] & 0x3f;
    
            //--- Determine whether padding happened, and adjust accordingly.
            paddingBytes          = inx - (inpLen - 1);
            switch (paddingBytes) {
                case 1:
                    // Set last character to padding char
                    encodedCharIndexes[3] = 64;
                    break;
                case 2:
                    // Set last 2 characters to padding char
                    encodedCharIndexes[3] = 64;
                    encodedCharIndexes[2] = 64;
                    break;
                default:
                    break; // No padding - proceed
            }
    
            /*--- Now grab each appropriate character out of our keystring,
                based on our index array and append it to the output string.
            */
            for (jnx = 0;  jnx < enCharLen;  ++jnx)
                output += keyStr.charAt ( encodedCharIndexes[jnx] );
        }
        return output;
    }


}(_ieVers, _isTouch, manageEvents);