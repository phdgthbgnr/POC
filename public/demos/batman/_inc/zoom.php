<?php

    $ref=$_SERVER['REFERER'];
    $host=$_SERVER['HOST'];

    if (!preg_match("/$host/", $ref)) {
        echo 'NOT ALLOWED';
        exit;
    }

    require('../_inc/connect.php');
    $allow='no';
    $ret='';

    if($_POST){

    if(isset($_POST['action']) && $_POST['action']=='zoom'){
        
        if(isset($_POST['id'])){
            if(isset($_POST['allow'])) $allow=protect($_POST['allow']);
            $id=protect($_POST['id']);
            $conn = new connect();
            $sql="SELECT mw_likes, namefic, firstname, lastname FROM $conn->tb1 WHERE id_user='$id' limit 1";
            $query=$conn->execute_query($sql);
            if($query){
                
               if(mysql_num_rows($query)>0){
                    $row = mysql_fetch_array($query);
                    
                    $ret = '<div href="#" id="closing" class="closing"><span><img src="../_capture/'.$row['namefic'].'" id="bigimg" class="invisible"/>';
                    switch($allow){
                        case 'yes':
                        $ret .= '<a class="poplikes" id="likepop" href="v-'.$id.'"><span id="points">'.$row['mw_likes'].'</span></a>';
                        break;
                        case 'no':
                        $ret .= '<div class="nolikes popno"><span>'.$row['mw_likes'].'</span></div>';
                        break;
                        default:
                        $ret .= '<div class="nolikes popno"><span>'.$row['mw_likes'].'</span></div>';
                        break;
                    }
                    
                    // twitter
                  $ret .= '<a href="https://twitter.com/intent/tweet/?text=Je viens de personnaliser le masque et le cape de Batman: BatmanX'.$row['firstname'].' '.$row['lastname'].'. Votez pour ma création %23BeTheBatman&url=http://batmanarkhamknight.warnerbros.fr/wall" class="share tw" id="inapptw2"><img src="../_images/sharetw.png"/></a>';
                   //$ret .= '<a href="#" class="share tw" id="inapptw2"><img src="../_images/sharetw.png"/></a>';
                    
                    // google
                   /* 
                   $ret.='<div class="share gplus">
                    <div class="googlehider">
                    <script type="text/javascript">               
                    function shareState2(p){
                        if(p){
                            if(p.type==\'confirm\'){
                                mwsdk.Analytics.share({
                                    socialNetwork:\'google\',
                                    socialAction:\'share\',
                                    socialTarget:\'http://batmanarkhamknight.warnerbros.fr/wall\',
                                    page:\'http://batmanarkhamknight.warnerbros.fr/wall\'
                                });
                            }
                        }
                    }
                    </script>
                    <g:plusone data-annotation="none" data-action="share" onendinteraction="shareState2" data-href="http://batmanarkhamknight.warnerbros.fr/wall"></g:plusone>        
                    </div>  
                    <img src="../_images/sharegp.png" class="mygoogle" />
                    </div>';
                */
                    // facebook
                    $ret .= '<a href="#" id="fbsharecrea" class="share fb"><img src="../_images/sharefb.png"/></a>';
                    
                    
                    $ret .= '</span></div>';
                   
                    
                   $ret.='<script type="text/javascript">
                            $(\'#fbsharecrea\').click(function(e){
                                e.preventDefault();
                                FB.ui({
                                    method:\'feed\',
                                    name: \'Batman x Me\',
                                    link: \'http://batmanarkhamknight.warnerbros.fr/wall\',
                                    picture: \'http://batmanarkhamknight.warnerbros.fr/_capture/'.$row['namefic'].'\',
                                    description: \'Votez pour mon armure de Batman : Arkham Knight !\',
                                    caption: \'Je viens de personnaliser le masque et la cape de Batman, votez pour ma création\'

                                    },function(d){

                                    if(d!=null) {
                                        // analytics share
                                        mwsdk.Analytics.share({
                                            socialNetwork:\'facebook\',
                                            socialAction:\'feed\',
                                            socialTarget:\'http://batmanarkhamknight.warnerbros.fr/wall\',
                                            page:\'http://batmanarkhamknight.warnerbros.fr/wall\'
                                        });                   
                                    }; 
                                });
                                return false;
                            });
                            
                             // partage sur TW 
                             
                            $(\'#inapptw2\').click(function(e){
                                e.preventDefault();
                                var width  = 575,
                                height = 400,
                                left   = ($(window).width()  - width)  / 2,
                                top    = ($(window).height() - height) / 2,
                                url    = \'http://twitter.com/share?text=Je viens de personnaliser le masque et la cape de Batman: BatmanX'.$row['firstname'].' '.$row['lastname'].'. Votez pour ma création %23BeTheBatman&url=http://batmanarkhamknight.warnerbros.fr/wall\',
                                opts   = \'status=1\' +
                                \',width=\'  + width  +
                                \',height=\' + height +
                                \',top=\'    + top    +
                                \',left=\'   + left;

                                window.open(url, \'twitter\', opts);

                                return false;
                            });
                            
                            
                            $(\'#likepop\').click(function(e){
                                e.preventDefault();
                                var vid=$(this).attr(\'href\');
                                if(request) request.abort();
                                    request=$.ajax({
                                        url:\'../_inc/votes.php\',
                                        data:{action:\'vote\',mwuser:idwarner,thumb:vid},
                                        type:\'post\',
                                        success:function (result){
                                           if(result==\'ok\'){
                                               var pt=parseInt($(\'#points\').text());
                                               pt++;
                                               //$(\'#points\').text(pt);
                                               $(\'#likepop\').replaceWith(\'<div class="nolikes popno"><span>\'+pt+\'</span></div>\');
                                               loadvignettes();
                                               $(\'#popbkg3\').css(\'visibility\',\'visible\');
                                               request=null;
                                           }
                                        }, 
                                        error:function(result){
                                            request=null;
                                        }
                                    });
                                    return false;
                            });
                            
                            
                             $(\'#closing\').click(function(e){
                                e.preventDefault();
                                $(\'#imgbig\').empty();
                                $(\'#imgbig\').css(\'display\',\'none\');
                                return false;
                            });
                
                            </script>';
                    
                }
                
            }
            
        }
        
    }
    
}

echo $ret;

 // protege $_POST
    function protect($v){
		$v=trim($v);
		//si magic_quotes pas de caractere d'echappement
		if (get_magic_quotes_gpc()==1){
			$r=$v;
		}else{
			$r=addslashes($v);
		}
		$r = htmlspecialchars($r);
		//$conn=new connect();
		//$r = mysql_real_escape_string($r);
		//$res=str_replace(array("'", '"'), "", $r);
		return $r;
    }


?>