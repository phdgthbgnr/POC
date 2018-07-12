
(function () {
    
    
    'use strict';
    
    var playlists={cocooning:[],chiling:[],party:[],working:[]};
    
    var _cocooning, _chiling, _party, _working;
    
    var token;
    
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
            console.log('sdk_options : ');
            console.log(sdk_options.token.accessToken);
            token = sdk_options.token.accessToken;
            // chiling
            DZ.api('/playlist/1979353542', function(response1){                     
            },function(response1){
                //console.log(response.error);
                if(!response1.error){
                    //console.log('chiling');
                    //console.log(response1);
                    for (var t in response1.tracks.data){
                        playlists.chiling.push(response1.tracks.data[t].id);
                    }
                    
                    // cocooning
                    DZ.api('/playlist/1979398162', function(response2){                      
                    },function(response2){ 
                        //console.log(response.error);
                        if(!response2.error){
                            //console.log('cocooning');
                            //console.log(response2);
                            for (var t in response2.tracks.data){
                                playlists.cocooning.push(response2.tracks.data[t].id);
                            }
                            
                            // party
                            DZ.api('/playlist/1979410182', function(response3){                      
                            },function(response3){ 
                                //console.log(response.error);
                                if(!response3.error){
                                    //console.log('party');
                                    //console.log(response3);
                                    for (var t in response3.tracks.data){
                                        playlists.party.push(response3.tracks.data[t].id);
                                    }
                                    //working
                                    DZ.api('/playlist/1979405942', function(response4){                      
                                    },function(response4){ 
                                        //console.log(response.error);
                                        if(!response4.error){
                                            //console.log('working');
                                            //console.log(response4);
                                            for (var t in response4.tracks.data){
                                                playlists.working.push(response4.tracks.data[t].id);
                                            }
                                            //console.log(playlists);
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
            
   
            
        })
    };
    
    (function() {
        var e = document.createElement('script');
        e.src = 'http://cdn-files.deezer.com/js/min/dz.js';
        e.async = true;
        document.getElementById('dz-root').appendChild(e);
        //console.log(e);
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
        
        
        
        /*
        // cocooning
        Q.read('http://api.deezer.com/playlist/1979398162',10000).then(function(e){
            var myjson = JSON.parse(e);
            console.log(myjson);
            alert('cocooning');
        }).fail(function(e){
            console.log(e);
            alert('erreur chargement cocooning');
        });
        */
        
        /*
        DZ.ready(function(sdk_options){
            console.log('sdk_options : ');
            console.log(sdk_options);
            // chiling
            DZ.api('/playlist/1979353542', function(response){                      
            },function(response){ 
                //console.log(response.error);
                console.log(response);
                if(!response.error){
                    console.log(response);
                }
            });
            
            // cocooning
            DZ.api('/playlist/1979398162', function(response){                      
            },function(response){ 
                //console.log(response.error);
                if(!response.error){
                    console.log(response);
                }
            });
            
            // party
            DZ.api('/playlist/1979410182', function(response){                      
            },function(response){ 
                //console.log(response.error);
                if(!response.error){
                    console.log(response);
                }
            });
            
            //working
            DZ.api('/playlist/1979405942', function(response){                      
            },function(response){ 
                //console.log(response.error);
                if(!response.error){
                    console.log(response);
                }
            });
            
        });
        */
        
        
        var circle = document.getElementById('circle'),
        coord1 = document.getElementById('coord1'),
        coord2 = document.getElementById('coord2'),
        canvas = document.getElementById('myCanvas'),
        context = canvas.getContext('2d'),
        
        _x = canvas.width / 2,
        _y = canvas.height / 2,
        _radius = 140,
        _counterClockwise = false,
        
        picker = document.getElementById('picker'),
        pickerCircle = picker.firstElementChild,
        rect = circle.getBoundingClientRect(),
        picker2 = document.getElementById('picker2'), 
        pickerCircle2 = picker2.firstElementChild, 
        startAngle,
        endAngle,
        _linewidth = 9,
        _deg1, _deg2,
        
        // angle de depart de chaque segment en degré
        _cocooning = 45,
        _working = 135,
        _party = 225,
        _chiling = 315,
            
        // longueur des segments en degré
        _courbe = 45,

        center = {
            x: rect.left + rect.width / 2,
            y: rect.top + rect.height / 2
        },

        rotate = function(x, y){
            var deltaX = x - center.x,
                deltaY = y - center.y,

            // The atan2 method returns a numeric value between -pi and pi representing the angle theta of an (x,y) point.
            // This is the counterclockwise angle, measured in radians, between the positive X axis, and the point (x,y).
            // Note that the arguments to this function pass the y-coordinate first and the x-coordinate second.
            // atan2 is passed separate x and y arguments, and atan is passed the ratio of those two arguments.
            // * from Mozilla's MDN

            // Basically you give it an [y, x] difference of two points and it give you back an angle
            // The 0 point of the angle is right (the initial position of the picker is also right)

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
        },
        
        mousedown2 = function(event){
            event.preventDefault();
            document.body.style.cursor = 'move';
            mousemove2(event);
            document.addEventListener('mousemove', mousemove2);
            document.addEventListener('mouseup', mouseup);
            document.addEventListener('touchend', mouseup);
            document.addEventListener("touchmove", mousemove2, false);
        },
    
        // DRAG
        mousemove = function(event){
            event.preventDefault();
            //console.log(event);
            /*
            e = event || window.event;
            var target = e.target || e.srcElement;
            */
            
            var deg;
            //var endAngle;
            if(event.changedTouches){
                deg = rotate2(event.changedTouches[0].clientX,event.changedTouches[0].clientY);
                picker.style.transform = 'rotate(' + rotate(event.changedTouches[0].clientX,event.changedTouches[0].clientY) + 'deg)';
                //target.style.transform = 'rotate(' + rotate(event.changedTouches[0].clientX,event.changedTouches[0].clientY) + 'deg)';
                endAngle = rotate3(event.changedTouches[0].clientX,event.changedTouches[0].clientY);
            }else{
                //console.log(event);
                var x = event.x === undefined ? event.clientX : event.x;
                var y = event.y === undefined ? event.clientY : event.y;
                deg = rotate2(x, y);
                picker.style.transform = 'rotate(' + rotate(x, y) + 'deg)';
                picker.style.msTransform = 'rotate(' + rotate(x, y) + 'deg)';
                //target.style.transform = 'rotate(' + rotate(event.x, event.y) + 'deg)';
                endAngle = rotate3(x, y);
            }
        
            //console.log(rotate(event.x, event.y));
            coord1.innerHTML = 'coord end : ' + deg;
            _deg2 = deg;
            //startAngle = 1.1 * Math.PI;
            //var endAngle = rotate3(event.x, event.y);//1.9 * Math.PI;
            
            setAngle();
            //console.log('endAngle : ' + endAngle);
            
        },
            
        mousemove2 = function(event){
            event.preventDefault();
            //console.log(event);
            /*
            e = event || window.event;
            var target = e.target || e.srcElement;
            */
            
            var deg;
            //var endAngle;
            if(event.changedTouches){
                deg = rotate2(event.changedTouches[0].clientX,event.changedTouches[0].clientY);
                picker2.style.transform = 'rotate(' + rotate(event.changedTouches[0].clientX,event.changedTouches[0].clientY) + 'deg)';
                //target.style.transform = 'rotate(' + rotate(event.changedTouches[0].clientX,event.changedTouches[0].clientY) + 'deg)';
                startAngle = rotate3(event.changedTouches[0].clientX,event.changedTouches[0].clientY);
            }else{
                var x = event.x === undefined ? event.clientX : event.x;
                var y = event.y === undefined ? event.clientY : event.y;
                deg = rotate2(x, y);
                picker2.style.transform = 'rotate(' + rotate(x, y) + 'deg)';
                picker2.style.msTransform = 'rotate(' + rotate(x, y) + 'deg)';
                //target.style.transform = 'rotate(' + rotate(event.x, event.y) + 'deg)';
                startAngle = rotate3(x, y);
            }
        
            //console.log(rotate(event.x, event.y));
            coord2.innerHTML = 'coord start : ' + deg; 
            _deg1 = deg;
            //var startAngle = 1.1 * Math.PI;
            //var endAngle = rotate3(event.x, event.y);//1.9 * Math.PI;
            setAngle();
            //console.log('startAngle : ' + startAngle);
    
        },

        // DRAGEND
        mouseup = function(){
            document.body.style.cursor = null;
            document.removeEventListener('mouseup', mouseup);
            document.removeEventListener('mousemove', mousemove);
            document.removeEventListener('mousemove', mousemove2);
            document.removeEventListener("touchmove", mousemove);
            document.removeEventListener("touchmove", mousemove2);
            console.log('mouseup');
            setPlaylist();
        },
        
        setAngle = function(){
            context.clearRect(0, 0, context.canvas.width, context.canvas.height);
            context.beginPath();
            context.arc(_x, _y, _radius, startAngle, endAngle, _counterClockwise);
            context.lineWidth = _linewidth;
            
            context.strokeStyle = '#fff';
            context.stroke();
        },
        
        setPlaylist = function(){
            console.log('fin : ' + _deg2);
            console.log('deb : ' + _deg1);
            var direction = startAngle - endAngle;
            console.log('direction : ' + direction);
            // on prend la valeur à l'extérieur des points
            if (direction > 0){
                if(_deg1 > _deg2){
                    var debut = _deg2
                }
            }
            
            // on prend la valeur à l'intérieur des points
            if(direction < 0){
            }
        };
        
    
        picker.style.transform = 'rotate(45deg)';
        picker2.style.transform = 'rotate(210deg)';
        startAngle = -2.6;
        endAngle = .7;
        setAngle();
        _deg2 = 225;
        _deg1 = 30;
        setPlaylist();
        



    // DRAG START
    pickerCircle.addEventListener('mousedown', mousedown);
    pickerCircle.addEventListener('touchstart', mousedown);
        
    pickerCircle2.addEventListener('mousedown', mousedown2);
    pickerCircle2.addEventListener('touchstart', mousedown2);  
        

    // ENABLE STARTING THE DRAG IN THE BLACK CIRCLE
    /*    
    circle.addEventListener('mousedown', function(event){
        if(event.target == this) mousedown(event);
    });
        
    circle.addEventListener('touchstart', function(event){
        if(event.target == this) mousedown(event);
    });
    */
        
        
})

})();