(function(i,t,m){

    
    
    const _m = m;
    const _ieVers = i;
    const _isTouch = t;
    const _pathThumb = 'vignettes/300x300/';
    const _content = _m.$dc('content');
    let  observer;

    let _currentNode = '';          // node parent a
    let _currentTargetId = '';      // id a
    let _base = {};                 // objet JSON des élements
    let _indexdb = 0;               // index où commencer l'insertion des éléments de la base

    let n = 0;


    window.addEventListener('startLogic', function(e){
        console.log('start 1');
        // grid = document.querySelector(".content");
        loadJSON(e.detail.payload);
    });



    const  loadJSON = function(j){
        let  datas = '';
        m.promises.httpRequest(j, 'GET', datas, 9000).then(function(e){
            let resjson = JSON.parse(e);
            _base = resjson;
            start();
        }).fail(function(error){
            if(error) console('erreur');

        }).progress(function(progress){
            // console.log(progress);
        }).fin(function(){  // finally don't work on ie8 (ES5)

        });
    };

    // const setObservable = function(){
    //     console.log('setObservable');
    //     const grid = document.querySelector(".content");
    //     animateCSSGrid.wrapGrid(grid, {duration : 300});

    //     let observer = new IntersectionObserver(function(observables){
    //         observables.forEach(function(observable){
    //             if(observable.intersectionRatio > .3){
    //                 let imgtoload = observable.target.querySelector('img').getAttribute('data-src');
    //                 observable.target.querySelector('img').setAttribute('src',imgtoload);
    //                 n++
    //                 console.log(n);

    //             }
    //         })
    //     },{
    //         threshold: [.3]
    //     });


    //     let items = Array.prototype.slice.call(document.querySelectorAll('#content > div'));
    //     items.forEach(function (el,i,arr) {
    //         console.log(i);
    //         // item.classList.add('not-visible')
    //         observer.observe(el);
    //     })

    // };




    const displayInfo = function(e,c,t){
        // let grid = _m.$dc('content');              // node content pour animate-css-grid
        // let {unwrapGrid, forceGridAnimation} = animateCSSGrid.wrapGrid(grid, {duration : 300});
        // forceGridAnimation();
        let img;
        let imgfake;

        if(_currentNode !== '') {
            _m.removeAclass(_currentNode,'zoom');
            img = _currentNode.querySelector('.imgthumb');
            _m.removeAclass(img,'blurry');
        }

        // imgfake = e.currentTarget.querySelector('.fake');
        _m.addAclass(e.currentTarget,'opened');

        _currentNode = e.currentTarget.parentNode;
        _m.addAclass(_currentNode,'zoom');
        _currentTargetId = e.currentTarget;

        img = e.currentTarget.querySelector('.imgthumb');
        _m.addAclass(img,'blurry');

        
    }


    

    // const  getDataFromBase = function getData (_indexdb){
        
    //     var fragment = new DocumentFragment();
    //     // div
    //     var div = document.createElement('div');
    //     div.classList.add('thumb');
    //     // a
    //     var a = document.createElement('a');
    //     a.setAttribute('id','th'+i);
    //     a.classList.add('athumb');
    //     // img
    //     var i = document.createElement('img');
    //     i.setAttribute('data-src', _pathThumb + _base.datas[_indexdb]['thumb']);
    //     i.setAttribute('src', '_img/blk300x300.png');
    //     // add node
    //     a.append(i);
    //     div.append(a);
    //     fragment.append(div);
    //     content.append(fragment);
    //     // observer.observe(content.children[_indexdb]);
    //     // console.log(content.children[_indexdb]);
    //     // console.log('getDataFromBase ', _indexdb);
    //     // console.log('_base.datas.length ', _base.datas.length);
    //     if(_indexdb == _base.datas.length-1){
    //         return 1;
    //     }
    //     return getData(_indexdb+1);
    //     //return getDataFromBase(_indexdb);
    // };


    // atend qu'une image soit chargée pour ajouter observer et animate-grid
    const firstImgLoad = function(e){
        console.log('firstImgLoad')
        _m.addAclass(e.currentTarget.parentNode,'loaded');
        // if(!grid){
        //     console.log('grid');
        //     // grid = document.querySelector(".content")
        //     // unwrapGrid, forceGridAnimation = animateCSSGrid.wrapGrid(grid, {duration : 300});
        //     // unwrapGrid();
        //     // grid = document.querySelector(".content");
        //     // animateCSSGrid.wrapGrid(grid, {duration : 300});
        // }
        observer.observe(e.currentTarget.parentNode.parentNode);
        e.currentTarget.removeEventListener('load',firstImgLoad,true);
    };
    
    const imgThumbLoaded = function(e){
        console.log('imgThumbLoaded')
        _m.removeAclass(e.currentTarget.parentNode,'outofright');
        e.currentTarget.removeEventListener('load',imgThumbLoaded,true);
    };





    const start = function(){
        console.log('start 2');

        // observer pour div thumb
        observer = new IntersectionObserver(function(observables){
            observables.forEach(function(observable){
                if(observable.intersectionRatio > .3){
                    let queryNode;
                    try{
                        queryNode = observable.target.querySelector('.imgtoload');
                        let imgtoload = queryNode.getAttribute('data-src');
                        queryNode.setAttribute('src',imgtoload);
                        _m.removeAclass(queryNode,'imgtoload');
                        queryNode.addEventListener('load',imgThumbLoaded,true);
                    }catch(e){
                    }
                    n++
                    console.log(n);

                }
            })
        },{
            threshold: [.3]
        });
        // console.log(getDataFromBase(_indexdb));
        // console.log('fin start 2');

        // setObservable();
        let fragment = new DocumentFragment();
        _base.datas.forEach(function(el,i,arr){
            // div thumb
            var div = document.createElement('div');
            div.classList.add('thumb');
            
            // a
            var a = document.createElement('a');
            a.setAttribute('id','th'+i);
            a.setAttribute('href','#'+i);
            a.classList.add('athumb');

            // span avec l'image à charger
            var span = document.createElement('span');
            span.classList.add('outofright');
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
            i.addEventListener('load', firstImgLoad,true);
            i.classList.add('fake');
            // a.classList.add('imgtoload');
            // add node
            a.append(i);
            a.append(span);
            div.append(a);
            fragment.append(div);
        });
        content.append(fragment);


        const clickaHref = function(e,c,t){
            let ahref = e.currentTarget.getAttribute('href');
            switch(ahref){
                case '#togglewidth':
                content.classList.toggle("fiftypercent");
                break;
            }
            return false;
        }

        _m.listenClass('athumb', 'click', displayInfo, true);
        _m.listenClass('toggle', 'click', clickaHref, true);
    };

    

        
    



})(_ieVers, _isTouch, manageEvents);