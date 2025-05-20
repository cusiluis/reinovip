<?php

include("../includes/globales.inc.php");

include("../includes/conexion.inc.php");

include("../includes/libreria.inc.php");

include("admin.traducciones.php");


session_start();
$nombreusuario=$_SESSION['usuariolog'];

// valido el usuario en la tabla de logueos

	$tablaL=$Prefijo."logueo";

	$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";

	$ResultL=$mysqli->query($SQL);

	$cantreg=mysqli_num_rows($ResultL);

	if ($cantreg < 1) 

	{//$nombreusuario="";

	}

	else

	{$arryLog=mysqli_fetch_array($ResultL);

	$idUs=$arryLog['ID'];

	$nivelUs=$arryLog['Nivel'];

	}

//

if ($nombreusuario=="") {

	header("Location: admin.php?mensaje=".$error_accesoindebido.".");

	exit;

}



$CualTabla=$_GET["tabla"];

if (($CualTabla=="") or ($Prefijo=="")) {

    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": ModRegistro.");

    exit;

}

$Item=$_GET["id"];

if ($Item=="") {

	header("Location: listarTabla.php?tabla=$CualTabla&mensaje=".$error_accesoindebido.". ".$tit_modulo.": ModRegistro.");

	exit;

}



$volver=$_GET['backto'];



$TomoFront=$_GET["front"];

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



<link href="calendar/calendar.css" rel="stylesheet" type="text/css">

<script src="<? //echo $URLSitio?>Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

<script language="javascript" src="calendar/calendar.js"></script>

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



function fotos(id) {

 var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", 'fotos.php', true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

			document.getElementById('mostrarFotos').innerHTML = " Aguarde por favor...";

			     }

		if (ajax.readyState == 4) {

                //document.getElementById('mostrarFotos').innerHTML=ajax.responseText;

		     }} 

	ajax.send('id='+id);

}



function videos(id) {

 var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", 'mostVideos.php', true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

			document.getElementById('mostrarVideos').innerHTML = " Aguarde por favor...";

			     }

		if (ajax.readyState == 4) {

                document.getElementById('mostrarVideos').innerHTML=ajax.responseText;

		     }} 

	ajax.send('id='+id);

} 



