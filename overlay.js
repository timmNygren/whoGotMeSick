function onClick() {
	var divElement = document.getElementById("displaybox");
	if (divElement.style.display == "none") {
		divElement.style.display = "";
		divElement.innerHTML = 
		"\
		<div height='100%' width='100%'> \
		<table style='margin: auto; background-color:#ffffff; height:40%; width:40%;'>\
			<tr>\
				<td>\
					This is a test.\
				</td>\
			</tr>\
		</table>\
		</div>\
		";	
	}
	else {
		divElement.style.display = "none";
		divElement.innerHTML = "";
	}
	return false;

}