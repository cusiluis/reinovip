<?php

require("../includes/globales.inc.php");

require("../includes/conexion.inc.php");

include("../includes/libreria.inc.php");

include("admin.traducciones.php");
include_once('../resize/ImageResize.php');
// include_once('../resize/watermark.php');
use \Eventviva\ImageResize;
$nombreusuario=$_SESSION['usuariolog'];
   // Edit upload location here
$idEscort=$_GET['id'];

if(!empty($_FILES)){

	
	$j=0;
	//print_r($_FILES);
	foreach ($_FILES['file']['name'] as $key) {
					$j++;
			}
				//print_r($j);die();
			

			

				for($i=0;$i<$j;$i++){


						$length=5;
						$rand = '';
    					$keys = array_merge(range(0, 9), range('a', 'z'));

			    		for ($h = 0; $h < $length; $h++) {
			        	$rand .= $keys[array_rand($keys)];
			    		}

						$tmp_name = $_FILES["file"]["tmp_name"][$i];
						$name = strtolower($rand.$_FILES["file"]["name"][$i]);
						$extension = explode('.', $name);
						if($extension['1']== 'jpeg'  or $extension['1']  == 'JPEG'){
							$name = $extension['0'].'.jpg';
						}
						// $name = str_replace('..', '.', $name);
						$random_name = rand(1, 1000000);
						$ext = '.jpg';
						$name = $idEscort."_".$random_name.$ext;
						$archivo=$_FILES['file']['name'][$i];
						$arryArchivo=explode(".",$archivo);
						// $ext=$arryArchivo[1];
						
						// print_r($name);die();
						$SQLGP="insert into reino01_foto_escort(IdEscort,Imagen,Principal) 
									values  ('$idEscort','$name','0')";		
						//echo $SQLGP;
						$mysqli->query($SQLGP);
						
						$medio=$idEscort."_".$random_name.$ext;   
						$target_path = "../fotos/".$medio;
						
			   
						if(@move_uploaded_file($tmp_name, $target_path))
						{
							//$SQLMP="update reino01_foto_escort set imagen='$medio' where ID='$idImg'";	
							//$mysqli->query($SQLMP);
							//echo $SQLMP;
						}
						else
						{
							//$SQLMP="delete from reino01_foto_escort where ID='$idImg'";	
							//$mysqli->query($SQLMP);
						}
						//para imagen home
						header('content-type: image/jpeg');
						$image = new ImageResize($target_path);
						

								$image->resizeToWidth(550);
								$image->save('../resize/perfil/'.$medio);
								$image->save('../fotos/'.$medio);

								$image = imagecreatefromjpeg('../resize/perfil/'.$medio);
								$imageSize = getimagesize('../resize/perfil/'.$medio);
		
								$watermark = imagecreatefrompng('../resize/watermark_perfil.png');
		
								$watermark_o_width = imagesx($watermark);
								$watermark_o_height = imagesy($watermark);
		
								$newWatermarkWidth = $imageSize[0]-20;
								$newWatermarkHeight = $watermark_o_height * $newWatermarkWidth / $watermark_o_width;
		
								imagecopyresized($image, 
												$watermark, 
												$imageSize[0]/2 - $newWatermarkWidth/2, 
												$imageSize[1]/2 - $newWatermarkHeight/2, 
												0, 
												0, 
												$newWatermarkWidth, 
												$newWatermarkHeight, 
												imagesx($watermark), 
												imagesy($watermark)
											);
		
								imagejpeg($image,'../resize/perfil/'.$medio);
								
		
								imagedestroy($image);
								imagedestroy($watermark);
						
						
				}
				//die();

}
header("Location: http://www.reinovip.es/administrador/ModRegistro.php?tabla=Escort&id=".$idEscort."&filtro=&front= ");exit;
   //sleep(1);

?>

<?php
	
?>



