<?php
$repost = "";
while (list($name, $value) = each($_REQUEST)) {
$repost += $name."=".$value."&";
}
$ch = curl_init('http://rainbowpdf.no-ip.info/cgi-bin/webconverter.py');
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $repost);
curl_exec ($ch);
curl_close ($ch);
?>
