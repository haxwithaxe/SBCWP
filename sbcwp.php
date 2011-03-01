<?php
/*
Plugin Name: SBC Wordpress
Description: Wordpress frontend to SBC
Version: 0.1
Author: Chris Koepke, Ben Mendis
Author URI: http://rainbowpdf.com
License: GPL3
*/

function sbcwp_form($content)
{
$sbcwp_form = '<script type="text/javascript" src="/wp/wp-content/plugins/SBCWP/jquery.js"></script>
<script type="text/javascript" src="/wp/wp-content/plugins/SBCWP/sbcwp.js"></script>
<div class="wrap">  

<iframe name="sbcwp_iframe" src="http://rainbowpdf.no-ip.info/cgi-bin/webconverter-iframe.py" width="100%" height="700px">

</iframe>

</div>';

if ( stristr($content, '%sbcwp_form%') )
{

	return str_replace('%sbcwp_form%', $sbcwp_form, $content);

}
else
{

	return $content;

}

}

add_action('the_content','sbcwp_form');

function sbcwp_options()
{

};

?>
