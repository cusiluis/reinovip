<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("admin.traducciones.php");

$accion=$_GET['accion'];
$nombreusuario=$_SESSION['usuariolog'];

		if(isset($_GET["activar"]) && $_GET["activar"]==1)
		{
			$tablaE=$Prefijo."Escort";
			$id=$_GET["id"];
			$diasPub=$_GET["diasPub"];
			$enviar=$_GET["enviar"]; // Si es 1 solo se activa, Si es 2 se prepara para enviar al WAC
			$pack=$_GET["pack"];
			$fechaHoy=date("Y-m-d");
			$mysqli->query("UPDATE $tablaE SET Pack='$pack', Publico=1, fechaPublicacion='$fechaHoy', diasPublicacion='$diasPub', EnvioWac='$enviar', EstadoEnvioWac=0 WHERE ID='$id'");
			
			$mensaje="Se actualizado el estado del anuncio";
		}

// valido el usuario en la tabla de logueos
$tablaL=$Prefijo."logueo";
$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";
$ResultL=$mysqli->query($SQL);
$cantreg=mysqli_num_rows($ResultL);
$RegL=mysqli_fetch_array($ResultL);
$permisos=explode('|',$RegL['Permisos']);
if ($RegL['Permisos']=='-1') $all=1;

if ($cantreg < 1) {
	unset($_SESSION['usuariolog']);
	unset($_SESSION['clavelog']);
	unset($_SESSION['menu_']);
	if ($nombreusuario!="") $mensaje=$error_accesobackoffice;
	$accion="";	
}
//

if (($accion=="logout") and ($nombreusuario!="")) {
	unset($_SESSION['usuariolog']);
	unset($_SESSION['clavelog']);
	unset($_SESSION['menu_']);
	$mensaje=$ley_gracias." ".$nombreusuario.": ".$ley_cierresesion.".";
	$accion="";
}

$menuabierto=$_SESSION['menu_'];
$nombreusuario=$_SESSION['usuariolog'];

$usuario=$_POST['l_usuario'];
if ($usuario!="") {
	//tomo el usuario y contrasenia del archivo 'Bases'
	$tablaLog=$Prefijo."logueo";
	$SQL="SELECT * FROM $tablaLog WHERE Nombre='$usuario' ";
	$Result=$mysqli->query($SQL);
	$cantreg=mysqli_num_rows($Result);
	if ($cantreg > 0) {
		$RegB=mysqli_fetch_array($Result);
		if ($RegB['Permisos']=='-1') $all=1;
		$permisos=explode('|',$RegB['Permisos']);
		if ($RegB['Publico']!="1") {
			$mensaje=$error_usuarionohabilitado.".";
		} else {
			$clave=$_POST['l_contrasenia'];
			if ($RegB['Contrasenia']==$clave) {
				
				$nombreusuario=$RegB['Nombre'];			
				$_SESSION['usuariolog']=$nombreusuario;
			} else {
				$mensaje=$error_claveinvalida.".";
			}
		}
	} else {
		$mensaje=$error_usuarioinvalido.".";
	}
}

if (($accion=="datospersonales") and ($nombreusuario!="")) {
	$tablaLog=$Prefijo."logueo";
	$SQL="SELECT * FROM $tablaLog WHERE Nombre='$nombreusuario' ";
	$Result=$mysqli->query($SQL);
	$RegUsuario=mysqli_fetch_array($Result);
	if ($RegUsuario['Permisos']=='-1') $all=1;
	$permisos=explode('|',$RegUsuario['Permisos']);
	$mensaje=mysqli_error();
}
if (($FTPhost=="") or ($FTPuser=="") or ($FTPpass=="")) {
	echo "No esta definido los datos de ftp.<br>";
	exit;
}
?>
<script type="text/javascript">
	function activar(enviar,id)
	{
		var pack=document.getElementById("pack_"+id).options[document.getElementById("pack_"+id).selectedIndex].value;
		var diasPub=document.getElementById("diasPub_"+id).value;
		if(diasPub==0 || diasPub=="" || pack==0)
		{
			alert("Para activar el anuncio debe registrar los dias de publicación");
		}
		else
		{
			window.location.href="admin.php?tabla=Escort&activar=1&id="+id+"&diasPub="+diasPub+"&enviar="+enviar+"&pack="+pack;
		}
    }  
