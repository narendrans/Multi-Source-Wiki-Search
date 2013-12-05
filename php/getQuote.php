<?php
/*

    @author Naren
    @version 1.0
    
    Gets a single random quote from DB to be displayed in UI.

*/

    error_reporting(0);
	$author = str_replace('@', ' ',  $_GET['author']);
	$limit = $_GET['limit'];

	// Database connection
	$con=mysqli_connect("localhost","root","","quotes");
	// Check connection
	if (mysqli_connect_errno())
	{
	 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// Get one random quote each time a query is fired
	$sql = "SELECT title,quote FROM quote WHERE title LIKE '%".$author."%' ORDER BY RAND() LIMIT ".$limit;
	$result = mysqli_query($con,$sql);


	// echo the random quote to be used by front end via AJAX call
	while($row = mysqli_fetch_array($result))
	{
	 	echo "\"".substr($row['quote'], 0,120) ."...\" - " . $row['title'];
	 	echo "<br>";
	}

	mysqli_close($con);
?>