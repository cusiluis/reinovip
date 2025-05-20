<?php

require("../includes/globales.inc.php");

require("../includes/conexion.inc.php");



   // Edit upload location here

    $idBann=$_POST['idBann'];

	$archivo=$_FILES['myfile']['name'];

	$arryArchivo=explode(".",$archivo);

	$ext=$arryArchivo[1];



	$target_path = "../banners/".$archivo;

   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {

		$SQLGC="update reino01_Banner set ArchivoMultimedia='$archivo' where ID='$idBann'";	

		if($mysqli->query($SQLGC))

      	{$result = 1;}

		else

		{$result = 0;}

   }

   else

   {

      $result = 0;

   }

   

   sleep(1);
header("Location: http://reinovip.com/administrador/ModRegistro.php?tabla=Banner&id=".$idBann."&filtro=&front= ");exit;
?>





