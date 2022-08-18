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
<body>

	<style type="text/css">
	
	#myVideo {
		  position: fixed;
		  right: 0;
		  bottom: 0;
		  min-width: 100%;
		  min-height: 100%;
		  z-index: -1
	}
	#text{
		
		height: 50px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		border-color: black;
		width: 100%;
		margin: auto;	
	}
	
	#button {
	
		padding: 10px;
		width: 250px;
		color: white;
		border-radius: 5px;
		background-color: peru;
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
	
	<div>
		<video autoplay muted loop id="myVideo">
			<source src="Elektrifisering og digitalisering _ NTNU.mp4" type="video/mp4">
		</video>
	</div>
	
	
	<div id="box">
		<form method="post">
			<div style="font-size: 35px;margin: 10px;color:darkgrey;text-align: center; border-color: black;border-radius: 5px">PLEASE LOGIN</div><br>
			<input id="text" type="text" name="user_name" placeholder="Username"><br><br>
			<input id="text" type="password" name="password" placeholder="Password"><br><br>
					
			<input id="button" type="submit" value="LOGIN"><br><br>
			
			
			<a href="signup.php" style="color: white" >Signup here! </a><br><br>
		
		</form>	
	
	</div>
	
</body>
</html>
