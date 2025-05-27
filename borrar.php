
<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");


$id=$_GET['id'];

//$buscDatos=$mysqli->query("");

	$sql="delete   from reino01_Escort where ID = '$id' ";
    

	$ResultCat=$mysqli->query($sql);
	header("Location: publicaciones.php");exit;
?>