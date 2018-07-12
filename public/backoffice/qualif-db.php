<?php 

    header('Content-Type: text/html charset=utf-8');

    $zoomrep = '../zooms/';
    $demorep = '../demos/';

    $jsonstr = file_get_contents('../_json/base.json');
    $arrjson = json_decode($jsonstr, true);
    foreach($arrjson['datas'] as $k => $v){

        $rep = '';
        $rep = $v['rep_images'];
        if(empty($rep)) echo 'no rep for : '.$v['name'];


        $arrimg = array();
        foreach($v['images'] as $im){
            array_push($arrimg,$im);
        }

        if(count($arrimg) == 0) echo 'no image for : '.$v['name'].'<br/>';

        foreach($arrimg as $im){
            if(!file_exists($zoomrep.$rep.'/'.$im)) echo 'no image : '.$im.' for '.$zoomrep.$rep.'<br/>';
        }

        $link='';
        $link = $v['link'];
        if(!empty($link)){
            if(count($v['banner'] > 0)){
                foreach($v['banner'] as $o){
                    // print_r($o);
                    $repban = $o['w'].'x'.$o['h'];
                    if(!file_exists($demorep.$link.'/'.$repban.'/index.html')) echo 'no index file or no rep for : '.$demorep.$link.'/'.$repban.'<br/>';
                }
            }else{
                if(!file_exists($demorep.$link.'/.index.php') && !file_exists($demorep.$link.'/.index.html')) echo 'no index file for : '.$demorep.$rep.'<br/>';
            }

        }
    }
?>