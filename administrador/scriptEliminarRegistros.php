<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("admin.traducciones.php");

$CualTabla=$_GET["tabla"];
if (($CualTabla=="") or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptEliminarRegistros.");
    exit;
}
$tabla=$Prefijo.$CualTabla;
$SQL="SELECT ID FROM $tabla WHERE Publico='2' ";
$ResultConsulta=$mysqli->query($SQL);
$cantreg=mysqli_num_rows($ResultConsulta);
$SQL="DELETE FROM $tabla WHERE Publico='2' ";
$ResultEliminar=$mysqli->query($SQL);
$err=mysqli_error();
if ($err=="") {
	$mensaje=$tit_eliminadobien.": ".$cantreg." ".$tit_registros.".";
	header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=".$mensaje);
	exit;
} else {
	$mensaje=$tit_error.": <b>".$err."</b> ".$error_aleliminar.".";
	header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=".$mensaje);
	exit;
}
?>