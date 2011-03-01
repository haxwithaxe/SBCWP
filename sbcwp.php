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

	<form id="sbcwp_form">

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
		</select></p> 
		<p><input type="checkbox" name="pdfEmbedFonts" value="on"> Embed Fonts</p>
		<br> 
		<p><b>SVG Options:</b></p> 
		<p>Version: 
		<select name="svgversion"> 
			<option value="SVG1.1" selected>SVG1.1</option> 
			<option value="SVGBasic">SVGBasic</option> 
			<option value="SVGTiny">SVGTiny</option> 
		</select></p> 
		<p><input type="checkbox" name="svgEmbedFonts" value="on"> Embed Fonts</p> 
		<br> 
		<p><b>JPEG/PNG Options:</b></p>
		<p>Image DPI: 
		<select name="rasdpi"> 
			<option value="100">100</option> 
			<option value="200" selected>200</option> 
			<option value="300">300</option> 
			<option value="400">400</option> 
		</select></p> 
		<p>Image Scale (percent):
		<select name="rasscale"> 
			<option value="25">25</option> 
			<option value="50">50</option> 
			<option value="75">75</option> 
			<option value="100" selected>100</option> 
			<option value="150">150</option> 
			<option value="200">200</option> 
			<option value="300">300</option> 
		</select></p>
		<p>Image Quality (percent):
		<select name="rasjq"> 
			<option value="25">25</option> 
			<option value="50">50</option> 
			<option value="75">75</option> 
			<option value="90" selected>90</option> 
			<option value="100">100</option> 
		</select></p> 
		<p><input type="checkbox" name="rasmono" value="on"> Monochrome</p>
		<br>
	</form> 

		<p class="submit">
  
			<input type="button" name="submit" value="Convert" onclick="sbcwp_form_submit()"/>

		</p>

	</form>

	<div id="debug">
		&nbsp;
	</div>

</div>';

	if ( $_REQUEST['sbcwp'] == 'form' )
	{

		return $sbcwp_form;

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
