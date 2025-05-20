<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");

$Tablas=$_GET['tablas'];
if ($Tablas!="") {
	$TablasOriginal=$Tablas;
	session_register('tablas_');
	$_SESSION['tablas_']=$Tablas;
}

if ($Tablas=="") {
	$Tablas=$_SESSION['tablas_'];
	$TablasOriginal=$Tablas;
}

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
$poscoma=strpos($Tablas,',');
$tablaUno=substr($Tablas,0,$poscoma);
$Tablas=substr($Tablas,$poscoma+1);
$poscoma=strpos($Tablas,',');
if ($poscoma > 0) {
	$tablaDos=substr($Tablas,0,$poscoma);
	$Tablas=substr($Tablas,$poscoma+1);
} else {
	$tablaDos=$Tablas;
	$Tablas="";
}
$poscoma=strpos($Tablas,',');
if ($poscoma > 0) {
	$tablaTres=substr($Tablas,0,$poscoma);
	$Tablas=substr($Tablas,$poscoma+1);
} else {
	$tablaTres=$Tablas;
	$Tablas="";
}
$poscoma=strpos($Tablas,',');
if ($poscoma > 0) {
	$tablaCuatro=substr($Tablas,0,$poscoma);
	$Tablas=substr($Tablas,$poscoma+1);
} else {
	$tablaCuatro=$Tablas;
	$Tablas="";
}
$tablaCinco=$Tablas;

//debbug :: echo "1.".$tablaUno." / 2.".$tablaDos." / 3.".$tablaTres." / 4.".$tablaCuatro."<br>";

if (($Prefijo=="") or ($tablaDos=="")) {
    header("Location: admin.php?mensaje=".utf8($error_accesoindebido).". ".utf8($tit_modulo).": listarCombo.");
    exit;
}

