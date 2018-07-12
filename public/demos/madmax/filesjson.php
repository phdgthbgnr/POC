<?php
    
    //ini_set('display_errors','off');    
        
    $json='';
    $quote='"';
    $ret="\r\n";

    $output = '';

    function ListIn($dir, $prefix = '') {
	   $dir = rtrim($dir, '\\/');
	   $result = array();

        foreach (scandir($dir) as $f) {
		  if ($f !== '.' and $f !== '..') {
              if (is_dir("$dir/$f")) {
                  $result[$f] = ListIn("$dir/$f");
              } else {
                 $result[] = $prefix.$f;
              }
          }
        }
        return $result;
    }

    $files=ListIn(dirname(__FILE__));

    //print_r($files);

    function makeList($array, $depth=0, $key_map=TRUE, $path='',$arrpath=array(), $referer='') {
        //Base case: an empty array produces no list
        
        //if (empty($array)) return '';
        
        if (empty($array) || !is_array($array)) return '';
        
        //Recursive Step: make a list with child lists
        //$path='';
        
        //if(!is_array($array)){
        
            foreach ($array as $key => $subArray) {
               if(is_array($subArray)){
                    $path.=$key.'/';
                    if(!in_array($key,$arrpath)) $arrpath[]=$key;
               }
                
               if(empty($referer)) $referer = getcurrentpath();
               $subList = makeList($subArray, $depth+1, $key_map, $path, $arrpath, $referer);
               if($key_map AND $key_map[$key]) $key = $key_map[$key];
               //if($subList) $output .= '<li>' . $key . $subList . '</li>';
               if(count($arrpath)>$depth) array_pop($arrpath);
               //print_r($arrpath);
               //echo '<br/>';
               if(is_array($subArray)){
                    //echo $path.'<br/>';
                    switch($key){
                        default:
                        $output.=$subList;
                        break;

                    }
               }else{
                    
                    $ext = pathinfo($subArray, PATHINFO_EXTENSION);
                    $n = strlen($ext);
                    $n=$n*-1;
                    $noext=substr($subArray,0,$n);
                    $thepath=implode('/',$arrpath);
                    $thepath.='/';
                    switch($ext){
                        case 'jpg':
                        case 'gif':
                        case 'png':
                            $output .= '{"source": "'.$thepath.$subArray.'",'."\n";
                            $output .= '"type": "IMAGE",'."\n";
                            $output .= '"size" : '.filesize($thepath.$subArray).'},'."\n";
                        break;
                        case 'css':
                            $output .= '{"source": "'.$thepath.$subArray.'",'."\n";
                            $output .= '"type": "CSS",'."\n";
                            $output .= '"size" : '.filesize($thepath.$subArray).'},'."\n";
                        break;
                        case 'js':
                            $output .= '{"source": "'.$thepath.$subArray.'",'."\n";
                            $output .= '"type": "SCRIPT",'."\n";
                            $output .= '"size" : '.filesize($thepath.$subArray).','."\n";
                            $output .= '"stopExecution": true },'."\n";
                            
                        break;
                        case 'mp4':
                            //webm
                            $output .= '{"type": "VIDEO",'."\n";
                            echo $thepath.$noext.'webm';
                            if(file_exists($thepath.$noext.'webm')){
                                $output .= '"sources":{'."\n";
                                $output .= '"webm" : {'."\n";
                                $output .= '"source": "'.$referer.$thepath.$noext.'webm",'."\n";
                                $output .= '"size": '.filesize($thepath.$noext.'webm')."\n";
                                $output .= '}'."\n";
                                $output .= '},'."\n";
                            }
                            //ogg
                            if(file_exists($thepath.$noext.'ogv')){
                                $output .= '"sources":{'."\n";
                                $output .= '"ogg" : {'."\n";
                                $output .= '"source": "'.$referer.$thepath.$noext.'ogv",'."\n";
                                $output .= '"size": '.filesize($thepath.$noext.'ogv')."\n";
                                $output .= '}'."\n";
                                $output .= '},'."\n";
                            }
                            //mp4
                            $output .= '"sources":{'."\n";
                            $output .= '"h264" : {'."\n";
                            $output .= '"source": "'.$referer.$thepath.$subArray.'",'."\n";
                            $output .= '"size": '.filesize($thepath.$subArray)."\n";
                            $output .= '}'."\n";   
                            $output .= '}'."\n";
                            $output .= '},'."\n";
                        break;
                    }

                }
            }
        
            //$output.=']}';
            return $output;
       // }
    }


    function getcurrentpath(){
        $curPageURL = "";
        if ($_SERVER["HTTPS"] != "on")
                $curPageURL .= "http://";
         else
            $curPageURL .= "https://" ;
        if ($_SERVER["SERVER_PORT"] == "80")
            $curPageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
         else
            $curPageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            $count = strlen(basename($curPageURL));
            $path = substr($curPageURL,0, -$count);
        return $path ;
    }


    $lists=makeList($files);

?>

<htmL>
    <head>
        <meta charset="utf-8">
        <title>TEST</title>
    </head>
    <body>
        résultat : <br/>
        <?php echo ('{"files":['."\n".$lists.']}') ?>
    </body>
</htmL>