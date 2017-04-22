<?php
ini_set('display_errors', 1);
require_once('thirdParty/TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2572452122-VE0DYGRJHaHcBevVBoVRoFphxAKpIzkIcxK7nJx",
    'oauth_access_token_secret' => "9oLSn5y9tmWOSHsr6BceYhNsr2xqCfxwRXDjXYkPosYwy",
    'consumer_key' => "1PnDwlGw55fkyEwgBjbJevbz2",
    'consumer_secret' => "jQCIGMZS5HEdTP5ARFCH5q0gINLI0Zz7EOMffe5YV1sBygKOQm"
);

/**GET INPUT VALUE **/
$twitterUsername = strtolower($_POST['twitterUsername']);

/** Perform a GET request and echo the response **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$twitterUsername.'&count=500&exclude_replies=true&include_rts=true&contributor_details=false';


$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$tweets =$twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

$timestamp = json_decode($tweets, true);
$timeArr = [];
foreach ($timestamp as $key => $value) {
	$date = date('H:i', strtotime($value['created_at']));
	$timeArr[] = str_replace(':', '.', $date);
}

$twt = ['count' => count(json_decode($tweets, true)), 'timestamp' => $timeArr];
echo json_encode($twt);

