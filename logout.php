<?php

	session_start();

	$redirect = NULL;
	if (!empty($_POST)) {

		if (isset($_GET['location'])) {
			$redirect = $_GET['location'];
		}

		if (isset($_POST['logout'])) {

			unset($_SESSION['valid_user']);
			session_destroy();

			header("Location:".$redirect);
			exit();
		} elseif (isset($_SESSION['valid_user'])) {
			header("Location:".$redirect);
			exit();
		}
	}

?>