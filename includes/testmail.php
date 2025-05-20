<?php
//Incluimos la clase de PHPMailer
require_once('class.phpmailer.php');

$correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()

//Usamos el SetFrom para decirle al script quien envia el correo
$correo->SetFrom("mauricio@reinovip.es", "reinovip MAC");

//Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
$correo->AddReplyTo("mauricio@reinovip.es", "reinovip MAC");

//Usamos el AddAddress para agregar un destinatario
$correo->AddAddress("publicidad@reinovip.es", "mauricio");

//Ponemos el asunto del mensaje
$correo->Subject = "Mi primero correo con PHPMailer";

/*
 * Si deseamos enviar un correo con formato HTML utilizaremos MsgHTML:
 * $correo->MsgHTML("<strong>Mi Mensaje en HTML</strong>");
 * Si deseamos enviarlo en texto plano, haremos lo siguiente:
 * $correo->IsHTML(false);
 * $correo->Body = "Mi mensaje en Texto Plano";
 */
$correo->MsgHTML("Mi Mensaje en <strong>HTML</strong>");
$correo->CharSet = 'UTF-8';
//Si deseamos agregar un archivo adjunto utilizamos AddAttachment
$correo->AddAttachment("images/phpmailer.gif");

//Enviamos el correo
if(!$correo->Send()) {
  echo "Hubo un error: " . $correo->ErrorInfo;
} else {
  echo "Mensaje enviado con exito.";
}

?>