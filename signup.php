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
			
			//generate random number for user_id. This comes from a random number function defined in functions.php			
			
			//HUUUSK DENNEEEE!!!!!			
			$user_id = random_number(15);
			//Save to database
			$query = "insert into login (user_id, user_name, password) values('$user_id', '$user_name', '$password')";
			mysqli_query($connection, $query);
			
			header("Location: login.php");		
			die;
		}
		else {
			echo "Username can not contain numbers or be blank. Try again";		
		}
	}	
	



?>

<!DOCTYPE html>
<html>
<head>
	<title>SIGNUP</title>
</head>
<body style="background-color: burlywood;">

	<style type="text/css">
	
	#text{
		
		height: 50px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
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
	
	<div id="box">
		<form method="post">
			<div style="font-size: 35px;margin: 10px;color: darkslategray;text-align: center;">PLEASE SIGNUP</div><br>
			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>
					
			<input id="button" type="submit" value="SIGNUP"><br><br>
			
		</form>	
	
	</div>
</body>