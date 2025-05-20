<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");

$nombreusuario=$_SESSION['usuariolog'];
// valido el usuario en la tabla de logueos
$tablaL=$Prefijo."logueo";
$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";
$ResultL=$mysqli->query($SQL);
$cantreg=mysqli_num_rows($ResultL);
if ($cantreg < 1) {$nombreusuario="";}
else
{$arryLog=mysqli_fetch_array($ResultL);}

if ($nombreusuario=="") {
	header("Location: admin.php?mensaje=".$error_accesoindebido.".");
	exit;
}

$volver=$_GET['backto'];

// no es necesario poner a la variable como "global" cuando se utiliza 
// directamente en el body (y no en una funcion)
// global $LongitudMaximaDeCampoEnPantalla;
$TomoFront=$_GET["front"];
if ($TomoFront=="") $TomoFront=$_POST["front"];
$CualTabla=$_GET["tabla"];
if (($CualTabla=="") or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": AltaRegistro.");
    exit;
}
$Mensaje=$_GET["mensaje"];

$filtro=$_GET['filtro'];
if ($filtro=="") $filtro=$_POST['filtro'];
if ($filtro!="") {
	$CampoFiltro=TextoAntesDe(">",$filtro);
	$ValorFiltro=TextoDespuesDe(">",$filtro);
} else {
	$CampoFiltro="";
}

//BUSQUEDA DE CANTIDAD DE ESCORTS REGISTRADOS
$idUs=$arryLog['ID'];
$nivelUs=$arryLog['Nivel'];
if($arryLog['Cmax']!=0){
	$tablaEsVer=$Prefijo."Escort";
	$SQLeVer="SELECT * FROM $tablaEsVer WHERE IDusuario='$idUs' AND ((Publico=1) OR (Publico=0)) ";
	$ResultEVer=$mysqli->query($SQLeVer);
	$cantEVer=mysqli_num_rows($ResultEVer);
	if ($cantEVer >= $arryLog['Cmax'])
	{	header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=Usted solo puede registrar ".$arryLog['Cmax']." anuncios, ya se ha excedido esta capacidad.");
		exit;
	}
}

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
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,cut,copy,paste,|,forecolor,backcolor",
		
		theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect,|,fullscreen",
		
		theme_advanced_buttons3 : "pastetext,pasteword,|,search,replace,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",
		theme_advanced_buttons4 : "insertdate,inserttime,preview,|,tablecontrols,|,styleprops",
		theme_advanced_buttons5 : "hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,insertlayer,moveforward,movebackward,absolute",
		
		theme_advanced_buttons6 :"cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",

								
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
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

	function verCiudadesDesplegable(idProv)
	{
		window.document.getElementById("ciudadPorProv" + idProv).style.display="block";
		window.document.getElementById("btnCiudad" + idProv).innerHTML="<a href='javascript:ocultarCiudades(" + idProv + ")'><img src='img/ocultar.png' title='Ocultar provincias' alt='Ocultar provincias'></a>";
	}
	
	function ocultarCiudades(idProv)
	{
		window.document.getElementById("ciudadPorProv" + idProv).style.display="none";
		window.document.getElementById("btnCiudad" + idProv).innerHTML="<a href='javascript:verCiudades(" + idProv + ")'><img src='img/mostrar.png' title='Mostrar provincias' alt='Mostrar provincias'></a>";
	}
	
	function verProvincias(idPais,idProv) {
		document.getElementById("ProvinciaID").disabled=true;
		var ajax;
		ajax = ajaxFunction();
		ajax.open("POST", "../provincias.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		ajax.onreadystatechange = function() {
			if (ajax.readyState==1){
					 }
			if (ajax.readyState == 4) {
					 document.getElementById("ProvinciaID").disabled=false;
					 document.getElementById("ProvinciaID").innerHTML=ajax.responseText;
				 }}
				 
		ajax.send('idPais='+idPais+'&idProvincia='+idProv);
	} 
	
	function verCiudades(idProvincia,idCiudad) {
		document.getElementById("CiudadID").disabled=true;
		var ajax;
		ajax = ajaxFunction();
		ajax.open("POST", "../ciudades.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		ajax.onreadystatechange = function() {
			if (ajax.readyState==1){
					 }
			if (ajax.readyState == 4) {
					 document.getElementById("CiudadID").disabled=false;
					 document.getElementById("CiudadID").innerHTML=ajax.responseText;
				 }}
				 
		ajax.send('idProvincia='+idProvincia+'&idCiudad='+idCiudad);
	} 
