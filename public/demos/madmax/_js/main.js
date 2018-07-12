var current='';
var pagevideo=0;
var old='';
var sjs;


jQuery(window).load(function() {
    //console.log('loaded');
   // jQuery('#loader').css('display','none');
});

jQuery(document).ready(function($){
    
    //console.log('ready');
    
    $('#menu li a').each(function(){
        $(this).click(function(e){
            var m=$(this).attr('id');
            current=m;
            reinitmenu(m);
            return false;
        });
    });
    
    
    $('.fermer').click(function(e){
        var ref=$(this).attr('href');

        switch(ref){
            case 'gslides':
                $('#contgalerie').css('visibility','hidden');
                $('#contgalerie').height('100%');
                //$('#contzgalerie').css('display','none');
                current='';
                //reinitmenu('');
            break;
            case 'ba':
                player2.pauseVideo();
                player.pauseVideo();
                $('#video1').css('visibility','hidden');
                $('#video2').css('visibility','hidden');
                $('#contba').css('visibility','hidden');
                current='';
                reinitmenu('');
            break;
            case 'synopsis':
                $('#contsynopsis').css('visibility','hidden');
                current='';
                reinitmenu('');
            break;
                
            case 'videoslide':
                $('#videoslide').css('display','none');
                document.getElementById("slidevideo").pause();
                // reinitmenu('');
                break;
        }
        return false;        
    });
    
    
    $('.btvideo').click(function(e){
        var cur=$(this).attr('href');
        var bt=cur=='video1'?'btvideo2':'btvideo1';
        $('#'+bt).removeClass('btvideocurrent');
        $(this).addClass('btvideocurrent');
        
        if(cur=='video1'){
            player2.pauseVideo();
            $('#video2').css('visibility','hidden');
             $('#'+cur).css('visibility','visible');
            player.playVideo();
        }else{
            player.pauseVideo();
            $('#video1').css('visibility','hidden');
            $('#'+cur).css('visibility','visible');
            player2.playVideo();
        }
 
        return false;
    });
    
    
    $(window).resize(function() {

        if(pagevideo==0)
        {
            var l=$('#video1').offset().left;
            l+=38;
            $('#btvideo1').css('margin-left',l+'px');
            var w=$('#video1').width();
            var wf=$('#fermerba').width();
            var dw=$(document).width();
            var r=(dw-(l+w))+60;
            
            $('#fermerba').css('right',r+'px');
            
            //console.log(dw +'  '+(l+w));
        }
    });
    
    $(window).trigger("resize");
    
    $('.persos').click(function(e){
        var id=$(this).attr('id');
        var others=id=='perso2'?Array('perso1','perso3','perso4'):Array();
        if(others.length==3)
        {
            for(var t in others){
                $('#'+others[t]).addClass('closeperso');
            }
            $(this).addClass('openperso');
        }
        if(id=='perso1' || id=='perso3' || id=='perso4')
        {
            $('#attente').css('display','block');
        }
        return false;
    });
    
    $('#fakecompte').click(function(e){
        $('#attente3').css('display','block');
    });
    
    $('#imgfollow').click(function(e){
        $('#attente2').css('display','block');
    });
    
    $('#fake2').click(function(e){
        $('#attente').css('display','block');
    });
    
    $('#attente2').click(function(e){
        $(this).css('display','none');
    });
    
    $('#attente').click(function(e){
        $(this).css('display','none');
    });
    
    $('#attente3').click(function(e){
        $(this).css('display','none');
    });
    
    $('.closew').click(function(e){
        var id=$(this).attr('id');
        switch (id){
            case "closew2":
                $('#perso1').removeClass('closeperso');
                $('#perso2').removeClass('openperso');
                $('#perso3').removeClass('closeperso');
                $('#perso4').removeClass('closeperso');
                $('#contwaste').css('display','none');
                $('#menucourse').css('display','block');
            break;
        }
        return false;
    });
    
    $('#lancer').click(function(e){
        $('#contcourse').addClass('opencourse');
        $('#lancer').css('display','none');
        document.getElementById('course').addEventListener('ended',coursevideoend,false);
        document.getElementById("course").play();
        return false;
    });
    
    $('.etape').click(function(e){
        var targt=$(this).attr('href');
       // console.log(targt);
        current=targt;
        reinitmenu(targt);
        return false;
    });
    
    $('.zoom').click(function(e){
        var ref = $(this).attr('href');
        e.preventDefault();
        
        var h=$(document).height();
        //console.log('hauteur : '+h);
        $('#contgalerie').css('top','0px');
        $('#contgalerie').height(h);
        
        $('#videoslide').css('top','0px');
        $('#videoslide').height(h);
        
        if(sjs==undefined) sjs = $('#slides').data('plugin_slidesjs');
        
        if(ref=='6'){
            $('#contgalerie').css('visibility','hidden');
            $('#videoslide').css('display','block');
            document.getElementById("slidevideo").play();
        }else{
            $('#contgalerie').css('visibility','visible');
            sjs.goto(parseInt(ref));
        }
       
        return false;
    });
    
    $('.nozoom').click(function(e){
        return false;
    });
    
    $('.honglet').click(function(e){
        var id=$(this).attr('href');
        if(id=='finale1'){
            $('.finale').each(function(){
                $(this).addClass('closefollow');
            });
            $(this).parent().removeClass('closefollow');
            $(this).parent().addClass('openfollow');
        }else{
            $('.finale').each(function(){
                $(this).removeClass('closefollow');
                $(this).removeClass('openfollow');
            });
        }
        return false;
    });
                        
    
});


