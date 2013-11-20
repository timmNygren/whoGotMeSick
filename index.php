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
	
	<?php
		$db = new mysqli('localhost', 'team17', 'rhubarb', 'team17_database');
		if (mysqli_connect_errno()) {
			echo 'Error: Could not connect to database.  Please try again later.';
			exit;
		}
		$result = mysqli_query($db,"SELECT * FROM users, reports WHERE user_id=users.id;");
		
		while($row = mysqli_fetch_array($result))
		  {
			echo "<article class='main'>";
			echo "<h1>". $row['username'] ."</h1>";
			echo "<p>". $row['note'] ."</p>";
			echo "<p class='top_right'>". $row['date'] ."</p>";
			echo "<p class='bottom_right'>". $row['points'] ."</p>";
			echo "</article>";
		  }
		
		
		$db->close();
	?>
</body>
</html>