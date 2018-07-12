<?php
  #!/usr/local/php5.6/bin/php
  //ini_set('display_errors', 1);
  //$path = dirname(__FILE__);
  // chemain de la commande CRON : rmcdunlop/_crontask/rmcdunlop-cron.php

/*
  require_once($path.'/TwitterAPIExchange.php');
  require_once($path.'/classtwit.php');
  require($path.'/connect-cron.php');
*/

  require_once('TwitterAPIExchange.php');
  require_once('classtwit.php');
  require('connect-cron.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2835235913-LV3Qd065VCbZAM3YOWvA9pF8QM1u4BqvsQ2soYo",
    'oauth_access_token_secret' => "dE3C4WhC1NT4GBv2lFVwVuXwHRxQIyIpUqIvMVCM70xV6",
    'consumer_key' => "P9TH0pfpsldbvna4uLFrEVERq",
    'consumer_secret' => "fdghhZUoOC3h7Mey1dZeQLJJMEWr3MP7ourO73VfBTMNj9JaiE"
);

/*

// URL for REST request, see: https://dev.twitter.com/docs/api/1.1/

$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';


// POST fields required by the URL above. See relevant docs as above

$postfields = array(
    'screen_name' => 'usernameToBlock',
    'skip_status' => '1'
);


// Perform a POST request and echo the response
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();

*/

// Perform a GET request and echo the response
// Note: Set the GET field BEFORE calling buildOauth();
//$url = 'https://api.twitter.com/1.1/followers/ids.json';
$url = 'https://api.twitter.com/1.1/search/tweets.json';


// test si dejà des twitt sont enregistrés
$lastid = '';
$conn = new connect();
$sql = "SELECT id_twt FROM $conn->tb2 WHERE id=1";
$query = $conn->execute_query($sql);
if($query){
  $lastid = mysql_result($query,0);
}

if(empty($lastid)){
  //$getfield = '?q=%2324hdementes&result_type=recent&count=50';
  $getfield='?q=%2324hdementes%20OR%20%2324hdementes1%20OR%20%2324hdementes2&result_type=recent&count=50';
}else{
  $getfield='?q=%2324hdementes%20OR%20%2324hdementes1%20OR%20%2324hdementes2&result_type=recent&count=50&since_id='.$lastid;
  //$getfield = '?q=%2324hdementes&result_type=recent&count=50&since_id='.$lastid;
}


//?q=%23lapureeamere%20OR%20%23lapureemauve&result_type=recent&count=7&since_id=731116866383564801
//$getfield = '?max_id=727834831342714880&q=%23lapureeamere&count=7&include_entities=1&result_type=recent';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$result = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$rsjson = json_decode($result);
//print_r($rsjson);
//echo(count($rsjson->statuses));
//echo isset($rsjson->search_metadata->next_results);
$result = 0;
$max = 100;

//$arrtwits = array();
if($rsjson){
  if(count($rsjson->statuses)>0){

      //$conn = new connect();

      foreach ($rsjson->statuses as $value) {

        //echo '----------------------------------------------'."\n";
        // print_r($value);
        // echo '----------------------------------------------'."\n";

        $curtwit = new classtwit($conn);

        $curtwit->id = $value->id_str;

        $hashtag = $value->entities->hashtags;
        $htarr = array();
        $endtext = 0;
        foreach($hashtag as $htg){
          //print_r($htg->text);
          array_push($htarr, $htg->text);
          $endtext = $endtext == 0 ? $htg->indices[0] : $endtext;
        }

        $curtwit->text = $value->text;

        /*
        if($endtext == 0){
          $curtwit->text = utf8_decode($value->text);
        }else{
          $curtwit->text = substr(utf8_decode($value->text), 0, $endtext);
        }
        */

        $curtwit->htags = $htarr;

        if(isset($value->entities->media) && count($value->entities->media)>0){
          $curtwit->image = $value->entities->media[0]->media_url; // url image
          $curtwit->urltwimg =  $value->entities->media[0]->url; // url raccourcie du twitt
        }

        if(isset($value->retweeted_status)) $curtwit->retwitt = 1;

        $curtwit->username = $value->user->name;
        $curtwit->userscreen = $value->user->screen_name;

        $curtwit->imgprofil = $value->user->profile_image_url;

        //array_push($arrtwits, $curtwit);

        //if(empty($lastid)) $lastid = 0;
        $curtwit->saveTwitt();

      }

      $conn->close_db();

  }
}

if($_POST){
  print_r($_POST);
}

?>
