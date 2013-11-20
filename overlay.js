$('.login').click(function(event) {
	console.log("Toggling");
	$("#overlay").toggle();
});

// $('html').click(function() {
// 	console.log("Hiding");
// 	$('#overlay').hide();
// });

$('#overlay').click(function(event) {
	console.log("Doing nothing");
	event.stopPropagation();
});
// var showing = -1;
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

