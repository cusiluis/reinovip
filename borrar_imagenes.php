
<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");


$id=$_GET['id'];

//$buscDatos=$mysqli->query("");

	$sql="delete   from reino01_foto_escort where ID = '$id' ";
    

	$ResultCat=$mysqli->query($sql);
	header("Location: publicaciones.php");exit;
?>