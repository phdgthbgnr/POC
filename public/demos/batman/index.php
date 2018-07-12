<?php
    $vers=$_SERVER['HTTP_USER_AGENT'];
    $mobile=0;
    if (strpos($vers,'Mobile')) $mobile=1;
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Personnalisez le masque et la cape de Batman"/>
    <meta property="og:site_name" content="Batman x Me"/>
    <meta property="og:url" content="http://batmanxme.fr" /> 
    <meta property="og:title" content="Batman x Me" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Vous aussi, libérez votre créativité en vous appropriant la célèbre armure de Batman !" /> 
    <meta property="og:image" content="http://batmanarkhamknight.warnerbros.fr/_images/batmanarkhamknight.jpg" />
    
    <link rel="canonical" href="http://batmanarkhamknight.warnerbros.fr" />
    
    <title>BATMAN X ME</title>
    <link rel="stylesheet" href="_css/style.css">

</head>

<body itemscope itemtype="http://schema.org/Article">
    
    <div class="preloading" id="preloading">
        <img src="_images/batman-arkham-knight-logo.jpg" width="307" height="138" alt="batman arkham knight" class="batlogo" id="logobat"/>
        <div class="percent" id="percent">0 %</div>
        <div class="levelload" id="loadlevel"></div>
    </div>
    
    <div class="contener" id="contener" style="position:absolute;top:50px;width:100%">
        
    <div id="batmansvg" class="svgbatman">
       <div class="nom" id="nom">&nbsp;</div> 
       <img src="_images/fond-batman.jpg" id="imgid" class="bgbatman"/>
       
       <div id="contextures" class="contextures">
           <img src="_images/textures0.png" class="ftexture" id="file01"/>
           <img src="_images/textures0.png" class="ftexture" id="file02"/>
           <img src="_images/textures0.png" class="ftexture" id="file03"/>
           <img src="_images/textures0.png" class="ftexture" id="file04"/>
           <img src="_images/textures0.png" class="ftexture" id="file05"/>
           <img src="_images/textures0.png" class="ftexture" id="file06"/>
           <img src="_images/textures0.png" class="ftexture" id="file07"/>
           <img src="_images/textures0.png" class="ftexture" id="file08"/>
           <img src="_images/textures0.png" class="ftexture" id="file09"/>
           <img src="_images/textures0.png" class="ftexture" id="file10"/>
           <img src="_images/textures0.png" class="ftexture" id="file11"/>
           <img src="_images/textures0.png" class="ftexture" id="file12"/>
           <img src="_images/textures0.png" class="ftexture" id="file13"/>
           <img src="_images/textures0.png" class="ftexture" id="file14"/>
           <img src="_images/textures0.png" class="ftexture" id="file15"/>
           <img src="_images/textures0.png" class="ftexture" id="file16"/>
           <img src="_images/textures0.png" class="ftexture" id="file17"/>
           <img src="_images/textures0.png" class="ftexture" id="file18"/>
           <img src="_images/textures0.png" class="ftexture" id="file19"/>
           <img src="_images/textures0.png" class="ftexture" id="file20"/>
           <img src="_images/textures0.png" class="ftexture" id="file21"/>
       </div>
       
        <div id="roll1" class="contour">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAMQCAMAAADMxOtbAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////AAAAVcLTfgAAAAF0Uk5TAEDm2GYAAAHiSURBVHja7MExAQAAAMKg9U9tCU+gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4GcCDAAw+QABW0rA+wAAAABJRU5ErkJggg==" width="600" height="784" class="imgblk" id="roll"/>      
        </div> 
            
        <div id="klicm" class="contour">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAMQCAMAAADMxOtbAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////AAAAVcLTfgAAAAF0Uk5TAEDm2GYAAAHiSURBVHja7MExAQAAAMKg9U9tCU+gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4GcCDAAw+QABW0rA+wAAAABJRU5ErkJggg==" width="600" height="784" class="imgblk" id="klic"/>      
        </div> 
           
       <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAAMQCAMAAADMxOtbAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////AAAAVcLTfgAAAAF0Uk5TAEDm2GYAAAHiSURBVHja7MExAQAAAMKg9U9tCU+gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4GcCDAAw+QABW0rA+wAAAABJRU5ErkJggg==" usemap="#Zoningbt" width="600" height="784" class="imgblk" id="targetImage"/>
      
       <map name="Zoningbt" id="Zoning"> 
            <area shape="poly" alt="" coords="271,39, 270,38, 269,39, 268,40, 266,52, 260,82, 256,102, 251,128, 248,146, 246,162, 245,179, 244,188, 243,204, 244,214, 244,223, 245,230, 245,224, 246,219, 247,214, 248,211, 250,209, 251,209, 250,208, 256,186, 252,150, 256,147, 259,145, 263,142, 267,140, 271,138, 276,137, 279,136, 276,136,
            275,135, 273,133, 273,129, 271,117, 270,104, 270,88, 270,64, 270,49, 270,39" class="dropzone" id="zone1">
            <area shape="poly" alt="" coords="327,39, 328,38, 328,39, 329,40, 332,52, 338,82, 342,102, 346,128, 349,146, 351,162, 353,179, 353,188, 354,204, 354,214, 353,223, 352,230, 352,224, 352,219, 351,214, 349,211, 347,209, 347,209, 347,208, 342,186, 345,150, 342,147, 339,145, 335,142, 331,140, 326,138, 321,137, 319,136, 321,136,
            323,135, 324,133, 325,129, 326,117, 327,104, 328,88, 328,64, 327,49, 327,39" class="dropzone" id="zone2">
            <area shape="poly" alt="" coords="299,220, 295,220, 295,216, 294,213, 292,208, 290,204, 287,201, 282,198, 272,193, 256,186, 252,150, 256,147, 259,145, 263,142, 267,140, 271,138, 276,137, 279,136, 283,135, 288,134, 293,134, 297,134, 299,134, 300,134, 304,134, 309,134, 315,135, 319,136, 321,137, 326,138, 331,140, 335,142,
            339,145, 342,147, 345,150, 342,186, 326,193, 316,198, 310,201, 307,204, 305,208, 303,213, 303,216, 303,220, 299,220" class="dropzone" id="zone3">
            <area shape="poly" alt="" coords="250,209, 251,209, 250,208, 256,186, 272,193, 282,198, 287,201, 290,204, 292,208, 294,213, 295,216, 295,220, 292,220, 289,219, 287,218, 284,216, 282,216, 279,216, 273,216, 269,217, 264,216, 260,215, 256,213, 250,209" class="dropzone" id="zone4">
            <area shape="poly" alt="" coords="347,209, 347,209, 347,208, 342,186, 326,193, 316,198, 310,201, 307,204, 305,208, 303,213, 303,216, 303,220, 305,220, 308,219, 311,218, 313,216, 316,216, 319,216, 324,216, 328,217, 334,216, 338,215, 342,213, 347,209" class="dropzone" id="zone5">
            <area shape="poly" alt="" coords="281,227, 279,227, 277,228, 275,228, 272,228, 267,228, 262,227, 260,224, 259,223, 260,221, 261,220, 263,219, 266,219, 270,219, 274,220, 278,222, 280,223, 281,225, 281,226, 280,227" class="dropzone" id="zone7">
            <area shape="poly" alt="" coords="338,224, 336,227, 331,228, 326,228, 323,228, 321,228, 319,227, 318,227, 317,226, 317,225, 318,223, 321,222, 324,220, 328,219, 332,219, 335,219, 337,220, 338,221, 339,223, 338,224" class="dropzone" id="zone7">
            <area shape="poly" alt="" coords="355,242, 353,243, 351,244, 347,246, 343,248, 339,249, 335,251, 309,254, 300,256, 298,256, 288,254, 263,251, 259,249, 255,248, 250,246, 247,244, 244,243, 243,242, 243,240, 244,233, 245,230, 245,224, 246,219, 247,214, 248,211, 250,209, 256,213, 260,215, 264,216, 269,217, 273,216, 279,216,
            282,216, 284,216, 287,218, 289,219, 292,220, 295,220, 303,220, 305,220, 308,219, 311,218, 313,216, 316,216, 319,216, 324,216, 328,217, 334,216, 338,215, 342,213, 347,209, 349,211, 351,214, 352,219, 352,224, 352,230, 353,233, 354,237, 354,240, 354,242" class="dropzone" id="zone6">
            <area shape="poly" alt="" coords="299,307, 296,306, 292,306, 288,305, 284,304, 282,302, 280,300, 278,295, 276,291, 273,285, 270,278, 268,270, 265,258, 263,251, 259,249, 255,248, 250,246, 247,244, 244,243, 243,242, 244,252, 246,260, 248,270, 250,276, 254,286, 258,293, 262,298, 266,302, 269,306, 273,310, 279,312, 287,314,
            296,315, 299,316, 302,315, 310,314, 319,312, 324,310, 328,306, 332,302, 336,298, 339,293, 343,286, 347,276, 349,270, 352,260, 353,252, 354,242, 353,243, 351,244, 347,246, 343,248, 339,249, 335,251, 333,258, 329,270, 327,278, 325,285, 322,291, 320,295, 317,300, 316,302, 313,304, 309,305, 305,306, 302,306, 299,307, 299,307"
            class="dropzone" id="zone8">
            <area shape="poly" alt="" coords="299,366, 296,366, 296,367, 295,366, 278,366, 275,367, 266,367, 265,368, 258,368, 252,371, 253,372, 251,371, 233,380, 223,386, 219,389, 213,393, 213,396, 204,396, 201,395, 199,394, 186,378, 218,363, 223,358, 223,357, 227,356, 233,354, 236,351, 237,347, 239,342, 239,336, 241,331, 243,329,
            245,328, 246,326, 246,323, 246,320, 240,287, 248,270, 250,276, 254,286, 258,293, 262,298, 266,302, 269,306, 273,310, 279,312, 287,314, 296,315, 299,316, 302,315, 310,314, 319,312, 324,310, 328,306, 332,302, 336,298, 339,293, 343,286, 347,276, 349,270, 358,287, 351,320, 351,323, 351,326, 352,328, 354,329, 357,331, 359,336,
            359,342, 360,347, 362,351, 365,354, 370,356, 374,357, 374,358, 379,363, 412,378, 399,394, 397,395, 394,396, 385,396, 385,393, 379,389, 375,386, 364,380, 347,371, 345,372, 345,371, 340,368, 332,368, 331,367, 322,367, 320,366, 303,366, 302,367, 301,366, 299,366" class="dropzone" id="zone9">
            <area shape="poly" alt="" coords="175,367, 170,359, 166,352, 165,348, 163,345, 163,341, 163,338, 163,335, 163,333, 164,331, 160,335, 158,338, 157,334, 156,329, 156,325, 157,322, 150,324, 133,326, 123,329, 114,334, 106,339, 98,345, 89,356, 81,368, 80,369, 77,380, 74,390, 77,407, 82,422, 98,435, 127,430, 134,410, 163,403,
            166,392, 170,384, 176,376, 177,375, 175,367, 175,367" class="dropzone" id="zone10">
            <area shape="poly" alt="" coords="423,367, 428,359, 431,352, 433,348, 434,345, 435,341, 435,338, 435,335, 434,333, 434,331, 437,335, 439,338, 441,334, 442,329, 441,325, 440,322, 447,324, 464,326, 474,329, 484,334, 491,339, 499,345, 509,356, 517,368, 518,369, 521,380, 524,390, 520,407, 515,422, 500,435, 470,430, 463,410,
            434,403, 431,392, 427,384, 421,376, 420,375, 422,367, 422,367" class="dropzone" id="zone11">
            <area shape="poly" alt="" coords="164,331, 167,327, 174,321, 179,316, 191,307, 189,306, 187,305, 186,306, 159,320, 157,322, 156,325, 156,329, 157,334, 158,338, 160,335, 164,331" class="dropzone" id="zone12">
            <area shape="poly" alt="" coords="434,331, 430,327, 424,321, 418,316, 407,307, 408,306, 410,305, 412,306, 438,320, 440,322, 441,325, 442,329, 441,334, 439,338, 437,335, 434,331" class="dropzone" id="zone13">
            <area shape="poly" alt="" coords="186,378, 218,363, 223,358, 223,357, 221,357, 210,352, 207,351, 205,349, 204,347, 204,345, 208,317, 209,306, 210,303, 211,300, 212,298, 211,297, 210,297, 209,298, 205,301, 200,303, 195,305, 191,307, 179,316, 174,321, 167,327, 164,331, 163,333, 163,335, 163,338, 163,341, 163,345, 165,348,
            166,352, 170,359, 175,368, 185,379, 186,378" class="dropzone" id="zone14">
            <area shape="poly" alt="" coords="412,378, 379,363, 374,358, 374,357, 376,357, 388,352, 391,351, 393,349, 393,347, 393,345, 390,317, 388,306, 387,303, 386,300, 385,298, 386,297, 387,297, 388,298, 392,301, 397,303, 402,305, 407,307, 418,316, 424,321, 430,327, 434,331, 434,333, 435,335, 435,338, 435,341, 434,345, 433,348,
            431,352, 428,359, 422,368, 413,379, 412,378" class="dropzone" id="zone15">
            <area shape="poly" alt="" coords="224,357, 227,356, 233,354, 236,351, 237,347, 239,342, 239,336, 241,331, 243,329, 245,328, 246,326, 246,323, 246,320, 240,287, 240,284, 238,283, 218,293, 215,295, 213,297, 211,300, 210,303, 209,306, 208,317, 204,345, 204,347, 205,349, 207,351, 210,352, 221,357, 223,357" class="dropzone" id="zone16">
            <area shape="poly" alt="" coords="374,357, 370,356, 365,354, 362,351, 360,347, 359,342, 359,336, 357,331, 354,329, 352,328, 351,326, 351,323, 351,320, 358,287, 358,284, 360,283, 379,293, 382,295, 384,297, 386,300, 387,303, 388,306, 390,317, 393,345, 393,347, 393,349, 391,351, 388,352, 376,357, 374,357" class="dropzone" id="zone17">
            <area shape="poly" alt="" coords="268,421, 253,372, 251,371, 233,380, 223,386, 219,389, 213,393, 213,396, 214,400, 215,402, 255,417, 259,416, 261,416, 263,420, 268,422, 268,421" class="dropzone" id="zone18">
            <area shape="poly" alt="" coords="299,422, 296,422, 295,422, 295,422, 287,422, 285,421, 285,422, 279,422, 278,421, 277,422, 269,422, 253,372, 252,371, 258,368, 265,368, 266,367, 275,367, 278,366, 295,366, 296,367, 296,366, 299,366, 301,366, 302,367, 303,366, 320,366, 322,367, 331,367, 332,368, 340,368, 345,371, 345,372,
            329,422, 321,422, 320,421, 319,422, 313,422, 312,421, 311,422, 303,422, 302,422, 301,422, 299,422" class="dropzone" id="zone19">
            <area shape="poly" alt="" coords="329,421, 345,372, 347,371, 364,380, 375,386, 379,389, 385,393, 385,396, 384,400, 382,402, 342,417, 339,416, 337,416, 335,420, 330,422, 329,421" class="dropzone" id="zone20">
            <area shape="poly" alt="" coords="74,390, 77,407, 82,422, 98,435, 127,430, 134,410, 163,403, 166,392, 170,384, 176,376, 177,375, 175,367, 175,367, 175,367, 175,368, 185,379, 186,378, 199,394, 201,395, 204,396, 213,396, 214,400, 215,402, 255,417, 259,416, 261,416, 263,420, 268,422, 268,421, 269,422, 277,422, 278,421, 279,422,
            285,422, 285,421, 287,422, 295,422, 295,422, 296,422, 299,422, 301,422, 302,422, 303,422, 311,422, 312,421, 313,422, 319,422, 320,421, 321,422, 329,422, 329,421, 330,422, 335,420, 337,416, 339,416, 342,417, 382,402, 384,400, 385,396, 394,396, 397,395, 399,394, 412,378, 413,379, 422,368, 422,367, 422,367, 420,375, 421,376,
            427,384, 431,392, 434,403, 463,410, 470,430, 500,435, 515,422, 520,407, 524,390, 549,497, 575,604, 600,711, 600,784, 480,784, 360,784, 240,784, 120,784, 0,784, 0,653, 37,522, 74,390" class="dropzone" id="zone21">
        </map>
  </div>
    
  <div class="colright" id="rightcol">
