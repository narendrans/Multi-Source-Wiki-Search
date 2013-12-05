<?php
/*

    @author Naren
    @version 1.0
    
    Gets correctly spelled version of a mispelled word from solr.

*/

	error_reporting(0);
	// Query normalization
	$query = str_replace('@', '+',  $_GET['q']);
	$response = file_get_contents("http://localhost:8983/solr/collection2/spell?q=".$query."&wt=xml&indent=true");

	// Remove the xml tags
	$response = strip_tags($response);

	// Get the actual corrected word(s) for a misspelled word
	// Temp fix

	preg_match('/false\s*(.+?)\s*[0-9]+/', $response, $matches);
	$res = $matches[1];
	$querylen = strlen($query);

	$rex = '/^[a-zA-Z][a-zA-Z ]*$/';


	if(preg_match($rex,$res)!='0')
	{
		// Temp fix
		if(strlen($res)<15)
			echo 'Did you mean? <a href="#" onclick="loadFromSpellCheck('."'" .$res."'" .');">'.$res . '</a>';
	}

?>