function loadTab(tab){
	Array.prototype.slice.call(document.getElementsByClassName("tab")).forEach(function(v,k){
		v.setAttribute("style", "display: none;");
	});

	document.getElementById(tab).setAttribute("style", "display: block;");
}

function requestInvite(){
	document.getElementById("main").innerHTML = "<iframe src='https://docs.google.com/forms/d/1iVrDDlanD9Ems27OhICPa79h90XG5TITDxAi2eA9owc/viewform' style='border: 0;' frameborder=0 height=50% width=50%></iframe>";
}

function shortenURL(){
	document.getElementById("url").disabled = true;
	jQuery.ajax({
		cache: false,
		url: "/shorten.php",
		type: "POST",
		data: {
			longurl: jQuery("#url").val()
		}
	}).done(function(f){
		document.getElementById("error").innerHTML="<font color='blue'>Your shortened URL is <a href='" + f + "'>" + f + "</a></font>";
	}).fail(function(e){
		document.getElementById("error").innerHTML="<font color='red'>Error: " + e + "</font>";
	}).always(function(e){
		document.getElementById("url").disabled = false;
		document.getElementById("url").value = "";
	});
}

function paste(){
	document.getElementById("pastecontents").disabled = true;
	jQuery.ajax({
		cache: false,
		url: "/paste.php",
		type: "POST",
		data: {
			paste: jQuery("#pastecontents").val()
		}
	}).done(function(f){
		document.getElementById("error_p").innerHTML="<font color='blue'>Your paste is available at <a href='" + f + "'>" + f + "</a></font>";
	}).fail(function(e){
		document.getElementById("error_p").innerHTML="<font color='red'>Error: " + e + "</font>";
	}).always(function(e){
		document.getElementById("pastecontents").disabled = false;
		document.getElementById("pastecontents").value = "";
	});
}
