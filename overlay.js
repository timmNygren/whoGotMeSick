function onClick() {
	var divElement = document.getElementById("displaybox");
	if (divElement.style.display == "none") {
		divElement.style.display = "";
		divElement.innerHTML = "<table height='100%' width='25%'><tr><td><strong>SUCK MAH DICK</strong></td></tr></table>";	
	}
	else {
		divElement.style.display = "none";
		divElement.innerHTML = "";
	}
	return false;

}