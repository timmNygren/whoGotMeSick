<?php
	session_start();

	include('dbconnect.php');

	if (isset($_GET)) {
		if (empty($_GET['searchTerm'])) {
			$search_query = "select * from users, reports where user_id=users.id;";	
		} 
		else {
			$search_query = "select * from users, reports where user_id=users.id and location_id=\"".$_GET['searchTerm']."\";";
			unset($_GET);			
		}

	} 

?>
<html>
<head>
	<title>Who Got Me Sick</title>&nbsp;
	<link rel="stylesheet" type="text/css" href="global.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="report.css">
	<script src="jquery-2.0.3.min.js"></script>
	<script src="overlaycontrol.js"></script>
	<script src="handlebuttonpressed.js"></script>
</head>
<body>
	<?php
		if (isset($_SESSION['register_status'])) {
			if ($_SESSION['register_status'] != "success") {
				echo '<script>';
				echo 'showRegisterOverlay("'.$_SESSION['register_status'].'");';
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
			echo "<div id='report_button'></div>";

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
			<input type="text" name="searchTerm" size="100%" placeholder="Enter a Zip code: e.g. 80401" pattern="\d\d\d\d\d" style="height:30px">
			</h3>
		</form>
	</article>
	<?php
	/*
		<li><input type="checkbox" name="symptom1" value="1" /><label for="text1">Fever</label></li>
				<li><input type="checkbox" name="symptom2" value="1" /><label for="text2">Cough</label></li>
				<li><input type="checkbox" name="symptom3" value="1" /><label for="text3">Stuffiness</label></li>
				<li><input type="checkbox" name="symptom4" value="1" /><label for="text4">Aches</label></li>
				<li><input type="checkbox" name="symptom5" value="1" /><label for="text5">Chills</label></li>
				<li><input type="checkbox" name="symptom6" value="1" /><label for="text6">Fatigue</label></li>
				<li><input type="checkbox" name="symptom7" value="1" /><label for="text7">Nausea/Vomiting</label></li>
				<li><input type="checkbox" name="symptom8" value="1" /><label for="text8">Diarrhea</label></li>
				<li><input type="checkbox" name="symptom9" value="1" /><label for="text9">Other</label></li>
	*/

	
		function parseSymptoms($string) {
			$symptoms = array(
				"0" =>  "Fever",
				"1" =>  "Cough",
				"2" =>  "Stuffiness",
				"3" =>  "Aches",
				"4" =>  "Chills",
				"5" =>  "Fatigue",
				"6" =>  "Nausea/Vomiting",
				"7" =>  "Diarrhea",
				"8" =>  "Other"
			);
			$len = strlen($string);
			$list = "";
			for($i=0; $i < $len; $i++){
				$key = substr($string, $i, 1);
				if($key == '1') {
					$list = $list." ".$symptoms[$i]; 
				}
			}
			return $list;
		}

		$result = $db->query($search_query);
		// echo $search_query;
		if ($result->num_rows == 0) {
			echo "<h1>There are no sicknesses in this area</h1><br>";
		} else {
			while($row = mysqli_fetch_array($result)){
				$timestamp = strtotime($row['date']);
				echo "<article class='main'>";
				echo "<h1><b>User</b>: ". $row['username'] ."</h1>";
				echo "<div class='symptoms'><b>Symptoms</b>: ". parseSymptoms($row['symptoms']) ."</div>";
				echo "<div class='notes'><b>Notes</b>: ". $row['note'] ."</div>";
				echo "<p class='top_right'><b>Date</b>: ". date("jS F o", $timestamp) ."</p>";
				echo "</article>";
			}
		}
		$db->close();
	?>
</body>
</html>