$TituloPagina=$_GET["titulo"];
if ($TituloPagina!="") {
	$valorsess=$tablaUno."_titulo_combo";
	if ($_SESSION[$valorsess]=="") session_register($valorsess);
	$_SESSION[$valorsess]=$TituloPagina;
}
if ($TituloPagina=="") {
	$valorsess=$tablaUno."_titulo_combo";
	$TituloPagina=$_SESSION[$valorsess];
}
$Mensaje=$_GET["mensaje"];
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
    <td class="listado_titulogeneral" colspan="4"> ::
	<?php
	if ($TItuloPagina!="") {
		echo $TituloPagina;
	} else {
		echo utf8($tit_modificareliminar)." ".$CualTabla."s";
	}
	?>
	</td>
  </tr>
  <tr>
  	<form enctype="multipart/form-data" method="post" action="AltaRegistro.php?tabla=<?php echo $tablaUno ?>&backto=listarCombo.php" name"formAgregar">
	<td class="admin_titlista" align="right" colspan="4">
	<input name="titulo" type="hidden" value="<?php echo $TituloPagina ?>">
	<input name="bt_agregar" type="submit" class="admin_botones" value="<?php echo $bt_agregar ?> <?php echo $tablaUno ?> >>">
	</td>
	</form>				
  </tr>
  <tr> 
	<td width="5%" class="admin_titlista">
	&nbsp;<?php echo utf8($tit_item) ?>
	</td>
	<td width="5%" class="admin_titlista">&nbsp;
	</td>
    <td width="52%" class="admin_titlista">
	<?php echo utf8($tit_nombre) ?>
	</td>
    <td width="38%" class="admin_titlista">
    <?php echo utf8($tit_acciones) ?>
	</td>
  </tr>
		<?php
		$tabla=$Prefijo.$tablaUno;
		$SQL="SELECT ID,Publico,Nombre FROM $tabla WHERE (Publico='0') OR (Publico='1') ORDER BY Nombre ASC";
		$ResultadoTablaUno=$mysqli->query($SQL);
		while ($RegTabUno=mysqli_fetch_array($ResultadoTablaUno)) {
			$clase="admin_nivel_1";
			$id=$RegTabUno['ID'];
			?>
		    <tr>
		      <td align="right" class="<?php echo $clase ?>">
			  <?php echo $id ?>
			  </td>
			  <td align="center" class="<?php echo $clase ?>">
			  <?php
			  if ($RegTabUno['Publico']==1) {
			  	  echo "&middot;P&middot;";
			  } else {
			  	  echo "&nbsp;";
			  } 
			  ?>		  
			  </td>
        	  <td align="left" class="<?php echo $clase ?>">
			  <?php echo stripslashes($RegTabUno['Nombre']) ?>
			  </td>
        	  <td align="left" class="<?php echo $clase ?>">
			  <?php
			  $LinkEliminar="scriptElimRegistro.php?tabla=".$tablaUno."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
			  $LinkModificar="ModRegistro.php?tabla=".$tablaUno."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
			  $LinkAgregar="AltaRegistro.php?tabla=".$tablaDos."&filtro=".$tablaUno."ID>".$id."&backto=listarCombo.php";
			  ?>
			  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo $lk_modificar ?></a>
			  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo $lk_eliminar ?></a>
			  <?php
			  if ($tablaDos!="") {
			  	  ?>
				  | <a href="<?php echo $LinkAgregar ?>" class="admin_linkaccion"><img src="img/icono_agregar.gif" border="0"><?php echo $tablaDos ?></a>
			  	  <?php
			  }
			  ?>
			  </td>
    	    </tr>
			<?php
			$tabla=$Prefijo.$tablaDos;
			$campofiltro=$tablaUno."ID";
			$SQL="SELECT ID,Publico,Nombre FROM $tabla WHERE ((Publico='0') OR (Publico='1')) AND ($campofiltro='$id') ORDER BY Nombre ASC";
			$ResultadoTablaDos=$mysqli->query($SQL);
	        while ($RegTabDos=mysqli_fetch_array($ResultadoTablaDos)) {
				$clase="admin_nivel_2";
				$id=$RegTabDos['ID'];
				?>
	    	    <tr>
        		  <td align="right" class="<?php echo $clase ?>">
				  <?php echo $id ?>
				  </td>
				  <td align="center" class="<?php echo $clase ?>">
				  <?php
				  if ($RegTabDos['Publico']==1) {
				  	  echo "&middot;P&middot;";
				  } else {
			  		  echo "&nbsp;";
				  } 
				  ?>		  
				  </td>
	        	  <td align="left" class="<?php echo $clase ?>">
				  <?php echo stripslashes($RegTabDos['Nombre']) ?>
				  </td>
    	    	  <td align="left" class="<?php echo $clase ?>">
				  <?php
				  $LinkEliminar="scriptElimRegistro.php?tabla=".$tablaDos."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
				  $LinkModificar="ModRegistro.php?tabla=".$tablaDos."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
				  $LinkAgregar="AltaRegistro.php?tabla=".$tablaTres."&filtro=".$tablaDos."ID>".$id."&backto=listarCombo.php";
				  ?>
				  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo $lk_modificar ?></a>
				  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo $lk_eliminar ?></a>
				  <?php
				  if ($tablaTres!="") {
				  	  ?>
					  | <a href="<?php echo $LinkAgregar ?>" class="admin_linkaccion"><img src="img/icono_agregar.gif" border="0"><?php echo $tablaTres ?></a>
			  		  <?php
				  }
				  ?>
				  </td>
    		    </tr>
				<?php
				if ($tablaTres!="") {
					$tabla=$Prefijo.$tablaTres;
					$campofiltro=$tablaDos."ID";
					$SQL="SELECT ID,Publico,Nombre FROM $tabla WHERE ((Publico='0') OR (Publico='1')) AND ($campofiltro='$id') ORDER BY Nombre ASC";
					$ResultadoTablaTres=$mysqli->query($SQL);
	    	    	while ($RegTabTres=mysqli_fetch_array($ResultadoTablaTres)) {
						$clase="admin_nivel_3";
						$id=$RegTabTres['ID'];
						?>
	    			    <tr>
        				  <td align="right" class="<?php echo $clase ?>">
						  <?php echo $id ?>
						  </td>
						  <td align="center" class="<?php echo $clase ?>">
						  <?php
						  if ($RegTabTres['Publico']==1) {
						  	  echo "&middot;P&middot;";
						  } else {
			  				  echo "&nbsp;";
						  } 
						  ?>		  
						  </td>
			        	  <td align="left" class="<?php echo $clase ?>">
						  <?php echo stripslashes($RegTabTres['Nombre']) ?>
						  </td>
    	    			  <td align="left" class="<?php echo $clase ?>">
						  <?php
						  $LinkEliminar="scriptElimRegistro.php?tabla=".$tablaTres."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
						  $LinkModificar="ModRegistro.php?tabla=".$tablaTres."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
						  $LinkAgregar="AltaRegistro.php?tabla=".$tablaCuatro."&filtro=".$tablaTres."ID>".$id."&backto=listarCombo.php";
						  ?>
						  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo $lk_modificar ?></a>
						  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo $lk_eliminar ?></a>
						  <?php
						  if ($tablaCuatro!="") {
						  	  ?>
							  | <a href="<?php echo $LinkAgregar ?>" class="admin_linkaccion"><img src="img/icono_agregar.gif" border="0"><?php echo $tablaCuatro ?></a>
					  		  <?php
						  }
						  ?>
						  </td>
	    		    	</tr>
						<?php
						if ($tablaCuatro!="") {
							$tabla=$Prefijo.$tablaCuatro;
							$campofiltro=$tablaTres."ID";
							$SQL="SELECT ID,Publico,Nombre FROM $tabla WHERE ((Publico='0') OR (Publico='1')) AND ($campofiltro='$id') ORDER BY Nombre ASC";
							$ResultadoTablaCuatro=$mysqli->query($SQL);
				    	    while ($RegTabCuatro=mysqli_fetch_array($ResultadoTablaCuatro)) {
								$clase="admin_nivel_4";
								$id=$RegTabCuatro['ID'];
								?>
	    					    <tr>
    	    					  <td align="right" class="<?php echo $clase ?>">
								  <?php echo $id ?>
								  </td>
								  <td align="center" class="<?php echo $clase ?>">
								  <?php
								  if ($RegTabCuatro['Publico']==1) {
								  	  echo "&middot;P&middot;";
								  } else {
			  						  echo "&nbsp;";
								  } 
								  ?>		  
								  </td>
			    		    	  <td align="left" class="<?php echo $clase ?>">
								  <?php echo stripslashes($RegTabCuatro['Nombre']) ?>
								  </td>
    			    			  <td align="left" class="<?php echo $clase ?>">
								  <?php
								  $LinkEliminar="scriptElimRegistro.php?tabla=".$tablaCuatro."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
								  $LinkModificar="ModRegistro.php?tabla=".$tablaCuatro."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
								  $LinkAgregar="AltaRegistro.php?tabla=".$tablaCinco."&filtro=".$tablaDos."ID>".$id."&backto=listarCombo.php";
								  ?>
								  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo $lk_modificar ?></a>
								  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo $lk_eliminar ?></a>
								  <?php
								  if ($tablaCinco!="") {
								  	  ?>
									  | <a href="<?php echo $LinkAgregar ?>" class="admin_linkaccion"><img src="img/icono_agregar.gif" border="0"><?php echo $tablaCinco ?></a>
							  		  <?php
								  }
								  ?>
								  </td>
	    			    		</tr>
								<?php
								if ($tablaCinco!="") {
									$tabla=$Prefijo.$tablaCinco;
									$campofiltro=$tablaCuatro."ID";
									$SQL="SELECT ID,Publico,Nombre FROM $tabla WHERE ((Publico='0') OR (Publico='1')) AND ($campofiltro='$id') ORDER BY Nombre ASC";
									$ResultadoTablaCinco=$mysqli->query($SQL);
						    	    while ($RegTabCinco=mysqli_fetch_array($ResultadoTablaCinco)) {
										$clase="admin_nivel_5";
										$id=$RegTabCinco['ID'];
										?>
	    							    <tr>
    	    							  <td align="right" class="<?php echo $clase ?>">
										  <?php echo $id ?>
										  </td>
										  <td align="center" class="<?php echo $clase ?>">
										  <?php
										  if ($RegTabCinco['Publico']==1) {
										  	  echo "&middot;P&middot;";
										  } else {
					  						  echo "&nbsp;";
										  } 
										  ?>		  
										  </td>
					    		    	  <td align="left" class="<?php echo $clase ?>">
										  <?php echo stripslashes($RegTabCinco['Nombre']) ?>
										  </td>
    					    			  <td align="left" class="<?php echo $clase ?>">
										  <?php
										  $LinkEliminar="scriptElimRegistro.php?tabla=".$tablaCinco."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
										  $LinkModificar="ModRegistro.php?tabla=".$tablaCinco."&id=".$id."&titulo=".$TituloPagina."&backto=listarCombo.php";
										  ?>
										  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo $lk_modificar ?></a>
										  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo $lk_eliminar ?></a>
										  </td>
	    					    		</tr>
										<?php
									}
								}
							}
						}
					}
				}
			}
   	    }
       	?>
</table>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
  	<form action="admin.php" name="formVolver" method="post"> 		  
	<td valign="top" align="left">
	<input type="submit" name="volver" class="admin_botones" value="<< <?php echo $bt_volver ?>">
	</td>
	</form>
  </tr>
</table>			
</body>
</html>