function principalFotos(id,idEscort) {

if(confirm("Esta seguro que desea convertir la imagen seleccionada como principal???"))

{

	 var ajax;

		ajax = ajaxFunction();

		ajax.open("POST",'principalFotos.php', true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		

		ajax.onreadystatechange = function() {

			if (ajax.readyState==1){

				document.getElementById('mostrarFotos').innerHTML = " Aguarde por favor...";

					 }

			if (ajax.readyState == 4) {

					//document.getElementById('mostrarFotos').innerHTML=ajax.responseText;

				 }} 

		ajax.send('id='+id+'&idEscort='+idEscort);

	}

	fotos(idEscort);

}



function principalVideos(id,idEscort) {

if(confirm("Esta seguro que desea convertir el video seleccionado como principal???"))

{

	 var ajax;

		ajax = ajaxFunction();

		ajax.open("POST",'principalVideos.php', true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		

		ajax.onreadystatechange = function() {

			if (ajax.readyState==1){

				document.getElementById('mostrarVideos').innerHTML = " Aguarde por favor...";

					 }

			if (ajax.readyState == 4) {

					//document.getElementById('mostrarFotos').innerHTML=ajax.responseText;

				 }} 

		ajax.send('id='+id+'&idEscort='+idEscort);

	}

	videos(idEscort);

} 



function eliminarFotos(id,idEscort) {

if(confirm("Esta seguro que desea eliminar la imagen seleccionada???"))

{

	 var ajax;

		ajax = ajaxFunction();

		ajax.open("POST", 'eliminarFotos.php', true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		

		ajax.onreadystatechange = function() {

			if (ajax.readyState==1){

				document.getElementById('mostrarFotos').innerHTML = " Aguarde por favor...";

					 }

			if (ajax.readyState == 4) {

					if(ajax.responseText == "")

					{
						//fotos(idEscort);
						location.reload();
					}

					else

					{//alert(ajax.responseText);
						location.reload();
					}

				 }} 

		ajax.send('id='+id+'&idEscort='+idEscort);

	}

}



function imgBanner(id) {

 var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", 'imgBanner.php', true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

			document.getElementById('mostrarImgBanner').innerHTML = " Aguarde por favor...";

			     }

		if (ajax.readyState == 4) {

                document.getElementById('mostrarImgBanner').innerHTML=ajax.responseText;

		     }} 

	ajax.send('id='+id);

}



function eliminarFotosBanner(id) {

if(confirm("Esta seguro que desea eliminar la imagen seleccionada???"))

{

	 var ajax;

		ajax = ajaxFunction();

		ajax.open("POST", 'eliminarImgBanner.php', true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		

		ajax.onreadystatechange = function() {

			if (ajax.readyState==1){

				document.getElementById('mostrarFotos').innerHTML = " Aguarde por favor...";
				
					 }

			if (ajax.readyState == 4) {

					if(ajax.responseText == "")

					{imgBanner(id);location.reload(); }
}

					else

					{alert(ajax.responseText); 
				 }} 

		ajax.send('id='+id);
		

	}

}



function eliminarVideos(id,idEscort) {

if(confirm("Esta seguro que desea eliminar el video seleccionado???"))

{

	 var ajax;

		ajax = ajaxFunction();

		ajax.open("POST", 'eliminarVideos.php', true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		

		ajax.onreadystatechange = function() {

			if (ajax.readyState==1){

				document.getElementById('mostrarVideos').innerHTML = " Aguarde por favor...";

					 }

			if (ajax.readyState == 4) {

					if(ajax.responseText == "")

					{videos(idEscort);}

					else

					{alert(ajax.responseText);}

				 }} 

		ajax.send('id='+id+'&idEscort='+idEscort);

	}

} 

</script>

<script type="text/javascript">

	function guardarArchivo()

	{

		document.getElementById("frmArchivo").submit();

	}



	function startUpload(){

		  document.getElementById('f1_upload_process').style.visibility = 'visible';

		  document.getElementById('f1_upload_form').style.visibility = 'hidden';

		  return true;

	}

	

	function startSubirVideos(){

		  document.getElementById('f1_video_process').style.visibility = 'visible';

		  document.getElementById('f1_video_form').style.visibility = 'hidden';

		  return true;

	}

	

	function startUploadBann(){

		
		  document.getElementById('f1_upload_process_bann').style.visibility = 'visible';

		  document.getElementById('f1_upload_form_bann').style.visibility = 'hidden';

		  return true;

	}

		

	function stopUpload(success,id){

		  var result = '';

		  if (success == 1){

			 //alert ('Archivo subido satisfactoriamente');

			 fotos(id);

		  }

		  else {

			 alert ('El archivo no se ha podido subir!');

		  }

		  document.getElementById('f1_upload_process').style.visibility = 'hidden';

		  //document.getElementById('f1_upload_form').style.visibility = 'visible';

		  return true;   

	}

	

	function stopSubirVideo(success,id){

		  var result = '';

		  if (success == 1){

			 //alert ('Archivo subido satisfactoriamente');

			 videos(id);

		  }

		  else {

			 alert ('El archivo no se ha podido subir!');

		  }

		  document.getElementById('f1_video_process').style.visibility = 'hidden';

		  document.getElementById('f1_video_form').style.visibility = 'visible';

		  return true;   

	}

	

	function stopUploadBann(success,id){

		  var result = '';

		  if (success == 1){

			 //alert ('Archivo subido satisfactoriamente');

			 imgBanner(id);

		  }

		  else {

			 alert ('El archivo no se ha podido subir!');

		  }

		  document.getElementById('f1_upload_process_bann').style.visibility = 'hidden';

		  //document.getElementById('f1_upload_form_bann').style.visibility = 'visible';

		  return true;   

	}

</script>



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

				 

		ajax.send('idProv='+idProvincia+'&idCiudad='+idCiudad);

	} 

	

</script>

<?php

//armo el script de validacion

echo "<script language=\"JavaScript\">\n";

echo "function validar() {\n";

echo "var regex=new RegExp(\"^[^@ ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|tv|cc|gov|mil|org|edu|int|biz|info|name|pro)$\");\n";

echo "    regnum=new RegExp(\"0-9\.\,\");\n";



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

		$HayValidaciones=true;



		if ($Validacion=="novacio") {

			

			echo "    if (document.FormModificar.".$NombreCampo.".value=='') {\n";

			echo "        alert('".utf8($tit_error).": ".utf8($TituloCampo)." ".utf8($error_vacio)."');\n";

			echo "        document.FormModificar.".$NombreCampo.".focus();\n";

			echo "        return false;\n";

			echo "    }\n";		

		}

		if ($Validacion=="esmail") {

			echo "    if (regex.test(document.FormModificar.".$NombreCampo.".value)==false) {\n";

			echo "        alert('".utf8($tit_error).": ".utf8($TituloCampo)." ".utf8($error_mailinvalido)."');\n";

			echo "        document.FormModificar.".$NombreCampo.".focus();\n";

			echo "        return false;\n";

			echo "    }\n";

		}

		if ($Validacion=="esnumero") {

			echo "    if (regnum.test(document.FormModificar.".$NombreCampo.".value)==false) {\n";

			echo "        alert('".utf8($tit_error).": ".utf8($TituloCampo)." ".utf8($error_numero)."');\n";

			echo "        document.FormModificar.".$NombreCampo.".focus();\n";

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

echo "    document.FormModificar.submit();\n";

echo "}\n";

echo "</script>\n";

?>

<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />

<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../js/dropzone.js" type="text/javascript"></script>
</head>



<body>

<?php

$NombreTabla=$Prefijo.$CualTabla;

$SQL="SELECT * FROM $NombreTabla WHERE ID='$Item'";

$ResultadoConsulta=$mysqli->query($SQL);

$Registro=mysqli_fetch_array($ResultadoConsulta);

?>

<?php include("topadmin.inc.php"); ?>

  <form enctype="multipart/form-data"

	      action="scriptModRegistro.php?tabla=<?php echo $CualTabla ?>&id=<?php echo $Item ?>&backto=<?php echo $volver ?>" 

		  onSubmit="validar();return false;"

	      method="post" 

		  name="FormModificar">

<?php

if($CualTabla=="Escort"){ 

$NombreTablaImg=$Prefijo."foto_escort";

$sqlImg="select * from $NombreTablaImg where IdEscort='$Item'";

$queryImg=$mysqli->query($sqlImg) or die (mysql_error());



$NombreTablaVideos=$Prefijo."video_escort";

$sqlVideo="select * from $NombreTablaVideos where IdEscort='$Item'";

$queryVideo=$mysqli->query($sqlVideo);

 }

?>

<table border="0" cellpadding="3" class="admin_form_derecha" cellspacing="0">

  <tr>

    <td class="listado_titulogeneral" colspan="2"><a href="listarTabla.php?tabla=<?php echo $CualTabla?>" class="admin_botones" > &lt;&lt; <?php echo utf8($bt_volver) ?></a>

	<?php echo $Item ?> :: <?php echo utf8($tit_modificando) ?> <?php echo $CualTabla ?>

	</td>

  </tr>

  <?php 

  	if($CualTabla=="Escort")

	{

  ?>

  <tr>

  	<td width="25%" class="celdatitulo">Fecha Registro

    </td>

    <td width="75%" class="celdainput">

    <?php

	echo $Registro["fecha_registro"];

	?>

    </td>

  </tr>

  <?php } ?>	

<?php

$tablaE=$Prefijo."estructura";

if ($TomoFront=="si") {

	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenfront='0' ORDER BY Nrodeordenfront ASC";

} else {

	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenback='0' ORDER BY Nrodeordenback ASC";

}
//echo $SQL;exit;
$ResultadoEstructura=$mysqli->query($SQL);

$jj=1;

while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {

    $Validaciones="";

    $TipoDeEntrada=strtoupper($RegistroEstructura['Tipodeentrada']);	

	$TituloCampo=$RegistroEstructura['Titulocampo'];

	$NombreCampoOriginal=$RegistroEstructura['Nombrecampo'];

	$NombreOriginal=$NombreCampoOriginal;

	$Valor=$Registro[$NombreCampoOriginal];

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

	$Leyenda=$RegistroEstructura['Leyendadetrasdeinput'];

	$Directorio=$RegistroEstructura['Directorio'];

	$PrefijoFoto=$RegistroEstructura['Prefijoimagen'];

	$Validaciones=$RegistroEstructura['Validaciones'];

	//-------------------------------------------------------------------

	// TipoDeEntrada=INPUT

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

				  <?php

				  if ($Valor=="") {

					  ?>

					  <option value="" class="admin_campo" selected>- <?php echo utf8($campo_seleccione) ?> -</option>

					  <?php

				  } else {

					  ?>

			          <option value="" class="admin_campo">- <?php echo utf8($campo_quitarseleccion) ?> -</option>

					  <?php

				  }

				  $tablaE=$Prefijo."estructura";

				  $SQL="SELECT * FROM $tablaE WHERE Nombretabla='Usuario' ORDER BY Nombrecampo ASC";

				  $ResultE=$mysqli->query($SQL);

				  while ($RegE=mysqli_fetch_array($ResultE)) {

					  if ($RegE['Nombrecampo']==$Valor) {

						  ?>

		        		  <option value="<?php echo $RegE['Nombrecampo'] ?>" class="admin_campo" selected><?php echo utf8($RegE['Titulocampo']) ?></option>

						  <?php

					  } else {

					  	  ?>

		        	  	  <option value="<?php echo $RegE['Nombrecampo'] ?>" class="admin_campo"><?php echo utf8($RegE['Titulocampo']) ?></option>

						  <?php

					  }

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

			  if($NombreCampoOriginal=="diasPublicacion")

			  {

			  $diasPasadosPublicacion=diferenciaFechas($Registro["fechaPublicacion"], date("Y-m-d"));

			  $Valor=$Valor-$diasPasadosPublicacion;

			  	if($Valor<0)

			  		$Valor=0;

			  }



			  ?>

			  <input name="<?php echo $NombreCampo ?>" 

				class="admin_campo"

				type="text" 

				value="<?php echo stripslashes($Valor) ?>" 

				size="<?php echo $Long ?>" 

				maxlength="<?php echo $LongMax ?>">

		      <?php 

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

				wrap="OFF"><?php echo stripslashes($Valor) ?></textarea>

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

			?> 

    	    <input type="radio" name="<?php echo $NombreCampo ?>" value="<?php echo $ii ?>"

			<?php

			if ($Valor==$ii) {

				?>

				checked>

				<?php

			} else {

				?>		

				>

				<?php

			}

			?>

	        <?php 

			$muestro_radio=PrimerValorSubcadena();

			echo utf8($muestro_radio) ?>&nbsp;&nbsp;

			<?php

     		$ii++;

		} // fin del while

		?>		

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

			$provinciaSeleccionado=$Valor;

		  }

		  if($NombreOriginal=="CiudadID")

		  {

		  	$IDGenCampo=" id='CiudadID' ";

		  }

		  ?>

	      <select name="<?php echo $NombreCampo ?>" class="admin_campo" <?php echo $IDGenCampo;?> <?php echo ($NombreOriginal=="ProvinciaID" ? "onChange='verCiudades(this.value,0)'" : "");?> >

		  <?php

		  if (($Valor=="") or ($Valor=="0")) {

			  ?>

    	      <option value="" class="admin_campo" selected>- <?php echo utf8($campo_sinseleccion) ?> -</option>

			  <?php

		  } else {

			  ?>

    	      <option value="" class="admin_campo">- <?php echo utf8($campo_quitarseleccion) ?> -</option>

			  <?php

	  	  }

		  while ($CadenaACortar != "") {

		      $Texto=PrimerValorSubcadena(); 

			  $ValorATomar=TextoAntesDe("=",$Texto);

			  $TextoAMostrar=TextoDespuesDe("=",$Texto);

			  if ($ValorATomar==$Valor) {

				  ?>

        		  <option value="<?php echo $ValorATomar ?>" class="admin_campo" selected><?php echo utf8($TextoAMostrar) ?></option>

				  <?php

		      } else {

				  ?>  

		          <option value="<?php echo $ValorATomar ?>" class="admin_campo"><?php echo utf8($TextoAMostrar) ?></option>

				  <?php

			  }

		  }  

		  ?>

          </select>

          

          <?php if($NombreOriginal=="ProvinciaID") { ?>

          <script type="text/javascript">verProvincias(<?php echo $paisSeleccionado;?>,<?php echo $Valor;?>)</script>

          <?php } ?>

          

          <?php if($NombreOriginal=="CiudadID") { ?>

          <script type="text/javascript">verCiudades(<?php echo $provinciaSeleccionado;?>,<?php echo $Valor;?>)</script>

          <?php } ?>

          

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

		  $SQLrelacionada=$RegistroEstructura['Sentenciasqlrelacionada'];

		  if ($SQLrelacionada=="") {

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

			  

			  if($NombreOriginal=="PaisID")

			  {$paisSeleccionado=$Valor;}

			  ?>

		      <select name="<?php echo $NombreCampo ?>" id="<?php echo $NombreCampo ?>" class="admin_campo" <?php echo ($NombreOriginal=="PaisID" ? "onChange='verProvincias(this.value,0)'" : "");?> >

			  <?php

			  if (($Valor=="") or ($Valor=="0")) {

				  ?>

    		      <option value="" class="admin_campo" selected>- <?php echo utf8($campo_sinseleccion) ?> -</option>		

				  <?php

			  } else {

				  ?>

    			  <option value="" class="admin_campo">- <?php echo utf8($campo_quitarseleccion) ?> -</option>		

				  <?php

			  }

			  if ($CamposAMostrar=="") $CamposAMostrar="Nombre";

			  if (strpos($CamposAMostrar,",") > 0) {

				  $primercampo=TextoAntesDe(",",$CamposAMostrar);

			  } else {

			 	  $primercampo=$CamposAMostrar;

			  }

			  $SQL="SELECT ID,".$CamposAMostrar." FROM ".$Prefijo.$TablaRelacionada." WHERE Publico='1' ORDER BY ".$CamposAMostrar." ASC ";
				// print_r($SQL);
			  $ResultadoConsultaTabla=$mysqli->query($SQL) or die (mysql_error());

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

				  if ($ValorATomar==$Valor) {

					  ?>

		              <option value="<?php echo utf8($ValorATomar) ?>" class="admin_campo" selected><?php echo stripslashes($TextoAMostrar) ?></option>

					  <?php

				  } else {			

					  ?>

		              <option value="<?php echo utf8($ValorATomar) ?>" class="admin_campo"><?php echo stripslashes($TextoAMostrar) ?></option>

					  <?php

				  } 

			  }  //del while $RegistroTabla

			  ?>

        	  </select>

			  &nbsp; <a href="AltaRegistro.php?tabla=<?php echo $TablaRelacionada ?>" class="admin_linkaccion"><img src="img/icono_agregar.gif" border="0"> <?php echo utf8($lk_agregar) ?></a> &nbsp;

			  <?php

		  } else {

			  //tiene sentencia sql relacionada

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

		      <select name="<?php echo $NombreCampo ?>" id="<?php echo $NombreCampo ?>" class="admin_campo">

			  <?php

			  if (($Valor=="") or ($Valor=="0")) {

				  ?>

    		      <option value="" class="admin_campo" selected>- <?php echo utf8($campo_sinseleccion) ?> -</option>

				  <?php

			  } else {

				  ?>

    			  <option value="" class="admin_campo">- <?php echo utf8($campo_quitarseleccion) ?> -</option>

				  <?php

			  }

			  while ($reg=mysqli_fetch_array($ResultRel)) {

				  if ($reg[$ValorATomar]==$Valor) {

				 	  ?>

			          <option value="<?php echo utf8($reg[$ValorATomar]) ?>" class="admin_campo" selected><?php echo stripslashes($reg[$TextoAMostrar]) ?></option>

					  <?php

				  } else {

					  ?>

			          <option value="<?php echo utf8($reg[$ValorATomar]) ?>" class="admin_campo"><?php echo stripslashes($reg[$TextoAMostrar]) ?></option>

					  <?php	

				  }			

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

    } elseif ($TipoDeEntrada=="IMAGEN") {

			if($CualTabla!="Escort")

			{

		?>

		<tr>

		  <td width="25%" class="celdatitulo">

		  <?php echo utf8($TituloCampo) ?>

		  </td>

		  <td width="75%" class="celdainput">

		  <?php

		  $AnchoImagen=$RegistroEstructura['Imagenanchofoto'];

		  $AltoImagen=$RegistroEstructura['Imagenaltofoto'];

		  if (($Valor=="") or ($Valor==NULL) or ($Valor=="NULL")) {

			  //no hay imagen cargada

			  ?>

			  <input name="<?php echo $NombreCampo ?>" id="<?php echo $NombreCampo ?>" class="admin_campo" type="file" size="<?php echo $Long ?>" maxlength="250">

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

		  } else {

		  	  //hay una imagen cargada

			  if ($Directorio!="") {

				  $NombreImagenChica="../".$Directorio."/".$PrefijoFoto.$Item."c.jpg";

				  $NombreImagenGrande="../".$Directorio."/".$PrefijoFoto.$Item."g.jpg";

			  } else {

				  $NombreImagenChica="../".$PrefijoFoto.$Item."c.jpg";

				  $NombreImagenGrande="../".$PrefijoFoto.$Item."g.jpg";

			  }

			  ?>

			  <input type="hidden" value="<?php echo $Valor ?>" name="<?php echo $NombreCampo."_falso" ?>">

			  <a href="javascript:popUp('foto.php?id=<?php echo $NombreImagenGrande ?>','<?php echo $AnchoImagen ?>','<?php echo $AltoImagen ?>')" class="admin_linkaccion"><img src="<?php echo $NombreImagenChica ?>" align="left" border="0" alt="Zoom"></a>

			  <a href="javascript:popUp('foto.php?id=<?php echo $NombreImagenGrande ?>','<?php echo $AnchoImagen ?>','<?php echo $AltoImagen ?>')" class="admin_linkaccion"><?php echo utf8($lk_verimagen) ?></a><br>

			  <input type="checkbox" value="si" name="<?php echo $NombreCampo ?>_eliminar"> <?php echo utf8($tit_remover_imagen) ?><br>

			  <input type="checkbox" value="si" name="<?php echo $NombreCampo ?>_cambiar"> <?php echo utf8($tit_cambiar_imagen) ?><br>

			  <input name="<?php echo $NombreCampo ?>" class="admin_campo" type="file" size="<?php echo $Long ?>" maxlength="250">

			  <br>

			  <span class="admin_notas">

			  <?php echo utf8($ley_jpg) ?><br>

			  <?php echo utf8($ley_ajusteimagen) ?>

			  <?php echo $RegistroEstructura['Imagenanchofoto'] ?> x <?php echo $RegistroEstructura['Imagenaltofoto'] ?> pixeles. 

		  	  <?php echo utf8($ley_proporcion) ?>

			  </span>

    	  	  <?php

			  if ($Validaciones!="") {

				  ?>

				  <span class="admin_obligatorio">(*)</span>

				  <?php

			  }

		  }

		  ?>

		  </td>

		</tr>

		<?php

		}

		

    } elseif ($TipoDeEntrada=="HTML") {	    

		?> 

		<tr>

		  <td colspan="2" class="celdatitulo"><div align="left"><?php echo utf8($TituloCampo) ?></div></td>

		</tr>

		<tr>

		  <td colspan="2" class="celdainput">	    

		  <textarea name="<?php echo $NombreCampo ?>" 

			    class="admin_campo"

				cols="<?php echo $Long ?>" 

				rows="<?php echo $Alto ?>" 

				wrap="OFF"><?php echo stripslashes($Valor) ?></textarea>

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

		

		

	} elseif ($TipoDeEntrada=="CHECK") {

		?> 

  <tr>

    <td width="25%" class="celdatitulo">

	<?php echo utf8($TituloCampo) ?>

	</td>

    <td width="75%" class="celdainput">

	<?php

	if ($Valor==$RegistroEstructura['Valores']) {

		$chk="checked";

	} else {

		$chk="";

	}

	?>

    <input type="checkbox" name="<?php echo $NombreCampo ?>" value="<?php echo $RegistroEstructura['Valores'] ?>" <?php echo $chk ?> >

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
   <tr>
  <!-- <td width="25%" class="celdatitulo">

	VIP

	</td>
	<td>
	<?php $idvip=$_GET['id'];
	$consulta="SELECT * FROM reino01_Escort WHERE ID='$id'";
	//	$sql="SELECT * FROM reino01_Escort WHERE ID='$id'";echo $sql;exit;
	$res=$mysqli->query($consulta);
	$resultconsulta=mysqli_fetch_array($res);
	?>
		 <input type="checkbox" name="vip" <?php if($resultconsulta['vip']=='SI'):?>checked="checked" <?php endif;?> >

	</td>
  </tr>
   <tr>
  <td width="25%" class="celdatitulo">

	AGENCIA 

	</td>
	<td>
	<?php $idvip=$_GET['id'];
	$consulta="SELECT id,nombre_agencia FROM agencias";
	//	$sql="SELECT * FROM reino01_Escort WHERE ID='$id'";echo $sql;exit;
	$res=$mysqli->query($consulta);
	//$resultconsulta=mysqli_fetch_array($res);

	?>
		 <select  name="agencia_id" class="admin_campo">
		 		<option value="">NINGUNA</option>
		 	<?php while ($value=mysqli_fetch_array($res)):?>
		 		<option value="<?php echo $value['id']?>"><?php echo $value['nombre_agencia']?></option>
		 	<?php endwhile;?>
		 </select>

	</td>
  </tr>
			-->
<?php // TipoDeEntrada=8 ARCHIVO

	} elseif (($TipoDeEntrada=="ARCHIVO") && ($CualTabla!="Escort") && ($CualTabla!="Banner")) {

		?> 

		<tr>

		  <td width="25%" valign="top" class="celdatitulo" align="right">

		  <?php echo utf8($TituloCampo) ?>

		  </td>

		  <td width="75%" class="celdainput">

		  <?php

		  if (($Valor=="") or ($Valor==NULL) or ($Valor=="NULL")) {

			  //no hay archivo

			  ?>

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

		  } else {

		  	  //hay archivo

			  if ($Directorio!="") {

				  $ArchivoConPath="../".$Directorio."/".$Valor;

			  } else {

				  $ArchivoConPath="../".$Valor;

			  }

			  //debbug :: echo $Valor."<br>";

			  //debbug :: echo $Directorio."<br>";

			  //debbug :: echo $ArchivoConPath."<br>";

			  ?>

			  <input type="hidden" value="<?php echo $Valor ?>" name="<?php echo $NombreCampo."_falso" ?>">

			  <a href="<?php echo $ArchivoConPath ?>" target="_blank"><img src="img/icono_archivo.jpg" align="left" border="0"></a>

			  <a href="<?php echo $ArchivoConPath ?>" target="_blank" class="admin_linkaccion"><?php echo utf8($tit_abrir_archivo)." ".$Valor ?></a><br>

			  <input type="checkbox" value="si" name="<?php echo $NombreCampo ?>_eliminar"> <?php echo utf8($tit_remover_archivo) ?><br>

			  <input type="checkbox" value="si" name="<?php echo $NombreCampo ?>_cambiar"> <?php echo utf8($tit_cambiar_archivo) ?><br>

			  <input name="<?php echo $NombreCampo ?>" class="admin_campo" type="file" size="<?php echo $Long ?>" maxlength="250">

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

		  }

		  ?>

		  </td>

		</tr>

		<?php

	}

	 elseif ($TipoDeEntrada=="FECHA") { 

?>

  <tr>

    <td width="25%" class="celdatitulo">

	<?php echo utf8($TituloCampo) ?>

	</td>

    <td width="75%" class="celdainput">	    

	<?php

	$Dia=substr($Valor,8,2);

	$Mes=substr($Valor,5,2);

	$Anio=substr($Valor,0,4);

	if ($adminstyle=="es") {

	?>

    <select name="<?php echo $NombreCampo ?>_dia" class="admin_campo">

	<?php

	if (($Dia=="") or ($Dia=="00")) {

		?>

		<option value="" class="admin_campo" selected>---</option>

		<?php

	} else {

		?>

		<option value="" class="admin_campo">---</option>

		<?php

	}

	$dia=0;

	while ($dia < 31) {

		$dia++;

		if ($dia < 10) {

			if ($Dia=="0".$dia) {

				?>

				<option value="0<?php echo $dia ?>" class="admin_campo" selected> <?php echo $dia ?></option>

				<?php

			} else {

				?>

				<option value="0<?php echo $dia ?>" class="admin_campo"> <?php echo $dia ?></option>

				<?php

			}

		} else {

			if ($Dia==$dia) {

				?>

				<option value="<?php echo $dia ?>" class="admin_campo" selected><?php echo $dia ?></option>

				<?php

			} else {

				?>

				<option value="<?php echo $dia ?>" class="admin_campo"><?php echo $dia ?></option>

				<?php

			}

		}

	}

	?>

	</select>

	/

    <select name="<?php echo $NombreCampo ?>_mes" class="admin_campo">

	<?php

	if (($Mes=="") or ($Mes=="00")) {

		?>

		<option value="" class="admin_campo" selected>----</option>

		<?php

	} else {

		?>

		<option value="" class="admin_campo">----</option>

		<?php

	}

	$mes=0;

	while ($mes < 12) {

		$mes++;

		if ($mes < 10) {

			if ($Mes=="0".$mes) {

				?>

				<option value="0<?php echo $mes ?>" class="admin_campo" selected><?php echo $NombreMes[$mes] ?></option>

				<?php

			} else {

				?>

				<option value="0<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>

				<?php

			}

		} else {

			if ($Mes==$mes) {

				?>

				<option value="<?php echo $mes ?>" class="admin_campo" selected><?php echo $NombreMes[$mes] ?></option>

				<?php

			} else {

				?>

				<option value="<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>

				<?php

			}

		}

	}

	?>

	</select>

	<?php

	} else {

	?>

    <select name="<?php echo $NombreCampo ?>_mes" class="admin_campo">

	<?php

	if (($Mes=="") or ($Mes=="00")) {

		?>

		<option value="" class="admin_campo" selected>----</option>

		<?php

	} else {

		?>

		<option value="" class="admin_campo">----</option>

		<?php

	}

	$mes=0;

	while ($mes < 12) {

		$mes++;

		if ($mes < 10) {

			if ($Mes=="0".$mes) {

				?>

				<option value="0<?php echo $mes ?>" class="admin_campo" selected><?php echo $NombreMes[$mes] ?></option>

				<?php

			} else {

				?>

				<option value="0<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>

				<?php

			}

		} else {

			if ($Mes==$mes) {

				?>

				<option value="<?php echo $mes ?>" class="admin_campo" selected><?php echo $NombreMes[$mes] ?></option>

				<?php

			} else {

				?>

				<option value="<?php echo $mes ?>" class="admin_campo"><?php echo $NombreMes[$mes] ?></option>

				<?php

			}

		}

	}

	?>

	</select>

	/

    <select name="<?php echo $NombreCampo ?>_dia" class="admin_campo">

	<?php

	if (($Dia=="") or ($Dia=="00")) {

		?>

		<option value="" class="admin_campo" selected>---</option>

		<?php

	} else {

		?>

		<option value="" class="admin_campo">---</option>

		<?php

	}

	$dia=0;

	while ($dia < 31) {

		$dia++;

		if ($dia < 10) {

			if ($Dia=="0".$dia) {

				?>

				<option value="0<?php echo $dia ?>" class="admin_campo" selected> <?php echo $dia ?></option>

				<?php

			} else {

				?>

				<option value="0<?php echo $dia ?>" class="admin_campo"> <?php echo $dia ?></option>

				<?php

			}

		} else {

			if ($Dia==$dia) {

				?>

				<option value="<?php echo $dia ?>" class="admin_campo" selected><?php echo $dia ?></option>

				<?php

			} else {

				?>

				<option value="<?php echo $dia ?>" class="admin_campo"><?php echo $dia ?></option>

				<?php

			}

		}

	}

	?>

	</select>

	<?php

	}

	?>

	/

    <select name="<?php echo $NombreCampo ?>_anio" class="admin_campo">

	<?php

	if (($Anio=="") or ($Anio=="0000")) {

		?>

		<option value="" class="admin_campo" selected>-----</option>

		<?php

	} else {

		?>

		<option value="" class="admin_campo">-----</option>

		<?php

	}

	$anio=0;

	$ListaDeValidaciones=$RegistroEstructura['Validaciones'];

	$Desde=1950;

	$Hasta=2050;

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

		if ($Anio==$anio) {

			?>

			<option value="<?php echo $anio?>" class="admin_campo" selected><?php echo $anio ?></option>

			<?php

		} else {

			?>

			<option value="<?php echo $anio?>" class="admin_campo"><?php echo $anio ?></option>

			<?php

		}

	}

	?>	

	</select>

    <?php

	if ($Validaciones!="") {

		?>

		<span class="admin_obligatorio">(*)</span>

		<?php

	}

	//debbug ::	echo "<br>Rango: ".$Rango." (".$Desde."/".$Hasta.")<br>";

	if ($Leyenda) {

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

    <?php 

	if($NombreCampoOriginal=="fechaPublicacion") 

	{$Valor=date("Y-m-d");}

	?>

    <input type="text" class="admin_campo" readonly="readonly" name="<?php echo $NombreCampo?>" size="12" value="<?php echo utf8($Valor) ?>">	

	<?php

	echo '<script language="javascript">';

	echo 'var Calendario_'.$NombreCampo.' = new calendar("FIELD:document.FormModificar.'.$NombreCampo.';FORMAT:3;DELIMITER:-;");';

	echo 'Calendario_'.$NombreCampo.'.writeCalendar();';

	echo '</script>';

	if ($Validaciones!="") {

		?> 

		<span class="admin_obligatorio">(*)</span>

		<?php

	}

	if ($Leyenda) {

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

			if (!strpos($Valor,"|".$ValorATomar."|")) {

				?>

			    <td align="center">

			    <input type="checkbox" name="<?php echo $NombreCampo ?>_<?php echo $kk ?>" value="<?php echo $ValorATomar ?>">

				</td>

				<?php

			} else {

				?>

			    <td align="center">

			    <input type="checkbox" name="<?php echo $NombreCampo ?>_<?php echo $kk ?>" value="<?php echo $ValorATomar ?>" checked>

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

	if ($Leyenda) {

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

						size="<?php echo $long_clave ?>" 

						maxlength="<?php echo $LongMax ?>"

						value="<?php echo stripslashes($Valor) ?>">

				  </td>

				</tr>

			    <?php

				$tablaI=$Prefijo."Idioma";

				$SQL="SELECT * FROM $tablaI WHERE (Publico='1') ORDER BY Nrodeorden ASC";

				$ResultI=$mysqli->query($SQL);

				while ($RegI=mysqli_fetch_array($ResultI)) {

					$idioma=stripslashes($RegI['Nombre']);

					$id_idioma=$RegI['ID'];

					$tablaT=$Prefijo."Traduccion";

					$SQL="SELECT * FROM $tablaT WHERE (Publico='1') AND (Tabla='$CualTabla') AND (TablaID='$Item') AND (Campo='$NombreCampoOriginal') AND (IdiomaID='$id_idioma')";

					$ResultT=$mysqli->query($SQL);

					$RegT=mysqli_fetch_array($ResultT);

					$valor_traduccion=stripslashes($RegT['Nombre']);

					?>

				    <tr>

					  <td width="20%" class="celdatitulo"><?php echo $idioma ?>:&nbsp;</td>

					  <td width="80%" class="celdainput">

				      <textarea name="<?php echo $NombreCampo."_traduccion_".$id_idioma ?>" 

					  	 	class="admin_campo"

							cols="<?php echo $ancho_text ?>" 

							rows="<?php echo $Alto ?>" 

							wrap="OFF"><?php echo $valor_traduccion ?></textarea>

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

		if ($Registro['Publico']==1) {

			?>

			<label><input type="radio" name="itempublico" value="1" checked>&nbsp;<?php echo utf8($campo_si) ?></label>&nbsp;&nbsp;

			<label><input type="radio" name="itempublico" value="0">&nbsp;<?php echo utf8($campo_no) ?></label>

			<?php

		} else {

			?>

			<label><input type="radio" name="itempublico" value="1">&nbsp;<?php echo utf8($campo_si) ?></label>&nbsp;&nbsp;

			<label><input type="radio" name="itempublico" value="0" checked>&nbsp;<?php echo utf8($campo_no) ?></label>	

			<?php

		}

	}

	else

	{	

		echo '<label><input type="radio" name="itempublico" value="1" '.($Registro['Publico']==1 ? 'checked="checked" ' : '').'>&nbsp;'.utf8($campo_si).'</label>&nbsp;&nbsp;

			<label><input type="radio" name="itempublico" value="0" '.($Registro['Publico']==0 ? 'checked="checked" ' : '').'>&nbsp;'.utf8($campo_no).'</label>&nbsp;&nbsp;

			<label><input type="radio" name="itempublico" value="3" '.($Registro['Publico']==3 ? 'checked="checked" ' : '').'>&nbsp;Pendiente</label>&nbsp;&nbsp;';

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

    <td class="celdainput">

	&nbsp;<span class="admin_obligatorio">(*) <?php echo utf8($tit_datosobligatorios) ?></span>

	</td>

  </tr>

  <?php

  }

	if (($CualTabla=="Banner")) {

		if($CualTabla=="Banner")

		{$tablaConsProv="reino01_banner_provincia";

		$tablaConsCiu="reino01_banner_ciudad";

		$idConsTab="IDBanner";}

		else

		{$tablaConsProv="reino01_escort_provincia";

		$tablaConsCiu="reino01_escort_ciudad";

		$idConsTab="IDEscort";}

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

					  

					 $SQLVerifExProv="SELECT ID FROM $tablaConsProv WHERE $idConsTab='$Item' AND IDProvincia='$idProvincia'";

					 $ejecVerifExProv=$mysqli->query($SQLVerifExProv) or die(mysql_error());

					 $numVerifProv=mysqli_num_rows($ejecVerifExProv);

					 

					if($CualTabla!="Banner")

					{

					 

					  	if($numVerifProv>0)

						{echo "<label><input type='checkbox' name='prov$idProvincia' value='1' checked='checked' />".$arryProv['Nombre']."</label><span id='btnCiudad$idProvincia'><a href='javascript:verCiudadesDesplegable($idProvincia)'><img src='img/mostrar.png' title='Mostrar provincias' alt='Mostrar provincias'></a></span><br>";

						}

 						else

					  	{echo "<label><input type='checkbox' name='prov$idProvincia' value='1' />".$arryProv['Nombre']."</label><span id='btnCiudad$idProvincia'><a href='javascript:verCiudadesDesplegable($idProvincia)'><img src='img/mostrar.png' title='Mostrar provincias' alt='Mostrar provincias'></a></span><br>";}

					  

							$SQLciu="SELECT * FROM reino01_Ciudad WHERE Publico=1 AND ProvinciaID='$idProvincia' ORDER BY Nombre";

							$Resultciu=$mysqli->query($SQLciu) or die (mysql_error());



							echo "<div id='ciudadPorProv$idProvincia' style='display:none'>";

							while ($arryCiu=mysqli_fetch_array($Resultciu)) {

								$idCiudad=$arryCiu['ID'];



					 $SQLVerifExCiu="SELECT ID FROM $tablaConsCiu WHERE $idConsTab='$Item' AND IDCiudad='$idCiudad'";

					 $ejecVerifExCiu=$mysqli->query($SQLVerifExCiu);

					 $numVerifCiu=mysqli_num_rows($ejecVerifExCiu);

					  	if($numVerifCiu>0)

						{echo " &mdash;&mdash; <label><input type='checkbox' name='ciu$idCiudad' value='1' checked='checked' />".$arryCiu['Nombre']."</label><br>";}

							else

						{echo " &mdash;&mdash; <label><input type='checkbox' name='ciu$idCiudad' value='1' />".$arryCiu['Nombre']."</label><br>";}



							}

							}

							else

							{

						if($numVerifProv>0)

						{echo "<label><input type='checkbox' name='prov$idProvincia' value='1' checked='checked' />".$arryProv['Nombre']."</label><br>";

						}

 						else

					  	{echo "<label><input type='checkbox' name='prov$idProvincia' value='1' />".$arryProv['Nombre']."</label><br>";}

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

	  <table width="100%" border="0" cellspacing="0" cellpadding="0">

	    <tr>

	      <td width="50%" valign="top" align="left"><a href="listarTabla.php?tabla=<?php echo $CualTabla?>" class="admin_botones" > &lt;&lt; <?php echo utf8($bt_volver) ?></a></td>

		  <td width="50%" valign="top" align="right">

		  <input type="hidden" name="filtro" value="<?php echo $filtro ?>">

		  <input type="hidden" name="titulo" value="<?php echo $titulo ?>">

		  <input name="agregar" type="submit" class="admin_botones" value="<?php echo utf8($bt_modificar) ?> >>"></td>

		</tr>

	  </table>

	</td>

  </tr>

</table>





<?php if($CualTabla=="Escort"){  ?>

<table border="0" cellspacing="0" class="admin_form_derecha" width="260px" style="background: #F2F3F7;">

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

		$tablaFPReg=$Prefijo."escort_formas_pagos_registro";

		

		$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");

		

		echo "<ul class='listaDetalles'>";

		while($arryFP = mysqli_fetch_array($sqlFP))

		{

			

			$sqlBuscRegFP=$mysqli->query("select ID from $tablaFPReg where ID_escort='$Item' AND ID_forma_pago='".$arryFP["ID"]."' ") or die(mysql_error());

			$cantRegFP=mysqli_num_rows($sqlBuscRegFP);

			echo "<li><label><input type='checkbox' name='FP_".$arryFP["ID"]."' value='1' ".($cantRegFP>0 ? "checked='checked'" : "").">".$arryFP["Nombre"]."</label></li>";

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

		$tablaLAReg=$Prefijo."escort_lugares_atencion_registro";

		

		$sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");

		

		echo "<ul class='listaDetalles'>";

		while($arryLA = mysqli_fetch_array($sqlLA))

		{

			$sqlBuscRegLA=$mysqli->query("select ID from $tablaLAReg where ID_escort='$Item' AND ID_lugar_atencion='".$arryLA["ID"]."' ") or die(mysql_error());

			$cantRegLA=mysqli_num_rows($sqlBuscRegLA);

			echo "<li><label><input type='checkbox' name='LA_".$arryLA["ID"]."' value='1' ".($cantRegLA>0 ? "checked='checked'" : "").">".$arryLA["Nombre"]."</label></li>";

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

		$tablaSReg=$Prefijo."escort_servicios_registro";

		

		$sqlS = $mysqli->query("select * from $tablaS where Publico='1'");

		

		echo "<ul class='listaDetalles'>";

		while($arryS = mysqli_fetch_array($sqlS))

		{

			$sqlBuscRegS=$mysqli->query("select ID from $tablaSReg where ID_escort='$Item' AND ID_servicio='".$arryS["ID"]."' ") or die(mysql_error());

			$cantRegS=mysqli_num_rows($sqlBuscRegS);

			echo "<li><label><input type='checkbox' name='S_".$arryS["ID"]."' value='1' ".($cantRegS>0 ? "checked='checked'" : "").">".$arryS["Nombre"]."</label></li>";

		}

		echo "</ul>";

		?>

    </td>

  </tr>

    

</table>

<?php } ?>











  </form>

  </table>

  

  <?php if($CualTabla=="Escort"){  ?>
<form action="borrarfotos.php" method="post">
 	<table class="admin_form_derecha" style="margin-top: -20px;"><tr><td> 

	<table border="0" cellspacing="0" id="mostrarFotos" width="300px" style="background: #F2F3F7;">

  <tr> 

    <td class="listado_titulogeneral" colspan="2" valign="top">

      <?php echo "INFORMACIÓN MULTIMEDIA FOTOS"; ?>

      <?php echo $CualTabla ?>

    </td>

  </tr>

  <?php while ($recImgDat = mysqli_fetch_array($queryImg)) { 

   if (file_exists("../fotos/".$recImgDat['Imagen'])) { ?>

  <tr>

  	<td width='25%' class='celdatitulo' valign="top"><?php 

	$radioVal="";

	if ($recImgDat['Principal'] == 1)

	{$radioVal="checked='checked'";}

	echo "

	<p><label><input type='radio' onClick='principalFotos(".$recImgDat['ID'].",".$Item.")' $radioVal >Principal</p></label>

	<input type='button' value='Eliminar' onClick='eliminarFotos(".$recImgDat['ID'].",".$Item.")' class='admin_botones'>"; ?></td>

  	<td align="center" class='celdainput' valign="top"> 

			<?php echo "<img src='../fotos/".$recImgDat['Imagen']."' height='150px' width='150px'>";

			?>

	</td>
	<td> <input type="checkbox" value="<?php echo $recImgDat['ID'];?>" name="foto[]"></td>
<input name='idEscort' type='hidden' value='<?php echo $Item ?>' />
  </tr>

  <?php 

  	}

  } 



	

	echo "
	<tr>
	</td>"; ?>
	<td></td>
	<td></td>
	<td><input type='submit' name='submitBtn' value='Borrar Fotos' class='admin_botones' onclick='return confirm("Esta seguro de borrar las fotos seleccionadas?");' /></td>
  <?php echo "</tr>"; ?>

  <tr>

  	<td colspan="2">&nbsp;</td>

  </tr>

</table>
</form>
<form action='upload.php' method='post' enctype='multipart/form-data'   >
<table>
	<tr>
		<td><label for="fotos">SUBIR MAS FOTOS</label></td>
	</tr>
	<tr>
		
		
		<td align="center" colspan="1">
			 
					
	          		<div class="dropzone" id="my-dropzone" name="mainFileUploader">
          				<div class="fallback">
                			<input name="file" type="file" multiple />
			            </div>
        			</div>
		</td>	
		
	</tr>
<tr>
<td><input class="admin_botones" id="submit-all" type="submit" value="SUBIR FOTOS >>" name="agregar"></td>


</tr>
</table>
</td></tr>

<tr>

<td valign="top">

<table border="0" cellspacing="0" id="mostrarVideos">

  <tr> 

    <td class="listado_titulogeneral" colspan="2">

      <?php echo "INFORMACIÓN MULTIMEDIA VIDEOS"; ?>

      <?php echo $CualTabla ?>

    </td>

  </tr>

  <?php while ($recVideoDat = mysqli_fetch_array($queryVideo)) { ?>

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

			<object width='400' height='400'><param name='movie' value='http://www.youtube.com/v/".$recVideoDat['Video']."'></param><embed src='http://www.youtube.com/v/".$recVideoDat['Video']."' type='application/x-shockwave-flash' width='300' height='300'></embed></object>

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

  <tr>

  	<td colspan="2">&nbsp;</td>

  </tr>

</table>

  </td></tr></table>

  

  <?php } ?>

  

  

  <?php

  if($CualTabla=="Banner"){

$banAncho=0;

$banAlto=0;

$sqlBanner="SELECT b.ID, b.Alto, b.Ancho, b.Descripcion, b.Nombre, b.ArchivoMultimedia FROM reino01_Banner b, reino01_banner_posicion bp WHERE b.Posicion=bp.ID AND b.ID='$Item' ";

$ejecBanner=$mysqli->query($sqlBanner) or die (mysql_error());

$arryBanner=mysqli_fetch_array($ejecBanner);

$revisarBanner=explode(".",$arryBanner['ArchivoMultimedia']);

$swSwf=0;

if($revisarBanner[1]=="swf")

{$swSwf=1;}

	$banAncho=$arryBanner['Ancho'];

	$banAlto=$arryBanner['Alto'];

?>

<table border="0" cellpadding="3" cellspacing="0" class="admin_form_derecha" id="mostrarImgBanner" style="margin-top:-12px;">

  <tr> 

    <td class="listado_titulogeneral" colspan="2">

      <?php echo "IMAGEN BANNER"; ?>

      <?php echo $CualTabla ?>

    </td>

  </tr>

<?php 

if($arryBanner['ArchivoMultimedia']=="")

{/*echo "<tr>

	<td width='25%' class='celdatitulo'>Cargar imagenes

	</td>

	<td width='75%' class='celdainput' align='center'>

	<form action='subirBanner.php' method='post' enctype='multipart/form-data' target='uploadBann_target' onSubmit='startUploadBann();' >

	<br><div class='uploadBann'><input name='myfile' type='file' /></div>

	<p id='f1_upload_form_bann' align='center'><input name='idBann' type='hidden' value='$Item' />

	<input type='submit' name='submitBtn' value='Subir imagen' class='admin_botones' /></p>

	<p id='f1_upload_process_bann' style='visibility:hidden'>Cargando...<img src='img/loader.gif' /></p>

	<iframe id='uploadBann_target' name='uploadBann_target' style='width:0;height:0;border:0px solid #fff;'></iframe></form>";

	echo "

	</td>

  </tr>";*/}

else

	{echo "<tr><td>";

		if($swSwf==1)

		{?>    

		<script type="text/javascript">

        AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','<?php echo $banAncho; ?>','height','<?php echo $banAlto; ?>','src','../banners/<?php echo $revisarBanner[0]; ?>','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','../banners/<?php echo $revisarBanner[0]; ?>' ); //end AC code

        </script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="<?php echo $banAncho; ?>" height="<?php echo $banAlto; ?>">

          <param name="movie" value="../banners/<?php echo $arryBanner['ArchivoMultimedia']; ?>">

          <param name="quality" value="high">

          <embed src="../banners/<?php echo $arryBanner['ArchivoMultimedia']; ?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="<?php echo $banAncho; ?>" height="<?php echo $banAlto; ?>"></embed>

		  </object>

		  </noscript>

		<?php }

		else

		{echo "<a href='http://".$arryBanner['Nombre']."' title='".$arryBanner['Descripcion']."' alt='".$arryBanner['Descripcion']."' target='_blank'> <img src='../banners/".$arryBanner['ArchivoMultimedia']."' width='$banAncho' height='$banAlto'></a>";}

		?>

		<br><br>
		<?php 
		if($arryBanner['ArchivoMultimedia']!=''):?>

		
	     <?php else:?>
	     <tr>
	     <td class="celdatitulo" width="25%">Cargar imagenes </td>
	     <td class="celdainput" width="75%" align="center">
<form  enctype="multipart/form-data" method="post" action="subirBanner.php">
<br>
<div class="uploadBann">
<input type="file" name="myfile">
</div>
<p id="f1_upload_form_bann" align="center">
<input type="hidden" value="<?php echo $arryBanner['ID']?>" name="idBann">
<input class="admin_botones" type="submit" value="Subir imagen" name="submitBtn">
</p>
</form>
</td>
</tr>
		<?php endif;?>
	<?php 

	echo "</td></tr>";

	}

?>
<?php 
		if($arryBanner['ArchivoMultimedia']!=''):?>

		<input type='button' value='Eliminar imagen banner' onClick='eliminarFotosBanner("<?php echo $arryBanner['ID']?>")' class='admin_botones'></td>
	     <?php else:?>
	     <tr>
	     <td class="celdatitulo" width="25%">Cargar imagenes </td>
	     <td class="celdainput" width="75%" align="center">
<form   enctype="multipart/form-data" method="post" action="subirBanner.php">
<br>
<div class="uploadBann">
<input type="file" name="myfile">
</div>
<p id="f1_upload_form_bann" align="center">
<input type="hidden" value="<?php echo $arryBanner['ID']?>" name="idBann">
<input class="admin_botones" type="submit" value="Subir imagen" name="submitBtn">
</p>
</form>
</td>
</tr>
		<?php endif;?>
</table>

<?php } ?>

  

  

</body>
<script type="text/javascript">
        $(document).ready(function(){
            Dropzone.autoDiscover = false;

            $("#my-dropzone").dropzone({
                url: "upload.php?id=<?php echo  $_GET['id'];?>",
        		addRemoveLinks: true,
        		dictRemoveFile: 'Borrar Foto',
        		autoProcessQueue: false,
        		uploadMultiple: true,
        		parallelUploads: 10,
        		maxFiles: 10,
        		dictDefaultMessage: "Por favor arrastre sus imagenes aca <br/> o haga click para buscar",
        		acceptedFiles: ".jpeg,.jpg,",


        		// The setting up of the dropzone
			    init: function() {
			        var myDropzone = this;
			        

			        // Here's the change from enyo's tutorial...
			      /*   this.on("sending", function(file, xhr, formData) {
					 	var provincia = $('#provincia').val();
					 	formData.append('provincia', provincia); 
					 	

					 	

					 	
					 	
						
						
					 	
	
					  }); */  
			        $("#submit-all").click(function (e) {
			            e.preventDefault();
			            e.stopPropagation();
			            myDropzone.processQueue();

			        });
			        this.on("sendingmultiple", function() {
				      // Gets triggered when the form is actually being sent.
				      // Hide the success button or the complete form.
				    });
				    this.on("successmultiple", function(files, response) {
				      // Gets triggered when the files have successfully been sent.
				      // Redirect user or notify of success.
				     window.location.href = "http://www.reinovip.es/administrador/ModRegistro.php?tabla=Escort&id=<?php echo $_GET['id'];?>&filtro=&front=";
				    });
				    this.on("errormultiple", function(files, response) {
				      // Gets triggered when there was an error sending the files.
				      // Maybe show form again, and notify user of error
				    });
			    },
		        success: function (file, response) {
            	var imgName = response;

            	file.previewElement.classList.add("dz-success");
            	console.log("Successfully uploaded :" + imgName);
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
            });

        });
    </script>
</html>

<?php 

function diferenciaFechas($date1, $date2) { 

    $current = $date1; 

    $datetime2 = date_create($date2); 

    $count = 0; 

    while(date_create($current) < $datetime2){ 

        $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 

        $count++; 

    } 

	return $count; 

} 

?>