</script>
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
<script language="JavaScript">
function doSubmit (Form,Action) {
   Form.action=Action;	
   Form.submit();
}

function validar_login() {
	if (document.formlogin.l_usuario.value=="") {
		alert("<?php echo utf8($error_nombrevacio) ?>");
		document.formlogin.l_usuario.focus();
		return false;
	}
	if (document.formlogin.l_contrasenia.value=="") {
		alert("<?php echo utf8($error_clavevacio) ?>");
		document.formlogin.l_contrasenia.focus();
		return false;
	}
	document.formlogin.submit();
}

function validar_datospersonales() {
	if (document.formDatosPersonales.dp_nombre.value=="") {
		alert("<?php echo utf8($error_nombrevacio) ?>");
		document.formDatosPersonales.dp_nombre.focus();
		return false;
	}
	if (document.formDatosPersonales.dp_clave.value=="") {
		alert("<?php echo utf8($error_clavevacio) ?>");
		document.formDatosPersonales.dp_clave.focus();
		return false;
	}
	document.formDatosPersonales.submit();
}
</script>
</head>

<body>
<?php
$tablaE=$Prefijo."Escort";
$selCaducos=$mysqli->query("SELECT * FROM $tablaE WHERE DATE_ADD(fechaPublicacion, INTERVAL diasPublicacion DAY) < DATE(NOW()) AND Publico='1' ");
$cantDesactivados=mysqli_num_rows($selCaducos);
$mysqli->query("UPDATE $tablaE SET Publico='0' WHERE DATE_ADD(fechaPublicacion, INTERVAL diasPublicacion DAY) < DATE(NOW()) AND Publico='1' ") or die(mysql_error());
$mensajeDesactivado="Se han desactivado ".$cantDesactivados." anuncios caducos.";
?>
<?php include("topadmin.inc.php");?>    
<?php
if ($nombreusuario=="") { 
	//no esta logueado todavia
	//debbug ::	echo $TablaMenu;
	?>
	<table class="tabla_ventana" cellpadding="0" cellspacing="0">
	  <tr>
	    <td>
		  <table border="0" cellpadding="3" cellspacing="0">
		    <tr>
			  <td colspan="2" class="listado_titulogeneral"><?php echo utf8($tit_login) ?></td>
			</tr>
    	    <form action="admin.php" onSubmit="validar_login(); return false;" enctype="multipart/form-data" method="post" name="formlogin">
			<tr> 
			  <td width="30%" class="celdatitulo"><?php echo utf8($campo_usuario) ?>:&nbsp;</td>
			  <td width="70%" class="celdainput">
		  	  <input name="l_usuario" type="text" class="admin_campo" size="50" maxlength="50" value="<?php echo $_GET['usuario'] ?>"></td>
			</tr>
			<tr> 
    	      <td class="celdatitulo"><?php echo utf8($campo_clave) ?>:&nbsp;</td>
	    	  <td class="celdainput">
		   	  <input name="l_contrasenia" type="password" class="admin_campo" size="20" maxlength="20" value="<?php echo $_GET['usuario'] ?>"></td>
		    </tr>
       	    <tr>
			  <td colspan="2" class="celdabotones">
			    <table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <tr>
	            	<td width="50%"><input class="admin_botones" type="button" onClick="javascript:doSubmit(formlogin,'../')" name="bt_salir" value="<< <?php echo $bt_cancelar ?>"></td>
          			<td width="50%" align="right"><input class="admin_botones" type="submit" name="bt_login" value="<?php echo $bt_login ?> >>"></td>
				  </tr>
				</table>
			  </td>
        	</tr>			  
		   </form>
      	  </table>
		</td>
	  </tr>
	</table>
<?php
} else {
echo '<div style="font-family: Tahoma;
font-size: 11px;
color: #000000;
text-decoration: none;
font-weight: bold;
text-transform: uppercase;
padding-left: 20px;
height: 17px;
background-color: #C2DC0B;">'.$mensajeDesactivado.'</div>';
	//debbug ::	echo $TablaMenu;
	if ($accion=="datospersonales") {
		?>
		<table class="tabla_ventana" cellpadding="0" cellspacing="0">
		  <tr>
	    	<td>
			  <table border="0" cellpadding="3" cellspacing="0">
			    <tr>
				  <td colspan="2" class="listado_titulogeneral"><?php echo utf8($tit_datospersonales) ?></td>
				</tr>
				<form enctype="multipart/form-data"
		    		action="scriptModDatosPersonales.php?id=<?php echo $RegUsuario['ID'] ?>" 
					onSubmit="validar_datospersonales();return false;"
					method="post" 
					name="formDatosPersonales">
			    <tr> 
			      <td width="30%" class="celdatitulo">
				  <?php echo utf8($campo_usuario) ?>:&nbsp;</td>
		    	  <td width="70%" class="celdainput">
		    	  <input name="dp_nombre" type="text" class="admin_campo" value="<?php echo $RegUsuario['Nombre'] ?>" size="40" maxlength="40">
				  &nbsp;<span class="admin_obligatorio">(*)</span></td>
		  		</tr>
		  		<tr> 
		  		  <td class="celdatitulo"><?php echo utf8($campo_clave) ?>:&nbsp;</td>
		  		  <td class="celdainput">
		    	  <input name="dp_clave" type="text" class="admin_campo" value="<?php echo $RegUsuario['Contrasenia'] ?>" size="20" maxlength="20">
				  &nbsp;<span class="admin_obligatorio">(*)</span></td>
		  		</tr>
		  		<tr> 
		  		  <td width="30%" class="celdatitulo"><?php echo utf8($campo_nivel) ?>:&nbsp;</td>
		  		  <td width="70%" class="celdainput">
	  	  		  <input name="l_nivel" type="text" class="admin_campo" size="5" maxlength="5" value="<?php echo $RegUsuario['Nivel'] ?>" disabled>	        </td>
		  		</tr>
        	    <tr>
				  <td class="celdabotones" colspan="2">
				    <table width="100%" border="0" cellpadding="0" cellspacing="0">
					  <tr>
	                    <td width="50%"><input class="admin_botones" type="button" onClick="javascript:history.back()" name="bt_volver" value="<< <?php echo $bt_cancelar ?>"></td>
            	  		<td width="50%" align="right"><input class="admin_botones" type="submit" name="bt_modificar" value="<?php echo $bt_modificar ?> >>"></td>
					  </tr>
					</table>
				  </td>
        	    </tr>			
				</form>  
      		  </table>
			</td>
		  </tr>
        </table>
		<?php
	} else {
		?>
		<!-- Menu a N columnas -->
        <table border="0" cellpadding="0" cellspacing="0">
	      <tr>
			<?php
			$columna=1;
			while ($columna < 5) {
				?>	  
		        <td width="320" valign="top">
				  <table width="100%" border="0" bordercolor="#F2F2F2" cellpadding="0" cellspacing="0">
					<?php
					$SubMenuActivo=$_GET["submenu"];
					if ($SubMenuActivo=="") {
						$SubMenuActivo=$menuabierto;
					} else {
						if ($SubMenuActivo=="0") {
							session_unregister('menu_');
						} else {
							session_register('menu_');
							$_SESSION['menu_']=$SubMenuActivo;
						}
					}
					$tablaM=$Prefijo."menu";
					$SQL="SELECT * FROM $tablaM WHERE (MenuIDPadre=0) AND (Columna=$columna) ORDER BY Nrodeorden ASC";
					$ResultadoConsulta=$mysqli->query($SQL);
					while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
					    $TituloMenu=$Registro['Titulomenu'];
						$LeyendaMenu=$Registro['Leyenda'];
						$MenuID=$Registro['MenuID'];
						$TieneSubMenu=$Registro['Tienesubmenu'];
						if ($TieneSubMenu==1) {
						     if ($MenuID==$SubMenuActivo) {
							     $CualImagen="img/abierto.gif";
								 $CualImagenRol="img/abierto_rol.gif";
								 $PlantillaPhp="admin.php?submenu=0"; //cerrar
							 } else {
						         $CualImagen="img/cerrado.gif";
								 $CualImagenRol="img/cerrado_rol.gif";
							     $PlantillaPhp="admin.php?submenu=".$MenuID; //abrir
							 }
					    } else {
						     $CualImagen="img/bullet.gif"; 
							 $CualImagenRol="img/bullet_rol.gif";
							 $PlantillaPhp=$Registro['Plantillaphp']; //opcion
						}
						?>
						<tr>  
						  <td width="100%">
						  <?php
					$igual=0;
					for ($i=0;$i<=sizeof($permisos);$i++) {
						if ($permisos[$i]==$MenuID) $igual=1;
					}
					if ($all==1) $igual==1;
					if ($igual==1) {
						  if ($PlantillaPhp=="") {
						  	  if ($TituloMenu=="-") {
							  ?>
							  <table width="100%" align="center" border="1" bordercolor="#F2F2F2" cellpadding="0" cellspacing="0">
	    						<tr>
								  <td height="2" width="100%" align="center" class="celdasubtitulomenu"><img src="img/transparente.gif" height="2" width="2"></td>
								</tr>
							  </table>	  
							  <?php
							} else {
								?>
								<table width="100%" align="center" border="1" bordercolor="#F2F2F2" cellpadding="3" cellspacing="0">
								<tr>
									<td height="17" width="100%" align="center" valign="middle" class="celdasubtitulomenu"><?php echo utf8($TituloMenu) ?></td>
									</tr>
								</table>	  
								<?php
							}
						} else {
							?>
							<table width="100%" align="center" border="1" bordercolor="#F2F2F2" cellpadding="3" cellspacing="0">
							<tr>
								<td height="17" width="30" align="center" valign="middle" class="celdabullet">
								<div align="center"><a href="<?php echo $PlantillaPhp ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Im<?php echo $MenuID ?>','','<?php echo $CualImagenRol ?>',1)"><img src="<?php echo $CualImagen ?>" name="Im<?php echo $MenuID ?>" border="0"></a></div></td>
								<td width="290" class="celdamenu">
								<a href="<?php echo $PlantillaPhp ?>" class="menulink"><?php echo utf8($TituloMenu) ?></a>
								<?php 
								if ($LeyendaMenu!="") {
									echo "<br>";		
									echo utf8($LeyendaMenu);
								}
								?>
								</td>
								</tr>
							</table>
							<?php
						}
					}
					  ?>	
					  </td>
				    </tr>
				  <?php 
				  if ($MenuID==$SubMenuActivo) {
				  	  $tablaM=$Prefijo."menu";
					  $SQL="SELECT * FROM $tablaM WHERE MenuIDPadre='$SubMenuActivo' ORDER BY Nrodeorden ASC";
				  	  $ResultadoConsultaSubmenu=$mysqli->query($SQL);
				  	  while ($RegistroSubMenu=mysqli_fetch_array($ResultadoConsultaSubmenu)) {
					 	  $PlantillaPhp=$RegistroSubMenu['Plantillaphp'];
					 	  $TituloMenu=$RegistroSubMenu['Titulomenu'];
					 	  $LeyendaMenu=$RegistroSubMenu['Leyenda'];
						  $MenuID=$RegistroSubMenu['MenuID'];
						  $CualImagen="img/bullet.gif";
						  $CualImagenRol="img/bullet_rol.gif";
						  ?>	
						  <tr>	  
						    <td height="17" width="100%">
						    <?php
							if ($PlantillaPhp=="")  {
								?>
								<table width="100%" align="center" border="1" bordercolor="#F2F2F2" cellpadding="3" cellspacing="0">
								  <tr>
									<td height="17" width="100%" align="center" valign="middle" class="celdasubtitulomenu">
								    <?php echo utf8($TituloMenu) ?>
									</td>
								  </tr>
								</table>	  
								<?php
							} else {
								?>
							    <table width="100%" align="center"  border="1" bordercolor="#F2F2F2" cellpadding="3" cellspacing="1">
								  <tr>
							        <td height="17" width="50" align="center" valign="middle" class="celdabullet">
								  		<div align="center">
								  			<a href="<?php echo $PlantillaPhp ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Im<?php echo $MenuID ?>','','<?php echo $CualImagenRol ?>',1)">
								  				<img src="<?php echo $CualImagen ?>" name="Im<?php echo $MenuID ?>" border="0">
								  			</a>
								  		</div>
								  	</td>
						  		  	<td height="17" width="270" class="celdasubmenu">
								  	<a href="<?php echo $PlantillaPhp ?>" class="menulink"><?php echo utf8($TituloMenu) ?></a>
								  	<?php
								  	if ($LeyendaMenu!="") {
										echo "<br>";
										echo utf8($LeyendaMenu);
								  	}
								  	?>
									</td>
								  </tr>
							    </table>	  
								<?php
							}
							?>
							</td>
					      </tr>
						  <?php
				      } // del while sub-menu
				  } // del if ($MenuID==$SubMenuActivo)
			  } //del while $Registro
			  ?>  
		    </table>		  
		  </td>
		  <?php
		  $columna++;
		} //del while $columna
		?>	
	  </tr>
	</table>
<table border="0" cellpadding="3" cellspacing="0" width="100%">
  <tr>
    <td class="listado_titulogeneral" colspan="7"> ::
	Anuncios pendientes de aprobaci&oacute;n
	</td>
  </tr>
  <tr>
  	<td width="5%" class="admin_titlista">Usuario</td>
    <td width="5%" class="admin_titlista">&nbsp;<?php echo utf8($tit_item) ?></td>
    <td width="11%" class="admin_titlista">Nombre</td>
    <td width="8%" class="admin_titlista">Tel&eacute;fono</td>
    <td width="8%" class="admin_titlista">Provincia</td>
    <td width="8%" class="admin_titlista">Ciudad</td>
    <td width="25%" class="admin_titlista">Especificaciones</td>
    <td width="40%" class="admin_titlista">Acciones</td>
  </tr>

  <?php
  $tablaEscort=$Prefijo."Escort";
  $tablaProvincia=$Prefijo."Provincia";
  $tablaCiudad=$Prefijo."Ciudad";
  $usuario=$Prefijo."escort_usuarios";

  $sql1= "SELECT * from $usuario";
  $result=$mysqli->query($sql1) or die (mysql_error());

  while($data=mysqli_fetch_array($result)) {

  	$usuario_id= $data['id'];
  	$SQL="SELECT e.ID, e.Nombre,e.Email,e.Telefono,e.Edad,p.Nombre as PROV_NOMBRE,c.Nombre as CIU_NOMBRE, e.Especificaciones FROM $tablaEscort e LEFT JOIN $tablaProvincia p ON e.ProvinciaID=p.ID LEFT JOIN $tablaCiudad c ON e.CiudadID=c.ID WHERE e.Publico='3' and e.usuario_id = $usuario_id ORDER BY e.ID DESC ";

	// fin debugging */
	$ResultadoConsulta=$mysqli->query($SQL) or die (mysql_error());

	$i=0;
	while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
	$clase="listado_datos";
	$fondoicono="blanco";
	?>
    <tr>
      <td align="right" class="<?php echo $clase ?>">
      	<?php echo $data['email'];?>
      </td>
      <td align="right" class="<?php echo $clase ?>">
	  <?php echo $Registro['ID'] ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['Nombre']
	  ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['Telefono']
	  ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['PROV_NOMBRE']
	  ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['CIU_NOMBRE']
	  ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['Especificaciones']
	  ?>
	  </td>
	  <td align="left" class="<?php echo $clase ?>">
	  <?php
	  $CualTabla="Escort";
	  $LinkEliminar="scriptElimRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&filtro=".$FiltroAplicado."&front=".$TomoFront;
	  $LinkModificar="ModRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&filtro=".$FiltroAplicado."&front=".$TomoFront;
	  ?>
	  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo utf8($lk_modificar) ?></a>
	  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo utf8($lk_eliminar) ?></a>
	  <!-- Aca van las Acciones Adicionales -->
	  <?php  
	  	if ($Registro['Publico']!=1) {
			$diasPasadosPublicacion=diferenciaFechas($Registro["fechaPublicacion"], date("Y-m-d"));
			$Valor=$Registro['diasPublicacion']-$diasPasadosPublicacion;
			  	if($Valor<0)
			  		$Valor=0;
					
		  $tablaT=$Prefijo."tipo_contratacion";
		  $sqlPack=$mysqli->query("select * from $tablaT ");
		  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          | <input type="text" size="5" id="diasPub_<?php echo $Registro['ID'];?>" value="<?php echo $Valor;?>">&nbsp;D&iacute;as pub.
		  | <a href="javascript:activar('0','<?php echo $Registro['ID']; ?>')" class="admin_linkaccion">Activar</a>
		  | <a href="javascript:activar('1','<?php echo $Registro['ID']; ?>')" class="admin_linkaccion">Activar y enviar WAC</a>
          <table  style="font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;font-size: 11px; "><tr><td>
 			<select id="pack_<?php echo $Registro['ID'];?>" name="pack_<?php echo $Registro['ID'];?>">
          		<option value="0"> - Pack - </option>
                <?php 
					while($arryPack=mysqli_fetch_array($sqlPack)){
						echo '<option value="'.$arryPack["ID"].'">'.$arryPack["Nombre"].'</option>';
					}
				?>
            </select>
          </td></tr></table>
		  <?php } 
	  ?>
	  </td>
    </tr>
	<?php
}
} 
?>
   

