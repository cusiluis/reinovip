<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");

   // Edit upload location here
    $idImg=$_POST['id'];
	$mensaje="";
	
	$sqlBuscImg="select ArchivoMultimedia from reino01_Banner where ID='$idImg' ";
	$arryIm=mysqli_fetch_array($mysqli->query($sqlBuscImg));

	$sqlElimImagen="update reino01_Banner set ArchivoMultimedia='' where ID='$idImg'";

	
	if(unlink("../banners/".$arryIm['ArchivoMultimedia']))
	{
		if($mysqli->query($sqlElimImagen))
		{$mensaje="";}
		else
		{$mensaje="No se ha podido eliminar la imagen";}
	}
	else
	{$mensaje="No se ha podido eliminar la imagen";}
	sleep(1);
	echo $mensaje;
?>