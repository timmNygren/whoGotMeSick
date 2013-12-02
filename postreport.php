<?php

	session_start();
	
	include('dbconnect.php');

	$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		header("Location: index.php");
		exit();
	}

	$report_query = "insert into reports (user_id, location_id, symptoms, points, note, date) values(?, ?, ?, ?, ?, NOW())";
	$stmt = $db->prepare($report_query);

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
	$location = $_POST['zip'];

	$stmt->bind_param("iisis", $_SESSION['user_id'], $location, $encoded, $points, $comment);
	$stmt->execute();


	$db->close();

	echo "<p>Report sent!</p>";
	
	header( "refresh:3;url=index.php" );
 	exit();
?>	