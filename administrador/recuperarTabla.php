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
$NombreTabla=$Prefijo.$CualTabla;
if ((!$CualTabla) or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": recuperarTabla.");
    exit;
}
//
$AdondeVolver="listarTabla.php?tabla=".$CualTabla;
$backto=$_GET['backto'];
if ($backto!="") $AdondeVolver=$backto;

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
<?php 
$tablaE=$Prefijo."estructura";
$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla'";
$ResultadoEstructura=$mysqli->query($SQL);
while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {
    if ($RegistroEstructura['Nombrecampo']=="Nombre") $TituloNombre=$RegistroEstructura['Titulocampo'];
}
$MensajeFiltro="";
$$fid=$_POST["fid"];  // del form de buscar por nº de item, campo "ID"
if ($fid) {
	$MensajeFiltro="Buscando el ítem cuyo ID es <b>$fid</b>";
}
$fnombre=$_POST["fnombre"]; // del form de buscar por campo "Nombre"
if ($fnombre) {
	$MensajeFiltro="Buscando los ítems cuyo Nombre contiene <b>$fnombre</b>";
}

//pongo $TituloNombre / $CamposBusqueda / vector $QueCampo / $cantvec
$CamposBusqueda="Nombre";
$cantvec=1;
$QueCampo[1]="Nombre";
$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla'";
$ResultadoEstructura=$mysqli->query($SQL);
while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {
    if ($RegistroEstructura['Nombrecampo']=="Nombre") $TituloNombre=$RegistroEstructura['Titulocampo'];
}
$tablaT=$Prefijo."titulos";
$SQL="SELECT * FROM $tablaT WHERE Nombretabla='$CualTabla' ORDER BY Nrodeorden,TituloID ASC ";
if ($ResultT=$mysqli->query($SQL)) {
	$kk=0;
	while ($RegT=mysqli_fetch_array($ResultT)) {
		$kk++;
		$cantvec=$kk;
		$QueCampo[$kk]=$RegT['Nombrecampo'];
		if ($kk==1) {
			$CamposBusqueda=$RegT['Nombrecampo'];
			$TituloNombre="";
		} else {
			$CamposBusqueda.=",".$RegT['Nombrecampo'];
		}
		$SQL="SELECT * FROM $TablaEstructura WHERE Nombretabla='$CualTabla'";
		$ResultadoEstructura=$mysqli->query($SQL);
		while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {
		    if ($RegistroEstructura['Nombrecampo']==$RegT['Nombrecampo']) {
				if ($TituloNombre=="") {
					$TituloNombre=$RegistroEstructura['Titulocampo'];
				} else {
					$TituloNombre.=" / ".$RegistroEstructura['Titulocampo'];
				}
			}
		}		
	}
}
//

?>
<?php include("topadmin.inc.php"); ?>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td class="listado_titulogeneral" colspan="4">
	<?php
	echo utf8($tit_recuperar_eliminar)." :: ".$CualTabla;
	?>
	</td>
  </tr>
  <tr> 
   	<td width="5%" class="admin_titlista">
  	&nbsp;<?php echo utf8($tit_item) ?>
  	</td>
  	<td width="5%" class="admin_titlista">&nbsp;
   	</td>
   	<td width="55%" class="admin_titlista">
   	<?php echo utf8($TituloNombre) ?>
   	</td>
   	<td width="35%" class="admin_titlista">
   	<?php echo utf8($tit_acciones) ?>
  	</td>
  </tr>
  		  	  <?php		
			  $SQL="SELECT ID,Publico,$CamposBusqueda FROM $NombreTabla WHERE (Publico='2') ORDER BY ID ASC";
			  $ResultadoConsulta=$mysqli->query($SQL);
        	  $i=1;
        	  while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
          	     if (($i%2)==0) { $clase="admin_listaoscura"; } else { $clase="admin_listaclara"; }
				 $clase="listado_datos";
		  	  ?>
          	  <tr>
          	    <td align="right" class="<?php echo $clase ?>">
		  		<?php echo $Registro['ID'] ?>
		  		</td>
		  		<td align="center" class="<?php echo $clase ?>">
		  		<?php
				if ($Registro['Publico']==2) {
		    	?>
			  	·R·
				<?php
				}
				?>
		   		</td>
          		<td align="left" class="<?php echo $clase ?>">
			    <?php 
			    $jj=0;
			    while ($jj < $cantvec) {
		  		    $jj++;
			  	    $valor=$QueCampo[$jj];
				    if ($jj==1) {
					    echo $Registro[$valor];
				    } else {
			  		    echo " / ".$Registro[$valor];
				    }
			    }
			    ?>
		  		</td>
          		<td align="left" class="<?php echo $clase ?>">
		  		<?php
		  		$LinkEliminarDefinitivo="scriptElimDefinitivoRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&backto=".$AdondeVolver;
		  		$LinkRecuperar="scriptRecuperarRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&backto=".$AdondeVolver;
		  		?>
		  		<a href="<?php echo $LinkRecuperar ?>" class="admin_linkaccion"><?php echo utf8($lk_recuperar) ?></a>
		  		&nbsp;&nbsp;
		  		<a href="<?php echo $LinkEliminarDefinitivo ?>" class="admin_linkaccion"><?php echo utf8($lk_definitivo) ?></a>
		  		</td>
          	  </tr>
			  <?php
			  	  $i++;
          	  }
         	  ?>
</table>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>

	<form action="<?php echo $AdondeVolver ?>" name="formVolver" method="post">
	<td valign="top">
	<input type="submit" name="bt_volver" class="admin_botones" value="<< <?php echo utf8($bt_volver) ?>">
	</td>
	</form>
  
	<form enctype="multipart/form-data" method="post" action="EliminarRegistros.php?tabla=<?php echo $CualTabla ?>" name"formEliminar">
	<td height="16" align="right">
	<input name="tabla" type="hidden" value="<?php echo $CualTabla ?>">
	<input name="filtro" type="hidden" value="<?php echo $FiltroAplicado ?>">	
	<input name="titulo" type="hidden" value="<?php echo $TituloPagina ?>">
	<input name="front" type="hidden" value="<?php echo $TomoFront ?>">
    <input name="bt_eliminar" type="submit" class="admin_botones" value="<?php echo utf8($bt_eliminarxcriterio) ?> >>">
	</td>
	</form>
	<form action="scriptEliminarRegistros.php?tabla=<?php echo $CualTabla ?>&backto=<?php echo $AdondeVolver ?>" name="formEliminar" method="post">
	<td valign="top" align="right">
	<input type="submit" name="bt_todos" class="admin_botones" value="<?php echo utf8($bt_eliminartodo) ?> >>">
	</td>
	</form>
  </tr>
</table>
</body>
</html>
