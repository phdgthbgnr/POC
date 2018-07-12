// JavaScript Document
// JavaScript Document
//HTML5 Ad Template JS from DoubleClick by Google

//Declaring elements from the HTML i.e. Giving them Instance Names like in Flash - makes it easier
var dcAd = {};

//Function to run with any animations starting on load, or bringing in images etc
dcAd.setObjects = function() {
	
	//Assign All the elements to the element on the page
	dcAd.container = document.getElementById('container_dc');
	dcAd.bgExit = document.getElementById('background_exit_dc');
	
	dcAd.addListeners();
}

//Add Event Listeners
dcAd.addListeners = function() {
	dcAd.bgExit.addEventListener('click', dcAd.bgExitHandler , false);
}

//exits
dcAd.bgExitHandler = function(e) {
	dcAd.enablerExit(dcAd.ON_BG_EXIT);
}


//Function to call for Custom Exit Tracking - using switch method
dcAd.enablerExit = function(type) {
	switch (type) {
		case dcAd.ON_BG_EXIT:
			Enabler.exit('HTML5_Background_Clickthrough');
			break;
	}
}

window.onload = function() {
	if (Enabler.isInitialized()) {
		dcAd.setObjects();
	} else { 
		Enabler.addEventListener(studio.events.StudioEvent.INIT, dcAd.setObjects);
	}
}


