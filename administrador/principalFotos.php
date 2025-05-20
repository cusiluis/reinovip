<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");

   // Edit upload location here
    $idFotoScort=$_POST['id'];
	$idEscort=$_POST['idEscort'];

		$sqlm="update reino01_foto_escort set Principal=0 where IdEscort='$idEscort'";
		$mysqli->query($sqlm) or die ("error en el query actualización del estado principal de las fotos" .mysqli_error());

		$sqlmf="update reino01_foto_escort set Principal=1 where ID='$idFotoScort'";
		$mysqli->query($sqlmf) or die ("error en el query actualización del estado principal de las fotos" .mysqli_error());

?>