</script>
<?php
//armo el script de validacion
echo "<script language=\"JavaScript\">\n";
echo "function validar() {\n";
echo "var regex=new RegExp(\"^[^@ ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|tv|cc|gov|mil|org|edu|int|biz|info|name|pro)$\");\n";
echo " 	  regnum=new RegExp(\" 0-9\.\,\");\n";
$tablaE=$Prefijo."estructura";
if ($TomoFront=="si") {
	$SQL="SELECT Titulocampo,Validaciones FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenfront='0' ORDER BY Nrodeordenfront ASC";
} else {
	$SQL="SELECT Titulocampo,Validaciones FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenback='0' ORDER BY Nrodeordenback ASC";
}
$ResultadoEstructura=$mysqli->query($SQL);
$jj=1;
$HayValidaciones=false;
while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {
	$TituloCampo=$RegistroEstructura['Titulocampo'];
	$NombreCampo="Campo".$jj;
	$ListaDeValidaciones=$RegistroEstructura['Validaciones'];
	if (strpos($ListaDeValidaciones,']') > 0) {
		//elimino lo que esta entre corchetes
		$posabertura=strpos($ListaDeValidaciones,'[');
		$poscierre=strpos($ListaDeValidaciones,']');
		$adelante=substr($ListaDeValidaciones,0,$posabertura);
		$atras=substr($ListaDeValidaciones,$poscierre+1);
		$ListaDeValidaciones=$adelante.$atras;
	}
	if (strpos($ListaDeValidaciones,";") > 0) {
		$Validacion=TextoAntesDe(";",$ListaDeValidaciones);
		$ListaDeValidaciones=TextoDespuesDe(";",$ListaDeValidaciones);
	} else {
		$Validacion=$ListaDeValidaciones;
		$ListaDeValidaciones="";
	}
	while ($Validacion!="") {
		$HayValidaciones=true;
		if ($Validacion=="novacio") {
			echo "    if (document.FormAgregar.".$NombreCampo.".value=='') {\n";
			echo "        alert('".$tit_error.": ".utf8($TituloCampo)." ".utf8($error_vacio)."');\n";
			echo "        document.FormAgregar.".$NombreCampo.".focus();\n";
			echo "        return false;\n";
			echo "    }\n";		
		}
		if ($Validacion=="esmail") {
			echo "    if (regex.test(document.FormAgregar.".$NombreCampo.".value)==false) {\n";
			echo "        alert('".$tit_error.": ".utf8($TituloCampo)." ".utf8($error_mailinvalido)."');\n";
			echo "        document.FormAgregar.".$NombreCampo.".focus();\n";
			echo "        return false;\n";
			echo "    }\n";
		}
		if ($Validacion=="esnumero") {
			echo "    if (regnum.test(document.FormAgregar.".$NombreCampo.".value)==false) {\n";
			echo "        alert('".$tit_error.": ".utf8($TituloCampo)." ".utf8($error_numero)."');\n";
			echo "        document.FormAgregar.".$NombreCampo.".focus();\n";
			echo "        return false;\n";
			echo "    }\n";
		}
		if (strpos($ListaDeValidaciones,";") > 0) {
			$Validacion=TextoAntesDe(";",$ListaDeValidaciones);
			$ListaDeValidaciones=TextoDespuesDe(";",$ListaDeValidaciones);
		} else {
			$Validacion=$ListaDeValidaciones;
			$ListaDeValidaciones="";
		}
	} // del while ($Validacion)	
	$jj++;	
}
echo "    document.FormAgregar.submit();\n";
echo "}\n";
echo "</script>\n";
?>
</head>

<body>
<?php include("topadmin.inc.php"); ?>
  <form enctype="multipart/form-data"
	    action="scriptAltaRegistro.php?tabla=<?php echo $CualTabla ?>&backto=<?php echo $volver ?>" 
		onSubmit="validar();return false;"
	    method="post" 
		name="FormAgregar">
<table border="0" cellpadding="3" cellspacing="0" class="admin_form_derecha">
  <tr>
    <td class="listado_titulogeneral" colspan="2"><a href="listarTabla.php?tabla=<?php echo $CualTabla?>" class="admin_botones" > &lt;&lt; <?php echo utf8($bt_volver) ?></a>
	:: <?php echo utf8($tit_agregando) ?> <?php echo $CualTabla ?> 
	</td>
  </tr>        
