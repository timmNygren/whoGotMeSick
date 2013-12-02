<?php
	session_start();

	echo "Registration Stub";

	$_SESSION['register_status'] = 1;
	header("Location: index.php");
	exit();
?>