<?php 



include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");
$provincia_id=$_POST['provincia'];
$sql="SELECT * from reino01_pie where provincia_id='$provincia_id'";
$result=$mysqli->query($sql);
if($data=mysqli_fetch_array($result)){

	header("Location: listar.php?tabla=insertarpie&error=1");exit;	

}
else{

						$provincia_id=$_POST['provincia'];
						
						$datos=split(',',$_POST['datospie']);

						for ($i=0; $i <count($datos);$i++) { 

						$SQLGP="insert into reino01_pie(nombre,provincia_id) 
									values ('$datos[$i]','$provincia_id')";	
						//echo $SQLGP;die();
						$mysqli->query($SQLGP);	
					}
	
				header("Location: listar.php?tabla=PieProvincias");exit;
}
?>