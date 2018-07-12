/* globals com, mmmLib, cc, EB */

/** README FIRST !
 * cc : this global variable list all creatives elements tagged width data-cc
 * -- ad api --
 * mmmLib.ad.startVideo(cc.video) : display and launch banner video playback
 * mmmLib.ad.startVideo(cc.videoExpand) : display and launch launch expand video playback
 *   note that cc.videoWrapper & cc.videoExpandWrapper are by defautl setted to display:none
 * mmmLib.ad.expand()   : expand the ad
 * mmmLib.ad.collapse() : collapse the ad
 * mmmLib.ad.getCurrentScenario() : return current scenari modulo capping
 * -- ad status --
 * mmmLib.ad.status.isCollapsed
 * mmmLib.ad.status.isAtTheEnd
 * mmmLib.ad.status.currentCapping
 * -- video api sample --
 * cc.video.currentTime = n : seek banner video
 * cc.videoExpand.pause() : pause expand video
 */

function onStartAd() {
	console.log('[crea]  : onStartAd (code here) ');
	cc.banner.style.display = 'block'; //banner is hide via css
	//initAnim();
}

function initAnim() {
	console.log('[crea]  : initAnim (code here) ');
	cc.play2.style.display = 'none';
	//cc.caption.style.display = 'none';
	mmmLib.ad.startVideo(cc.video);
}

function onVideoEnd() {
	console.log('[crea]  : onVideoEnd (code here) ');
}

function onReplayAd() {
	initAnim();
}

//clickTag management : default url & metrics labels
function clickthrough(e) {
	console.log('[crea]  : clickthrough ( set clicks labels here) ');
	/*
	if (EB._isLocalMode) {
		window.open('http://www.massmotionmedia.fr/fr/#' + e.target.id);
	}
	else
	{*/
		console.log('ID: '+e.target.id);
		switch (e.target.id) {
			case 'video':
				EB.clickthrough('video');
			break;
			case 'play2':
				initAnim();
			break;
			default:
				EB.clickthrough(); //#banner,#losange...
		}
	//}
}

//Instanciation & config settings #doNotRemove
mmmLib = new com.massmotionmedia.ad({
	videoAlpha: 0.3,
	injectSvg: true
});

//Click management #doNotRemove
mmmLib.ad.event.on('CLICK_AD', clickthrough);

//Scenario management #editCarrefully
mmmLib.ad.event.on('START_AD', onStartAd);
mmmLib.ad.event.on('VIDEO_END', onVideoEnd);
mmmLib.ad.event.on('REPLAY_AD', onReplayAd);
