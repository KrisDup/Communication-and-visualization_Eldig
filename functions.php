<?php

function check_login($con) {
	
	if(isset($_SESSION['user_id'])){
		
		
		$id = $_SESSION['user_id'];
		$query = "SELECT * FROM login WHERE user_id = '$id' limit 1";
		
		$result  = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}


	//Redirect to login
	header("Location: login.php");
	die;
}


//Random number function
function random_number($amount) {

	$temp = "";
	
	//Check to see if amount is too short	
	if($amount < 5) {
		$amount = 5;	
	}
	
	//fill array
	for ($x = 0; $x <= $amount; $x++){
		$temp .= rand(1, 9);	
	}
	
	return $temp; 	
}

?>