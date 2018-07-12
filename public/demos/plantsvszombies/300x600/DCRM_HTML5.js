// JavaScript Document
//HTML5 Ad Template JS from DoubleClick by Google

var container_dc;
var content_dc;
var exitBtn;



dcrmInit = function(){
	
	container_dc = document.getElementById('container_dc');
	//content_dc = document.getElementById('content_dc');
	exitBtn = document.getElementById('exit_btn');
	
	// Added Listeners
	addListeners();

}


addListeners = function (){
	exitBtn.addEventListener('click', onExitHandler, false);
}



onExitHandler = function(e){
	Enabler.exit('HTML5_Background_Clickthrough');
}



window.onload = function() {
  /* Initialize Enabler */
  if (Enabler.isInitialized()) {
    dcrmInit();
  } else {
    Enabler.addEventListener(studio.events.StudioEvent.INIT, dcrmInit);
  }
}
  
