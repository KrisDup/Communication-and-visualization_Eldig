<?php

	include("connection.php");
	include("functions.php");
$people[] = "Heyo";
$people[] = "Halla";
$people[] = "Trym";


//Get Query String

$q = $_REQUEST['q'];


$result = mysqli_query($connection, $q);
if($result && mysqli_num_rows($result) > 0) {
	$user_data = mysqli_fetch_all($result);
	echo json_encode($user_data);			
}







/*
$suggestion = "";

//Get Suggestions

if ($q !==""){
	$q = strtolower($q);
	$len = strlen($q);
	foreach($people as $person){
		if (stristr($q, substr($person, 0, $len))){
			if ($suggestion ===""){
				$suggestion = $person;
			}		
			else {
				$suggestion .= ", $person";			
			}
		}	
	}
	
}
echo $q;
echo $suggestion === "" ? "No suggestion" : $suggestion;
*/

?>