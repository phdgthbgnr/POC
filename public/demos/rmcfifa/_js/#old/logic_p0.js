//
// logic pour participation 0
// du mercredi au vendredi (equipe de la semaine)
(function(m,t,f,mbl){

    var token = t,
    fifateam = f,
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
            }else if (nbDefer[i].readyState){ // IE8
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
            case 'zoom':
            m.removeAclass('zoomphot','nodisplay');
            break;

            case 'facebook':
                //var qstr = e.currentTarget.getAttribute('href').substring(1);
                var urlfic = 'http://trophee-fut-rmcsport.bfmtv.com/_teamfifa/' + fifateam + '.jpg';

                console.log(urlfic);
                /*
                FB.ui({
                    method: 'share_open_graph',
                    action_type: 'og.shares',
                    action_properties: JSON.stringify({
                        object: {
                            'og:url': 'http://trophee-fut-rmcsport.bfmtv.com/',//?imgsh=' + fifateam,
                            'og:title': "RMCSPORT FIFA UTIMATE TEAM",
                            'og:description': "Voici l'équipe de la semaine FIFA Ultimate Team",
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
                link: 'http://trophee-fut-rmcsport.bfmtv.com/?imgsh=' + fifateam,
                picture: urlfic,
                description: "Voici l'équipe de la semaine FIFA ULTIMATE TEAM !",
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
                text   = "Voici%20l'équipe%20de%20la%20semaine%20FIFA%20ULTIMATE%20TEAM%20!",
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
    },

    closePop = function(e,ct,t){
        var id = e.target.parentNode.parentNode.parentNode.getAttribute('id');
        if(!m.hasAclass(id,'nodisplay')) m.addAclass(id,'nodisplay');
        return false;
    };

    deferImages(function(){/*nothing*/},'data-src','');
    m.$dc('download').setAttribute('href', '_teamfifa/_adwnld.php?token=' + token + '&shareimg='+ f);
    m.listenClass('closepopup','click', closePop, true);
    m.listenerAdd('zoom','click', clickStd, true);
    m.listenerAdd('facebook','click', clickStd, true);
    m.listenerAdd('twitter','click', clickStd, true);
    
}(manageEvents,window.token,window.fifateam,window.ismobil));