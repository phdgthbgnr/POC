const cacheName = 'pwa.1.3';

console.log('service worker');
self.addEventListener('install',function(e){
    console.log('install sw', e);
    // install API caches
    // promise en variable pour waitUntil
    const cachePromise = caches.open(cacheName).then(function(cache){
       return cache.addAll([
            'main.js',
            'style.css',
            'vendors/bootstrap.min.css',
            'add_techno.html',
            'database.js',
            'idb.js',
            'add_techno.js',
            'contact.html',
            'contact.js'
        ])
    });

    e.waitUntil(cachePromise);
});

self.addEventListener('activate', function(e){
    console.log('activate sw', e);
    // effacement des anciens caches
    let cacheCleanPromise = caches.keys().then(function(keys){
        keys.forEach(function(key){
            console.log('key ', key);
            if(key !== cacheName){
                return caches.delete(key);
            }
        });
    })
    e.waitUntil(cacheCleanPromise);
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
            console.log('recupere depuis le reseau ',e.request.url);
            caches.open(cacheName).then(function(cache){
                cache.put(e.request, res);
            });
            // retourne clone repponse
            return res.clone();
            // erreur requete reseau -> retourne fichier en cache
        }).catch(function(err){
            console.log('recupere depuis le cache ',e.request.url);
            return caches.match(e.request);
        })
    );


});


// Notification persistante

// self.registration.showNotification('SW notification',
// {
//     body:'je suis une notification persistante', 
//     icon:'images/icons/icon-72x72.png',
//     actions:[{action:'accept', title:'accepter'},{action:'refuse',title:'refuser'}]
// }
// );


// self.addEventListener('notificationclose', function(e){
//     console.log('Notification fermée', e);
// });

// self.addEventListener('notificationclick',function(e){
//     if(e.action === 'accept') {
//         console.log('vous avez accepté');
//     }else if(e.action === 'refuse') {
//         console.log('vous avez refusé')
//     }else{
//         console.log('clic sur le corps de la notif');
//     }
//     e.notification.close();
// });

self.addEventListener('push', function(evt){
    console.log('push ', evt);
    console.log('push data ', evt.data.text());
    evt.waitUntil(self.registration.showNotification('ma notification',
         {body:'une nouvelle notification'}
    ))

})