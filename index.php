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
		$u_name = $user_data['user_name'];	
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
	<div id = 'Power Input'></div>
	<div id = 'Charge'></div>
	<div id = 'Battery Temperature'></div>
	<div id = 'Battery Voltage'></div>
	<div id = 'Battery Current'></div>
	<div id = 'IO Voltage'></div>
	<div id = 'IO Current'></div>
	<div id = 'Temperature'></div>
	
	<!--Import the plotting functions -->
	<script src = "plotting.js"></script>
	<script type="text/javascript" >
		var group= '<?php echo $u_name; ?>';
		main(group);
	</script>
	
	</div>	
</body>
</html>