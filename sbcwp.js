// helper functions

// find the form elements and submit them to the post relay
function sbcwp_form_submit(){
url = '/wp/postrelay.php?'

file_1 = $('input[name="file_1"]').val()
omitBP = $('input[name="omitBP"]:checked').val()
if (omitBP){
url += 'omitBP='+omitBP+'&'
}

outputType = $('input[name="outputType"]:checked').val()
pdfversion = $('select[name="pdfversion"]').children(':selected').val()
pdfEmbedFonts = $('input[name="pdfEmbedFonts"]:checked').val()
if (pdfEmbedFonts){
url += 'pdfEmbedFonts='+pdfEmbedFonts+'&'
}
svgversion = $('select[name="svgversion"]').children(':selected').val()
svgEmbedFonts = $('input[name="svgEmbedFonts"]:checked').val()
if (svgEmbedFonts){
url += 'svgEmbedFonts='+svgEmbedFonts+'&'
}
rasdpi = $('select[name="rasdpi"]').children(':selected').val()
rasscale = $('select[name="rasscale"]').children(':selected').val()
rasjq = $('select[name="rasjq"]').children(':selected').val()
rasmono = $('input[name="svgEmbedFonts"]:checked').val()
if (rasmono){
url += 'rasmono='+rasmono+'&'
}
url += 'outputType='+outputType+'&pdfversion='+pdfversion+'&svgversion='+svgversion+'&rasdpi='+rasdpi+'&rasscale='+rasscale+'&rasjq='+rasjq
$('div#debug').load(url)
}

