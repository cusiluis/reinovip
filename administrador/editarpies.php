<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio)?></title>
<?php
if ($admin_en_utf8) { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php 
} else { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<?php
} 
?>
<?php include("metatags.txt"); ?>
<link href="admin.css" rel="stylesheet" type="text/css">
<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../js/dropzone.js" type="text/javascript"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
</head>

<body>
<?php include("topadmin.inc.php");
	$provincia_id=$_GET['id'];
 ?>
 <form enctype="multipart/form-data"
	    action="editarpie.php?id=<?php echo $id;?>" 
	    method="post">
<table border="0" cellpadding="6" cellspacing="0" class="admin_form_derecha">
	<tr>
		<td class="listado_titulogeneral" colspan="4">BANNER DE LA PROVINCIA</td>
	</tr>
	<tr>
		<td>TEXTO</td>
		<td>URL</td>
		<td>ACCION</td>
	</tr>  
	<input type="hidden" name="provincia_id" value="<?php echo $provincia_id;?>">
	<?php
				$provincia_id=$_GET['id'];
				$SQLprov="SELECT * FROM reino01_pie where provincia_id='$provincia_id'";
				$Resultprov=$mysqli->query($SQLprov) or die (mysqli_error());

				while ($datas=mysqli_fetch_array($Resultprov)):?>			
					<tr>
						<td>
							<input type="text" name="data[nombre][]" value="<?php echo trim($datas['nombre']);?>"> 
							<input type="hidden" name="data[id][]" value="<?php echo trim($datas['ID']);?>"> 
						</td>
						<td>
							<input type="text" name="data[url][]" value="<?php echo $datas['url']?>"> 
						</td>
						<td>
							<a href="eliminarpie.php?id=<?php echo $datas['ID']?>&provincia_id=<?php echo $provincia_id?>">ELIMINAR</a>
						</td>
					</tr>
				<?php endwhile;?>
	<tr>
		
		<td width="25%" class="celdatitulo">
			datos (coloque colocando por una coma)
			</td>
			<td>
				<input type="text" name="datospie" size="30">
			</td>
	</tr>

	<tr>
		<td></td>
		<td></td>
		<td></td>

		<td><input class="admin_botones" type="submit" value="SUBIR CAMBIOS >>" name="agregar"></td>
	</tr>
</table>
</form>
</body>
</html>




