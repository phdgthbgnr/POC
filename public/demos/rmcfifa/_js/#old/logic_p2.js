//
// logic pour participation 0
// du mercredi au vendredi (equipe de la semaine)
(function(m,t,f,mbl){

    var token = t,
        trophee = f,
        ismobile = mbl,

        deferImages = function(callback, dt, rep){
            var totImgDefer = 0;
            var imgDefer = document.getElementsByTagName('img');
            var nbDefer = [];

            // dt == data-srcslide
            for (var i=0; i<imgDefer.length; i++) {
                if (m.hasAclass(imgDefer[i],'nomobile') && ismobile == 1) continue;
                if(imgDefer[i].getAttribute(dt)) {
                    nbDefer.push(imgDefer[i]);
                }
            }
            for (var i=0; i<nbDefer.length; i++) {
                nbDefer[i].setAttribute('src', rep+nbDefer[i].getAttribute(dt));
                //console.log('defering : ', nbDefer[i].getAttribute(dt));
                if (nbDefer[i].addEventListener != undefined){
                    nbDefer[i].addEventListener('load',function(e){
                        if(totImgDefer >= nbDefer.length-1) {
                            callback();
                        }
                        totImgDefer++;
                    });
                } else if (nbDefer[i].readyState){ // IE8
                    nbDefer[i].onreadystatechange = function(){
                        if(nbDefer[i].readyState == 'loaded' || nbDefer[i].readyState == 'complete') {
                            if(totImgDefer >= nbDefer.length-1) {
                                callback();
                            }
                            totImgDefer++;
                        }
                    }
                }
            }    
        },

        clickStd = function(e,ct,t){
            var id = e.currentTarget.id;
            switch(id){

            case 'facebook':
                var qstr = e.currentTarget.getAttribute('href').substring(1);
                var urlfic = 'http://trophee-fut-rmcsport.bfmtv.com/_trophee/' + trophee + '.jpg';
                
                /*
                FB.ui({
                    method: 'share_open_graph',
                    action_type: 'og.shares',
                    action_properties: JSON.stringify({
                        object: {
                            'og:url': 'http://trophee-fut-rmcsport.bfmtv.com/',//?imgsh=' + fifateam,
                            'og:title': "RMCSPORT FIFA UTIMATE TEAM",
                            'og:description': "Trophée de l’équipe de la semaine RMC x FIFA Ultimate Team #1",
                            'og:image': urlfic
                        }
                    })
                }, function(response){

                });
                */
                
                FB.ui({
                    method: 'feed',
                    //href: 'http://trophee-fut-rmcsport.bfmtv.com/?imgsh='+qstr,
                    name: 'RMCSPORT FIFA ULTIMATE TEAM',
                    link: 'http://trophee-fut-rmcsport.bfmtv.com/?imgsh=' + trophee,
                    picture: urlfic,
                    description: '',
                    caption: 'RMCSPORT.BFMTV.COM'
                },function(d){
                    console.log(d);
                });
                
                break;

            case 'twitter':
                var width  = 575,
                    height = 320,
                    left   = 300,
                    top    = 200,
                    text   = "Trophée%20de%20l’équipe%20de%20la%20semaine%20RMC%20x%20FIFA%20Ultimate%20Team",
                    urlnflix ='http://trophee-fut-rmcsport.bfmtv.com/',
                    url    = 'https://twitter.com/intent/tweet/?text='+text+'&url='+urlnflix,
                    opts   = 'status=1' +
                    ',width='  + width  +
                    ',height=' + height +
                    ',top='    + top    +
                    ',left='   + left;
                window.open(url, 'twitter', opts);
                break;
            }

            return false;
        };

    deferImages(function(){/*nothing*/},'data-src','');

    m.listenerAdd('facebook','click', clickStd, true);
    m.listenerAdd('twitter','click', clickStd, true);

}(manageEvents, window.token, window.trophee, window.ismobil));