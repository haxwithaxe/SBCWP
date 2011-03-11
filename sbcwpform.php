<?php
header("Content-type: text/html");
print "testing... debuging... hard face to keyboard contact";
$url = $_SERVER['SERVER_NAME'].'/wp/wp-content/plugins/SBCWP/debug.php';
$post = array('test' => 'testing','testing' => '@debug.php');
$ch = curl_init($url);  
curl_setopt($ch, CURLOPT_POSTFIELDS, $_REQUEST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$postResult = curl_exec($ch);
curl_close($ch);
print "$postResult";

?>
