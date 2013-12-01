<html>
<head>
	<title>Who Got Me Sick</title>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
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
	<div class="content">
		<form action="change.php" method="post">
			<span class='section_header'><h1>Change User Name</h1></span>
			New user name: <input type="text" name="username"><br>
			<input type="submit">
		</form>
	</div>
	<div class="content">
		<form action="change.php" method="post">
			<span class='section_header'><h1>Change Password</h1></span>
			Old password       :<input type="text" name="oldpassword"><br>
			New password       :<input type="text" name="newpassword"><br>
			Confirm Password   :<input type="text" name="confirmpassword"><br>
			<input type="submit">
		</form>
	</div>
	<div class="content">
		<span class='section_header'><h1>Privacy Settings</h1></span>
		<form>
		<input type="checkbox" name="vehicle" value="Bike">Show Username<br>
		<input type="checkbox" name="vehicle" value="Car">Show Rating<br>
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
