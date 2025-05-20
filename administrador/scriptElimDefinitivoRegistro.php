<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");
include("admin.traducciones.php");

$CualTabla=$_GET["tabla"];
$NombreTabla=$Prefijo.$CualTabla;
$Item=$_GET["id"];
if ((!$CualTabla) or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptElimDefinitivoRegistro.");
    exit;
}
if (!$Item) {
    header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptElimDefinitivoRegistro.");
    exit;
}
$SQL="DELETE FROM $NombreTabla WHERE ID='$Item'";
//tiene una falla, quedan colgados los archivos asociados, habria que arreglarlo !
$EjecutarBorrado=$mysqli->query($SQL);	
$err=mysqli_error();
if ($EjecutarBorrado) {
	$mensaje=$tit_elitem.": <b>".$Item."</b> ".$tit_eliminadobien.".";
    header("Location: recuperarTabla.php?tabla=".$CualTabla."&mensaje=".$mensaje);
} else {
	$mensaje=$tit_error.": <b>".$err."</b>: ".$error_aleliminar.": ".$Item.".";
    header("Location: recuperarTabla.php?tabla=".$CualTabla."&mensaje=".$mensaje);
}
?>