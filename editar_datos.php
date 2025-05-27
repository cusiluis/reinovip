
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
//echo '<pre>';print_r($_POST);exit;
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
require_once('includes/class.phpmailer.php');
include_once('resize/ImageResize.php');
use \Eventviva\ImageResize;
include_once('resize/watermark.php');

$correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()



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
	$idEscort = $_POST['escort_id'];
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
	$f_idiomas = $_POST['f_idiomas'];
	$f_horarios = $_POST["f_horario"];
	$f_lugares = explode(',',$_POST['f_lugares']);
	$f_whatsapp = $_POST["f_whatsapp"]=='on'?1:0;
	$f_telegram = $_POST["f_telegram"]=='on'?1:0;
    $f_forma_pagos = $_POST["forma_pago"];
	
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
                $sqlCli = "UPDATE reino01_Escort set Nombre = '$f_nombre', CategoriaID = '$f_categoria', Telefono = '$f_telefono',
                        Edad = '$f_edad', Horario = '$f_horarios', whatsapp = '$f_whatsapp', telegram = '$f_telegram',
                         ProvinciaID = '$f_provincia', PaisID = '$f_pais', CiudadID = '$f_ciudad', 
                        Comentario = '$f_descripcion', Medidas = '$f_medidas', peso = '$f_peso', ojos = '$f_ojos', pelo = '$f_pelo',
                        Altura = '$f_altura', Nacionalidad = '$f_nacionalidad' WHERE ID = '$idEscort' ";
			
	//echo $sqlCli;die();
			if($mysqli->query($sqlCli))
			{
			//	$idInsert=$mysqli->insert_id;
				//$idEscort=$_POST["id_escort"];
				$contCantFotos = 0;
				
				
				/*******************************************************/
				$Item=$idInsert;
				$tablaGuardarFP=$Prefijo."escort_formas_pagos_registro";
				$tablaFP=$Prefijo."escort_formas_pagos";
				$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
				$mysqli->query("DELETE FROM $tablaGuardarFP where ID_escort = ".$idEscort." ");
				foreach ($f_forma_pagos as $key => $value) {
						$mysqli->query("INSERT INTO $tablaGuardarFP (ID_escort,ID_forma_pago)values('".$idEscort."','".$value."')");
				}
				
				
					
				$tablaGuardarLA=$Prefijo."escort_lugares_atencion_registro";
				$tablaLA=$Prefijo."escort_lugares_atencion";
				$sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");
				
				$mysqli->query("DELETE FROM $tablaGuardarLA where ID_escort = ".$idEscort." ");
                foreach ($f_lugares as $key => $value) {
					
					$mysqli->query("INSERT INTO $tablaGuardarLA (ID_escort,ID_lugar_atencion)values('".$idEscort."','".$value."')");
				}
				
                //idiomas 
                $mysqli->query("DELETE FROM reino01_escort_idiomas_registro where ID_escort = ".$idEscort." ");

            
				foreach ($f_idiomas as $key => $value) {
                  //  echo "INSERT INTO reino01_escort_idiomas_registro (ID_escort,idioma_id)values('".$idEscort."','".$value."')";exit;
					$mysqli->query("INSERT INTO reino01_escort_idiomas_registro (ID_escort,idioma_id)values('".$idEscort."','".$value."')");
				} 
				$tablaGuardarS=$Prefijo."escort_servicios_registro";
				$tablaS=$Prefijo."escort_servicios";
				$sqlS = $mysqli->query("select * from $tablaS where Publico='1'");
		
				while($arryS = mysqli_fetch_array($sqlS))
				{
					$idS=$arryS["ID"];
					if(isset($_POST['S_'.$idS]) && $_POST['S_'.$idS]==1)
					{
                        
						$mysqli->query("INSERT INTO $tablaGuardarS (ID_escort,ID_servicio)values('".$idEscort."','".$arryS["ID"]."')");
					}
				}
				/*******************************************************/
              
				
		

				
//$correo->Send();
				header("Location: publicaciones.php");exit;

			}
	
?>