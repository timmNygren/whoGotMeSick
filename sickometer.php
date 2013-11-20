<html>
<head>
	<title>Who Got Me Sick</title>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
</head>
<body id="body">
	<article class="top">
		<h1>whogotmesick.com</h1>
		<div class="login">
			<a href="index.php">Home</a>
		</div>
	</article>
	<article>
		<form action="change.php" method="post">
			<h1>Change User Name</h1>
			New user name: <input type="text" name="username"><br>
			<input type="submit">
		</form>
		<form action="change.php" method="post">
			<h1>Change Password</h1>
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
		<canvas id="canvas" width="400" height="400" style="border:1px solid #000000;"></canvas>
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