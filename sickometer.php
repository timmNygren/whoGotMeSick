<?php
	session_start();
?>	
<html>
<head>
	<title>Who Got Me Sick</title>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
	<link rel="stylesheet" type="text/css" href="sickometer.css">
</head>
<body id="body">
	<article class="top">
		<h1>whogotmesick.com</h1>
		<div class="login">
			<a href="index.php">Home</a>
		</div>
	</article>
	<?php
		echo 'Welcome '.$_SESSION['valid_user']."!";
	?>
	<article>
		<form action="change.php" method="post">
			<h1>Change User Name</h1>
			<?php
				if (isset($_SESSION['name_change'])) {
					if ($_SESSION['name_change'] == 0) {
						echo "Field is empty<br>";
					} else {
						echo "Username has been changed successfully<br>";		
					}
					unset($_SESSION['name_change']);
				}
			?>
			New user name: <input type="text" name="username"><br>
			<input type="submit">
		</form>
		<form action="change.php" method="post">
			<h1>Change Password</h1>
			<?php
				if (isset($_SESSION['password_change'])) {
					if ($_SESSION['password_change'] == 0) {
						echo "One or more fields missing <br>";
					} elseif ($_SESSION['password_change'] == 1) {
						echo "Passwords DO NOT match<br>";
					} elseif ($_SESSION['password_change'] == 2) {
						echo "Password Successfully changed<br>";
					}
					unset($_SESSION['password_change']);
				}
			?>
			Old password       :<input type="text" name="oldpassword"><br>
			New password       :<input type="text" name="newpassword"><br>
			Confirm Password   :<input type="text" name="confirmpassword"><br>
			<input type="submit">
		</form>
	</article>
	<article>
		<h1>Privacy Settings</h1>
		<form>
		<input type="checkbox" name="vehicle" value="Bike">Show Username<br>
		<input type="checkbox" name="vehicle" value="Car">Show Rating<br>
		<input type="submit">
		</form>
	</article>
	<div id="candiv">
		<h1>Sickometer</h1>
		<canvas id="canvas" width="400" height="300" style="border:1px solid #000000;"></canvas>
		<!-- Loaded after canvas so the element is populated -->
		<script src="sickometer.js"></script>
	</div>
	<div>
		<h1>Sickometer metrics</h1>
		<p>Frequency</p><br>
		<input type="range" name="stuff" min="1" max="10" value="1"><br>
		<p>Severity</p><br>
		<input type="range" name="more stuff" min="1" max="10" value="1"><br>
		<p>Duration</p><br>
		<input type="range" name="points" min="1" max="10" value="1"><br>
	</div>
</body>
</html>