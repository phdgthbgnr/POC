<?php
ini_set('display_errors', 1);
require_once('_inc/TwitterAPIExchange.php');

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
$getfield = '?q=uncharted4&result_type=recent&count=5';
//$getfield = '?max_id=727839180475252735&q=%23lapureeamere&count=5&include_entities=1&result_type=recent';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$result = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$rsjson = json_decode($result);
print_r($rsjson);
