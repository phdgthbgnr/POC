



function tab1(num) {

	if (num == 1 ) {
		$('#tab11').addClass("tabselect");
		$('#tab11box').css({'display': 'block'});
		$('#tab12').removeClass("tabselect");
		$('#tab12box').css({'display': 'none'});
	} 
	else if (num == 2 ) {
		$('#tab12').addClass("tabselect");
		$('#tab12box').css({'display': 'block'});
		$('#tab11').removeClass("tabselect");
		$('#tab11box').css({'display': 'none'});
	}
	
}