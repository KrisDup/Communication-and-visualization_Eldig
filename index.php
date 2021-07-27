<?php
session_start();
	include("connection.php");
	include("functions.php");
	$user_data = check_login($connection);
	
	//Get user_name
	if ($user_data['user_name'] == "kingzaiz1") {
		$u_name = "kingzaiz1";
	}
	else {
		$u_name = substr($user_data['user_name'], 7);	
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Teknostart Login</title>
	<script type = 'text/javascript'src="https://cdn.plot.ly/plotly-latest.min.js"></script>
	
</head>
<body style="background-color: powderblue;">

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
		background-color: firebrick;
		border: none #aaa;
		font-size: 20px;
		width: 20%;
			
	}
	
	#box{
	
		margin: auto;
		width: 90%;
		padding: 50px;
		background-color: powderblue;
	}
	
	</style>
	
	<div id="box">
	
	<h1><center>Overview for group<span style="color: white;"> <?php echo $u_name;?></span></center></h1>
	
	<br>
	<center><input id="button" type="submit" value="LOGOUT", onclick="location.href='logout.php';"></center><br><br>
	

	<div id = 'Temperature'></div>
	<div id = 'Current'></div>
	<div id = 'Voltage'></div>
	
	<!--Import the plotting functions -->
	<script src = "plotting.js"></script>
	
	<script type="text/javascript" >
		main();
	</script>
	
	
	<p>Suggestions: <span id="output" style="font-weigh:bold"></span></p>	

	
	</div>
	
</body>
</html>