
<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

$respuestaautomatica="Reino Vip PUBLICIDAD";
$gracias="Gracias por contactarte con ".$TituloSitio;
$mensajeenvio="Tu información ha sido guardada con éxito y tu publicación estará en listas despues de la aprobación de nuestro personal.";
$err_errorenvio="No se ha podido enviar su email: ";
$error_nombre="Error: Debe completar su Nombre";
$error_telefono="Error: Debe completar su Teléfono";
$error_email="Error: Debe completar su cuenta de E-Mail";
$error_email_invalido="Error: La cuenta de E-Mail no tiene un formato válido";
	
function enviarmail($myname,$myemail,$contactname,$contactemail,$subject,$message) {
  $headers.="MIME-Version: 1.0\n";
  $headers.="Content-type: text/html; charset=utf-8\n";
  $headers.="X-Priority: 1\n";
  $headers.="X-MSMail-Priority: High\n";
  $headers.="X-Mailer: php\n";
  $headers.="From: \"".$myname."\" <".$myemail.">\n";
  return(mail("\"".$contactname."\" <".$contactemail.">",$subject,$message,$headers));
}

	function formatearTexto($texto,$swNombre)
	{
		$patrones = array('@,{2,}@i', '@\.{2,}@i', '@ {2,}@i');
		$sustituciones = array(',', '.', ' ');
		 
		$textoFormato=preg_replace($patrones, $sustituciones, $texto);
		$textoFormato = mb_strtolower($textoFormato,"UTF-8");
		if($swNombre)
		{$textoFormato = ucwords($textoFormato);}
		else
		{$textoFormato = ucfirst($textoFormato);}
		return $textoFormato;
	}
	//print_r($_POST);die();
	if(!empty($_POST['f_nombre'])){
				
				//print_r($_FILES);
				//print_r($_POST);die();
	

	$f_nombre=formatearTexto($_POST["f_nombre"],true);
	$f_titulo=$f_nombre;
	$f_edad=$_POST["f_edad"];
	$f_categoria=$_POST["f_categoria"];
	$f_telefono=$_POST["f_telefono"];
	$f_email=$_POST["f_email"];
	$f_pais=$_POST["f_pais"];
	$f_provincia=$_POST["f_provincia"];
	$f_ciudad=$_POST["f_ciudad"];
	$f_descripcion=formatearTexto($_POST["f_descripcion"],false);
	$f_especificaciones=$_POST["f_especificaciones"];
	$f_fechaReg=date("Y-m-d");
	$f_medidas=$_POST["f_medidas"];
	$f_peso=$_POST["f_peso"];
	$f_altura=$_POST["f_altura"];
	$f_nacionalidad=$_POST["f_nacionalidad"];
	$f_ojos=$_POST["f_ojos"];
	$f_pelo=$_POST["f_pelo"];
	$f_idiomas=$_POST["f_idiomas"];
	$f_horarios=$_POST["f_horario"];
}
$mensaje="";
$urlCliente="";
$urlClientePanel="";
$idInsert=0;

	if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
        $captcha_message="Texto de imagen inválido.";
    } else {
        $captcha_message = "";
			$dat='abcdefghijklmnpqrstuvwxyz123456789';
			$random1 = mt_rand(0,33);
			$random2 = mt_rand(0,33);
			$random3 = mt_rand(0,33);
			$random4 = mt_rand(0,33);
			$random5 = mt_rand(0,33);
			$genPass=$dat[$random1].$dat[$random2].$dat[$random3].$dat[$random4].$dat[$random5];
			$sqlCli="insert into reino01_Escort(Publico,Usuario,Contrasenia,Nombre,Titulo,Edad,Email,CategoriaID,
				Telefono,Comentario,PaisID,ProvinciaID,CiudadID,fechaPublicacion,Especificaciones,fecha_registro,
				Medidas,peso,Altura,Nacionalidad,ojos,pelo,Idioma,Horario)
				values('3','$f_email','$genPass','$f_nombre','$f_titulo','$f_edad','$f_email','$f_categoria',
				'$f_telefono','$f_descripcion','$f_pais','$f_provincia','$f_ciudad','$f_fechaReg','$f_especificaciones',
				NOW(),'$f_medidas','$f_peso','$f_altura','$f_nacionalidad','$f_ojos','$f_pelo','$f_idiomas','$f_horario')";
			if($mysqli->query($sqlCli))
			{
				$idInsert=mysql_insert_id();
				$idEscort=$idInsert;
				$contCantFotos = 0;
				

				/*******************************************************/
				$Item=$idInsert;
				$tablaGuardarFP=$Prefijo."escort_formas_pagos_registro";
				$tablaFP=$Prefijo."escort_formas_pagos";
				$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
		
				while($arryFP = mysql_fetch_array($sqlFP))
				{
					$idFP=$arryFP["ID"];
					if(isset($_POST['FP_'.$idFP]) && $_POST['FP_'.$idFP]==1)
					{
						$mysqli->query("INSERT INTO $tablaGuardarFP (ID_escort,ID_forma_pago)values('".$Item."','".$arryFP["ID"]."')");
					}
				}
					
				$tablaGuardarLA=$Prefijo."escort_lugares_atencion_registro";
				$tablaLA=$Prefijo."escort_lugares_atencion";
				$sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");
		
				while($arryLA = mysql_fetch_array($sqlLA))
				{
					$idLA=$arryLA["ID"];
					if(isset($_POST['LA_'.$idLA]) && $_POST['LA_'.$idLA]==1)
					{
						$mysqli->query("INSERT INTO $tablaGuardarLA (ID_escort,ID_lugar_atencion)values('".$Item."','".$arryLA["ID"]."')");
					}
				}
			
				$tablaGuardarS=$Prefijo."escort_servicios_registro";
				$tablaS=$Prefijo."escort_servicios";
				$sqlS = $mysqli->query("select * from $tablaS where Publico='1'");
		
				while($arryS = mysql_fetch_array($sqlS))
				{
					$idS=$arryS["ID"];
					if(isset($_POST['S_'.$idS]) && $_POST['S_'.$idS]==1)
					{
						$mysqli->query("INSERT INTO $tablaGuardarS (ID_escort,ID_servicio)values('".$Item."','".$arryS["ID"]."')");
					}
				}
				/*******************************************************/

				
				
				foreach ($_FILES["foto"]["error"] as $key => $error) {
					if ($error == UPLOAD_ERR_OK) {
						$contCantFotos++;
						$tmp_name = $_FILES["foto"]["tmp_name"][$key];
						$archivo=$_FILES['foto']['name'][$key];
						$arryArchivo=explode(".",$archivo);
						$ext=$arryArchivo[1];
						
						if($contCantFotos==1)
						{
							$imgPincipal=1;
						}
						else
						{
							$imgPincipal=0;
						}
						
						$SQLGP="insert into reino01_foto_escort(IdEscort,Principal) 
									values ('$idEscort','$imgPincipal')";	
						$mysqli->query($SQLGP);
						$idImg=mysqli_insert_id();
						
						$medio=$idEscort."_".$idImg.".".$ext;   
						$target_path = "fotos/".$medio;
			   
						if(@move_uploaded_file($tmp_name, $target_path))
						{
							$SQLMP="update reino01_foto_escort set Imagen='$medio' where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}
						else
						{
							$SQLMP="delete from reino01_foto_escort where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}
					}
				}

				$mensaje="Ahora sube tus fotos para tener mas presentación ";
				$sqlDat="update reino01_Escort set IDusuario=$idInsert where ID='$idInsert'";
				$mysqli->query($sqlDat);
				
				$urlCliente=$URLSitio."escort/".urls_amigables(retornarNombre("reino01_Ciudad", $f_ciudad))."/".$idInsert."/".urls_amigables($f_nombre).".php";
				
			/*	$asunto="Anuncio Nuevo Pendiente de Aprobación - ".$NombreSitio;
				$cuerpo="<font color='#000000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>";
				$dd=date(d);
				$mm=date(m);
				$aaaa=date(Y);
				$cuerpo.="<img src='http://i.minus.com/ioUvcmH9L7c3K.png' height='155px'><br><br>";
				$cuerpo.="<div align=\"right\">".$LocalidadSitio.", ".$dd."/".$mm."/".$aaaa."</div><hr>";
				$cuerpo.="Nombre: ".$f_nombre."<br>";
				$cuerpo.="Categoria: ".retornarNombre("reino01_Categoria", $f_categoria)."<br>";
				$cuerpo.="Teléfono: ".$f_telefono."<br>";	
				$cuerpo.="Email: ".$f_email."<br>";	
				$cuerpo.="País: ".retornarNombre("reino01_Pais", $f_pais)."<br>";
				$cuerpo.="Provincia: ".retornarNombre("reino01_Provincia", $f_provincia)."<br>";	
				$cuerpo.="Ciudad: ".retornarNombre("reino01_Ciudad", $f_ciudad)."<br>";	
				$cuerpo.="Descripción: ".$f_descripcion."<br>";
				$cuerpo.="URL de publicación: <a href=".$urlCliente.">".$urlCliente."</a><br>";
				$cuerpo.="ip: ".$_SERVER['REMOTE_ADDR']."<br>";
				$cuerpo.="</font>";
				$err.=enviarmail($f_nombre,$EmailSitio,$NombreSitio,"mauricio.ayllon@gmail.com",$asunto,$cuerpo);
				if ($err > "1") {
					$mensaje="Error: ".$err.". ".$err_errorenvio.$cuentaemail;
				} else {
					$mensaje=$gracias;
				}*/

				$from = "publicidad@reinovip.com";
		        $to = "gerencia@reinovip.com,publicidad@reinovip.com";
		        $subject = "Anuncio Nuevo Pendiente de Aprobación - ".$NombreSitio;
		        $cuerpo="<font color='#000000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>";
		        $cuerpo.="<img src='http://i.minus.com/ioUvcmH9L7c3K.png' height='155px'><br><br>";
				$cuerpo.="<div align=\"right\">".$LocalidadSitio.", ".$dd."/".$mm."/".$aaaa."</div><hr>";
				$cuerpo.="Nombre: ".$f_nombre."<br>";
				$cuerpo.="Categoria: ".retornarNombre("reino01_Categoria", $f_categoria)."<br>";
				$cuerpo.="Teléfono: ".$f_telefono."<br>";	
				$cuerpo.="Email: ".$f_email."<br>";	
				$cuerpo.="País: ".retornarNombre("reino01_Pais", $f_pais)."<br>";
				$cuerpo.="Provincia: ".retornarNombre("reino01_Provincia", $f_provincia)."<br>";	
				$cuerpo.="Ciudad: ".retornarNombre("reino01_Ciudad", $f_ciudad)."<br>";	
				$cuerpo.="Descripción: ".$f_descripcion."<br>";
				$cuerpo.="URL de publicación: <a href=".$urlCliente.">".$urlCliente."</a><br>";
				$cuerpo.="ip: ".$_SERVER['REMOTE_ADDR']."<br>";
				$cuerpo.="</font>";

		       $headers  = "From:".$from."\r\n";
    		   $headers .= "Content-type: text/html\r\n"; 
		       
  
		        mail($to,$subject,$cuerpo, $headers);
				//mandamos 1 envio de recibido por mail 
				
				$urlClientePanel=$URLSitio."modificar.php";
				
				$asunto=$respuestaautomatica;
				$cuerpo="<img src='http://i.minus.com/ioUvcmH9L7c3K.png' height='155px'><br><br>";
				$cuerpo.="<div align='center'>";
				$cuerpo.="<font color='#000000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>";
				$cuerpo.=$gracias."<br>";
				$cuerpo.=$mensajeenvio."<br><br>";
				$cuerpo.="Aqui podras ver tu publicación<br>";
				$cuerpo.="<a href=".$urlCliente.">".$urlCliente."</a>";
				$cuerpo.="<br><br>";
				$cuerpo.="Aqui podras modificar tu información<br>";
				$cuerpo.="<a href=".$urlClientePanel.">".$urlClientePanel."</a><br>";
				$cuerpo.="</font>";
				$cuerpo.="</div>";
				$cuerpo.="<br>Tu usuario y contraseña para poder modificar tu información es:<br>";
				$cuerpo.="Usuario: ".$f_email."<br>";
				$cuerpo.="Contraseña: ".$genPass."<br>";
				$cuerpo.="<br><br><p style='color:#003300; font-weight:bold; font-family:Georgia, `Times New Roman`, Times, serif'>Publicidad Reino Vip<br>Call Center 983 44 00 77 - Atención al cliente</p>";
				$err.=enviarmail($NombreSitio,$EmailSitio,$f_nombre,$f_email,$asunto,$cuerpo);
				
				session_register('idlog');		
				$_SESSION['idlog']=$idInsert;
				header("Location: registro_final.php");

			}
		}
	}
	
	function retornarNombre($tabla, $id)
	{
		$sql="select Nombre from $tabla where ID='$id'";
		$exSql=$mysqli->query($sql);
		$cantReg=mysqli_num_rows($exSql);
		if($cantReg>0)
		{
			$arry=mysqli_fetch_array($exSql);
			return $arry["Nombre"];
		}
		return "";
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $TituloSitio; ?></title>
  <meta name="description" content="Guía Erótica de España donde encontraras acompañantes vip, chicas, escorts, travestis, eros,  etc.  Publica tu anuncio GRATIS">
  <meta name="keywords" content="acompañantes vip, chicas, escorts, travestis, eros, gays, chicas en las palmas, transexuales,">

	<link href="css/formulario.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/dropzone.css" rel="stylesheet" type="text/css" />
	<link href="css/cropper.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery.validate.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/CssRegistro.css?v=2.1" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" rel="stylesheet" type="text/css" />
	

	<script src="js/ajax.js?v=2.0" type="text/javascript"></script>
	
	
	<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="js/jquery.validate.js" type="text/javascript"></script>

	<script src="js/dropzone.js" type="text/javascript"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" type="text/javascript"></script>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="<?php echo $URLSitio?>css/jqueryscrollTo-min.js" type="text/javascript"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- ####### ED- ######## -->
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <link rel="stylesheet" href="css/CssIndex.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />   

<?php 
  include ('cabecera.php');
  
?>
<style>
								
					

								/* .container {
								display: flex;
								justify-content: center;
								align-items: center;
								}
					
					
					
								h2 {
								text-align: center;
								margin-bottom: 20px;
								color: #333;
								} */
					
								.input-group {
								margin-bottom: 20px;
								width: 100%;
								}
					
								.input-group label {
								font-size: 14px;
								color: #666;
								}
					
								.input-group input {
								width: 100%;
								padding: 12px;
								border: 1px solid #ddd;
								border-radius: 5px;
								margin-top: 5px;
								font-size: 14px;
								}
					
								.input-group input:focus {
								border-color: #78787a;
								outline: none;
								}
					
								.error-message {
								color: red;
								font-size: 12px;
								margin-top: 5px;
								}
					
								.submit-btn {
  width: 190px !important;
  padding: 12px;
  background-color: #78787a !important;
  border: none;
  color: white !important;
  font-size: .8rem;
  cursor: pointer;
  border-radius: 5px;
}
.select2-container .select2-selection--single{
	height:35px !important;
}
					
								.forgot-password {
								text-align: center;
								margin-top: 10px;
								}
					
								.forgot-password a {
								color: #00a850;
								text-decoration: none;
								}
					
								.forgot-password a:hover {
								text-decoration: underline;
								}
					
								.signup-link {
								text-align: center;
								margin-top: 15px;
								}
					
								.signup-link a {
								color: #00a850;
								text-decoration: none;
								}
					
								.signup-link a:hover {
								text-decoration: underline;
								}
					
								@media (max-width: 480px) {
								.login-box {
									padding: 20px;
									display: inline-block;
									margin:0 !important;
									width:92% !important;
								}
								.submit-btn{
									width: 170px  !important;
									display:inline-block;
								}
								.ci-user-picture{
									margin-left: -10px;
								}
								.services{
									min-height:350px;
									padding: 0px;
									box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
									width: 86%;
									max-width: 86%;
									margin-top: 29px;
									padding-top: 10px;
								}
								}
								@media (min-width: 992px) {
									.col-lg-9 {
									margin-left:120px;
									}
									.services{
					margin-left:17px; 
					min-height:350px;
					padding: 0px;
					box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
					width: 96%;
					max-width: 100%;
					margin-top: 10px;
					padding-top: 29px;
					padding-left:50px;
				}
									}
									.form-group label{
										font-size:.8rem;
									}
.form-control {
    height: 35px !important;
}

@media (max-width: 480px) {
    .login-box {
        padding: 20px;
        margin: 10px !important;
    }
    .titulo {
        color: #793a57;
        font-size: 1.1rem;
        text-transform: uppercase;
        padding: 0 20px;
    }

    .form-control {
        width: 350px !important;
    }
}

.services {
    min-height: 350px;
    padding: 0px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    width: 96%;
    max-width: 100%;
    margin-top: 10px;
    padding-top: 10px;
    margin-left: 17px;
}

.titulo {
    text-align: left;
    color: #793a57;
    font-size: 1.1rem;
    margin-top: 35px;
    text-transform: uppercase;
}

@media (min-width: 992px) {
    .form-control {
        width: 200px !important;
    }

    .services {
        margin-left: 17px;
        min-height: 350px;
        padding: 0px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        width: 96%;
        max-width: 100%;
        margin-top: 10px;
    }
}  
.filepreviewprofile {
 /**   position: absolute;
    top: 0;
    right: 30px;
    width: 100%;
    height: 250px; */
    opacity: 0;
}
.ci-user-picture {
    min-width: 250px;
    margin-right: 16px;
    display: inline-block;
}
.ci-user-picture {
    width: 250px;
    
    border-radius: 50%;
}  
.btn-default {
    display: inline-block;
    padding: 14px 32px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    transition: 0.5s;
    text-align: center;
    text-transform: capitalize;
}              
</style>
		<script language="JavaScript">
 	
		function validar() {			
		var regex=new RegExp("^[^@ ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|gov|mil|org|edu|int|biz|info|name|pro)$");
			if (document.getElementById("f_nombre").value=="") {
				alert("Ingresa tu nombre...");
				document.getElementById("f_nombre").focus();
				return false;
			}
			if (document.getElementById("f_edad").value=="") {
				alert("Ingresa tu edad...");
				document.getElementById("f_edad").focus();
				return false;
			}
			if (!Number(parseInt(document.getElementById("f_edad").value))) {
				alert("Tu edad debe ser numerico...");
				document.getElementById("f_edad").focus();
				return false;
			}
			if (document.getElementById("f_categoria").options[document.getElementById("f_categoria").selectedIndex].value=="0") {
				alert("Selecciona una categoria...");
				document.getElementById("f_categoria").focus();
				return false;
			}
			if (document.getElementById("f_telefono").value=="") {
				alert("Ingresa el teléfono a publicar...");
				document.getElementById("f_telefono").focus();
				return false;
			}
			if (document.getElementById("f_email").value=="") {
				alert("Ingresa tu E-mail...");
				document.getElementById("f_email").focus();
				return false;
			}
			if (regexoceanovirtual.es(document.getElementById("f_email").value)==false) {
				alert("Tu E-mail no es correcto...");
				document.getElementById("f_email").focus();
				return false;
			}	
			if (document.getElementById("f_pais").options[document.getElementById("f_pais").selectedIndex].value=="0") {
				alert("Selecciona un pais...");
				document.getElementById("f_pais").focus();
				return false;
			}
			if (document.getElementById("f_provincia").options[document.getElementById("f_provincia").selectedIndex].value=="0") {
				alert("Selecciona una provincia...");
				document.getElementById("f_provincia").focus();
				return false;
			}
			if (document.getElementById("f_ciudad").options[document.getElementById("f_ciudad").selectedIndex].value=="0") {
				alert("Selecciona una ciudad...");
				document.getElementById("f_ciudad").focus();
				return false;
			}
		
			
			if (document.getElementById("f_medidas").value=="") {
				alert("Ingresa tus medidas...");
				document.getElementById("f_medidas").focus();
				return false;
			}
			if (document.getElementById("f_peso").value=="") {
				alert("Ingresa tu peso...");
				document.getElementById("f_peso").focus();
				return false;
			}
			if (document.getElementById("f_altura").value=="") {
				alert("Ingresa tu altura...");
				document.getElementById("f_altura").focus();
				return false;
			}
			if (document.getElementById("f_nacionalidad").value=="") {
				alert("Ingresa tu nacionalidad...");
				document.getElementById("f_nacionalidad").focus();
				return false;
			}
			if (document.getElementById("f_ojos").value=="") {
				alert("Ingresa el color de tus ojos...");
				document.getElementById("f_ojos").focus();
				return false;
			}
			if (document.getElementById("f_pelo").value=="") {
				alert("Ingresa el color de tu pelo...");
				document.getElementById("f_pelo").focus();
				return false;
			}
			if (document.getElementById("f_idiomas").value=="") {
				alert("Ingresa los idiomas que hablas...");
				document.getElementById("f_idiomas").focus();
				return false;
			}
			if (document.getElementById("f_horario").value=="") {
				alert("Ingresa los horarios en que trabajas...");
				document.getElementById("f_horario").focus();
				return false;
			}

			if (document.getElementById("f_descripcion").value=="") {
				alert("Ingresa el texto a publicar...");
				document.getElementById("f_descripcion").focus();
				return false;
			}
			if (document.getElementById("captcha-form").value=="") {
				alert("Ingresa el texto de la imagen...");
				document.getElementById("captcha-form").focus();
				return false;
			}
			var swFotos=0;
			var foto="";
			for(recImg=1;recImg<=10;recImg++)
			{
				foto=document.getElementById("foto"+recImg).value;
				if(foto!="")
				{
					swFotos++;
				}
			}
			
			if(swFotos==0)
			{
				alert("Debe seleccionar al menos 1 foto...");
				return false;
			}

			document.getElementById("formC").submit();
		}

	function fotos(id) {
	 var ajax;
		ajax = ajaxFunction();
		ajax.open("POST", 'ver_fotos.php', true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		ajax.onreadystatechange = function() {
			if (ajax.readyState==1){
				document.getElementById('mostrarFotos').innerHTML = " Aguarde por favor...";
					 }
			if (ajax.readyState == 4) {
					document.getElementById('mostrarFotos').innerHTML=ajax.responseText;
				 }} 
		ajax.send('id='+id);
	}
	
	function videos(id) {
	 var ajax;
		ajax = ajaxFunction();
		ajax.open("POST", 'ver_videos.php', true);
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
		  document.getElementById('f1_upload_form').style.visibility = 'visible';
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
	
	function principalFotos(id,idEscort) {
	if(confirm("Esta seguro que desea convertir la imagen seleccionada como principal???"))
	{
		 var ajax;
			ajax = ajaxFunction();
			ajax.open("POST",'administrador/principalFotos.php', true);
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
			ajax.open("POST",'administrador/principalVideos.php', true);
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
			ajax.open("POST", 'administrador/eliminarFotos.php', true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			
			ajax.onreadystatechange = function() {
				if (ajax.readyState==1){
					document.getElementById('mostrarFotos').innerHTML = " Aguarde por favor...";
						 }
				if (ajax.readyState == 4) {
						if(ajax.responseText == "")
						{fotos(idEscort);}
						else
						{alert(ajax.responseText);}
					 }} 
			ajax.send('id='+id+'&idEscort='+idEscort);
		}
	}
	
	function eliminarVideos(id,idEscort) {
	if(confirm("Esta seguro que desea eliminar el video seleccionado???"))
	{
		 var ajax;
			ajax = ajaxFunction();
			ajax.open("POST", 'administrador/eliminarVideos.php', true);
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
	
	function contarCaracteres(){
    document.getElementById('numcar').childNodes[0].data = document.getElementById("f_descripcion").value.length + " de 400 caracteres";
    if (document.getElementById("f_descripcion").value.length > 400)
        document.getElementById("f_descripcion").value = document.getElementById("f_descripcion").value.substring(0, 400);
	}
		</script>
<!-- Cards -->
<div class="container mt-4">
   <div class="content-container">
		<div class="container login-box" style="border-radius:5px;margin-top:35px;">
		
				<div class="row">
					<!-- <form class="formRegistro" action="subir.php"  name="formC" id="formC" method="post" onsubmit=" validar(); return false;" enctype="multipart/form-data">-->
					
					<form class="formRegistro" action="subir.php"  name="formC" id="formC" method="POST" onsubmit="" enctype="multipart/form-data">
						<div class="">
							<div class="col-lg-12">
								<h2 class="titulo" style="text-align:center;color:#793a57;font-size:18px;margin-top:29px;text-transform:uppercase;">Utiliza este formulario para subir tus anuncios</h2>
							</div>
						</div> 	
						<div class="col-lg-4">
							<div class="form-group">
								<label for="categoria">Categoria:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<select name="f_categoria" class="form-control" id="f_categoria" style="height: 35px !important;width: 80% !important;">
									<option value="0" >---o---</option>
										<?php
										$catT=$Prefijo."Categoria";
										$SQLcat="SELECT * FROM $catT WHERE Publico=1 ORDER BY Nombre";
										$catT=$Prefijo."Categoria";
										
								
										$ResultCat=$mysqli->query($SQLcat);
										while ($categoria=mysqli_fetch_array($ResultCat)){
											if($categoria['ID']==$f_categoria){ ?>
												<option value="<?php echo $categoria['ID']?>" selected="selected" ><?php echo $categoria['Nombre']?></option>
											<?php } else {?>
												<option value="<?php echo $categoria['ID']?>" ><?php echo $categoria['Nombre']?></option>
									<?php }} ?>
								</select>
							</div>
						</div>
							<div class="col-lg-4">
							<div class="form-group">
								<label for="nombre">Nombre (Sin Adjetivos):<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<input type="text" value="" class="form-control form_celdainput" style="height: 35px !important;width: 80% !important;" maxlength="20" id="f_nombre" name="f_nombre">
							</div>
						</div>
						
						
						<div class="col-lg-4">
							<div class="form-group" style="text-align:left;display:inline-block">
							<div style="float:left;width:130px;">
								<label for="fono">Tel&eacute;fono a publicar:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<input name="f_telefono" id="f_telefono" style="height: 35px !important;width: 130px !important;" type="text" class="form-control form_celdainput" maxlength="9" />
								</div>
								<div style="float:left;width:100px;margin-top: 16px;margin-left: 10px;">
								<input style="width:10px;" type="checkbox" name="f_whatsapp" id="f_whatsapp" value="1"/><img src="img/wp.png" style="width:14px;margin: 0 4px;"><label style="width:65px;font-size:.7rem;">Whatsapp </label>
								<input style="width:10px;margin-top:0px;" type="checkbox" name="f_telegram" id="f_telegram" value="1"/><img src="img/tg.png" style="width:14px;margin: 0 4px;"><label style="width:65px;font-size:.7rem;">Telegram </label>
								</div>
							</div>
						</div>
						<div style="clear:both"></div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="edad">Edad:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<select name="f_edad" id="f_edad" style="width: 80% !important;" class="edad form-control">
									<option value=""></option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
									<option value="32">32</option>
									<option value="33">33</option>
									<option value="34">34</option>
									<option value="35">35</option>
								</select>
								
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
							<label for="atencion">Lugares de atenci&oacute;n:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								 <select name="f_lugares[]" id="f_lugares" class="lugares form-control" multiple="multiple" style="width: 80% !important;height:35px !important;">
                                       
                                   								
                                    <?php 
                                        $tablaLA=$Prefijo."escort_lugares_atencion";
                                        $tablaLAReg=$Prefijo."escort_lugares_atencion_registro";
                                        $sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");
                                        
                                        while($arryLA = mysqli_fetch_array($sqlLA)):
                                            $checkLA=0;
                                            $nomCampLA="LA_".$arryLA["ID"];
                                            if(isset($_POST[$nomCampLA]) && $_POST[$nomCampLA]==1)
                                            {$checkLA=1;}?>
                                        
                                    ?>
                                    <option value="<?php echo $arryLA["ID"];?>"><?php echo $arryLA["Nombre"]?></option>
                                    
                                    <?php endwhile;?>
                                    </select>										
								
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="horarios">Horarios de trabajo:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<input name="f_horario" id="f_horario" type="text" maxlength="40"  class="form-control form_celdainput" style="height: 35px !important;width: 80% !important;" />
							</div>
						</div>
						<div class="col-lg-12">
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="pais">Pais:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<select name="f_pais" class="form-control form_selector pais" id="f_pais" onchange="verProvincias(this.value,0)" style="height: 35px !important;width: 80% !important;">
									
									<?php
										$paisSeleccionado=$f_pais;
										$PaisT=$Prefijo."Pais";
										$SQL="SELECT * FROM $PaisT WHERE Publico=1 AND ID= '41' ORDER BY Nombre";
										$Result=$mysqli->query($SQL);
										while ($Pais=mysqli_fetch_array($Result)){
											if($Pais['ID']==41){ 
											$paisSeleccionado=$Pais['ID'];
											?>
											<option value="<?php echo $Pais['ID']?>" selected="selected"><?php echo $Pais['Nombre']; ?></option>
											<?php } else {?>
											<option value="<?php echo $Pais['ID']?>"><?php echo $Pais['Nombre']; ?></option>
									<?php }} ?>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="provincia">Provincia:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<select name="f_provincia" id="f_provincia" onChange="verCiudades(this.value,0)" class="form-control form_selector f_provincia" id="f_provincia" disabled="disabled" style="height: 35px !important;width: 80% !important;margin-left:10px;">
									<option value="0">---o---</option>
								</select>&nbsp;&nbsp;<img src="images/cargando.gif" width="15" height="15" style="display:none" id="cargProv" />
								
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="ciudad">Ciudad:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
								<select name="f_ciudad" class="form-control form_selector f_ciudad" id="f_ciudad" disabled="disabled" style="height: 35px !important;width: 80% !important;">
									<option value="0">---o---</option>
								</select>&nbsp;&nbsp;<img src="images/cargando.gif" width="15" height="15" style="display:none" id="cargCiu" />
								
							</div>
						</div>
						
						
						<div class="col-lg-12">
						<div class="content">
							<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<div class="confirm-identity">
									
									<div class="ci-user-btn text-center mt-4">
									<div class="ci-user d-flex align-items-center justify-content-center">
										
									</div>
										<a style="width:100%;color:#793a57 !important; !important;" href="javascript:;" class="userEditeBtn btn-default bg-blue position-relative" href="#">
											<div class="ci-user-picture" style="float:left;">
												<img style="width:120px;border: 2px solid #000;border-radius:5px;" src="/img/fondo-chica.jpg" id="item-img-output" data-src="" class="imgpreviewPrf img-fluid" alt="">
											</div>
											<input type="file" id="imagen_principal1" class="item-img file center-block filepreviewprofile" style="display:inherit;" multiple name="file">
											<p style="text-align:center;">
											SUBE TU IMAGEN PRINCIPAL
											</p>
											<div class="login-box" style="width:400px;float:right;border-radius:5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
											<p style="text-align:center;margin-top:30px;">
												<span styl class="submit-btn">Selecciona tu archivo o Sube tu foto ahora</span>
											</p><br>
											<p style="text-align:center;">
												Arrastra tu archivo aqui
											</p>
											</div>
										</a>
										
									</div>
									</div>
									
									
								</div>
								</div>
							</div>
							</div>

							<div class="modal fade cropImageModal" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<button type="button" class="close-modal-custom" data-dismiss="modal" aria-label="Close"><i class="feather icon-x"></i></button>
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-body p-0">
									<div class="modal-header-bg"></div>
									<div class="up-photo-title">
									<h3 class="modal-title">Subir foto de perfil</h3>
									</div>
									<div class="up-photo-content pb-5">
									<div id="upload-demo" class="center-block">
										<!-- <h5><i class="fas fa-arrows-alt mr-1"></i> Drag your photo as you require</h5>-->
									</div>
									<div class="upload-action-btn text-center px-2">
										<button type="button" id="cropImageBtn" class="btn btn-default btn-medium bg-blue px-3 mr-2">Guardar foto</button>
										<!-- <button type="button" class="btn btn-default btn-medium bg-default-light px-3 ml-sm-2 replacePhoto position-relative">Replace Photo</button>-->
									</div>
									</div>
								</div>
								</div>
							</div>
							</div>
						</div>
						
						<div class="col-lg-12">
							
						</div>
						
						<div class="col-lg-12">
						<div class="form-group">
							<label for="peso">Texto a publicar:<span class="campObligatorio">&nbsp;&nbsp;* </span><span id="numcar" class="texto"></span></label>
							
							<textarea style="height:100px;width:96% !important;" name="f_descripcion" id="f_descripcion" cols="70" rows="6" maxleng class="form-control-2 form_campo_comentarios"></textarea>
						</div>
						</div>
						<div class="col-lg-12">
						</div>
						<div class="col-lg-12">
							
							<div class="form-group">
								<label for="peso">Servicios:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
							</div>
							<div class="form-group services" style="border-radius:5px;">
								
								<?php 
								$tablaS=$Prefijo."escort_servicios";
								$tablaSReg=$Prefijo."escort_servicios_registro";
								
								$sqlS = $mysqli->query("select * from $tablaS where Publico='1'");
								
								while($arryS = mysqli_fetch_array($sqlS))
								{
									$checkS=0;
									$nomCampS="S_".$arryS["ID"];
									if(isset($_POST[$nomCampS]) && $_POST[$nomCampS]==1)
									{$checkS=1;}
									echo "<div class='col-lg-4'><div style='display: inline;color: #555;background: none;background-image: none;border:none;box-shadow: none;' class='form-control checkEspecificacion3'><label><input style='width:auto;' type='checkbox' id='S_".$arryS["ID"]."'  name='S_".$arryS["ID"]."' value='1' ".($checkS==1 ? "checked='checked'" : "").">&nbsp;&nbsp;".mb_convert_encoding($arryS["Nombre"],'UTF-8')."</label></div></div>";
								}
							?> 
							</div>
							
						</div>
						<div class="col-lg-12">
							<div class="contSubirFoto" style="margin-left:15px;margin-top:10px;">
								<div class="form-group">
									<label for="fotos">IMAGENES PARA GALERIA FOTOGRAFICA</label>
									<div class="dropzone" id="my-dropzone" name="mainFileUploader" style="width:98%;">
										<div class="fallback">
											<input name="file[]" type="file" multiple />
										</div>
										<span style="text-align:center;">SUBIR MAS FOTOS</span><br>
									</div>  
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<hr>
							<h2 class="titulo" style="text-align:left;color:#793a57;font-size:18px;margin-top:29px;">INFORMACION OPCIONAL </h2>
						</div>
						
						<div class="col-lg-4">
						
							<div class="form-group">
								<label for="idiomas">Idiomas:</label><br>
								<select nam="f_idiomas[]" id="f_idiomas" class="idioma form-control" multiple="multiple" style="height: 35px !important;width: 80% !important;">
									<?php 
									$sql = $mysqli->query("select * from reino01_escort_idiomas where publico='1'");
									
									while($data = mysqli_fetch_array($sql)):
										$idIdioma = $data["ID"];?>
										
										<option value="<?php echo $data["ID"];?>"><?php echo $data['Nombre']?></option>
									
										<?php endwhile;?>
									
								</select>
							</div>
						</div>
						

						<!-- <div class="col-lg-4">
						<div class="form-group">
							<label for="email">E-mail (No se publicar&aacute;):<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
							<input name="f_email" id="f_email" type="text" maxlength="40"  class="form-control form_celdainput"  />
						</div>
						</div> -->
						
						
					<div class="col-lg-4">
						<div class="form-group">
							<label for="pago">Formas de pago:</label>
								<select name="f_forma_pago[]" id="f_forma_pago" class="forma_pago form-control" multiple="multiple" style="height: 35px !important;width: 80% !important;">
								<?php $sql = $mysqli->query("select * from reino01_escort_formas_pagos where publico='1'");
									
									while($data = mysqli_fetch_array($sql)):?>
										<option value="<?php echo $data["ID"];?>"><?php echo $data['Nombre']?></option>;
								<?php endwhile;?>
								</select>	
								
								
						</div>
					</div>

						<div class="col-lg-4">
						<div class="form-group">
							<label for="medidad">Medida (Ejem: 90-60-90):</label>
							<input name="f_medidas" id="f_medidas" type="text" maxlength="20" class="form-control form_celdainput" style="height: 35px !important;width: 80% !important;" />
						</div>
						</div>
						<div class="col-lg-12">
						</div>							
						<div class="col-lg-4">
						<div class="form-group">
							<label for="altura">Altura:</label>
							<select name="f_altura" id="f_altura" class="altura form-control form_celdainput" style="height: 35px !important;width: 80% !important;" >
								<option value=""></option>
								<option value="130">130 cm / 4'3''</option>
								<option value="131">131 cm / 4'4''</option>
								<option value="132">132 cm / 4'4''</option>
								<option value="133">133 cm / 4'4''</option>
								<option value="134">134 cm / 4'5''</option>
								<option value="135">135 cm / 4'5''</option>
								<option value="136">136 cm / 4'6''</option>
								<option value="137">137 cm / 4'6''</option>
								<option value="138">138 cm / 4'6''</option>
								<option value="139">139 cm / 4'7''</option>
								<option value="140">140 cm / 4'7''</option>
								<option value="141">141 cm / 4'8''</option>
								<option value="142">142 cm / 4'8''</option>
								<option value="143">143 cm / 4'8''</option>
								<option value="144">144 cm / 4'9''</option>
								<option value="145">145 cm / 4'9''</option>
								<option value="146">146 cm / 4'9''</option>
								<option value="147">147 cm / 4'10''</option>
								<option value="148">148 cm / 4'10''</option>
								<option value="149">149 cm / 4'11''</option>
								<option value="150">150 cm / 4'11''</option>
								<option value="151">151 cm / 4'11''</option>
								<option value="152">152 cm / 4'12''</option>
								<option value="153">153 cm / 5'0''</option>
								<option value="154">154 cm / 5'1''</option>
								<option value="155">155 cm / 5'1''</option>
								<option value="156">156 cm / 5'1''</option>
								<option value="157">157 cm / 5'2''</option>
								<option value="158">158 cm / 5'2''</option>
								<option value="159">159 cm / 5'3''</option>
								<option value="160">160 cm / 5'3''</option>
								<option value="161">161 cm / 5'3''</option>
								<option value="162">162 cm / 5'4''</option>
								<option value="163">163 cm / 5'4''</option>
								<option value="164">164 cm / 5'5''</option>
								<option value="165">165 cm / 5'5''</option>
								<option value="166">166 cm / 5'5''</option>
								<option value="167">167 cm / 5'6''</option>
								<option value="168">168 cm / 5'6''</option>
								<option value="169">169 cm / 5'7''</option>
								<option value="170">170 cm / 5'7''</option>
								<option value="171">171 cm / 5'7''</option>
								<option value="172">172 cm / 5'8''</option>
								<option value="173">173 cm / 5'8''</option>
								<option value="174">174 cm / 5'9''</option>
								<option value="175">175 cm / 5'9''</option>
								<option value="176">176 cm / 5'9''</option>
								<option value="177">177 cm / 5'10''</option>
								<option value="178">178 cm / 5'10''</option>
								<option value="179">179 cm / 5'10''</option>
								<option value="180">180 cm / 5'11''</option>
								<option value="181">181 cm / 5'11''</option>
								<option value="182">182 cm / 5'12''</option>
								<option value="183">183 cm / 6'0''</option>
								<option value="184">184 cm / 6'0''</option>
								<option value="185">185 cm / 6'1''</option>
								<option value="186">186 cm / 6'1''</option>
								<option value="187">187 cm / 6'2''</option>
								<option value="188">188 cm / 6'2''</option>
								<option value="189">189 cm / 6'2''</option>
								<option value="190">190 cm / 6'3''</option>
								<option value="191">191 cm / 6'3''</option>
								<option value="192">192 cm / 6'4''</option>
								<option value="193">193 cm / 6'4''</option>
								<option value="194">194 cm / 6'4''</option>
								<option value="195">195 cm / 6'5''</option>
								<option value="196">196 cm / 6'5''</option>
								<option value="197">197 cm / 6'6''</option>
								<option value="198">198 cm / 6'6''</option>
								<option value="199">199 cm / 6'6''</option>
								<option value="200">200 cm / 6'7''</option>
							</select>
							
						</div>
					</div>
						<div class="col-lg-4">
						<div class="form-group">
							<label for="ojos">Color de ojos:</label>
							<select  name="f_ojos" id="f_ojos" class="ojos form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
								<option value=""> </option>
								<option value="Negro">Negro</option>
								<option value="Azules">Azules</option>
								<option value="Azules-Verde">Azules-Verde</option>
								<option value="Pardos">Pardos</option>
								<option value="Verdes">Verdes</option>
								<option value="Grises">Grises</option>
								<option value="Avellana">Avellana</option>
							</select>
						</div>
						</div>

						<div class="col-lg-4">
						<div class="form-group">
							<label for="peso">Peso:</label>
							
							<select  name="f_peso" id="f_peso" class="peso form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
								<option value=""> </option>
								<option value="40">40 kg / 88 lbs   </option>
								<option value="41">41 kg / 90 lbs   </option>
								<option value="42">42 kg / 93 lbs   </option>
								<option value="43">43 kg / 95 lbs   </option>
								<option value="44">44 kg / 97 lbs   </option>
								<option value="45">45 kg / 99 lbs   </option>
								<option value="46">46 kg / 101 lbs  </option>
								<option value="47">47 kg / 104 lbs  </option>
								<option value="48">48 kg / 106 lbs  </option>
								<option value="49">49 kg / 108 lbs  </option>
								<option value="50">50 kg / 110 lbs  </option>
								<option value="51">51 kg / 112 lbs  </option>
								<option value="52">52 kg / 115 lbs  </option>
								<option value="53">53 kg / 117 lbs  </option>
								<option value="54">54 kg / 119 lbs  </option>
								<option value="55">55 kg / 121 lbs  </option>
								<option value="56">56 kg / 123 lbs  </option>
								<option value="57">57 kg / 126 lbs  </option>
								<option value="58">58 kg / 128 lbs  </option>
								<option value="59">59 kg / 130 lbs  </option>
								<option value="60">60 kg / 132 lbs  </option>
								<option value="61">61 kg / 134 lbs  </option>
								<option value="62">62 kg / 137 lbs  </option>
								<option value="63">63 kg / 139 lbs  </option>
								<option value="64">64 kg / 141 lbs  </option>
								<option value="65">65 kg / 143 lbs  </option>
								<option value="66">66 kg / 146 lbs  </option>
								<option value="67">67 kg / 148 lbs  </option>
								<option value="68">68 kg / 150 lbs  </option>
								<option value="69">69 kg / 152 lbs  </option>
								<option value="70">70 kg / 154 lbs  </option>
								<option value="71">71 kg / 157 lbs  </option>
								<option value="72">72 kg / 159 lbs  </option>
								<option value="73">73 kg / 161 lbs  </option>
								<option value="74">74 kg / 163 lbs  </option>
								<option value="75">75 kg / 165 lbs  </option>
								<option value="76">76 kg / 168 lbs  </option>
								<option value="77">77 kg / 170 lbs  </option>
								<option value="78">78 kg / 172 lbs  </option>
								<option value="79">79 kg / 174 lbs  </option>
								<option value="80">80 kg / 176 lbs  </option>
								<option value="81">81 kg / 179 lbs  </option>
								<option value="82">82 kg / 181 lbs  </option>
								<option value="83">83 kg / 183 lbs  </option>
								<option value="84">84 kg / 185 lbs  </option>
								<option value="85">85 kg / 187 lbs  </option>
								<option value="86">86 kg / 190 lbs  </option>
								<option value="87">87 kg / 192 lbs  </option>
								<option value="88">88 kg / 194 lbs  </option>
								<option value="89">89 kg / 196 lbs  </option>
								<option value="90">90 kg / 198 lbs  </option>
								<option value="91">91 kg / 201 lbs  </option>
								<option value="92">92 kg / 203 lbs  </option>
								<option value="93">93 kg / 205 lbs  </option>
								<option value="94">94 kg / 207 lbs  </option>
								<option value="95">95 kg / 209 lbs  </option>
								<option value="96">96 kg / 212 lbs  </option>
								<option value="97">97 kg / 214 lbs  </option>
								<option value="98">98 kg / 216 lbs  </option>
								<option value="99">99 kg / 218 lbs  </option>
								<option value="100">100 kg / 220 lbs</option>
								<option value="101">101 kg / 223 lbs</option>
								<option value="102">102 kg / 225 lbs</option>
								<option value="103">103 kg / 227 lbs</option>
								<option value="104">104 kg / 229 lbs</option>
								<option value="105">105 kg / 231 lbs</option>
								<option value="106">106 kg / 234 lbs</option>
								<option value="107">107 kg / 236 lbs</option>
								<option value="108">108 kg / 238 lbs</option>
								<option value="109">109 kg / 240 lbs</option>
								<option value="110">110 kg / 243 lbs</option>
								<option value="111">111 kg / 245 lbs</option>
								<option value="112">112 kg / 247 lbs</option>
								<option value="113">113 kg / 249 lbs</option>
								<option value="114">114 kg / 251 lbs</option>
								<option value="115">115 kg / 254 lbs</option>
								<option value="116">116 kg / 256 lbs</option>
								<option value="117">117 kg / 258 lbs</option>
								<option value="118">118 kg / 260 lbs</option>
								<option value="119">119 kg / 262 lbs</option>
								<option value="120">120 kg / 265 lbs</option>
								<option value="121">121 kg / 267 lbs</option>
								<option value="122">122 kg / 269 lbs</option>
								<option value="123">123 kg / 271 lbs</option>
								<option value="124">124 kg / 273 lbs</option>
								<option value="125">125 kg / 276 lbs</option>
								<option value="126">126 kg / 278 lbs</option>
								<option value="127">127 kg / 280 lbs</option>
								<option value="128">128 kg / 282 lbs</option>
								<option value="129">129 kg / 284 lbs</option>
								<option value="130">130 kg / 287 lbs</option>
								<option value="131">131 kg / 289 lbs</option>
								<option value="132">132 kg / 291 lbs</option>
								<option value="133">133 kg / 293 lbs</option>
								<option value="134">134 kg / 295 lbs</option>
								<option value="135">135 kg / 298 lbs</option>
								<option value="136">136 kg / 300 lbs</option>
								<option value="137">137 kg / 302 lbs</option>
								<option value="138">138 kg / 304 lbs</option>
								<option value="139">139 kg / 306 lbs</option>
								<option value="140">140 kg / 309 lbs</option>
								<option value="141">141 kg / 311 lbs</option>
								<option value="142">142 kg / 313 lbs</option>
								<option value="143">143 kg / 315 lbs</option>
								<option value="144">144 kg / 317 lbs</option>
								<option value="145">145 kg / 320 lbs</option>
								<option value="146">146 kg / 322 lbs</option>
								<option value="147">147 kg / 324 lbs</option>
								<option value="148">148 kg / 326 lbs</option>
								<option value="149">149 kg / 328 lbs</option>
								<option value="150">150 kg / 331 lbs</option>
							</select>
						</div>
						</div>
						<div class="col-lg-12">
						</div>
						<div class="col-lg-4">
						<div class="form-group">
							<label for="nacionalidad">Nacionalidad:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
							<select name="f_nacionalidad" id="f_nacionalidad"class="nacionalidad form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
								<option value=""></option>
								<option value="Afghan">Afghan  </option>
								<option value="albanesa">albanesa </option>
								<option value="alemana">alemana  </option>
								<option value="americana">americana</option>
								<option value="argentina">argentina</option>
								<option value="armenia">armenia </option>
								<option value="australiana">australiana</option>
								<option value="austríaca">austríaca</option>
								<option value="Azerbaiyán ">Azerbaiyán</option>
								<option value="bahamas">bahamas </option>
								<option value="bahraini">bahraini </option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="barbadense">barbadense </option>
								<option value="belga">belga </option>
								<option value="Beliceño">Beliceño</option>
								<option value="bielorrusa">bielorrusa </option>
								<option value="boliviana">boliviana </option>
								<option value="Bosnian">Bosnian </option>
								<option value="brasileña">brasileña</option>
								<option value="británica">británica</option>
								<option value="Bruneian">Bruneian</option>
								<option value="búlgara">búlgara  </option>
								<option value="Burmese">Burmese </option>
								<option value="camerunés">camerunés</option>
								<option value="canadiense">canadiense </option>
								<option value="checa">checa </option>
								<option value="chilena">chilena  </option>
								<option value="china">china </option>
								<option value="colombiana">colombiana </option>
								<option value="congoleña">congoleña </option>
								<option value="coreana">coreana  </option>
								<option value="costarricense">costarricense </option>
								<option value="croata">croata</option>
								<option value="cubana">cubana</option>
								<option value="Cyprus">Cyprus  </option>
								<option value="danesa">danesa</option>
								<option value="dominicana">dominicana </option>
								<option value="ecuatoriana">ecuatoriana  </option>
								<option value="Egyptian">Egyptian</option>
								<option value="Emiratis">Emiratis</option>
								<option value="eslovaca">eslovaca </option>
								<option value="eslovena">eslovena </option>
								<option value="española">española </option>
								<option value="estonia">estonia  </option>
								<option value="Ethiopian">Ethiopian </option>
								<option value="filipina">filipina </option>
								<option value="finlandesa">finlandesa </option>
								<option value="francesa">francesa </option>
								<option value="georgiana">georgiana </option>
								<option value="ghanesa">ghanesa  </option>
								<option value="griega">griega</option>
								<option value="Hondureño">Hondureño </option>
								<option value="húngara">húngara  </option>
								<option value="india">india </option>
								<option value="indonesia">indonesia</option>
								<option value="inglesa">inglesa  </option>
								<option value="iraní">iraní</option>
								<option value="irlandesa">irlandesa</option>
								<option value="israelí">israelí  </option>
								<option value="italiana">italiana </option>
								<option value="jamaicano">jamaicano</option>
								<option value="japonesa">japonesa </option>
								<option value="Jordanian">Jordanian </option>
								<option value="kazaja">kazaja  </option>
								<option value="keniana">keniana </option>
								<option value="Kosovar">Kosovar </option>
								<option value="Kuwaiti">Kuwaiti </option>
								<option value="laosiana">laosiana</option>
								<option value="Laotian">Laotian </option>
								<option value="letón">letón </option>
								<option value="libanesa">libanesa </option>
								<option value="lituano">lituano  </option>
								<option value="luxemburguesa">luxemburguesa</option>
								<option value="Macau">Macau</option>
								<option value="malaya">malaya</option>
								<option value="Maldivian">Maldivian </option>
								<option value="maltesa">maltesa  </option>
								<option value="marfileña">marfileña </option>
								<option value="maroquí">maroquí </option>
								<option value="mexicana">mexicana </option>
								<option value="moldava">moldava  </option>
								<option value="mongola">mongola  </option>
								<option value="montenegrina">montenegrina  </option>
								<option value="Mozambican">Mozambican</option>
								<option value="Namibian">Namibian</option>
								<option value="neerlandesa">neerlandesa</option>
								<option value="Neozelandés">Neozelandés  </option>
								<option value="Nepalí">Nepalí  </option>
								<option value="nigeriana">nigeriana </option>
								<option value="noruega">noruega  </option>
								<option value="Omani">Omani</option>
								<option value="pakistaní">pakistaní</option>
								<option value="panameña">panameña </option>
								<option value="paraguaya">paraguaya</option>
								<option value="peruana">peruana  </option>
								<option value="polaca">polaca</option>
								<option value="portuguesa">portuguesa </option>
								<option value="puertorriqueña">puertorriqueña</option>
								<option value="rumana">rumana</option>
								<option value="rusa">rusa</option>
								<option value="Saudí">Saudí</option>
								<option value="serbia">serbia</option>
								<option value="singapurense">singapurense  </option>
								<option value="Sri Lankan">Sri Lankan</option>
								<option value="sudafricana">sudafricana</option>
								<option value="sueca">sueca </option>
								<option value="suiza">suiza </option>
								<option value="Syrian">Syrian  </option>
								<option value="tailandesa">tailandesa </option>
								<option value="Taiwán">Taiwán  </option>
								<option value="Tanzano">Tanzano </option>
								<option value="trinitense">trinitense</option>
								<option value="Tunisian">Tunisian</option>
								<option value="turca">turca </option>
								<option value="ucraniana">ucraniana</option>
								<option value="Ugandés">Ugandés </option>
								<option value="uruguayo">uruguayo</option>
								<option value="Uzbek">Uzbek</option>
								<option value="venezolana">venezolana </option>
								<option value="vietnamita">vietnamita </option>
							</select>
						</div>
					</div>
						<div class="col-lg-4">
						<div class="form-group">
							<label for="pelo">Color de pelo:</label>
							<select  name="f_pelo" id="f_pelo" class="pelo form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
								<option value=""></option>
								<option value="Rubio">Rubio </option>
								<option value="Pardo">Pardo </option>
								<option value="Negro">Negro </option>
								<option value="Pelirrojo">Pelirrojo </option>
							</select>
						</div>
						</div>
						
						

						

						<div class="col-lg-4 hidden-xs hidden-lg">
						<div class="form-group">
							<label for="peso">CARGA TU VIDEO DESDE YOUTUBE:<span id="numcar" class="texto"> (Ej. http://www.youtube.com/watch?v=IlrPHnwk5-8.)</span></label>
							<input name="f_video" id="f_video" type="text" maxlength="90" class="form-control form_celdainput" value="<?php echo $f_video?>" />
						</div>
						</div>

						<div class="col-lg-12">
						<div class="form-group">
							<!-- 	<label for="fotos">FINALIZAR PUBLICACION</label>
								<input class="form_boton btn btn-primary" type="submit" name="bt_enviar2" value="F"  id="submit-all" onClick="validar();" />
								<input name="bt_borrar2" type="reset" class="form_boton btn btn-primary" id="bt_borrar2" value="borrar" /> -->
						</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<div class="info-line clearfix">
									<div class="form_celdatitulo-midle" style="width:400px; "></div>
									<div class="col-1" style="width:240px;">
									<span id="terminar" style="display: none; font-size:19px;" class="campObligatorio"><img id="cargaFinal" style="display: none;" width="15" height="15" src="images/cargando.gif">ENVIANDO </span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group form-inline">
								
								<input class="submit-btn" style="background:#793a57 !important;padding:5px;" type="submit" name="bt_enviar2" id="submit-all" value="PUBLICAR ANUNCIO" style="padding: 10px;"  />
								
							</div>
							<div class="form-group">
								<div class="info-line clearfix">
									<div class="form_celdatitulo-midle"></div>
									<div class="col-1">
										<span id="terminar" class="campObligatorio"><img id="cargaFinal" src="images/cargando.gif">ENVIANDO </span>
									</div>
								</div>
							</div>
						</div>
					</form><!-- END FORM -->
				</div>
				</div> 	
		</div> <!-- /container -->
  


  </div>
 
</div>

<script type="text/javascript">
        $(document).ready(function(){
			verProvincias(41,0)
            Dropzone.autoDiscover = false;
			
            $("#my-dropzone").dropzone({
                url: "subir.php",
        		addRemoveLinks: true,
        		dictRemoveFile: 'Borrar Foto',
        		autoProcessQueue: false,
				renameFile: "files",
        		uploadMultiple: true,
        		parallelUploads: 8,
        		maxFiles: 8,
			
        		dictDefaultMessage: "<span style='font-size:0.7rem'>Por favor arrastre sus imagenes aca o haga click para buscar</span>",


        		// The setting up of the dropzone
			    init: function() {
			        var myDropzone = this;
			        

			        // Here's the change from enyo's tutorial...
			         this.on("sending", function(file, xhr, formData) {
						
			         	cargarmy();
					
					 	var f_categoria = $('#f_categoria').val();
					 	formData.append('f_categoria', f_categoria);    
					 	var f_edad = $('#f_edad').val();
					 	formData.append('f_edad', f_edad);   
						 var f_lugares = $('#f_lugares').val();
					 	formData.append('f_lugares', f_lugares);    
					 	var f_nombre = $('#f_nombre').val();
					 	formData.append('f_nombre', f_nombre);    
					 	var f_telefono = $('#f_telefono').val();
					 	formData.append('f_telefono', f_telefono);  
					 	var f_pais = $('#f_pais').val();
					 	formData.append('f_pais', f_pais);    
					 	var f_provincia = $('#f_provincia').val();
					 	formData.append('f_provincia', f_provincia);    
					 	var f_ciudad = $('#f_ciudad').val();
					 	formData.append('f_ciudad', f_ciudad);    
					 	var f_telefono = $('#f_horario').val();
					 	formData.append('f_horario', f_telefono); 
						 var f_whatsapp = false ;
						 if (document.getElementById('f_whatsapp').checked) {
							f_whatsapp = true;
						 }
					 	formData.append('f_whatsapp', f_whatsapp); 
						var f_telegram = false ;
						 if (document.getElementById('f_telegram').checked) {
							f_telegram = true;
						 }
						formData.append('f_telegram', f_telegram); 

						var imagen_principal = $('#item-img-output').attr('data-src');
					 	formData.append('imagen_principal', imagen_principal); 

					 	var f_idiomas = $('#f_idiomas').val();
					 	formData.append('f_idiomas', f_idiomas); 
						 var f_forma_pago = $('#f_forma_pago').val();
					 	formData.append('f_forma_pago', f_forma_pago);    
					 	var f_email = $('#f_email').val();
					 	formData.append('f_email', f_email );   

					 	if ($('#LA_1').is(":checked"))
						{
							var LA_1 = $('#LA_1').val(); 
							formData.append('LA_1', LA_1);    
						}
						if ($('#LA_2').is(":checked"))
						{
							var LA_2 = $('#LA_2').val(); 
							formData.append('LA_2', LA_2);    
						}
						if ($('#LA_3').is(":checked"))
						{
							var LA_3 = $('#LA_3').val(); 
							formData.append('LA_3', LA_3);    
						}
					 	
					 	//pagos
					 	
					 	if ($('#FP_1').is(":checked"))
						{
							var FP_1 = $('#FP_1').val(); 
							formData.append('FP_1', FP_1);    
						}
						if ($('#FP_1').is(":checked"))
						{
							var FP_2 = $('#FP_2').val(); 
							formData.append('FP_2', FP_2);    
						}
						if ($('#FP_3').is(":checked"))
						{
							var FP_3 = $('#FP_3').val(); 
							formData.append('FP_3', FP_3);    
						}
						if ($('#FP_4').is(":checked"))
						{
							var FP_4 = $('#FP_4').val(); 
							formData.append('FP_4', FP_4);    
						}
						var f_medidas = $('#f_medidas').val();
					 	formData.append('f_medidas', f_medidas);    
					 	var f_altura = $('#f_altura').val();
					 	formData.append('f_altura', f_altura);

					 	var f_ojos = $('#f_ojos').val();
					 	formData.append('f_ojos', f_ojos);    
					 	var f_peso = $('#f_peso').val();
					 	formData.append('f_peso', f_peso); 

					 	var f_nacionalidad = $('#f_nacionalidad').val();
					 	formData.append('f_nacionalidad', f_nacionalidad);    
					 	var f_pelo = $('#f_pelo').val();
					 	formData.append('f_pelo', f_pelo); 
					 	//servicios
					 	if ($('#S_1').is(":checked"))
						{
							var S_1 = $('#S_1').val(); 
							formData.append('S_1', S_1);    
						}
						if ($('#S_2').is(":checked"))
						{
							var S_2 = $('#S_2').val(); 
							formData.append('S_2', S_2);    
						}
						if ($('#S_3').is(":checked"))
						{
							var S_3 = $('#S_3').val(); 
							formData.append('S_3', S_3);    
						}
						if ($('#S_4').is(":checked"))
						{
							var S_4 = $('#S_4').val(); 
							formData.append('S_4', S_4);    
						}
						if ($('#S_5').is(":checked"))
						{
							var S_5 = $('#S_5').val(); 
							formData.append('S_5', S_5);    
						}
						if ($('#S_6').is(":checked"))
						{
							var S_6 = $('#S_6').val(); 
							formDaa.append('S_6', S_6);    
						}
						if ($('#S_7').is(":checked"))
						{
							var S_7 = $('#S_7').val(); 
							formData.append('S_7', S_7);    
						}
						if ($('#S_8').is(":checked"))
						{
							var S_8 = $('#S_8').val(); 
							formData.append('S_8', S_8);    
						}
						if ($('#S_9').is(":checked"))
						{
							var S_9 = $('#S_9').val(); 
							formData.append('S_9', S_9);    
						}
						if ($('#S_10').is(":checked"))
						{
							var S_10 = $('#S_10').val(); 
							formData.append('S_10', S_10);    
						}
						if ($('#S_11').is(":checked"))
						{
							var S_11= $('#S_11').val(); 
							formData.append('S_11', S_11);    
						}
						if ($('#S_12').is(":checked"))
						{
							var S_12 = $('#S_12').val(); 
							formData.append('S_12', S_12);    
						}
						if ($('#S_13').is(":checked"))
						{
							var S_13 = $('#S_13').val(); 
							formData.append('S_13', S_13);    
						}
						if ($('#S_14').is(":checked"))
						{
							var S_14 = $('#S_14').val(); 
							formData.append('S_14', S_14);    
						}
						if ($('#S_15').is(":checked"))
						{
							var S_15 = $('#S_15').val(); 
							formData.append('S_15', S_15);    
						}
						if ($('#S_16').is(":checked"))
						{
							var S_16 = $('#S_16').val(); 
							formData.append('S_16', S_16);    
						}
						if ($('#S_17').is(":checked"))
						{
							var S_17 = $('#S_17').val(); 
							formData.append('S_17', S_17);    
						}
						if ($('#S_18').is(":checked"))
						{
							var S_18 = $('#S_18').val(); 
							formData.append('S_18', S_18);    
						}
						if ($('#S_19').is(":checked"))
						{
							var S_19 = $('#S_19').val(); 
							formData.append('S_19', S_19);    
						}
						if ($('#S_20').is(":checked"))
						{
							var S_20 = $('#S_20').val(); 
							formData.append('S_20', S_20);    
						}
						if ($('#S_21').is(":checked"))
						{
							var S_21 = $('#S_21').val(); 
							formData.append('S_21', S_21);    
						}
						if ($('#S_22').is(":checked"))
						{
							var S_22 = $('#S_22').val(); 
							formData.append('S_22', S_22);    
						}
						if ($('#S_23').is(":checked"))
						{
							var S_23 = $('#S_23').val(); 
							formData.append('S_23', S_23);    
						}
						if ($('#S_24').is(":checked"))
						{
							var S_24 = $('#S_4').val(); 
							formData.append('S_24', S_24);    
						}
						if ($('#S_25').is(":checked"))
						{
							var S_25 = $('#S_25').val(); 
							formData.append('S_25', S_25);    
						}
						if ($('#S_26').is(":checked"))
						{
							var S_26 = $('#S_26').val(); 
							formData.append('S_26', S_26);    
						}
						if ($('#S_27').is(":checked"))
						{
							var S_27 = $('#S_27').val(); 
							formData.append('S_27', S_27);    
						}
						if ($('#S_28').is(":checked"))
						{
							var S_28 = $('#S_28').val(); 
							formData.append('S_28', S_28);    
						}
						if ($('#S_29').is(":checked"))
						{
							var S_29 = $('#S_29').val(); 
							formData.append('S_29', S_29);    
						}
						if ($('#S_30').is(":checked"))
						{
							var S_30 = $('#S_30').val(); 
							formData.append('S_30', S_30);    
						}
						if ($('#S_31').is(":checked"))
						{
							var S_31 = $('#S_31').val(); 
							formData.append('S_31', S_31);    
						}
						
						var f_descripcion = $('#f_descripcion').val();
					 	formData.append('f_descripcion', f_descripcion);    
					 	var f_especificaciones = $('#f_especificaciones').val();
					 	formData.append('f_especificaciones', f_especificaciones); 
					 	var f_video = $('#f_video').val();
					 	formData.append('f_video', f_video);    
					 	
					
					  });
			        $("#submit-all").click(function (e) {
			            
			            $('#item-img-output').attr('src','');
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
					  
				      window.location.href = "registro_final.php";
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
			console.log(response);
        }
            });

        });
		




    $(document).ready(function() {
    $('.idioma').select2();
	$('.edad').select2();
	$('.lugares').select2();
	$('.forma_pago').select2();
	$('.altura').select2();
	$('.nacionalidad').select2();
	$('.pelo').select2();
	$('.servicios').select2();
	$('.peso').select2();
	$('.ojos').select2();
	$('.pais').select2();
	
	
});
    </script>
	<script>
		// -----Crop Image file upload with modal--

var $uploadCrop,
		tempFilename,
		rawImg,
		imageId;
		function readFile(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.upload-demo').addClass('ready');
					$('#cropImagePop').modal('show');
					rawImg = e.target.result;
				};
				reader.readAsDataURL(input.files[0]);
			}
			else {
				console.log("Sorry - you're browser doesn't support the FileReader API");
			}
		}

		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: 300,
				height: 350,
				type: 'square'
			},
			enforceBoundary: false,
			enableExif: true
		});
		$('#cropImagePop').on('shown.bs.modal', function(){
			$('.cr-slider-wrap').prepend('<p>Image Zoom</p>');
			$uploadCrop.croppie('bind', {
				url: rawImg
			}).then(function(){
				console.log('jQuery bind complete');
			});
		});

		$('#cropImagePop').on('hidden.bs.modal', function(){
			$('.item-img').val('');
			$('.cr-slider-wrap p').remove();
		});

		$('.item-img').on('change', function () { 
			readFile(this); 
		});

		$('.replacePhoto').on('click', function(){
			$('#cropImagePop').modal('hide');
			$('.item-img').trigger('click');
		});
		
		$('#cropImageBtn').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'base64',
				// format: 'jpeg',
        		backgroundColor : "#000000",
        		format: 'jpg',
				size: {width: 300, height: 350}
			}).then(function (resp) {
				
				$('#item-img-output').attr('src', resp);
				resp = resp.replace("data:image/png;base64,", "");
				$('#item-img-output').attr('data-src', resp);
				$('#cropImagePop').modal('hide');
				$('.item-img').val('');
			});
		});
	</script>

<div class="holas" style="display:none;"><!-- Place at bottom of page --><span>POR FAVOR ESPERE MIENTRAS SE GUARDAN LOS DATOS</span></div>
<!-- Footer -->
<?php include ('footer.php') ?>

