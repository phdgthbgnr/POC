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

// self.addEventListener('activate', function(e){
//     console.log('activate sw', e);
//     // effacement des anciens caches
//     let cacheCleanPromise = caches.keys().then(function(keys){
//         keys.forEach(function(key){
//             console.log('key ', key);
//             if(key !== cacheName){
//                 return caches.delete(key);
//             }
//         });
//     })
//     e.waitUntil(cacheCleanPromise);
// });


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
