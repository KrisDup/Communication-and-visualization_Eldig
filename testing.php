<!DOCTYPE html>
<html>

<head>
	<title>SIGNUP</title>
</head>
<body>


	 <?php

	include("connection.php");
	include("functions.php");
	

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		postDate($connection);
	}
	
	function fillTable($testing_conn){
		for($x = 0; $x<= 10; $x++){
		//Something was posted
		$temp = random_number(6);
		$current = random_number(6);
		$query = "insert into testing_data (temp, current) values('$temp', '$current')";
		
		
		//Here you can add more constraints on the username
		if (True){
			echo count($testing_conn);
			mysqli_query($testing_conn, $query);
			sleep(1);
		}
		else {
			echo "Username can not contain numbers or be blank. Try again";		
			}	
		}
	}
	
	function postDate($test_conn) {	
		//Here you can add more constraints on the username
			
			//Read from database
			$query_login = "select temp from testing_data order by date desc limit 50";
			$result = mysqli_query($test_conn, $query_login);
			if($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_all($result);
				foreach ($user_data as $y){
					foreach ($y as $x){
						echo $x;			
					}
					echo "<br>";
				}
			}
			echo "WRONG USERNAME OR PASSWORD";
			
	function posting() {
		postDate($connection);	
	}
			
			

	}
	?>
	
<?php

		function fillTable($testing_conn){
		for($x = 1; $x<= 10; $x++){
		//Something was posted
		$base = "gruppe_";
		$gruppe = $base . strval($x);
		$query = "CREATE TABLE {$gruppe} (power_input FLOAT(2), charge INT, battery_temp INT, bat_v FLOAT(2), bat_i FLOAT(2), io_v FLOAT(2), io_c FLOAT(2), temperature FLOAT(2), date TIMESTAMP PRIMARY KEY)";
		//Here you can add more constraints on the username
		if (True){
			echo count($testing_conn);
			mysqli_query($testing_conn, $query);
			sleep(1);
		}
		else {
			echo "Username can not contain numbers or be blank. Try again";		
			}	
		}
	}

?>
	
	<form method="post">
		<input type="submit" name = "button1" class="button" value = "Button1"/>
	<form>
	
	
	<script type="text/javascript" >
		var x = "<?php "fillTable;"?>"
		document.write(x);
	</script>



</body>

	

</html>