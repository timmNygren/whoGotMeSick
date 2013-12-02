var login_overlay_created = 0;
var register_overlay_created = 0;
var report_overlay_created = 0;

function showLoginOverlay() {
	console.log("Showing Login Overlay");
	if (login_overlay_created == 1) {
			$('#login_wrapper').css("display", "");
			return;
	}
	$('\
		<div id="login_wrapper">\
		<form method="post" action="login.php?location=index.php">\
			<table id="login_overlay">\
				<th><h2>Login</h2></th>\
				<tr>\
					<td class="form_label">Username:</td>\
					<td><input class="form_field" type="text" name="username"></td>\
				</tr>\
				<tr>\
					<td class="form_label">Password:</td>\
					<td><input class="form_field" type="password" name="password"></td>\
				</tr>\
				<tr>\
					<td align="left">\
						<input class="form_submit" type="submit" value="Login">\
					</td>\
					<td align="right" style="padding-right: 25px;">\
						<a id="register_button" href="#">Register</a>\
					</td>\
				</tr>\
			</table>\
		</form>\
	</div>\
	').appendTo(document.body);
	login_overlay_created = 1;
}

function showRegisterOverlay() {
	console.log("Showing Register Overlay");
	if (register_overlay_created == 1) {
		$('#register_wrapper').css("display", "");
		return;
	}
	$('\
		<div id="register_wrapper">\
		<form method="post" action="register.php">\
			<table id="register_overlay">\
				<th><h2>Register</h2></th>\
				<tr>\
					<td class="form_label">Username:</td>\
					<td><input class="form_field" type="text" name="username"></td>\
				</tr>\
				<tr>\
					<td class="form_label">Password:</td>\
					<td><input class="form_field" type="password" name="password"></td>\
				</tr>\
				<tr>\
					<td class="form_label">Confirm:</td>\
					<td><input class="form_field" type="password" name="passconfirm"></td>\
				</tr>\
				<tr>\
					<td align="center" colspan="2">\
						<input class="form_submit" type="submit" value="Register">\
					</td>\
				</tr>\
			</table>\
		</form>\
	</div>\
		').appendTo(document.body);
	register_overlay_created = 1;
}

function showReportOverlay() {
	console.log("Showing Report Overlay");
	if (report_overlay_created == 1) {
		$('#report_wrapper').css("display", "");
		return;
	}
	$('\
		<div id="report_wrapper">\
			<form action="postreport.php" method="post" id="userform">\
				<table id="report_overlay">\
					<th><h1>Submit Report</h1></th>\
					<tr>\
						<td><input type="checkbox" name="symptom1" value="1" /><label for="text1">Fever</label></td>\
						<td><input type="checkbox" name="symptom2" value="1" /><label for="text2">Cough</label></td>\
						<td><input type="checkbox" name="symptom3" value="1" /><label for="text3">Stuffiness</label></td>\
					</tr>\
					<tr>\
						<td><input type="checkbox" name="symptom4" value="1" /><label for="text4">Aches</label></td>\
						<td><input type="checkbox" name="symptom5" value="1" /><label for="text5">Chills</label></td>\
						<td><input type="checkbox" name="symptom6" value="1" /><label for="text6">Fatigue</label></td>\
					</tr>\
					<tr>\
						<td><input type="checkbox" name="symptom7" value="1" /><label for="text7">Nausea/Vomiting</label></td>\
						<td><input type="checkbox" name="symptom8" value="1" /><label for="text8">Diarrhea</label></td>\
						<td><input type="checkbox" name="symptom9" value="1" /><label for="text9">Other</label></td>\
					</tr>\
					<tr>\
					 	<td colspan="3"><input type="text" name="zip" value = "" pattern="\d\d\d\d\d" placeholder="e.g. 80401"></td>\
					</tr>\
					<tr>\
						<td colspan="3"><input type="submit" value="Submit"></td>\
					</tr>\
					<tr>\
						<td colspan="3"><textarea placeholder="Additional notes..." rows="4" cols="50" name="comment" form="userform"></textarea></td>\
					</tr>\
				</table>\
			</form>\
		</div>\
		').appendTo(document.body);
	report_overlay_created = 1;
}

function hideOverlays() {
	$('#login_wrapper').css("display", "none");
	$('#register_wrapper').css("display", "none");
	$('#report_wrapper').css("display", "none");
}