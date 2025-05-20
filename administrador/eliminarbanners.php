<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");


if(isset($_GET['id'])){

	$provincia_id=$_GET['id'];
	$sql="DELETE FROM reino01_banner_ciudades WHERE provincia_id='$provincia_id'";
	$result=$mysqli->query($sql);
}
header('Location:http://www.reinovip.com/nuevovip/administrador/listar.php?tabla=BannerCiudades');exit;
?>