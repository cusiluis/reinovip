
<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//echo '<pre>';print_r($_FILES);
//echo '<pre>';print_r($_SESSION);
//echo '<pre>';print_r($_POST);exit;
//echo '<pre>';print_r($_FILES);exit;

include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

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

	$nombre = $_POST["nombre_agencia"];
	$descripcion = $_POST["descripcion_agencia"];
    $web = $_POST["web"];
    $telefono = $_POST["telefono_1"];
    $paisId = $_POST["pais"];
    $provinciaId = $_POST["provincia"];
    $ciudadId = $_POST["ciudad"];

	if(isset($_FILES['imagen_agencia'])){
        
        $tmp_name = $_FILES["imagen_agencia"]["tmp_name"];
        $archivo=strtolower($_FILES['imagen_agencia']['name']);
        $arryArchivo=explode(".",$archivo);
        $ext=strtolower($arryArchivo[1]?? '');
        if($ext == 'jpeg' or $ext  == 'JPEG' ){
            $ext = '.jpg';
        }
        $medio=$_SESSION['usuario_id']."_".rand(0,100).".".$ext;   
        
        $target_path = "fotos/".$medio;


        
        if(@move_uploaded_file($tmp_name, $target_path))
        {
            $SQLMP="UPDATE agencias set imagen_principal = '$medio' where usuario_id = ".$_SESSION['usuario_id'];	
           //echo 	$SQLMP;exit;						
            $mysqli->query($SQLMP);
        }

    }
    $sql = "UPDATE agencias set nombre_agencia = '$nombre', descripcion = '$descripcion' , web = '$web', telefono_1 = '$telefono', pais_id = '$paisId',
    provincia_id = '$provinciaId', ciudad_id = '$ciudadId' 
    WHERE usuario_id = ".$_SESSION['usuario_id'];
	//echo $sql;exit;
    $mysqli->query($sql);
    
	header("Location: publicaciones.php");exit;		
	
?>