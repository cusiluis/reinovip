<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

if(isset($_SESSION['nombre']) and $_SESSION['nombre']!=''){
	header("Location: publicaciones.php");exit;
}


//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
$respuestaautomatica="Reino Vip PUBLICIDAD";
$gracias="Gracias por contactarte con ".$TituloSitio;
$mensajeenvio="Tu información ha sido modificada con éxito.";
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



		if(isset($_SESSION['email']))
		{

			
				
				$usuario=$_SESSION['email'];
				$buscCliente="select ID from reino01_escort_usuarios where email='$usuario'";
				$ejecBuscCli=$mysqli->query($buscCliente) or die (mysqli_error());
				$swReg=mysqli_num_rows($ejecBuscCli);

				if($swReg>0)
				{
				$arryBuscCli=mysqli_fetch_array($ejecBuscCli);
				//$idCliente=$arryBuscCli['ID'];	
				//session_register('idlog');		
				//$_SESSION['idlog']=$idCliente;
				if($_POST['id']){
				$publicacion_id=$_POST['id'];
					
				$tblEscort=$Prefijo."Escort";
				$tblProvincia=$Prefijo."escort_provincia";
				$tblProv=$Prefijo."Provincia";
				$tblCiudad=$Prefijo."escort_ciudad";
			
				//$sqlCliente="select * from $tblEscort where ID=".$idCliente;
				$sqlCliente="select * from reino01_Escort where ID=".$publicacion_id;
				$ejEscort=$mysqli->query($sqlCliente) or die (mysqli_error());
				$cantRegCli=mysqli_num_rows($ejEscort);

				}
				else{
				$publicacion_id=$_GET['id'];
					
				$tblEscort=$Prefijo."Escort";
				$tblProvincia=$Prefijo."escort_provincia";
				$tblProv=$Prefijo."Provincia";
				$tblCiudad=$Prefijo."escort_ciudad";
			
				//$sqlCliente="select * from $tblEscort where ID=".$idCliente;
				//$sqlCliente="select * from reino01_Escort where ID=".$publicacion_id;
				//$ejEscort=$mysqli->query($sqlCliente) or die (mysqli_error());
				//$cantRegCli=mysqli_num_rows($ejEscort);

				}
				if($cantRegCli>0)
					{
						$arryEscort=mysqli_fetch_array($ejEscort);
						$idClienteDB=$arryEscort["ID"];
							
						$f_nombre=$arryEscort["Nombre"];
						$f_titulo=$arryEscort["Titulo"];
						$f_edad=$arryEscort["Edad"];
						$f_categoria=$arryEscort["CategoriaID"];
						$f_telefono=$arryEscort["Telefono"];
						$f_email=$arryEscort["Email"];
						$f_pais=$arryEscort["PaisID"];
						$f_provincia=$arryEscort["ProvinciaID"];
						$f_ciudad=$arryEscort["CiudadID"];
						$f_descripcion=$arryEscort["Comentario"];
						$f_especificaciones=$arryEscort["Especificaciones"];
						$f_medidas=$arryEscort["Medidas"];
						$f_peso=$arryEscort["peso"];
						$f_altura=$arryEscort["Altura"];
						$f_nacionalidad=$arryEscort["Nacionalidad"];
						$f_ojos=$arryEscort["ojos"];
						$f_pelo=$arryEscort["pelo"];
						$f_idiomas=$arryEscort["Idioma"];
						$f_horario=$arryEscort["Horario"];
					}
				}
				else
				{
				session_destroy();
				$mensajeIngresoCliente="El usuario y la contrase&ntilde;a introducida no es v&aacute;lida";
				}
			
		}
	
	//if (!empty($_REQUEST['captcha'])) {
		//print_r($_FILES);exit;
	

		if(isset($_POST['id']) and $_POST['id']!='' )  {

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
			$f_medidas=$_POST["f_medidas"];
			$f_peso=$_POST["f_peso"];
			$f_altura=$_POST["f_altura"];
			$f_nacionalidad=$_POST["f_nacionalidad"];
			$f_ojos=$_POST["f_ojos"];
			$f_pelo=$_POST["f_pelo"];
			$f_idiomas=$_POST["f_idiomas"];
			$f_horario=$_POST["f_horario"];
			$idClienteDB=$_POST['id'];
			$captcha_message = "";
			$sqlCli="update reino01_Escort set Nombre='$f_nombre',Titulo='$f_titulo',Edad='$f_edad',CategoriaID='$f_categoria',Email='$f_email',Telefono='$f_telefono',Comentario='$f_descripcion',Publico='3',PaisID='$f_pais',ProvinciaID='$f_provincia',CiudadID='$f_ciudad',Especificaciones='$f_especificaciones',Medidas='$f_medidas',peso='$f_peso',Altura='$f_altura',Nacionalidad='$f_nacionalidad',ojos='$f_ojos',pelo='$f_pelo',Idioma='$f_idiomas',Horario='$f_horario' where ID='$idClienteDB' ";
			//echo $sqlCli;exit;
			if($mysqli->query($sqlCli)){
				
				
				$Item=$idClienteDB;
				$tablaGuardarFP=$Prefijo."escort_formas_pagos_registro";
				$mysqli->query("DELETE FROM $tablaGuardarFP WHERE ID_escort='".$Item."'");
				$tablaFP=$Prefijo."escort_formas_pagos";
				$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
				while($arryFP = mysqli_fetch_array($sqlFP))
				{
					$idFP=$arryFP["ID"];
					if(isset($_POST['FP_'.$idFP]) && $_POST['FP_'.$idFP]==1)
					{
						$mysqli->query("INSERT INTO $tablaGuardarFP (ID_escort,ID_forma_pago)values('".$Item."','".$arryFP["ID"]."')");
					}
				}
				$tablaGuardarLA=$Prefijo."escort_lugares_atencion_registro";
				$mysqli->query("DELETE FROM $tablaGuardarLA WHERE ID_escort='".$Item."'");
				$tablaLA=$Prefijo."escort_lugares_atencion";
				$sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");
				while($arryLA = mysqli_fetch_array($sqlLA))
				{
					$idLA=$arryLA["ID"];
					if(isset($_POST['LA_'.$idLA]) && $_POST['LA_'.$idLA]==1)
					{
						$mysqli->query("INSERT INTO $tablaGuardarLA (ID_escort,ID_lugar_atencion)values('".$Item."','".$arryLA["ID"]."')");
					}
				}

				$tablaGuardarS=$Prefijo."escort_servicios_registro";
				$mysqli->query("DELETE FROM $tablaGuardarS WHERE ID_escort='".$Item."'");
				$tablaS=$Prefijo."escort_servicios";
				$sqlS = $mysqli->query("select * from $tablaS where Publico='1'");
				while($arryS = mysqli_fetch_array($sqlS))
				{
					$idS=$arryS["ID"];
					if(isset($_POST['S_'.$idS]) && $_POST['S_'.$idS]==1)
					{
						$mysqli->query("INSERT INTO $tablaGuardarS (ID_escort,ID_servicio)values('".$Item."','".$arryS["ID"]."')");
					}
				}
				$mensaje="Ahora sube tus fotos para tener mas presentación ";
				$idInsert=$idClienteDB;


	$sql="select Nombre from reino01_Ciudad where ID='$f_ciudad'";
		$exSql=$mysqli->query($sql);
		$cantReg=mysqli_num_rows($exSql);
			$arry=mysqli_fetch_array($exSql);
			$retornarNombre=  $arry["Nombre"];
	
				// $urlCliente=$URLSitio."escort/".urls_amigables($retornarNombre)."/".$idInsert."/".urls_amigables($f_nombre).".php";
				// $urlClientePanel=$URLSitio."modificar.php";
				// $asunto=$respuestaautomatica;
				// $cuerpo="<img src='http://i.minus.com/ioUvcmH9L7c3K.png' height='155px'><br><br>";
				// $cuerpo.="<div align='center'>";
				// $cuerpo.="<font color='#000000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>";
				// $cuerpo.=$gracias."<br>";
				// $cuerpo.=$mensajeenvio."<br><br>";
				// $cuerpo.="Aqui podras ver tu publicación<br>";
				// $cuerpo.="<a href=".$urlCliente.">".$urlCliente."</a>";
				// $cuerpo.="<br><br>";
				// $cuerpo.="Aqui podras modificar tu información<br>";
				// $cuerpo.="<a href=".$urlClientePanel.">".$urlClientePanel."</a><br>";
				// $cuerpo.="</font>";
				// $cuerpo.="</div>";
				// $cuerpo.="<br><br><p style='color:#003300; font-weight:bold; font-family:Georgia, `Times New Roman`, Times, serif'>Publicidad Reino Vip<br>Call Center 983 44 00 77 - Atención al cliente</p>";
				 $err.=enviarmail($NombreSitio,$EmailSitio,$f_nombre,$f_email,$asunto,$cuerpo);
				header("Location: modificacion_final.php");
			}

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

   

<?php 
  include ('cabecera.php');
  
?>
<style>
	 .content-container-crear {
  max-width: 500px;
  margin: 0 auto;
  padding: 0 36px;
  margin-top: 2em;
  }
 .content-container-crear h1{
      color: #793a57;
      font-size: 1.5rem;
      text-align: center;
    }
.content-container-crear h2{
    color: #793a57;
  font-size: 1.1rem;
  margin-bottom: 20px;
    }
    p {
      color: #333;
      line-height: 1.6;
      margin-top: 1em;
      text-align: justify;
    }
    .content-container-crear ul.listado li{
      font-size: 0.9rem;
    list-style-type: square !important;
  display: list-item;
  border: none;
  padding: 0;
  margin: 10px 18px;
    }

    @media (max-width: 600px) {
      .content-container-crear {
        padding: 0;
      }
    }
    .login-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
        max-width: 100%;
        margin-top: 30px;
    }
    .input-group {
        margin-bottom: 20px;
        width: 100%;
    }

    .input-group label {
        font-size: .8rem !important;
        color: #666;
    }

    .input-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 5px;
        font-size: .8rem;
    }

    .input-group input:focus {
        border-color: #793a57;
        outline: none;
    } 
    .error-message {
        color: red;
        font-size: .7rem;
        margin-top: 5px;
    }

    .submit-btn2 {
        width: 100%;
        padding: 12px;
        background-color: #793a57;
        border: none;
        color: white;
        font-size: 17px;
        cursor: pointer;
        border-radius: 5px;
    }

    .submit-btn2:hover {
        background-color: #00a850;
    } 

