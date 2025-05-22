<?php
	include ("includes/globales.inc.php");
	include ("includes/conexion.inc.php");
	include('phpmailer/src/Exception.php');
	include('phpmailer/src/PHPMailer.php');
	//include('phpmailer/src/SMTP.php');
	$respuestaautomatica="Reino Vip PUBLICIDAD";
	$gracias = "Gracias por contactarte con ".$TituloSitio;
	$mensajeenvio ="Tu información ha sido modificada con éxito.";
	$err_errorenvio = "No se ha podido enviar su email: ";
	$error_nombre = "Error: Debe completar su Nombre";
	$error_telefono = "Error: Debe completar su Teléfono";
	$error_email = "Error: Debe completar su cuenta de E-Mail";
	$error_email_invalido = "Error: La cuenta de E-Mail no tiene un formato válido";
	//print_r($_POST); exit;
	function enviarmail($myname,$myemail,$contactname,$contactemail,$subject,$message) {
		$headers = '';
		$headers.="MIME-Version: 1.0\n";
		$headers.="Content-type: text/html; charset=utf-8\n";
		$headers.="X-Priority: 1\n";
		$headers.="X-MSMail-Priority: High\n";
		$headers.="X-Mailer: php\n";
		$headers.="From: \"".$myname."\" <".$myemail.">\n";
		return(mail("\"".$contactname."\" <".$contactemail.">",$subject,$message,$headers));
	}

    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for ($i = 0; $i < 16; $i++) {
        $token .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    if(isset($_POST['escort'])){
		$tipo = 'ESCORT';
	}
	if(isset($_POST['agencia'])){
		$tipo = 'AGENCIA';
		
	}
    $nombre = $_POST['usuario'];
	$correo = $_POST['correo1'];
	$pass   = $_POST['contrasena1'];
	$sql    = "INSERT reino01_escort_usuarios (nombre_modelo,email,contrasena,token,habilitado,tipo)
			   VALUES ('$nombre','$correo','$pass','$token',0,'$tipo')";

	$mysqli->query($sql);
	$idInsert=$mysqli->insert_id;
	if(isset($_POST['agencia'])){
		
		$sql1   = "INSERT agencias (usuario_id,nombre_agencia)
			   VALUES ('$idInsert','$nombre')";

		$mysqli->query($sql1);
		
	} 
	$mail = new PHPMailer\PHPMailer\PHPMailer();

	try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		//$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.reinovip.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'soporte@reinovip.com';                     //SMTP username
		$mail->Password   = 'Ypfb2010!';                               //SMTP password
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('soporte@reinovip.com', 'Reino Vip');
		$mail->addAddress($correo);     //Add a recipient
		//$mail->addAddress('mauricio.ayllon@gmail.com');               //Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Confirma tu direccion de correo electronico';
		$mail->Body    = '<h1>Registro en Reino Vip</h1>Hola,<br>Gracias por registrarte en nuestra pagina www.reinovip.com. Para activar tu cuenta, por favor, haz clic en el siguiente enlace:<br><br>
		                  <a href="https://reinovip.com/validacion_correo.php?token='.$token.'">Validar mi correo electrónico</a><br><br>Recuerda que tienes 24 horas para confimar, caso contrario se eliminara el registro<br><br>Nuetros mejores deseos desde Reino Vip <br><br><a href="https://www.reinovip.com">www.reinovip.com</a>.<br>
							¡Gracias por confiar en nosotros!';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		//echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	//$URLSitio = 'https://reinovip.com/'
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
    .login-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
        max-width: 100%;
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
.formlink  {
    color: #333;
    text-decoration: none;
}
.formlink:hover {
    color: #cc922f;
}
</style>
<!-- Cards -->
<div class="container mt-4">
   <div class="content-container">

   				<div class="login-box">
						<h2>REGISTRO COMPLETADO</h2>
						<br>
						<p>
								Gracias por registrarte<br><br>
							Un mensaje con un enlace de confirmación ha sido enviado a su dirección de correo electrónico .<br><br>
							Para completar el registro, solo haga clic en el enlace o copie y pegue el enlace en su navegador.<br><br>
							A veces puede pasar que el mensaje termine en el correo basura(spam), no olvide revisarlo.<br><br>
							Si por algún motivo no recibe la confirmación, por favor contáctenos.<br><br>
							</p>
							<a href="/">
                 <button class="submit-btn">Volver a la pagina de inicio</button>
              </a>
					</div>

  </div>
 
</div>


<!-- Footer -->
<?php include ('footer.php') ?>
