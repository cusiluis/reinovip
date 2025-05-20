<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("admin.traducciones.php");

$nombreusuario=$_SESSION['usuariolog'];
// valido el usuario en la tabla de logueos
	$tablaL=$Prefijo."logueo";
	$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";
	$ResultL=$mysqli->query($SQL);
	$cantreg=mysqli_num_rows($ResultL);
	if ($cantreg < 1) $nombreusuario="";
//
if ($nombreusuario=="") {
	header("Location: admin.php?mensaje=".$error_accesoindebido.".");
	exit;
}

$CualTabla=$_GET["tabla"];
if (($CualTabla=="") or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": EliminarRegistros.");
    exit;
}

$volver=$_GET['backto'];

$CualCampo=$_POST['cualcampo'];
if ($CualCampo!="") {
	$Contenido=$_POST['contenido'];
	$modo=$_POST['modo'];
	$tabla=$Prefijo.$CualTabla;
	if ($modo==1) {
		$SQL="SELECT ID FROM $tabla WHERE $CualCampo LIKE '%$Contenido%' ";
	} else {
		$SQL="SELECT ID FROM $tabla WHERE $CualCampo='$Contenido' ";
	}
	$ResultConsulta=$mysqli->query($SQL);
	$cantreg=mysqli_num_rows($ResultConsulta);
	if ($modo==1) {
		$SQL="UPDATE $tabla SET Publico='2' WHERE $CualCampo LIKE '%$Contenido%' ";
	} else {
		$SQL="UPDATE $tabla SET Publico='2' WHERE $CualCampo='$Contenido' ";
	}
	//$SQL="DELETE FROM $tabla WHERE $CualCampo='$Contenido' ";
	$ResultEliminar=$mysqli->query($SQL);
	if ($volver=="") {
		header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=".$tit_eliminaron." ".$cantreg." ".$tit_registros.".");
		exit;
	} else {
		if (strpos($volver,'?')) {
		} else {
			$volver.="?ref=1";
		}
		header("Location: ".$volver."&tabla=".$CualTabla."&mensaje=".$tit_eliminaron." ".$cantreg." ".$tit_registros.".");
		exit;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio) ?></title>
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
</head>

<body>
<?php include("topadmin.inc.php"); ?>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td class="listado_titulogeneral" colspan="2">
	<?php echo utf8($tit_eliminandoregistros) ?> :: <?php echo $CualTabla ?>
	</td>
  </tr>
  <form enctype="multipart/form-data"
      action="EliminarRegistros.php?tabla=<?php echo $CualTabla ?>&backto=<?php echo $volver ?>" 
      method="post" 
	  name="FormEliminarRegistros">
  <tr>
	<td width="25%" class="celdatitulo">
	<?php echo utf8($campo_campo) ?>
	</td>
	<td width="75%" class="celdainput">
	<select name="cualcampo" class="admin_campo">
	<option value="" selected class="admin_campo">- <?php echo $campo_seleccione ?> -</option>
	<?php
	$tablaE=$Prefijo."estructura";
	$SQL="SELECT Nombrecampo,Titulocampo FROM $tablaE WHERE Nombretabla='$CualTabla' ";
	$ResultadoEstructura=mysql_query($SQL);
	while ($RegistroEstructura=mysql_fetch_array($ResultadoEstructura)) {
		$TituloCampo=utf8($RegistroEstructura['Titulocampo']);
		$NombreCampo=$RegistroEstructura['Nombrecampo'];
		?>
		<option value="<?php echo $NombreCampo ?>"><?php echo $TituloCampo ?></option>
		<?php
	}
	?>
	</select>
	</td>
  </tr>
  <tr>
	<td width="25%" class="celdatitulo">
	<?php echo utf8($campo_contenido) ?>
	</td>
	<td width="75%" class="celdainput">
	<input type="text" class="admin_campo" name="contenido" size="60" maxlength="100" value="">
	</td>
  </tr>
  <tr>
	<td width="25%" class="celdatitulo">
	<?php echo utf8($campo_modo) ?>
	</td>
	<td width="75%" class="celdainput">
	<input type="radio" name="modo" value="1" checked> <?php echo utf8($campo_incluido) ?><br>
	<input type="radio" name="modo" value="2"> <?php echo utf8($campo_igualvalor) ?>
	</td>
  </tr>
  <tr>
	<td height="16" colspan="2">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
		  <td width="50%" valign="top" align="left">
		  <input name="volver" type="button" class="admin_botones" onClick="javascript:history.back()" value="<< <?php echo utf8($bt_volver) ?>">
		  </td>
		  <td width="50%" valign="top" align="right">
		  <input name="bt_eliminar" type="submit" class="admin_botones" value="<?php echo utf8($bt_eliminarregistros) ?> >>"> 
		  </td>
        </tr>			  
      </table>			
	</td>
  </tr>
  </form>
</table>
</body>
</html>

