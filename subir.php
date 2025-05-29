
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//echo '<pre>';print_r($_FILES);
//echo '<pre>';print_r($_POST);exit;
//echo '<pre>';print_r($_FILES);exit;
session_start();
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
require_once('includes/class.phpmailer.php');
include_once('resize/ImageResize.php');
use \Eventviva\ImageResize;
include_once('resize/watermark.php');

$correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()



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

	$f_nombre=formatearTexto($_POST["f_nombre"],true);
	$f_titulo=$f_nombre;
	$f_edad=$_POST["f_edad"];
	$f_categoria=$_POST["f_categoria"];
	$f_telefono=$_POST["f_telefono"];
	$f_email=$_SESSION["email"];
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
	$f_idiomas = explode(',',$_POST['f_idiomas']);
	$f_horarios = $_POST["f_horario"];
	$f_lugares = explode(',',$_POST['f_lugares']);
	$f_whatsapp = $_POST["f_whatsapp"];
	$f_telegram = $_POST["f_telegram"];
	$f_forma_pago = explode(',',$_POST["f_forma_pago"]);
	
$mensaje="";
$urlCliente="";
$urlClientePanel="";
$idInsert=0;

	
    
        $captcha_message = "";
			$dat='abcdefghijklmnpqrstuvwxyz123456789';
			$random1 = mt_rand(0,33);
			$random2 = mt_rand(0,33);
			$random3 = mt_rand(0,33);
			$random4 = mt_rand(0,33);
			$random5 = mt_rand(0,33);
			$genPass=$dat[$random1].$dat[$random2].$dat[$random3].$dat[$random4].$dat[$random5];
			$sql="SELECT id from reino01_escort_usuarios where email = '".$_SESSION['email']."'";
			
			$res = $mysqli->query($sql);
			while($arryFP = mysqli_fetch_array($res))
				{
					$idUsuario=$arryFP['id'];
				}
			
		//	print_r($idUsuario);exit;

			$sqlCli="insert into reino01_Escort(
			usuario_id,
			diasPublicacion,
			Publico,
			Usuario,
			Contrasenia,
			Nombre,
			Pack,
			Titulo,
			Edad,
			Email,
			CategoriaID,
			Telefono,
			whatsapp,
			telegram,
			Comentario,
			PaisID,
			ProvinciaID,
			CiudadID,
			fechaPublicacion,
			Especificaciones,
			fecha_registro,
			Medidas,
			peso,
			Altura,
			Nacionalidad,
			ojos,
			pelo,
			
			Viaje,
			Web,
			Horario)
			values(
			'$idUsuario',
			'30',
			'0',
			'',
			'',
			'$f_nombre',
			'8',
			'$f_titulo',
			'$f_edad',
			'$f_email',
			'$f_categoria',
			'$f_telefono',
			'$f_whatsapp',
			'$f_telegram',
			'$f_descripcion',
			'$f_pais',
			'$f_provincia',
			'$f_ciudad',
			'$f_fechaReg',
			'$f_especificaciones'
			,NOW(),
			'$f_medidas',
			'$f_peso',
			'$f_altura',
			'$f_nacionalidad',
			'$f_ojos',
			'$f_pelo',
			
			'text',
			'text',
			'$f_horario')";
	//echo $sqlCli;die();
			if($mysqli->query($sqlCli))
			{
				$idInsert=$mysqli->insert_id;
				$idEscort=$idInsert;
				$contCantFotos = 0;
				
				
				/*******************************************************/
				$Item=$idInsert;
				$tablaGuardarFP=$Prefijo."escort_formas_pagos_registro";
				$tablaFP=$Prefijo."escort_formas_pagos";
				$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
				
				foreach ($f_forma_pago as $key => $value) {
					
					
						$mysqli->query("INSERT INTO $tablaGuardarFP (ID_escort,ID_forma_pago)values('".$Item."','".$value."')");
					
				}
				
					
				$tablaGuardarLA=$Prefijo."escort_lugares_atencion_registro";
				$tablaLA=$Prefijo."escort_lugares_atencion";
				$sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");
				
				foreach ($f_lugares as $key => $value) {
					
					$mysqli->query("INSERT INTO $tablaGuardarLA (ID_escort,ID_lugar_atencion)values('".$Item."','".$value."')");
				}
				
				foreach ($f_idiomas as $key => $value) {
					$mysqli->query("INSERT INTO reino01_escort_idiomas_registro (ID_escort,idioma_id)values('".$Item."','".$value."')");
				} 
				$tablaGuardarS=$Prefijo."escort_servicios_registro";
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
				/*******************************************************/
				
				
				$j=0;
				
				foreach ($_FILES['file']['name'] as $key) {
					$j++;
				}
				
				
				for($i=0;$i<=$j;$i++){




						
						$contCantFotos++;
						$tmp_name = $_FILES["file"]["tmp_name"][$i];
						$archivo=strtolower($_FILES['file']['name'][$i]);
						$arryArchivo=explode(".",$archivo);
						$ext=strtolower($arryArchivo[1]?? '');
						//print_r($archivo);die();


						if($ext == 'jpeg' or $ext  == 'JPEG' ){
							$ext = '.jpg';
						}

						
							$imgPincipal=0;
						
						
						$SQLGP="insert into reino01_foto_escort(IdEscort,Principal) 
									values ('$idEscort','$imgPincipal')";	
						
						$mysqli->query($SQLGP);
						$idImg=$mysqli->insert_id;
						
						$medio=$idEscort."_".$idImg.".".$ext;   
						$target_path = "fotos/".$medio;
			   
						if(@move_uploaded_file($tmp_name, $target_path))
						{
							$SQLMP="update reino01_foto_escort set Imagen='$medio' where ID='$idImg'";	
							
							$mysqli->query($SQLMP);

							//para imagen home
							$image = new ImageResize($target_path);
							$image->resize(130,180);
							$image->save('resize/home/borrar/'.$medio);
							$watermark = new Watermark();
							$watermark->apply('resize/home/borrar/'.$medio, 'resize/home/'.$medio, 'resize/watermark_home.png', 0);
							
							//para imagen escort
							$image->resize(188,243);
							$image->save('resize/escort/borrar/'.$medio);
							$watermark->apply('resize/escort/borrar/'.$medio, 'resize/escort/'.$medio, 'resize/watermark_escort.png', 0);
							
							//para imagen perfil
							$data = getimagesize($target_path);
							$width = $data[0];
							$height = $data[1];

							if($width > $height){
								$image->resizeToWidth(650);
								$image->save('resize/perfil/borrar/'.$medio);
								$watermark->apply('resize/perfil/borrar/'.$medio, 'resize/perfil/'.$medio, 'resize/watermark_perfil.png', 0);
							
							}
							else{
								$image->resizeToHeight(650);
								$image->save('resize/perfil/borrar/'.$medio);
								$watermark->apply('resize/perfil/borrar/'.$medio, 'resize/perfil/'.$medio, 'resize/watermark_perfil.png', 0);
							}
						
						}
						else
						{
							$SQLMP="delete from reino01_foto_escort where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}

					
						
						
						
				}

				
				define('UPLOAD_DIR', 'fotos/');
				$img = $_POST['imagen_principal'];;
				//$img = str_replace('data:image/png;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$imagenPrincipal = uniqid() . '.jpg';
				$file = UPLOAD_DIR . $imagenPrincipal;
				$success = file_put_contents($file, $data);
				$SQLip="insert into reino01_foto_escort(IdEscort,Principal,imagen) 
									values ('$idEscort','1','$imagenPrincipal')";	
				//		echo $SQLip;exit;
				$mysqli->query($SQLip);
				//para imagen home
				$image = new ImageResize($file);
				$image->resize(130,180);
				$image->save('resize/home/borrar/'.$imagenPrincipal);
				$watermark = new Watermark();
				$watermark->apply('resize/home/borrar/'.$imagenPrincipal, 'resize/home/'.$imagenPrincipal, 'resize/watermark_home.png', 0);
				
				//para imagen escort
				$image->resize(188,243);
				$image->save('resize/escort/borrar/'.$imagenPrincipal);
				$watermark->apply('resize/escort/borrar/'.$imagenPrincipal, 'resize/escort/'.$imagenPrincipal, 'resize/watermark_escort.png', 0);
				
				//para imagen perfil
				$data = getimagesize($file);
				$width = $data[0];
				$height = $data[1];

				if($width > $height){
					$image->resizeToWidth(650);
					$image->save('resize/perfil/borrar/'.$imagenPrincipal);
					$watermark->apply('resize/perfil/borrar/'.$imagenPrincipal, 'resize/perfil/'.$imagenPrincipal, 'resize/watermark_perfil.png', 0);
				
				}
				else{
					$image->resizeToHeight(650);
					$image->save('resize/perfil/borrar/'.$imagenPrincipal);
					$watermark->apply('resize/perfil/borrar/'.$imagenPrincipal, 'resize/perfil/'.$imagenPrincipal, 'resize/watermark_perfil.png', 0);
				}

			//	$mensaje="Ahora sube tus fotos para tener mas presentación ";
			//	$sqlDat="update reino01_Escort set IDusuario=$idInsert where ID='$idInsert'";
			//	$mysqli->query($sqlDat);


		$sql="select Nombre from reino01_Categoria where ID='$f_categoria'";
		
		$exSql=$mysqli->query($sql);
		$cantReg=mysqli_num_rows($exSql);
		if($cantReg>0)
		{
			$arry=mysqli_fetch_array($exSql);
			$retornarNombreCategoria= $arry["Nombre"];
		}		
		$sql="select Nombre from reino01_Pais where ID='$f_pais'";
		$exSql=$mysqli->query($sql);
		$cantReg=mysqli_num_rows($exSql);
		if($cantReg>0)
		{
			$arry=mysqli_fetch_array($exSql);
			$retornarNombrepais= $arry["Nombre"];
		}						

		$sql="select Nombre from reino01_Provincia where ID='$f_provincia'";
		$exSql=$mysqli->query($sql);
		$cantReg=mysqli_num_rows($exSql);
		if($cantReg>0)
		{
			$arry=mysqli_fetch_array($exSql);
			$retornarNombreProvincia= $arry["Nombre"];
		}		
		$sql="select Nombre from reino01_Ciudad where ID='$f_ciudad'";
		$exSql=$mysqli->query($sql);
		$cantReg=mysqli_num_rows($exSql);
		if($cantReg>0)
		{
			$arry=mysqli_fetch_array($exSql);
			$retornarNombreCiudad= $arry["Nombre"];
		}					
		
		
				$urlCliente=$URLSitio."escort/".urls_amigables($retornarNombreCiudad)."/".$idInsert."/".urls_amigables($f_nombre).".php";
		

				$dd=date('d');
				$mm=date('m');
				$aaaa=date('Y');
//Usamos el SetFrom para decirle al script quien envia el correo
$correo->SetFrom("publicidad@reinovip.com");
//Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
$correo->AddReplyTo("noreply@reinovip.com");
//Usamos el AddAddress para agregar un destinatario
$correo->AddAddress("publicidad@reinovip.com");
//Ponemos el asunto del mensaje
$correo->Subject = "Reino Vip PUBLICIDAD";
//Si deseamos enviar un correo con formato HTML utilizaremos MsgHTML:
$urlClientePanel=$URLSitio."modificar.php";
$correo->isHTML(true);
$correo->Body = "<font color='#000000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>
					<img src='http://i.minus.com/ioUvcmH9L7c3K.png' height='155px'><br><br>
					<div align=\"right\">".$LocalidadSitio.", ".$dd."/".$mm."/".$aaaa."</div><hr>
					Nombre: ".$f_nombre."<br>
					Categoria: ".$retornarNombreCategoria."<br>
					Teléfono: ".$f_telefono."<br>
					Email: ".$f_email."<br>
					País: ".$retornarNombrePais."<br>
					Provincia: ".$retornarNombreProvincia."<br>
					Ciudad: ".$retornarNombreCiudad."<br>
					Descripción: ".$f_descripcion."<br>
					URL de publicación: <a href=".$urlCliente.">".$urlCliente."</a><br>
					ip: ".$_SERVER['REMOTE_ADDR']."<br>
					</font>
	";
$correo->CharSet = 'UTF-8';
//$correo->Send();
$correo->SetFrom("publicidad@reinovip.com");
//Usamos el AddAddress para agregar un destinatario
$correo->AddAddress($f_email);
//Ponemos el asunto del mensaje
$correo->Subject = "Reino Vip PUBLICIDAD";
$correo->isHTML(true);
$correo->Body = "<img src='http://i.minus.com/ioUvcmH9L7c3K.png' height='155px'><br><br>
					<div align='center'>
					<font color='#000000' size='2' face='Verdana, Arial, Helvetica, sans-serif'>
					Gracias por contactarte con ReinoVip<br>
					Tu información ha sido guardada con éxito y tu publicación estará en listas despues de la aprobación de nuestro personal.<br/>
					</font></div>
					<br>Tu usuario y contraseña para poder modificar tu información es:<br>
					Usuario: ".$f_email."<br>
					Contraseña: ".$genPass."<br>
					<br><br><p style='color:#003300; font-weight:bold; font-family:Georgia, `Times New Roman`, Times, serif'>Publicidad Reino Vip<br>Call Center 983 44 00 77 - Atención al cliente</p>
				";
$correo->CharSet = 'UTF-8';
//$correo->Send();
				header("Location: registro_final.php");exit;

			}
	
?>