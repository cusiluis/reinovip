<?php 
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
$Item=$_POST['id'];
$sqlImg="select * from reino01_foto_escort where IdEscort='$Item'";
$queryImg=$mysqli->query($sqlImg);
	echo "<tr> 
    <td class='listado_titulogeneral' colspan='2'>";
      echo "INFORMACIÓN MULTIMEDIA"; ?>
      <?php echo $CualTabla ?>
    </td>
  </tr>
  <?php while ($recImgDat = mysqli_fetch_array($queryImg)) { 
   if (file_exists("../fotos/".$recImgDat['Imagen'])) { ?>
  <tr>
  	<td width='25%' class='celdatitulo'><?php 
	$radioVal="";
	if ($recImgDat['Principal'] == 1)
	{$radioVal="checked='checked'";}
	echo "
	<p><label><input type='radio' onClick='principalFotos(".$recImgDat['ID'].",".$Item.")' $radioVal >Principal</p></label>
	<input type='button' value='Eliminar' onClick='eliminarFotos(".$recImgDat['ID'].",".$Item.")' class='admin_botones'>"; ?></td>
  	<td align="center" class='celdainput'> 
			<?php echo "<img src='../fotos/".$recImgDat['Imagen']."' height='150px' width='150px'>";
			?>
	</td>
  </tr>
  <?php 
  	}
  } 
  echo "<tr>
	<td width='25%' class='celdatitulo'>Cargar imagenes
	</td>
	<td width='75%' class='celdainput' align='center'>
	<form action='upload.php' method='post' enctype='multipart/form-data' target='upload_target' onSubmit='startUpload();' >
	<br><div class='upload'><input name='myfile' type='file' /></div>
	<p id='f1_upload_form' align='center'><input name='idEscort' type='hidden' value='$Item' />
	<p><label><input type='checkbox' name='imgPrincipal' value='1' />Imagen principal</label></p>
	<input type='submit' name='submitBtn' value='Subir archivo' class='admin_botones' /></p>
	<p id='f1_upload_process' style='visibility:hidden'>Cargando...<img src='img/loader.gif' /></p>
	<iframe id='upload_target' name='upload_target' style='width:0;height:0;border:0px solid #fff;'></iframe></form>";
	echo "
	</td>
  </tr>"; ?>