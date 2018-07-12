this._wdropTouchcoord = {};
onmessage = function(e) {
    switch(e.data[0]){
        case 'init':
        this._wdropTouchcoord = e.data[1];
        // console.log('ok ', _wdropTouchcoord);
        break;
        case 'testover':
        // console.log('testover', e.data[1].x, e.data[1].y, e.data[1].w, e.data[1].h);
        var m = e.data[1],
        // offset = 10;
        ret = null,
        allowDrop = false, // test si tous les emplacements sont remplis (noAllowDrop = true)
        d1x = m.x,
        d1y = m.y,
        d1xMax = m.x+m.w,
        d1yMax = m.y+m.h,
        xyoverlap = 0,
        overlap = 0,
        inSurface = 0,
        testFull = 0;
        
        for(var i in this._wdropTouchcoord){
            // allowDrop = false;
            k = this._wdropTouchcoord[i];
            var d2x = k.x, 
            d2y = k.y, 
            d2xMax = k.x+k.w,
            d2yMax = k.y+k.h,
            // calcul overlap
            x_overlap = Math.max(0, Math.min(d1xMax,d2xMax) - Math.max(d1x,d2x))
            y_overlap = Math.max(0, Math.min(d1yMax,d2yMax) - Math.max(d1y,d2y));

            overlap = x_overlap*y_overlap;

            if(overlap > 0) inSurface = 1;
           
            if(overlap > 0 && overlap > xyoverlap && k.reveal == false){
                xyoverlap = overlap;
                ret = i;
            }
        }
        // pas dans la surface on renvoie : null
        if(inSurface == 0) ret = null; // inutile : pour debug
        // dans la surface mais emplacement occupé : false
        if((inSurface == 1) && (ret === null)) ret = false;

        postMessage(ret)
        break;
    }
    // postMessage(workerResult);
  }

  