<?php
/*

 @author Naren
 @version 1.0

 This script is used to push quotes into sql db.
 MUST only be called by the Java program.

 */

// DB config
$con = mysqli_connect("localhost", "root", "", "quotes");
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// insert data to db
mysqli_query($con, "INSERT INTO quote (title, quote)
VALUES ('" . $_POST['title'] . "', '" . $_POST['quote'] . "')");

// post message if success
echo "success";

// close the connection
mysqli_close($con);
?>
