<?php

	session_start();
	
	include('dbcontrol.php');
	
	$report_query = "insert into reports (user_id, zip_code, symptoms, note, date) values(?, ?, ?, ?, NOW())";
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
	
	$location = $_POST['zip'];


	$stmt->bind_param("iisis", $_SESSION['user_id'], $location, $encoded, $comment);
	$stmt->execute();


	$db->close();

	echo "<p>Report sent!</p>";
	
	header( "refresh:3;url=index.php" );
 	exit();
?>	