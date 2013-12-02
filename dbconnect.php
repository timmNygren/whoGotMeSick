<?php
	// Connect to database
	$db_server = 'localhost';
	$db_user_name = 'team17';
	$db_password = 'rhubarb';
	$db_name = 'team17_database';

	$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);

	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit();
	}
?>