<?php

require("../includes/globales.inc.php");

require("../includes/conexion.inc.php");



   // Edit upload location here

    $idFotoScort=$_POST['id'];

	$idEscort=$_POST['idEscort'];

	$mensaje="";



		$sqlm="select  f.*

		from reino01_foto_escort f 

		where f.ID='$idFotoScort'";

		$resultm=$mysqli->query($sqlm) or die ("error en el query registro de fotos" .mysqli_error());

		$numMed=mysqli_num_rows($resultm);

		if($numMed>0)

		{

			$arryM=mysqli_fetch_array($resultm);

			if($arryM['Principal']==1)

			{$mensaje="No puede eliminar una foto que es principal, primero cambie el estado de la foto que desea eliminar";}

			else

			{

			$sqlElimImagen="delete from reino01_foto_escort where ID='$idFotoScort'";

			$mysqli->query($sqlElimImagen);

			unlink("../fotos/".$arryM['Imagen']);

			$mensaje="";}

		}

		else

		{$mensaje="No existe la foto especificada";}

		//sleep(1);
		echo $mensaje;
		

		

?>