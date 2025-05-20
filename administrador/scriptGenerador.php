<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");

$Base=$Prefijo;

if (!$Base) {
	header("Location: admin.php?mensaje=Uso indebido del módulo <b>scriptGenerador</b>.");
	exit;
}

$CualTabla="";
$err=0;
$TablaE=$Base."estructura";
$SQL="SELECT * FROM $TablaE ORDER BY Nombretabla ASC";
$ResultadoEstructura=$mysqli->query($SQL);
while ($RegEstructura=mysqli_fetch_array($ResultadoEstructura)) {
    // debugging
	// echo $RegEstructura[Nombretabla]." :: ".$RegEstructura[Nombrecampo]."<br>";
	//
    if ($CualTabla != $RegEstructura['Nombretabla']) {
	    // creo la tabla y armo la cabecera
		$CualTabla=$RegEstructura['Nombretabla'];
		$NombreTabla=$Base.$CualTabla;
		$SQL="CREATE TABLE `$NombreTabla` (`ID` BIGINT(10) UNSIGNED NOT NULL) ";	
		$ResultadoCreate=$mysqli->query($SQL);
		$err=$err+mysql_error();
		$SQL="ALTER TABLE `$NombreTabla` ADD PRIMARY KEY (ID)";
		$ResultadoAlter=$mysqli->query($SQL);
		$err=$err+mysql_error();
		$SQL="ALTER TABLE `$NombreTabla` CHANGE `ID` `ID` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT";
		$ResultadoAlter=$mysqli->query($SQL);
		$err=$err+mysql_error();
        $SQL="ALTER TABLE `$NombreTabla` ADD `Publico` TINYINT(1) UNSIGNED DEFAULT '1' NOT NULL";
		$ResultadoAlter=$mysqli->query($SQL);
		$err=$err+mysql_error();
	}
	$NombreCampo=$RegEstructura['Nombrecampo'];
	$TipoCampo=$RegEstructura['Tipodelcampo'];
	$SQL="ALTER TABLE `$NombreTabla` ADD `$NombreCampo` $TipoCampo NOT NULL";
	$ResultadoAlter=$mysqli->query($SQL);
	$err=$err+mysqli_error();	
}
if ($err) {
    header("Location: admin.php?mensaje=Error <b>$err</b>: Las tablas no pudieron ser creadas.");
} else {
    header("Location: admin.php?mensaje=Las tablas fueron creadas con éxito.");
}
?>
