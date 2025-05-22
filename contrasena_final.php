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
	
    //echo '<pre>';print_r($_POST);exit;


	$correo = $_POST['correo'];

    $SQLcat="SELECT * FROM reino01_escort_usuarios where  email = '".$correo."' ";
		$ResultCat=$mysqli->query($SQLcat);
		while ($res = mysqli_fetch_array($ResultCat)){
            $password = $res['contrasena'];
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
		$mail->setFrom('soporte@reinovip.com', 'SOPORTE REINOVIP');
		$mail->addAddress($correo);     //Add a recipient
		$mail->addAddress($correo);               //Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Recuperacion Contrasena';
		$mail->Body    = 'Hola,<br><br>
                    Parece que has solicitado restablecer tu contraseña.<br><br>
                    la contraseña es:'.$password.'<br><br>
                    Si necesitas ayuda adicional, no dudes en contactarnos.';
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

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
<div class="container mt-4">
   <div class="content-container">
  
					<div class="login-box">
								<h2>Recuperacion de contraseña completada</h2>
								Se ha enviado un correo a <?php echo $correo; ?><br><br>
							Si el correo se encuentra registrado, recibira un mensaje <br><br>    	
							Si por algún motivo no recibe la confirmación, por favor contáctenos.<br><br>
							</p>
							<a href="/"><button class="submit-btn">Volver a la pagina de inicio</button></a>
							</div>


  </div>
 
</div>


<!-- Footer -->
<?php include ('footer.php') ?>
