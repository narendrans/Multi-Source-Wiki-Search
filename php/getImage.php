<?php
/*
@author Naren
@version 1.0
Gets a set of images for the given query using Google AJAX API.
*/

error_reporting(0);
$q = $_GET['q'];
$response = file_get_contents("https://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=" . $q);
$myArray = json_decode($response, true);
$wikiquote = false;
$count = 1;

foreach ($myArray['responseData']['results'] as $doc) {
echo "<a class='fancybox' rel = 'gallery1' href='".$doc['url']."'><img width=\"200\" height = \"200\"src=\"".$doc['url']."\"></a>";
//echo "<br/>" . $doc['titleNoFormatting'] . "</center><br/>";
$count++;
if($count==10)
break;
}
?>
