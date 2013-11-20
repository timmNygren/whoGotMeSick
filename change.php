<?php
	if (isset($_POST['username'])) {
		if (empty($_POST['username'])) {
			header("Location: sickometer.php");
		}
		echo "usename changed";
	}	
	else if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
		if (empty($_POST['oldpassword']) || empty($_POST['newpassword']) || empty($_POST['confirmpassword'])) {
			header("Location: sickometer.php");
		}	
		echo "password changed";
	}
?>