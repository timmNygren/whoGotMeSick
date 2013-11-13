function onClick() {
	var divElement = document.getElementById("displaybox");
	if (divElement.style.display == "none") {
		divElement.style.display = "";
		divElement.innerHTML = "<table height='100%' width='100%'><tr><td><a href='#' onClick='return onClick()'><strong>LOGIN HOOKS</strong></a></td></tr></table>";	
	}
	else {
		divElement.style.display = "none";
		divElement.innerHTML = "";
	}
	return false;

}