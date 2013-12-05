<?php
require_once('TwitterApiExchange.php');
$q = str_replace('@', '%20',  $_GET['q']);
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "22251792-by2fotnoINLYOTtgFtzryFPmvCRgZxt1TB2OKr6Id",
    'oauth_access_token_secret' => "Qr70Jm4LQJ940fJcQQ7uxhjfnFfoPWPc4TgvbirVLUwAa",
    'consumer_key' => "rCcwyVa8h3ych7Gp0Zkg",
    'consumer_secret' => "g3eez0Dc2XZ0OQY3FYYIkYflpRckSZ6Zx3usgGkLLfg"
);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$requestMethod = 'GET';
$getfield = '?q='.$q.'&result_type=recent';

// Perform the request
$twitter = new TwitterAPIExchange($settings);
$result=  $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
             
        //echo $result;
          $myArray = json_decode($result, true);   
          
          $count  = 0;
          echo "<marquee>";
   foreach($myArray["statuses"] as $status) {
       echo $status["text"] . "&nbsp;&nbsp;&nbsp;&nbsp;";
       $count++;
       if($count==9)
       break;
}
echo "</marquee>";          

?>