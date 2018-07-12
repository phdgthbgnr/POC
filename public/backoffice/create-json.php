<?php
    $arrjson = array();
    if($handle = opendir('../_img/thumbs300x300/')){
        while(false !== ($entry = readdir($handle))){
            $string = '{
                "name":"",
                "type":"",
                "type_op":"",
                "thumb":"",
                "rep_images":"",
                "images":[],
                "videos":[],
                "text":"",
                "link":"",
                "size":[],
                "techno":[],
                "mobile":0
            }';
            $objjson = json_decode($string);
            // print_r($objjson);
            if($entry != '.' && $entry != '..' && preg_match('/^(.*jpg|.*jpeg|.*gif|.*png|.*svg)$/',$entry)){
                $objjson->thumb = $entry;
                array_push($arrjson, $objjson);
            }
        }

        // $result = array('error'=>'','data'=>$temp);
        $file = '../_json/base.json';
        $sf = file_put_contents($file,json_encode($arrjson));
        if($sf == false){
            $result=array('error'=>'save json file');
            returnJson($result);
        }else{
            $result=array('error'=>'','json'=>'ok');
            returnJson($result);
        }
    }


    function returnJson($rslt){
        header('Content-Type: application/json charset=utf-8');
        echo json_encode($rslt);
    }
    


?>