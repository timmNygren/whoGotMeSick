<?php

	session_start();

	if (!empty($_POST)) {

		if (isset($_POST['userid']) && isset($_POST['password']) && !isset($_SESSION['valid_user'])) {

			$db = new mysqli('localhost', 'team17', 'rhubarb', 'team17_database');
			if (mysqli_connect_errno()) {
				echo 'Error: Could not connect to database.  Please try again later.';
				exit();
			}

			// User has just tried to log in
			$userid = $_POST['userid'];
			$password = $_POST['password'];

			$loginquery = "select * from users where username=\"".$userid."\" and password=\"".$password."\"";

			$loginresult = $db->query($loginquery);

			if ($loginresult->num_rows) {
				// If they are a registered user in the database
				$_SESSION['valid_user'] = $userid;
			}

			$db->close();
			header("Location:index.php");
			exit();
		} elseif (isset($_SESSION['valid_user'])) {
			header("Location:index.php");
			exit();
		}
	}

?>