</table>
<br><br>
<table border="0" cellpadding="3" cellspacing="0" width="100%">
  <tr>
    <td class="listado_titulogeneral" colspan="11"> <font style="color:#FF0000"> ::
	Anuncios proximos a caducar</font>
	</td>
  </tr>
  <tr>
  	<?php 
	$fechaHoy=date("Y-m-d");
	$fechaHoy;
	$fechaAyer=date("Y-m-d", strtotime("$fechaHoy -1 day"));
	$fechaAntesAyer=date("Y-m-d", strtotime("$fechaHoy -2 day"));
	?>
    <td width="5%" class="admin_titlista">&nbsp;<?php echo utf8($tit_item) ?></td>
    <td width="11%" class="admin_titlista">Nombre</td>
    <td width="8%" class="admin_titlista">Tel&eacute;fono</td>
    <td width="8%" class="admin_titlista">Provincia</td>
    <td width="8%" class="admin_titlista">Ciudad</td>
    <td width="10%" class="admin_titlista">Fecha de publicaci&oacute;n</td>
    <td width="3%" class="admin_titlista">D&iacute;as</td>
    <td width="10%" class="admin_titlista">Fecha fin Publicaci&oacute;n</td>
    <td width="5%" class="admin_titlista">D&iacute;as restantes</td>
    <td width="40%" class="admin_titlista">Acciones</td>
  </tr>
  
  
  
  <?php
  /*
  DATE_ADD(e.fechaPublicacion, INTERVAL diasPublicacion DAY)=$fechaHoy OR 
DATE_ADD(e.fechaPublicacion, INTERVAL diasPublicacion DAY)=$fechaAyer OR 
DATE_ADD(e.fechaPublicacion, INTERVAL diasPublicacion DAY)=$fechaAntesAyer 
  */
  $tablaEscort=$Prefijo."Escort";
  $tablaProvincia=$Prefijo."Provincia";
  $tablaCiudad=$Prefijo."Ciudad";
