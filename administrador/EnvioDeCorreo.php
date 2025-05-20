<?php 
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("admin.traducciones.php");
include("../includes/phpmailer.inc.php");

$modulo="EnvioDeCorreo.php";
$nombreSuscriptores="Usuario";

function enviarmail_phpmailer ($myname,$myemail,$contactname,$contactemail,$subject,$message) {
	$mail=new PHPMailer();
	$mail->From=$myemail;
	$mail->FromName=$myname;
	$mail->Subject=stripslashes($subject);
	$mail->Body=stripslashes($message);
	$mail->AltBody=strip_tags($message); 
	$mail->IsHTML(true);
	$mail->AddAddress($contactemail,$contactname);
	if (!$mail->Send()) $mensaje="Error: ".$mail->ErrorInfo;
	else $mensaje="";
	return $mensaje;
}


// valido la existencia de este usuario 
$usuario=$_SESSION['usuariolog'];
$tablaL=$Prefijo."logueo";
$SQL="SELECT * FROM $tablaL WHERE Nombre='$usuario' ";
$ResultL=$mysqli->query($SQL);
$cantreg=mysqli_num_rows($ResultL);
if ($cantreg < 1) $usuario="";
if ($usuario=="") {
	header("location: admin.php?mensaje=".$error_accesoindebido.".");
	exit;
}	
//

if ($_SESSION['usuariolog']=="") $Prefijo="";
if ($Prefijo=="") {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": ".$modulo);
    exit;
}

function enviarmail($myname,$myemail,$contactname,$contactemail,$subject,$message) {
  $headers.="MIME-Version: 1.0\n";
  $headers.="Content-type: text/html; charset=iso-8859-1\n";
  $headers.="X-Priority: 1\n";
  $headers.="X-MSMail-Priority: High\n";
  $headers.="X-Mailer: php\n";
  $headers.="From: \"".$myname."\" <".$myemail.">\n";
  return(mail("\"".$contactname."\" <".$contactemail.">",$subject,$message,$headers));
}

//atención: deben existir los campos Nombre, Email y CategoriaSuscriptorID en la tabla Usuario
$tablaSuscriptores=$Prefijo.$nombreSuscriptores;
$tablaCategoriaSuscriptores=$Prefijo."CategoriaSuscriptor";
if ($EmailDeControl=="") $EmailDeControl="control.envio@laelefanta.es";
$tablaMailsMasivos=$Prefijo."MailMasivo";
$TituloEnvio="Control de Mailing";

//mensajes de resultado de acción:
$mensajeprueba="";
$mensajeenvio="";
$mensajegrabado="";


// ********************************************************************
// EL SISTEMA DE ENVIO DE CORREO UTILIZA 4 ARCHIVOS, QUE DEBEN CONTENER
// LOS SIGUIENTES DATOS:
// $Prefijo."Usuario" -> Nombre (cadena-50)
//            			 Email (cadena-80)
//            		     CategoriaSuscriptorID (bigint-10-unsigned)
// $Prefijo."CategoriaSuscriptor" -> Nombre (cadena-30)
//                                   Cantidad (bigint-10-unsigned)
// $Prefijo."MailMasivo" -> Nombre 'Asunto' (cadena-70)
//                          Contenido (text)
// $Prefijo."EnvioMasivo" -> Nombre (cadena-70)
//                           CategoriaSuscriptorID (bigint-10-unsigned)
//                           MailMasivoID (bigint-10-unsigned)
//                           Registrohasta (bigint-10-unsigned)
// ********************************************************************
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
<script language="Javascript1.2">
_editor_url="EditorHtml/";                   // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
// me parece que se corta la palabra "<script>" para que no se confunda
// el explorer ???
  document.write('<scr'+'ipt src="'+_editor_url+'editor.js"');
  document.write('language="Javascript1.2"></scr'+'ipt>');  
} else { 
  document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); 
}
</script>
</head>

