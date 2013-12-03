<?php
	session_start();

	if (!empty($_POST)) {
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passconfirm'])) {

			include('dbcontrol.php');

			$new_user_query = "insert into users(username, password, settings) values(?, ?, ?);";
			$stmt = $db->prepare($new_user_query);

			$username = $_POST['username'];
			$password = $_POST['password'];
			$settings = "00";

			if (empty($_POST['username'])) {
				$_SESSION['register_status'] = "username_empty";		// Missing username field
				$db->close();
				header("Location: index.php");
				exit();
			} elseif (preg_match('/\s/', $username)) {
				echo "Username has space";
				$_SESSION['register_status'] = "contains_space";		// Username contains space = bad
				$db->close();
				header("Location: index.php");
				exit();
			} elseif ($_POST['password'] != $_POST['passconfirm']) {
				$_SESSION['register_status'] = 'password_mismatch';		// Password and Confirm do not match
				$db->close();
				header("Location: index.php");
				exit();
			}

			$check_user_query = "select username from users where username=\"".$username."\";";

			$result = $db->query($check_user_query);

			if ($result->num_rows) {
				$_SESSION['register_status'] = "invalid_name";			// Name is already taken
				$db->close();
				header("Location: index.php");
				exit();
			}
			$result->free();

			$stmt->bind_param("sss", $username, $password, $settings);
			$stmt->execute();

			$_SESSION['register_status'] = "success";					// Success
			$db->close();
			header("Location: index.php");
			exit();			
		}
	}
?>