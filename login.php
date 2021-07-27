<?php
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//Something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];	
		
		

		//Here you can add more constraints on the username
		if (!empty($user_name) && !empty($password)){
			
			//Read from database
			$query_login = "select * from login where user_name = '$user_name' limit 1";
			$result = mysqli_query($connection, $query_login);
			if($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_assoc($result);
				if($user_data['password'] == $password) {
					$_SESSION['user_id'] = $user_data['user_id'];				
					header("Location: index.php");
					die;
				}
			}
			echo "WRONG USERNAME OR PASSWORD";
		}
		else {
			echo "USERNAME CAN NOT BE BLANK";		
		}
	}	
?>

<html>
<head>
	<title>Login</title>
</head>
<body style="background-color: powderblue;">

	<style type="text/css">
	
	#text{
		
		height: 50px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		border-color: darkslategray;
		width: 100%;
		margin: auto;	
	}
	
	#button {
	
		padding: 10px;
		width: 250px;
		color: white;
		border-radius: 5px;
		background-color: firebrick;
		border: none #aaa;
		font-size: 20px;
		width: 100%;
			
	}
	
	#box{
	
		margin: auto;
		width: 300px;
		padding: 50px;
	}
	
	</style>
	
	<div id="box">
		<form method="post">
			<div style="font-size: 35px;margin: 10px;color: darkslategray;text-align: center;">PLEASE LOGIN</div><br>
			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>
					
			<input id="button" type="submit" value="LOGIN"><br><br>
			
			<a href="signup.php">Signup here! </a><br><br>
		</form>	
	
	</div>
	
</body>
</html>
