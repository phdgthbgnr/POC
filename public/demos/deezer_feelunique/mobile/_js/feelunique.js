var plstOK = false;

(function () {
    
    
    'use strict';
    
    /*
    Number.prototype.between = function(a, b) {
        var min = Math.min.apply(Math, [a, b]),
        max = Math.max.apply(Math, [a, b]);
        return this > min && this < max;
    };
    */
    
    var idrock  = 1979958202; // test : 1979398162;
    var idsexy  = 1979938182; // test : 1979353542;
    var idlazy  = 1995605762; // test : 1979410182;
    var idfun   = 1995606902; // test : 1979405942;
    
    
    
    var nbtracks = 20; // nb tracks à selectionner dans les playlists
    
    var playlists   = {rock:[],sexy:[],lazy:[],fun:[]}; // playlistes originales (50 titres)
    var playlistsR  = {rock:[],sexy:[],lazy:[],fun:[]}; // playlistes avec xx titres tirés au sort
    
    var token;
    var idUSER;
    var idPlaylist = 0;
    var titlplst = 'Feel You';
    
    window.dzAsyncInit = function() {
        DZ.init({
            appId  : '183922', //'145651',
            channelUrl : 'http://entertainmentggd.com/deezerfeelunique/channel.html',
            player: {
                onload: function(response) {
                    //console.log('DZ.player is ready', response);
                    DZ.Event.subscribe('player_position', function(track, evt_name){
                       // console.log("position in the track", track);
                        //posTrack=track[0];
                    });
                        DZ.Event.subscribe('player_paused', function(track, evt_name){
                       // console.log("position in the track", track);
                        /*
                        var o=DZ.player.getCurrentTrack();
                        var id=parseInt(o.id);
                        if($.inArray(id,arrAlbums)>-1)  curAlbum=0;
                        if($.inArray(id,arrPlsts)>-1)  curPlst=0;
                        */
                        //posTrack=track[0];
                    });
                }
            }
        });
        
        
        
        DZ.ready(function(sdk_options){
            //console.log('sdk_options : ');
            //console.log(sdk_options);
            if(sdk_options.token.accessToken){
                token = sdk_options.token.accessToken
            }else{
                token = 'frEsE7ch7T4c6MK62ATOirDdpX06LAfuXicM4em7baRTNSh883'; // token temporaire pour test sur entertainmentggd/feelunique (a creer sur developers.deezer.com
            };
            
            DZ.api('/user/me?access_token='+token, function(response){
                //console.log('id : ');
                //console.log(response);
                idUSER = response.id;
                //console.log('idUSER : ' + idUSER);
            });
            
            // sexy
            DZ.api('/playlist/'+idsexy+'&access_token='+token, function(response1){                     
            },function(response1){
                //console.log(response.error);
                if(!response1.error){
                    //console.log('sexy');
                    //console.log(response1);
                    for (var t in response1.tracks.data){
                        playlists.sexy.push(response1.tracks.data[t].id);
                    }
                    
                    // rock
                    DZ.api('/playlist/'+idrock+'&access_token='+token, function(response2){                      
                    },function(response2){ 
                        //console.log(response.error);
                        if(!response2.error){
                            //console.log('rock');
                            //console.log(response2);
                            for (var t in response2.tracks.data){
                                playlists.rock.push(response2.tracks.data[t].id);
                            }
                            
                            // lazy
                            DZ.api('/playlist/'+idlazy+'&access_token='+token, function(response3){                      
                            },function(response3){ 
                                //console.log(response.error);
                                if(!response3.error){
                                    //console.log('lazy');
                                    //console.log(response3);
                                    for (var t in response3.tracks.data){
                                        playlists.lazy.push(response3.tracks.data[t].id);
                                    }
                                    //fun
                                    DZ.api('/playlist/'+idfun+'&access_token='+token, function(response4){                      
                                    },function(response4){ 
                                        //console.log(response.error);
                                        if(!response4.error){
                                            //console.log('fun');
                                            //console.log(response4);
                                            for (var t in response4.tracks.data){
                                                playlists.fun.push(response4.tracks.data[t].id);
                                            }
                                            
                                            plstOK = true;
                                            //console.log(playlists);
                                            console.log('playlists chargeees');
                                            
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });

        })
        
        
    }; // fin dzAsyncInit
    
    
    
    (function() {
        var e = document.createElement('script');
        e.src = 'http://cdn-files.deezer.com/js/min/dz.js';
        e.async = true;
        document.getElementById('dz-root').appendChild(e);
    }());
    /*
    Q.read = function (path, timeout) {
      var response = Q.defer();
      var request = new XMLHttpRequest(); // ActiveX blah blah
      request.open("GET", path, true);
      request.onreadystatechange = function () {
          console.log(request.readyState);
          if (request.readyState === 4) {
              if (request.status === 200) {
                  response.resolve(request.responseText);
              } else {
                  response.reject("HTTP " + request.status + " for " + path);
              }
          }
      };
      timeout && setTimeout(response.reject, timeout);
      request.send('');
      return response.promise;
    };
    */
    
    
    document.addEventListener('DOMContentLoaded', function(){
        
        //console.log('DOMContentLoaded');
        
        var produits={sexy:[
                        {num:4,pict:'produits04.png',titre:'Sleek MakeUp - Matte Me Lip Cream',lien:'http://fr.feelunique.com/p/Sleek-Makeup-Matte-Me-Lip-Cream-6ml',prix:'7,00&nbsp;€'},
                        {num:3,pict:'produits03.png',titre:'Paco Rabanne - Lady Million',lien:'http://fr.feelunique.com/p/Paco-Rabanne-Lady-Million-Eau-De-Parfum-Spray-30ml',prix:'53,50&nbsp;€'},
                        {num:2,pict:'produits02.png',titre:'ST. TROPEZ - Classic Bronzing Mousse',lien:'http://fr.feelunique.com/p/St-Tropez-Classic-Bronzing-Mousse-240ml',prix:'44,00&nbsp;€'},
                        {num:1,pict:'produits01.png',titre:'Kérastase - Elixir Ultime Original',lien:'http://fr.feelunique.com/p/Kerastase-Elixir-Ultime-Original-100ml',prix:'33,00&nbsp;€'}

                        ],
                    rock:[
                        {num:8,pict:'produits08.png',titre:'TIGI BED HEAD - Manipulator Matte Wax with Massive Hold',lien:'http://fr.feelunique.com/p/TIGI-Bed-Head-Manipulator-Matte-Wax-with-Massive-Hold-57g',prix:'12,60&nbsp;€'},
                        {num:7,pict:'produits07.png',titre:'Yves Saint Laurent - Black Opium Nuit Blanche',lien:'http://fr.feelunique.com/p/Yves-Saint-Laurent-Black-Opium-Nuit-Blanche-Eau-De-Parfum-30ml',prix:'55,30&nbsp;€'},
                        {num:6,pict:'produits06.png',titre:'RIMMEL - Scandal\'eyes Rockin\' Curves Mascara',lien:'http://fr.feelunique.com/p/Rimmel-Scandaleyes-Rockin-Curves-Mascara-12ml',prix:'9,90&nbsp;€'},
                        {num:5,pict:'produits05.png',titre:'NAILSINC - The Paint Can',lien:'http://fr.feelunique.com/p/nails-inc-The-Paint-Can-Spray-On-Polish-50ml',prix:'14,00&nbsp;€'}
                        ],
                    lazy:[
                        {num:12,pict:'produits12.png',titre:'Macadamia - Deep Repair Masque',lien:'http://fr.feelunique.com/p/Macadamia-Deep-Repair-Masque-250ml',prix:'19,70&nbsp;€'},
                        {num:11,pict:'produits11.png',titre:'Zoella Beauty - Bath Latte',lien:'http://fr.feelunique.com/p/Zoella-Beauty-Bath-Latte-400ml',prix:'5,10&nbsp;€'},
                        {num:10,pict:'produits10.png',titre:'This Works - Deep Sleep Pillow Spray',lien:'http://fr.feelunique.com/p/this-works-Deep-Sleep-Pillow-Spray-75ml',prix:'22,50&nbsp;€'},
                        {num:9,pict:'produits09.png',titre:'Maison Margiela - Lazy Sunday Morning',lien:'http://fr.feelunique.com/p/Maison-Margiela-Replica-Lazy-Sunday-Morning-Eau-de-Toilette-100ml',prix:'89,90&nbsp;€'}
                        ],
                    fun:[
                        {num:16,pict:'produits16.png',titre:'Marc Jacobs - Honey',lien:'http://fr.feelunique.com/p/Marc-Jacobs-Honey-Eau-de-Parfum-50ml',prix:'68,90&nbsp;€'},
                        {num:15,pict:'produits15.png',titre:'Popband - Brighton Rock Hair Ties',lien:'http://fr.feelunique.com/p/Popband-London-Brighton-Rock-Hair-Ties-Multi-Pack',prix:'11,00&nbsp;€'},
                        {num:14,pict:'produits14.png',titre:'Lipstick Queen - Frog Prince Cream Blush',lien:'http://fr.feelunique.com/p/Lipstick-Queen-Frog-Prince-Cream-Blush-22g',prix:'30,90&nbsp;€'},
                        {num:13,pict:'produits13.png',titre:'NYX - Vivid Brights Eyeliner',lien:'http://fr.feelunique.com/p/NYX-Vivid-Brights-Eyeliner-2ml',prix:'7,50&nbsp;€'}
                        ]
                     },
        
        produit = 0, // liste des produits en cours
        curslide = 0, // slide courant dans le carousel
        accordionlazy       = document.getElementById('lazy'),
        accordionsexy       = document.getElementById('sexy'),
        accordionfun        = document.getElementById('fun'),
        accordionrock       = document.getElementById('rock'),
            
        menulazy            = document.getElementById('mlazy'),
        menusexy            = document.getElementById('msexy'),
        menufun             = document.getElementById('mfun'),
        menurock            = document.getElementById('mrock'),
            
        _lift               = document.getElementById('lift'),
        _slider             = document.getElementById('slider'),
        
        oldtrack = 0, // titre des playlist feelunique en cours de lecture
        oldid = 0, // id lien du titre des playlist feelunique en cours de lecture
        
        
        circle  = document.getElementById('circle'),
        coord1  = document.getElementById('coord1'),
        coord2  = document.getElementById('coord2'),
        bulle   = document.getElementById('bulle'),
        btp     = document.getElementById('btplaylist'),
        _btp    = btp.getBoundingClientRect(),   
            
        _pickerx = 0,_pickery = 0,
        
        _x = circle.offsetWidth / 2,
        _y = circle.offsetHeight / 2,
        _radius = circle.offsetWidth / 2,
        rect = circle.getBoundingClientRect(),
        
        picker = document.getElementById('picker'),
        rectp = picker.getBoundingClientRect(),
        _percent = 100,
        _dpercent = _percent/2,

        center = {
            x: rect.left + rect.width / 2,
            y: rect.top + rect.height / 2
        },
            
        dimpicker = {
            w: rectp.width,
            h: rectp.height,
            radius: rectp.width / 2
        },
            
        dimbtp = {
            w: _btp.width,
            h: _btp.height,
            radius: _btp.width / 2
        },
            
        maxcoords = {
            x1: 0,
            y1: dimpicker.radius - rect.height / 2,
            x2: rect.width / 2 - dimpicker.radius,
            y2: 0,
            x3: 0,
            y3: rect.height / 2 - dimpicker.radius,
            x4: dimpicker.radius - rect.width / 2,
            y4: 0
        },    

        rotate = function(x, y){
            var deltaX = x - center.x,
                deltaY = y - center.y,

                angle = Math.atan2(deltaY, deltaX) * 180 / Math.PI;

            // Math.atan2(deltaY, deltaX) => [-PI +PI]
            // We must convert it to deg so...
            // / Math.PI => [-1 +1]
            // * 180 => [-180 +180]

            return angle;
        },
            
        rotate2 = function(x, y){
            var deltaX = x - center.x,
                deltaY = y - center.y,
            // retourne l'angle en degres à partir du milieu gauche = 0
            angle = Math.round(Math.atan2(deltaY, deltaX) * 180 / Math.PI +180);

            return angle;
        },
            
        rotate3 = function(x, y){
            var deltaX = x - center.x,
                deltaY = y - center.y,
            // retourne l'angle en radians à partir du milieu gauche = 0
            angle = Math.atan2(deltaY, deltaX);

            return angle;
        },
            
        // DRAGSTART
        mousedown = function(event){
            event.preventDefault();
            document.body.style.cursor = 'move';
            mousemove(event);
            document.addEventListener('mousemove', mousemove);
            document.addEventListener('mouseup', mouseup);
            document.addEventListener('touchend', mouseup);
            document.addEventListener("touchmove", mousemove, false);
            addAclass('bulle','nodisplay');
            addAclass('btplaylist','novisible');
        },
        
    
        // DRAG
        mousemove = function(event){
            event.preventDefault();
            //if(!plstOK) return;
            //console.log(event);
            /*
            e = event || window.event;
            var target = e.target || e.srcElement;
            */
        
            var x, y;
            //var endAngle;
            if(event.changedTouches){
                x = event.changedTouches[0].clientX;
                y = event.changedTouches[0].clientY;

            }else{
                //console.log(event);
                x = event.x === undefined ? event.clientX : event.x;
                y = event.y === undefined ? event.clientY : event.y;

            }
            
            var pos = Math.round(Math.sqrt((x-center.x)*(x-center.x) + (y-center.y)*(y-center.y)));
           
            //console.log('radius : ' + _radius);
            
              
            //console.log('position : ' + (pos+dimpicker.radius < _radius));
            
            if(pos+dimpicker.radius < _radius){
                
                //console.log('position : ' + pos);
                
                _pickerx = x-center.x;
                _pickery = y-center.y;
            
                picker.style.transform = 'translate(' + (x-center.x-dimpicker.radius) + 'px,' + (y-center.y-dimpicker.radius) + 'px)';
                btp.style.transform = 'translate(' + (x-center.x-dimbtp.radius) + 'px,' + (y-center.y-dimbtp.radius) + 'px)';
                
                picker.style.WebkitTransform = 'translate(' + (x-center.x-dimpicker.radius) + 'px,' + (y-center.y-dimpicker.radius) + 'px)';
                btp.style.WebkitTransform = 'translate(' + (x-center.x-dimbtp.radius) + 'px,' + (y-center.y-dimbtp.radius) + 'px)';
                
                picker.style.msTransform = 'translate(' + (x-center.x-dimpicker.radius) + 'px,' + (y-center.y-dimpicker.radius) + 'px)';
                btp.style.msTransform = 'translate(' + (x-center.x-dimbtp.radius) + 'px,' + (y-center.y-dimbtp.radius) + 'px)';
                //picker.style.transform = 'translate(' + (x-center.x) + 'px,' + (y-center.y) + 'px)';
                
                //console.log(x-center.x);
                //console.log('clientX : ' + event.clientX);
                //console.log('clientY : ' + event.clientY);
                
                //console.log(dimpicker.radius);
                //console.log(rect);
                
            }
            /*
            console.log('picker : ' + _pickerx + ' / ' + _pickery);
            console.log('clientX : ' + event.clientX);
            console.log('eventx : ' + event.x);
            console.log('pos : ' + pos);
            console.log('_radius : ' + _radius);
            */
            //console.log('picker : ' + (x-dimpicker.radius) + ' / ' + (y-dimpicker.radius));
            //console.log(rotate(event.x, event.y));
            //coord1.innerHTML = 'coord end : ' + deg;
            
            //setSelection();

            
        },
          
        // a moi la playlist    
        mousedownbtp = function(evt){
            setPlaylist(_pickerx,_pickery);
        },    

        // DRAGEND
        mouseup = function(event){
            document.body.style.cursor = null;
            document.removeEventListener('mouseup', mouseup);
            document.removeEventListener('mousemove', mousemove);
            document.removeEventListener("touchmove", mousemove);
            removeAclass('btplaylist','novisible');
            btp.addEventListener('mousedown', mousedownbtp);
        },
        
        setSelection = function(){

        },
            
        selecTracks = function(p){
            //console.log(playlists[p]);
            if(playlists[p].length == 0) return;
            var i = Math.floor(Math.random() * nbtracks);
            var idtrack = playlists[p][i];
            var deja = 0;
            for (var t in playlistsR[p]){
                if(playlistsR[p][t] === idtrack){
                    deja = 1;
                }
            }
            if(deja == 0){
                playlistsR[p].push(idtrack);
            }else{
               selecTracks(p); 
            }
            
            if(playlistsR[p].length == nbtracks){
                return;
            }else{
                selecTracks(p);
            }
        },
        
        setPlaylist = function(x,y){
            
            //console.log('x, y : ' + x + ' / ' + y);
            //alert('x, y : ' + x + ' / ' + y);
            
            // poucentage max rock
            //var max1 = y < 0 ? Math.round(y/maxcoords.y1*100) : 0;
            var max1 = y >= 0 ? Math.round(_dpercent - (y * _dpercent)/maxcoords.y3) : Math.round((y * _dpercent)/maxcoords.y1 + _dpercent);
            // poucentage max sexy
            var max2 = x >= 0 ? Math.round(_dpercent - (x * _dpercent)/maxcoords.x2) : Math.round((x * _dpercent)/maxcoords.x4 + _dpercent);
            // poucentage max lazy
            //var max3 = y > 0 ? Math.round(y/maxcoords.y3*100) : 0;
            var max3 = y >= 0 ? Math.round(_dpercent - (y * _dpercent)/maxcoords.y1) : Math.round((y * _dpercent)/maxcoords.y3 + _dpercent);
            // poucentage max fun
            //var max4 = x < 0 ? Math.round(x/maxcoords.x4*100) : 0;
            var max4 = x >= 0 ? Math.round(_dpercent - (x * _dpercent)/maxcoords.x4)  : Math.round((x * _dpercent)/maxcoords.x2 + _dpercent);
                        
        
            // selection les tracks
            playlistsR  = {rock:[],sexy:[],lazy:[],fun:[]};
            
            selecTracks('rock');
            selecTracks('sexy');
            selecTracks('lazy');
            selecTracks('fun');
            
            //console.log('rock p :' + Math.round((max1*20)/100));
            
            
            
            //console.log(playlistsR);
            
            
            // user/{user_id}/playlists params : title
            // cree la playlist
            
            //return; // <<<<<< A COMMENTER !!!!!!!!!!!!!!!
            
           DZ.api('/user/'+idUSER+'/playlists?request_method=POST&title=' + titlplst + '&access_token='+token, function(response){
               // console.log('playlist');
                if(response.id){
                    //
                    var trcks = '';
                    var nbtrcks;
                    var comma = '';
                    idPlaylist = response.id;
                    // ajout des tracks rock
                    nbtrcks = Math.round((max1*20)/100);
                    for(var t = 0; t < nbtrcks; t++){
                        comma = t === 0 ? '' : ',';
                        trcks += comma+playlistsR.rock[t];
                    }
                    // ajout des tracks fun
                    nbtrcks = Math.round((max4*20)/100);
                    for(var t = 0; t < nbtrcks; t++){
                        //comma = t == 0 ? '' : ',';
                        trcks += comma+playlistsR.fun[t];
                    }
                    // ajout des tracks lazy
                    nbtrcks = Math.round((max3*20)/100);
                    for(var t = 0; t < nbtrcks; t++){
                        //comma = t == 0 ? '' : ',';
                        trcks += comma+playlistsR.lazy[t];
                    }
                    
                    // ajout des tracks sexy
                    nbtrcks = Math.round((max2*20)/100);
                    for(var t = 0; t < nbtrcks; t++){
                        //comma = t == 0 ? '' : ',';
                        trcks += comma+playlistsR.sexy[t];
                    }
                    
                   // console.log('tracks :');
                    //console.log(trcks);
                    
                    // ajout titres
                    DZ.api('/playlist/' + idPlaylist + '/tracks?request_method=POST&access_token=' + token + '&songs=' + trcks, function(response2){
                        //console.log(response2);
                        if(response2){
                            DZ.api('/playlist/'+idPlaylist, function(response3){
                                if(response3.error === undefined){
                                    removeAclass('contenu2','novisible');
                                    addAclass('contenu1','novisible');
                                    document.getElementById('generee').innerHTML = '<img src="'+response3.picture_medium+'"/>';
                                    document.getElementById('gfb').href = 'http://www.deezer.com/playlist/' + idPlaylist;
                                }
                            });
                        }
                    });
                }
                
            });
            
        },
                        
        addAclass = function (id, classe){
            document.getElementById(id).classList ? document.getElementById(id).classList.add(classe) : document.getElementById(id).className += ' '+classe;
        },
        
        removeAclass = function(id,classe){
            document.getElementById(id).className = document.getElementById(id).className.replace(' ' + classe, '').replace(classe, '');
        },
                
        listenerAdd = function(id,evt){
            document.getElementById(id).addEventListener = document.getElementById(id).addEventListener || function (e, f) { document.getElementById(id).attachEvent('on' + e, f); };
            document.getElementById(id).addEventListener(evt,function(e){
                e = e || window.event;
                //console.log('prout');
                listen(e,this);
            });
	    },
    
        listen = function(e,t){
            
            if(e.preventDefault){
                    e.preventDefault();
                    e.stopPropagation();
                }else{
                    e.returnValue = false;
                    e.cancelBubble = true;
                }
            //var target = e.target || e.srcElement;
            //console.log('href : '+t.getAttribute('href'));
            //console.log('id : '+t.getAttribute('id'));
            //console.log(t);
            var dest  = t.getAttribute('href');
            var id  = t.getAttribute('id');
            
            var datas = 0;
            
            //console.log(dest);
            
            
            switch(dest){
                case '#currentracks':
                    datas = t.getAttribute('data-idtrck');
                    //console.log('data : ' + datas);
                    playCurTrack(id, datas);
                    break;
                case '#favori':
                    datas = t.getAttribute('data-idz');
                    //console.log('data : ' + datas);
                    addFavori(datas);
                    break;
                case '#suite':
                    changeSlide('suite');
                    break;
                case '#retour':
                    changeSlide('retour');
                    break;
                case '#unique':
                    goSurmesure();
                    break;
                case '#playerplster':
                    playCurplaylist();
                    break;
                case '#facebook':
                    shareFB();
                    break;
                case '#twitter':
                    shareTW();
                    break;
                default:
                    goUnivers(dest);
            }
            
            //return false;
        },
            
        changeSlide = function(s){
            var nb = document.getElementById('slide').children.length-1;
            var cur = nb - curslide;
            //console.log(cur);
            //console.log(curslide);
            switch(s){
                case 'suite':
                    if(cur >= 0){
                        addAclass('produit'+cur,'invisible');
                        curslide = curslide+1>=nb-1 ? nb - 1 : curslide+1;
                        document.getElementById('txtprod').innerHTML = produit[cur-1].titre;
                        document.getElementById('txtprix').innerHTML = produit[cur-1].prix;
                    }
                    break;
                case 'retour':
                    if(cur >= 0){
                        removeAclass('produit'+cur,'invisible');
                        curslide = curslide-1 < 0 ? 0 : curslide-1;
                        document.getElementById('txtprod').innerHTML = produit[cur].titre;
                        document.getElementById('txtprix').innerHTML = produit[cur].prix;
                    }
                    break;
                
            }
            
            
        },
            
        playCurplaylist = function(){
            //console.log(DZ.player.isPlaying());
            if(idPlaylist != 0){
                if(DZ.player.isPlaying()){
                    removeAclass('playerplster','playing');
                    DZ.player.pause();
                }else{
                    addAclass('playerplster','playing');
                    DZ.player.playPlaylist(idPlaylist);
                }
                
            }
        },
            
        playCurTrack = function(i, d){
            if(d != oldtrack){
                if(oldid !== 0) removeAclass(oldid,'playing')
                addAclass(i,'playing');
                DZ.player.playTracks([d]);
                oldtrack = d;
                oldid = i;
            }else{
                removeAclass(i,'playing');
                DZ.player.pause();
                oldtrack = 0;
                oldid = 0;
            }
        },
            
        goSurmesure = function(){
            addAclass('ongletd','vingt');
            removeAclass('surmesure', 'novisible');
            removeAclass('contenu1', 'novisible');
            //if(DZ.player.isPlaying()) DZ.player.pause();
            oldtrack = 0;
            oldid = 0;
        },
                   
        goUnivers = function(u){
            
            //if(DZ.player.isPlaying()) DZ.player.pause();
            //oldtrack = 0;
            oldid = 0;
            
            addAclass('ongletanim','animtranz');
            
            
            removeAclass('univers','lazy');
            removeAclass('univers','sexy');
            removeAclass('univers','fun');
            removeAclass('univers','rock');
            
            removeAclass('accroche','tlazy');
            removeAclass('accroche','tsexy');
            removeAclass('accroche','tfun');
            removeAclass('accroche','trock');
            
            removeAclass('want','wlazy');
            removeAclass('want','wsexy');
            removeAclass('want','wfun');
            removeAclass('want','wrock');
            
            removeAclass('mlazy','actif');
            removeAclass('msexy','actif');
            removeAclass('mfun','actif');
            removeAclass('mrock','actif');
            
            addAclass('contenu1','novisible');
            addAclass('contenu2','novisible');
            addAclass('surmesure','novisible');
            
            curslide = 0;
            
            document.getElementById('playlistdz').innerHTML = '';
            document.getElementById('txtprod').innerHTML = '';
            
            
            var curplst = 0;
            produit = 0;
            
            switch(u){
                case '#lazy':
                    addAclass('univers','lazy');
                    addAclass('accroche','tlazy');
                    addAclass('want','wlazy');
                    addAclass('mlazy','actif');
                    curplst = idlazy;
                    produit = produits.lazy;
                    removeAclass('ongletd','vingt');
                    removeAclass('univers','nodisplay');
                    break;
                case '#sexy':
                    addAclass('univers','sexy');
                    addAclass('accroche','tsexy');
                    addAclass('want','wsexy');
                    addAclass('msexy','actif');
                    curplst = idsexy;
                    produit = produits.sexy;
                    removeAclass('ongletd','vingt');
                    removeAclass('univers','nodisplay');
                    break;
                case '#fun':
                    addAclass('univers','fun');
                    addAclass('accroche','tfun');
                    addAclass('want','wfun');
                    addAclass('mfun','actif');
                    curplst = idfun;
                    produit = produits.fun;
                    removeAclass('ongletd','vingt');
                    removeAclass('univers','nodisplay');
                    break;
                case '#rock':
                    addAclass('univers','rock');
                    addAclass('accroche','trock');
                    addAclass('want','wrock');
                    addAclass('mrock','actif');
                    curplst = idrock;
                    produit = produits.rock;
                    removeAclass('ongletd','vingt');
                    removeAclass('univers','nodisplay');
                    break;
                case '#home':
                    removeAclass('ongletd','vingt');
                    addAclass('univers','nodisplay');
                    //addAclass('surmesure','novisible');
                    //addAclass('contenu1','novisible');
                    //addAclass('contenu2','novisible');
                    break;
            }
            
            
            // chargement produits
            var imgs = '';
            for( var t in produit){
                imgs += '<img src="_produits/' + produit[t].pict +'" id="produit' + t + '" />';
            }
            document.getElementById('slide').innerHTML = imgs;
            document.getElementById('txtprod').innerHTML = produit[t].titre;
            document.getElementById('txtprix').innerHTML = produit[t].prix;
            
            // remise a ero du slider de l'ascenceur
            document.getElementById('slider').style.WebkitTransform = 'translate(0px, 0px)';
            document.getElementById('slider').style.msTransform = 'translate(0px, 0px)';
            document.getElementById('slider').style.transform = 'translate(0px, 0px)';
            
            
            // chargement playlist
            if(curplst != 0){
                DZ.api('/playlist/' + curplst + '&access_token='+token, function(response){                     
                },function(response){
                    document.getElementById('titlep').innerHTML = response.title;
                    document.getElementById('favori').setAttribute('data-idz',response.id);
                    var elems = '<ul id="listetracks">';
                    for (var t = 0; t<response.tracks.data.length; t++){
                        var id      = response.tracks.data[t].id;
                        var imgs    = response.tracks.data[t].album.cover_small;
                        var artist  = response.tracks.data[t].artist.name;
                        var title  = response.tracks.data[t].title_short;
                        console.log(id + ' / ' + oldtrack);
                        var $class = id == oldtrack ? ' class="playing"' : '';
                        elems += '<li><a href="#currentracks" id="tr' + id + '" data-idtrck="'+ id +'"'+ $class +'><img src="' + imgs + '"/><span class="artist">' + artist + '</span> - <span class="song">' + title + '</span></a></li>';
                    };
                    elems += '</ul>';
                    document.getElementById('playlistdz').innerHTML = elems;
                    var nblines = document.getElementById('listetracks').children.length;
                    // ajout event
                    for (var t = 0; t<nblines; t++){
                        var cur = document.getElementById('listetracks').children[t].children[0].getAttribute('id');
                        listenerAdd(cur,'click');
                    }
                });
            };
        },
            
        addFavori = function(d){
            DZ.api('/user/' + idUSER + '/playlists?playlist_id=' + d + '&request_method=POST&access_token='+token, function(response){
                //console.log(response);
            })
        },
        
        // move slide ascenceur
        slideMove = function(event){
            event.preventDefault();
            var x,y;
            var hb  = document.getElementById('lift');
            var sb  = document.getElementById('slider');
            var lst = document.getElementById('listetracks');
            var recthb = hb.getBoundingClientRect();
            var rectsb = sb.getBoundingClientRect();
            var rectlst = lst.getBoundingClientRect();
            var demi = rectsb.height/2;
            if(event.changedTouches){
                x = event.changedTouches[0].clientX;
                y = event.changedTouches[0].clientY;

            }else{
                //console.log(event);
                x = event.x === undefined ? event.clientX : event.x;
                y = event.y === undefined ? event.clientY : event.y;
            }
            
            var yy = y-recthb.top-demi;
            if(yy > 0 && (yy+rectsb.height) < recthb.height){
                //sb.style.transform = 'translate-y(' + (y-recthb.top) + 'px)';
                //console.log('translate(0px,' + (y-recthb.top-demi) + 'px)');
                sb.style.WebkitTransform = 'translate(0px,' + yy + 'px)';
                sb.style.msTransform = 'translate(0px,' + yy + 'px)';
                sb.style.transform = 'translate(0px,' + yy + 'px)';
                // coordonnées ul
                var yl = (yy * rectlst.height) / recthb.height;
                //console.log('yl : ' + yl);
                lst.style.transform = 'translate(0px, ' + (-yl) + 'px)';
            }
        },
        
        // up sur slide ascenceur    
        slideUp = function(event){
            document.removeEventListener('mouseup', slideUp);
            document.removeEventListener('mousemove', slideMove);
            document.removeEventListener("touchmove", slideMove);
        }, 
        // clic slide ascenceur
        slideDown = function(event){
            event.preventDefault();
            //document.body.style.cursor = 'move';
            //mousemove(event);
            document.addEventListener('mousemove', slideMove);
            document.addEventListener('mouseup', slideUp);
            document.addEventListener('touchend', slideUp);
            document.addEventListener("touchmove", slideMove, false);
            
        },
            
        shareFB = function(){
            FB.ui({
                  method: 'feed',
                  name: 'Et vous, quel est votre mood aujourd\'hui ?',
                  link: 'http://www.deezer.com/app/feelunique',
                  picture: 'http://entertainmentggd.com/deezerfeelunique/20160708-feelunique-1200x625.jpg',
                  description: '#Feelunique vient de composer ma playlist parfaite, and i love it',
                  caption: 'Feel Unique'
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
                        //console.log('ok facebook');
                        request=null;
                      },
                      error:function(result){
                        //console.log('error facebook');
                        request=null;
                      }
                    })
                  }
              });
        },
            
        shareTW = function(){
             var width  = 575,
              height = 320,
              left   = 300,
              top    = 200,
              url    = 'https://twitter.com/intent/tweet/?text=Et%20vous,%20quel%20est%20votre%20mood%20aujourd\'hui%20?%20#Feelunique%20vient%20de%20composer%20ma%20playlist%20parfaite,%20and%20i%20love%20it&url=http://www.deezer.com/app/feelunique',
              opts   = 'status=1' +
              ',width='  + width  +
              ',height=' + height +
              ',top='    + top    +
              ',left='   + left;
              window.open(url, 'twitter', opts);
        }
        
        var intAPIdeezer = setInterval(testDeezer,300);
        
        function testDeezer(){
            if(plstOK){
                //setPlaylist(0,0);
                picker.addEventListener('mousedown', mousedown);
                picker.addEventListener('touchstart', mousedown);
                
                _slider.addEventListener('mousedown', slideDown);
               
                // retour hom
                listenerAdd('home','click');
                
                // event click accordion
                listenerAdd('lazy','click');
                listenerAdd('sexy','click');
                listenerAdd('fun','click');
                listenerAdd('rock','click');
                
                // event click menu haut
                /*
                listenerAdd('mlazy','click');
                listenerAdd('msexy','click');
                listenerAdd('mfun','click');
                listenerAdd('mrock','click');
                */
                
                listenerAdd('favori','click');
                
                listenerAdd('suite','click');
                listenerAdd('retour','click');
                
                listenerAdd('unique','click');
                
                listenerAdd('playerplster','click');
                
                listenerAdd('rethome','click');
                
                listenerAdd('facebook','click');
                listenerAdd('twitter','click');
                
                
                /*
                accordionlazy.addEventListener('mousedown', goUnivers);
                accordionsexy.addEventListener('mousedown', goUnivers);
                accordionfun.addEventListener('mousedown', goUnivers);
                accordionrock.addEventListener('mousedown', goUnivers);
                
                menulazy.addEventListener('mousedown', goUnivers);
                menusexy.addEventListener('mousedown', goUnivers);
                menufun.addEventListener('mousedown', goUnivers);
                menurock.addEventListener('mousedown', goUnivers);
                */
                
                
                //console.log('OK ----------------------------------------');
                clearInterval(intAPIdeezer);
                
            }
        }
        
        
        // crentage du picker
        picker.style.transform = 'translate(' + (-dimpicker.radius) + 'px,' + (-dimpicker.radius) + 'px)';
        picker.style.WebkitTransform = 'translate(' + (-dimpicker.radius) + 'px,' + (-dimpicker.radius) + 'px)';
        picker.style.msTransform = 'translate(' + (-dimpicker.radius) + 'px,' + (-dimpicker.radius) + 'px)';
        
        
        document.getElementById('ongletanim').addEventListener("animationend", function(){
            //console.log('transitionend');
            removeAclass('ongletanim','animtranz');
        }, false);
            
        document.getElementById('ongletanim').addEventListener("oAnimationEnd oanimationend", function(){
            removeAclass('ongletanim','animtranz');
        }, false);
            
        document.getElementById('ongletanim').addEventListener("webkitAnimationEnd", function(){
            removeAclass('ongletanim','animtranz');
        }, false);
        
        document.getElementById('ongletanim').addEventListener("MSAnimationEnd", function(){
            removeAclass('ongletanim','animtranz');
        }, false);
        

    // DRAG START

    

    // ENABLE STARTING THE DRAG IN THE BLACK CIRCLE
    /*    
    circle.addEventListener('mousedown', function(event){
        if(event.target == this) mousedown(event);
    });
        
    circle.addEventListener('touchstart', function(event){
        if(event.target == this) mousedown(event);
    });
    */
    //console.log(produits);     
        
    }); // fin DOMContentLoaded
   
   
    
})(); // closure