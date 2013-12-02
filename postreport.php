<?php

	session_start();
	
	include('dbconnect.php');

	$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		header("Location: index.php");
		exit();
	}

	$encoded = "";
	
	for ($i = 1;$i < 10 ; $i++) {
		if (isset($_POST["symptom".$i])) {
			$encoded = $encoded."1";
		}
		else{
			$encoded = $encoded."0";
		}
	}

	if (isset($_POST['comment'])) {
		if (!empty($_POST['comment'])) {
			$comment = $_POST['comment'];
		} else {
			$comment = "NULL";
		}
	}
	$points = 0;
	$time = "NOW()";
	$location = $_POST['zip'];
	$report_query = "insert into reports (user_id, location_id, symptoms, points, note, date) values(?, ?, ?, ?, ?, NOW())";
	$stmt = $db->prepare($report_query);
	
	$stmt->bind_param("iisis", $_SESSION['user_id'], $location, $encoded, $points, $comment);
	$stmt->execute();
	// mysqli_query($db,"INSERT INTO reports (user_id, location_id, symptoms, points, note, date) VALUES (".$_SESSION['user_id'].", 2, ".$encoded.", 25, ".$_POST['comment'].", NOW())");
	// mysqli_close($db);
	$db->close();
	echo "<p>Report sent!</p>";
	
	header( "refresh:5;url=index.php" );
 	exit();
?>	