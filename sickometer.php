<?php
	session_start();

	$db = new mysqli('localhost', 'team17', 'rhubarb', 'team17_database');
	if (mysqli_connect_errno()) {
		echo 'Error: Could not connect to database.  Please try again later.';
		header("Location: sickometer.php");
		exit();
	}
?>

<html>
<head>
	<title>Who Got Me Sick</title>&nbsp;
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
	<script src="jquery-2.0.3.min.js"></script>
	<script src="overlay.js"></script>
</head>
<body id="body">
	<article class="top">
		<h1>whogotmesick.com</h1>
		<div id='logout_button'>
			<a href='#' onClick='onLogoutClicked();'>Logout</a>
		</div>
		<div id="home_button">
			<a href="index.php">Home</a>
		</div>
	</article>
	<?php
		echo 'Welcome '.$_SESSION['valid_user']."!";
	?>
	<div class="content">
		<form action="change.php" method="post">
			<span class='section_header'><h1>Change User Name</h1></span>
			<?php
				if (isset($_SESSION['name_change'])) {
					if ($_SESSION['name_change'] == "username_empty") {
						echo "Field is empty<br>";
					} elseif ($_SESSION['name_change'] == "contains_space") {
						echo "User names CAN NOT contain spaces<br>";
					} else {
						echo "Username has been changed successfully<br>";		
					}
					unset($_SESSION['name_change']);
				}
			?>
			New user name: <input type="text" name="username"><br>
			<input type="submit">
		</form>
	</div>
	<div class="content">
		<form action="change.php" method="post">
			<span class='section_header'><h1>Change Password</h1></span>
			<?php
				if (isset($_SESSION['password_change'])) {
					if ($_SESSION['password_change'] == "empty_field") {
						echo "One or more fields missing <br>";
					} elseif ($_SESSION['password_change'] == "no_match") {
						echo "Passwords DO NOT match<br>";
					} elseif ($_SESSION['password_change'] == "success") {
						echo "Password Successfully changed<br>";
					}
					unset($_SESSION['password_change']);
				}
			?>
			Old password       :<input type="password" name="oldpassword"><br>
			New password       :<input type="password" name="newpassword"><br>
			Confirm Password   :<input type="password" name="confirmpassword"><br>
			<input type="submit">
		</form>
	</div>
	<div class="content">
		<span class='section_header'><h1>Privacy Settings</h1></span>		
		<?php
			if (isset($_SESSION['settings_change'])) {
				echo "Settings updated<br>";
				unset($_SESSION['settings_change']);
			}

			$set_settings_query = "select settings from users where username=\"".$_SESSION['valid_user']."\";";
			$result = $db->query($set_settings_query);

			$settings = mysqli_fetch_array($result);

			if ($settings['settings'] == "11") {
				$userCheck = "checked";
				$rateCheck = "checked";
			} elseif ($settings['settings'] == "10") {
				$userCheck = "checked";
				$rateCheck = "unchecked";
			} elseif ($settings['settings'] == "01") {
				$userCheck = "unchecked";
				$rateCheck = "checked";
			} else {
				$userCheck = "unchecked";
				$rateCheck = "unchecked";
			}

			echo "<form action='change.php' method='post'>";
			echo "<input type='checkbox' name='showName' ".$userCheck.">Show Username<br>";
			echo "<input type='checkbox' name='showRate' ".$rateCheck.">Show Rating<br>";
		?>
		<input type="submit">
		</form>
	</div>
	<div id="candiv">
		<span class='section_header'><h1>Sickometer</h1></span>
		<canvas id="canvas" width="400" height="400" style="border:1px solid #000000;"></canvas>
		<!-- Loaded after canvas so the element is populated -->
		<script src="sickometer.js"></script>
	</div>
	<div>
		<span class='section_header'><h1>Sickometer metrics</h1></span>
		<p>Frequency</p><br>
		<input type="range" name="stuff" min="1" max="10" value="1"><br>
		<p>Severity</p><br>
		<input type="range" name="more stuff" min="1" max="10" value="1"><br>
		<p>Duration</p><br>
		<input type="range" name="points" min="1" max="10" value="1"><br>
	</div>
</body>
</html>	
