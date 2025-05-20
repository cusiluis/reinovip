<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
require_once "class.writeexcel_workbook.inc.php";
require_once "class.writeexcel_worksheet.inc.php";
set_time_limit(10);

$CualTabla=$_GET['tabla'];
$tablaE=$Prefijo.'estructura';
$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND Nrodeordenback!=0 AND Nrodeordenfront!=0 ORDER BY Nrodeordenfront,Nrodeordenback";
$DatoResult=$mysqli->query($SQL);
$DatoResult2=$mysqli->query($SQL);
$DatoResult3=$mysqli->query($SQL);

$fname = tempnam("temp", "$tabla.xls");
$workbook = &new writeexcel_workbook($fname);
$worksheet =& $workbook->addworksheet();

# Create a format for the column headings
$c_header =& $workbook->addformat();
$c_header->set_bold();
$c_header->set_size(11);

# Create a format for the stock price
$c_texto =& $workbook->addformat();
$c_texto->set_align('left');

$c_numero =& $workbook->addformat();
$c_numero->set_align('right');


# Write out the data
$i=0;
while ($Datos=mysqli_fetch_array($DatoResult)){
	$worksheet->set_column($i, $i, 25);
	$i++;
}


$i=0;
while ($Datos=mysqli_fetch_array($DatoResult2)){
	$worksheet->write(0, $i, $Datos['Nombrecampo'],   $c_header);
	$i++;
}



$i=1;
$Tabla=$Prefijo.$CualTabla;
$SQL="SELECT * FROM $Tabla WHERE Publico=1";
$Result=$mysqli->query($SQL);
while ($Tabla=mysqli_fetch_array($Result)){
	$tablaE=$Prefijo.'estructura';
	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND Nrodeordenback!=0 AND Nrodeordenfront!=0 ORDER BY Nrodeordenfront,Nrodeordenback";
	$DatoResult=$mysqli->query($SQL);
	$j=0;
	while ($Dato=mysqli_fetch_array($DatoResult)){
		$campo=$Dato['Nombrecampo'];		
		if (strstr($Dato['Tipodelcampo'],'INT') || strstr($Dato['Tipodelcampo'],'DECIMAL')) $tipo=$c_numero;
		else $tipo=$c_texto;
		if ($Dato['Tipodeentrada']=='RADIO'){
			$valores=explode('|',$Dato['Valores']);
			$worksheet->write($i, $j, $valores[$Tabla[$campo]-1],   $tipo);
		}else{
			if ($Dato['Tipodeentrada']=='TABLA'){
				$tabla_relacionada=explode('=',$Dato['Provienedetablarelacionada']);
				$id_dato=$Tabla[$campo];
				$Campo2=$tabla_relacionada[1];
				$Tabla2=$Prefijo.$tabla_relacionada[0];
				$SQL2="SELECT $Campo2 FROM $Tabla2 WHERE ID=$id_dato";
				$Result2=@$mysqli->query($SQL2);
				if (mysqli_num_rows($Result2)!=0) {
					$Dato2=@mysqli_fetch_array($Result2);
					$worksheet->write($i, $j, $Dato2[$Campo2], $tipo);
				}else{
					$worksheet->write($i, $j, $Tabla[$campo], $tipo);
				}
			}else{
				if ($Dato['Tipodeentrada']=='CALENDARIO' || $Dato['Tipodeentrada']=='FECHA' ){
					if (strstr($Tabla[$campo],'-')) { 
						$fecha=explode('-',$Tabla[$campo]);
						$worksheet->write($i, $j, $fecha[2].'/'.$fecha[1].'/'.$fecha[0], $tipo);
					}else{
						$worksheet->write($i, $j, $Tabla[$campo], $tipo);
					}
				}else{
					$worksheet->write($i, $j, $Tabla[$campo], $tipo);
				}
			}
		}
		$j++;
	}
	$i++;
}



$workbook->close();

header("Content-Type: application/x-msexcel; name=\"$tabla.xls\"");
header("Content-Disposition: inline; filename=\"$tabla.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>