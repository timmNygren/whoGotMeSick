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
			// unset($_POST['searchTerm']);			
		}

		$defaultPreviousTime = mktime(12, 0, 0, date('m'), date('d')-14, date('Y'));

		if (empty($_GET['d1'])) {
			$previousDate = date('Y-m-d', $defaultPreviousTime);
		} else {
			$previousDate = $_GET['d1'];
		}

		if (empty($_GET['d2'])) {
			$maxDate = date('Y-m-d');
		} else {
			$maxDate = $_GET['d2'];
		}

		if (strtotime($previousDate) > strtotime($maxDate)) {
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
	?>
	<article class="top">
		<div id="logo"></div>
	<?php
		if (isset($_SESSION['valid_user'])) {
		
			echo "<div id='overview_button'>";
			echo "<a href='overview.php'>Overview</a>";
			echo "</div>";
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
			<h3>
			<input type="text" name="searchTerm" size="35%" placeholder="Zip code (leave empty for all areas)" value="<?php echo $search; ?>" pattern="\d\d\d\d\d" style="height:30px">
			<?php
				// $defaultPreviousTime = mktime(12, 0, 0, date('m'), date('d')-14, date('Y'));
				echo 'From: <input type="date" name="d1" value="'.$previousDate.'" max="'.$maxDate.'">  To: <input type="date" name="d2" value="'.$maxDate.'" max="'.date('Y-m-d').'">';
			?>
			<input type="submit" name="Search" id="search_button">
			</h3>
		</form>
	</article>
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

		if ($result->num_rows == 0) {
			echo "<h1>There are no sicknesses in this area at this point in time</h1><br>";
		} else {
			while($row = mysqli_fetch_array($result)){
				$timestamp = strtotime($row['report_date']);
				// echo $timestamp."<br>";
				// echo $row['date'];
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