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
	<title>Who Got Me Sick</title>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
</head>
<body id="body">
	<span id="title"><h1>Submit Report</h1></span>
	<div >
		<form>
			<ul class="checkbox-grid">
				<li><input type="checkbox" name="text1" value="value1" /><label for="text1">Fever</label></li>
				<li><input type="checkbox" name="text2" value="value2" /><label for="text2">Cough</label></li>
				<li><input type="checkbox" name="text3" value="value3" /><label for="text3">Stuffiness</label></li>
				<li><input type="checkbox" name="text4" value="value4" /><label for="text4">Aches</label></li>
				<li><input type="checkbox" name="text5" value="value5" /><label for="text5">Chills</label></li>
				<li><input type="checkbox" name="text6" value="value6" /><label for="text6">Fatigue</label></li>
				<li><input type="checkbox" name="text7" value="value7" /><label for="text7">Nausea/Vomiting</label></li>
				<li><input type="checkbox" name="text8" value="value8" /><label for="text8">Diarrhea</label></li>
				<li><input type="checkbox" name="text8" value="value8" /><label for="text8">Other</label></li>
			</ul>
			<textarea rows="4" cols="50"></textarea>
			<input type="submit" value="Submit">
		</form>
	</div>
</body>
</html>	
