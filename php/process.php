<?php
/*

    @author Naren
    @version 1.0
    
    This script acts as a middle ware between solr and UI. 
    The query from the UI is sent to different cores and results are tabled and 
    sent back to UI via AJAX calls.

*/
    // Replace all @ with + : temp fix
    error_reporting(0);
    $query = str_replace('@', '+',  $_GET['q']);
    $rows = 5;
    $summarySize = 400;
    
    // Query format, using shards
    $wikipediaQuery  =  "http://localhost:8983/solr/collection3/select?q=";


    // Actual query from UI. Return format as JSON
    $wikipediaQuery .=  $query."+!%23REDIRECT&wt=json&fl=title,id,text&rows=" .$rows ;

    // Parameters for highlighting
    $wikipediaQuery .=  "&sort=timestamp+DESC&hl=true&hl.fl=title,text&hl.fragsize=".$summarySize."&hl.simple.pre=<b>&hl.simple.post=<%2Fb>";


    // Gets the JSON response for the built URL from SOLR
    $response = file_get_contents($wikipediaQuery);
    $myArray = json_decode($response, true);


    // Get the ids from highlighting part of JSON and use this array to match  the docs section of JSON
    $highlighting = array();
    foreach($myArray['highlighting'] as $key => $value)
    {
        $highlighting[$key] = $value['text'][0];
    }



 echo "<div class=\"wiki\"><h3>Wikinews</h3><table id=\"example3\"><thead><tr><td></td><td></td></tr><tbody>";
   foreach ($myArray['response']['docs'] as $doc) {
    if(strpos($doc['title'], ':') !== false)
        continue;
        echo "<tr><td><a class = \"fancybox\" target=\"_blank\" href=".getFullUrl('wikinews',$doc['title']).">"     .$doc['title']. " - Wikinews </a></td></tr>";
       // $string = preg_replace("/[http://.+ ]+/i", " ", $highlighting[$doc['id']]);
            //echo "<a target=\"_blank\" href=".getFullUrl('wikipedia',$doc['title']).">"     .$doc['title']. " - Wikipedia </a><br/>";
            $string = preg_replace("/[^a-z\<b\>\<\/b\>]+/i", " ", $highlighting[$doc['id']]);
            echo "<tr><td>".$string . "</td></tr>";
        
    }
   // echo "</div>";
    echo "</tbody></table></div>";


    //echo "</div>";


 $wikiquoteQuery  =  "http://localhost:8983/solr/collection2/select?q=";


    // Actual query from UI. Return format as JSON
    $wikiquoteQuery .= $query."+!%23REDIRECT&wt=json&fl=title,id,text&rows=" .$rows ;

    // Parameters for highlighting
    $wikiquoteQuery .=  "&hl=true&hl.fl=title,text&hl.fragsize=".$summarySize."&hl.simple.pre=<b>&hl.simple.post=<%2Fb>";


    // Gets the JSON response for the built URL from SOLR
    $response = file_get_contents($wikiquoteQuery);
    $myArray = json_decode($response, true);


    // Get the ids from highlighting part of JSON and use this array to match  the docs section of JSON
    $highlighting = array();
    foreach($myArray['highlighting'] as $key => $value)
    {
        $highlighting[$key] = $value['text'][0];
    }



    /* Results for Wikiquote */
   // echo "<div id=\"wikiquote\">";

    echo "<div class=\"wiki\"><h3>Wikiquote</h3><table id=\"example1\"><thead><tr><td></td><td></td></tr><tbody>";
   foreach ($myArray['response']['docs'] as $doc) {
        echo "<tr><td><a class = \"fancybox\" target=\"_blank\" href=".getFullUrl('wikiquote',$doc['title']).">"     .$doc['title']. " - Wikiquote </a></td></tr>";
            //echo "<a target=\"_blank\" href=".getFullUrl('wikipedia',$doc['title']).">"     .$doc['title']. " - Wikipedia </a><br/>";
            echo "<tr><td>".$highlighting[$doc['id']] . "</td></tr>";
        
    }
   // echo "</div>";
    echo "</tbody></table></div>";
    

 $wikinewsQuery  =  "http://localhost:8983/solr/collection1/select?q=";


    // Actual query from UI. Return format as JSON
    $wikinewsQuery .= $query."+!%23REDIRECT&wt=json&fl=title,id,text&rows=" .$rows ;

    // Parameters for highlighting
    $wikinewsQuery .=  "&hl=true&hl.fl=title,text&hl.fragsize=".$summarySize."&hl.simple.pre=<b>&hl.simple.post=<%2Fb>";


    // Gets the JSON response for the built URL from SOLR
    $response = file_get_contents($wikinewsQuery);
    $myArray = json_decode($response, true);


    // Get the ids from highlighting part of JSON and use this array to match  the docs section of JSON
    $highlighting = array();
    foreach($myArray['highlighting'] as $key => $value)
    {
        $highlighting[$key] = $value['text'][0];
    }




     /* Results for Wikinews */
    //echo "<div id=\"wikinews\">";
    echo "<div class=\"wiki\"><h3>Wikipedia</h3><table id=\"example\"><thead><tr><td></td><td></td></tr><tbody>";
    foreach ($myArray['response']['docs'] as $doc) {
        echo "<tr><td><a class = \"fancybox\" target=\"_blank\" href=".getFullUrl('wikipedia',$doc['title']).">"     .$doc['title']. " - Wikipedia </a></td></tr>";
            //echo "<a target=\"_blank\" href=".getFullUrl('wikipedia',$doc['title']).">"     .$doc['title']. " - Wikipedia </a><br/>";
        $string = preg_replace("/[^a-z\<b\>\<\/b\>]+/i", " ", $highlighting[$doc['id']]);
            echo "<tr><td>".$string . "</td></tr>";
        
    }
echo "</tbody></table></div>";
   // echo "</div>";


    /* Footer message: temp fix */
    echo "<br/><br/><em>&copy; 2013. All rights reserved.</em>";


    // This function generates the wikipedia url from the title
    // params: type of wiki - String, title - String
    
    function getFullUrl($wikitype,$title){

        // replace all space with _
    	$title = str_replace(' ','_',$title);
    	$fullurl = "http://en.".$wikitype.".org/wiki/".$title;
    	return $fullurl;
    }

    ?>