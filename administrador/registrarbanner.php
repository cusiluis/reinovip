<?php 



include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");
$provincia_id=$_POST['provincia'];
$sql="SELECT * from reino01_banner_ciudades where provincia_id='$provincia_id'";
$result=$mysqli->query($sql);
if($data=mysqli_fetch_array($result)){

	header("Location: listar.php?tabla=insertarbanner&error=1");exit;	

}
else{

				$j=0;
				foreach ($_FILES['file']['name'] as $key) {
					$j++;
				}
				//print_r($j);die();
				for($i=0;$i<=$j;$i++){




						$provincia_id=$_POST['provincia'];
						$contCantFotos++;
						$tmp_name = $_FILES["file"]["tmp_name"][$i];
						$name = $_FILES["file"]["name"][$i];
						$archivo=$_FILES['file']['name'][$i];
						$arryArchivo=explode(".",$archivo);
						$ext=$arryArchivo[1];
						//print_r($archivo);die();
						
						if($contCantFotos==1)
						{
							$imgPincipal=1;
						}
						else
						{
							$imgPincipal=0;
						}
						
						$SQLGP="insert into reino01_banner_ciudades(provincia_id,imagen,posicion) 
									values ('$provincia_id','$name','$i')";	
						//echo $SQLGP;die();
						$mysqli->query($SQLGP);
						$idImg=mysqli_insert_id();
						
						$medio=$name; 
						$target_path = "../fotos/banner/".$medio;
			   
						if(@move_uploaded_file($tmp_name, $target_path))
						{
							$SQLMP="update reino01_banner_ciudades set Imagen='$medio' where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}
						else
						{
							$SQLMP="delete from reino01_banner_ciudades where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}
				}
				header("Location: listar.php?tabla=BannerCiudades");exit;
}
?>