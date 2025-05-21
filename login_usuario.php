
<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
//echo '<pre>';print_r($_POST);exit;
$email=$_POST['usuario'];
$pass=$_POST['contrasenia'];
if(($email=="") || ($pass=="") )
			{
				header("Location: modificar.php?erro=1");exit;

			}
$sqlFP = $mysqli->query("select * from reino01_escort_usuarios where email='$email' and habilitado = 1  order by ID DESC limit 1 ");
				
				$swReg=mysqli_num_rows($sqlFP);
				
					if($swReg==0)
					{
						header("Location: modificar.php?erro=1");exit;
					}
				while($row = mysqli_fetch_array($sqlFP))
				{
					

					if($row['contrasena']==$pass){
						$_SESSION['usuario_id']=$row['id'];
						$_SESSION['email']=$row['email'];
						$_SESSION['nombre']=$row['nombre_modelo'];
						$_SESSION['tipo']=$row['tipo'];
						$_SESSION['token']=$row['token'];
						header("Location: publicaciones.php");exit;
					}
					else{
						session_destroy();
						
						header("Location: modificar.php?erro=1");exit;
					}
				}

?>