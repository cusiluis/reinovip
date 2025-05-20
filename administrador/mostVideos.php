<?php 
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
$Item=$_POST['id'];
$sqlVid="select * from reino01_video_escort where IdEscort='$Item'";
$queryVid=$mysqli->query($sqlVid);
	echo "<tr> 
    <td class='listado_titulogeneral' colspan='2'>";
      echo "INFORMACIÓN MULTIMEDIA VIDEOS"; ?>
      <?php echo $CualTabla ?>
    </td>
  </tr>
  <?php while ($recVideoDat = mysqli_fetch_array($queryVid)) { ?>
  <tr>
  	<td width='25%' class='celdatitulo'><?php 
	$radioVal="";
	if ($recVideoDat['Principal'] == 1)
	{$radioVal="checked='checked'";}
	echo "
	<p><label><input type='radio' onClick='principalVideos(".$recVideoDat['ID'].",".$Item.")' $radioVal >Principal</p></label>
	<input type='button' value='Eliminar' onClick='eliminarVideos(".$recVideoDat['ID'].",".$Item.")' class='admin_botones'>"; ?></td>
  	<td align="center" class='celdainput'> 
			<?php echo "
			<object width='600' height='500'><param name='movie' value='http://www.youtube.com/v/".$recVideoDat['Video']."'></param><embed src='http://www.youtube.com/v/".$recVideoDat['Video']."' type='application/x-shockwave-flash' width='400' height='400'></embed></object>
			";
			?>
	</td>
  </tr>
  <?php 
  } 
  echo "<tr>
	<td width='25%' class='celdatitulo'>Cargar Videos
	</td>
	<td width='75%' class='celdainput' align='center'>
	<form action='videos.php' method='post' enctype='multipart/form-data' target='secc_videos' onSubmit='startSubirVideos();' >
	<br><div class='upload'><input name='txtVideo' type='text' size='40' /></div>
	<p id='f1_video_form' align='center'><input name='idEscort' type='hidden' value='$Item' />
	<p><label><input type='checkbox' name='imgPrincipal' value='1' />Video principal</label></p>
	<input type='submit' name='submitBtn' value='Guardar' class='admin_botones' /></p>
	<p id='f1_video_process' style='visibility:hidden'>Cargando...<img src='img/loader.gif' /></p>
	<iframe id='secc_videos' name='secc_videos' style='width:0;height:0;border:0px solid #fff;'></iframe></form>";
	echo "
	</td>
  </tr>"; ?>