<!--        &#35;-->
        <a href="https://twitter.com/intent/tweet/?text=Je personnalise le masque et la cape de Batman pour gagner ma création grandeur nature !  %23BeTheBatman &url=http://batmanxme.fr" class="share tw" id="inapptw"><img src="_images/sharetw.png"/></a>
        <div class="share gplus">  
            <div class="googlehider">
                <script type="text/javascript">
                                        
                    function shareState(p){
                        if(p){
                            if(p.type=='confirm'){
                                mwsdk.Analytics.share({
                                    socialNetwork:'google',
                                    socialAction:'share',
                                    socialTarget:'http://batmanarkhamknight.warnerbros.fr/',
                                    page:'http://batmanarkhamknight.warnerbros.fr/'
                                });
                            }
                        }
                    }
                </script>
                <g:plusone data-annotation="none" data-action="share" onendinteraction="shareState" data-href="http://batmanxme.fr"></g:plusone>
                
            </div>  
            <img src="_images/sharegp.png" class="mygoogle" />
        </div>
        <a href="#" id="fbshare" class="share fb"><img src="_images/sharefb.png"/></a>
        <h1 class="logobtmn"><img itemprop="image" src="_images/batman-arkham-knight-logo2.jpg"/></h1>
        <h2 itemprop="description" class="intro"><strong>Pour la toute première fois, personnalisez le masque et la cape de Batman</strong> selon vos envies<br/>et tentez de gagner votre création grandeur nature en la publiant&nbsp;!</h2>
        <div class="apply">Appliquez une texture sur les zones de votre choix :</div>
        
        <ul class="palette firstp" id="palette">
            <li class="rond liste"><a href="#" id="coul1" class="drag rond1"></a></li>
            <li class="rond liste"><a href="#" id="coul2" class="drag rond2"></a></li>
            <li class="rond liste"><a href="#" id="coul5" class="drag rond5"></a></li>
            <li class="rond liste"><a href="#" id="coul7" class="drag rond7"></a></li>
            <li class="rond liste"><a href="#" id="coul8" class="drag rond8"></a></li>
            <li class="rond liste"><a href="#" id="coul9" class="drag rond9"></a></li>
            
            <li class="rond liste"><a href="#" id="coul14" class="drag rond14"></a></li>
            <li class="rond liste"><a href="#" id="coul15" class="drag rond15"></a></li>
            <li class="rond liste"><a href="#" id="coul16" class="drag rond16"></a></li>
            <li class="rond liste"><a href="#" id="coul17" class="drag rond17"></a></li>
            <li class="rond liste"><a href="#" id="coul18" class="drag rond18"></a></li>
            <li class="rond liste"><a href="#" id="coul19" class="drag rond19"></a></li>
            <li class="rond liste"><a href="#" id="coul20" class="drag rond20"></a></li>
            <li class="rond liste"><a href="#" id="coul21" class="drag rond21"></a></li>
            <li class="rond liste"><a href="#" id="coul22" class="drag rond22"></a></li>
            <li class="rond liste"><a href="#" id="coul23" class="drag rond23"></a></li>
            <li class="rond liste"><a href="#" id="coul24" class="drag rond24"></a></li>
            <li class="rond liste"><a href="#" id="coul25" class="drag rond25"></a></li>
            <li class="rond liste"><a href="#" id="coul26" class="drag rond26"></a></li>
            <li class="rond liste"><a href="#" id="coul27" class="drag rond27"></a></li>
            <li class="rond liste"><a href="#" id="coul28" class="drag rond28"></a></li>
            <li class="rond liste"><a href="#" id="coul29" class="drag rond29"></a></li>
            <li class="rond liste"><a href="#" id="coul30" class="drag rond30"></a></li>
            <li class="rond liste"><a href="#" id="coul31" class="drag rond31"></a></li>
            <li class="rond liste"><a href="#" id="coul32" class="drag rond32"></a></li>

        </ul>
        
        <ul class="liens">
            <li><a href="#" id="partager" class="bouton">Publiez votre création</a></li>
            <li><a href="/wall" id="wall" class="bouton">Découvrez la galerie</a></li>
        </ul>
        
        <div class="pack">
            <img src="_images/packs.jpg" class="packs"/>
            <a href="https://www.warnerbros.fr/products/batman-arkham-knight" target="_blank" class="bouton preco">Précommandez le jeu</a>
            <img src="_images/logos.jpg" class="logo"/>
        </div>
        
        <div class="mentions">
            BATMAN: ARKHAM KNIGHT software © 2015 Warner Bros. Entertainment Inc. Developed by Rocksteady Studios. “<img src="_images/ps.png"/>”, “PlayStation” and “<img src="_images/xo.png"/>” are trademarks or registered trademarks of Sony Computer Entertainment Inc. “<img src="_images/ps4.png" class="ps4"/>” is a trademark of the same company. All other trademarks and copyrights are the property of their respective owners. All rights reserved.
        </div>
        <div class="mentionsbis"><img src="_images/wb_batman.png"/>BATMAN and all characters, their distinctive likenesses, and related elements are trademarks of DC Comics © 2015. All Rights Reserved.<br/>WB GAMES LOGO, WB SHIELD: ™ & © Warner Bros. Entertainment Inc. (s15)</div>
    </div>
        
    </div>
    
    <div class="popbkg" id="popbkg">
        <div class="popcont">
            <div class="texte">Votre création a bien été enregistrée !</div>
            <a href="#" id="okclose">OK</a><br/>
            <div class="ttreso">Partagez votre création :</div>
            <a href="#" class="share2" id="inapptw2"><img src="_images/sharetw.png"/></a>
            <a href="#" id="fbshare2" class="share2"><img src="_images/sharefb.png"/></a>
        </div>
    </div>
    
    <div class="popbkg" id="popbkg2">
        <div class="popcont">
            <div class="texte">Pour publier votre création, vous devez être connecté à MyWarner</div>
            <a href="#" id="okclose2">Me connecter</a><a href="#" id="annule" class="annuler">Annuler</a>
        </div>
    </div>
    
    <div class="popbkg" id="popbkg3">
        <div class="popcont">
            <div class="texte">Vous pouvez maintenant publier</div>
            <a href="#" id="okclose3">PUBLIEZ</a>
        </div>
    </div>
    
    <div class="popbkg" id="popbkg4">
        <div class="popcont">
            <div class="texte">Vous devez remplir toutes les zones</div>
            <a href="#" id="okclose4">OK</a>
        </div>
    </div>
    
    <div class="msgport">
        Pour personnaliser Batman,<br/>retournez l'écran !
    </div>    
   
    <script type="text/javascript">
        
        // Include the Twitter Library ---------------------------------------------------------------------
        
        window.twttr = (function (d,s,id) {
          var t, js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
          js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
          return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
        }(document, "script", "twitter-wjs"));
        
         twttr.ready(function (twttr) {
             twttr.events.bind('tweet', function (ev) {
                 switch(ev.target.id){
                    case 'inapptw','inapptw2':
                        mwsdk.Analytics.share({
                            socialNetwork:'twitter',
                            socialAction:'tweet',
                            socialTarget:'http://batmanarkhamknight.warnerbros.fr/',
                            page:'http://batmanarkhamknight.warnerbros.fr/'
                        });
                    break;
                 }
             });
         });
        
         // script Warner log et analytics ------------------------------------------------------------------
             
        var idwarner='';
        var mwtoken='';
        var mwfirstname='';
        var mwlastname='';
        var mwemail='';
        var fbid='';
        var mwsdk;
        var mobile=<?php echo $mobile ?>;
        /*
        window.myWarnerAsyncLoad = function() {
            MyWarner.init({
            client_id: '2eb9376cf0389a63c128a9fb',
            context: 'challenge',
            topbar: {
                show: true,
                display: {
                warnerbros_website: true,
                challenges: true,
                mobile_app: false,
                harry_potter: true,
                justforfans: false,
                faq: true
                }
            },
                
            
            analytics: {context:'batmanxMe',type:'animation'}
            }).done(function(sdk) {
                // OK
                mwsdk=sdk;
                sdk.Analytics.pageView({
                    context:'batmanaxMe',
                    type:'animation',
                    page:'http://batmanarkhamknight.warnerbros.fr'
                       
                // customDimensions: {
                // MPM: ['12345', '6789'],
                // title: 'Titre de la news trackée'
                }
                
                });
                sdk.Event.subscribe('sdk.connect.login', function(event, id, token) {
                // L'utilisateur est connecté.
                    //console.log('FB1 : '+id);
                    idwarner = id;
                    //console.log('----------------------- user connected ----------------------');
                    sdk.User.getInfos({})
                    .done(function(o){
                        //console.log('FB : '+o.facebook_id);
                        //console.log(o);
                        idwarner = o.mw_id;
                        mwfirstname = o.first_name;
                        mwlastname = o.last_name;
                        mwemail = o.email;
                        fbid = o.facebook_id;
                        mwtoken = o.mw_token;
                        jQuery('#nom').empty().html('BATMAN <span>X</span> ' + mwfirstname + ' ' +mwlastname.substr(0,1) + '.')
                    }).fail(function(erreur){
                        //console.log(erreur);
                        //console.log(erreur.error);
                        //console.log(erreur.code);
                    });
                });
                
                sdk.Event.subscribe('sdk.connect.logout', function(event, id, token) {
                // L'utilisateur est connecté.
                    idwarner = '';
                    mwfirstname = '';
                    mwlastname = '';
                    mwemail = '';
                    fbid = '';
                    mwtoken = '';
                    jQuery('#nom').empty().html('BATMAN <span>X</span> ' + '' );
                });
                
                    jQuery('#percent').html('100 %');
                    jQuery('#percent').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
                        jQuery('#percent').unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
                        jQuery('#preloading').css('display','none');
                        jQuery('#contener').css('visibility','visible');
                        jQuery('#contener').addClass('apparition');
                        jQuery(document).height(documenth);
                        if (window.matchMedia("(orientation: portrait)").matches) {
                            jQuery('.msgport').css('display','block');
                        }
                    });
                    jQuery('#percent').addClass('disparition');
                    jQuery('#loadlevel').addClass('disparition');
                    jQuery('#logobat').addClass('disparition');
                   
                //console.log(profil.facebook_id);
            }).fail(function(error) {
                // Gestion des erreurs.
                //console.error(error);
            });
            
            
            
        
            
            
        };
        */
    </script>
    <!-- staging -->
    <!-- <script src="https://mywarner-upload-preprod.s3.amazonaws.com/js-sdk/staging/sdk.min.js" type="text/javascript"></script> -->
    <!-- production -->
