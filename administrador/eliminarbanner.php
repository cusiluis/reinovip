<?php


include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");


$id=$_GET['id'];
$provincia_id=$_GET['provincia_id'];

	
	


		$sql="DELETE  FROM reino01_banner_ciudades WHERE id='$id' and provincia_id='$provincia_id'";
		//echo $sql;die();
		$mysqli->query($sql);
		header("Location: editarbanners.php?id=".$provincia_id);exit;
	

?>