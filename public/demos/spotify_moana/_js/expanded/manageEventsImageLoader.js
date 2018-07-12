// polyfill new event pour ie 10 11 ---------------------------------------------------
(function () {
  function CustomEvent ( event, params ) {
    params = params || { bubbles: false, cancelable: false, detail: undefined };
    var evt = document.createEvent( 'CustomEvent' );
    evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
    return evt;
   }

  CustomEvent.prototype = window.Event.prototype;

  window.CustomEvent = CustomEvent;
})();
// ------------------------------------------------------------------------------------

manageEvents = typeof manageEvents !== undefined ? manageEvents : {};

manageEvents.ImageLoader = {
    totImages:0,
    curImage:0,
    $dc:function(id){
        var elem = null;
        if (document.getElementById(id) !== null) elem = document.getElementById(id);
        if(elem == null) elem = document.querySelectorAll(id);
        if(elem == null) console.log('%cERREUR : sélecteur "' + id + '" introuvable / image loader','color:#ff1d00;font-weight:bold');
        return elem;
    },
    listenerAdd:function(id, evt, callback, capture){
        //var elem = id !== window && id !== document && id != '[object HTMLImageElement]' ? this.$dc(id) : id;
        var elem = id !== window && id !== document ? this.$dc(id) : id;
        if( Object.prototype.toString.call(elem) === '[object NodeList]' ) {
            this.totImages = elem.length;
            for (var n = 0; n < elem.length; n++){
                /*
                console.log('##########################################');
                console.log(elem[n].complete);
                console.log(elem[n].height);
                console.log('##########################################');
                */
                if(elem[n].complete){
                    //var e = evt || window.event;
                    this.curImage = n;//++;
                    try{
                        if (callback) callback(new Event('load'), elem[n], this, this.curImage, this.totImages);
                    }catch(e){
                        //console.log(e);
                        //console.log('ie 10 11 new event inconnu 1 : on bascule sur le polyfill');
                        if (callback) callback(CustomEvent('load'), elem[n], this,  this.curImage, this.totImages);
                    }
                }else{
                    if (elem[n].complete === false && elem[n].naturalHeight > 0){ // bug ie10  complete == false mais image chargée
                        this.curImage = n;//++;
                        try{
                            if (callback) callback(new Event('load'), elem[n], this, this.curImage, this.totImages);
                            //return;
                        }catch(e){
                            //console.log(e);
                            //console.log('ie 10 11 new event inconnu 2 : on bascule sur le polyfill (+ bug complete)');
                            if (callback) callback(CustomEvent('load'), elem[n], this,  this.curImage, this.totImages);
                            //return;
                        }
                    }else{
                       // this.curImage = n;//++;
                        manageEvents.listenerAdd(elem[n], evt, callback, capture, this.curImage, this.totImages);
                    }
                }
            }
        }else{
            console.log('%cERREUR : l\'element "' + id + '" n\'est pas du type NodeList / image loader','color:#ff1d00;font-weight:bold');
        }
       
    }
}
