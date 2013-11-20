$('document').ready(function() {
	$('#login_button').click(function(event) {
		event.preventDefault();
		console.log("onLoginClicked");
		$('\
			<div id="login_wrapper">\
			<form method="post" action="index.php">\
				<table id="login_overlay">\
					<tr>\
						<td>UserId:</td>\
						<td><input type="text" name="userid"></td>\
					</tr>\
					<tr>\
						<td>Password:</td>\
						<td><input type="password" name="password"></td>\
					</tr>\
					<tr>\
						<td colspan="2" algin="center">\
							<input type="submit" value="Login2">\
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

