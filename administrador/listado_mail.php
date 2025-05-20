<?php

$listado=$_POST['listado'];
$idioma=$_POST['listado_idioma'];


$tablaP=$Prefijo."Producto";

if ($listado=='oferta') {
  $SQL="SELECT * FROM $tablaP WHERE (Publico='1') AND (Esoferta='1')";
  $ResultP=$mysqli->query($SQL);
}else{
  $SQL="SELECT * FROM $tablaP WHERE (Publico='1') AND (Esdestacado='1')";
  $ResultP=$mysqli->query($SQL);
}

 

$nombre_archivo = "listado_mail.html";
$gestor = fopen($nombre_archivo, "w+");


$contenido='
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>'.$TituloSitio.'</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<table width="498" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000" style="border: 2px solid #E1E1E1;">
  <tr> 
    <td height="87" valign="middle" background="'.$URLSitio.'/img/logo_modyf.jpg" style="border-bottom-width: 2px;border-bottom-style: solid;	border-bottom-color: #E1E1E1">&nbsp;</td>
  </tr>';
fwrite($gestor, $contenido);

while ($Producto=mysqli_fetch_array($ResultP)) {

	if ($idioma=='es') $nombre=stripslashes($Producto['Nombre']);
	else $nombre=stripslashes($Producto['Nombre_'.$idioma]);


	$detalle=stripslashes($Producto['Detalle_'.$idioma]);
	$precio_str=number_format($Producto['Preciodefecto'],2,',','.')." &euro; ".$txt_iva_no_incl;
	if ($Producto['Foto1']!="") {
		$foto=$URLSitio."/fotos/productos/1f".$Producto['ID']."g.jpg";
	} else {
		$foto=$URLSitio."/img/nofoto100x133.jpg";
	}
	$contenido='	
	<tr> 
		<td valign="middle" style="background-image: url('.$URLSitio.'/img/bg_top_ofertas.gif);	background-repeat: no-repeat;
	height: 37px;	padding-left:36px;	font-family: Verdana, Arial, Tahoma, sans-serif;	font-size: 11px;	font-weight: bold;	color: #FFFFFF;	vertical-align: middle;	text-align: left;	text-transform: uppercase;	border-bottom: 2px solid #E1E1E1;"><span style="	font-family: monospace, Courier, "Courier New", sans-serif,;	color: #FFFFFF;	text-decoration: none;	text-transform: uppercase;	letter-spacing: -1px;">
<a href="'.$URLSitio.'/producto.php?id='.$Producto['ID'].'"><font color="#FFFFFF" size="5"><strong><font size="4" style="text-decoration:none;">'.$nombre.' </font></strong></font></a></span></td>
	</tr>
	<tr> 
	<td valign="top" style="border-bottom-width: 2px;	border-bottom-style: solid;	border-bottom-color: #81807E;padding:15px;"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr valign="top"> 
		<td width="120"><a href="'.$URLSitio.'/producto.php?id='.$Producto['ID'].'"><img src="'.$foto.'" width="100" height="133" style="border: 1px solid #797876;"></a></td>
		<td width="304"><span style="font-family: Verdana, Tahoma, Arial;font-size: 10px;color: #FFFFFF;text-decoration:none;">'.$detalle.'</span> 
		</td>
		<td width="42"><div align="right"><span style="	font-family: monospace, Courier, "Courier New", sans-serif,;
	color: #FFFFFF;	text-decoration: none;	text-transform: uppercase;	letter-spacing: -1px;"><font color="#E37617"><strong><font color="#FF8040" size="4">'.$precio_str.'</font></strong></font></span></div></td>
		</tr>
	</table></td>
	</tr>';
	fwrite($gestor, $contenido);
	
}

 $contenido='
</table>
<p>&nbsp;</p>
</body>
</html>
';
fwrite($gestor, $contenido);
fclose($gestor);?>
