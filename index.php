<?php
	session_start();

	include('dbconnect.php');

	$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit();
	}

?>
<html>
<head>
	<title>Who Got Me Sick</title><br>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
	<script src="jquery-2.0.3.min.js"></script>
	<script src="overlay.js"></script>
</head>
<body>
	<?php

		if (isset($_SESSION['register_status'])) {
			echo "REGISTER STATUS FAILED";
			echo '<script type="text/javascript">';
			echo 'toggleRegister();';
			echo '</script>';
			unset($_SESSION['register_status']);
		}
	?>
	<article class="top">
		<span id="title"><h1>whogotmesick.com</h1></span>
	<?php
		if (isset($_SESSION['valid_user'])) {

			// Button for the account page link
			echo "<div id='account_button'>";
			echo "<a href='sickometer.php'>Account</a>";
			echo "</div>";

			// Button for the report page link
			echo "<div id='report_button'>";
			echo "<a href='report.php'>Report</a>";
			echo "</div>";

			// Button for logout
			echo "<div id='logout_button'>";
			echo "<a href='#' onClick='onLogoutClicked();'>Logout</a>";
			echo "</div>";
		} else {

			if (isset($userid)) {
				// Tried to log in and failed
				echo "Could not log you in";
			}

			echo "<div id='login_button'>";
			echo "<a href='#'>Login</a>";
			echo "</div>";
		}

	?>
	</article>
	
	<?php

		$result = mysqli_query($db,"SELECT * FROM users, reports WHERE user_id=users.id;");
		
		while($row = mysqli_fetch_array($result)){
			$timestamp = strtotime($row['date']);
			echo "<article class='main'>";
			echo "<h1><b>User</b>: ". $row['username'] ."</h1>";
			echo "<div class='symptoms'><b>Symptoms</b>: ". $row['symptoms'] ."</div>";
			echo "<div class='notes'><b>Notes</b>: ". $row['note'] ."</div>";
			echo "<p class='top_right'><b>Date</b>: ". date("jS F o", $timestamp) ."</p>";
			echo "<p class='bottom_right'><b>Points</b>: ". $row['points'] ."</p>";
			echo "</article>";
		  }

		$db->close();
	?>
</body>
</html>