var login_overlay_created = 0;
var register_overlay_created = 0;

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
					<td><input class="form_field" type="text" name="userid"></td>\
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
					<td><input class="form_field" type="text" name="userid"></td>\
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

function hideOverlays() {
	$('#login_wrapper').css("display", "none");
	$('#register_wrapper').css("display", "none");
}

$('document').ready(function() {
	$('#login_button').click(function(event) {
		showLoginOverlay();
	});
});

$(document.body).delegate("#login_wrapper", "click", function() {
	console.log("Hiding");
	hideOverlays();
});

$(document.body).delegate("#register_wrapper", "click", function() {
	console.log("Hiding");
	hideOverlays();
});

$(document.body).delegate("#login_overlay", "click", function(event) {
	console.log("Click inside");
	event.stopPropagation();
});

$(document.body).delegate("#register_overlay", "click", function(event) {
	console.log("Click inside register overlay");
	event.stopPropagation();
});

$(document.body).delegate("#logout_button", "click", function(event) {
	event.preventDefault();
	console.log("Logout");

});

$(document.body).delegate("#register_button", "click", function(event) {
	event.preventDefault();
	console.log("Register");
	hideOverlays();
	showRegisterOverlay();
});

function onHomeClicked() {
	window.location.href = "index.php";
}

function onAccountClicked() {
	window.location.href = "sickometer.php";
}

function onReportClicked() {
	window.location.href = "report.php";
}

function onLogoutClicked() {
	var ret_val = confirm("Do you really want to logout?");
	if (ret_val) {
		window.location.href = 'logout.php';
	}
}