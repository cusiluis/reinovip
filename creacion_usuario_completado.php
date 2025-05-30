<?php
include("includes/globales.inc.php");
include("includes/conexion.inc.php");
include('phpmailer/src/Exception.php');
include('phpmailer/src/PHPMailer.php');

use PHPMailer\PHPMailer\PHPMailer;


if (empty($_POST['usuario']) || empty($_POST['correo1']) || empty($_POST['contrasena1'])) {
    // echo "Error: Debes completar todos los campos obligatorios.";
    if (isset($_POST['escort'])) {
      header("Location: crear_usuario_escort.php?error=1");
      exit;
    }else{
      header("Location: crear_usuario_agencia.php?error=1");
      exit;
    }
    
}
// Variables
$respuestaautomatica = "Reino Vip PUBLICIDAD";
$TituloSitio = "Reino Vip"; // Asegúrate de definir esto en globales.inc.php
$gracias = "Gracias por contactarte con " . $TituloSitio;
// $fechaActual = date("Y-m-d H:i:s");

$nombre = $_POST['usuario'];
$correo = $_POST['correo1'];
$pass   = $_POST['contrasena1'];
$tipo   = isset($_POST['escort']) ? 'ESCORT' : (isset($_POST['agencia']) ? 'AGENCIA' : '');
$token  = strtoupper(bin2hex(random_bytes(8))); // token seguro

// Verificar si ya existe el correo
$check = $mysqli->prepare("SELECT id FROM reino01_escort_usuarios WHERE email = ?");
$check->bind_param("s", $correo);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    //echo "Error: Ya existe un usuario registrado con ese correo.";
    header("Location: existe_usuario.php");
    exit;
}

// Insertar nuevo usuario
// $sql = "INSERT INTO reino01_escort_usuarios 
//         (nombre_modelo, email, contrasena, token, habilitado, tipo) 
//         VALUES (?, ?, ?, ?, 0, ?)";
// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param("ssssss", $nombre, $correo, $pass, $token, $tipo);
// $stmt->execute();
// $idInsert = $stmt->insert_id;


	$sql    = "INSERT reino01_escort_usuarios (nombre_modelo,email,contrasena,token,habilitado,tipo)
			   VALUES ('$nombre','$correo','$pass','$token',0,'$tipo')";
	$mysqli->query($sql);
	$idInsert=$mysqli->insert_id;



// Insertar agencia si corresponde
if ($tipo === 'AGENCIA') {
    // $sql2 = "INSERT INTO agencias (usuario_id, nombre_agencia)
    //          VALUES (?, ?)";
    // $stmt2 = $mysqli->prepare($sql2);
    // $stmt2->bind_param("iss", $idInsert, $nombre);
    // $stmt2->execute();
    $sql1   = "INSERT agencias (usuario_id,nombre_agencia)
		VALUES ('$idInsert','$nombre')";

		$mysqli->query($sql1);
}

// Enviar correo de confirmación
$mail = new PHPMailer();
try {
    $mail->Host       = 'smtp.reinovip.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'soporte@reinovip.com';
    $mail->Password   = 'Ypfb2010!';
    $mail->Port       = 465;

    $mail->setFrom('soporte@reinovip.com', 'Reino Vip');
    $mail->addAddress($correo);

    $mail->isHTML(true);
    $mail->Subject = 'Confirma tu direccion de correo electronico';
    $mail->Body    = '
        <h1>Registro en Reino Vip</h1>
        Hola,<br>Gracias por registrarte en nuestra página <strong>www.reinovip.com</strong>. 
        Para activar tu cuenta, haz clic en el siguiente enlace:<br><br>
        <a href="https://reinovip.com/validacion_correo.php?token=' . $token . '">Validar mi correo electrónico</a><br><br>
        Recuerda que tienes 24 horas para confirmar, caso contrario se eliminará el registro.<br><br>
        Nuestros mejores deseos desde Reino Vip<br>
        <a href="https://www.reinovip.com">www.reinovip.com</a><br><br>
        ¡Gracias por confiar en nosotros!';
    $mail->AltBody = 'Gracias por registrarte. Valida tu correo en www.reinovip.com';

    $mail->send();
} catch (Exception $e) {
    echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
}

// Redireccionar a página de agradecimiento
// header("Location: gracias.php");
// exit;
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
	  font-size: 0.9rem;
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
        width: 480px;
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
<div class="container">
   <div class="content-container-crear">

   				<div class="login-box">
						<h2>REGISTRO COMPLETADO</h2>
						<p>Gracias por registrarte</p>
						<p>	Un mensaje con un enlace de confirmación ha sido enviado a su dirección de correo electrónico .</p>
						<p>	Para completar el registro, solo haga clic en el enlace o copie y pegue el enlace en su navegador.</p>
						<p>	A veces puede pasar que el mensaje termine en el correo basura(spam), no olvide revisarlo.</p>
						<p>	Si por algún motivo no recibe la confirmación, por favor contáctenos.</p>
							
							<a href="/">
                 <button class="submit-btn">Volver a la pagina de inicio</button>
              </a>
					</div>

  </div>
 
</div>


<!-- Footer -->
<?php include ('footer.php') ?>
