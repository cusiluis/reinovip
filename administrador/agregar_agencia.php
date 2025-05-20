<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");
session_start();
$nombreusuario=$_SESSION['usuariolog'];
?>
<?php 
if($_POST['nombre_agencia'] != ''){
	$nombre = $_POST['nombre_agencia'];
	$descrip = $_POST['descripcion'];
	$lat = $_POST['latitud'];
	$lon = $_POST['longitud'];
	$telefono_1 = $_POST['telefono_1'];
	$telefono_2 = $_POST['telefono_2'];
	$direccion = $_POST['direccion'];
	// print_r($_FILES);exit;
	$SQL="INSERT INTO agencias (nombre_agencia,descripcion,latitud,longitud,telefono_1,telefono_2,direccion) 
	VALUES ('$nombre','$descrip','$lat','$lon','$telefono_1','$telefono_2','$direccion')";
	// echo $SQL;exit;
	$agregar=$mysqli->query($SQL);
	$lastid = "SELECT id from agencias ORDER BY id DESC LIMIT 1";
	$lastid = $mysqli->query($lastid);
	$last = mysqli_fetch_array($lastid);
	$_last = $last['id'];

	if(count($_FILES)>0){

		$tmp_name = $_FILES["imagen"]["tmp_name"];
		$name = $_FILES["imagen"]["name"];
		$archivo=$_FILES['imagen']['name'];
		$medio=$name; 
		$target_path = "../fotos/agencias/".$medio;
		
		if(@move_uploaded_file($tmp_name, $target_path))
		{
			$SQLMP="UPDATE agencias SET imagen_principal='$name' WHERE id='$_last'";	
			$mysqli->query($SQLMP);
		}
	}
	header("Location: http://reinovip.es/administrador/agencias.php");
	die();

	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>BackOffice :: Agregar Agencia</title>
		<?php
		if ($admin_en_utf8==true) {
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
		<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
		<script src="<? //echo $URLSitio?>Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
		<script language="javascript" src="calendar/calendar.js"></script>
		<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
		<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />
		<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="../js/dropzone.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include("topadmin.inc.php"); ?>
		<form enctype="multipart/form-data"
			action="agregar_agencia.php"
			method="post"
			name="FormModificar">
			<table border="0" cellpadding="3" class="admin_form_derecha" cellspacing="0">
				<tr>
					<td class="listado_titulogeneral" colspan="2"><a href="listarTabla.php?tabla=<?php echo $CualTabla?>" class="admin_botones" > &lt;&lt; <?php echo utf8($bt_volver) ?></a>¡
					<?php echo $Item ?> :: Agregar Agencia
				</td>
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
					Nombre Agencia
				</td>
				<td class="celdainput" width="75%">
					<input name="nombre_agencia" class="admin_campo" type="text" size="50" maxlength="50">
				</td>
				
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
					Descripción
				</td>
				<td class="celdainput" width="75%">
					 <textarea name="descripcion" 

			    class="admin_campo"

				cols="<?php echo 2 ?>" 

				rows="<?php echo 10 ?>" 

				wrap="OFF"></textarea>
					<input name="descripcion" class="admin_campo" type="text" size="50" maxlength="50">
				</td>
				
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
					Latitud
				</td>
				<td class="celdainput" width="75%">
					<input name="latitud" class="admin_campo" type="text" size="50" maxlength="50">
				</td>
			</tr>
			<tr>
				<td class="celdatitulo" width="25%">
					Longitud
				</td>
				<td class="celdainput" width="75%">
					<input name="longitud" class="admin_campo" type="text" size="50" maxlength="50">
				</td>
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
					Telefono 1
				</td>
				<td class="celdainput" width="75%">
					<input name="telefono_1" class="admin_campo" type="text" size="50" maxlength="50">
				</td>
				
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
					Telefono 2
				</td>
				<td class="celdainput" width="75%">
					<input name="telefono_2" class="admin_campo" type="text" size="50" maxlength="50">
				</td>
				
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
					Dirección
				</td>
				<td class="celdainput" width="75%">
					<input name="direccion" class="admin_campo" type="text" size="50" maxlength="50">
				</td>
				
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
					Imagen Principal
				</td>
				<td class="celdainput" width="75%">
					<input name="imagen" class="admin_campo" type="file" size="50" maxlength="50">
				</td>
				
			</tr>
			<tr>
				
				<td class="celdatitulo" width="25%">
				<input class="admin_botones" type="submit" value="Agregar" name="submitBtn">
				</td>
				<td class="celdainput" width="75%">
				
				</td>
				
			</tr>
		</table>
	</form>
</body>
</html>