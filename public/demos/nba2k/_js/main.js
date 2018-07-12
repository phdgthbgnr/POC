var manageEvents={myevents:new Array,$dc:function(e){var t=null;return null!==document.getElementById(e)&&(t=document.getElementById(e)),null==t&&console.log('%cERREUR : id "'+e+'" introuvable',"color:#ff1d00;font-weight:bold"),t},listen:function(e,t,n,o,r){e=e||window.event,n&&(e.preventDefault?(e.preventDefault(),e.stopPropagation()):(e.returnValue=!1,e.cancelBubble=!0));var i=e.target||e.srcElement;t&&t(e,i,o,r)},listenerAdd:function(e,t,n,o,r,i){var c=e!==window&&e!==document&&"[object HTMLImageElement]"!=e?this.$dc(e):e;try{c.addEventListener=c.addEventListener||function(e,t){c.attachEvent("on"+e,t)},c.addEventListener(t,function(c){manageEvents.myevents._addEvt({id:e,evt:t,event:arguments.callee}),manageEvents.listen(c,n,o,r,i)},!1),c.removeEventListener=c.removeEventListener||function(e,t){c.detachEvent("on"+e,t)}}catch(v){console.log('%cERREUR : id "'+e+'" introuvable',"color:#ff4e00;font-weight:bold"),console.log(v),console.log("%c---------------------------","color:#ff4e00")}},listenerRemove:function(e,t){var n=this.myevents._remEvt({id:e,evt:t}),o=e!==window&&e!==document?this.$dc(e):e;if(n)try{o.removeEventListener(t,n)}catch(r){console.log('%cERREUR : id "'+e+'" introuvable',"color:#ff4e00"),console.log(r),console.log("%c---------------------------","color:#ff4e00")}}};Array.prototype._addEvt||(Array.prototype._addEvt=function(e){res=!1;for(var t in this)this[t].id==e.id&&this[t].evt==e.evt&&(res=!0);res||this.push(e)}),Array.prototype._remEvt||(Array.prototype._remEvt=function(e){var t=!1,n=this._searchEvt(e);if(-1!=n){var t=this[n];this.splice(n,1)}return"object"==typeof t?t.event:!1}),Array.prototype._searchEvt||(Array.prototype._searchEvt=function(e,t){t=t||0;for(var n=this.length;n>t;){if(this[t].id===e.id&&this[t].evt===e.evt)return t;++t}return-1});

