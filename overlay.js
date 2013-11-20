$('document').ready(function() {
	$('#login_button').click(function(event) {
		event.preventDefault();
		console.log("onLoginClicked");
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
						<td colspan="2" algin="center">\
							<input class="form_submit" type="submit" value="Login">\
						</td>\
					</tr>\
				</table>\
			</form>\
		</div>\
		').appendTo(document.body);
	});
});

$(document.body).delegate("#login_wrapper", "click", function() {
	console.log("Hiding");
	$(this).css("display", "none");
});

$(document.body).delegate("#login_overlay", "click", function(event) {
	console.log("Click inside");
	event.stopPropagation();
})

// function onLoginClicked() {
// 	console.log("onLoginClicked");
// 	var overlay = $('\
// 		<div id="overlay">\
// 			<table class="login_overlay">\
// 				<tr>\
// 					<td>\
// 					</td>\
// 				</tr>\
// 			</table>\
// 		</div>\
// 		');
// 	overlay.appendTo(document.body);
// 	showing = 1;
// 	return false;
// }

// $('html').click(function() {
// 	if (showing != 0) {
// 		console.log("Removing overlay");
// 		$('#overlay').remove();
// 		showing = 0;
// 	}
// });

// $('#overlay').click(function(event) {
// 	console.log("Got a click on the overlay");
// 	event.stopPropagation();
// });

