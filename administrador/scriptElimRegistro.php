<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");
include("admin.traducciones.php");

$CualTabla=$_GET["tabla"];
$NombreTabla=$Prefijo.$CualTabla;
$Item=$_GET["id"];
if (!$CualTabla) {
    header("Location: index.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptElimRegistro.");
    exit;
}
if (!$Item) {
    header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptElimRegistro.");
    exit;
}
$SQL="UPDATE $NombreTabla SET Publico='2' WHERE ID='$Item'";
$borrar=$mysqli->query($SQL);
$err=mysqli_error();

$volver=$_GET['backto'];
if ($volver=="") {
	if ($err=="") {
		$mensaje=$tit_elitem.": <b>".$Item."</b> ".$tit_eliminadobien.".";
    	header("Location: listarTabla.php?tabla=$CualTabla&filtro=$filtro&titulo=$titulo&mensaje=".$mensaje);
	} else {
		$mensaje=$tit_error.": <b>".$err."</b>: ".$error_aleliminar.": ".$Item.".";
    	header("Location: listarTabla.php?tabla=$CualTabla&filtro=$filtro&titulo=$titulo&mensaje=".$mensaje);
	}
} else {
	if (strpos($volver,'?')) {
	} else {
		$volver.="?ref=1";
	}
	if ($err=="") {
		$mensaje=$tit_elitem.": <b>".$Item."</b> ".$tit_eliminadobien.".";
    	header("Location: $volver&tabla=$CualTabla&filtro=$filtro&titulo=$titulo&mensaje=".$mensaje);
	} else {
		$mensaje=$tit_error.": <b>".$err."</b>: ".$error_aleliminar.": ".$Item.".";
    	header("Location: $volver&tabla=$CualTabla&filtro=$filtro&titulo=$titulo&mensaje=".$mensaje);
	}
}
?>