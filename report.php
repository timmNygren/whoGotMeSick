<?php
	session_start();
?>	
<html>
<head>
	<title>Who Got Me Sick</title>
	<link rel="stylesheet" type="text/css" href="whogotmesick.css">
</head>
<body id="body">
	<span id="title"><h1>Submit Report</h1></span>
	<div >
		<form action="postreport.php" method="post" id="userform">
			<ul class="checkbox-grid">
				<li><input type="checkbox" name="symptom1" value="1" /><label for="text1">Fever</label></li>
				<li><input type="checkbox" name="symptom2" value="1" /><label for="text2">Cough</label></li>
				<li><input type="checkbox" name="symptom3" value="1" /><label for="text3">Stuffiness</label></li>
				<li><input type="checkbox" name="symptom4" value="1" /><label for="text4">Aches</label></li>
				<li><input type="checkbox" name="symptom5" value="1" /><label for="text5">Chills</label></li>
				<li><input type="checkbox" name="symptom6" value="1" /><label for="text6">Fatigue</label></li>
				<li><input type="checkbox" name="symptom7" value="1" /><label for="text7">Nausea/Vomiting</label></li>
				<li><input type="checkbox" name="symptom8" value="1" /><label for="text8">Diarrhea</label></li>
				<li><input type="checkbox" name="symptom8" value="1" /><label for="text8">Other</label></li>
			</ul>
			<input type="text" name="zip" value = "" pattern="\d*">
			<input type="submit" value="Submit">
		</form>
		<textarea rows="4" cols="50" name="comment" form="userform"></textarea>
	</div>
</body>
</html>	
