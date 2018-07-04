# POC
POC chargement et population DOM + mise en cache BLOB image (cape API) + Service Worker

````js
!function(i,t,m,mb,sm){

    
    const _m = m;
    const _mobile = mb;
    const _safarimobile = sm;
    const _ieVers = i;
    const _isTouch = t;
    const _pathThumb = _mobile ? 'vignettes/200x200/' : 'vignettes/320x320/';
    const _rootZoom = 'zooms/';
    const _content = _m.$dc('content');
    const _forscroll = _m.$dc('forscroll');
    const _header = _m.$dc('header');
    
    const cacheAvailable = 'caches' in self;

    let  observer;

    let _currentParent = '';        // node parent a (div .thumb)
    let _currentNode = '';          // node  a
    let _currentTargetId = '';      // id a
    let _base = {};                 // objet JSON des élements
    let _indexdb = 0;               // index où commencer l'insertion des éléments de la base
    // let requestID;                  // id requestanimationframe
    let clickNotAllow = false;      // empeche de cliquer si anim zomm pas terminée
    let _vueliste = false;
    let _timeoutsrcoll1 = null;     // timeout scroll bar carousel
    let _timeoutsrcoll2 = null;     // timeout scroll bar page (_forscroll)

    let _idToFire = null;      // simulation du click sur id a vignette (depuis submenu burger)




    // test support passive event handler ---------------------------------------------------------------------------
    let supportsPassive = false;
    try {
    let opts = Object.defineProperty({}, 'passive', {
        get: function() {
        supportsPassive = true;
        }
    });
    window.addEventListener("testPassive", null, opts);
    window.removeEventListener("testPassive", null, opts);
    } catch (e) {};
    // ---------------------------------------------------------------------------------------------------------------




    // TEST SUPPORT WEBP ----------------------------------------------------------------------------------------------
    const webpSupport = function() {
        let  elem = document.createElement('canvas');
        if (!!(elem.getContext && elem.getContext('2d'))) {
            return elem.toDataURL('image/webp').indexOf('data:image/webp') == 0;
        }
        else {
            return false;
        }
    }
    const _webp = webpSupport();
    // -----------------------------------------------------------------------------------------------------------------



    _m.removeAclass('contener','nodisplay');

    // let n = 0;

    // let sY, sby, sty, bY, bsY, ty, hh = 0;

    const requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

    const cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;


    window.addEventListener('startLogic', function(e){
        console.log('start 1');
        // grid = document.querySelector(".content");
        loadJSON(e.detail.payload);
        if(_isTouch){
            _m.addAclass('forscroll','mobilescrolly');
        }
    });


    const loadJSON = function(j){
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
        console.log('displayinfo')
        if(clickNotAllow) return;

        clickNotAllow = true;

        if(_currentParent !== '' && _currentParent != e.currentTarget.parentNode ) {
            _m.removeAclass(_currentParent,'zoom');
            _content.removeChild(_currentParent);
        }

        // clonage élément cliqué
        let idbase = e.currentTarget.getAttribute('href').substring(1);
        let cln = e.currentTarget.parentNode.cloneNode(true);

        if(!_vueliste) _content.insertBefore(cln, e.currentTarget.parentNode.nextSibling);

        if(_vueliste) {
            // pas bon
            //let index = Array.prototype.indexOf.call(_content.children, e.currentTarget.parentNode);
            
            // pas bon non plus
            // if (idbase%2 == 0) _content.insertBefore(cln, e.currentTarget.parentNode.nextSibling.nextSibling);
            // if (idbase%2 == 1) _content.insertBefore(cln, e.currentTarget.parentNode.nextSibling);

            let x = e.currentTarget.getBoundingClientRect().left;
            let cx = _content.getBoundingClientRect().width;
            // solution bancale
            let index = Array.prototype.indexOf.call(_content.children, e.currentTarget.parentNode);
            let insertafter = true;
            // console.log( index,_content.children.length)
            if(x < (cx/2) && index < _content.children.length-1){
                for(let i = index+1; i < _content.children.length; i++ ){
                    if(!_m.hasAclass(_content.children[i], 'nodisplay')){
                        _content.insertBefore(cln, _content.children[i].nextSibling);
                        insertafter = false;
                        break;
                    }
                }
            }
            if(insertafter) _content.insertBefore(cln, e.currentTarget.parentNode.nextSibling);
        }
        //changement ID
        cln.setAttribute('id','d-duplicate');
        _currentParent = cln;
        _currentNode = cln.querySelector('a');
        _currentNode.setAttribute('id','a-duplicate');
        _currentTargetId = 'a-duplicate';

        _m.addAclass(cln,'zoom');
            //_m.addAclass(_currentParent,'zoom');

        setAnimZoom(idbase);
        //

        // }

    };
    // --------------------------------------------------------------------------------------------------------


    const setAnimZoom = function(idbase){
        console.log('setanimzoom')
        // FIN de l'animation ZOOM AVANT
        _m.addAclass(_currentParent.querySelector('.spanthumb'),'backwhite');
        _m.addAclass(_currentParent.querySelector('.imgthumb'),'blurry');

        _m.listenerAnimAdd(_currentTargetId,'animationend', function(e,t){
            // vue en damier on insert tous le contenus du zoom
            if(!_vueliste){
                // let fragment = new DocumentFragment();
                let fragment =document.createDocumentFragment();
                let div = document.createElement('div');
                div.classList.add('details');


                // let progbar = document.createElement('div');
                // _m.addAclass(progbar,'progbar');
                // progbar.setAttribute('id','progbar');

                // let bprogbar = document.createElement('div');
                // _m.addAclass(bprogbar,'progssbar');
                // bprogbar.setAttribute('id','progssbar');
                // progbar.append(bprogbar);
                // div.append(progbar);


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
                li.append(span, _base.datas[idbase]['techno'].join(' + '));
                ul.append(li);

                div.append(ul);

                fragment.append(div);

                _currentParent.append(fragment);
            }else{
                // vue en ligne on insère seulement la barre de progression
                // let div = _currentParent.querySelector('.details');
                // let progbar = document.createElement('div');
                // _m.addAclass(progbar,'progbar');
                // progbar.setAttribute('id','progbar');

                // let bprogbar = document.createElement('div');
                // _m.addAclass(bprogbar,'progssbar');
                // bprogbar.setAttribute('id','progssbar');
                // progbar.append(bprogbar);
                // div.insertAdjacentElement('afterbegin',progbar);

            }
            // filter sur l'image
           


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
                    // fragment = new DocumentFragment();
                    fragment = document.createDocumentFragment();
                    div = document.createElement('div');
                    _m.addAclass(div,'carousel');
                    // if(_isTouch) _m.addAclass(div,'mobilescrollx');
                    div.setAttribute('id', 'carousel');
                    ul = document.createElement('ul');
                    ul.setAttribute('id', 'ulcarousel');

                    // reactivation scrollx pour les devices TOUCH
                    if(_isTouch) _m.addAclass(ul,'mobilescrollx');

                    div.append(ul);

                    // ajout scrollbar pour desktop
                    if(!_isTouch){
                        let pcrb = document.createElement('div');
                        pcrb.setAttribute('id','pscrollh');
                        _m.addAclass(pcrb,'pscrollh');
                        let ccrb = document.createElement('div');
                        ccrb.setAttribute('id','cscrollh');
                        _m.addAclass(ccrb,'cscrollh');
                        pcrb.append(ccrb);
                        div.append(pcrb);
                    }

                    // barre de progression du chargment des images
                    let progbar = document.createElement('div');
                    _m.addAclass(progbar,'progbar');
                    progbar.setAttribute('id','progbar');

                    let bprogbar = document.createElement('div');
                    _m.addAclass(bprogbar,'progssbar');
                    bprogbar.setAttribute('id','progssbar');
                    progbar.append(bprogbar);
                    div.append(progbar);

                    _currentParent.append(div);
                    
                    // }, supportsPassive ? { passive: true } : true);


                    // let div = _currentParent.querySelector('.details');
                    // let progbar = document.createElement('div');
                    


                    _m.removeAclass('progbar','bardissolve');
                    // fin centtrage : chargement des images zooms + callback fin chargement de TOUS les zooms
                    console.log('chargement zoom');
                    // caches.open('zooms').then((cache) => {
                    //     cache.keys().then((cachedItems) => {
                    //       console.log(cachedItems)
                    //     })
                    //   })
                    loadZoom(0,idbase, ul, function(){
                        _m.addAclass('progbar','bardissolve');
                        console.log('fin chargement des images');

                        if(!_isTouch){
                            setTimeout(function(){
                                let cw = _m.$dc('carousel').getBoundingClientRect().width;
                                let uw = 0;
                                let nodes =  _m.$dc('carousel').querySelectorAll('.itemzoom img');
                                nodes.forEach(function(el,i,arr){
                                    let iw = el.getBoundingClientRect().width;
                                    uw += iw;
                                    // console.log( el.getBoundingClientRect().width);
                                    // bug alignement Firefox ------------------------
                                    el.parentNode.style.width = iw + "px";
                                    // -----------------------------------------------
                                });
                                
                                if(uw > cw){
                                    _m.listenerAdd('carousel','wheel', function(e,c,t){
                                        if(_timeoutsrcoll1) clearTimeout(_timeoutsrcoll1);
                                        if(e.deltaY > 0){
                                            _m.$dc('ulcarousel').scrollLeft  += 100;
                                        }else{
                                            _m.$dc('ulcarousel').scrollLeft  -= 100;
                                        }
                                        let cs = _m.$dc('cscrollh');
                                        let ph = _m.$dc('pscrollh').getBoundingClientRect().width;
                                        let ch = uw;//_m.$dc('ulcarousel').getBoundingClientRect().width;
                                        let csh = ph/(ch/ph);
                                        cs.style.width =  csh + "px";
                                        let sY = _m.$dc('ulcarousel').scrollLeft;// === undefined ? _forscroll.scrollTop : _forscroll.scrollY;
                                        cs.style.left = sY*(csh/ph) + "px";
                                        _m.addAclass('pscrollh','pscrollhopen');
                                        // close scroll
                                        _timeoutsrcoll1 = setTimeout(function(){
                                            _m.removeAclass('pscrollh','pscrollhopen');
                                        },2000);
                                
                                    }, true);
                                }
                            },100)
                        }
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
        if(_currentParent !== '' && _currentParent != e.currentTarget.parentNode ) {
            _m.removeAclass(_currentParent,'zoom');
            _content.removeChild(_currentParent);
            _currentParent = '';
            _currentNode = '';
        }
        if(!_vueliste){
            let nodes = document.querySelectorAll('.details');
            nodes.forEach(function(el){
                // let garbage = el.parentNode.removeChild(el);
                el.parentNode.removeChild(el);
            });
        }
        if(_vueliste) {
            populateListe();
        }
        _content.classList.toggle("imagetexte");
    };




    // créé element carousel avec une video --------------------------------------------------------------------
    const loadVideos = function(b){
        _m.addAclass('progbar','bardissolve');
        if(_base.datas[b]['videos'].length > 0) {

            // let fragment = new DocumentFragment();
            let fragment = document.createDocumentFragment();
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
                videos.setAttribute('controls','controls');
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
        // let datas = '' ;
        var idbase = idb;
        // let accept = null;
        let cur_img = _rootZoom + _base.datas[idbase]['rep_images'] + '/' + _base.datas[idbase]['images'][i];

        if(cacheAvailable){
            caches.open('zooms').then(function(cache){
                cache.match(cur_img).then(function(res){
                    if(res){
                        res.blob().then(function(b){ 
                            console.log('from cache');
                            let li = document.createElement('li'),
                            img = document.createElement('img'),
                            objectURL = window.URL.createObjectURL(b);
                            _m.addAclass(li,'itemzoom');
                            img.setAttribute('src', objectURL);
                            li.append(img);
                            ul.append(li);
                            i++;
                            if(i < _base.datas[idbase]['images'].length){
                                loadZoom(i,idbase, ul, callback);
                            }else{
                                // TODO tester également si la largeur totale des images < carousel et center UL
                                if(i == 1) _m.addAclass(ul,'unique');
                                callback(); // fin chargement de toutes les images <<<<<<<
                            }
                        });
                    }else{
                        console.log('no cache');
                        getFromXHR(i,idb,ul,callback);
                    }
                })
            });
        }else{
            getFromXHR(i,idb,ul,callback);
        }

        // cur_img = _rootZoom + _base.datas[idbase]['rep_images'] + '/' + _base.datas[idbase]['images'][i];
        
    }
    // ----------------------------------------------------------------------------------------------------------




    // SI PAS DANS LE CACHE OU SI PAS DE CACHE ----------------------------------------------------------------------
    const getFromXHR = function(i,idb,ul,callback){

        let datas = '' ;
        var idbase = idb;
        let accept = null;
        let cur_img = _rootZoom + _base.datas[idbase]['rep_images'] + '/' + _base.datas[idbase]['images'][i];

        if(_webp) accept = 'image/webp,image/apng,image/*,*/*;q=0.8';
        _m.promises.httpRequest( cur_img, 'GET', datas, 30000, "text/plain", 'arraybuffer', accept).then(function(e){
            // console.log('promises',e)
            // i++
            console.log('from XHR');
            let li = document.createElement('li'),
            img = document.createElement('img'),
            arrayBufferView = new Uint8Array(e.response),
            blob = new Blob([arrayBufferView], {'type': 'image/jpeg'}),
            objectURL = window.URL.createObjectURL(blob);
            
            // si cache present la requete est interceptée dans loadZoom
            if(cacheAvailable){
                const requrl = new Request(e.responseURL);
                const  response = new Response(blob);
                caches.open('zooms').then(function(cache){
                    cache.put(requrl,response);
                });
            };
            // response.blob().then(function(r){
            //     console.log(r)
               
            // })

            _m.addAclass(li,'itemzoom');
            img.setAttribute('src', objectURL);
            li.append(img);
            ul.append(li);
            i++;
            
            if(i < _base.datas[idbase]['images'].length){
                loadZoom(i,idbase, ul, callback);
            }else{
                // TODO tester également si la largeur totale des images < carousel et center UL
                if(i == 1) _m.addAclass(ul,'unique');
                callback(); // fin chargement de toutes les images <<<<<<<
            }
        }).fail(function(error){
            // console.log('error ', error);
            // callback();
        }).progress(function(progress){
            // console.log('progress ', progress);
            moveProgressBar(i,_base.datas[idbase]['images'].length, progress)
        }).fin(function(){
        });

    }
    // ----------------------------------------------------------------------------------------------------------




    // barre de progression de chargement des images ------------------------------------------------------------
    const moveProgressBar = function(i, l, p){
        let w1 = 0;
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
        // console.log('imgthumbloaded')
        _m.removeAclass(e.currentTarget.parentNode,'outofright');
        _m.addAclass(e.currentTarget.parentNode,'spanthumb');
        
        // on supprime les anciennes images de placement
        let fake = e.currentTarget.parentNode.parentNode.querySelector('.fake');
        _m.addAclass(fake,'invisible');

        let id = e.currentTarget.parentNode.parentNode.getAttribute('id').substring(2);
        _base.datas[id]['thumbloaded'] = true;

        // si click depuis submenu burger
        // declenche l'ouverture du zoom si l'image n'était pas chargée
        // setTimeout(function(){
        if(_idToFire == id){
            let event = new MouseEvent('click', {
                'view': window,
                'bubbles': true,
                'cancelable': true
              });
              
            _m.$dc('th'+_idToFire).dispatchEvent(event);
            _idToFire = null; 
        } 
        //}, 100);

        // charge le descriptif textuel

        const prg = document.createElement('p');
        m.addAclass(prg,'poptexte');
        const spn1 = document.createElement('span');
        spn1.append(_base.datas[id].name);
        spn2 = document.createElement('span');
        m.addAclass(spn2,'stype');
        spn2.append(_base.datas[id].type_op);
        spn1.appendChild(spn2);
        prg.append(spn1);
        e.currentTarget.parentNode.parentNode.append(prg);

        e.currentTarget.removeEventListener('load', imgThumbLoaded, true);
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
        
        let dup = _content.querySelector('#d-duplicate');
        if(dup){
            _content.removeChild(dup);
            _currentNode = '';
            _currentParent = '';
        }
            
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

        // clic depuis submenu burger mais image pas chargée
        // console.log('_idToFire',_idToFire)
        if(_idToFire && _base.datas[_idToFire]['thumbloaded'] == false){
            let y = _m.$dc('thumb-'+_idToFire).getBoundingClientRect().top;
            //console.log(y);
            _forscroll.scrollTop = (y+_forscroll.scrollTop);
            return false;
        }
        
    };
    // --------------------------------------------------------------------------------------------------------
    
    

    
    // clic sur les items des sous menu ------------------------------------------------------------------------
    const clickSubBurger = function(e,c,t){
        let event = new MouseEvent('click', {
            'view': window,
            'bubbles': true,
            'cancelable': true
        });
        let prnt = e.currentTarget.getAttribute('data-parent');
        let ind = e.currentTarget.getAttribute('data-index');

        _idToFire = ind;

       // _m.$dc(prnt).dispatchEvent(event);

        if(_base.datas[_idToFire]['thumbloaded'] == true){
            setTimeout(function(){
                if(_idToFire){
                    let event = new MouseEvent('click', {
                        'view': window,
                        'bubbles': true,
                        'cancelable': true
                    });
                    
                    _m.$dc('th'+_idToFire).dispatchEvent(event);
                    _idToFire = null; 
                } 
            }, 100);
        };
        return false;
    }

    // --------------------------------------------------------------------------------------------------------




    // cree GRID vignettes & observer -------------------------------------------------------------------------
    // event clic sur vignettes 
    const start = function(){
        console.log('start 2');
        // observer pour div thumb
        observer = new IntersectionObserver(function(observables){
            observables.forEach(function(observable){
                if(observable.intersectionRatio > .2){
                    // let queryNode;
                    try{
                        let queryNode = observable.target.querySelector('.imgtoload');
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
        // let fragment = new DocumentFragment();
        let fragment = document.createDocumentFragment();

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
            i.setAttribute('alt', el['name']+'fake');
            i.classList.add('fake');
            // a.classList.add('imgtoload');
            // add node
            a.append(i);
            a.append(span);
            div.append(a);
            fragment.append(div);
        });
        _content.append(fragment);

        _m.listenClass('athumb', 'click', displayInfo, true);
        // _m.listenerAdd('vues', 'click', clickaHref, true);
        _m.listenerAdd('vues', 'change', changeVue, true);
        setWheelMouse();

    };
    // -----------------------------------------------------------------------------------------------------------



    // cree BURGER MENU -------------------------------------------------------------------------------------------
    const createBurger = function(){
        // console.log(document.append);
        let temp = []; // noms des rubriques

        // objet des elements des rbriques
        /*
        rubrique : tableau des id s'y rapportant
        {"Display":[0,5,6,10]}
        */
        let temp2 = {};
        _base.datas.forEach(function(el,i,arr){
            if(temp.indexOf(el['type']) == -1) temp.push(el['type']);
            if(!temp2.hasOwnProperty(el['type'])) temp2[el['type']] = [];
            temp2[el['type']].push(i);
        });
        temp.sort();
        let ul = document.createElement('ul');
        _m.addAclass(ul,'itemsburger');
        ul.setAttribute('id','itemsburger');
        
        // let fragment = new DocumentFragment();
        let fragment = document.createDocumentFragment();
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
            let id = 'menu-'+i;
            a.setAttribute('href', '#'+el);
            a.setAttribute('data-text', el);
            a.setAttribute('id', id);
            _m.addAclass(a,'itemburger');
            a.append(el);
            if(temp2.hasOwnProperty(el)){
                let s_ul = document.createElement('ul');
                s_ul.setAttribute('id','smenu-'+el);
                temp2[el].forEach(function(el,i,arr){
                    let s_li = document.createElement('li');
                    let s_a = document.createElement('a');
                    _m.addAclass(s_a,'submenu');
                    s_a.setAttribute('href', '#'+_base.datas[el]['name'])
                    s_a.setAttribute('data-index', el);
                    s_a.setAttribute('data-parent', +_base.datas[el]['type']);
                    s_a.append(_base.datas[el]['name']);
                    s_li.append(s_a);
                    s_ul.append(s_li);
                });
                a.append(s_ul);
            }
            li.append(a);
            fragment.append(li);
        });

        // TODO : à mettre en ligne plus tard
        // // exemples avec animation
        // li = document.createElement('li');
        // a =  document.createElement('a');
        // a.setAttribute('href','#animation');
        // a.setAttribute('data-text','Animations');
        // _m.addAclass(a,'itemburger');
        // a.append('Animations');
        // li.append(a);
        // fragment.append(li);

        // // exemples avec demos fonctionnelles
        // li = document.createElement('li');
        // a =  document.createElement('a');
        // a.setAttribute('href','#demo');
        // a.setAttribute('data-text','Démos');
        // _m.addAclass(a,'itemburger');
        // a.append('Démos');
        // li.append(a);
        // fragment.append(li);

        ul.append(fragment);

        _m.$dc('header').append(ul);

        _m.listenClass('itemburger', 'click', clickBurger, false);
        _m.listenClass('submenu', 'click', clickSubBurger, false);

    };

    
    
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
        // let fragment = new DocumentFragment();
        let fragment = document.createDocumentFragment();

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



    const setWheelMouse = function(){
        console.log('_isTouch ',_isTouch);
        if(!_isTouch){
            _m.removeAclass('pscroll','nodisplay');

            _m.listenerAdd('allthumb','wheel', function(e,c,t){
                if(_timeoutsrcoll2) clearTimeout(_timeoutsrcoll2);
                if(e.deltaY > 0){
                    _forscroll.scrollTop  += 100;
                }else{
                    _forscroll.scrollTop  -= 100;
                }
                let cs = _m.$dc('cscroll');
                let ph = _m.$dc('pscroll').getBoundingClientRect().height;
                let ch = _content.getBoundingClientRect().height;
                let csh = ph/(ch/ph);
                cs.style.height =  csh + "px";
                let sY = _forscroll.scrollY === undefined ? _forscroll.scrollTop : _forscroll.scrollY;
                cs.style.top = sY*(csh/ph) + "px";
                _m.addAclass('pscroll','pscrollopen');
                _timeoutsrcoll2 = setTimeout(function(){
                    _m.removeAclass('pscroll','pscrollopen');
                },2000)

            }, supportsPassive ? { passive: true } : false);  
        }
    }

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


}(_ieVers, _isTouch, manageEvents, isMobile, safariMobile);

````

### Service Worker

````js
const cacheName = 'book-v.1.0.4';

console.log('service worker');
self.addEventListener('install',function(e){
    console.log('install sw', e);
    // install API caches
    // promise en variable pour waitUntil
  const cachePromise = caches.open(cacheName).then(function(cache){
    cache.addAll([
        '/',
        'index.html',
        '_js/app01.js',
        '_js/manageEvents15.js',
        '_js/manageEventsPromises12.js',
        '_js/manageEventsAnimation10.js',
        '_js/manageEventsTransition10.js',
        '_js/q2.js',
        '_json/base.json',
        '_css/style.css',
        'vignettes/blk_320x320.png',
        'vignettes/blk_200x200.png',
        'favicon.ico',
        '_img/expand.png'
    ])
  });
    e.waitUntil(cachePromise);
});


self.addEventListener('activate', function(e) {
    console.log('[ServiceWorker] Activate');
    e.waitUntil(
      caches.keys().then(function(keyList) {
        return Promise.all(keyList.map(function(key) {
          if (key !== cacheName) {
              console.log(key);
            // console.log('[ServiceWorker] Removing old cache', key);
            // return caches.delete(key);

          }
        }));
      })
    );
    // activate SW faster
    return self.clients.claim();
  });


self.addEventListener('fetch',function(e){

    // if(!navigator.onLine){
    //     const headers = {headers:{'content-type':'text/html;charset=utf-8'}};
    //     e.respondWith(new Response('<h1>no connection &éé&é</h1>',headers));
    // }
    console.log('fetch on url : ', e.request.url);



    // CACHE ONLY WITH NETWORK FALLBACK
    /*
    e.respondWith(
        // recherche si fichier en cache
        caches.match(e.request).then(function(res){
            console.log('fetch ',res, e.request.url);
            if(res){
                // retourne version en cache
                return res;
            }
            // si fichier pas dans cache requete reseau
            return fetch(e.request).then(function(newResponse){
                console.log('mise en cache ', newResponse, e.request.url);
                caches.open(cacheName).then(function(cache){
                    // ajoute la response de la requete
                    cache.put(e.request, newResponse);
                });
                // on ne peut pas utiliser une réponse plusieurs fois -> clonage pour le renvoi
                // renvoie de la reponse
                return newResponse.clone();
            });
        })
    );
    */

    // NETWORK FIRST WITH CACHE FALLBACK
    e.respondWith(
        // request reseau
        fetch(e.request).then(function(res){
            // mise en cache
            console.log('recupere depuis le reseau : ', e.request.url);
            caches.open(cacheName).then(function(cache){
                cache.put(e.request, res);
            });
            // retourne clone repponse
            return res.clone();
            // erreur requete reseau -> retourne fichier en cache
        }).catch(function(err){
            console.log('recupere depuis le cache ', e.request.url);
            return caches.match(e.request).then(function(res){
                if(res){
                    return res;
                }else{
                    throw Error(e.request.url+' not found in cache');
                }
            });
            // let = rescached = caches.match(e.request);
            // console.log('rescached ', rescached);
            // if(rescached){
            //     return rescached;
            // }else{
            //     console.log('not in cache and offline');
            // }
            // pas dans le cache non plus
        }).catch(function(err){
            console.log('pas dans le cache : ', err);
            if(e.request.url.match('vignettes/200x200/')){
                const requrl = new Request('/vignettes/blk_200x200.png');
                return caches.match(requrl).then(function(res){
                    // console.log("200x200");
                    return res;
                });
            } 
            if(e.request.url.match('vignettes/320x320/')){
                const requrl = new Request('/vignettes/blk_320x320.png');
                return caches.match(requrl).then(function(res){
                    // console.log("320x320");
                    // console.log(res);
                    return res;
                });
            } 

        })
    );


});
````
