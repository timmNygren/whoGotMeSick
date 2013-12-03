<?php
	session_start();
	date_default_timezone_set('America/Denver');
	include('dbcontrol.php');

	if (isset($_GET)) {
		if (empty($_GET['searchTerm'])) {
			$search_query = "select * from users, reports where user_id=users.id ";	
			$search = "";
		} 
		else {
			$search_query = "select * from users, reports where user_id=users.id and zip_code=\"".$_GET['searchTerm']."\" ";
			$search = $_GET['searchTerm'];		
		}

		// Set default previous time to 2 weeks ago from today
		$defaultPreviousTime = mktime(12, 0, 0, date('m'), date('d')-14, date('Y'));
		$regex = "/[0-9]{4}\/[0-9]{2}\/[0-9]{2}/";
		// Checking for previous date
		if (empty($_GET['d1'])) {
			// Use default date if empty
			$previousDate = date('Y-m-d', $defaultPreviousTime);
		} else {
			// Grab date from d1
			$previousDate = $_GET['d1'];
		}

		// Validate d1
		if (!preg_match($regex, $previousDate)) {
			$previousDate = date('Y-m-d', $defaultPreviousTime);
		} else {
			$date1 = date_parse($previousDate);

			if ( !checkdate( $date1['month'], $date1['day'], $date1['year'] ) ) {
				// Not a valid date, set to default
				$previousDate = date('Y-m-d', $defaultPreviousTime);
			}
		}
	

		// Check secondary, later date
		if (empty($_GET['d2'])) {
			// No date supplied
			$maxDate = date('Y-m-d');
		} else {
			// Grab date from d2
			$maxDate = $_GET['d2'];
		}

		// Validate d2
		if (!preg_match($regex, $maxDate)) {
			$maxDate = date('Y-m-d');
		} else {
			$date2 = date_parse($maxDate);

			if ( !checkdate( $date2['month'], $date2['day'], $date2['year'] ) ) {
				// Not a valid date, set to default
				echo "Not a valid date";
				$maxDate = date('Y-m-d');
			}			
		}


		if (strtotime($previousDate) > strtotime($maxDate)) {
			// Check for previous date being after max date
			$previousDate = date('Y-m-d', $defaultPreviousTime);
			$maxDate = $maxDate;
		}

		$search_query = $search_query.'and reports.report_date between "'.$previousDate.'" and "'.$maxDate.'" order by reports.report_date desc;';
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
				echo 'showRegisterOverlay();';
				echo 'showRegisterErrorText("'.$_SESSION['register_status'].'");';
				echo '</script>';
			} else {
				echo 'Successfully created user';
			}
			unset($_SESSION['register_status']);
		}
		if (isset($_SESSION['login_status'])) {
			echo '<script>';
			echo 'showLoginOverlay();';
			echo 'showLoginErrorText("'.$_SESSION['login_status'].'");';
			echo '</script>';
			unset($_SESSION['login_status']);
		}
		include('indexpagetitlebar.php');
	?>
	</article>
	<div class="search_area">
		<form action="index.php" method="get">
			<h3>
			<input type="text" name="searchTerm" size="35%" placeholder="Zip code (leave empty for all areas)" value="<?php echo $search; ?>" pattern="\d\d\d\d\d" style="height:30px">
			<?php
				echo 'From: <input type="date" name="d1" value="'.$previousDate.'" max="'.$maxDate.'">  To: <input type="date" name="d2" value="'.$maxDate.'" max="'.date('Y-m-d').'">';
			?>
			<input type="submit" value="Search" id="search_button">
			</h3>
		</form>
	</div>
	<?php
	
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

		if (empty($result)) {
			echo "<h1>There are no sicknesses in this area at this point in time</h1><br>";
		} else {
			while($row = mysqli_fetch_array($result)){
				$timestamp = strtotime($row['report_date']);
				echo "<article class='main'>";
				if ($row['settings'] == "1") {
					echo "<h1><b>User</b>: Anonymous</h1>";
				} else {
					echo "<h1><b>User</b>: ". $row['username'] ."</h1>";	
				}
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