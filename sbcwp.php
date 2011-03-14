<?php
/*
Plugin Name: SBC Wordpress
Description: Wordpress frontend to SBC
Version: 0.1
Author: Chris Koepke, Ben Mendis
Author URI: http://rainbowpdf.com
License: GPL3
*/
if( is_admin() )
{

	add_action( 'admin_menu', 'sbcwp_create_menu' );

}
else
{

	add_action( 'the_content', 'sbcwp_form' );

}

function sbcwp_form($content)
{
	$SCRIPT_PATH = plugins_url('/sbcwpform.php', __FILE__);
	$sbcwp_form_bits = file_get_contents(plugin_basename(dirname(__FILE__)).'sbcwpform.html');
	print $sbcwp_form_bits;
	$sbcwp_form = '<script type="text/javascript" src="'.plugins_url('/sbcwp.js', __FILE__).'"></script>
<div class="wrap">  
	<form method="post" enctype="multipart/form-data" action="'.$SCRIPT_PATH.'" target="sbcwp_upload_target" onsubmit="sbcwp_submit()">  
		'.$sbcwp_form_bits.'
		<input type="submit" name="submit" value="Submit">
		<div id="sbcwp_message">
			&nbsp;
		</div>
		<iframe id="sbcwp_upload_target" name="sbcwp_upload_target" src="" style="width:0px;height:0px;border:0px;"></iframe>
	</form>
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

function sbcwp_create_menu() 
{

	//create new top-level menu
	add_menu_page( 'SBCWP Plugin Settings', 'SBCWP Settings', 'administrator', __FILE__, 'sbcwp_options','' );

	//call register settings function
	add_action( 'admin_init', 'register_sbcwp_settings' );

}

function register_sbcwp_settings()
{

	register_setting( 'sbcwp-settings-group', 'sbcwp_server_url' );

}

function sbcwp_options()
{

	if($_REQUEST['sbcwp_form_submitted'] == 'true')
	{

		update_option('sbcwp_server_url',$_REQUEST['sbcwp_server_url']);

		$optval = $_REQUEST['sbcwp_server_url'];

	}
	else
	{

		$optval = get_option('sbcwp_server_url');

	}

?>
<div class="wrap">
	<h2>SBCWP</h2>
	<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
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
			<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>

<?php
}

?>
