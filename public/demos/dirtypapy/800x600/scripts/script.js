var timeUntilAutoCollapse = 0; // Use 0 for no timeout
var autoCollapseTimeout;
var cancelAutoCollapseOnUserInteraction = true;
var lockScrollingWhenExpanded = true;
var isAndroid2 = (/android 2/i).test(navigator.userAgent);
var android2ResizeTimeout;

window.addEventListener("load", checkIfEBIsInitialized);
window.addEventListener("message", onMessageReceived);

function checkIfEBIsInitialized() {
	if (EB.isInitialized()) {
		startAd();
	}
	else {
		EB.addEventListener(EBG.EventName.EB_INITIALIZED, startAd);
	}
}

function startAd() {
	initializeCustomVariables();
	addEventListeners();
	expand();
}

function initializeCustomVariables() {
	if (!EB._isLocalMode && EB._adConfig.customJSVars) {
		var customVariables = EB._adConfig.customJSVars;

		if (EBG.isNumber(customVariables.mdTimeUntilAutoCollapse)) {
			timeUntilAutoCollapse = customVariables.mdTimeUntilAutoCollapse;
		}

		if (EBG.isBool(customVariables.mdLockScrollingWhenExpanded)) {
			lockScrollingWhenExpanded = customVariables.mdLockScrollingWhenExpanded;
		}

		if (EBG.isBool(customVariables.mdCancelAutoCollapseOnUserInteraction)) {
			cancelAutoCollapseOnUserInteraction = customVariables.mdCancelAutoCollapseOnUserInteraction;
		}
	}
}


function addEventListeners() {
	document.getElementById("close-button").addEventListener("click", collapse, false);
	document.getElementById("user-action-button").addEventListener("click", userAction, false);
	document.getElementById("clickthrough-button").addEventListener("click", clickthrough, false);

	if (cancelAutoCollapseOnUserInteraction) {
		var ad = document.getElementById("ad");

		ad.addEventListener("mousedown", cancelAutoCollapse);
		ad.addEventListener("touchstart", cancelAutoCollapse);
	}
}

function userAction(event) {
	EB.userActionCounter("UserAction");
}

function clickthrough(event) {
	EB.clickthrough();
}

function cancelAutoCollapse(event) {
	clearTimeout(autoCollapseTimeout);
	event.currentTarget.removeEventListener("mousedown", cancelAutoCollapse);
	event.currentTarget.removeEventListener("touchstart", cancelAutoCollapse);
}

function expand() {
	EB.expand({
		actionType: EBG.ActionType.AUTO
	});

	if (lockScrollingWhenExpanded) {
		preventPageScrolling();
	}
	
	if (timeUntilAutoCollapse > 0){
		autoCollapseTimeout = setTimeout(collapse, timeUntilAutoCollapse);
	}
}

function preventPageScrolling() {
	document.addEventListener("touchmove", stopScrolling);
}

function stopScrolling(event) {
	event.preventDefault();
}

function collapse(event) {
	EB.collapse();

	if (lockScrollingWhenExpanded) {
		allowPageScrolling();
	}
	
	removeAd();
}

function allowPageScrolling() {
	document.removeEventListener("touchmove", stopScrolling);
}

function removeAd() {
	document.getElementById("ad").style.display = "none";

	var message = {
		adId: getAdID(),
		type: "removeAd"
	};

	window.parent.postMessage(JSON.stringify(message), "*");
}

function getAdID() {
	if (EB._isLocalMode) {
		return null;
	}
	else {
		return EB._adConfig.adId;
	}
}

function onMessageReceived(event) {
	try {
		var messageData = JSON.parse(event.data);

		if (messageData.adId && messageData.adId === getAdID()) {
			if (messageData.type && messageData.type === "resize") {
				if (isAndroid2) {
					forceResizeOnAndroid2();
				}
			}
		}
	}
	catch (error) {
		EBG.log.debug(error);
	}
}

function forceResizeOnAndroid2() {
	document.body.style.opacity = 0.99;
	clearTimeout(android2ResizeTimeout);
	android2ResizeTimeout = setTimeout(function() {
		document.body.style.opacity = 1;
		document.body.style.height = window.innerHeight;
		document.body.style.width = window.innerWidth;
	}, 200);
}