<?php
	session_start();

	if (!empty($_POST)) {

		if (isset($_POST['userid']) && isset($_POST['password'] && isset($_POST['passconfirm'])) {

			include('dbconnect.php');

			$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);
			if (mysqli_connect_errno()) {
				echo 'Error: Could not connect to database.  Please try again later.';
				exit();
			}

			// User has just tried to log in
			$userid = $_POST['userid'];
			$password = $_POST['password'];

			$check_user_query = "select username from users where username=\"".$userid."\";";

			$result = $db->query($check_user_query);

			if ($result->num_rows) {
				$_SESSION['register_status'] = "invalid_name";
			}
		}
	}

	$_SESSION['register_status'] = "test";
	header("Location: index.php");
	exit();
?>