$SQL="SELECT e.fechaPublicacion, e.diasPublicacion, DATE_ADD(e.fechaPublicacion, INTERVAL e.diasPublicacion DAY) as fechaFinPub, e.ID, e.Nombre,e.Email,e.Telefono,e.Edad,p.Nombre as PROV_NOMBRE,c.Nombre as CIU_NOMBRE, e.Especificaciones FROM $tablaEscort e LEFT JOIN $tablaProvincia p ON e.ProvinciaID=p.ID LEFT JOIN $tablaCiudad c ON e.CiudadID=c.ID WHERE (DATE_ADD(e.fechaPublicacion, INTERVAL diasPublicacion DAY)='$fechaHoy' OR 
DATE_ADD(e.fechaPublicacion, INTERVAL diasPublicacion DAY)='$fechaAyer' OR 
DATE_ADD(e.fechaPublicacion, INTERVAL diasPublicacion DAY)='$fechaAntesAyer') AND e.Publico=1
ORDER BY e.ID DESC ";

// fin debugging */
$ResultadoConsulta=$mysqli->query($SQL) or die (mysql_error());
$i=0;
while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
	$clase="listado_datos";
	$fondoicono="blanco";
	?>
    <tr>
      <td align="right" class="<?php echo $clase ?>">
	  <?php echo $Registro['ID'] ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['Nombre']
	  ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['Telefono']
	  ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['PROV_NOMBRE']
	  ?>
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  echo $Registro['CIU_NOMBRE']
	  ?>
	  </td>
      <td align="right" class="<?php echo $clase ?>">
	  <?php echo formatoFecha($Registro['fechaPublicacion']) ?>
	  </td>
      <td align="right" class="<?php echo $clase ?>">
	  <?php echo $Registro['diasPublicacion'] ?>
	  </td>
      <td align="right" class="<?php echo $clase ?>">
	  <?php echo formatoFecha($Registro['fechaFinPub']) ?>
	  </td>
      <td align="right" class="<?php echo $clase ?>">
	  <?php 
	  	$diasRestantes=diferenciaFechas($Registro['fechaFinPub'],date("Y-m-d"));
	  	if($diasRestantes == 0)
		{
			echo "HOY";
		}
		else
		{	echo $diasRestantes;}
	  
	  ?>
	  </td>
	  <td align="left" class="<?php echo $clase ?>">
	  <?php
	  $CualTabla="Escort";
	  $LinkEliminar="scriptElimRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&filtro=".$FiltroAplicado."&front=".$TomoFront;
	  $LinkModificar="ModRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&filtro=".$FiltroAplicado."&front=".$TomoFront;
	  ?>
	  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo utf8($lk_modificar) ?></a>
	  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo utf8($lk_eliminar) ?></a>
	  </td>
    </tr>
	<?php
}
?>
</table>
<br><br>
	<?php
	} //del else ($accion==datospersonales)
} //del if ($logueado)
?>    

</body>
</html>
<?php 
function diferenciaFechas($date1, $date2) { 
	if($date1!="0000-00-00" && $date2!="0000-00-00")
	{
		$current = $date1; 
		$datetime2 = date_create($date2); 
		$count = 0; 
		while(date_create($current) < $datetime2){ 
			$current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 
			$count++; 
   		} 
		return $count; 
	}
	return 0;
} 

function formatoFecha($fecha)
{
	$frmFecha=explode("-",$fecha);
	return $frmFecha[2]."-".$frmFecha[1]."-".$frmFecha[0];
}
?>