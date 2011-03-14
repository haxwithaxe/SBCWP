function sbcwp_submit(waitPath) // when the SBC interface form is submitted do this stuff
{

	document.getElementById("sbcwp_upload_target").onload = uploadDone; // set the onload event action of the iframe to uploadDone

	document.getElementById('sbcwp_message').innerHTML = '<img src="'+waitPath+'" alt="Converting your document ..."/>'; // show an animated wait gif until the iframe is done loading

}

function uploadDone() // once the iframe has loaded try to grab the response from it
{

	msgobj = top.sbcwp_upload_target.document.getElementById('sbcwp_ret'); // try to load the contents of the iframe 

	if(!msgobj) // if the reponse is null then do this
	{

		setTimeout('uploadDone()', 10); // wait for 10ms and try again

	}
	else
	{

		document.getElementById('sbcwp_message').innerHTML = msgobj.innerHTML; // set the contents of the message area to the contents of the iframe

	}

}
