<html>
<head>
	<title>Who Got Me Sick</title>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
	<script src="sickometer.js"></script>
</head>
<body id="body">
	<article class="top">
		<h1>whogotmesick.com</h1>
		<div class="login">
			<p>Login</p>
		</div>
	</article>
	<article>
		<form action="change.php" method="post">
			<h1>Change User Name</h1><br>
			New user name: <input type="text" name="firstname"><br>
			<input type="submit">
		</form>
		<form action="change.php" method="post">
			<h1>Change Password</h1><br>
			Last name: <input type="text" name="lastname"><br>
			Last name: <input type="text" name="lastname"><br>
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
		<canvas id="canvas" width="400" height="400"
			style="border:1px solid #000000;">
		</canvas>
	</div>
</body>
</html>