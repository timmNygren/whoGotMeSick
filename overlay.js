var overlay_created = 0;
$('document').ready(function() {
	$('#login_button').click(function(event) {
		if (overlay_created == 1) {
			$('#login_wrapper').css("display", "");
			return;
		}
		event.preventDefault();
		console.log("onLoginClicked");
		$('\
			<div id="login_wrapper">\
			<form method="post" action="index.php">\
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
						<td colspan="2" algin="center">\
							<input class="form_submit" type="submit" value="Login">\
						</td>\
					</tr>\
				</table>\
			</form>\
		</div>\
		').appendTo(document.body);
		overlay_created = 1;
	});
});

$(document.body).delegate("#login_wrapper", "click", function() {
	console.log("Hiding");
	$(this).css("display", "none");
});

$(document.body).delegate("#login_overlay", "click", function(event) {
	console.log("Click inside");
	event.stopPropagation();
});

$(document.body).delegate("#logout_button", "click", function(event) {
	event.preventDefault();
	console.log("Logout");

});

function onLogoutClicked() {
	var ret_val = confirm("Do you really want to logout?");
	if (ret_val) {
		window.location.href = 'logout.php';
	}
}


