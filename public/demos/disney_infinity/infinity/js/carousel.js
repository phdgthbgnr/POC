jQuery(document).ready(function($){

  $(window).load(function(){
    // -------------------------------------------------------------------- PRELOAD IMAGES SLIDERS
    var preloadPictures = function(pictureUrls, callback) {
        var i,
        j,
        loaded = false;

        for (i = 0, j = pictureUrls.length; i < j; i++) {
            (function (img, src) {
                img.onload = function () {
                if (++loaded == pictureUrls.length && callback) {
                    callback();
                }else{
                    var wl=Math.round((loaded*100)/pictureUrls.length);
                    //console.log(loaded+' / '+pictureUrls.length+' / '+wl);
                    //jQuery('#percent').html((wl)+' %');
                    wl*=2;
                    //jQuery('#loadlevel').width(wl);
                }
            };

            // Use the following callback methods to debug
            // in case of an unexpected behavior.
            img.onerror = function () {};
            img.onabort = function () {};
            img.src = src;
          } (new Image(), dir_slides+pictureUrls[i]));
        }
    };

    function loadingok(){
        loaded=true;
        //console.log('images chargee');
        var bullets='';
        for (var t in img_sliders){
          var s=parseInt(t);
          s++;
          $('#carousel').append('<li id="sld'+s+'"><img src="'+dir_slides+img_sliders[t]+'"/></li>');
          //bullets+='<li class="bullets"><a href="b'+t+'" class="btbullet"><img src="'+dir_slides+'/bullet_blk.gif"/></a></li>';
        }

        $('#carousel li:first-child img').addClass('nopacity');
        //$('#ubullet').empty().append(bullets);
        $('#sliderloading').attr('src','img/packsaventure/carousel/carouselblank.png');

        $('#btleft').removeClass('novisible');
        $('#btright').removeClass('novisible');

        $('#numimg').html(ind_slide + ' / ' + img_sliders.length);

        return true;
    }

    preloadPictures(img_sliders, loadingok);

    // ------------------------------------------------------------------------------------------

  })

	var totalSlides = img_sliders.length;
	
    $('#btright').click(function(e){
        e.preventDefault();
		var totalSlides = img_sliders.length;
        if(ind_slide<totalSlides){
          $('#sld'+(ind_slide+1)+' img').addClass('fadin');
          $('#sld'+(ind_slide+1)+' img').removeClass('fadout');
          ind_slide++;
          $('#numimg').html(ind_slide + ' / ' + totalSlides);
        }
		else if(ind_slide==totalSlides) {
			$('#sld'+(ind_slide)+' img').addClass('fadout');
			$('#carousel li:not(:first-child) img').removeClass('fadin');
			$('#sld1 img').removeClass('fadout');
			ind_slide = 1;
			$('#numimg').html(ind_slide + ' / ' + totalSlides);
		}
        return false;
    });

    $('#btleft').click(function(e){
		e.preventDefault();
		if(ind_slide>1){
			$('#sld'+(ind_slide)+' img').addClass('fadout');
			$('#sld'+(ind_slide)+' img').removeClass('fadin');
			ind_slide--;
			$('#numimg').html(ind_slide + ' / ' + totalSlides);
		}
		else {
		  $('#sld'+(totalSlides)+' img').addClass('nofade').removeClass('fadout').removeClass('nofade').addClass('fadin');
		  $('#carousel li:not(:last-child) img').removeClass('fadout').addClass('fadin');
		  ind_slide = totalSlides;
		  $('#numimg').html(ind_slide + ' / ' + totalSlides);
		}
      return false;
    });

});
