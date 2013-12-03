var login_overlay_created = 0;
var register_overlay_created = 0;
var report_overlay_created = 0;
var overlays_dirty = 0;

function showLoginOverlay() {
	console.log("Showing Login Overlay");
	if (login_overlay_created == 1) {
			$('#login_wrapper').css("display", "");
			return;
	}
	$('\
		<div id="login_wrapper">\
		<form method="post" action="login.php">\
			<table id="login_overlay">\
				<th><h2>Login</h2></th>\
				<tr>\
					<td class="form_label">Username:</td>\
					<td><input class="form_field" type="text" name="username" autocomplete="off"></td>\
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
	console.log("Login overlay created");
}

function testFunction(a) {
	if (typeof(a) === 'undefined') {
		a = 10;
	}
	alert("A" + a);
}

function showRegisterOverlay() {

	console.log("Showing Register Overlay");
	if (register_overlay_created == 1) {
		console.log("Skipping recreate");
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
					<td><input class="form_field" type="text" name="username" autocomplete="off" required>\
				</tr>\
				<tr>\
					<td class="form_label">Password:</td>\
					<td><input class="form_field" type="password" name="password" required></td>\
				</tr>\
				<tr>\
					<td class="form_label">Confirm:</td>\
					<td><input class="form_field" type="password" name="passconfirm" required></td>\
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

function showRegisterErrorText(error) {
	console.log("In showRegisterErrorText");
	if (register_overlay_created == 0) {
		showRegisterErrorText(error);
	}
	if (typeof(error) === 'undefined') {
		error = "ok";
		return;
	}
	else if (error === "invalid_name") {
		console.log("Register error: Used username");
		$('<tr><td colspan="2">Name already in use</td></tr>').appendTo($('#register_overlay'));
		overlays_dirty = 1;
	}
}

function showLoginErrorText(error) {
	if (login_overlay_created == 0) {
		showLoginErrorText(error);
	}
	if (typeof(error) === 'undefined') {
		error = "ok";
		return;
	}
	else if (error === "invalid_credentials") {
		console.log("Login error: Invalid");
		$('<tr><td colspan="2">Username or password is incorrect</td></tr>').appendTo($('#login_overlay'));
		overlays_dirty = 1;
	}
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
					<th colspan="2"><h1>Submit Report</h1></th>\
					<tr>\
						<td width="33%"><input type="checkbox" name="symptom1" value="1" /><label for="text1">Fever</label></td>\
						<td width="33%"><input type="checkbox" name="symptom2" value="1" /><label for="text2">Cough</label></td>\
						<td width="33%"><input type="checkbox" name="symptom3" value="1" /><label for="text3">Stuffiness</label></td>\
					</tr>\
					<tr>\
						<td width="33%"><input type="checkbox" name="symptom4" value="1" /><label for="text4">Aches</label></td>\
						<td width="33%"><input type="checkbox" name="symptom5" value="1" /><label for="text5">Chills</label></td>\
						<td width="33%"><input type="checkbox" name="symptom6" value="1" /><label for="text6">Fatigue</label></td>\
					</tr>\
					<tr>\
						<td width="33%"><input type="checkbox" name="symptom7" value="1" /><label for="text7">Nausea/Vomiting</label></td>\
						<td width="33%"><input type="checkbox" name="symptom8" value="1" /><label for="text8">Diarrhea</label></td>\
						<td width="33%"><input type="checkbox" name="symptom9" value="1" /><label for="text9">Other</label></td>\
					</tr>\
					<tr>\
					 	<td colspan="3">Zip Code: <input type="text" name="zip"  placeholder="e.g. 80401" autocomplete="off" required>*</td>\
					</tr>\
					<tr>\
						<td colspan="3"><textarea placeholder="Additional notes..." rows="4" cols="50" name="comment" form="userform"></textarea></td>\
					</tr>\
					<tr>\
						<td colspan="2"><input type="submit" value="Submit"></td>\
						<td>* required</td>\
					</tr>\
				</table>\
			</form>\
		</div>\
		').appendTo(document.body);
	report_overlay_created = 1;
}

function hideOverlays() {
	if (overlays_dirty == 1) {
		$('#login_wrapper').remove();
		$('#register_wrapper').remove();
		$('#report_wrapper').remove();
		login_overlay_created = 0;
		register_overlay_created = 0;
		report_overlay_created = 0;
		overlays_dirty = 0;
	}
	$('#login_wrapper').css("display", "none");
	$('#register_wrapper').css("display", "none");
	$('#report_wrapper').css("display", "none");
}