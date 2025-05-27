
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//echo '<pre>';print_r($_FILES);
//cho '<pre>';print_r($_POST);exit;
session_start();
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
require_once('includes/class.phpmailer.php');
include_once('resize/ImageResize.php');
use \Eventviva\ImageResize;
include_once('resize/watermark.php');


$idEscort = $_POST['id_escort_imagen'];
				
				$j=0;
				
				foreach ($_FILES['file']['name'] as $key) {
					$j++;
				}
				
				
				for($i=0;$i<=$j;$i++){




						
						$contCantFotos++;
						$tmp_name = $_FILES["file"]["tmp_name"][$i];
						$archivo=strtolower($_FILES['file']['name'][$i]);
						$arryArchivo=explode(".",$archivo);
						$ext=strtolower($arryArchivo[1]?? '');
						//print_r($archivo);die();


						if($ext == 'jpeg' or $ext  == 'JPEG' ){
							$ext = '.jpg';
						}

						
							$imgPincipal=0;
						
						
						$SQLGP="insert into reino01_foto_escort(IdEscort,Principal) 
									values ('$idEscort','$imgPincipal')";	
						
						$mysqli->query($SQLGP);
						$idImg=$mysqli->insert_id;
						
						$medio=$idEscort."_".$idImg.".".$ext;   
						$target_path = "fotos/".$medio;
			   
						if(@move_uploaded_file($tmp_name, $target_path))
						{
							$SQLMP="update reino01_foto_escort set Imagen='$medio' where ID='$idImg'";	
							
							$mysqli->query($SQLMP);

							//para imagen home
							$image = new ImageResize($target_path);
							$image->resize(130,180);
							$image->save('resize/home/borrar/'.$medio);
							$watermark = new Watermark();
							$watermark->apply('resize/home/borrar/'.$medio, 'resize/home/'.$medio, 'resize/watermark_home.png', 0);
							
							//para imagen escort
							$image->resize(188,243);
							$image->save('resize/escort/borrar/'.$medio);
							$watermark->apply('resize/escort/borrar/'.$medio, 'resize/escort/'.$medio, 'resize/watermark_escort.png', 0);
							
							//para imagen perfil
							$data = getimagesize($target_path);
							$width = $data[0];
							$height = $data[1];

							if($width > $height){
								$image->resizeToWidth(650);
								$image->save('resize/perfil/borrar/'.$medio);
								$watermark->apply('resize/perfil/borrar/'.$medio, 'resize/perfil/'.$medio, 'resize/watermark_perfil.png', 0);
							
							}
							else{
								$image->resizeToHeight(650);
								$image->save('resize/perfil/borrar/'.$medio);
								$watermark->apply('resize/perfil/borrar/'.$medio, 'resize/perfil/'.$medio, 'resize/watermark_perfil.png', 0);
							}
						
						}
						else
						{
							$SQLMP="delete from reino01_foto_escort where ID='$idImg'";	
							$mysqli->query($SQLMP);
						}

					
						
						
						
				}
header("Location: publicaciones.php");exit;
?>