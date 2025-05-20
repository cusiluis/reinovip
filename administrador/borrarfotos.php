<?php

include("../includes/globales.inc.php");

include("../includes/conexion.inc.php");

include("../includes/libreria.inc.php");

include("admin.traducciones.php");



$nombreusuario=$_SESSION['usuariolog'];

if(isset($_POST['foto']) and !empty($_POST['foto'])){


$fotos=$_POST['foto'];
	$id=$_POST['idEscort'];
	foreach ($fotos as $value) {
		
		
		$sql="delete from reino01_foto_escort where ID='$value'";
		//echo $sql;
		$resultm=$mysqli->query($sql) or die ("error en el query registro de fotos" .mysqli_error());
	}
	
	header("Location: http://reinovip.es/administrador/ModRegistro.php?tabla=Escort&id=".$id."&filtro=&front= ");exit;
}
else{
	$id=$_POST['idEscort'];
	header("Location: http://reinovip.es/administrador/ModRegistro.php?tabla=Escort&id=".$id."&filtro=&front= ");exit;
}
?>