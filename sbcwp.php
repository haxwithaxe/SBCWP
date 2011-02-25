<?php
/*
Plugin Name: SBC Wordpress
Description: Wordpress frontend to SBC demo
Version: 0.1
Author: Chris Koepke
Author URI: http://antennahouse.com
License: GPL3
*/

$sbcwp_form = file_get_contents('sbcwp_form');

function sbcwp_form()
{

	return $sbcwp_form;

}

add_filter('the_content','sbcwp_form');

function sbcwp_options()
{

};

?>
