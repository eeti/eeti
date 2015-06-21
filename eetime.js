function loadTab(tab){
	Array.prototype.slice.call(document.getElementsByClassName("tab")).forEach(function(v,k){
		v.setAttribute("style", "display: none;");
	});

	document.getElementById(tab).setAttribute("style", "display: block;");
}

function requestInvite(){
	document.getElementById("main").innerHTML = "<iframe src='https://docs.google.com/forms/d/1iVrDDlanD9Ems27OhICPa79h90XG5TITDxAi2eA9owc/viewform' style='border: 0;' frameborder=0 height=50% width=50%></iframe>";
}

