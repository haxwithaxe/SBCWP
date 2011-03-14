<?php
/*
Plugin Name: SBC Wordpress
Description: Wordpress frontend to SBC
Version: 0.1
Author: Chris Koepke, Ben Mendis
Author URI: http://rainbowpdf.com
License: GPL3
*/

if ( !is_admin() )
{

	add_action( 'the_content', 'sbcwp_form' );

}
else
{

	add_action( 'admin_menu', 'sbcwp_create_menu' );

}

function sbcwp_form($content)
{
   $SCRIPT_PATH = plugin_url('/sbcwpform.php', __FILE__);
	$sbcwp_form = '<script type="text/javascript" src="/wp/wp-content/plugins/SBCWP/sbcwp.js"></script>
<div class="wrap">  
	<form method="post" enctype="multipart/form-data" action="'.$SCRIPT_PATH.'" target="sbcwp_upload_target" onsubmit="sbcwp_submit()">  
		<input type="hidden" name="sbcwp_form_submitted" value="true">
		<p>File name: <input name="file_1" type="file" size="50"></p>
		<p><input type="checkbox" name="omitBP" value="on" checked> Omit Blank Pages</p> 
		<p><b>Output Format:</b></p> 
		<p><input type="radio" name="outputType" value="PDF" checked> PDF</p> 
		<p><input type="radio" name="outputType" value="SVG"> SVG</p> 
		<p><input type="radio" name="outputType" value="JPEG"> JPEG</p> 
		<p><input type="radio" name="outputType" value="PNG"> PNG</p> 
		<p><input type="radio" name="outputType" value="XPS"> XPS</p> 
		<p><input type="radio" name="outputType" value="INX"> INX</p> 
		<p><input type="radio" name="outputType" value="Flash"> <font color="red"><b>Flash</b></font></p> 
		<p><input type="radio" name="outputType" value="TIFF"> <font color="red"><b>TIFF</b></font></p> 
		<p><input type="radio" name="outputType" value="MTIFF"> <font color="red"><b>MTIFF</b></font></p> 
		<br> 
		<p><b>PDF Options:</b></p>
		<p>Version: 
			<select name="pdfversion"> 
				<option value="PDF1.3">PDF1.3</option> 
				<option value="PDF1.4" selected>PDF1.4</option> 
				<option value="PDF1.5">PDF1.5</option> 
				<option value="PDF1.6">PDF1.6</option> 
				<option value="PDF1.7">PDF1.7</option> 
			</select>
		</p> 
		<p><input type="checkbox" name="pdfEmbedFonts" value="on"> Embed Fonts</p>
		<br> 
		<p><b>SVG Options:</b></p> 
		<p>Version: 
			<select name="svgversion"> 
				<option value="SVG1.1" selected>SVG1.1</option> 
				<option value="SVGBasic">SVGBasic</option> 
				<option value="SVGTiny">SVGTiny</option> 
			</select>
		</p> 
		<p><input type="checkbox" name="svgEmbedFonts" value="on"> Embed Fonts</p> 
		<br> 
		<p><b>JPEG/PNG Options:</b></p>
		<p>Image DPI: 
			<select name="rasdpi"> 
				<option value="100">100</option> 
				<option value="200" selected>200</option> 
				<option value="300">300</option> 
				<option value="400">400</option> 
			</select>
		</p> 
		<p>Image Scale (percent):
			<select name="rasscale"> 
				<option value="25">25</option> 
				<option value="50">50</option> 
				<option value="75">75</option> 
				<option value="100" selected>100</option> 
				<option value="150">150</option> 
				<option value="200">200</option> 
				<option value="300">300</option> 
			</select>
		</p>
		<p>Image Quality (percent):
			<select name="rasjq"> 
				<option value="25">25</option> 
				<option value="50">50</option> 
				<option value="75">75</option> 
				<option value="90" selected>90</option> 
				<option value="100">100</option> 
			</select>
		</p> 
		<p><input type="checkbox" name="rasmono" value="on"> Monochrome</p>
		<br>
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

?>
<div class="wrap">
	<h2>SBCWP</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'sbcwp-settings-group' ); ?>
		<?php do_settings( 'sbcwp-settings-group' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					SBC CGI URL
				</th>
				<td>
					<input type="text" name="sbcwp_server_url" value="<?php echo get_option('sbcwp_server_url'); ?>" />
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" />
		</p>
	</form>
</div>

<?php
}

?>
