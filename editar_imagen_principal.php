
<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
require_once('includes/class.phpmailer.php');
include_once('resize/ImageResize.php');
use \Eventviva\ImageResize;
include_once('resize/watermark.php');
//echo '<pre>';print_r($_POST);exit;
$idEscort = $_POST['id_escort'];
				
		if(isset($_POST['imagen_principal_edit']) and $_POST['imagen_principal_edit']!=''){
				define('UPLOAD_DIR', 'fotos/');
				$img = $_POST['imagen_principal_edit'];
                
				//$img = str_replace('data:image/png;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$imagenPrincipal = uniqid() . '.jpg';
				$file = UPLOAD_DIR . $imagenPrincipal;
				$success = file_put_contents($file, $data);

                $SQLip="delete from reino01_foto_escort where IdEscort = '$idEscort' and Principal = 1)";
									
				
				$mysqli->query($SQLip);
				$SQLip="insert into reino01_foto_escort(IdEscort,Principal,imagen) 
									values ('$idEscort','1','$imagenPrincipal')";	
						//echo $SQLip;exit;
				$mysqli->query($SQLip);
				//para imagen home
				$image = new ImageResize($file);
				$image->resize(130,180);
				$image->save('resize/home/borrar/'.$imagenPrincipal);
				$watermark = new Watermark();
				$watermark->apply('resize/home/borrar/'.$imagenPrincipal, 'resize/home/'.$imagenPrincipal, 'resize/watermark_home.png', 0);
				
				//para imagen escort
				$image->resize(188,243);
				$image->save('resize/escort/borrar/'.$imagenPrincipal);
				$watermark->apply('resize/escort/borrar/'.$imagenPrincipal, 'resize/escort/'.$imagenPrincipal, 'resize/watermark_escort.png', 0);
				
				//para imagen perfil
				$data = getimagesize($file);
				$width = $data[0];
				$height = $data[1];

				if($width > $height){
					$image->resizeToWidth(650);
					$image->save('resize/perfil/borrar/'.$imagenPrincipal);
					$watermark->apply('resize/perfil/borrar/'.$imagenPrincipal, 'resize/perfil/'.$imagenPrincipal, 'resize/watermark_perfil.png', 0);
				
				}
				else{
					$image->resizeToHeight(650);
					$image->save('resize/perfil/borrar/'.$imagenPrincipal);
					$watermark->apply('resize/perfil/borrar/'.$imagenPrincipal, 'resize/perfil/'.$imagenPrincipal, 'resize/watermark_perfil.png', 0);
				}


        }
header("Location: publicaciones.php");exit;

			
	
?>