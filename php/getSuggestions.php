<?php
/*

    @author Naren
    @version 1.0
    
    Suggestions generator.
	This file echos list of suggestions for a given query.

*/
	error_reporting(0);
    // Query normalization
	$query = str_replace('@', '+',  $_GET['q']);
	$singleCoreQuery = "http://localhost:8983/solr/collection2/suggest?q=" .  $query ."&wt=json";

	// Get the result json from solr and decode it
	$response = file_get_contents($singleCoreQuery);
	$myArray = json_decode($response, true);

	$a;
	foreach($myArray['spellcheck']['suggestions'][1] as $doc)
		$a= $doc;


	for($i=0;$i<count($a);$i++)
		echo $a[$i] . "<br/>";

?>