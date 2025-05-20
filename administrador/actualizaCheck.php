<?php 
	include("../includes/globales.inc.php");
	include("../includes/conexion.inc.php");

	if (isset($_GET['valor'])) {
		echo $valor = $_GET['valor'];
		echo $id = $_GET['id'];
		echo $url = $_GET['url'];
		$sqlEstado = "UPDATE reino01_banner_ciudades 
					SET estado='$valor' 
					WHERE id='$id'";
		$Resultprov=$mysqli->query($sqlEstado) or die (mysqli_error());
	header("Location: http://www.reinovip.es".$url);
	} else {
		echo "HUBO UN PROBLEMA AL GUARDAR LOS DATOS POR FAVOR INTENTE MAS TARDE";
	}
	

?>