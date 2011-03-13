function sbcwp_submit() {

	document.getElementById("sbcwp_upload_target").onload = uploadDone;

	var waitImg = '<img src="/wp/wp-content/plugins/SBCWP/wait.gif" alt="Converting your document ..."/>';

	document.getElementById('sbcwp_message').innerHTML = waitImg;

}

function uploadDone() {

	msgobj = top.sbcwp_upload_target.document.getElementById('sbcwp_ret');

	if(!msgobj){

		setTimeout('uploadDone()', 10);

	}else{

		document.getElementById('sbcwp_message').innerHTML = msgobj.innerHTML;

	}

}