<?php
$tablaE=$Prefijo."estructura";
if ($TomoFront=="si") {
	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenfront='0' ORDER BY Nrodeordenfront ASC";
} else {
	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenback='0' ORDER BY Nrodeordenback ASC";
}
$ResultadoEstructura=$mysqli->query($SQL);
$jj=1;
while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {
    $TipoDeEntrada=strtoupper($RegistroEstructura['Tipodeentrada']);
	$TituloCampo=$RegistroEstructura['Titulocampo'];
	$NombreOriginal=$RegistroEstructura['Nombrecampo'];
	$NombreCampo="Campo".$jj;
    $Long=$RegistroEstructura['Ancho'];
	// echo $Long."-".$LongitudMaximaDeCampoEnPantalla; 
	if ($Long > $LongitudMaximaDeCampoEnPantalla) {
		if (($TipoDeEntrada=="ARCHIVO") or ($TipoDeEntrada=="IMAGEN")) {
			$Long=$LongitudMaximaDeCampoEnPantalla-25;
		} else {
			$Long=$LongitudMaximaDeCampoEnPantalla;
		}
	}
    $LongMax=$RegistroEstructura['Ancho'];
    $Alto=$RegistroEstructura['Alto'];
    $ValorInicial=$RegistroEstructura['Valoresdefault'];
	$Leyenda=$RegistroEstructura['Leyendadetrasdeinput'];
	$Validaciones=$RegistroEstructura['Validaciones'];
	if (strpos($Validaciones,']') > 0) {
		//elimino lo que esta entre corchetes
		$posabertura=strpos($Validaciones,'[');
		$poscierre=strpos($Validaciones,']');
		$adelante=substr($Validaciones,0,$posabertura);
		$atras=substr($Validaciones,$poscierre+1);
		$Validaciones=$adelante.$atras;
	}
	//-------------------------------------------------------------------
	
    if ($TipoDeEntrada=="INPUT") {
		if ($RegistroEstructura['Sentenciasqlrelacionada']!="") {
			$Comando=$RegistroEstructura['Sentenciasqlrelacionada'];
			//-------- HAY COMANDOS INTERNOS ---------------------------
			?>		
		    <tr> 
    		  <td width="25%" class="celdatitulo">
			  <?php echo utf8($TituloCampo) ?>
			  </td>
	    	  <td width="75%" class="celdainput">
			  <?php 
			  if ($Comando=="[campo_usuario]") {
				  ?>
			      <select name="<?php echo $NombreCampo ?>" class="admin_campo">
        		  <option value="" class="admin_campo" selected>- <?php echo $campo_seleccione ?> -</option>
				  <?php
				  $tablaE=$Prefijo."estructura";
				  $SQL="SELECT * FROM $tablaE WHERE Nombretabla='Usuario' ORDER BY Nombrecampo ASC";
				  $ResultE=$mysqli->query($SQL);
				  while ($RegE=mysqli_fetch_array($ResultE)) {
					  ?>
	        		  <option value="<?php echo $RegE['Nombrecampo'] ?>" class="admin_campo"><?php echo $RegE['Titulocampo'] ?></option>
					  <?php
				  }
				  ?>
				  </select>
				  <?php
			  }
			  echo utf8($Leyenda);
			  if ($Validaciones!="") {
				  ?> 
				  <span class="admin_obligatorio">(*)</span>
				  <?php
			  }
			  ?>
		      </td>
		    </tr>
			<?php 
		} else {
			?>		
		    <tr> 
    	  	  <td width="25%" class="celdatitulo">
			  <?php echo utf8($TituloCampo) ?>
		  	  </td>
	    	  <td width="75%" class="celdainput">
			  <?php 
			  if ($CampoFiltro==$NombreOriginal) {
				  ?>
	    		  <input name="<?php echo $NombreCampo ?>" type="hidden" value="<?php echo $ValorFiltro ?>">
	    		  <input name="falso_<?php echo $NombreCampo ?>" 
					   type="text"
					   class="admin_campo"
					   value="<?php echo $ValorFiltro ?>" 
					   size="<?php echo $Long ?>" 
					   maxlength="<?php echo $LongMax ?>" disabled>
				  <?php
			  } else {
				  ?>
	    		  <input name="<?php echo $NombreCampo ?>" 
					   type="text"
					   class="admin_campo"
					   value="<?php echo $ValorInicial ?>" 
					   size="<?php echo $Long ?>" 
					   maxlength="<?php echo $LongMax ?>">
				  <?php
			  }
			  echo utf8($Leyenda);
			  if ($Validaciones!="") {
		  		  ?> 
				  <span class="admin_obligatorio">(*)</span>
				  <?php
			  }
			  ?>
		      </td>
		    </tr>
			<?php 
		}
		
    } elseif ($TipoDeEntrada=="MEMO") {
		?> 
	    <tr>
		  <td width="25%" class="celdatitulo">
		  <?php echo utf8($TituloCampo) ?>
		  </td>
		  <td width="75%" class="celdainput">	    
	      <textarea name="<?php echo $NombreCampo ?>" 
  			 	class="admin_campo"
				cols="<?php echo $Long ?>" 
				rows="<?php echo $Alto ?>" 
				wrap="OFF"><?php echo $ValorInicial ?></textarea>
	      <?php
		  if ($Validaciones!="") {
		  	  ?> 
			  <span class="admin_obligatorio">(*)</span>
			  <?php
		  }
		  ?>
    	  </td>
  		</tr>
		<?php
		
    } elseif ($TipoDeEntrada=="RADIO") {
		$CadenaACortar=$RegistroEstructura['Valores'];
		?>
		<tr> 
		  <td width="25%" class="celdatitulo">
		  <?php echo utf8($TituloCampo) ?>
		  </td>
		  <td width="75%" class="celdainput">
		  <?php
		  $ii=1;
		  while ($CadenaACortar!="") {
		  	  $chk="";
			  if ($ValorInicial==$ii) $chk="checked";
			  ?> 
			  <input type="radio" name="<?php echo $NombreCampo ?>" value="<?php echo $ii ?>" <?php echo $chk ?> >
			  <?php 
			  $muestra_radio=PrimerValorSubcadena();
			  echo utf8($muestra_radio) ?>&nbsp;&nbsp;
			  <?php
			  $ii++;
		  } // fin del while
		  if ($Validaciones!="") {
			  ?>
			  <span class="admin_obligatorio">(*)</span>
			  <?php
		  }
		  ?>
		  </td>
		</tr>
		<?php
		
    } elseif ($TipoDeEntrada=="COMBO") {
		$CadenaACortar=$RegistroEstructura['Valores'];
		?>
		<tr> 
		  <td width="25%" class="celdatitulo">
		  <?php echo utf8($TituloCampo) ?>
		  </td>
		  <td width="75%" class="celdainput">
          <?php
		  $IDGenCampo="";
		  if($NombreOriginal=="ProvinciaID")
		  {
		  	$IDGenCampo=" id='ProvinciaID' ";
		  }
		  if($NombreOriginal=="CiudadID")
		  {
		  	$IDGenCampo=" id='CiudadID' ";
		  }
		  ?>
		  <select name="<?php echo $NombreCampo ?>" class="admin_campo" <?php echo $IDGenCampo;?> <?php echo ($NombreOriginal=="ProvinciaID" ? "onChange='verCiudades(this.value,0)'" : "");?>>
          <option value="" class="admin_campo">- <?php echo $campo_seleccione ?> -</option>
		  <?php 
		  while ($CadenaACortar != "") {
		      $Texto=PrimerValorSubcadena(); 
		  	  $ValorATomar=TextoAntesDe("=",$Texto);
			  $TextoAMostrar=TextoDespuesDe("=",$Texto);
			  ?>
			  <option value="<?php echo $ValorATomar ?>" class="admin_campo"><?php echo $TextoAMostrar ?></option>
			  <?php
		  }  
		  ?>
          </select>
    	  <?php
		  if ($Validaciones!="") {
			  ?>
			  <span class="admin_obligatorio">(*)</span>
			  <?php
		  }
		  ?>
		  </td>
		</tr>
		<?php
    } elseif (($TipoDeEntrada=="TABLA") && (($nivelUs!="Cliente") || ($NombreOriginal!="IDusuario"))) {
		?>
		<tr> 
		  <td width="25%" class="celdatitulo">
		  <?php echo utf8($TituloCampo) ?>
		  </td>
		  <td width="75%" class="celdainput">
		  <?php
		  //debbug :: 
		  //echo "filtro: ".$filtro."<br>";
		  //echo "CampoFiltro: ".$CampoFiltro."<br>";
		  //echo "ValorFiltro: ".$ValorFiltro."<br>";
		  //echo "NombreOriginal: ".$NombreOriginal."<br>";
		  //
		  $SQLrelacionada=$RegistroEstructura['Sentenciasqlrelacionada'];
	      if ($SQLrelacionada=="") {
			  //debbug ::	echo "no tiene sentencia sql relacionada.<br>";
			  $Texto=$RegistroEstructura['Provienedetablarelacionada'];
			  $TablaRelacionada=TextoAntesDe("=",$Texto);
			  $QueSeDebeMostrar=TextoDespuesDe("=",$Texto);
			  $CamposAMostrar="";
			  while (strpos($QueSeDebeMostrar,"+") > 0) {
				  $Campo=TextoAntesDe("+",$QueSeDebeMostrar);
				  $QueSeDebeMostrar=TextoDespuesDe("+",$QueSeDebeMostrar);
				  if (strpos($Campo,"(") > 0) {
					  $Campo=TextoAntesDe("(",$Campo);
				  }
				  $CamposAMostrar.=$Campo.",";
			  }
		  	  $Campo=$QueSeDebeMostrar;
			  if (strpos($Campo,"(") > 0) {
				  $Campo=TextoAntesDe("(",$Campo);
			  }
			  $CamposAMostrar.=$Campo;
			  $QueSeDebeMostrar=TextoDespuesDe("=",$Texto);
			  if ($CampoFiltro==$NombreOriginal) {
				  $ValorDefecto=$ValorFiltro;
			  } else {
			  	  $ValorDefecto="";
			  }
			  if ($ValorDefecto!="") {
				  ?>
			      <input type="hidden" name="<?php echo $NombreCampo ?>" value="<?php echo $ValorDefecto ?>">
			      <select name="falso_<?php echo $NombreCampo ?>" class="admin_campo" disabled >
	    	      <option value="" class="admin_campo">- <?php echo utf8($campo_quitarseleccion) ?> -</option>
				  <?php
			  } else {
				  ?>
			      <select name="<?php echo $NombreCampo ?>" class="admin_campo" <?php echo ($NombreOriginal=="PaisID" ? "onChange='verProvincias(this.value,0)'" : "");?> >
	    	      <option value="" class="admin_campo" selected>- <?php echo utf8($campo_seleccione) ?> -</option>
				  <?php
			  }
			  if ($CamposAMostrar=="") $CamposAMostrar="Nombre";
			  if (strpos($CamposAMostrar,",") > 0) {
				  $primercampo=TextoAntesDe(",",$CamposAMostrar);
			  } else {
			 	  $primercampo=$CamposAMostrar;
			  }
			  $SQL="SELECT ID,".$CamposAMostrar." FROM ".$Prefijo.$TablaRelacionada." WHERE Publico='1' OR Publico='0' ORDER BY ".$CamposAMostrar." ASC ";
			  $ResultadoConsultaTabla=$mysqli->query($SQL);
			  while ($RegistroTabla=mysqli_fetch_array($ResultadoConsultaTabla)) {
		    	  $ValorATomar=$RegistroTabla['ID'];
				  $QueSeDebeMostrar=TextoDespuesDe("=",$Texto);
				  $TextoAMostrar="";
				  while (strpos($QueSeDebeMostrar,"+") > 0) {
					  $Campo=TextoAntesDe("+",$QueSeDebeMostrar);
					  $QueSeDebeMostrar=TextoDespuesDe("+",$QueSeDebeMostrar);
					  if (strpos($Campo,"(") > 0) {
						  $CampoFiltroID=TextoAntesDe("(",$Campo);					
						  $ValorFiltroID=$RegistroTabla[$CampoFiltroID];
						  $TablaAdic=TextoDespuesDe("(",$Campo);
						  $TablaAdic=TextoAntesDe("=",$TablaAdic);
						  $CampoAdic=TextoDespuesDe("=",$Campo);
						  $CampoAdic=TextoAntesDe(")",$CampoAdic);
						  $SQL="SELECT ".$CampoAdic." FROM ".$Prefijo.$TablaAdic." WHERE ID='$ValorFiltroID' ";
						  $ResultAdic=$mysqli->query($SQL);
						  $RegAdic=mysqli_fetch_array($ResultAdic);
					  	  $TextoAMostrar.=$RegAdic[$CampoAdic]." -> ";
					  } else {
						  $TextoAMostrar.=$RegistroTabla[$Campo]." / ";
					  }
				  }
				  $Campo=$QueSeDebeMostrar;
				  if (strpos($Campo,"(") > 0) {
					  $CampoFiltroID=TextoAntesDe("(",$Campo);
					  $ValorFiltroID=$RegistroTabla[$CampoFiltroID];
					  $TablaAdic=TextoDespuesDe("(",$Campo);
					  $TablaAdic=TextoAntesDe("=",$TablaAdic);
					  $CampoAdic=TextoDespuesDe("=",$Campo);
					  $CampoAdic=TextoAntesDe(")",$CampoAdic);
					  $SQL="SELECT ".$CampoAdic." FROM ".$Prefijo.$TablaAdic." WHERE ID='$ValorFiltroID' ";
					  $ResultAdic=$mysqli->query($SQL);
					  $RegAdic=mysqli_fetch_array($ResultAdic);
					  $TextoAMostrar.=$RegAdic[$CampoAdic];				
				  } else {
					  $TextoAMostrar.=$RegistroTabla[$Campo];
				  }
				  if (strlen($TextoAMostrar) > $LongitudMaximaDeCampoEnPantalla-10) {
					  $TextoAMostrar=substr($TextoAMostrar,0,$LongitudMaximaDeCampoEnPantalla-15)."...";
				  }
				  if ($ValorDefecto==$ValorATomar) {
					  ?>
	    		      <option value="<?php echo utf8($ValorATomar) ?>" class="admin_campo" selected><?php echo stripslashes($TextoAMostrar) ?></option>
					  <?php
				  } else {
					  ?>
			          <option value="<?php echo utf8($ValorATomar) ?>" class="admin_campo"><?php echo stripslashes($TextoAMostrar) ?></option>
					  <?php
				  }
			  }
			  ?>
        	  </select>
		 	  <?php
			  if ($ValorDefecto=="") {
				  ?>
				  &nbsp; <a href="AltaRegistro.php?tabla=<?php echo $TablaRelacionada ?>" class="admin_linkaccion"><img src="img/icono_agregar.gif" border="0"><?php echo utf8($lk_agregar) ?></a> &nbsp;
				  <?php
			  }
		  } else {
			  //tiene sentencia de sql asociada a la tabla
			  //debbug :: echo "tiene sentencia sql relacionada.<br>";
			  $SQL=$SQLrelacionada;
			  //debbug :: echo "sql: ".$SQL."<br>";
			  $ResultRel=$mysqli->query($SQL);
			  $err=mysql_error();
			  //debbug ::	echo "error: ".$err."<br>";
		  	  $Texto=$RegistroEstructura['Provienedetablarelacionada'];
			  if ($Texto=="") {
				  $ValorATomar="ID";
				  $TextoAMostrar="Nombre";
			  } else {
				  $ValorATomar=TextoAntesDe("=",$Texto);
				  $TextoAMostrar=TextoDespuesDe("=",$Texto);
			  }
			  ?>
		      <select name="<?php echo $NombreCampo ?>" class="admin_campo">
    	      <option value="" class="admin_campo" selected>- <?php echo utf8($campo_seleccione) ?> -</option>
			  <?php
			  while ($reg=mysqli_fetch_array($ResultRel)) {
				  ?>
		          <option value="<?php echo uft8($reg[$ValorATomar]) ?>" class="admin_campo"><?php echo stripslashes($reg[$TextoAMostrar]) ?></option>
				  <?php				
			  }
			  ?>
			  </select>
		      <?php
		  }
		  if ($Validaciones!="") {
			  ?> 
			  <span class="admin_obligatorio">(*)</span>
			  <?php
		  }
		  ?>
		  </td>
		</tr>
		<?php
		
    } elseif (($TipoDeEntrada=="TABLA") && ($nivelUs=="Cliente")) {
	?>
	 <input type="hidden" name="<?php echo $NombreCampo ?>" value="<?php echo $idUs ?>">
	<?php
    }elseif ($TipoDeEntrada=="IMAGEN") {
			if($CualTabla!="Escort")
			{
		?>	
  		<tr> 
  		  <td width="25%" valign="top" class="celdatitulo" align="right">
		  <?php echo utf8($TituloCampo) ?>
		  </td>
		  <td width="75%" class="celdainput">
		  <input name="<?php echo $NombreCampo ?>" class="admin_campo" type="file" size="<?php echo $Long ?>" maxlength="250">
    	  <br>
		  <span class="admin_notas">
		  <?php echo utf8($ley_jpg) ?><br>
		  <?php echo utf8($ley_ajusteimagen) ?>
		  <?php echo $RegistroEstructura['Imagenanchofoto'] ?> x 
		  <?php echo $RegistroEstructura['Imagenaltofoto'] ?> pixeles. 
		  <?php echo utf8($ley_proporcion) ?>
		  </span>
    	  <?php
		  if ($Validaciones!="") {
			  ?>
			  <span class="admin_obligatorio">(*)</span>
			  <?php
		  }
		  ?>
		  </td>
  		</tr>
  		<?php
		}
    } elseif ($TipoDeEntrada=="HTML") {	    
?> 
  <tr>
    <td class="celdatitulo" colspan="2"><div align="left"><?php echo utf8($TituloCampo) ?></div></td>
  </tr>
  <tr>
    <td class="celdainput" colspan="2">
    <textarea name="<?php echo $NombreCampo ?>" 
		class="admin_campo"
		cols="<?php echo $Long ?>" 
		rows="<?php echo $Alto ?>" 
		wrap="OFF"><?php echo $ValorInicial ?></textarea>
    <?php
	if ($Validaciones!="") {
		?> 
		<span class="admin_obligatorio">(*)</span>
		<?php
	}
	?>
    </td>
  </tr>
<?php // TipoDeEntrada=7 CHECKBOX
	} elseif ($TipoDeEntrada=="CHECK") {
?> 
  <tr>
    <td width="25%" class="celdatitulo">
	<?php echo utf8($TituloCampo) ?>
	</td>
    <td width="75%" class="celdainput">
	<?php
	$valorchk=$RegistroEstructura['Valores'];
	if ($valorchk==$ValorInicial) {
		$chk="checked";
	} else {
		$chk="";
	}
	?>
    <input type="checkbox" name="<?php echo $NombreCampo ?>" value="<?php echo $valorchk ?>" <?php echo $chk ?> >
    <?php echo utf8($Leyenda) ?>
    <?php
	if ($Validaciones!="") {
		?> 
		<span class="admin_obligatorio">(*)</span>
		<?php
	}
	?>
    </td>
  </tr>
		<?php 


	} elseif (($TipoDeEntrada=="ARCHIVO") && ($CualTabla!="Escort")) {
		?> 
		<tr>
		  <td width="25%" class="celdatitulo">
		  <?php echo utf8($TituloCampo) ?>
		  </td>
		  <td width="75%" class="celdainput">
		  <input type="file" class="admin_campo" name="<?php echo $NombreCampo ?>" value="<?php echo $ValorInicial ?>" size="<?php echo $Long ?>">
		  <?php
		  if ($Validaciones!="") {
			  ?>
			  <span class="admin_obligatorio">(*)</span>
			  <?php
		  }
		  if (utf8($Leyenda)) {
	     	  echo "<br>";
			  echo "<span class=\"admin_notas\">".utf8($Leyenda)."</span>"; 
		  }
		  ?>
		  </td>
		</tr>
		<?php	  
	} elseif ($TipoDeEntrada=="FECHA") { 
?>
  <tr>
    <td width="25%" class="celdatitulo">
	<?php echo utf8($TituloCampo) ?>
	</td>
    <td width="75%" class="celdainput">	    
	<?php
	if ($adminstyle=="es") {
	?>
    <select name="<?php echo $NombreCampo ?>_dia" class="admin_campo">
	<option value="" class="admin_campo" selected>---</option>
	<?php
	$dia=0;
	while ($dia < 31) {
		$dia++;
		if ($dia < 10) {
			?>
			<option value="0<?php echo $dia ?>" class="admin_campo"> <?php echo $dia ?></option>
			<?php
		} else {
			?>
			<option value="<?php echo $dia ?>" class="admin_campo"><?php echo $dia ?></option>
			<?php
		}
	}
	?>
	</select>
	/
    <select name="<?php echo $NombreCampo ?>_mes" class="admin_campo">
	<option value="" class="admin_campo" selected>----</option>
	<?php
	$mes=0;
	while ($mes < 12) {
		$mes++;
		if ($mes < 10) {
			?>
			<option value="0<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>
			<?php
		} else {
			?>
			<option value="<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>
			<?php
		}
	}
	?>
	</select>
	<?php
	} else {
	?>
    <select name="<?php echo $NombreCampo ?>_mes" class="admin_campo">
	<option value="" class="admin_campo" selected>----</option>
	<?php
	$mes=0;
	while ($mes < 12) {
		$mes++;
		if ($mes < 10) {
			?>
			<option value="0<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>
			<?php
		} else {
			?>
			<option value="<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>
			<?php
		}
	}
	?>
	</select>
	/
    <select name="<?php echo $NombreCampo ?>_dia" class="admin_campo">
	<option value="" class="admin_campo" selected>---</option>
	<?php
	$dia=0;
	while ($dia < 31) {
		$dia++;
		if ($dia < 10) {
			?>
			<option value="0<?php echo $dia ?>" class="admin_campo"> <?php echo $dia ?></option>
			<?php
		} else {
			?>
			<option value="<?php echo $dia ?>" class="admin_campo"><?php echo $dia ?></option>
			<?php
		}
	}
	?>
	</select>
	<?php
	}
	?>
	/
    <select name="<?php echo $NombreCampo ?>_anio" class="admin_campo">
	<option value="" class="admin_campo" selected>-----</option>
	<?php
	$anio=0;
	$ListaDeValidaciones=$RegistroEstructura['Validaciones'];
	$Desde=1950;
	$Hasta=2050;
	$Actual=date(Y);
	if (strpos($ListaDeValidaciones,']') > 0) {
		$posabertura=strpos($ListaDeValidaciones,'[');
		$poscierre=strpos($ListaDeValidaciones,']');
		$long=$poscierre-$posabertura-1;
		$Rango=substr($ListaDeValidaciones,$posabertura+1,$long);
		$poscoma=strpos($Rango,',');
		if ($poscoma > 0) {
			$Desde=substr($Rango,0,$poscoma);
			$Hasta=substr($Rango,$poscoma+1);
		}
	}
	$anio=$Desde-1;
	while ($anio < $Hasta) {
		$anio++;
		?>
		<option value="<?php echo $anio?>" class="admin_campo"><?php echo $anio ?></option>
		<?php
	}
	?>	
	</select>
	<?php
	if ($Validaciones!="") {
		?> 
		<span class="admin_obligatorio">(*)</span>
		<?php
	}
	?>
	<?php
	//debbug ::	echo "<br>Rango: ".$Rango." (".$Desde."/".$Hasta.")<br>";
	if (utf8($Leyenda)) {
	     echo "<br>";
         echo "<span class=\"admin_notas\">".utf8($Leyenda)."</span>"; 
	}
	?>
	</td>
  </tr>
<?php
	} elseif ($TipoDeEntrada=="CALENDARIO") { 
?>
  <tr>
    <td width="25%" class="celdatitulo">
	<?php echo utf8($TituloCampo) ?>
	</td>
    <td width="75%" class="celdainput">
    <?php $fechaHoy=date("Y-m-d"); 
	?>
    <input type="text" class="admin_campo" readonly="readonly" name="<?php echo $NombreCampo?>" size="12" value="<?php echo $fechaHoy;?>">	
	<?php
	echo '<script language="javascript">';
	echo 'var Calendario_'.$NombreCampo.' = new calendar("FIELD:document.FormAgregar.'.$NombreCampo.';FORMAT:3;DELIMITER:-;");';
	echo 'Calendario_'.$NombreCampo.'.writeCalendar();';
	echo '</script>';
	if ($Validaciones!="") {
		?> 
		<span class="admin_obligatorio">(*)</span>
		<?php
	}
	if (utf8($Leyenda)) {
	     echo "<br>";
         echo "<span class=\"admin_notas\">".utf8($Leyenda)."</span>"; 
	}
	?>
	</td>
  </tr>
<?php
	} elseif ($TipoDeEntrada=="ANIDADO") {
?>
  <tr>
    <td width="25%" class="celdatitulo">
	<?php echo utf8($TituloCampo) ?>
	</td>
    <td width="75%" class="celdainput">
	  <table border="0" cellpadding="2" cellspacing="0">
	    <?php
		$Texto=$RegistroEstructura['Provienedetablarelacionada'];
		$TablaRelacionada=TextoAntesDe("=",$Texto);
		$QueSeDebeMostrar=TextoDespuesDe("=",$Texto);
		$CamposAMostrar="";
		while (strpos($QueSeDebeMostrar,"+") > 0) {
			$Campo=TextoAntesDe("+",$QueSeDebeMostrar);
			$QueSeDebeMostrar=TextoDespuesDe("+",$QueSeDebeMostrar);
			if (strpos($Campo,"(") > 0) {
				$Campo=TextoAntesDe("(",$Campo);
			}
			$CamposAMostrar.=$Campo.",";
		}
		$Campo=$QueSeDebeMostrar;
		if (strpos($Campo,"(") > 0) {
			$Campo=TextoAntesDe("(",$Campo);
		}
		$CamposAMostrar.=$Campo;
		$QueSeDebeMostrar=TextoDespuesDe("=",$Texto);
		if ($CamposAMostrar=="") $CamposAMostrar="Nombre";
		if (strpos($CamposAMostrar,",") > 0) {
			$primercampo=TextoAntesDe(",",$CamposAMostrar);
		} else {
			$primercampo=$CamposAMostrar;
		}
		$SQL="SELECT ID,".$CamposAMostrar." FROM ".$Prefijo.$TablaRelacionada." WHERE Publico='1' OR Publico='0' ORDER BY ".$primercampo." ASC ";
		$ResultadoConsultaTabla=$mysqli->query($SQL);
		$kk=0;
		while ($RegistroTabla=mysqli_fetch_array($ResultadoConsultaTabla)) {
	    	$ValorATomar=$RegistroTabla['ID'];
			$QueSeDebeMostrar=TextoDespuesDe("=",$Texto);
			$TextoAMostrar="";
			while (strpos($QueSeDebeMostrar,"+") > 0) {
				$Campo=TextoAntesDe("+",$QueSeDebeMostrar);
				$QueSeDebeMostrar=TextoDespuesDe("+",$QueSeDebeMostrar);
				if (strpos($Campo,"(") > 0) {
					$CampoFiltroID=TextoAntesDe("(",$Campo);					
					$ValorFiltroID=$RegistroTabla[$CampoFiltroID];
					$TablaAdic=TextoDespuesDe("(",$Campo);
					$TablaAdic=TextoAntesDe("=",$TablaAdic);
					$CampoAdic=TextoDespuesDe("=",$Campo);
					$CampoAdic=TextoAntesDe(")",$CampoAdic);
					$SQL="SELECT ".$CampoAdic." FROM ".$Prefijo.$TablaAdic." WHERE ID='$ValorFiltroID' ";
					$ResultAdic=$mysqli->query($SQL);
					$RegAdic=mysqli_fetch_array($ResultAdic);
					$TextoAMostrar.=$RegAdic[$CampoAdic]." -> ";
				} else {
					$TextoAMostrar.=$RegistroTabla[$Campo]." / ";
				}
			}
			$Campo=$QueSeDebeMostrar;
			if (strpos($Campo,"(") > 0) {
				$CampoFiltroID=TextoAntesDe("(",$Campo);
				$ValorFiltroID=$RegistroTabla[$CampoFiltroID];
				$TablaAdic=TextoDespuesDe("(",$Campo);
				$TablaAdic=TextoAntesDe("=",$TablaAdic);
				$CampoAdic=TextoDespuesDe("=",$Campo);
				$CampoAdic=TextoAntesDe(")",$CampoAdic);
				$SQL="SELECT ".$CampoAdic." FROM ".$Prefijo.$TablaAdic." WHERE ID='$ValorFiltroID' ";
				$ResultAdic=$mysqli->query($SQL);
				$RegAdic=mysqli_fetch_array($ResultAdic);
				$TextoAMostrar.=$RegAdic[$CampoAdic];				
			} else {
				$TextoAMostrar.=$RegistroTabla[$Campo];
			}
			$kk++;
			?>
			<tr>
			<?php			
			if ($ValorDefecto==$ValorATomar) {
				?>
			    <td align="center">
			    <input type="checkbox" name="<?php echo $NombreCampo ?>_<?php echo $kk ?>" value="<?php echo $ValorATomar ?>" checked>
				</td>
				<?php
			} else {
				?>
			    <td align="center">
			    <input type="checkbox" name="<?php echo $NombreCampo ?>_<?php echo $kk ?>" value="<?php echo $ValorATomar ?>">
				</td>
				<?php
			}
			?>
			<td>
			<span class="admin_txt_anidado"><?php echo stripslashes($TextoAMostrar) ?></span>
			</td>
		  </tr>
	  	  <?php
		}		
		?>
	  </table>
	  <input type="hidden" name="<?php echo $NombreCampo?>_cantitems" value="<?php echo $kk ?>">
	<?php
	if (utf8($Leyenda)) {
         echo "<span class=\"admin_notas\">".utf8($Leyenda)."</span>"; 
	}
	?>
	</td>
  </tr>
		<?php
		
		
	} elseif ($TipoDeEntrada=="TRADUCCION") {
		//este es un campo especial que se vincula con la tabla "Traduccion" e "Idioma"
		?>
		  <tr>
    		<td width="25%" class="celdatitulo">
			<?php echo utf8($TituloCampo) ?>
			</td>
		    <td width="75%" class="celdainput">
			  <table width="100%" border="0" cellpadding="2" cellspacing="0">
			    <tr>
				  <td width="20%" class="celdatitulo"><?php echo utf8($clave) ?>:&nbsp;</td>
				  <td width="80%" class="celdainput">
				  <?php
				  $long_clave=$RegistroEstructura['Ancho'];
				  $ancho_text=$RegistroEstructura['Anchomuestra'];
				  ?>
				  <input name="<?php echo $NombreCampo ?>" 
				  		type="text"
						class="admin_campo"
						value="<?php echo $ValorInicial ?>" 
						size="<?php echo $long_clave ?>" 
						maxlength="<?php echo $LongMax ?>">
				  </td>
				</tr>
			    <?php
				$tablaI=$Prefijo."Idioma";
				$SQL="SELECT * FROM $tablaI WHERE (Publico='1') ORDER BY Nrodeorden ASC";
				$ResultI=$mysqli->query($SQL);
				while ($RegI=mysqli_fetch_array($ResultI)) {
					$idioma=stripslashes($RegI['Nombre']);
					$id_idioma=$RegI['ID'];
					?>
				    <tr>
					  <td width="20%" class="celdatitulo"><?php echo $idioma ?>:&nbsp;</td>
					  <td width="80%" class="celdainput">
				      <textarea name="<?php echo $NombreCampo."_traduccion_".$id_idioma ?>" 
					  	 	class="admin_campo"
							cols="<?php echo $ancho_text ?>" 
							rows="<?php echo $Alto ?>" 
							wrap="OFF"></textarea>
					  </td>
					</tr>
					<?php
				}
				?>
	    	  </table>
			</td>
		  </tr>
		<?php
	}
    $jj++;
} //end del while

  if ($nivelUs!="Cliente") {
	?>
  <tr> 
    <td class="celdatitulo"><?php echo utf8($campo_publico) ?></td>
    <td class="celdainput">
    <?php
		if($CualTabla!="Escort"){ 
    		echo '<label><input type="radio" name="itempublico" value="1" checked>&nbsp;'.utf8($campo_si).'</label>&nbsp;&nbsp;
    		<label><input type="radio" name="itempublico" value="0">&nbsp;'.utf8($campo_no).'</label>';
			}
		else
			{ 
    		echo '<label><input type="radio" name="itempublico" value="1" checked>&nbsp;'.utf8($campo_si).'</label>&nbsp;&nbsp;
    		<label><input type="radio" name="itempublico" value="0">&nbsp;'.utf8($campo_no).'</label>&nbsp;&nbsp;
			<label><input type="radio" name="itempublico" value="3">&nbsp;Pendiente</label>';
			}
	?>	
	</td>
  </tr>
  <?php
  }
  else
  { ?>
	<input type="hidden" name="itempublico" value="3" >
  <?php 
  }

  if ($HayValidaciones==true) {
	  ?>
	  <tr>
    	<td class="celdatitulo">&nbsp;</td>
	    <td class="celdainput">&nbsp;<span class="admin_obligatorio">(*) <?php echo utf8($tit_datosobligatorios) ?></span>
		</td>
	  </tr>
	  <?php
  }
  
	if (($CualTabla=="Banner")) {
		?>
		  <tr>
    		<td width="25%" class="celdatitulo">
			Provincias - ciudades
			</td>
		    <td width="75%" class="celdainput">
			    <?php
				$SQLprov="SELECT * FROM reino01_Provincia WHERE Publico=1 ORDER BY Nombre";
				$Resultprov=$mysqli->query($SQLprov) or die (mysql_error());
				while ($arryProv=mysqli_fetch_array($Resultprov)) {
					  $idProvincia=$arryProv['ID'];
					  echo "<label><input type='checkbox' name='prov$idProvincia' value='1' />".$arryProv['Nombre']."</label>";
					  
					if($CualTabla!="Banner")
					{
					  echo "<span id='btnCiudad$idProvincia'><a href='javascript:verCiudadesDesplegable($idProvincia)'><img src='img/mostrar.png' title='Mostrar provincias' alt='Mostrar provincias'></a></span><br>";
							$SQLciu="SELECT * FROM reino01_Ciudad WHERE Publico=1 AND ProvinciaID='$idProvincia' ORDER BY Nombre";
							$Resultciu=$mysqli->query($SQLciu) or die (mysql_error());

								echo "<div id='ciudadPorProv$idProvincia' style='display:none'>";
								while ($arryCiu=mysqli_fetch_array($Resultciu)) {
									$idCiudad=$arryCiu['ID'];
									echo " &mdash;&mdash; <label><input type='checkbox' name='ciu$idCiudad' value='1' />".$arryCiu['Nombre']."</label><br>";
								}
					}
					else
					{
						echo "<br>";
					}
							echo "</div>";
				}
				?>
			</td>
		  </tr>
		<?php
	}
  ?>
  <tr>
    <td class="celdabotones" colspan="2">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
	      <td width="50%" valign="top" align="left">
          <a href="listarTabla.php?tabla=<?php echo $CualTabla?>" class="admin_botones" > &lt;&lt; <?php echo utf8($bt_volver) ?></a>
		  </td>
	      <td width="50%" valign="top" align="right">
		  <input type="hidden" name="filtro" value="<?php echo $filtro ?>">
		  <input type="hidden" name="titulo" value="<?php echo $titulo ?>">
		  <input type="hidden" name="front" value="<?php echo $TomoFront ?>">
		  <input name="agregar" class="admin_botones" type="submit" value="<?php echo utf8($bt_agregar) ?> >>"> 
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
</table>







