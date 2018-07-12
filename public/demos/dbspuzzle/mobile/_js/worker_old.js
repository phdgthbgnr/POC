var _wdropTouchcoord = {};
onmessage = function(e) {
    switch(e.data[0]){
        case 'init':
        _wdropTouchcoord = e.data[1];
        // console.log('ok ', _wdropTouchcoord);
        break;
        case 'testover':
        // console.log('testover', e.data[1].x, e.data[1].y, e.data[1].w, e.data[1].h);
        var m = e.data[1];
        var offset = 10;
        var ret = null;
        for(var i in _wdropTouchcoord){
            k = _wdropTouchcoord[i];
            if(
                ((m.x+offset > k.x+offset && m.x-offset < k.x+k.w-offset ) && 
                (m.y+offset > k.y+offset && m.y-offset < k.y+k.h-offset ))
            ) ret = i;
            // if((k.x < m.x && k.x+k.w >m.x) && (k.y < m.y && k.y+k.h > m.y)) console.log('OVER ', i);
        }
        postMessage(ret)
        break;
    }
    // postMessage(workerResult);
  }

  