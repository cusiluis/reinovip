<?php

// idioma - toma idioma y genera variable de $_SESSION

session_start();

//header("Cache-control: private");

$idioma=$_GET['idioma'];

if ($idioma!="") {

	if ($_SESSION['sitestyle']!="") {

		$_SESSION['sitestyle']=$idioma;



	} else {



		session_register('sitestyle');



		$_SESSION['sitestyle']=$idioma;

	}

}



if ($idioma=="") $idioma=$_SERVER['HTTP_ACCEPT_LANGUAGE'];



$gLANG=substr($idioma,0,2);



$sitestyle=$_SESSION['sitestyle'];



if ($sitestyle=="") $sitestyle=$gLANG;



if ($sitestyle=="") $sitestyle="es"; //idioma por default: es-> español



if ($_SESSION['sitestyle']!="") {



	$_SESSION['sitestyle']=$sitestyle;



} else {



	


	$_SESSION['sitestyle']=$sitestyle;

}



//-------------------------------------------------------------------------------------------------------------



//------ ADMINISTRADOR ----------------------------------------------------------------------------------------



//-------------------------------------------------------------------------------------------------------------

$adminstyle="es";



$hastadonde=$_SESSION['cantporpagina'];

if ($hastadonde=="") $hastadonde=40;

$cantregxpag=$_POST['cantregxpag'];

if ($cantregxpag!="") $hastadonde=$cantregxpag;

if ($_SESSION['cantporpagina']!="") {

$_SESSION['cantporpagina']=$hastadonde;



} else {



	



	$_SESSION['cantporpagina']=$hastadonde;

}



//*** administrador utf-8 ***

$admin_en_utf8 = true;

$sitio_en_utf8 = true;



function utf8 ($texto){

  global $admin_en_utf8;



  global $sitio_en_utf8;

	if (($admin_en_utf8==true) or ($sitio_en_utf8==true)) {

		return utf8_encode($texto);

	} else {

		return $texto;

	}



}



//***



//--FIN ADMINISTRADOR -------------------------------------------------------------------------------------------



//prefijo de las tablas (solo para esta aplicacion)

$Prefijo="reino01_";



//datos de conexion principal

//$HostPrincipal="201.235.253.67";
//$HostPrincipal="201.235.253.67";
//$HostPrincipal="167.250.5.10";

$HostPrincipal="192.168.0.123";
$UsuarioPrincipal="root";
// $ClavePrincipal="5CJPPYUR6h";
$ClavePrincipal="root";
$BasePrincipal="reinovip4";


$MensajeDeErrorConexion = "";



$FTPhost="ftp.reinovip.com";

$FTPpublica="";

$FTPrelativa="";

$FTPuser="rv2@reinovip.com";

$FTPpass="0913ReinoVip";



//variables del sitio

$NombreSitio = "Reino Vip";

$TituloSitio = "Reino Vip";

$URLSitio = "http://localhost/reinovip/";

$EmailSitio = "publicidad@reinovip.com";

$DireccionSitio = "Parque Tecnológico de Castilla y León C/Luis Proust, Parcela 3.2.2.";

$CodigoPostalSitio = "47151";

$LocalidadSitio = "Boecillo (Valladolid)";

$PaisSitio = "España";

$TelefonoSitio = "+34 983 395 905";

$FaxSitio = "+34 983 395 905";

$EmailTesteo = "test.reinovip@vedcora.es";

$EmailVentas_1=$EmailSitio; 

$PrecioPublicacion=74;



//variables de envio de correo   // EnvioDeCorreo.php

$TablaSuscriptores = $Prefijo."Suscriptor";

$TablaCategoriaSuscriptores = $Prefijo."CategoriaSuscriptor";

$TablaMailsMasivos = $Prefijo."MailsMasivos";

$EmailDesde = "";

$EmailDesdeNombre = "Reino VIP :: Boletín";

$mensajeprueba = "";

$mensajeenvio = "";

$mensajegrabado = "";



//variables genericas

$TablaEstructura=$Prefijo."estructura";

$TablaMenu=$Prefijo."menu";

$TablaFiltros=$Prefijo."filtros";

$LongitudMaximaDeCampoEnPantalla = 80;

$ValidacionDeCampos = "";

$NombresCampos = "";

$ContenidoCampos = "";

$Abortar = 0;

$TasaIVA=0;





function strtolower_utf8($inputString) {



    $outputString    = utf8_decode($inputString);

    $outputString    = strtolower($outputString);

    $outputString    = utf8_encode($outputString);

    return $outputString;

}



function urls_amigables($url) {



	// Tranformamos todo a minusculas



	$url = strtolower_utf8($url);



	//Rememplazamos caracteres especiales latino



	$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ','Ñ','Á','É','Í','Ó','Ú');

	$repl = array('a', 'e', 'i', 'o', 'u', 'n','n','a','e','i','o','u');

	$url = str_replace ($find, $repl, $url);



	// Añadimos los guiones



	$find = array(' ', '&', '\r\n', '\n', '+');

	$url = str_replace ($find, '-', $url);



	// Eliminamos y Reemplazamos dem�s caracteres especiales

	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

	$repl = array('', '-', '');

	$url = preg_replace ($find, $repl, $url);

	return $url;



}



foreach($_POST AS $key => $value) {



    ${$key} = $value;

}

foreach($_GET AS $key => $value) {



    ${$key} = $value;



}



?>