<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");

$CualTabla=$_GET["tabla"];

$nombreusuario=$_SESSION['usuariolog'];
// valido el usuario en la tabla de logueos
$tablaL=$Prefijo."logueo";
$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";
$ResultL=mysql_query($SQL);
$cantreg=mysql_num_rows($ResultL);
if ($cantreg < 1) $nombreusuario="";
//
if (($nombreusuario=="") and ($CualTabla!="DeBBuG")) {
	header("Location: admin.php?mensaje=".$error_accesoindebido.".");
	exit;
}

$NombreTabla=$Prefijo.$CualTabla;
if ((!$CualTabla) or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": listarTabla.");
    exit;
}
$FiltroAplicado=$_GET["filtro"];
$TituloPagina=$_GET["titulo"];
if ($TituloPagina!="") {
	$valorsess=$CualTabla."_titulo";
	if ($_SESSION[$valorsess]=="") session_register($valorsess);
	$_SESSION[$valorsess]=$TituloPagina;
}
if ($TituloPagina=="") {
	$valorsess=$CualTabla."_titulo";
	$TituloPagina=$_SESSION[$valorsess];
}
$TomoFront=$_GET["front"];
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
//pongo $TituloNombre / $CamposBusqueda / vector $QueCampo / $cantvec
$CamposBusqueda="Nombre";
$cantvec=1;
$QueCampo[1]="Nombre";
$tablaE=$Prefijo."estructura";
$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla'";
$ResultadoEstructura=mysql_query($SQL);
while ($RegistroEstructura=mysql_fetch_array($ResultadoEstructura)) {
    if ($RegistroEstructura['Nombrecampo']=="Nombre") $TituloNombre=$RegistroEstructura['Titulocampo'];
}
$tablaT=$Prefijo."titulos";
$SQL="SELECT * FROM $tablaT WHERE Nombretabla='$CualTabla' ORDER BY Nrodeorden,TituloID ASC ";
if ($ResultT=mysql_query($SQL)) {
	$kk=0;
	while ($RegT=mysql_fetch_array($ResultT)) {
		$kk++;
		$cantvec=$kk;
		$QueCampo[$kk]=$RegT['Nombrecampo'];
		$Icono[$kk]=$RegT['Muestroicono'];
		$SqlTabla[$kk]=$RegT['Sqltabla'];
		if ($kk==1) {
			$CamposBusqueda=$RegT['Nombrecampo'];
			$TituloNombre="";
		} else {
			$CamposBusqueda.=",".$RegT['Nombrecampo'];
		}
		$tablaE=$Prefijo."estructura";
		$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla'";
		$ResultadoEstructura=mysql_query($SQL);
		while ($RegistroEstructura=mysql_fetch_array($ResultadoEstructura)) {
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

$MensajeFiltro="";
$findQuery="";
$fid=$_POST["fid"];  // del form de buscar por nº de item, campo "ID"
$fidhasta=$_POST["fidhasta"];
if ($fid) {
	if ($fidhasta) {
		$findQuery=" AND $NombreTabla.ID>=$fid AND $NombreTabla.ID<=$fidhasta ";
		$MensajeFiltro = $MensajeFiltro." ID de ".$fid." a ".$fidhasta."</b>. ";
	} else {
		$findQuery=" AND $NombreTabla.ID=$fid ";
		$MensajeFiltro = $MensajeFiltro."ID = ".$fid."</b>. ";
	}
}
$fnombre=$_POST["fnombre"]; // del form de buscar por campo "Nombre"
if ($fnombre) {
	$MensajeFiltro .= " / ".utf8($ley_contenido).": <b>".$fnombre."</b>.";
}

$filtroCiudad="";
$campoFilCiu="";
$swCiud=0;

	if(isset($_POST["fciudad"]))
	{
		if(($fprovincia!=0) || ($fciudad!=0))
		{
		$verCiuProv=explode("-",$_POST["fciudad"]);
		$fprovincia=$verCiuProv[0];
		$fciudad=$verCiuProv[1];
		if ($fciudad==0) {
			$idSelProv=$fprovincia;
			$MensajeFiltro = $MensajeFiltro." / Provincia : <b>".$fprovincia."</b>.";
			$joinCiuProv = " JOIN reino01_escort_provincia ep ON $NombreTabla.ID = ep.IDEscort";
			$whereCiuProv = " AND ep.IDProvincia=".$fprovincia;
		}
		else
		{
			$swCiud=1;
			$idSelProv=$fciudad;
			$MensajeFiltro = $MensajeFiltro." / Ciudad : <b>".$fciudad."</b>.";
			$joinCiuProv = " JOIN reino01_escort_ciudad ec ON $NombreTabla.ID = ec.IDEscort";
			$whereCiuProv = " AND ec.IDCiudad=".$fciudad;
		}
		}
	}

if ($CualTabla=="DeBBuG") {
	$tablaL=$Prefijo."logueo";
	$SQL="SELECT * FROM $tablaL ";
	$ResultL=mysql_query($SQL);
	while ($RegL=mysql_fetch_array($ResultL)) {
		echo $RegL['ID'].") ".$RegL['Nombre']."/".$RegL['Contrasenia']."<br>";
	}
	echo "host: ".$HostPrincipal."<br>";
	echo "user: ".$UsuarioPrincipal."<br>";
	echo "pass: ".$ClavePrincipal."<br>";
	echo "base: ".$BasePrincipal."<br>";
	echo "error conexion: ".$MensajeConexion."<br>";
	echo "host ftp: ".$FTPhost."<br>";
	echo "publica: ".$FTPpublica."<br>";
	echo "relativa: ".$FTPrelativa."<br>";
	echo "user: ".$FTPuser."<br>";
	echo "pass: ".$FTPpass."<br>";
	echo "prefijo: ".$Prefijo."<br>";
	echo "sitio: ".$NombreSitio."<br>";
	echo "titulo: ".$TituloSitio."<br>";
	echo "mail: ".$EmailSitio."<br>";
	echo "ventas1: ".$EmailVentas_1."<br>";
	echo "ventas2: ".$EmailVentas_2."<br>";
	echo "desde: ".$EmailDesde."<br>";
	echo "nombre desde: ".$EmailDesdeNombre."<br>";
	echo "mail testeo: ".$EmailTesteo."<br>";
	echo "webmaster: ".$EmailWebmaster."<br>";
	echo "<br>";
	exit;
}
?>
<?php 
if ($MensajeFiltro!="") {
	if ($mensaje=="") $mensaje=$_GET['mensaje'];
	$mensaje=utf8($ley_filtroaplicado)." / ".$MensajeFiltro."<br>".$mensaje;
}
include("topadmin.inc.php"); 
?>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td class="listado_titulogeneral" colspan="3"> ::
	<?php
	if ($TituloPagina!="") {
		echo utf8($TituloPagina);
	} else {
		echo utf8($tit_modificareliminar)." ".$CualTabla."s";
	}
	?>
	</td>
	<?php
	$volver=$_GET['backto'];
	if ($volver=="") {
		?>
  		<form enctype="multipart/form-data" method="post" action="AltaRegistro.php?tabla=<?php echo $CualTabla ?>" name"formAgregar">
		<?php
	} else {
		?>
  		<form enctype="multipart/form-data" method="post" action="AltaRegistro.php?tabla=<?php echo $CualTabla ?>&backto=<?php echo $volver ?>" name"formAgregar">
		<?php
	}
	?>
	<td class="listado_titulogeneral" align="right">
	<input name="tabla" type="hidden" value="<?php echo $CualTabla ?>">
	<input name="filtro" type="hidden" value="<?php echo $FiltroAplicado ?>">	
	<input name="front" type="hidden" value="<?php echo $TomoFront ?>">
	<input name="bt_agregar" type="submit" class="admin_botones" value="<?php echo $bt_agregar ?> >>">
	</td>
	</form>
  </tr>
  <tr>
    <td colspan="4" id="barra_de_filtros" style="padding:0px;">
<!-- buscador -->
<form name="formBuscarPorID" method="post" action="listarTabla.php?tabla=<?php echo $CualTabla ?>&filtro=<?php echo $FiltroAplicado ?>&titulo=<?php echo $TituloPagina ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="borde_tabla_buscador">
  <tr>
    <td valign="bottom" class="admin_fondotitulo">
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="86"><span class="admin_txt"><?php echo utf8($tit_itemdesde); ?>:</span></td>
          <td width="154"><span class="admin_txt"><?php echo utf8($tit_itemhasta); ?>:</span></td>
          <td width="397"><span class="admin_txt"><?php echo utf8($tit_buscar)." ".utf8($TituloNombre) ?>: </span></td>
          <td width="111"><span class="admin_txt"><?php echo utf8($tit_regxpag) ?>:</span></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td valign="top" class="admin_fondocampo">
	  <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="86"><input name="fid" type="text" class="admin_campo" size="10" value="<?php echo $fid; ?>"></td>
          <td width="154"> <input name="fidhasta" type="text" class="admin_campo" size="10" value="<?php echo $fidhasta; ?>"> 
          <input name="submitnombre2" type="submit" class="admin_botones" value=">>"> 
          </td>
<!--		  </form>
		  <form name="formBuscarPorNombre" method="post" action="listarTabla.php?tabla=<?php echo $CualTabla ?>&filtro=<?php echo $FiltroAplicado ?>&titulo=<?php echo $TituloPagina ?>">
-->          <td width="397">
          <?php 
		  if($CualTabla=="Escort")
		  {
		  $campoFilCiu=", Telefono";
		  $sqlProvA="SELECT * FROM reino01_Provincia WHERE Publico=1 ORDER BY Nombre";
		  ?>
          <input name="fnombre" type="text" class="admin_campo" size="20" value="<?php echo $fnombre; ?>">
          <select name="fciudad">
          	<option value="0-0"> - Seleccione ciudad - </option>
            <?php 
				$resultProv=mysql_query($sqlProvA) or die (mysql_error());
				while($arryProv=mysql_fetch_array($resultProv))
				{
				$provIdAprov=$arryProv['ID'];
				echo "<option value='".$arryProv['ID']."-0' ".($swCiud==0 && $fprovincia==$arryProv['ID'] ? ' selected="selected"' : '')." >".$arryProv['Nombre']."</option>";
					$SQLCiu="SELECT * FROM reino01_Ciudad WHERE ProvinciaID='$provIdAprov' AND Publico=1 ORDER BY Nombre";
					$resultCiud=mysql_query($SQLCiu) or die (mysql_error());
					while($arryCiudad=mysql_fetch_array($resultCiud))
					{
					echo "<option value='".$arryProv['ID']."-".$arryCiudad['ID']."' ".($swCiud==1 && $fciudad==$arryCiudad['ID'] ? ' selected="selected"' : '').">--".$arryCiudad['Nombre']."</option>";
					}
				}
			?>
          </select>
          <?php }
		  else
		  {
		  ?>
          <input name="fnombre" type="text" class="admin_campo" size="60">
          <?php 
		  }
		  ?>
          
          <input type="image" src="img/bt_buscar.jpg" name="bt_buscar" width="21" height="19" border="0" align="absmiddle" id="bt_buscar" onMouseOver="MM_swapImage('bt_buscar','','img/bt_buscar_rol.jpg',1)" onMouseOut="MM_swapImgRestore()"> 
          </td>
		  <!--</form>
		  <form name="formCantReg" action="listarTabla.php?tabla=<?php echo $CualTabla ?>&filtro=<?php echo $FiltroAplicado ?>&titulo=<?php echo $TituloPagina ?>&front=<?php echo $TomoFront ?>" method="post">
-->          <td width="111"><input name="cantregxpag" type="text" class="admin_campo" size="10" value="<?php echo $_SESSION['cantporpagina'] ?>"> 
          <input name="submitnombre3" type="submit" class="admin_botones" value=">>"></td>
		 <!-- </form>-->
        </tr>
      </table> 
	</td>
  </tr>
</table>
</form>
<!-- fin buscador -->
	</td>
  </tr>
  <tr> 
    <td width="5%" class="admin_titlista">&nbsp;<?php echo utf8($tit_item) ?></td>
	<td width="5%" class="admin_titlista">&nbsp;</td>
    <td width="52%" class="admin_titlista"><?php echo utf8($TituloNombre) ?></td>
    <td width="38%" class="admin_titlista"><?php echo utf8($tit_acciones) ?></td>
  </tr>
<?php
// Acciones Adicionales		
/*$TablaAcc=$Prefijo."filtros";
$SQL="SELECT * FROM $TablaAcc WHERE Nombretabla='$CualTabla' ";*/
//debbug ::
//echo $SQL."<br>";
/*
$ResultadoAcc=mysql_query($SQL);
$ii=0;
while ($RegAcc=mysql_fetch_array($ResultadoAcc)) {
	$ii++;
	if ($ii==1) {
		$TituloAcc1=$RegAcc['Tituloaccion'];
		$Accion1=$RegAcc['Accionphp'];
		//debbug ::
		//echo "titulo: ".$TituloAcc1." accion: ".$Accion1."<br>";
	}
	if ($ii==2) {
		$TituloAcc2=$RegAcc['Tituloaccion'];
		$Accion2=$RegAcc['Accionphp'];
		//debbug ::
		//echo "titulo: ".$TituloAcc2." accion: ".$Accion2."<br>";
	}
}*/
/*$FiltrarPor="((Publico='1') OR (Publico='0')) ".$filtroCiudad;
if ($FiltroAplicado!="") {
	$CampoFiltro=TextoAntesDe(">",$FiltroAplicado);
	$ValorFiltro=TextoDespuesDe(">",$FiltroAplicado);
	$FiltrarPor.=" AND ($CampoFiltro='$ValorFiltro') ".$filtroCiudad;
}
$consultarpor="";
$jj=0;
while ($jj < $cantvec) {
	$jj++;
	if ($jj==1) {
		$consultarpor="(".$QueCampo[$jj]." LIKE '%$fnombre%') ";
	} else {
		$consultarpor.=" OR (".$QueCampo[$jj]." LIKE '%$fnombre%')";
	}
}*/

if ($fnombre) {
$findQuery .= " AND $NombreTabla.Nombre Like '%$fnombre%' ";
}

	$hastadonde=$_SESSION['cantporpagina'];
	$SQL="SELECT $NombreTabla.ID,$NombreTabla.Nombre, $NombreTabla.Publico,$NombreTabla.$CamposBusqueda $campoFilCiu FROM $NombreTabla $joinCiuProv WHERE $NombreTabla.Publico=1 $whereCiuProv $findQuery GROUP BY $NombreTabla.ID ORDER BY $NombreTabla.ID DESC LIMIT 0,$hastadonde ";

// fin debugging */
$ResultadoConsulta=mysql_query($SQL) or die (mysql_error());
$i=1;
while ($Registro=mysql_fetch_array($ResultadoConsulta)) {
	if (($i%2)==0) { 
		$clase="admin_listaoscura"; 
		$fondoicono="oscuro";
	} else { 
		$clase="admin_listaclara"; 
		$fondoicono="claro";
	}
	$clase="listado_datos";
	$fondoicono="blanco";
	?>
    <tr>
      <td align="right" class="<?php echo $clase ?>">
	  <?php echo $Registro['ID'] ?>
	  </td>
	  <td align="center" class="<?php echo $clase ?>">
	  <?php
	  if ($Registro['Publico']==1) {
	  	  echo "&middot;P&middot;";
	  } else {
	  	  echo "&nbsp;";
	  } 
	  ?>		  
	  </td>
      <td align="left" class="<?php echo $clase ?>">
	  <?php
	  $jj=0;
	  $pusoalgo=false;
	  while ($jj < $cantvec) {
	  	  $jj++;
	  	  $valor=$QueCampo[$jj];
		  if ($jj==1) {
		  	  if ($Icono[$jj]==0) {
			  	  if ($SqlTabla[$jj]=="") {
				  		if($CualTabla=="Escort")
					  		{echo stripslashes($Registro[$valor])." - ".$Registro['Telefono'];}
							else
							{echo stripslashes($Registro[$valor]);}
								
				  } else {
				  	  //es un dato que sale de tabla
					  $id_t=$Registro[$valor];
					  $nombre_t=$Prefijo.TextoAntesDe("=",$SqlTabla[$jj]);
					  $campo_t=TextoDespuesDe("=",$SqlTabla[$jj]);
					  $SQL="SELECT $campo_t FROM $nombre_t WHERE ID='$id_t' ";
					  $Result=mysql_query($SQL);
					  $err=mysql_error();
					  //debbug ::
					  //echo "sql: ".$SQL."<br>";
					  //echo "error: ".$err."<br>";
					  //
					  $Reg_t=mysql_fetch_array($Result);
					  echo stripslashes($Reg_t[$campo_t]);
				  }
			  } else {
			  	  if (($Registro[$valor]!="") and ($Registro[$valor]!="0")) {
				  	  echo "<img src=\"img/icono_".$Icono[$jj]."_".$fondoicono.".gif\">";
				  }
			  }
		  	  if ($Registro[$valor]!="") $pusoalgo=true;
		  } else {
		  	  if ($Icono[$jj]==0) {
				  if ($pusoalgo==true) echo " | ";
				  if ($SqlTabla[$jj]=="") {
					  echo $Registro[$valor];
				  } else {
				  	  //es un dato que sale de tabla
					  $id_t=$Registro[$valor];
					  $nombre_t=$Prefijo.TextoAntesDe("=",$SqlTabla[$jj]);
					  $campo_t=TextoDespuesDe("=",$SqlTabla[$jj]);
					  $SQL="SELECT $campo_t FROM $nombre_t WHERE ID='$id_t' ";
					  $Result=mysql_query($SQL);
					  //debbug ::
					  //echo "sql: ".$SQL."<br>";
					  //echo "error: ".$err."<br>";
					  //
					  $Reg_t=mysql_fetch_array($Result);
					  echo stripslashes($Reg_t[$campo_t]);
				  }
			  } else {
			  	  if (($Registro[$valor]!="") and ($Registro[$valor]!="0")) {					  	  
					  if ($pusoalgo==true) echo " | ";
					  echo "<img src=\"img/icono_".$Icono[$jj]."_".$fondoicono.".gif\">";
				  }
			  }
		  	  if ($Registro[$valor]!="") $pusoalgo=true;
		  }
	  }
	  ?>
	  </td>
	  <td align="left" class="<?php echo $clase ?>">
	  <?php
	  $LinkEliminar="scriptElimRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&filtro=".$FiltroAplicado."&front=".$TomoFront;
	  $LinkModificar="ModRegistro.php?tabla=".$CualTabla."&id=".$Registro['ID']."&filtro=".$FiltroAplicado."&front=".$TomoFront;
	  ?>
	  <a href="<?php echo $LinkModificar ?>" class="admin_linkaccion"><?php echo utf8($lk_modificar) ?></a>
	  | <a href="<?php echo $LinkEliminar ?>" class="admin_linkaccion"><?php echo utf8($lk_eliminar) ?></a>
	  <!-- Aca van las Acciones Adicionales -->
	  <?php
	  // 
	  if ($Accion1!="") {
	      $AccionAux=$Accion1;
		  $AccionAux=TextoCambiado($AccionAux,"%ID%",$Registro['ID']);
		  //lo hago de vuelta, por si hay dos veces %ID%
		  $AccionAux=TextoCambiado($AccionAux,"%ID%",$Registro['ID']);
		  $AccionAux=TextoCambiado($AccionAux,"%Nombre%",$Registro['Nombre']);
		  $LinkAccionAdicional=$AccionAux;
		  $TituloAccionAdicional=$TituloAcc1;
		  ?>
		  | <a href="<?php echo $LinkAccionAdicional ?>" class="admin_linkaccion"><?php echo utf8($TituloAccionAdicional) ?></a>
		  <?php 
	  }
	  if ($Accion2!="") {
	  	  $AccionAux=$Accion2;
		  $AccionAux=TextoCambiado($AccionAux,"%ID%",$Registro['ID']);
		  $AccionAux=TextoCambiado($AccionAux,"%Nombre%",$Registro['Nombre']);		  
	  	  $LinkAccionAdicional=$AccionAux;
		  $TituloAccionAdicional=$TituloAcc2;		  
		  ?>
		  | <a href="<?php echo $LinkAccionAdicional ?>" class="admin_linkaccion"><?php echo utf8($TituloAccionAdicional) ?></a>
		  <?php
	  }
	  ?>
	  </td>
    </tr>
	<?php
	$i++;
}
?>
</table>

<table border="0" cellpadding="3" cellspacing="0">
  <tr>
	
	<form action="admin.php" name="formVolver" method="post"> 		  
    <td valign="top" align="left">
	<input type="submit" name="volver" class="admin_botones" value="<< <?php echo utf8($bt_volver) ?>">
	</td>
	</form>
	
	<form enctype="multipart/form-data" method="post" action="EliminarRegistros.php?tabla=<?php echo $CualTabla ?>" name"formEliminar">
    <td height="16" align="right">
	<input name="tabla" type="hidden" value="<?php echo $CualTabla ?>">
 	<input name="filtro" type="hidden" value="<?php echo $FiltroAplicado ?>">	
	<input name="front" type="hidden" value="<?php echo $TomoFront ?>">
    <input name="bt_eliminar" type="submit" class="admin_botones" value="<?php echo utf8($bt_eliminarxcriterio) ?> >>">
	</td>
	</form>
	
	<form enctype="multipart/form-data" action="recuperarTabla.php?tabla=<?php echo $CualTabla ?>" name="formRecuperar" method="post"> 		  
	<td valign="top" align="right">
	<input type="hidden" name="tabla" value="<?php echo $CualTabla ?>">
	<input type="hidden" name="filtro" value="<?php echo $FiltroAplicado ?>">
	<input type="submit" name="recuperar" class="admin_botones" value="<?php echo utf8($bt_recuperar) ?> >>">
	</td>
	</form>	
  </tr>
</table>			

</body>
</html>
