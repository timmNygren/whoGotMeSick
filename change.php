<?php
	$db = new mysqli('localhost', 'team17', 'rhubarb', 'team17_database');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		header("Location: sickometer.php");
		exit;
	}
	session_start();
	if (isset($_POST['username'])) {
		if (empty($_POST['username'])) {
			header("Location: sickometer.php");
		}
		else if (empty($_SESSION['valid_user'])) {
			// Something would be very wrong here. Immediately logout the user.
			header("Location: logout.php");
		}
		$update_user_query = "update users set username=".$_POST['username']." where id=".$_SESSION['valid_user'].";";

		$result = $db->query($update_user_query);
		header("Location: sickometer.php");
	}	
	else if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
		if (empty($_POST['oldpassword']) || empty($_POST['newpassword']) || empty($_POST['confirmpassword'])) {
			header("Location: sickometer.php");
		}	
		echo "password changed";
	}
?>