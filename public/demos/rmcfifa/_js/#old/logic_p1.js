//
// logic pour participation 1 
// du lundi au mercredi
(function(m,t,r,s){

    var token = t,
    refresh = r,
    semaine = s,
    selectionfifa = {};

    window.token = 0;
    window.refreshjson = 0;
    window.semaine = 0;
    
    // recupere la selection fifa de la semaine en cours (refresh) ---------------------------------------------
    if(refresh === 1){
        var datas = 'token=' + token + '&action=semfifajoueur';
        m.promises.httpRequest('_services/endPoint.php', 'POST', datas, 9000).then(function(e){
            var resjson = JSON.parse(e);
            //sending = false;
        }).fail(function(error){
            //console.log(error);
            if(error)console('erreur');
            sending = false;
        }).progress(function(progress){
            console.log(Math.round(progress*100) + ' %');
        }).fin(function(){  // finally don't work on ie8 (ES5)
            console.log('fin');
            sending = false;
        });
    }else{
        // charge seulement le json genere
        var datas = '';
        m.promises.httpRequest('_json/selectionfifa-'+semaine+'.json', 'GET', datas, 9000).then(function(e){
            var resjson = JSON.parse(e);
            selectionfifa = resjson.data;
            start();
        }).fail(function(error){
            if(error)console('erreur');
            console('erreur');
        }).progress(function(progress){
              console.log(Math.round(progress*100) + ' %');
        }).fin(function(){  // finally don't work on ie8 (ES5)
            console.log('fin');
        });
    }
    // -----------------------------------------------------------------------------------------------

    var sending = false,
    curPoste = '',
    repjoueur = '_img/_joueurs/',
    divintro = m.$dc('intro'),
    divselection = m.$dc('selection'),
    divformulaire = m.$dc('formulaire'),
    divpartage = m.$dc('partages'),
    shareimg = m.$dc('shareimg'),
    scanvas = m.$dc('sharecanvas'),
    scontext = scanvas.getContext('2d'),
    nbJoueurs = 11, // <--------------------- NOMBRE DE JOUEURS IMPORTANT POUR GENERATION IMAGE DE PARTAGE
    isInSelection = function(id){
        var key = '';
        for (key in selections){
            if (selections[key]['joueurid'] == id) return true;
        }
        return false;
    },
    populatePopup = function(){
        // cles selection fifa
        keysids = {'ag':'ailierg','g':'gardien','dc':'defenseurc','dg':'defenseurg','dd':'defenseurd','ad':'ailierd','bu':'buteur','mc':'milieuc','mdc':'milieudc'};
        var key = '';
        var idpop = '';
        for(key in selectionfifa){
            idpop = keysids[key];
            var htmlli = '';
            for(var k = 0; k < selectionfifa[key].length; k++){
                var cur = selectionfifa[key][k];
                var insel = isInSelection(cur['id']) == true ? ' insel' : '';
                htmlli += '<li><a href="#' + key + '" id="joueur-' + cur['id'] + '" class="seljoueur' + insel + '"><img src="_img/nojoueur.png" alt="' + cur['prenom'] + ' ' + cur['nom'] + '" data-src-' + key + '="' + cur['image'] + '" /><p><span class="nom">' + cur['prenom'] + ' ' + cur['nom'] + '</span><span class="perf">' + cur['performance'] + '</span></p></a></li>'; //+'<!-- \n -->';
            }
            m.$dc(idpop).childNodes[1].childNodes[3].innerHTML = htmlli;
        }
        m.listenClass('seljoueur','click', setJoueurs, true);
    },
    setJoueurs = function(e,ct,t){
        var id = ct.getAttribute('id');
        //var id = e.currentTarget.id;
        var cnode = m.$dc(id);
        var sid = id.substring(7);
        selections[curPoste]['joueurid'] = sid;
        // for(var i = 0; i < e.currentTarget.parentNode.parentNode.childNodes.length; i++){
        for(var i = 0; i < e.currentTarget.parentNode.parentNode.childNodes.length; i++){
            var node = e.currentTarget.parentNode.parentNode.childNodes[i];
            var nid = node.firstChild.getAttribute('id');
            if (nid != id){
                var snid = nid.substring(7);
                if(m.hasAclass(nid,'insel') && !isInSelection(snid)) m.removeAclass(nid,'insel');
            }
        };
        
        if(!m.hasAclass(id, 'insel')) m.addAclass(id, 'insel');

        createCookie('rmcfifafut2017', selections, 30);

        testFini();

        populateSelections();

        var idp = cnode.parentNode.parentNode.parentNode.parentNode;
        m.addAclass(idp,'nodisplay');
    },
    testFini = function(){
        var fini = true;
        for(k in selections){
            if(selections[k]['joueurid'] == '') fini = false;
        }

        if(fini) {
            m.removeAclass('continuer','nodisplay');
            m.addAclass('legende','nodisplay');
        }else{
            m.removeAclass('legende','nodisplay');
            m.addAclass('continuer','nodisplay');
        }
    },
    closePop = function(e,ct,t){
        var id = e.target.parentNode.parentNode.parentNode.getAttribute('id');
        if(!m.hasAclass(id,'nodisplay')) m.addAclass(id,'nodisplay');
        return false;
    },
    clicJoueur = function(e,ct,t){   
        //var id = ct.getAttribute('id');
        var id = e.currentTarget.id;
        var poste = '';
        var idmodal = '';
        var datasrc =''
        switch(id){
            case 'buteur1':
            poste   = 'bu';
            idmodal = 'buteur';
            datasrc = 'data-src-bu';
            break;
            case 'ailier1':
            poste   = 'ag';
            idmodal = 'ailierg';
            datasrc = 'data-src-ag';
            break;
            case 'ailier2':
            poste   = 'ad';
            idmodal = 'ailierd';
            datasrc = 'data-src-ad';
            break;
            case 'milieu1':
            poste   = 'mc1';
            idmodal = 'milieuc';
            datasrc = 'data-src-mc';
            break;
            case 'milieu2':
            poste   = 'mc2';
            idmodal = 'milieuc';
            datasrc = 'data-src-mc';
            break;
            case 'milieu3':
            poste   = 'mdc';
            idmodal = 'milieudc';
            datasrc = 'data-src-mdc';
            break;
            case 'defenseur1':
            poste   = 'dg';
            idmodal = 'defenseurg';
            datasrc = 'data-src-dg';
            break;
            case 'defenseur2':
            poste   = 'dc1';
            idmodal = 'defenseurc';
            datasrc = 'data-src-dc';
            break;
            case 'defenseur3':
            poste   = 'dc2';
            idmodal = 'defenseurc';
            datasrc = 'data-src-dc';
            break;
            case 'defenseur4':
            poste   = 'dd';
            idmodal = 'defenseurd';
            datasrc = 'data-src-dd';
            break;
            case 'gardien1':
            poste   = 'g';
            idmodal = 'gardien';
            datasrc = 'data-src-g';
            break;
        };

        // si joueur sélectionné dans milieu gauche on ne l'affiche pas dans milieu droit
        if( poste == 'mc1' ) listeDouble('milieuc','mc2');
        // si joueur sélectionné dans milieu droit on ne l'affiche pas dans milieu gauche
        if( poste == 'mc2' ) listeDouble('milieuc','mc1');
        // si joueur sélectionné dans defenseur central gauche on ne l'affiche pas dans defenseur central droit
        if( poste == 'dc1' ) listeDouble('defenseurc','dc2');
        // si joueur sélectionné dans defenseur central droit on ne l'affiche pas dans defenseur central gauche
        if( poste == 'dc2' ) listeDouble('defenseurc','dc1');

        curPoste = poste;
        if(m.hasAclass(idmodal,'nodisplay')) m.removeAclass(idmodal,'nodisplay');
        deferImages(function(){/*nothing*/},datasrc,repjoueur);

        return false;
    },
    listeDouble = function(id1,id2){
        var curnode;
        var curid;
        var nodisplay;
        for(var i = 0; i < m.$dc(id1).childNodes[1].childNodes[3].childNodes.length; i++){
            curnode = m.$dc(id1).childNodes[1].childNodes[3].childNodes[i];
            curid = curnode.firstChild.getAttribute('id').substring(7);
            nodisplay = selections[id2]['joueurid'] == curid ? true : false;
            if(nodisplay){
                m.addAclass(curnode.firstChild,'noselec');
            }else{
                m.removeAclass(curnode.firstChild,'noselec');
            }
        }   
    },
    createCookie = function(name,value,days){
        var svalue = JSON.stringify(value);
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + svalue + expires + "; path=/";
    },
    readCookie = function(name){
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    },
    eraseCookie= function(name) {
        createCookie(name,"",-1);
    },
    clickStd = function(e,ct,t){
        var id = e.currentTarget.id;
        switch(id){

            case 'participer':
                m.removeAclass(divselection, 'nodisplay');
                m.addAclass(divintro, 'nodisplay');
            break;

            case 'continuer':
                m.addAclass(divselection, 'nodisplay');
                m.removeAclass(divformulaire, 'nodisplay');
                loadInCanvas();
            break;

            case 'valider':
                if(m.hasAclass('nom','erreur')) m.removeAclass('nom','erreur');
                if(m.hasAclass('prenom','erreur')) m.removeAclass('prenom','erreur');
                if(m.hasAclass('email','erreur')) m.removeAclass('email','erreur');

                var err = new Array();

                var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|fr|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b/;
                var email = m.$dc('email').value.toLowerCase();
                if (!re.test(email)) err.push('email');

                if (m.$dc('nom').value.trim() == '') err.push('nom');

                if (m.$dc('prenom').value.trim() == '') err.push('prenom'); 

                if (err.length == 0 && sending == false){
                    var frm = m.$dc('saveprofil');
                    var datas =  serialize(frm);
                    datas.push('selection=' + JSON.stringify(selections));
                    datas.push('semaine=' + semaine);
                    datas = datas.join('&');
                    sending = true;
                    m.promises.httpRequest('_services/endPoint.php', 'POST', datas, 9000).then(function(e){
                        var resjson = JSON.parse(e);
                        if(resjson.error == 'ok') {
                            if (resjson.data.match('^([a-zA-Z0-9]){40}-([0-9]{6})$')){
                                m.$dc('imgshare').setAttribute('data-shrc', '_sharing/' + resjson.data + '.jpg');
                                m.$dc('download').setAttribute('href', '_sharing/_adwnld.php?token=' + token + '&shareimg='+ resjson.data);
                            }
                        }

                        deferImages(function(){
                            m.addAclass(divformulaire, 'nodisplay');
                            m.removeAclass(divpartage,'nodisplay');
                        },'data-shrc','');

                        sending = false;
                    }).fail(function(error){
                        //console.log(error);
                        if(error)console('erreur');
                        sending = false;
                    }).progress(function(progress){
                        console.log(Math.round(progress*100) + ' %');
                    }).fin(function(){  // finally don't work on ie8 (ES5)
                        console.log('fin');
                        sending = false;
                    });
                }else{
                    for(var i=0;i<err.length;i++){
                        m.addAclass(err[i],'erreur');
                    }
                }
            break;

            case 'download':
                
                /*
                if (sending) return;
                sending = true;
                var nm = e.currentTarget.getAttribute('data-dl');
                var datas = 'token=' + token + '&action=download&shareimg=' + nm;
                m.promises.httpRequest('_services/endPoint.php', 'POST', datas, 9000).then(function(e){                    
                    sending = false;
                }).fail(function(error){
                    //console.log(error);
                    if(error)console('erreur');
                    sending = false;
                }).progress(function(progress){
                    console.log(Math.round(progress*100) + ' %');
                }).fin(function(){  // finally don't work on ie8 (ES5)
                    console.log('fin');
                    sending = false;
                });
                */
            break;

        }
        return false;
    },
    
    rePopulateSelections = function(kk,ids){
        var kf = ''; // id selection fifa
        var idf = 'j' + kk; // id image à recharger
        switch(kk){
            case 'mc1':
            case 'mc2':
            kf = 'mc';
            break;
            case 'dc1':
            case 'dc2':
            kf = 'dc';
            break;
            default:
            kf = kk;
            break;
        }
        var oj= {};
        for(var i = 0; i < selectionfifa[kf].length; i++){
            oj = selectionfifa[kf][i];
            if(oj['id'] == ids){
                m.$dc(idf).setAttribute('data-ssrc', oj['image']);
                m.$dc(idf).setAttribute('alt', oj['prenom'] + ' ' + oj['nom']);
            }
        }
        
    },
    start = function(){

        m.listenClass('poste','click', clicJoueur, true);
        m.listenClass('closepopup','click', closePop, true);

        m.listenerAdd('participer','click', clickStd, true);
        m.listenerAdd('valider','click', clickStd, true);
        m.listenerAdd('continuer','click', clickStd, true);
        //m.listenerAdd('download','click', clickStd, true);

        var cook = readCookie('rmcfifafut2017');
        var err = false;
        if(cook !== null) {
            try {
                selections = JSON.parse(cook);
                if (selections['bu']['week']){
                    if(selections['bu']['week'] == s){
                        testFini();
                    }else {err = true};
                }else {err = true};
            } catch(e){
                err = true;
            };
        }else{
            err = true;
        }
        if(err){
            // x,y : position joueur sur image partage
            selections = {
                'bu'    :{'joueurid':'','x':537,'y':1,'week':s},
                'mc1'   :{'joueurid':'','x':404,'y':120,'week':s},
                'mc2'   :{'joueurid':'','x':676,'y':120,'week':s},
                'mdc'   :{'joueurid':'','x':540,'y':190,'week':s},
                'dg'    :{'joueurid':'','x':209,'y':248,'week':s},
                'dd'    :{'joueurid':'','x':870,'y':248,'week':s},
                'dc1'   :{'joueurid':'','x':385,'y':313,'week':s},
                'dc2'   :{'joueurid':'','x':680,'y':313,'week':s},
                'ag'    :{'joueurid':'','x':264,'y':44,'week':s},
                'ad'    :{'joueurid':'','x':820,'y':44,'week':s},
                'g'     :{'joueurid':'','x':536,'y':440,'week':s}
            }
        }; 
        
        deferImages(function(){/*nothing*/},'data-src','');
        populateSelections();
        populatePopup();

    },
    populateSelections = function(){
        var k = '';
        for (k in selections){
            rePopulateSelections(k,selections[k]['joueurid']);
        }
        deferImages(function(){/*nothing*/},'data-ssrc',repjoueur);
    },
    deferImageCanvas = function(callback, ind, im, x, y, w, h, dx, dy, dw, dh){
        if (im.addEventListener != undefined){
            im.addEventListener('load',function(e){
                    callback(im, ind, x, y, w, h, dx, dy, dw, dh);
             });
        }else if (im.readyState){ // IE8
            im.onreadystatechange = function(){
                if(im.readyState == 'loaded' || im.readyState == 'complete') {
                    callback(im, ind, x, y, w, h, dx, dy, dw, dh);
                }
            }
        }
    },
    loadInCanvas = function(){
        //console.log(selections);
        //console.log(selectionfifa);
        // ajout bg
        var bimg = new Image();
        bimg.src='_img/bg_share.jpg';
        
        deferImageCanvas(loadInCanvasPlayer,0 , bimg, 0, 0, 1200, 628, 0, 0, 1200, 628); 
    },
    loadInCanvasPlayer = function(im, ind, x, y, w, h, dx, dy, dw, dh){
        // dessine l'image de fond
        scontext.drawImage(im, x, y, w, h, dx, dy, dw, dh);
        //
        var imgs = new Array();
        for (k in selections){
            var ks = k;
            if(k == 'mc1' || k == 'mc2') ks = 'mc';
            if(k == 'dc1' || k == 'dc2') ks = 'dc';
            for(var i = 0; i < selectionfifa[ks].length; i++){
                if(selectionfifa[ks][i]['id'] == selections[k]['joueurid']){
                    //console.log(repjoueur + selectionfifa[ks][i]['image']);
                    imgs.push(new Image());
                    var l = imgs.length-1;
                    imgs[l].src = repjoueur + selectionfifa[ks][i]['image'];
                    var x = selections[k]['x'];
                    var y = selections[k]['y'];
                    deferImageCanvas(drawInCanvas,l,imgs[l],0,0,124,184,x,y,124,184);
                }
            }
        }
    },
    drawInCanvas = function(im, ind, x, y, w, h, dx, dy, dw, dh){
        //var scontext = scanvas.getContext('2d');
        scontext.drawImage(im, x, y, w, h, dx, dy, dw, dh);
        if(ind == nbJoueurs-1){
            setTimeout(function(){
                var data = scanvas.toDataURL();
                shareimg.src = data;
                m.$dc('dataimg').value = data;
            },100)
        }
    },
    deferImages = function(callback, dt, rep){
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
    serialize = function(form) {
        if (!form || form.nodeName !== "FORM") {
            return;
        }
        var i, j, q = [];
        for (i = form.elements.length - 1; i >= 0; i = i - 1) {
            if (form.elements[i].name === "") {
                continue;
            }
            switch (form.elements[i].nodeName) {
            case 'INPUT':
                switch (form.elements[i].type) {
                case 'text':
                case 'hidden':
                case 'password':
                case 'button':
                case 'reset':
                case 'submit':
                case 'email':
                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    break;
                case 'checkbox':
                case 'radio':
                    if (form.elements[i].checked) {
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    }
                    break;
                case 'file':
                    break;
                }
                break;
            case 'TEXTAREA':
                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                break;
            case 'SELECT':
                switch (form.elements[i].type) {
                case 'select-one':
                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    break;
                case 'select-multiple':
                    for (j = form.elements[i].options.length - 1; j >= 0; j = j - 1) {
                        if (form.elements[i].options[j].selected) {
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j].value));
                        }
                    }
                    break;
                }
                break;
            case 'BUTTON':
                switch (form.elements[i].type) {
                case 'reset':
                case 'submit':
                case 'button':
                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    break;
                }
                break;
            }
        }
        return q;
        //return q.join("&");
    }

}(manageEvents,window.token,window.refreshjson,window.semaine));