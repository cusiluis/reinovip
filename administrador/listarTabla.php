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

$ResultL=$mysqli->query($SQL);

$cantreg=mysqli_num_rows($ResultL);

if ($cantreg < 1) {$nombreusuario="";}

else

{$arryLog=mysqli_fetch_array($ResultL);

$idUsuario=$arryLog['ID'];

$nivelUsuario=$arryLog['Nivel'];

}



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



	if($CualTabla=="Escort")

	{

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

	}

?>

<script type="text/javascript">

	function ajaxFunction() {

	  var xmlHttp;

	  try {

	   

		xmlHttp=new XMLHttpRequest();

		return xmlHttp;

	  } catch (e) {

		

		try {

		  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");

		  return xmlHttp;

		} catch (e) {

		  

		  try {

			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");

			return xmlHttp;

		  } catch (e) {

			alert("Tu navegador no soporta AJAX!");

			return false;

		  }}}

	}



	function activar(enviar,id)

	{

		var pack=document.getElementById("pack_"+id).options[document.getElementById("pack_"+id).selectedIndex].value;

		var diasPub=document.getElementById("diasPub_"+id).value;

		if(diasPub==0 || diasPub=="" || pack==0)

		{

			alert("Para activar el anuncio debe registrar los dias de publicación, y el tipo de contratación.");

		}

		else

		{

			window.location.href="listarTabla.php?tabla=Escort&activar=1&id="+id+"&diasPub="+diasPub+"&enviar="+enviar+"&pack="+pack;

		}

    }  

	

	function verCiudades(idProvincia,idCiudad) {

		document.getElementById("fciudad").disabled=true;

		var ajax;

		ajax = ajaxFunction();

		ajax.open("POST", "../ciudades.php", true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		

		ajax.onreadystatechange = function() {

			if (ajax.readyState==1){

					 }

			if (ajax.readyState == 4) {

					 document.getElementById("fciudad").disabled=false;

					 document.getElementById("fciudad").innerHTML=ajax.responseText;

				 }}

				 

		ajax.send('idProvincia='+idProvincia+'&idCiudad='+idCiudad);

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

</head>



<body>

<?php 

//pongo $TituloNombre / $CamposBusqueda / vector $QueCampo / $cantvec

$CamposBusqueda="Nombre";

$cantvec=1;

$QueCampo[1]="Nombre";

$tablaE=$Prefijo."estructura";

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



$MensajeFiltro="";

$findQuery=" 1 ";

$fid=$_POST["fid"];  // del form de buscar por nº de item, campo "ID"

$fidhasta=$_POST["fidhasta"];

if ($fid) {

	if ($fidhasta) {

		$findQuery .= " AND $NombreTabla.ID>=$fid AND $NombreTabla.ID<=$fidhasta ";

		$MensajeFiltro = $MensajeFiltro." ID de ".$fid." a ".$fidhasta."</b>. ";

	} else {

		$findQuery .= " AND $NombreTabla.ID=$fid ";

		$MensajeFiltro = $MensajeFiltro."ID = ".$fid."</b>. ";

	}

}

$fnombre=$_POST["fnombre"]; // del form de buscar por campo "Nombre"
$ftelefono=$_POST["ftelefono"]; // del form de buscar por campo "Nombre"

if ($fnombre) {

	$MensajeFiltro .= " / ".utf8($ley_contenido).": <b>".$fnombre."</b>.";

}



$filtroCiudad="";

$campoFilCiu="";

$swCiud=0;

$fcategoria=0;

$festado=-1;



	if(isset($_POST['fcategoria']) && $_POST['fcategoria']!=0)

	{$fcategoria=$_POST['fcategoria'];

	$findQuery.=" AND $NombreTabla.CategoriaID='$fcategoria'";

	}

	

	if(isset($_POST['festado']) && $_POST['festado']!=-1)

	{$festado=$_POST['festado'];

	}



	$idProv=0;

	if (isset($_POST['fprovincia']) && $_POST['fprovincia']!=0) {

	$idProv=$_POST['fprovincia'];

	}

	

	$idCiu=0;

	if (isset($_POST['fciudad']) && $_POST['fciudad']!=0) {

	$idCiu=$_POST['fciudad'];

	}





	/*

	if(isset($_POST["fciudad"]) && ($CualTabla=="Escort"))

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

			$findQuery .= " AND ep.IDProvincia=".$fprovincia;

		}

		else

		{

			$swCiud=1;

			$idSelProv=$fciudad;

			$MensajeFiltro = $MensajeFiltro." / Ciudad : <b>".$fciudad."</b>.";

			$joinCiuProv = " JOIN reino01_escort_ciudad ec ON $NombreTabla.ID = ec.IDEscort";

			$findQuery .= " AND ec.IDCiudad=".$fciudad;

		}

		}

	}

	

	if(isset($_POST["fciudad"]) && ($CualTabla=="Banner"))

	{

		if(($fprovincia!=0) || ($fciudad!=0))

		{

		$verCiuProv=explode("-",$_POST["fciudad"]);

		$fprovincia=$verCiuProv[0];

		$fciudad=$verCiuProv[1];

		if ($fciudad==0) {

			$idSelProv=$fprovincia;

			$MensajeFiltro = $MensajeFiltro." / Provincia : <b>".$fprovincia."</b>.";

			$joinCiuProv = " JOIN reino01_banner_provincia ep ON $NombreTabla.ID = ep.IDBanner";

			$findQuery .= " AND ep.IDProvincia=".$fprovincia;

		}

		else

		{

			$swCiud=1;

			$idSelProv=$fciudad;

			$MensajeFiltro = $MensajeFiltro." / Ciudad : <b>".$fciudad."</b>.";

			$joinCiuProv = " JOIN reino01_banner_ciudad ec ON $NombreTabla.ID = ec.IDBanner";

			$findQuery .= " AND ec.IDCiudad=".$fciudad;

		}

		}

	}

*/

if ($CualTabla=="DeBBuG") {

	$tablaL=$Prefijo."logueo";

	$SQL="SELECT * FROM $tablaL ";

	$ResultL=$mysqli->query($SQL);

	while ($RegL=mysqli_fetch_array($ResultL)) {

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

          <td width="297"><span class="admin_txt"><?php echo utf8($tit_buscar)." ".utf8($TituloNombre) ?>: </span></td>


          <td width="111"><span class="admin_txt"><?php echo utf8($tit_regxpag) ?>:</span></td>

        </tr>

      </table>

    </td>

  </tr>

  <tr> 

    <td valign="top" class="admin_fondocampo" style="background: #E9E9E7;">

	  <table width="750" border="0" cellspacing="0" cellpadding="0">

        <tr> 

          <td width="86"><input name="fid" type="text" class="admin_campo" size="10" value="<?php echo $fid; ?>"></td>

          <td width="154"> <input name="fidhasta" type="text" class="admin_campo" size="10" value="<?php echo $fidhasta; ?>"> 

          <input name="submitnombre2" type="submit" class="admin_botones" value=">>"> 

          </td>

<!--		  </form>

		  <form name="formBuscarPorNombre" method="post" action="listarTabla.php?tabla=<?php echo $CualTabla ?>&filtro=<?php echo $FiltroAplicado ?>&titulo=<?php echo $TituloPagina ?>">

-->          <td width="450" align="center">

          <?php 

		  if(($CualTabla=="Escort") || ($CualTabla=="Banner"))

		  {

		  	if($CualTabla=="Escort")

			{$campoFilCiu=", Telefono";

			}

			else

			{

				if($CualTabla=="Banner")

				{$campoFilCiu=", Alias";}

			}

		  $sqlProvA=$mysqli->query("SELECT * FROM reino01_Provincia WHERE Publico=1 ORDER BY Nombre");

		  ?>

          <input name="fnombre" type="text" class="admin_campo" size="50" value="<?php echo $fnombre; ?>"><br><br>

          <span class="admin_txt">Telefono: </span>
          <input name="ftelefono" type="text" class="admin_campo" size="50" value="<?php echo $ftelefono; ?>"><br><br>

          <select name="fprovincia" onChange="verCiudades(this.value,0)">

          	<option value="0"> - Seleccione la provincia - </option>

            <?php

			while($arryProv = mysqli_fetch_array($sqlProvA))

			{

				echo '<option value="'.$arryProv['ID'].'" '.($idProv==$arryProv['ID'] ? 'selected="selected"' : '').'>'.$arryProv['Nombre'].'</option>';

			}

			?>

          </select>

          <select name="fciudad" id="fciudad">

          <option value="0">---o---</option>

          </select>

          <script type="text/javascript">

		  verCiudades(<?php echo $idProv?>,<?php echo $idCiu?>);

		  </script>

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

-->          <td width="200"><input name="cantregxpag" type="text" class="admin_campo" size="10" value="<?php echo $_SESSION['cantporpagina'] ?>"> 

          <input name="submitnombre3" type="submit" class="admin_botones" value=">>"></td>

		 <!-- </form>-->

        </tr>

                  

		<?php if($CualTabla=="Escort") { 

		echo "<tr><td></td><td></td>

		<td align='center'>";

		?>

          <?php $sqlCat="SELECT * FROM reino01_Categoria WHERE Publico=1 ORDER BY Nombre";?>

          <br><select name="fcategoria">

          	<option value="0"> - Seleccione categoria - </option>

            <?php 

				$resultCat=$mysqli->query($sqlCat);

				while($arryCat=mysqli_fetch_array($resultCat))

				{

				$idCat=$arryCat['ID'];

				echo "<option value='".$arryCat['ID']."' ".($fcategoria==$arryCat['ID'] ? ' selected="selected"' : '')." >".$arryCat['Nombre']."</option>";

				}

			?>

          </select>

          <select name="festado">

          	<option value="-1"> - Estado - </option>

            <?php 

			echo "<option value='0' ".($festado==0 ? ' selected="selected"' : '')." >No publicado</option>";

			echo "<option value='1' ".($festado==1 ? ' selected="selected"' : '')." >Publicado</option>";

			echo "<option value='3' ".($festado==3 ? ' selected="selected"' : '')." >Pendiente</option>";

			?>

          </select>

          <?php } 

		  echo "</td><td></td>";

		  ?>

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

    <td width="40%" class="admin_titlista"><?php echo utf8($TituloNombre) ?></td>

    <td width="60%" class="admin_titlista"><?php echo utf8($tit_acciones) ?></td>

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

while ($RegAcc=mysqli_fetch_array($ResultadoAcc)) {

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

if ($idProv!=0) {

$findQuery .= " AND $NombreTabla.ProvinciaID = '$idProv' ";

}



if ($idCiu!=0) {

$findQuery .= " AND $NombreTabla.CiudadID = '$idCiu' ";

}



if ($fnombre) {

$findQuery .= " AND $NombreTabla.Nombre Like '%$fnombre%'";


}

if($ftelefono){
$findQuery .= " AND $NombreTabla.Telefono = '$ftelefono'";	
}


if($festado==-1)

{$findQuery .= " AND (($NombreTabla.Publico=1) OR ($NombreTabla.Publico=0)) ";}

else

{$findQuery .= " AND ($NombreTabla.Publico=$festado) ";}



if(($nivelUsuario=="Cliente") && ($CualTabla=="Escort"))

{$findQuery .= " AND IDusuario='$idUsuario' ";}



	$hastadonde=$_SESSION['cantporpagina'];

	$selCampos="";

	if($CualTabla=="Escort")

	{

		$selCampos=" fechaPublicacion, diasPublicacion, EnvioWac, EstadoEnvioWac, ";

	}

	$SQL="SELECT $selCampos $NombreTabla.ID,$NombreTabla.Nombre, $NombreTabla.Publico,$NombreTabla.$CamposBusqueda $campoFilCiu FROM $NombreTabla $joinCiuProv WHERE $findQuery GROUP BY $NombreTabla.ID ORDER BY $NombreTabla.ID DESC LIMIT 0,$hastadonde ";


//echo $SQL;
// fin debugging */

$ResultadoConsulta=$mysqli->query($SQL);

$i=1;

while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {

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

	  		if($CualTabla=="Escort")

			{echo "<img src='../img/reinovip.png' width='17px' title='Publico en Reino Vip' alt='Publico en Reino Vip'>";

			

				if($Registro['EnvioWac']==1 && $Registro['EstadoEnvioWac']==1)

				{echo "&nbsp;&nbsp;<img src='../img/enviado.ico' width='14px' title='Enviado WAC' alt='Enviado WAC'>";}

				

				if($Registro['EnvioWac']==1 && $Registro['EstadoEnvioWac']==0)

				{echo "&nbsp;&nbsp;<img src='../img/preparadoEnviar.ico' width='15px' title='Preparado para enviar WAC' alt='Preparado para enviar WAC'>";}

			}

			else

			{echo "&middot;P&middot;";}

	  } else {

	  	  echo "&nbsp;";

		  if($Registro['EnvioWac']==1 && $Registro['EstadoEnvioWac']==1)

				{echo "&nbsp;&nbsp;<img src='../img/enviado.ico' width='14px' title='Enviado WAC' alt='Enviado WAC'>";}

				

				if($Registro['EnvioWac']==1 && $Registro['EstadoEnvioWac']==0)

				{echo "&nbsp;&nbsp;<img src='../img/preparadoEnviar.ico' width='15px' title='Preparado para enviar WAC' alt='Preparado para enviar WAC'>";}

	  } 

	  ?>		  

	  </td>

      <td align="left" class="<?php echo $clase ?>">

      <?php
      	// echo '<img src="img/nopicture.png" width="15px" title="EL PERFIL NO TIENE IMAGEN POR DEFECTO">';
      ?>

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

					  		{

					  			echo stripslashes($Registro[$valor])." - ".$Registro['Telefono'];							


	$lstErrores="";
	$escort_id = $Registro['ID'];
	$prefEscorts=$Prefijo."foto_escort";
	$SQL2 = "select * from $prefEscorts where IdEscort='$escort_id' and Principal='1'";
	
	
	
	$sqlBuscarImagen=$mysqli->query($SQL2);
	//$sql= "select * from $prefEscorts where IdEscort='$id' and Principal='1'";
	if(mysqli_num_rows($sqlBuscarImagen) == 0)

	{

		$lstErrores .= 'EL PERFIL NO TIENE IMAGEN PRINCIPAL';

	}



	

								$cantReg=$lstErrores;
								
								if($cantReg!="")

								{	
									

									echo '<img src="img/nopicture.png" width="15px" alt="'.$cantReg.'" title="'.$cantReg.'" >';

								}

							}

							else

							{

								if($CualTabla=="Banner")

								{echo stripslashes($Registro['Alias']." - ".$Registro[$valor]);}

								else

								{echo stripslashes($Registro[$valor]);}

							}

								

				  } else {

				  	  //es un dato que sale de tabla

					  $id_t=$Registro[$valor];

					  $nombre_t=$Prefijo.TextoAntesDe("=",$SqlTabla[$jj]);

					  $campo_t=TextoDespuesDe("=",$SqlTabla[$jj]);

					  $SQL="SELECT $campo_t FROM $nombre_t WHERE ID='$id_t' ";

					  $Result=$mysqli->query($SQL);

					  $err=mysqli_error();

					  //debbug ::

					  //echo "sql: ".$SQL."<br>";

					  //echo "error: ".$err."<br>";

					  //

					  $Reg_t=mysqli_fetch_array($Result);

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

					  $Result=$mysqli->query($SQL);

					  //debbug ::

					  //echo "sql: ".$SQL."<br>";

					  //echo "error: ".$err."<br>";

					  //

					  $Reg_t=mysqli_fetch_array($Result);

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

	  

	  if($CualTabla=="Escort")

	  {

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

          <table style="font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;font-size: 11px;"><tr><td>

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

	

    <?php if($nivelUsuario!="Cliente") : ?>

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

    <?php endif; ?>

  </tr>

</table>			



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



// function revisarErrores($Prefijo,$id)

// {

// 	$lstErrores="";

// 	$prefEscorts=$Prefijo."foto_escort";

// 	$sqlBuscarImagen=$mysqli->query("select * from $prefEscorts where IdEscort='$id' and Principal='1'");

// 	if(mysqli_num_rows($sqlBuscarImagen) == 0)

// 	{

// 		$lstErrores .= "No se encontro una imagen principal.\n";

// 	}



// 	return $lstErrores;

// }

?>

