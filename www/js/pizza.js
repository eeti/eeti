jQuery("html").pasteImageReader(function(r){
	loadTab("uploads-clipboard");
	document.getElementById("uploading").setAttribute("style", "display: block;");
	document.getElementById("uplimg").setAttribute("src", r.dataURL);

	jQuery.ajax({
		method: 'post',
		data: {
			base64: r.dataURL.replace("data:image/png;base64,", "")
		},
		url: 'ufbase64.php'
	}).done(function(b){
		document.getElementById("clstatus").innerHTML = "<font color='blue'>File uploaded to <a href='" + b + "'>" + b + "</a></font>";
	}).fail(function(e){
		document.getElementById("clstatus").innerHTML = "<font color='red'>File upload failed: " + e + "</font>";
	});
});
