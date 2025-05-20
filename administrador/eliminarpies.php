<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");


if(isset($_GET['id'])){

	$provincia_id=$_GET['id'];
	$sql="DELETE FROM reino01_pie WHERE provincia_id='$provincia_id'";
	$result=$mysqli->query($sql);
}
header('Location:http://www.reinovip.es/administrador/listar.php?tabla=PieProvincias	');exit;
?>