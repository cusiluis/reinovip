function mostrar_flash (cualswf,ancho,alto,modo) {
	document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width='+ancho+' height='+alto+'>\n');
	document.write('<param name="movie" value='+cualswf+'>\n');
	document.write('<param name="menu" value="false">\n');
	if (modo!="") {
		document.write('<param name="wmode" value='+modo+'>\n');
	}
	document.write('<param name="quality" value="high">');
	document.write('<embed src='+cualswf+' quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width='+ancho+' height='+alto+'></embed>');
	document.write('</object>');
}

