<?php
/* This is not a wordpress module.
 * This IS a post request proxy.
 */
header("Content-type: text/html"); // set the headers

require_once('../../../wp-load.php'); // bootstrap wordpress functionality

$url = get_option('sbcwp_server_url'); // get the SBC CGI URL 


// grab the file being uploaded and repack it into the $_REQUEST array
$target_path = '/tmp/'.basename( $_FILES['file_1']['name']); // set the place the file will go until we reupload it 

if(move_uploaded_file($_FILES['file_1']['tmp_name'], $target_path)) // if there is a file to move and it moves successfully then do this
{

	$_REQUEST['file_1'] = "@$target_path"; // repackage the file into the $_REQUEST array

}

// setup curl and submit the post request to the server
$ch = curl_init($url); // init curl with the URL from the settings page

curl_setopt ($ch, CURLOPT_POST, 1); // make sure curl submits a post request

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // make curl return the response instead of just printiing it

curl_setopt ($ch, CURLOPT_POSTFIELDS, $_REQUEST); // give curl the data to post

curl_setopt ($ch, CURLINFO_HEADER_OUT, True); // i don't remember what this does :P

if ( $ret = curl_exec ($ch) ) // if there is a response then do this
{

	print $ret; // print the response

}
else // if there was no response then do this
{

	print 'Error: '.$_SERVER['SCRIPT_FILENAME'].' '.curl_error($ch); // print the error message and this script's name

}

curl_close ($ch); // close the curl object when we're done with it
?>
