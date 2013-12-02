<?php
	session_start();

	include('dbconnect.php');

	$db = @new mysqli($db_server, $db_user_name, $db_password, $db_name);
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		exit();
	}

	if (isset($_GET)) {
		$search_query = "select * from users, reports, locations where user_id=users.id and locations.id=location_id and locations.zip_code=\"".$_GET['searchTerm']."\";";
		unset($_GET);
	} else {
		$search_query = "select * from users, reports where user_id=users.id;";
	}

?>
<html>
<head>
	<title>Who Got Me Sick</title>&nbsp;
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
	<script src="jquery-2.0.3.min.js"></script>
	<script src="overlay.js"></script>
</head>
<body>
	<?php

		if (isset($_SESSION['register_status'])) {
			if ($_SESSION['register_status'] != "success") {
				echo '<script>';
				echo 'showRegisterOverlay();';
				echo '</script>';
			} else {
				echo 'Successfully created user';
			}
			unset($_SESSION['register_status']);
		}
	?>
	<article class="top">
		<div id="logo"></div>
	<?php
		if (isset($_SESSION['valid_user'])) {

			// Button for the account page link
			echo "<div id='account_button' onClick='onAccountClicked();'></div>";

			// Button for the report page link
			echo "<div id='report_button' onClick='onReportClicked();'></div>";

			// Button for logout
			echo "<div id='logout_button' onClick='onLogoutClicked();'></div>";
		} else {

			if (isset($username)) {
				// Tried to log in and failed
				echo "Could not log you in";
			}

			echo "<div id='login_button'></div>";
		}

	?>
	</article>
	<article class="search">
		<form action="index.php" method="get">
			<h3>Search
			<input type="text" name="searchTerm" size="100%" value="Enter a City, State, or Zip code" style="height:30px">
			</h3>
		</form>
	</article>
	<?php

		$result = $db->query($search_query);

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