<?php

	session_start();
	include('dbconnect.php');

	$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		header("Location: useraccountsettings.php");
		exit();
	}

	if (isset($_POST['username'])) {
		if (empty($_POST['username'])) {
			$_SESSION['name_change'] = "username_empty";
			$db->close();
			header("Location: useraccountsettings.php");
			exit();
		}
		else if (empty($_SESSION['valid_user'])) {
			// Something would be very wrong here. Immediately logout the user.
			$db->close();
			header("Location: logout.php");
			exit();
		}

		if (preg_match('/\s/', $_POST['username'])) {
			echo "Username has space";
			$_SESSION['name_change'] = "contains_space";
			$db->close();
			header("Location: useraccountsettings.php");
			exit();
		}

		$username = $_POST['username'];
		$previousUsername = $_SESSION['valid_user'];
		
		$update_user_query = "update users set username=? where username=?;";
		$stmt = $db->prepare($update_user_query);
		$stmt->bind_param("ss", $username, $previousUsername);
		$stmt->execute();

		$_SESSION['valid_user'] = $username;
		$_SESSION['name_change'] = "success";
		$db->close();
		header("Location: useraccountsettings.php");
		exit();

	}	
	elseif (isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
		
		if (empty($_POST['oldpassword']) || empty($_POST['newpassword']) || empty($_POST['confirmpassword'])) {
			
			$_SESSION['password_change'] = "empty_field";
			$db->close();
			header("Location: useraccountsettings.php");
			exit();
		}	

		$confirm_password_query = "select password from users where username=\"".$_SESSION['valid_user']."\";";

		$result = $db->query($confirm_password_query);
		$confirm_password = mysqli_fetch_array($result);
		$result->free();

		if ( ($_POST['newpassword'] == $_POST['confirmpassword']) && ($_POST['oldpassword'] == $confirm_password['password']) ) {
			$newpass = $_POST['newpassword'];
			$usertoupdate = $_SESSION['valid_user'];
			$update_password_query = "update users set password=? where username=?;";
			$stmt = $db->prepare($update_password_query);
			$stmt->bind_param("ss", $newpass, $usertoupdate);

			$stmt->execute();
			$_SESSION['password_change'] = "success";
		}
		else {
			$_SESSION['password_change'] = "no_match";
		}

		$db->close();
		header("Location: useraccountsettings.php");
		exit();
	}
	else {

		if (!empty($_POST['showName']) && !empty($_POST['showRate'])) {
			$settings = "11";
		} elseif (!empty($_POST['showName']) && empty($_POST['showRate'])) {
			$settings = "10";
		} elseif (empty($_POST['showName']) && !empty($_POST['showRate'])) {
			$settings = "01";
		} else {
			$settings = "00";
		}

		$_SESSION['settings_change'] = "success";
		$user = $_SESSION['valid_user'];

		$update_settings_query = "update users set settings=? where username=?";
		$stmt = $db->prepare($update_settings_query);

		$stmt->bind_param("ss", $settings, $user);
		$stmt->execute();

		$db->close();
		header("Location: useraccountsettings.php");
		exit();
	}
?>