function init() {

	document.getElementById("sbcwp_form").onsubmit = function() {

		document.getElementById("sbcwp_form").target = "sbcwp_upload_target";

		document.getElementById("sbcwp_upload_target").onload = uploadDone; //This function should be called when the iframe has compleated loading
			// That will happen when the file is completely uploaded and the server has returned the data we need.

	}

}

function uploadDone() { //Function will be called when iframe is loaded

	var ret = frames['sbcwp_upload_target'].document.getElementsByTagName('body')[0].innerHTML;

	if(ret) { //This part happens when the image gets uploaded.

		document.getElementById('sbcwp_message').innerHTML = ret;

	}

}
