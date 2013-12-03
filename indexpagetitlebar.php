<?php
	echo "<article class='top'>";
	echo "<div id='logo'></div>";
	if (isset($_SESSION['valid_user'])) {	
		echo "<div id='overview_button' onClick='onOverviewClicked();'></div>";
		// Button for the account page link	
		echo "<div id='account_button' onClick='onAccountClicked();'></div>";
		// Button for the report page link
		echo "<div id='report_button'></div>";
		// Button for logout
		echo "<div id='logout_button' onClick='onLogoutClicked();'></div>";
	} 
	else {
		if (isset($username)) {
			// Tried to log in and failed
			echo "Could not log you in";
		}
		echo "<div id='login_button'></div>";
	}
	echo "</article>";
?>