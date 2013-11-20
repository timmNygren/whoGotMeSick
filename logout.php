<?php

session_start();

	$_SESSION['logout'] = TRUE;

header("Location: index.php");

?>