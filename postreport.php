<?php

	session_start();
	
	$encoded = "";
	
	for ($i = 1;$i < 10 ; $i++) {
		if (isset($_POST["symptom".$i])) {
			$encoded = $encoded."1";
		}
		else{
			$encoded = $encoded."0";
		}
	}
	
	$db = new mysqli('localhost', 'team17', 'rhubarb', 'team17_database');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		header("Location: index.php");
		exit();
	}
	
	mysqli_query($db,"INSERT INTO reports (user_id, location_id, symptoms, points, note, date) VALUES (".$_SESSION['user_id'].", 2, ".$encoded.", 25, ".$_POST['comment'].", NOW())");
	mysqli_close($db);
	
	echo "<p>Report sent!</p>";
	
	header( "refresh:2;url=index.php" );
 	exit();
?>	