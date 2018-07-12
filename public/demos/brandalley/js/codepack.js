// JavaScript Document




$(document).ready(function() {

	var current;

	if(current==undefined) current=$('.active').attr('href');
    
	$("#nike-header").animate({height:"463px"}, 500);
	$(".logo-header").animate({opacity:"1"}, 3000);
	$(".txt-header").delay(500).animate({opacity:"1"}, 2000);
	$("#bienvenue a").delay(1000).animate({opacity:"1", marginTop:"25px"}, 2000);



	$("#women-01, #women-02, #women-03, #women-04").hover(function () {
        $(this).find("#bloc").animate({width: 'toggle'});
    });
	
	

	
	
	
    //AFFICHE LES TABS BLOGGUEUSE
    //$("li.tabContent").not(":first").hide(); 
    // adding Active class to first selected tab and show 
     
 
    // Click event on tab
    $("a.puce-link").click(function() {
        // Removing class of Active tab
        
        // hiding all the tab contents
        $("li.tabContent").hide();        
        // showing the clicked tab's content using fading effect
		//$($('a',this).attr("href")).fadeIn('slow'); 
        var num=$(this).attr("href");
		num=num.substr(5);
		//console.log(num);
		//$('#prod'+num).show(); 
        var tp=$('#slide').offset().top;
        $('html, body').animate({scrollTop:tp }, 'slow');
		$('#prod'+num).fadeIn('slow');
 
        return false;
    });
	
	/*
	//AFFICHE LES POPUP PRODUITS
    $("#produits").not(":first").hide(); 
    // adding Active class to first selected tab and show 
    $("div#produits:first").addClass("active").show();  
 
    // Click event on tab
    $("ul.btn-menu-women li").hover(function() {
        // Removing class of Active tab
        $("ul.btn-menu-women li.active").removeClass("active"); 
        // Adding Active class to Clicked tab
        $(this).addClass("active"); 
        // hiding all the tab contents
        $(".tabContent").hide();        
        // showing the clicked tab's content using fading effect
		//$($('a',this).attr("href")).fadeIn('slow'); 
        $($('a',this).attr("href")).fadeIn('slow'); 
 
        return false;
    });
	*/
	$('.menu').each(function(){
        $(this).unbind('click');
		$(this).click(function(){
		var num=$(this).attr('href');
		num=num.substr(1);
		var fic='women'+num+'.html';
		var slide='pages/slide'+num+'.html';
        var d = new Date();
        var n = d.getTime();
		//console.log(fic+' '+slide);
		$.ajax({
			url:fic,
			dataType:'html'
			}).done(function(dt){
				$('#nike-content').empty().append(dt);
                var tp=$('#nike-content').offset().top;
                tp-=6;
                $('html, body').animate({scrollTop:tp }, 'slow');
            
				$.ajax({
				url:slide+'?'+n,
				dataType:'html'
				}).done(function(dt){
					$('#contenua').empty().append(dt);
                    $('#prod1').css('display','block');
                    $('#prod1').show(); 
				});
			});
			return false;
		
		});
	
	});
	
	$('.ssmenu').each(function(){
        $(this).unbind('click');
		$(this).unbind('hover');
		$(this).click(function(){
            var num=$(this).attr('href');
			current=num;
            num=num.substr(1);
            var fic='women'+num+'.html';
            var slide='pages/slide'+num+'.html';
            var d = new Date();
            var n = d.getTime();
            //console.log(fic+' '+slide);

                    $.ajax({
                    url:slide+'?'+n,
                    dataType:'html'
                    }).done(function(dt){
                        //console.log(' contenua '+$('#contenua').children().length);
                        $('#contenub').empty().append(dt);
                        $('#contenub').css('opacity',1);
                        $('#contenub').addClass('contenuanim');
                        $('#contenub').css('left',0);
						// special ie8 ----------------------
						if( $("html").hasClass("ie8") || $("html").hasClass("ie9") ) {
							$('#contenua').replaceWith('<div id="contenua">'+$('#contenub').html()+'</div>');
                            $('#contenub').empty();
							 //alert('ie8') 
						};
						// ----------------------------------
                        $('#contenub').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
                            $('#prod1').show(); 
                            $('#contenub').removeClass('contenuanim');
                            $('#contenua').replaceWith('<div id="contenua">'+$('#contenub').html()+'</div>');
                            $('#contenub').empty();
                            $('#contenub').css('left','974px');
                            $('#contenub').css('opacity',0);
                            $('#prod1').css('display','block');
                            $('#prod1').show(); 
                            $('#contenub').unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
                        });
                    });

            return false;
		
		});
		
		//console.log(current);
		
		$(this).hover(function()
		{

			$('.ssmenu').each(function(){
				if($(this).attr('href')==current) $(this).removeClass('active');
			});
		},function(){
		$('.ssmenu').each(function(){
				if($(this).attr('href')==current) $(this).addClass('active');
			});
		});
	
	});
	 //console.log(current);
	 //if( $("html").hasClass("ie9") ) { alert('ie9') };
 
});


