<?php

	session_start();

	if (!empty($_POST)) {

		if (isset($_POST['username']) && isset($_POST['password']) && !isset($_SESSION['valid_user'])) {

			include('dbconnect.php');

			$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);
			if (mysqli_connect_errno()) {
				echo 'Error: Could not connect to database.  Please try again later.';
				exit();
			}


			// User has just tried to log in
			$username = $_POST['username'];
			$password = $_POST['password'];

			$loginquery = "select * from users where username=\"".$username."\" and password=\"".$password."\"";

			$loginresult = $db->query($loginquery);
			if ($loginresult->num_rows) {
				$row = $loginresult->fetch_assoc();
				// If they are a registered user in the database
				$_SESSION['valid_user'] = $username;
				$_SESSION['user_id'] = $row['id'];

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