.submit-btn {
  background-color: #702343;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: background-color 0.4s ease, transform 0.3s ease;
  width: 100%;
  margin-top: 30px;
}

/* Hover: agrandar y tono más claro */
.submit-btn:hover {
  background-color: #8a2d52;
  transform: scale(1.05);
}

/* Línea brillante dorada */
.submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    120deg,
    transparent,
    rgba(255, 215, 0, 0.6),
    transparent
  );
  transition: all 0.5s ease;
}

/* Animación al pasar el mouse */
.submit-btn:hover::before {
  left: 100%;
}

    
    .forgot-password {
        text-align: center;
        margin-top: 10px;
		    color:#793a57;
        text-decoration: none;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    } 
a:hover{color:#fff;text-decoration:none;}
</style>  
<!-- Cards -->
<div class="container">
   <div class="content-container-crear">


    <div class="login-box">
    <h2 style="margin:0 0 20px 0;">ACCEDE A TU PERFIL</h2>
							<form action="login_usuario.php" method="post" name="frmIngreso">
								<div class="input-group">
									<label for="email">Usuario</label>

									<input name="usuario" id="usuario" type="text" class="form_celdainput_ingreso" value="" />
									<small id="email-error" class="error-message"></small>
								</div>

								<div class="input-group">
									<label for="password">Contraseña</label>
									<input name="contrasenia" id="contrasenia" type="password" class="form_celdainput_ingreso"
										value="" />
									<small id="password-error" class="error-message"></small>
								</div>
								<p>
								<button type="submit" class="submit-btn">Ingresar</button>
								</p>
								<div class="forgot-password">
									<a style="color:#793a57;" href="/recuperar_contrasena.php">Olvidaste tu contraseña?</a>
								</div>
							</form>
							<br>
							<p style="font-size: 11px;line-height:15px;">Al ingresar confirmas que has leido y estas de acuerdo con nuestros terminos
								y condiciones, condiciones de contratacion, politicas de cookies, privacidad y contenidos.
							</p>
  </div>

						<div class="login-box">
							<p style="text-align:center;font-weight:600;">
								¿No tienes cuenta? <a style="color:#28a745;background-color:#FFF;font-weight:700;"  class="submit-btn2" href="/crear_usuario.php">Crear cuenta</a>
							</p>
						</div>



  </div>  
</div>


<!-- Footer -->
<?php include ('footer.php') ?>
