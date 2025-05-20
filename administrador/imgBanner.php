<?php 
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
$Item=$_POST['id'];
$banAncho=0;
$banAlto=0;
$sqlBanner="SELECT b.ID, b.Alto, b.Ancho, b.Descripcion, b.Nombre, b.ArchivoMultimedia FROM reino01_Banner b, reino01_banner_posicion bp WHERE b.Posicion=bp.ID AND b.ID='$Item' ";
$ejecBanner=$mysqli->query($sqlBanner) or die (mysqli_error());
$arryBanner=mysqli_fetch_array($ejecBanner);
$revisarBanner=explode(".",$arryBanner['ArchivoMultimedia']);
$swSwf=0;
if($revisarBanner[1]=="swf")
{$swSwf=1;}
	$banAncho=$arryBanner['Ancho'];
	$banAlto=$arryBanner['Alto'];
?>
<?php 
if($arryBanner['ArchivoMultimedia']=="")
{echo "<tr>
	<td width='25%' class='celdatitulo'>Cargar imagenes
	</td>
	<td width='75%' class='celdainput' align='center'>
	<form action='subirBanner.php' method='post' enctype='multipart/form-data' target='uploadBann_target' onSubmit='startUploadBann();' >
	<br><div class='uploadBann'><input name='myfile' type='file' /></div>
	<p id='f1_upload_form_bann' align='center'><input name='idBann' type='hidden' value='$Item' />
	<input type='submit' name='submitBtn' value='Subir imagen' class='admin_botones' /></p>
	<p id='f1_upload_process_bann' style='visibility:hidden'>Cargando...<img src='img/loader.gif' /></p>
	<iframe id='uploadBann_target' name='uploadBann_target' style='width:0;height:0;border:0px solid #fff;'></iframe></form>";
	echo "
	</td>
  </tr>";}
else
	{echo "<tr><td>";
		if($swSwf==1)
		{?>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="<?php echo $banAncho; ?>" height="<?php echo $banAlto; ?>">
          <param name="movie" value="../banners/<?php echo $arryBanner['ArchivoMultimedia']; ?>">
          <param name="quality" value="high">
          <embed src="../banners/<?php echo $arryBanner['ArchivoMultimedia']; ?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="<?php echo $banAncho; ?>" height="<?php echo $banAlto; ?>"></embed>
		  </object>
		<?php }
		else
		{echo "<a href='http://".$arryBanner['Nombre']."' title='".$arryBanner['Descripcion']."' alt='".$arryBanner['Descripcion']."' target='_blank'> <img src='../banners/".$arryBanner['ArchivoMultimedia']."' width='$banAncho' height='$banAlto'></a>";}
		?>
		<br><br>
		<input type='button' value='Eliminar imagen banner' onClick='eliminarFotosBanner("<?php echo $arryBanner['ID']?>")' class='admin_botones'></td>
	<?php 
	echo "</td></tr>";
	}
?>