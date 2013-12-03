<?php
	session_start();
	include("dbcontrol.php");
?>

<html>
<head>
	<title>Who Got Me Sick</title>&nbsp;
	<link rel="stylesheet" type="text/css" href="global.css">
	<link rel="stylesheet" type="text/css" href="useraccountsettings.css">
	<script src="jquery-2.0.3.min.js"></script>
	<script src="handlebuttonpressed.js"></script>
</head>
<body id="body">
	<?php
		include('auxpagetitlebar.php');
		echo 'Welcome '.$_SESSION['valid_user']."!";
	?>
	<div class="content">
		<form action="updateusersettings.php" method="post">
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
			New user name: <input type="text" name="username" autocomplete="off"><br>
			<input type="submit">
		</form>
	</div>
	<div class="content">
		<form action="updateusersettings.php" method="post">
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

			echo "<form action='updateusersettings.php' method='post'>";
			echo "<input type='checkbox' name='showName' ".$userCheck.">Show Username<br>";
			echo "<input type='checkbox' name='showRate' ".$rateCheck.">Show Rating<br>";
		?>
		<input type="submit">
		</form>
	</div>
	<div class='content'>
		<span class='section_header'><h1>Sickometer</h1></span>
		<canvas id="sickometer" width="400" height="400"></canvas>
		<!-- Loaded after canvas so the element is populated -->
		<script src="sickometer.js"></script>
	</div>

	<?php

		function getSeverityForSymptoms($symptoms) {
			return 1;
		}
		$get_user_reports_query = "select * from reports where user_id=".$_SESSION['user_id'].";";
		$reports_array = $db->query($get_user_reports_query);
		$get_user_join_date_query = "select DATEDIFF(date_joined, NOW()) as time from users where id=".$_SESSION['user_id'].";";
		$join_date_array = $db->query($get_user_join_date_query);
		$joined = $join_date_array->fetch_assoc();
		$days_since_join = $joined['time'];
		$total_reports = $reports_array->num_rows;
		if ($days_since_join == 0) {
			$frequency = 0;
		}
		else {
			$frequency = $total_reports / $days_since_join / 7;
		}
		$total_severity = 0;
		for ($i=0; $i<$total_reports; $i++) {
			$row = $reports_array->fetch_assoc();
			$total_severity = $total_severity + getSeverityForSymptoms($row['symptoms']);
		}
		$percent = $total_severity + $total_reports / 2;
		echo "<script>updateArrow(".$percent.");</script>";
		echo "<div class='content'>";
		echo "<span class='section_header'><h1>Sickometer metrics</h1></span>";
		echo "<p>Frequency</p>";
		echo "<div class='center'><canvas id='freq_canvas' class='c-slider' width='400' height='50'></canvas></div><br>";
		echo "<p>Severity</p>";
		echo "<div class='center'><canvas id='sev_canvas' class='c-slider' width='400' height='50'></canvas></div><br>";
		echo "</div>";
		echo "<script>updateFrequencySlider(".$frequency."); updateSeveritySlider(".$total_severity.");</script>";
	?>

</body>
</html>	
