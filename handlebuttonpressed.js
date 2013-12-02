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

$(document.body).delegate("#report_wrapper", "click", function() {
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

$(document.body).delegate("#report_overlay", "click", function(event) {
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

$(document.body).delegate("#report_button", "click", function(event) {
	event.preventDefault();
	console.log("Report");
	hideOverlays();
	showReportOverlay();
});

function onHomeClicked() {
	window.location.href = "index.php";
}

function onAccountClicked() {
	window.location.href = "useraccountsettings.php";
}

function onLogoutClicked() {
	var ret_val = confirm("Do you really want to logout?");
	if (ret_val) {
		window.location.href = 'logout.php';
	}
}