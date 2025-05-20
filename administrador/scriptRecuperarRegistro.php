<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");
include("admin.traducciones.php");

$CualTabla=$_GET["tabla"];
$NombreTabla=$Prefijo.$CualTabla;
$Item=$_GET["id"];
if (!$CualTabla) {
    header("Location: index.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptRecuperarRegistro.");
    exit;
}
if (!$Item) {
    header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptRecuperarRegistro.");
    exit;
}
$SQL="UPDATE $NombreTabla SET Publico='0' WHERE ID='$Item'";
$EjecutarRecuperado=$mysqli->query($SQL);	
$err=mysqli_error();
if ($err=="") {
	$mensaje=$tit_elitem.": <b>".$Item."</b> ".$tit_recuperadobien.".";
    header("Location: recuperarTabla.php?tabla=".$CualTabla."&mensaje=".$mensaje);
} else {
	$mensaje=$tit_error.": <b>".$err."</b>: ".$error_alrecuperar.": ".$Item.".";
    header("Location: recuperarTabla.php?tabla=".$CualTabla."&mensaje=".$mensaje);
}
?>