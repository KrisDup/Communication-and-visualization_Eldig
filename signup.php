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
			$query_temp = "SELECT user_name FROM login WHERE user_name='{$user_name}'";
			$result = mysqli_query($connection, $query_temp);
			if (mysqli_num_rows($result) == 0){
				$user_id = random_number(15);
				//Save to database
				$query = "insert into login (user_id, user_name, password) values('$user_id', '$user_name', '$password')";
				mysqli_query($connection, $query);
				$query_create = "CREATE TABLE {$user_name} (power_input VARCHAR(20), charge INT, battery_temp INT, bat_v FLOAT(2), bat_i FLOAT(2), io_v FLOAT(2), io_c FLOAT(2), temperature FLOAT(2), date TIMESTAMP PRIMARY KEY)";
				mysqli_query($connection, $query_create);
				$user_query = "CREATE USER '{€user_name}'@'%' IDENTIFIED BY '{$password}'";
				mysqli_query($connection, $user_query);
				$grant_query = "GRANT ALL ON teknostart.{$user_name} TO  '{$user_name}'@'%' IDENTIFIED BY '{$password}' WITH GRANT OPTION";
				mysqli_query($connection, $grant_query);
				mysqli_query($connection, "FLUSH PRIVILEGES");
				header("Location: login.php");		
				die;
			}
			else {
				echo "Username already exists!!!";			
			}
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
			<div style="font-size: 35px;margin: 10px;color: lightgray;text-align: center;">PLEASE SIGNUP</div><br>
			<input id="text" type="text" name="user_name" placeholder="Username"><br><br>
			<input id="text" type="password" name="password" placeholder="Password"><br><br>
					
			<input id="button" type="submit" value="SIGNUP"><br><br>
			
		</form>	
	
	</div>
</body>