!function(t){"use strict";if("function"==typeof bootstrap)bootstrap("promise",t);else if("object"==typeof exports&&"object"==typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define(t);else if("undefined"!=typeof ses){if(!ses.ok())return;ses.makeQ=t}else{if("undefined"==typeof window&&"undefined"==typeof self)throw new Error("This environment was not anticipated by Q. Please file a bug.");var n="undefined"!=typeof window?window:self,e=n.Q;n.Q=t(),n.Q.noConflict=function(){return n.Q=e,this}}}(function(){"use strict";function t(t){return function(){return J.apply(t,arguments)}}function n(t){return t===Object(t)}function e(t){return"[object StopIteration]"===et(t)||t instanceof L}function r(t,n){if(V&&n.stack&&"object"==typeof t&&null!==t&&t.stack&&-1===t.stack.indexOf(rt)){for(var e=[],r=n;r;r=r.source)r.stack&&e.unshift(r.stack);e.unshift(t.stack);var i=e.join("\n"+rt+"\n");t.stack=o(i)}}function o(t){for(var n=t.split("\n"),e=[],r=0;r<n.length;++r){var o=n[r];c(o)||i(o)||!o||e.push(o)}return e.join("\n")}function i(t){return-1!==t.indexOf("(module.js:")||-1!==t.indexOf("(node.js:")}function u(t){var n=/at .+ \((.+):(\d+):(?:\d+)\)$/.exec(t);if(n)return[n[1],Number(n[2])];var e=/at ([^ ]+):(\d+):(?:\d+)$/.exec(t);if(e)return[e[1],Number(e[2])];var r=/.*@(.+):(\d+)$/.exec(t);return r?[r[1],Number(r[2])]:void 0}function c(t){var n=u(t);if(!n)return!1;var e=n[0],r=n[1];return e===H&&r>=_&&st>=r}function s(){if(V)try{throw new Error}catch(t){var n=t.stack.split("\n"),e=n[0].indexOf("@")>0?n[1]:n[2],r=u(e);if(!r)return;return H=r[0],r[1]}}function f(t,n,e){return function(){return"undefined"!=typeof console&&"function"==typeof console.warn&&console.warn(n+" is deprecated, use "+e+" instead.",new Error("").stack),t.apply(t,arguments)}}function p(t){return t instanceof h?t:g(t)?E(t):S(t)}function a(){function t(t){n=t,p.longStackSupport&&V&&(i.source=t),W(e,function(n,e){p.nextTick(function(){t.promiseDispatch.apply(t,e)})},void 0),e=void 0,r=void 0}var n,e=[],r=[],o=Z(a.prototype),i=Z(h.prototype);if(i.promiseDispatch=function(t,o,i){var u=K(arguments);e?(e.push(u),"when"===o&&i[1]&&r.push(i[1])):p.nextTick(function(){n.promiseDispatch.apply(n,u)})},i.valueOf=function(){if(e)return i;var t=v(n);return m(t)&&(n=t),t},i.inspect=function(){return n?n.inspect():{state:"pending"}},p.longStackSupport&&V)try{throw new Error}catch(u){i.stack=u.stack.substring(u.stack.indexOf("\n")+1)}return o.promise=i,o.resolve=function(e){n||t(p(e))},o.fulfill=function(e){n||t(S(e))},o.reject=function(e){n||t(R(e))},o.notify=function(t){n||W(r,function(n,e){p.nextTick(function(){e(t)})},void 0)},o}function l(t){if("function"!=typeof t)throw new TypeError("resolver must be a function.");var n=a();try{t(n.resolve,n.reject,n.notify)}catch(e){n.reject(e)}return n.promise}function d(t){return l(function(n,e){for(var r=0,o=t.length;o>r;r++)p(t[r]).then(n,e)})}function h(t,n,e){void 0===n&&(n=function(t){return R(new Error("Promise does not support operation: "+t))}),void 0===e&&(e=function(){return{state:"unknown"}});var r=Z(h.prototype);if(r.promiseDispatch=function(e,o,i){var u;try{u=t[o]?t[o].apply(r,i):n.call(r,o,i)}catch(c){u=R(c)}e&&e(u)},r.inspect=e,e){var o=e();"rejected"===o.state&&(r.exception=o.reason),r.valueOf=function(){var t=e();return"pending"===t.state||"rejected"===t.state?r:t.value}}return r}function y(t,n,e,r){return p(t).then(n,e,r)}function v(t){if(m(t)){var n=t.inspect();if("fulfilled"===n.state)return n.value}return t}function m(t){return t instanceof h}function g(t){return n(t)&&"function"==typeof t.then}function k(t){return m(t)&&"pending"===t.inspect().state}function w(t){return!m(t)||"fulfilled"===t.inspect().state}function j(t){return m(t)&&"rejected"===t.inspect().state}function b(){ot.length=0,it.length=0,ct||(ct=!0)}function x(t,n){ct&&("object"==typeof process&&"function"==typeof process.emit&&p.nextTick.runAfter(function(){-1!==X(it,t)&&(process.emit("unhandledRejection",n,t),ut.push(t))}),it.push(t),n&&"undefined"!=typeof n.stack?ot.push(n.stack):ot.push("(no stack) "+n))}function T(t){if(ct){var n=X(it,t);-1!==n&&("object"==typeof process&&"function"==typeof process.emit&&p.nextTick.runAfter(function(){var e=X(ut,t);-1!==e&&(process.emit("rejectionHandled",ot[n],t),ut.splice(e,1))}),it.splice(n,1),ot.splice(n,1))}}function R(t){var n=h({when:function(n){return n&&T(this),n?n(t):this}},function(){return this},function(){return{state:"rejected",reason:t}});return x(n,t),n}function S(t){return h({when:function(){return t},get:function(n){return t[n]},set:function(n,e){t[n]=e},"delete":function(n){delete t[n]},post:function(n,e){return null===n||void 0===n?t.apply(void 0,e):t[n].apply(t,e)},apply:function(n,e){return t.apply(n,e)},keys:function(){return nt(t)}},void 0,function(){return{state:"fulfilled",value:t}})}function E(t){var n=a();return p.nextTick(function(){try{t.then(n.resolve,n.reject,n.notify)}catch(e){n.reject(e)}}),n.promise}function O(t){return h({isDef:function(){}},function(n,e){return C(t,n,e)},function(){return p(t).inspect()})}function Q(t,n,e){return p(t).spread(n,e)}function N(t){return function(){function n(t,n){var u;if("undefined"==typeof StopIteration){try{u=r[t](n)}catch(c){return R(c)}return u.done?p(u.value):y(u.value,o,i)}try{u=r[t](n)}catch(c){return e(c)?p(c.value):R(c)}return y(u,o,i)}var r=t.apply(this,arguments),o=n.bind(n,"next"),i=n.bind(n,"throw");return o()}}function D(t){p.done(p.async(t)())}function P(t){throw new L(t)}function A(t){return function(){return Q([this,I(arguments)],function(n,e){return t.apply(n,e)})}}function C(t,n,e){return p(t).dispatch(n,e)}function I(t){return y(t,function(t){var n=0,e=a();return W(t,function(r,o,i){var u;m(o)&&"fulfilled"===(u=o.inspect()).state?t[i]=u.value:(++n,y(o,function(r){t[i]=r,0===--n&&e.resolve(t)},e.reject,function(t){e.notify({index:i,value:t})}))},void 0),0===n&&e.resolve(t),e.promise})}function U(t){if(0===t.length)return p.resolve();var n=p.defer(),e=0;return W(t,function(r,o,i){function u(t){n.resolve(t)}function c(t){e--,0===e&&(t.message="Q can't get fulfillment value from any promise, all promises were rejected. Last error message: "+t.message,n.reject(t))}function s(t){n.notify({index:i,value:t})}var f=t[i];e++,y(f,u,c,s)},void 0),n.promise}function F(t){return y(t,function(t){return t=Y(t,p),y(I(Y(t,function(t){return y(t,q,q)})),function(){return t})})}function M(t){return p(t).allSettled()}function B(t,n){return p(t).then(void 0,void 0,n)}function $(t,n){return p(t).nodeify(n)}var V=!1;try{throw new Error}catch(G){V=!!G.stack}var H,L,_=s(),q=function(){},z=function(){function t(){for(var t,r;e.next;)e=e.next,t=e.task,e.task=void 0,r=e.domain,r&&(e.domain=void 0,r.enter()),n(t,r);for(;c.length;)t=c.pop(),n(t);o=!1}function n(n,e){try{n()}catch(r){if(u)throw e&&e.exit(),setTimeout(t,0),e&&e.enter(),r;setTimeout(function(){throw r},0)}e&&e.exit()}var e={task:void 0,next:null},r=e,o=!1,i=void 0,u=!1,c=[];if(z=function(t){r=r.next={task:t,domain:u&&process.domain,next:null},o||(o=!0,i())},"object"==typeof process&&"[object process]"===process.toString()&&process.nextTick)u=!0,i=function(){process.nextTick(t)};else if("function"==typeof setImmediate)i="undefined"!=typeof window?setImmediate.bind(window,t):function(){setImmediate(t)};else if("undefined"!=typeof MessageChannel){var s=new MessageChannel;s.port1.onmessage=function(){i=f,s.port1.onmessage=t,t()};var f=function(){s.port2.postMessage(0)};i=function(){setTimeout(t,0),f()}}else i=function(){setTimeout(t,0)};return z.runAfter=function(t){c.push(t),o||(o=!0,i())},z}(),J=Function.call,K=t(Array.prototype.slice),W=t(Array.prototype.reduce||function(t,n){var e=0,r=this.length;if(1===arguments.length)for(;;){if(e in this){n=this[e++];break}if(++e>=r)throw new TypeError}for(;r>e;e++)e in this&&(n=t(n,this[e],e));return n}),X=t(Array.prototype.indexOf||function(t){for(var n=0;n<this.length;n++)if(this[n]===t)return n;return-1}),Y=t(Array.prototype.map||function(t,n){var e=this,r=[];return W(e,function(o,i,u){r.push(t.call(n,i,u,e))},void 0),r}),Z=Object.create||function(t){function n(){}return n.prototype=t,new n},tt=t(Object.prototype.hasOwnProperty),nt=Object.keys||function(t){var n=[];for(var e in t)tt(t,e)&&n.push(e);return n},et=t(Object.prototype.toString);L="undefined"!=typeof ReturnValue?ReturnValue:function(t){this.value=t};var rt="From previous event:";p.resolve=p,p.nextTick=z,p.longStackSupport=!1,"object"==typeof process&&process&&process.env&&process.env.Q_DEBUG&&(p.longStackSupport=!0),p.defer=a,a.prototype.makeNodeResolver=function(){var t=this;return function(n,e){n?t.reject(n):arguments.length>2?t.resolve(K(arguments,1)):t.resolve(e)}},p.Promise=l,p.promise=l,l.race=d,l.all=I,l.reject=R,l.resolve=p,p.passByCopy=function(t){return t},h.prototype.passByCopy=function(){return this},p.join=function(t,n){return p(t).join(n)},h.prototype.join=function(t){return p([this,t]).spread(function(t,n){if(t===n)return t;throw new Error("Q can't join: not the same: "+t+" "+n)})},p.race=d,h.prototype.race=function(){return this.then(p.race)},p.makePromise=h,h.prototype.toString=function(){return"[object Promise]"},h.prototype.then=function(t,n,e){function o(n){try{return"function"==typeof t?t(n):n}catch(e){return R(e)}}function i(t){if("function"==typeof n){r(t,c);try{return n(t)}catch(e){return R(e)}}return R(t)}function u(t){return"function"==typeof e?e(t):t}var c=this,s=a(),f=!1;return p.nextTick(function(){c.promiseDispatch(function(t){f||(f=!0,s.resolve(o(t)))},"when",[function(t){f||(f=!0,s.resolve(i(t)))}])}),c.promiseDispatch(void 0,"when",[void 0,function(t){var n,e=!1;try{n=u(t)}catch(r){if(e=!0,!p.onerror)throw r;p.onerror(r)}e||s.notify(n)}]),s.promise},p.tap=function(t,n){return p(t).tap(n)},h.prototype.tap=function(t){return t=p(t),this.then(function(n){return t.fcall(n).thenResolve(n)})},p.when=y,h.prototype.thenResolve=function(t){return this.then(function(){return t})},p.thenResolve=function(t,n){return p(t).thenResolve(n)},h.prototype.thenReject=function(t){return this.then(function(){throw t})},p.thenReject=function(t,n){return p(t).thenReject(n)},p.nearer=v,p.isPromise=m,p.isPromiseAlike=g,p.isPending=k,h.prototype.isPending=function(){return"pending"===this.inspect().state},p.isFulfilled=w,h.prototype.isFulfilled=function(){return"fulfilled"===this.inspect().state},p.isRejected=j,h.prototype.isRejected=function(){return"rejected"===this.inspect().state};var ot=[],it=[],ut=[],ct=!0;p.resetUnhandledRejections=b,p.getUnhandledReasons=function(){return ot.slice()},p.stopUnhandledRejectionTracking=function(){b(),ct=!1},b(),p.reject=R,p.fulfill=S,p.master=O,p.spread=Q,h.prototype.spread=function(t,n){return this.all().then(function(n){return t.apply(void 0,n)},n)},p.async=N,p.spawn=D,p["return"]=P,p.promised=A,p.dispatch=C,h.prototype.dispatch=function(t,n){var e=this,r=a();return p.nextTick(function(){e.promiseDispatch(r.resolve,t,n)}),r.promise},p.get=function(t,n){return p(t).dispatch("get",[n])},h.prototype.get=function(t){return this.dispatch("get",[t])},p.set=function(t,n,e){return p(t).dispatch("set",[n,e])},h.prototype.set=function(t,n){return this.dispatch("set",[t,n])},p.del=p["delete"]=function(t,n){return p(t).dispatch("delete",[n])},h.prototype.del=h.prototype["delete"]=function(t){return this.dispatch("delete",[t])},p.mapply=p.post=function(t,n,e){return p(t).dispatch("post",[n,e])},h.prototype.mapply=h.prototype.post=function(t,n){return this.dispatch("post",[t,n])},p.send=p.mcall=p.invoke=function(t,n){return p(t).dispatch("post",[n,K(arguments,2)])},h.prototype.send=h.prototype.mcall=h.prototype.invoke=function(t){return this.dispatch("post",[t,K(arguments,1)])},p.fapply=function(t,n){return p(t).dispatch("apply",[void 0,n])},h.prototype.fapply=function(t){return this.dispatch("apply",[void 0,t])},p["try"]=p.fcall=function(t){return p(t).dispatch("apply",[void 0,K(arguments,1)])},h.prototype.fcall=function(){return this.dispatch("apply",[void 0,K(arguments)])},p.fbind=function(t){var n=p(t),e=K(arguments,1);return function(){return n.dispatch("apply",[this,e.concat(K(arguments))])}},h.prototype.fbind=function(){var t=this,n=K(arguments);return function(){return t.dispatch("apply",[this,n.concat(K(arguments))])}},p.keys=function(t){return p(t).dispatch("keys",[])},h.prototype.keys=function(){return this.dispatch("keys",[])},p.all=I,h.prototype.all=function(){return I(this)},p.any=U,h.prototype.any=function(){return U(this)},p.allResolved=f(F,"allResolved","allSettled"),h.prototype.allResolved=function(){return F(this)},p.allSettled=M,h.prototype.allSettled=function(){return this.then(function(t){return I(Y(t,function(t){function n(){return t.inspect()}return t=p(t),t.then(n,n)}))})},p.fail=p["catch"]=function(t,n){return p(t).then(void 0,n)},h.prototype.fail=h.prototype["catch"]=function(t){return this.then(void 0,t)},p.progress=B,h.prototype.progress=function(t){return this.then(void 0,void 0,t)},p.fin=p["finally"]=function(t,n){return p(t)["finally"](n)},h.prototype.fin=h.prototype["finally"]=function(t){if(!t||"function"!=typeof t.apply)throw new Error("Q can't apply finally callback");return t=p(t),this.then(function(n){return t.fcall().then(function(){return n})},function(n){return t.fcall().then(function(){throw n})})},p.done=function(t,n,e,r){return p(t).done(n,e,r)},h.prototype.done=function(t,n,e){var o=function(t){p.nextTick(function(){if(r(t,i),!p.onerror)throw t;p.onerror(t)})},i=t||n||e?this.then(t,n,e):this;"object"==typeof process&&process&&process.domain&&(o=process.domain.bind(o)),i.then(void 0,o)},p.timeout=function(t,n,e){return p(t).timeout(n,e)},h.prototype.timeout=function(t,n){var e=a(),r=setTimeout(function(){n&&"string"!=typeof n||(n=new Error(n||"Timed out after "+t+" ms"),n.code="ETIMEDOUT"),e.reject(n)},t);return this.then(function(t){clearTimeout(r),e.resolve(t)},function(t){clearTimeout(r),e.reject(t)},e.notify),e.promise},p.delay=function(t,n){return void 0===n&&(n=t,t=void 0),p(t).delay(n)},h.prototype.delay=function(t){return this.then(function(n){var e=a();return setTimeout(function(){e.resolve(n)},t),e.promise})},p.nfapply=function(t,n){return p(t).nfapply(n)},h.prototype.nfapply=function(t){var n=a(),e=K(t);return e.push(n.makeNodeResolver()),this.fapply(e).fail(n.reject),n.promise},p.nfcall=function(t){var n=K(arguments,1);return p(t).nfapply(n)},h.prototype.nfcall=function(){var t=K(arguments),n=a();return t.push(n.makeNodeResolver()),this.fapply(t).fail(n.reject),n.promise},p.nfbind=p.denodeify=function(t){if(void 0===t)throw new Error("Q can't wrap an undefined function");var n=K(arguments,1);return function(){var e=n.concat(K(arguments)),r=a();return e.push(r.makeNodeResolver()),p(t).fapply(e).fail(r.reject),r.promise}},h.prototype.nfbind=h.prototype.denodeify=function(){var t=K(arguments);return t.unshift(this),p.denodeify.apply(void 0,t)},p.nbind=function(t,n){var e=K(arguments,2);return function(){function r(){return t.apply(n,arguments)}var o=e.concat(K(arguments)),i=a();return o.push(i.makeNodeResolver()),p(r).fapply(o).fail(i.reject),i.promise}},h.prototype.nbind=function(){var t=K(arguments,0);return t.unshift(this),p.nbind.apply(void 0,t)},p.nmapply=p.npost=function(t,n,e){return p(t).npost(n,e)},h.prototype.nmapply=h.prototype.npost=function(t,n){var e=K(n||[]),r=a();return e.push(r.makeNodeResolver()),this.dispatch("post",[t,e]).fail(r.reject),r.promise},p.nsend=p.nmcall=p.ninvoke=function(t,n){var e=K(arguments,2),r=a();return e.push(r.makeNodeResolver()),p(t).dispatch("post",[n,e]).fail(r.reject),r.promise},h.prototype.nsend=h.prototype.nmcall=h.prototype.ninvoke=function(t){var n=K(arguments,1),e=a();return n.push(e.makeNodeResolver()),this.dispatch("post",[t,n]).fail(e.reject),e.promise},p.nodeify=$,h.prototype.nodeify=function(t){return t?void this.then(function(n){p.nextTick(function(){t(null,n)})},function(n){p.nextTick(function(){t(n)})}):this},p.noConflict=function(){throw new Error("Q.noConflict only works when Q is used as a global")};var st=s();return p});

manageEvents=void 0!==typeof manageEvents?manageEvents:{};try{if("function"!=typeof Q)throw"Q promises introuvable !";manageEvents=void 0!==typeof manageEvents?manageEvents:{},manageEvents.promises=Q,manageEvents.promises.httpRequest=function(e,n,t){var o=this.defer(),s=new XMLHttpRequest;return s.open(n,e,!0),s.onprogress=function(e){o.notify(e.loaded/e.total)},s.onreadystatechange=function(){4===s.readyState&&(200===s.status?o.resolve(s.responseText):o.reject("HTTP "+s.status+" for "+e))},t&&setTimeout(function(){o.reject("timeout expired")},t),s.send(""),o.promise},manageEvents.promises.selectionne=function(e){var n=this.defer(),t=manageEvents.$dc(e),o=0;return t.onchange=function(e){console.log(o),e=e||window.event;var t=e.target||e.srcElement;o=t.value,n.notify(t.value)},n.promise},manageEvents.promises.animation=function(e){this.defer(),manageEvents.$dc(e)}}catch(err){console.log("Erreur : "+err)}


(function(){

    // FB ---------------------------------------------------------------------------------------------------------------
    function logintoFB(){
            FB.login(function(response){
                if(response.status=='connected'){
                    FB.api('/me', { locale: 'fr_FR', fields: 'first_name, last_name, name, email' }, function(response) {
                        //console.log(response);
                        if(response.name && response.email){
                            
                            document.getElementById('nom').value = response.last_name;
                            document.getElementById('prenom').value = response.first_name;
                            document.getElementById('mail').value = response.email;
                            document.getElementById('fbinscr').value = 1;
                            document.getElementById('labelform').innerHTML = 'Merci de valider';
                            document.getElementById("reglement").checked = true;
                           //var datas = 'action=inscription&nom=' + response.last_name + '&prenom=' + response.first_name + '&mail=' + response.email + '&reglement=1&fbinscr=1&token='+token;
                           //sendData(datas,1);
                       }
                    });
                }
            },  {
                scope: 'public_profile, email',
                return_scopes: true
            });

            return false;
        }

        function logoutFB(){
            FB.logout(function(response) {
          // user is now logged out
        });

        }


      window.fbAsyncInit = function() {
          /*
          var fid = '0';
          switch(window.location.hostname){
            case 'demo.greengardendigital.com':
                fid = '680086685500035';
                break;
              case 'jeu-concoursnba2kdev.2kweb.online':
                  fid = '878258412309056';
                  break;
              case 'jeu-concoursnba2k.com':
                  fid = '837137913089670';
                  break;
          }
          */

          FB.init({
            appId      : fid,
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.7' // use graph api version 2.5
          });
      };


      // Load the SDK asynchronously
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      // Here we run a very simple test of the Graph API after login is
      // successful.  See statusChangeCallback() for when this call is made.
      function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
          console.log('Successful login for: ' + response.name);
          document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
        });
      }

    // END FB ------------------------------------------------------------------------------------------------------


    Q.read = function (path, data, timeout){
        var response = Q.defer();
        var request = new XMLHttpRequest(); // ActiveX blah blah
        request.open("POST", path, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.setRequestHeader("Content-length", data.length);
        //request.send(data);
        request.onreadystatechange = function () {
            //console.log(request.readyState);
            //console.log(request.status);
            if (request.readyState === 4) {
                if (request.status === 200) {
                    response.resolve(request.responseText);
              } else {
                  response.reject("HTTP " + request.status + " for " + path);
              }
          }
      };
      timeout && setTimeout(response.reject, timeout);
      //request.send();
      request.send(data);
      return response.promise;
    };

    var quests={quest1:[
        {question :'Paul George est un joueur All-Star. Combien de fois a-t\’il été sélectionné pour le All-Star Games ?'},
        {reponses:[
        {num:1, reponse : 'Quatre fois'},
        {num:2, reponse : 'Trois fois'},
        {num:3, reponse : 'Deux fois'}]
        }],
        quest2:[
        {question : '&Agrave; quel poste évolue Paul George ?'},
        {reponses:[
        {num:1, reponse : 'Ailier'},
        {num:2, reponse : 'Meneur'},
        {num:3, reponse : 'Pivot'}]
        }],
        quest3:[
        {question : 'Quel est le surnom de Kobe Bryant :'},
        {reponses:[
        {num:1, reponse : 'The Black Mambo'},
        {num:2, reponse : 'Dany Bryant'},
        {num:3, reponse : 'The Black Mamba'}]
        }]},

        curquest = 0,   // index courant [0-2]
        resultats = [{},{},{}],
        sending = false,
        fberr = 0,

        $ID = function(id){
            var elem = null;
            if (document.getElementById(id) !== null) elem = document.getElementById(id);
            if(elem == null) console.log('%cERREUR : id "' + id + '" introuvable','color:#ff1d00;font-weight:bold');
            return elem;
        },

        addAclass = function (id, classe){
            $ID(id).classList ? $ID(id).classList.add(classe) : $ID(id).className += ' '+classe;
        },

        removeAclass = function(id,classe){
            $ID(id).className = $ID(id).className.replace(' ' + classe, '').replace(classe, '');
        },

    	hasAClass = function(id, cls) {
    		var element = $ID(id);
    		return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    	},

        shuffle = function(array){
            var currentIndex = array.length, temporaryValue, randomIndex;
            // While there remain elements to shuffle...
            while (0 !== currentIndex) {
                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;
                // And swap it with the current element.
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }
          return array;
        },

        inscription = function(e,t){

            var frm = $ID('formulaire');
            var datas = serialize(frm);
            var error = false;
            if(datas.length < 5) error = true;
            for(var t=0; t<datas.length; t++){
                var c = datas[t];
                if(c=='mail=' || c=='prenom=' ||c=='nom=') error = true;
            }
            $ID('erreurs').innerHTML = '';
            if(!error){
                datas = datas.join('&');
                datas += '&fbinscr=0';
                sendData(datas,0);
                /*
                for(var t=0; t<resultats.length;t++){
                    datas += '&' + resultats[t].question + '=' + resultats[t].reponses;
                }
                //datas += '&reponses='+resultats;
                Q.read('_inc/ajax.php', datas, 10000).then(function(e){
                    //var res = JSON.parse(e);
                }).fail(function(e){
                  console.log(e);
                });
                */
            }else{
                $ID('erreurs').innerHTML = 'Merci de renseigner tous les champs';
            }
            return false;

        },

        sendData = function(datas,fb){
            if (sending) return;
            fberr = fb;
            sending = true;
            $ID('erreurs').innerHTML = '';
            for(var t=0; t < resultats.length;t++){
                    datas += '&' + resultats[t].question + '=' + resultats[t].reponses;
                }
                //datas += '&reponses='+resultats;
                //var ajaxtarget = '_inc/ajax.php';
                //if(window.location.hostname == 'jeu-concoursnba2kdev.2kweb.online') ajaxtarget = 'https://jeu-concoursnba2kdev.2kweb.online/_inc/ajax.php';
                Q.read('_inc/ajax.php', datas, 10000).then(function(e){
                    sending = false;
                    try{
                        var res = JSON.parse(e);
                        if(res.length == 1) $ID('erreurs').innerHTML = 'Une erreur est survenue';
                        if(res.length ==  2 && fberr == 0){
                            switch(res[1]){
                                case 'ok' :
                                    removeAclass('page5','novisible');
                                    addAclass('page4','novisible');
                                    break;
                                case 'sql':
                                    $ID('erreurs').innerHTML = 'Erreur à l\'enregistrement<br/>Merci de réessayer';
                                    grecaptcha.reset();
                                    break;
                                case 'mail1':
                                    $ID('erreurs').innerHTML = 'Une adresse mail est obligatoire';
                                    grecaptcha.reset();
                                    break;
                                case 'mail2':
                                    $ID('erreurs').innerHTML = 'Une adresse mail valide est obligatoire';
                                    grecaptcha.reset();
                                    break;
                                case 'mail3':
                                    $ID('erreurs').innerHTML = 'Adresse mail déjà présente';
                                    grecaptcha.reset();
                                    break;
                                case 'nom':
                                    $ID('erreurs').innerHTML = 'Merci de renseigner votre nom';
                                    break;
                                case 'prenom':
                                    $ID('erreurs').innerHTML = 'Merci de renseigner votre prénom';
                                    grecaptcha.reset();
                                    break;
                                case 'reglement':
                                    $ID('erreurs').innerHTML = 'Merci de cocher l\'acceptation des termes et conditions du réglement';
                                    grecaptcha.reset();
                                    break;
								case 'captcha':
                                    $ID('erreurs').innerHTML = 'Merci d\'utiliser le captcha';
                                    break;
								case 'captcha2':
                                case 'captcha3':
                                case 'captcha4':
                                    $ID('erreurs').innerHTML = 'Erreur dans le captcha';
                                    grecaptcha.reset();
                                    break;
                            }
                        }
                        if(res.length ==  2 && fberr == 1){
                            switch(res[1]){
                                case 'mail3':
                                    $ID('erreursfb').innerHTML = 'Adresse mail déjà présente';
                                    break;
                                case 'ok' :
                                    removeAclass('page5','novisible');
                                    addAclass('page4','novisible');
                                    break;
                                default :
                                    $ID('erreursfb').innerHTML = 'Inscription avec Facebook impossible<br/>Merci d\'utiliser le formulaire';
                                    break;
                            }
                        }
                    }catch(e){
                        $ID('erreurs').innerHTML = 'Une erreur est survenue';
                    }
                }).fail(function(e){
                  sending = false;
                  console.log(e);
            });
        },

        checkquest = function(ar){
            var t = 0;
            for(var i=0; i<ar.length; i++){
                if(resultats[i].question){
                    t++;
                }
            }
            return t;
        },

        jouer = function(e,t){
            //curqcm = questions[curquest];
             //$ID('question1').innerHTML = '';
            addAclass('page0','novisible');
            removeAclass('page1','novisible');
            player.stopVideo();
            return false;
        },

        reponse = function(e,t){
            var resq = t.getAttribute('data-question');
            var resr = t.getAttribute('data-reponse');
            var id = t.getAttribute('id');
            var res={'question':resq,'reponses':resr};
            var pnode = t.parentElement.parentElement;
            for (var n = 0; n < pnode.children.length; n++){
                var ahref = pnode.childNodes[n].childNodes[0].getAttribute('id');
                removeAclass(ahref,'checked');
            }
            //console.log(t.parentElement.parentElement.children.length);
            switch(resq){
              case 'quest1':
                resultats[0]=res;
                addAclass(id,'checked');
              break;
              case 'quest2':
                resultats[1]=res;
                addAclass(id,'checked');
              break;
              case 'quest3':
                resultats[2]=res;
                addAclass(id,'checked');
              break;
            }
            return false;
        },

        continuer = function(e,t){
            if(checkquest(resultats) == 1){
                addAclass('page1','novisible');
                removeAclass('page2','novisible');
            }

            if(checkquest(resultats) == 2){
                addAclass('page2','novisible');
                removeAclass('page3','novisible');
            }

            if(checkquest(resultats) == 3){
                addAclass('page3','novisible');
                removeAclass('page4','novisible');
            }
            return false;
        },

        shareFB = function(){
            FB.ui({
                  method: 'share',
                  href: fbhref,
                  /*
                  name: 'Et vous, quel est votre mood aujourd\'hui ?',
                  link: 'http://www.deezer.com/app/feelunique',
                  picture: 'http://entertainmentggd.com/deezerfeelunique/20160708-feelunique-1200x625.jpg',
                  description: 'Je viens de composer ma playlist parfaite avec #Feelunique and I love it !',
                  */
                  caption: 'Jeu Concours NBA2k17'
              },function(d){
                  // nothing
              });
            return false;
        },

        shareTW = function(){
             var width  = 575,
              height = 320,
              left   = 300,
              top    = 200,
              url    = 'https://twitter.com/intent/tweet/?text=Jouez%20et%20tentez%20de%20remporter%20un%20séjour%20à%20Miami%20avec%20@NBA2K17%20et%20@Hypergames%20%23ContestNBA2K17&url='+fbhref,
			  opts   = 'status=1' +
              ',width='  + width  +
              ',height=' + height +
              ',top='    + top    +
              ',left='   + left;
              window.open(url, 'twitter', opts);
        };


        manageEvents.listenerAdd(document,'DOMContentLoaded', function(e,t){

            // shuffle questions
            var questions = shuffle(['quest1','quest2','quest3']),
            curquestion = questions[0],
            curquestrep = quests[curquestion],
            // shuffle reponses
            reponses = shuffle(curquestrep[1].reponses);

            // question1
            $ID('question1').innerHTML = curquestrep[0].question;
            var elem = '';
            for(var t=0; t<reponses.length; t++){
                elem += '<li><a href="#rep' + reponses[t].num + '" data-reponse="' + reponses[t].num + '" data-question="' + curquestion + '" id="reponse' + t + '">' + reponses[t].reponse + '</a></li>';
            }
            $ID('reponses1').innerHTML = elem;

            // question2
            curquestion = questions[1];
            curquestrep = quests[curquestion];
            reponses = shuffle(curquestrep[1].reponses);
            $ID('question2').innerHTML = curquestrep[0].question;
            var elem = '';
            for(var t=0; t<reponses.length; t++){
                elem += '<li><a href="#rep' + reponses[t].num + '" data-reponse="' + reponses[t].num + '" data-question="' + curquestion + '" id="reponse' + (t+3) + '">' + reponses[t].reponse + '</a></li>';
            }
            $ID('reponses2').innerHTML = elem;


            // question3
            curquestion = questions[2];
            curquestrep = quests[curquestion];
            reponses = shuffle(curquestrep[1].reponses);
            $ID('question3').innerHTML = curquestrep[0].question;
            var elem = '';
            for(var t=0; t<reponses.length; t++){
                elem += '<li><a href="#rep' + reponses[t].num + '" data-reponse="' + reponses[t].num + '" data-question="' + curquestion + '" id="reponse' + (t+6) + '">' + reponses[t].reponse + '</a></li>';
            }
            $ID('reponses3').innerHTML = elem;


            manageEvents.listenerAdd('inscrire','click', inscription, true);

            manageEvents.listenerAdd('jouer','click', jouer, true);

            manageEvents.listenerAdd('continuer1','click', continuer, true);
            manageEvents.listenerAdd('continuer2','click', continuer, true);
            manageEvents.listenerAdd('continuer3','click', continuer, true);

            manageEvents.listenerAdd('loginFB','click', logintoFB, true);

            manageEvents.listenerAdd('sharefb','click', shareFB, true);
            manageEvents.listenerAdd('sharetwt','click', shareTW, true);

            for(var i = 0; i <= 8; i++){
                manageEvents.listenerAdd('reponse'+i,'click', reponse, true);
            }

        },true);


        function serialize(form) {
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


})()
