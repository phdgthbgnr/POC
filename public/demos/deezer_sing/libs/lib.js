(function() {
	function checkIfEBInitialized(event) {
		if (EB.isInitialized()) {
	        initializeCreative();
	    }
	    else {
	        EB.addEventListener(EBG.EventName.EB_INITIALIZED, initializeCreative);
	    }
	}

	window.addEventListener("load", checkIfEBInitialized);

	function redirection (id, url) {
		url = url || "";
		//	console.log("redirection sur " + click);
		EB.clickthrough(id, url);
		if (EB._isLocalMode) {
			window.open(url + "#" + id);
		}
	}

	function initializeCreative() {
		addVideoModule();
		addListeners();
		EB.expand();
	}

	// addVideoModule : ajoute le module de tracking de Sizmek aux videos
	function addVideoModule() {
		var videos = document.getElementsByTagName("video");
		for (var i = 0, len = videos.length; i < len; i++) {
			new EBG.VideoModule(videos[i]);
		}
	}

	function addListeners() {
		document.body.addEventListener("click", checkClickthrough);
	}

	// checkClickthrough permet de gérer la redirection
	function checkClickthrough(event) {
		var target = event.target || event.srcElement;

		var noRedirection = target.getAttribute("data-clickthroughCanceled");
		if (noRedirection === "") {
			return;
		}

		var click = target.getAttribute("data-clickthroughId");
		while (!click && target !== document.body && target.parentNode !== document.body) {
			target = target.parentNode;
			if (target.getAttribute("data-clickthroughNoInherited") === "") {
				return;
			}
			click = target.getAttribute("data-clickthroughId");
		}

		if (click) {
			redirection(click);
		}
	}
})();