function coursevideoend(e){
    $('#contcourse').removeClass('opencourse');
    $('#fake1').css('display','none');
    $('#fake2').css('display','block');
}


function reinitmenu(m){
    
    // console.log('current : '+current);
    // console.log('old : '+old);
    
    $('#menu li a').each(function(){
        $(this).removeClass('current');
    });
    
    if(current=='wasteland'){
//        $('#contwaste').css('visibility','hidden');
        $('#contwaste').css('display','none');
        $('#coursefinale').css('display','none');
    }
    
   // console.log(m);
    
    var dv = m=='wasteland' || m=='survis' || m=='coursefinale'?'wasteland':m;
    
    //if(m=='survis') old='';
    
    if(current!=''){
        $('#'+dv).addClass('current');
    }else{
        $('#home').addClass('current');
    }
    

    switch(old){
        case 'wasteland':
        case 'survis':
        case 'coursefinale':
            if(m!='survis' && m!='coursefinale'){
                strSRC1 = '_video/madmaxscreen.mp4';
                strTYPE1 = 'video/mp4';
                strSRC2 = '_video/madmaxscreen.webm';
                strTYPE2 = 'video/webm';
                $("#videobg").html('<source src="'+strSRC1+'" type="'+strTYPE1+'"></source><source src="'+strSRC2+'" type="'+strTYPE2+'"></source>' );
                document.getElementById("videobg").load();
                document.getElementById("videobg").play();
                $('#videobg').removeClass('marginauto');
//                $('#contwaste').css('visibility','hidden');
                $('#contwaste').css('display','none');
                $('#coursefinale').css('display','none');
                $('#menucourse').css('display','none');
            old='';
            }
        break;
    
        case 'compte':
            $('#contcompte').css('visibility','hidden');
        break;
        
        case 'galerie':
            $('#contzgalerie').css('display','none');
        break;
    }
    
    
    switch(m){
            
        case 'galerie':
            // $('#contzgalerie').css('visibility','visible');
            $('#contzgalerie').css('display','block');
        break;
            
        case 'ba':
            $('#contba').css('visibility','visible');
            $('#video1').css('visibility','visible');
            $('#video2').css('visibility','visible');
            $(window).trigger("resize");
            player.playVideo();
        break;
            
        case 'synopsis':
            $('#contsynopsis').css('visibility','visible');
        break;
            
        case 'wasteland':
            strSRC1 = '_video/fullScene_1_1.mp4';
            strTYPE1 = 'video/mp4';
            strSRC2 = '_video/fullScene_1_1.webm';
            strTYPE2 = 'video/webm';
            $("#videobg").html('<source src="'+strSRC1+'" type="'+strTYPE1+'"></source><source src="'+strSRC2+'" type="'+strTYPE2+'"></source>' );
            document.getElementById("videobg").load();
            document.getElementById("videobg").play();
            $('#videobg').addClass('marginauto');
            $('#menucourse').css('display','block');
            old='wasteland';
        break;
            
        case 'survis':
            $('#menucourse').css('display','none');
            //$('#contwaste').css('visibility','visible');
            $('#contwaste').css('display','block');
            old='survis';
        break;
            
        case 'coursefinale':
            $('#menucourse').css('display','none');
            $('#coursefinale').css('display','block');
            old='coursefinale';
        break;
            
        case 'compte':
            $('#contcompte').css('visibility','visible');
        break;
            
    }
    
    old=m;
}



/*
function closeandopen(n){
    if(current!='') {
        $('#'+current).css('display','none');
    }
    
}
*/