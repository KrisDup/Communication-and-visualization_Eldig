<?php	
	//This one includes the database connection
	//include_once dirname(__FILE__) . '/../includes/database.inc.php';
	$dbServerName = "localhost";
	$dbUsername = "admin";
	$dbPassword = "Teknostart";
	$dbName = "ELDIts";
	
	if(!$connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName)){
		die("Failed to connect!");
	}
?>