<?php
/*
Plugin Name: SBC Wordpress
Description: Wordpress frontend to SBC. This plugin will automatically replace "%sbcwp%" in any page with the form to access SBC.
Version: 1.0
Author: Chris Koepke
Author URI: http://rainbowpdf.com
License: GPL3
*/

if( is_admin() ) // only run this if user is an admin
{

	add_action( 'admin_menu', 'sbcwp_create_menu' ); // hook 'admin_menu' to create the admin menu item for this plugin

}
else
{

	add_action( 'the_content', 'sbcwp_form' ); // hook 'the_content' to modify the content before it's served to the user

}

// replace the first instance of %sbcwp% with the form to access SBC
function sbcwp_form( $content )
{
	preg_match( '/win.*/i', PHP_OS ) ? $slash = "\\" : $slash = "/"; // if this is windows then $slah is a backslash else it's a forward slash

	$SCRIPT_PATH = plugins_url('/sbcwpform.php', __FILE__); // set the URL location of the post proxy script

	$WAIT_PATH = plugins_url('/wait.gif', __FILE__); // set the URL path of the animated wait gif

	// get the filesystem path of sbcwpform.html which contains the form inards and read it to memory
	$sbcwp_form_bits = file_get_contents(getcwd().$slash.'wp-content'.$slash.'plugins'.$slash.plugin_basename(dirname(__FILE__)).$slash.'sbcwpform.html');

	// set the form html
	$sbcwp_form = '<script type="text/javascript" src="'.plugins_url('/sbcwp.js', __FILE__).'"></script>

<div class="wrap">  

	<form method="post" enctype="multipart/form-data" action="'.$SCRIPT_PATH.'" target="sbcwp_upload_target" onsubmit="sbcwp_submit(\''.$WAIT_PATH.'\')">  

		'.$sbcwp_form_bits.'

		<input type="submit" name="submit" value="Submit">

		<div id="sbcwp_message">

			&nbsp;

		</div>

		<iframe id="sbcwp_upload_target" name="sbcwp_upload_target" src="" style="width:0px;height:0px;border:0px;"></iframe>

	</form>

</div>';

	if ( stristr( $content, '%sbcwp_form%' ) ) // if the token is in $content then do this
	{

		return str_replace( '%sbcwp_form%', $sbcwp_form, $content ); // replace the token with the form html and return it

	}
	else // if the token isn't in $content just return $content
	{

		return $content;

	}

}

function sbcwp_create_menu() // create menu bits for the admin settings of this plugin
{

	//create new top-level menu
	add_menu_page( 'SBCWP Plugin Settings', 'SBCWP Settings', 'administrator', __FILE__, 'sbcwp_options','' );

	//call register settings function
	add_action( 'admin_init', 'register_sbcwp_settings' );

}

function register_sbcwp_settings() // register the individual settings
{

	register_setting( 'sbcwp-settings-group', 'sbcwp_server_url' ); // this is the URL of the SBC CGI

}

function sbcwp_options() // display the options form and update options is necissary
{

	if( $_REQUEST['sbcwp_form_submitted'] == 'true' ) // if the form was just submitted then update the values
	{

		update_option( 'sbcwp_server_url', $_REQUEST['sbcwp_server_url'] );

		$optval = $_REQUEST['sbcwp_server_url'];

	}
	else
	{

		$optval = get_option( 'sbcwp_server_url' );

	}

?>
<div class="wrap">

	<h2>SBCWP</h2>

	<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">

		<input type="hidden" name="sbcwp_form_submitted" value="true">

		<table class="form-table">

			<tr valign="top">

				<th scope="row">

					SBC CGI URL

				</th>

				<td>

					<input type="text" size="100" name="sbcwp_server_url" value="<?php echo $optval ?>" />

				</td>

			</tr>

		</table>

		<p class="submit">

			<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />

		</p>

	</form>

</div>

<?php
}

?>
