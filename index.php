<?php
	$db = new mysqli('localhost', 'team17', 'rhubarb', 'team17_database');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit;
	}
	
	$db->close();

?>
<html>
<head>
	<title>Who Got Me Sick</title>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
	<script src="overlay.js"></script>
	<style>
	#displaybox {
		z-index: 10000;
		opacity: 0.5;
		background-color:#000000;
		position:fixed; top:0px; left:0px; width:100%; height:100%; text-align:center; vertical-align:middle;
	}
	</style>
	<div id="displaybox" style="display: none;"></div>
</head>
<body>
	<article class="top">
		<span class="title"><h1>whogotmesick.com</h1></span>
	<div class="login">
		<a href="#" onclick="return onClick();">Login</a>
	</div>
	<div class="account">
		<a href="sickometer.php">Account</a>
	</div>
	</article>
	<article class="main">
	  <h1>User</h1>
	  <p>Test Text</p>
	  <p class="top_right">11/10/2012</p>
	  <p class="bottom_right">9001 points</p>
	</article>

	<article class="main">
	  <h1>User</h1>
	  <p>Test Text</p>
	  <p class="top_right">11/10/2012</p>
	  <p class="bottom_right">9001 points</p>
	</article>

	<article class="main">
	  <h1>User</h1>
	  <p>Test Text</p>
	  <p class="top_right">11/10/2012</p>
	  <p class="bottom_right">9001 points</p>
	</article>
	
</body>
</html>