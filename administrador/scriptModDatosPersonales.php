<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");
include("admin.traducciones.php");

//
$dp_nombre=$_POST['dp_nombre'];
$dp_clave=$_POST['dp_clave'];
//
$Item=$_GET["id"];
$err="";

$tablaLog=$Prefijo."logueo";
$SQL="UPDATE $tablaLog SET Nombre='$dp_nombre', ".
			"Contrasenia='$dp_clave' WHERE ID='$Item'";
$Result=$mysqli->query($SQL);
$err.=mysqli_error();
if ($err!="") {
	$mensaje=$tit_error.": <b>".$err."</b>: ".$error_almodificardatospersonales.".";
    header("Location: admin.php?mensaje=".$mensaje);
} else {
	$mensaje=$tit_datospersonalesbien.".";
    header("Location: admin.php?mensaje=".$mensaje);
}
?>