<?php
if($CualTabla=="Escort"){ 
$NombreTablaImg=$Prefijo."foto_escort";
$sqlImg="select * from $NombreTablaImg where IdEscort='$Item'";
$queryImg=$mysqli->query($sqlImg);

$NombreTablaVideos=$Prefijo."video_escort";
$sqlVideo="select * from $NombreTablaVideos where IdEscort='$Item'";
$queryVideo=$mysqli->query($sqlVideo);
?>
<table border="0" cellspacing="0" id="mostrarFotos" class="admin_form_derecha" width="300px" style="background: #F2F3F7;">
  <tr> 
    <td class="listado_titulogeneral">
      <?php echo "DETALLES"; ?>
      <?php echo $CualTabla ?>
    </td>
  </tr>

  <tr>
  	<td>
    	<font style='color:#7E0202; text-decoration:underline;'><center>Formas de Pago</center></font>
    	<?php 
		$tablaFP=$Prefijo."escort_formas_pagos";
		$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
		
		echo "<ul class='listaDetalles'>";
		while($arryFP = mysqli_fetch_array($sqlFP))
		{
			echo "<li><label><input type='checkbox' name='FP_".$arryFP["ID"]."' value='1' >".$arryFP["Nombre"]."</label></li>";
		}
		echo "</ul>";
		?>
    </td>
  </tr>
  
  <tr>
  	<td>
    	<font style='color:#7E0202; text-decoration:underline;'><center>Lugares de atenci&oacute;n</center></font>
    	<?php 
		$tablaLA=$Prefijo."escort_lugares_atencion";
		$sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");
		
		echo "<ul class='listaDetalles'>";
		while($arryLA = mysqli_fetch_array($sqlLA))
		{
			echo "<li><label><input type='checkbox' name='LA_".$arryLA["ID"]."' value='1' >".$arryLA["Nombre"]."</label></li>";
		}
		echo "</ul>";
		?>
    </td>
  </tr>
  
  <tr>
  	<td>
    	<font style='color:#7E0202; text-decoration:underline;'><center>Servicios</center></font>
    	<?php 
		$tablaS=$Prefijo."escort_servicios";
		$sqlS = $mysqli->query("select * from $tablaS where Publico='1'");
		
		echo "<ul class='listaDetalles'>";
		while($arryS = mysqli_fetch_array($sqlS))
		{
			echo "<li><label><input type='checkbox' name='S_".$arryS["ID"]."' value='1' >".$arryS["Nombre"]."</label></li>";
		}
		echo "</ul>";
		?>
    </td>
  </tr>
    
</table>
<?php } ?>





  </form>
</body>
</html>

