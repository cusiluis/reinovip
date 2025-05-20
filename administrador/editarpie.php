<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");

//echo '<pre>'; print_r($_POST);exit;
if(!empty($_POST)){
	
	foreach ($_POST['data']['id'] as $key => $value) {

		$url=$_POST['data']['url'][$key];
		$nombre = $_POST['data']['nombre'][$key];
		$provincia_id=$_POST['data']['provincia_id'][$key];
		$sql="UPDATE reino01_pie SET url='$url', nombre='$nombre' WHERE ID='$value'";
		$mysqli->query($sql);
		
	}
	if(!empty($_POST['datospie'])){
		
						$provincia_id=$_POST['provincia_id'];
						
						$datos=explode(',',$_POST['datospie']);

						for ($i=0; $i <count($datos);$i++) { 

						$SQLGP="insert into reino01_pie(nombre,provincia_id) 
									values ('$datos[$i]','$provincia_id')";	
						//echo $SQLGP;die();
						$mysqli->query($SQLGP);	
					}
	
				header("Location: listar.php?tabla=PieProvincias");exit;
	}
}



header('Location:http://www.reinovip.es/administrador/listar.php?tabla=PieProvincias');exit;

?>