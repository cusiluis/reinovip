<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");



if(!empty($_POST['id'])){
	
	
	$i=0;
	foreach ($_POST['id'] as $datos) {
		$data[$i]['id']=$_POST['id'][$i];
		$data[$i]['imagen']=$_POST['imagen'][$i];
		$data[$i]['url']=$_POST['url'][$i];
		$data[$i]['tiempo']=$_POST['tiempo'][$i];
		$i++;
	}
	foreach ($data as $value) {
		
		$id=$value['id'];
		$url=$value['url'];
		$tiempo=$value['tiempo'];
		$imagen=$value['imagen'];
		$sql="UPDATE reino01_banner_ciudades SET imagen='$imagen', url='$url',tiempo='$tiempo' WHERE id='$id'";
		$result=$mysqli->query($sql);
	}

}
$provincia_id=$_GET['id'];

if(!empty($_FILES)){

	$sql="SELECT posicion FROM reino01_banner_ciudades WHERE provincia_id='$provincia_id' GROUP BY posicion DESC LIMIT 0,1";
						$result=$mysqli->query($sql);
						$data=mysqli_fetch_array($result);
						
						$ultima_posicion=$data['posicion'];

	foreach ($_FILES['file']['name'] as $key) {
					$j++;
				}
				//print_r($j);die();
				// for($i=0;$i<=$j;$i++){ //ED- original
				for($i=0;$i<$j;$i++){
		
						$tmp_name = $_FILES["file"]["tmp_name"][$i];
						$name = $_FILES["file"]["name"][$i];
						$archivo=$_FILES['file']['name'][$i];
						$arryArchivo=explode(".",$archivo);
						$ext=$arryArchivo[1];
						$ultima_posicion=$ultima_posicion+1;
						//print_r($archivo);die();
						$SQLGP="insert into reino01_banner_ciudades(provincia_id,imagen,posicion) 
									values ('$provincia_id','$name','$ultima_posicion')";	
						//echo $SQLGP;die();
						$id_imagen=$mysqli->query($SQLGP);

						$last="SELECT * FROM reino01_foto_escort ORDER BY ID DESC";
						$mysqli->query($last);
						while ($row=mysqli_fetch_array($last)) {
							$idImg= $row['ID'];
						}
						//$idImg=$mysqli->insert_id($id_imagen);
						
						$medio=$name; 
						$target_path = "../fotos/banner/".$medio;
			   
						if(@move_uploaded_file($tmp_name, $target_path))
						{
							$SQLMP="update reino01_banner_ciudades set imagen='$medio' where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}
						else
						{
							$SQLMP="delete from reino01_banner_ciudades where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}
				}

}
$path = $_POST['path'];
header('Location: http://www.reinovip.es'.$path);exit;

?>