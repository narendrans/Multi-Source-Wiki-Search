<?php
/*

    @author Naren
    @version 1.0
    
    Gets a list of related words from online theasaurus.
    $finalCount represents the number of related words to be chosen.

*/
    
error_reporting(0);
$query = str_replace('@', '+',  $_GET['q']);
$finalCount = 3;
$temp = 0;
$response = file_get_contents("http://words.bighugelabs.com/api/1/eb1bd19b42620e661f36c4ee1b20d505/".$query."/");
$toClient  = "";

if(strlen($response)<4)
{
	echo "Expanded queries are not available for your query.";
}
else{
$expandedQueries = explode("\n", $response);

for($i=0;$i<count($expandedQueries);$i++){

$expandedQueries[$i] = strtolower($expandedQueries[$i]);
	if($query==$expandedQueries[$i])
		unset($expandedQueries[$i]);
}
$expandedQueries = array_values($expandedQueries);

for($i=0;$i<count($expandedQueries);$i++){
$temp++;
if($temp>3)
break;
$toClient = $toClient . $expandedQueries[$i] . " ";
}

echo 'Would you like to try this query? <a href="#" onclick="loadFromExpandedQueries('."'" .trim($toClient)."'" .');">'.trim($toClient) . '</a>';
}
?>