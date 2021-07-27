<?php	
	//This one includes the database connection
	//include_once dirname(__FILE__) . '/../includes/database.inc.php';
	$dbServerName = "test.dev";
	$dbUsername = "teknostart_bruker";
	$dbPassword = "abcde12345";
	$dbName = "teknostart_login";
	
	if(!$connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName)){
		die("Failed to connect!");
	}
	
?>