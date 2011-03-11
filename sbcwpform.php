<?php
header("Content-type: text/html");
print "testing... debuging... hard face to keyboard contact";
$url = 'http://rainbowpdf.no-ip.info/cgi-bin/webconverter-urlonly.py';
//$url = $_SERVER['SERVER_NAME'].'/wp/wp-content/plugins/SBCWP/debug.php';
$target_path = '/tmp/'.basename( $_FILES['file_1']['name']);
if(move_uploaded_file($_FILES['file_1']['tmp_name'], $target_path)) {
	$_REQUEST['file_1'] = '@'.$targetpath;
}
$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $_REQUEST);
curl_setopt ($ch, CURLINFO_HEADER_OUT, True);
$ret = curl_exec ($ch);
while ( ( curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200 ) && !curl_errno($ch) )
{
	sleep(1);
};
curl_close ($ch);
print $ret;
?>