<body>
<?php 
$asuntomail=addslashes($_POST['asuntomail']);
$contenidomail=addslashes($_POST['contenidomail']);
$quehacer=$_GET["accion"];
if ($quehacer=="grabar") {
    global $tablaMailsMasivos;
	global $mensajegrabado;
	$mensajegrabado="";
	$SQL="INSERT INTO $tablaMailsMasivos (Publico,Nombre,Contenido) VALUES ('1','$asuntomail','$contenidomail')";
	$ResultadoConsulta=$mysqli->query($SQL);
	$mensajegrabado=mysqli_error();
	if ($mensajegrabado=="") {
	      $mensajegrabado=$ley_grabobien.".";
	}
}

if ($quehacer=="probar") {
    global $mensajeprueba;
    $mensajeprueba="";
    global $EmailDesde;
    global $EmailDesdeNombre;
    global $tablaMailsMasivos;
    /*
    mail($destino, $asunto, $texto, "From: $envia <$remite>
 	Reply-To: $EmailDesde
	X-Mailer: PHP/" . phpversion());
    */
    $mimail=$EmailDesde;
    $minombre=$EmailDesdeNombre;
    $CualMail=$mailseleccionado;
    $SQL="SELECT * FROM $tablaMailsMasivos WHERE ID='$CualMail' ";
    $ResultadoConsulta=$mysqli->query($SQL);
    if ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
    	$asunto=stripslashes($Registro['Nombre']);
        $cuerpo=stripslashes($Registro['Contenido']);
    }
    $direccion=$maildeprueba;
    $mensaje_error=enviarmail_phpmailer($minombre,$mimail,$direccion,$direccion,$asunto,$cuerpo);
    if ($mensaje_error!="") {
		$mensajeprueba=$error_noseenviomail.": ".$mensaje_error;
    } else {
   	    $mensajeprueba=$ley_pruebabien.".";
    }
}
if ($mensajeprueba!="") $Mensaje.=$mensajeprueba;
if ($mensajeenvio!="") $Mensaje.=$mensajeenvio;
if ($mensajegrabado!="") $Mensaje.=$mensajegrabado;
?>
<?php include("topadmin.inc.php"); ?>
<!-- Aca comienza el formulario -->
<?php
if ($quehacer=="enviar") {
?>
<table class="tabla_ventana" cellpadding="3" cellspacing="0">
  <tr>
    <td>
<?php
if ($quehacer=="enviar") {
	global $mensajeenvio;
   	$mensajeenvio="";
   	global $EmailDesde;
   	global $EmailDesdeNombre;	   
   	global $tablaMailsMasivos;

	if ($_POST['listado']!='') {
		//Enviamos un listado de las ofertas o novedades
		include("listado_mail.php");
		$contenidomail = file_get_contents('listado_mail.html');

		$CualCategoria=$_POST['categoriaseleccionada'];
	
		$RegIni=$_POST['reginicio'];
		if ($RegIni=="") {
			$tablaEnvioMasivo=$Prefijo."EnvioMasivo";
			$SQL="SELECT * FROM $tablaEnvioMasivo WHERE CategoriaSuscriptorID='$CualCategoria' ";
			$Result=$mysqli->query($SQL);
			$cantreg=mysqli_num_rows($Result);
			if ($cantreg==0) {
				$RegIni=1;
			} else {
				$RegEM=mysqli_fetch_array($Result);
				$RegIni=$RegEM['Registrohasta']+1;
			}
		}
		$Tanda=$_POST['cantidadtanda'];
		if ($Tanda=="") $Tanda="200";
		
		$EnvioControl=$_POST['mailenviocontrol'];
		$mimail=$EmailDesde;
		$minombre=$EmailDesdeNombre;


		$asunto='Listado';
		$asuntomail='Listado 2';
		$cuerpo=$contenidomail;

		global $tablaSuscriptores;
		$aplicafiltro=$_POST['aplicafiltro'];
		$campofiltro=$_POST['campofiltro'];
		$valorfiltro=$_POST['valorfiltro'];
		if (($aplicafiltro=="si") and ($campofiltro!="")) {
			$debo_grabar_control=false;
			$SQL="SELECT * FROM $tablaSuscriptores WHERE (Publico='1') AND ($campofiltro='%$valorfiltro%') ";
			$ResultadoConsulta=$mysqli->query($SQL);
		} else {
			$debo_grabar_control=true;
			$SQL="SELECT * FROM $tablaSuscriptores WHERE Publico='1' AND CategoriaSuscriptorID='$CualCategoria' ";
			$ResultadoConsulta=$mysqli->query($SQL);
			$total=mysqli_num_rows($ResultadoConsulta);
			$SQL="UPDATE $tablaCategoriaSuscriptores SET Cantidad='$total' WHERE ID='$CualCategoria'";
			$ResultModi=$mysqli->query($SQL);
		}
		echo "<font size=\"1\" face=\"Arial, Helvetica, sans-serif\">";
		$numreg=0;
		$enviados=0;
		$errores=0;
		$cont=0;
		while($Registro=mysqli_fetch_array($ResultadoConsulta)) {
			$numreg++;
			if (($numreg >= $RegIni) and ($enviados < $Tanda)) {
				$display=$Registro['Nombre'];
				if (strlen($display) < 5) $display=$Registro['Empresa'];
				if (strlen($display) < 5) $display=$Registro['Email'];
				echo "(".$numreg.") ".$tit_envioa.": ".$Registro['Email']."<br>";
				$cont++;
				$direccion=$Registro['Email'];
				$aquien=$display;
				$mensaje_error=enviarmail_phpmailer($minombre,$mimail,$aquien,$direccion,$asunto,$cuerpo);
				if ($mensaje_error!="") {
					$errores++;
					echo "<font color=\"#FF0000\"><b>".$mensaje_error.": ".$Registro['Email']."</b></font><br>";
					// pongo en 3 (tres) a ItemPublico al mail que me da error
					$Id=$Registro['ID'];
					$SQL="UPDATE $tablaSuscriptores SET Publico='3' WHERE ID='$Id' ";
					$ResultadoModificacion=$mysqli->query($SQL);
			}
			$enviados++;
				$numregfinal=$numreg;
			}
			if ($cont==100) {
				$cont=0;
				$direccion=$EmailDeControl;
				$aquien=$TituloEnvio;
				$mensaje_error=enviarmail_phpmailer($minombre,$mimail,$aquien,$direccion,$asunto,$cuerpo);
				if ($EnvioControl!="") {
					$direccion=$EnvioControl;
					$mensaje_error=enviarmail_phpmailer($minombre,$mimail,$aquien,$direccion,$asunto,$cuerpo);
				}
			}
		}		
		//grabo hasta donde llegó
		if ($debo_grabar_control==true) {
			$tablaEnvioMasivo=$Prefijo."EnvioMasivo";
			$SQL="SELECT * FROM $tablaEnvioMasivo WHERE CategoriaSuscriptorID='$CualCategoria' ";
			$Result=$mysqli->query($SQL);
			$cantreg=mysqli_num_rows($Result);
			if ($cantreg==0) {
				$SQL="INSERT INTO $tablaEnvioMasivo (Nombre,CategoriaSuscriptorID,Registrohasta) ".
					"VALUES ('$asuntomail','$categoriaseleccionada','$numregfinal')";
				$ResultAgregar=$mysqli->query($SQL);
			} else {
				$RegEM=mysqli_fetch_array($Result);
				$idEM=$RegEM['ID'];
				$SQL="UPDATE $tablaEnvioMasivo SET Registrohasta='$numregfinal' WHERE ID='$idEM' ";
				$ResultModificar=$mysqli->query($SQL);
			}
		}
		//fin
		
		echo "<br>";
		echo $ley_enviomasivo." (enviados: ".$enviados."/".$total.", errores: ".$errores.").<br>";
		echo "<br>";
		echo "<a href=\"".$modulo."\">".$bt_volver."</a><br><br><br>";
		echo "</font>";



	}else{ 
		$CualMail=$_POST['mailseleccionado'];
		$CualCategoria=$_POST['categoriaseleccionada'];
	
		$RegIni=$_POST['reginicio'];
		if ($RegIni=="") {
			$tablaEnvioMasivo=$Prefijo."EnvioMasivo";
			$SQL="SELECT * FROM $tablaEnvioMasivo WHERE MailMasivoID='$CualMail' AND CategoriaSuscriptorID='$CualCategoria' ";
			$Result=$mysqli->query($SQL);
			$cantreg=mysqli_num_rows($Result);
			if ($cantreg==0) {
				$RegIni=1;
			} else {
				$RegEM=mysqli_fetch_array($Result);
				$RegIni=$RegEM['Registrohasta']+1;
			}
		}
		$Tanda=$_POST['cantidadtanda'];
		if ($Tanda=="") $Tanda="200";
		
		$EnvioControl=$_POST['mailenviocontrol'];
		$mimail=$EmailDesde;
		$minombre=$EmailDesdeNombre;
		$SQL="SELECT * FROM $tablaMailsMasivos WHERE ID='$CualMail' ";
		$ResultadoMail=$mysqli->query($SQL);
		if ($Registro=mysqli_fetch_array($ResultadoMail)) {
			$asunto=$Registro['Nombre'];
			$asuntomail=stripslashes($Registro['Nombre']);
			$cuerpo=stripslashes($Registro['Contenido']);
			global $tablaSuscriptores;
			$aplicafiltro=$_POST['aplicafiltro'];
			$campofiltro=$_POST['campofiltro'];
			$valorfiltro=$_POST['valorfiltro'];
			if (($aplicafiltro=="si") and ($campofiltro!="")) {
				$debo_grabar_control=false;
				$SQL="SELECT * FROM $tablaSuscriptores WHERE (Publico='1') AND ($campofiltro='%$valorfiltro%') ";
				$ResultadoConsulta=$mysqli->query($SQL);
			} else {
				$debo_grabar_control=true;
				$SQL="SELECT * FROM $tablaSuscriptores WHERE Publico='1' AND CategoriaSuscriptorID='$CualCategoria' ";
				$ResultadoConsulta=$mysqli->query($SQL);
				$total=mysqli_num_rows($ResultadoConsulta);
				$SQL="UPDATE $tablaCategoriaSuscriptores SET Cantidad='$total' WHERE ID='$CualCategoria'";
				$ResultModi=$mysqli->query($SQL);
			}
			echo "<font size=\"1\" face=\"Arial, Helvetica, sans-serif\">";
			$numreg=0;
			$enviados=0;
			$errores=0;
			$cont=0;
			while($Registro=mysqli_fetch_array($ResultadoConsulta)) {
				$numreg++;
				if (($numreg >= $RegIni) and ($enviados < $Tanda)) {
					$display=$Registro['Nombre'];
					if (strlen($display) < 5) $display=$Registro['Empresa'];
					if (strlen($display) < 5) $display=$Registro['Email'];
					echo "(".$numreg.") ".$tit_envioa.": ".$Registro['Email']."<br>";
					$cont++;
					$direccion=$Registro['Email'];
					$aquien=$display;
					$mensaje_error=enviarmail_phpmailer($minombre,$mimail,$aquien,$direccion,$asunto,$cuerpo);
					if ($mensaje_error!="") {
						$errores++;
						echo "<font color=\"#FF0000\"><b>".$mensaje_error.": ".$Registro['Email']."</b></font><br>";
						// pongo en 3 (tres) a ItemPublico al mail que me da error
						$Id=$Registro['ID'];
						$SQL="UPDATE $tablaSuscriptores SET Publico='3' WHERE ID='$Id' ";
						$ResultadoModificacion=$mysqli->query($SQL);
				}
					$enviados++;
					$numregfinal=$numreg;
				}
				if ($cont==100) {
					$cont=0;
					$direccion=$EmailDeControl;
					$aquien=$TituloEnvio;
					$mensaje_error=enviarmail_phpmailer($minombre,$mimail,$aquien,$direccion,$asunto,$cuerpo);
					if ($EnvioControl!="") {
						$direccion=$EnvioControl;
						$mensaje_error=enviarmail_phpmailer($minombre,$mimail,$aquien,$direccion,$asunto,$cuerpo);
					}
				}
			}		
			//grabo hasta donde llegó
			if ($debo_grabar_control==true) {
				$tablaEnvioMasivo=$Prefijo."EnvioMasivo";
				$SQL="SELECT * FROM $tablaEnvioMasivo WHERE MailMasivoID='$CualMail' AND CategoriaSuscriptorID='$CualCategoria' ";
				$Result=$mysqli->query($SQL);
				$cantreg=mysqli_num_rows($Result);
				if ($cantreg==0) {
					$SQL="INSERT INTO $tablaEnvioMasivo (Nombre,CategoriaSuscriptorID,MailMasivoID,Registrohasta) ".
						"VALUES ('$asuntomail','$categoriaseleccionada','$CualMail','$numregfinal')";
					$ResultAgregar=$mysqli->query($SQL);
				} else {
					$RegEM=mysqli_fetch_array($Result);
					$idEM=$RegEM['ID'];
					$SQL="UPDATE $tablaEnvioMasivo SET Registrohasta='$numregfinal' WHERE ID='$idEM' ";
					$ResultModificar=$mysqli->query($SQL);
				}
			}
			//fin
		} else {
			$mensajeerror=$error_nohayregistromail.": ".$CualMail;
			echo $mensajeerror."<br>";		
		}
		echo "<br>";
		echo $ley_enviomasivo." (enviados: ".$enviados."/".$total.", errores: ".$errores.").<br>";
		echo "<br>";
		echo "<a href=\"".$modulo."\">".$bt_volver."</a><br><br><br>";
		echo "</font>";
	}
   
} 
?>
	</td>
  </tr>
</table>
<?php
} else {
?>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td class="listado_titulogeneral" colspan="2">
	<?php
	echo utf8($tit_enviocorreo);
	?>
	</td>
  </tr>
  <tr>
		      <form action="listarTabla.php?tabla=<?php echo $nombreSuscriptores ?>" method="post" name="formsuscriptores">
		      <td width="30%" class="celdatitulo">
			  Tabla de Suscriptores
			  </td>
			  <td width="70%" class="celdainput" align="right">
			  <input name="suscriptores" type="submit" class="admin_botones" value="Suscriptores >>">
		  	  </td>
		      </form>
		    </tr>
		    <tr>
			  <form action="listarTabla.php?tabla=CategoriaSuscriptor" method="post" name="formcategoria">
		      <td width="30%" class="celdatitulo">
			  Tabla de Categorías de Suscriptores
			  </td>
			  <td width="70%" class="celdainput" align="right">
			  <input name="categoriasuscriptor" type="submit" class="admin_botones" value="Categorías de Suscriptores >>">
			  </td>
			  </form>
  		    </tr>
  		    <tr>
			  <form action="listarTabla.php?tabla=MailMasivo" method="post" name="formmails">
    		  <td width="30%" class="celdatitulo">
			  Tabla de E-Mails Grabados
			  </td>
			  <td width="70%" class="celdainput" align="right">
			  <input name="mailsmasivos" type="submit" class="admin_botones" value="Contenidos Grabados >>">
			  </td>
			  </form>
  			</tr>
  <tr>
    <td colspan="2">
	<br>
	<font face="Verdana, Arial, Helvetica, sans-serif" size="3">
	<b>&nbsp;1) Definición del Correo a Enviar</b>
	</font>
	</td>
  </tr>
  <form name="formulariocarga" method="post" action="<?php echo $modulo ?>?accion=grabar">		  
  <tr>			
      		  <td width="30%" class="celdatitulo">
			  Contenido (html)
			  </td>
      		  <td width="70%" class="celdainput">
      		  <textarea name="contenidomail" class="admin_campo" cols="50" rows="10" id="textarea1"><?php //echo trim($Registro['Contenido']) ?></textarea>
      		  <script language="JavaScript1.2">  
	  		  editor_generate('contenidomail');
	  		  </script>
			  </td>
    		</tr>			
    		<tr> 
     		  <td class="celdatitulo">
			  Asunto
			  </td>
    		  <td class="celdainput">
			  <input name="asuntomail" class="admin_campo" type="text" size="60" maxlength="70">
			  </td>
    		</tr>
		    <tr>
   			  <td class="celdatitulo">
			  Resultado
			  </td>
			  <td class="celdainput">
			  <strong>&nbsp;<?php echo $mensajegrabado ?></strong>
			  </td>
			</tr> 
		  	<tr> 
    		  <td>&nbsp;&nbsp;
			  </td> 
			  <td align="right">
			  <input type="submit" name="accion" class="admin_botones" value="Grabar >>">
			  </td>
  </tr>
  </form>
  <tr>
	<td colspan="2">
	<br>
	<font face="Verdana, Arial, Helvetica, sans-serif" size="3">
	<b>&nbsp;2) Envío de un E-mail para testeo</b>
	</font>
	</td>
  </tr>
  <form name="formularioprueba" method="post" action="<?php echo $modulo ?>?accion=probar">
  <tr> 
			  <td width="30%" class="celdatitulo">
			  Seleccione Mail Grabado
			  </td>
    		  <td width="70%" class="celdainput">
			  <select name="mailseleccionado" class="admin_campo">
    		  <option value="0" class="admin_campo">- seleccione -</option>
			  <?php
			  $SQL="SELECT * FROM $tablaMailsMasivos WHERE Publico='1'";
			  $ResultadoConsulta=$mysqli->query($SQL);
			  while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
			     ?>
		    	 <option value="<?php echo $Registro['ID'] ?>" class="admin_campo"><?php echo $Registro['Nombre'] ?></option>
			     <?php
			  }
			  ?>
		      </select>
		      </td>
			</tr>
			<tr>
			  <td class="celdatitulo">
			  E-mail de prueba
			  </td>
			  <td class="celdainput">
			  <input name="maildeprueba" class="admin_campo" type="text" size="60" maxlength="70">
			  </td>
		    </tr>
		    <tr>
		      <td class="celdatitulo">
			  Resultado
			  </td>
		      <td class="celdainput">
			  <strong>&nbsp;<?php echo $mensajeprueba ?></strong>
			  </td>

			</tr> 
			<tr>
			  <td>&nbsp;
			  </td>
			  <td align="right">
			  <input type="submit" name="accion" class="admin_botones" value="Probar >>">
			  </td>
  </tr> 
  </form>   
  <tr>
    <td colspan="2">
	<br>
	<font face="Verdana, Arial, Helvetica, sans-serif" size="3">
	<b>&nbsp;3) Envío a los Suscriptores</b>
	</font>
	</td>
  </tr>
  <form name="formularioenvio" method="post" action="<?php echo $modulo ?>?accion=enviar">
		<tr>			
      		  <td width="30%" class="celdatitulo">
			  Listado de
			  </td>
      		  <td width="70%" class="celdainput">
			<input type="radio" name="listado" value="oferta"> Ofertas &nbsp;
			<input type="radio" name="listado" value="novedad"> Novedades
		  </td> 
    		</tr>			
		<tr>			
      		  <td width="30%" class="celdatitulo">
			  Idioma
			  </td>
      		  <td width="70%" class="celdainput">
			<input type="radio" name="listado_idioma" value="es"> Español &nbsp;
			<input type="radio" name="listado_idioma" value="pt"> Portugués
		  </td> 
    		</tr>			  
  		<tr> 
		<tr>
			  <td width="30%" class="celdatitulo">
			  Seleccione Mail Grabado
			  </td>
			  <td width="70%" class="celdainput">
			  <select name="mailseleccionado" class="admin_campo">
			  <option value="0" class="admin_campo">- seleccione -</option>
			  <?php
			  $SQL="SELECT * FROM $tablaMailsMasivos WHERE Publico='1'";
			  $ResultadoConsulta=$mysqli->query($SQL);
			  while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
		    	 ?>
	          <option value="<?php echo $Registro['ID'] ?>" class="admin_campo"><?php echo $Registro['Nombre'] ?></option>
        	  <?php
		  	  }
			  ?>
    		  </select>
			  </td>
		    </tr>
		    <tr> 
		      <td class="celdatitulo">
			  Seleccione Categoría de los Suscriptores
			  </td>
			  <td class="celdainput">
			  <select name="categoriaseleccionada" class="admin_campo">
			  <option value="0" class="admin_campo">- seleccione -</option>
			  <?php
			  $SQL="SELECT * FROM $tablaCategoriaSuscriptores WHERE Publico='1'";
			  $ResultadoConsulta=$mysqli->query($SQL);
			  while ($Registro=mysqli_fetch_array($ResultadoConsulta)) {
			  ?>
		          <option value="<?php echo $Registro['ID'] ?>" class="admin_campo"><?php echo $Registro['Nombre']." (".$Registro['Cantidad'].")" ?></option>
        		  <?php
			  }
			  ?>
		      </select> 
			  </td>
		    </tr>
			<tr>
			  <td class="celdatitulo">
			  Envío aplicando un filtro
			  </td>
			  <td class="celdainput">
			    <table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <tr>
				    <td width="10%" rowspan="2" valign="top">
					<input type="checkbox" name="aplicafiltro" value="si">
				      <font color="#993333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
					  Sí
					  </strong></font>
					</td>
					<td width="30%" align="right">
				    <font color="#993333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
					campo &nbsp;
					</strong></font>
					</td>
					<td width="60%">
			  		<select name="campofiltro" class="admin_campo">
			  		<option value="0" class="admin_campo">- seleccione -</option>
			  		<?php
					$tablaE=$Prefijo."estructura";
			  		$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$nombreSuscriptores' ORDER BY NombreCampo ASC";
			  		$ResultE=$mysqli->query($SQL);
			  		while ($RegE=mysqli_fetch_array($ResultE)) {
			  	  		?>
				  		<option value="<?php echo $RegE['Nombrecampo']?>" class="admin_campo"><?php echo $RegE['Titulocampo'] ?></option>
				  		<?php
			  		}
			  		?>
			  		</select>
					</td>
				  </tr>
				  <tr>
				    <td align="right">
				    <font color="#993333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
					contenido &nbsp;
					</strong></font>
					</td>
					<td>
					<input type="text" name="valorfiltro" class="admin_campo" size="30" value="">
					</td>
				  </tr>
				</table>
			  </td>
			</tr>
		    <tr> 
		      <td class="celdatitulo">
			  Registro de Inicio
			  </td>
		      <td class="celdainput">
			  <input name="reginicio" class="admin_campo" type="text" size="10" maxlength="10" value="">
			  <br>
		      <font color="#993333" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
		      Si no pone inicio, tomará el último+1 que se haya previamente enviado
			  </strong></font>
			  </td>
		    </tr>
		    <tr> 
		      <td class="celdatitulo">
			  Cantidad por Tanda
			  </td>
		      <td class="celdainput">
			  <input name="cantidadtanda" class="admin_campo" type="text" size="10" maxlength="10" value="200">
			  </td>
		    </tr>
		    <tr> 
		      <td class="celdatitulo">
			  Resultado
			  </td>
		      <td class="celdainput">
			  <strong>&nbsp;<?php echo $mensajeenvio ?></strong>
			  </td>
		    </tr>
		    <tr> 
		      <td>
			  <input type="button" name="volver" onClick="javascript:history.back()" class="admin_botones" value="<< Atrás"> 
		      </td>
		      <td align="right">
			  <input type="submit" name="accion" class="admin_botones" value="Enviar >>"> 
		      </td>
  </tr>
  </form>
</table>
<!-- Aca Termina el Formulario -->
<?php
} //del if ($quehacer=="enviar")
?>

</body>
</html>
