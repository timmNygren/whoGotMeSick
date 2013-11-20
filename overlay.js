$('document').ready(function() {
	$('#login_button').click(function(event) {
		event.preventDefault();
		console.log("onLoginClicked");
		$('<div id="login_wrapper"><div id="login_overlay"></div></div').appendTo(document.body);
	});
});

$(document.body).delegate("#login_wrapper", "click", function() {
	console.log("Hiding");
	$(this).css("display", "none");
});

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

