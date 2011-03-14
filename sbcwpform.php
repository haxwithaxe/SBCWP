<?php
header("Content-type: text/html");
require_once('./wp-load.php');
//$url = 'http://rainbowpdf.no-ip.info/cgi-bin/webconverter-urlonly.py';
$url = get_option('sbcwp_server_url');
$MAX_WAIT = 120;
$target_path = '/tmp/'.basename( $_FILES['file_1']['name']);
if(move_uploaded_file($_FILES['file_1']['tmp_name'], $target_path)) {
	$_REQUEST['file_1'] = "@$target_path";
}
$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $_REQUEST);
curl_setopt ($ch, CURLINFO_HEADER_OUT, True);
if ( $ret = curl_exec ($ch) ){

	print $ret;

}else{

	print 'Error: '.$_SERVER['SCRIPT_FILENAME'].' '.curl_error($ch);

}
curl_close ($ch);
?>