<!--     <script src="https://mywarner-upload.s3.amazonaws.com/js-sdk/sdk.min.js" type="text/javascript"></script> -->
    
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

   <script type="text/javascript" src="_js/html2canvas.js"></script>
   <script type="text/javascript" src="_js/jquery.plugin.html2canvas.js"></script>
    
    <script src="_js/jquery.rwdImageMaps.min.js"></script>

    <!-- jquery --------------------------------------------------------------------------------------- -->
    <script type="text/javascript">
        
        
        var curtarget = null; // id entier
        var numtarget = null; // numero seul
        var curtexture = null;
        var curoll = null;
        var documenth = jQuery(document).height();
        var imgwidth;
        var imgheight;
        var imgtmp;
        var imgthmb;
        var request=null;
        var request2=null;
        var loaded=false;
        var zones=new Array()
        
        jQuery(document).ready(function($){
            
           // console.log('document ready');
            
            if (window.matchMedia("(orientation: portrait)").matches) {
                jQuery('.msgport').css('display','none');
            }
            
            var preloadPictures = function(pictureUrls, callback) {
                var i,
                j,
                loaded = 0;

                for (i = 0, j = pictureUrls.length; i < j; i++) {
                    (function (img, src) {    
                        img.onload = function () {
                        if (++loaded == pictureUrls.length && callback) {
                            callback();
                        }else{
                            var wl=Math.round((loaded*100)/pictureUrls.length);
                            //console.log(loaded+' / '+pictureUrls.length+' / '+wl);
                            jQuery('#percent').html((wl)+' %');
                            wl*=2;
                            jQuery('#loadlevel').width(wl);
                        }
                    };

                    // Use the following callback methods to debug
                    // in case of an unexpected behavior.
                    img.onerror = function () {};
                    img.onabort = function () {};
                    img.src = src;
                    } (new Image(), pictureUrls[i]));
                }
            };

            function loadingok(){
                console.log('ok');
                loaded=true;
                
                $('#percent').html('100 %');
                    // jQuery('#percent').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
                    $('#percent').unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd");
                    $('#preloading').css('display','none');
                    $('#contener').css('visibility','visible');
                    $('#contener').addClass('apparition');
                    $(document).height(documenth);
                    // if (window.matchMedia("(orientation: portrait)").matches) {
                        $('.msgport').css('display','block');
                    // }
                    // });
                    $('#percent').addClass('disparition');
                    $('#loadlevel').addClass('disparition');
                    $('#logobat').addClass('disparition');
                    return true;
            }

            var arrpreload = new Array();
            
            // preload textures & couleurs
            var indexes=new Array(1,2,5,7,8,9,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32)
            for(var i=0;i<indexes.length;i++){
                for(var ii=1;ii<=21;ii++){
                    var iii=ii<10?'0'+ii:ii;
                     arrpreload.push('_images/rond'+indexes[i]+'/rond'+indexes[i]+'-'+iii+'.png'); 
                }
            }

            for(var i=1;i<=21;i++){
                arrpreload.push('_images/roll/roll'+i+'.png');
            }

            arrpreload.push('_images/Base-Batman-X-Me.jpg');

            preloadPictures(arrpreload, loadingok);
            
            $('img[usemap]').rwdImageMaps();
            
            var contenerh=$(document).height();
            $('#batmansvg').height(contenerh);
            
            $(window).resize(function() {
                
                if (window.matchMedia("(orientation: landscape)").matches) {
                    jQuery('.msgport').css('display','none');
                }
                
                if (window.matchMedia("(orientation: portrait)").matches && loaded) {
                    jQuery('.msgport').css('display','block');
                }
                
                contenerh=$(document).height();
                //$('#batmansvg').height(contenerh);
                //console.log(contenerh);
                
                imgwidth=Math.round($('#targetImage').width());
                $('#batmansvg').width(imgwidth);
                
                imgheight=Math.round($('#targetImage').height());
                $('#batmansvg').height(imgheight);
                
                $('#rightcol').css('left',imgwidth+'px');
            });
            
            $(window).resize();
            
            $('#okclose').click(function(){
                // console.log('okclose');
                //$('#popbkg').css('display','none');
                $('.popbkg').css('visibility','hidden');
                return false;
            });
            
            
            $('#okclose2').click(function(){
                // console.log('okclose');
                //$('#popbkg').css('display','none');
                $('.popbkg').css('visibility','hidden');
                mwsdk.Connect.login('generic', {
                    success: function(id, token) {
                    // L'utilisateur est connecté.
                        mwsdk.User.getInfos({})
                        .done(function(o){
                            //console.log('FB : '+o.facebook_id);
                            //console.log(o);
                            idwarner = o.mw_id;
                            mwfirstname = o.first_name;
                            mwlastname = o.last_name;
                            mwemail = o.email;
                            fbid = o.facebook_id;
                            mwtoken = o.mw_token;
                            $('#popbkg3').css('visibility','visible');
                            jQuery('#nom').empty().html('BATMAN <span>X</span> ' + mwfirstname + ' ' +mwlastname.substr(0,1) + '.');
                        }).fail(function(erreur){
                            //console.log(erreur);
                            //console.log(erreur.error);
                            //console.log(erreur.code);
                        });
                    },
                    error: function(e){
                    // Erreur
                    console.log(e);
                    }
                });
                return false;
            });
            
            $('#annule').click(function(e){
                $('.popbkg').css('visibility','hidden');
                return false;
            });
            
            $('#okclose3').click(function(e){
                $('#popbkg3').css('visibility','hidden');
                publier();
                return false;
            });
            
            
            $('#okclose4').click(function(e){
                $('#popbkg4').css('visibility','hidden');
                return false;
            });
                    

            $('.dropzone').each(function(e){
                $(this).click(function(o){
                    //console.log($(o.target).attr('id'));
                    curtarget=$(o.target).attr('id');
                    if(numtarget!=null) $('#klicm').removeClass('roll'+numtarget);
                    numtarget=$(o.target).attr('id').substr(4,curtarget.length);
                    $('#klicm').addClass('roll'+numtarget);
                    $('.drag').each(function(i,d){
                        if($(d).hasClass('bordure')) $(d).removeClass('bordure');
                    });
                    //console.log(n);
                    return false;
                });
            });
            
            
            $('.dropzone').each(function(i,d){
                  $(d).hover(function(){
                        var id=$(this).attr('id');
                        curoll=id.substr(4,id.length);
                        $('#roll1').addClass('roll'+curoll);
                    },function(){
                        //console.log(numtarget+' / '+curoll);
                        $('#roll1').removeClass('roll'+curoll);
                    });  
            });
            
            
            $('.drag').each(function(i,d){
                $(d).click(function(){
                    $('.drag').each(function(i,d){
                        if($(d).hasClass('bordure')) $(d).removeClass('bordure');
                    });
                    if(numtarget!=null) $('#klicm').removeClass('roll'+numtarget);
                    $(this).addClass('bordure');
                    //console.log($(this).attr('id'));
                    curtexture=$(this).attr('id');
                    applytexture();
                    return false;
                });
            });
            
            
            $('#fbshare').click(function(e){
                e.preventDefault();
                FB.ui({
                    //app_id:230954650284744,
                    //method: 'share',
                    //href:'http://batmanarkhamknight.warnerbros.fr?u=1'
                    method:'feed',
                    name: 'Batman x Me',
                    link: 'http://batmanxme.fr',
                    picture: 'http://batmanarkhamknight.warnerbros.fr/_images/batmanarkhamknight.jpg',
                    description: 'Vous aussi, libérez votre créativité en vous appropriant la célèbre armure de Batman !',
                    caption: 'Personnalisez le masque et la cape de Batman'

                    },function(d){
                    
                    if(d!=null) {
                        // analytics share
                        mwsdk.Analytics.share({
                            socialNetwork:'facebook',
                            socialAction:'feed',
                            socialTarget:'http://batmanarkhamknight.warnerbros.fr/',
                            page:'http://batmanarkhamknight.warnerbros.fr/'
                        });                   
                    }; 
                });
                return false;
            });
            
            
            $('#fbshare2').click(function(e){
                e.preventDefault();
                FB.ui({
                    method:'feed',
                    name: 'Batman x Me',
                    link: 'http://batmanxme.fr',
                    picture: 'http://batmanarkhamknight.warnerbros.fr/_capture/'+imgtmp,
                    description: 'Votez pour mon armure de Batman : Arkham Knight !',
                    caption: 'Je viens de personnaliser le masque et la cape de Batman, votez pour ma création'

                    },function(d){
                    
                    if(d!=null) {
                        // analytics share
                        mwsdk.Analytics.share({
                            socialNetwork:'facebook',
                            socialAction:'feed',
                            socialTarget:'http://batmanarkhamknight.warnerbros.fr/',
                            page:'http://batmanarkhamknight.warnerbros.fr/'
                        });                   
                    }; 
                });
                return false;
            });
            
            
            
            $('#inapptw2').click(function(e){
                e.preventDefault();
                var width  = 575,
                height = 400,
                left   = ($(window).width()  - width)  / 2,
                top    = ($(window).height() - height) / 2,
                url    = 'http://twitter.com/share?text=Je viens de personnaliser le masque et la cape de Batman: BatmanX'+mwfirstname+' '+mwlastname+'. Votez pour ma création %23BeTheBatman&url=http://batmanxme.fr',
                opts   = 'status=1' +
                ',width='  + width  +
                ',height=' + height +
                ',top='    + top    +
                ',left='   + left;
                window.open(url, 'twitter', opts);
                return false;
            });
            
 
            // partage facebook
            
            var request=null;
            var request2=null;
            
              $('#partager').click(function(e){
                 //alert('partageFB');
                if(zones.length>=18){  
                    publier();
                }else{
                    $('#popbkg4').css('visibility','visible');
                }
              
               return false;
                  
            });
            
        });
        
        function applytexture(){
            if(curtarget==null) return;
            var rep=curtexture.substr(0,4);
            if(rep=='coul') rep='rond';
            if(rep=='texte') rep='texture';
            var ind=curtexture.substr(4,curtexture.length);
            
            var indt=parseInt(curtarget.substr(4,curtarget.length));
            
            if(indt<10) indt='0'+indt;
            if($.inArray(indt,zones)==-1) zones.push(indt);
            
            // console.log(rep + ' / ' + indt);
            
            var path = '_images/'+rep+ind+'/rond'+ind+'-'+indt+'.png';
            
            jQuery('#file'+indt).attr("src",path);
            
            // console.log(path + ' / '+'#file'+indt);
            
        }
        
        function publier(){
            
            if(idwarner==''){
                    $('#popbkg2').css('visibility','visible');
                    return false;
                }
                var capture = {};
                var target = $('#batmansvg');
                $('#batmansvg').html2canvas({
                    onrendered: function(canvas) {
                        
                        //capture.img = canvas.toDataURL( "image/png" );
                        //capture.data = { 'image' : capture.img };
                         /*
                        var extra_canvas = document.createElement("canvas");
                        var wa = $('#targetImage').width();
                        var ha = $('#targetImage').height(); 
                        var hb=(600*ha)/wa;
                        extra_canvas.setAttribute('width', 600);
                        extra_canvas.setAttribute('height', 800);
                        var ctx = extra_canvas.getContext('2d');
                        ctx.drawImage(canvas,0,0,canvas.width, canvas.height,0,0,600,hb);
                        //ctx.drawImage(canvas,0,0,600,hb,0,0,600,hb);
                        var img = extra_canvas.toDataURL( "image/png" );
                        */
                        
                        //var img = canvas.toDataURL( "image/png" );
                        var img = canvas.toDataURL( "image/jpeg" );
                        var output= encodeURIComponent(img);
                        var parameters = 'image='+output+'&id='+idwarner;
                        if(request) request.abort();
                        request=$.ajax({
                            url: "_inc/ajax.php",
                            data: parameters, //capture.data,
                            type: 'post',
                            success: function( result ) {
                                // partage de l'image
                                //console.log('result : '+ result );
                                var res = JSON.parse(result);
                                imgtmp = res[0];
                                imgthmb = res[1];
                                request=null;
                                //console.log(imgtmp);
                                if(request2) request2.abort();
                                request2 = $.ajax({
                                    url : '_inc/saveshare.php',
                                    type : 'POST',
                                    data : {action:'publication', mwid:idwarner, fbpostid:0, share:'no', image:imgtmp, thumb:imgthmb, email:mwemail, firstname:mwfirstname,lastname:mwlastname}
                                });
                                request2.done(function(resp){
                                    request2=null;
                                    $('#popbkg').css('visibility','visible');
                                    // analytics share
                                    if(resp=='ok'){  // mettre ok en fin de test (deja_joue = test)
                                    // challange mywarner (enregistre 2000 au premier (et suelement au premier) partage réussi
                                        var $data={mw_id:idwarner, mw_token:mwtoken, challenge_id:'batman-x-me', score:2000};
                                        var req=$.ajax({
                                            url:'https://api-thirdparty-recette.mywarner.warnerbros.fr/challenge_completed',
                                            type:'POST',
                                            dataType:'json',
                                            data:JSON.stringify($data)
                                        });
                                        req.done(function(resp){
                                            // console.log('done');
                                            // console
                                        });
                                        req.fail(function(resp){
                                            // console.log('failure');
                                        });
                                    }
                                });
                                request2.fail(function(resp){
                                    request2=null;
                                }) 
                               
                            },
                            error:function(result){
                                request=null;
                                // console.log('error : '+result);
                            }
                        });
                    },
                    logging: true,
                    profile: true,
                    useCORS: true,
                    allowTaint: true
                });
        }
            
        
    </script>
    
    
    <!-- google + api ------------------------------------------------------------------- -->
    <script type="text/javascript">
        window.___gcfg = {
            lang: 'fr-FR'
        };

        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
        
    </script>
    
</body>
</html>
