<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio)?></title>
<?php
if ($admin_en_utf8) { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php 
} else { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<?php
} 
?>
<?php include("metatags.txt"); ?>

<link href="admin.css" rel="stylesheet" type="text/css">
<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../js/dropzone.js" type="text/javascript"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>

</head>

<body>
<?php include("topadmin.inc.php");
	$provincia_id=$_GET['id'];
 ?>
  	<form enctype="multipart/form-data" action="editarbanner.php?id=<?php echo $id;?>" method="post">
		<?php
			$provincia_id=$_GET['id'];
			$SQLprov="SELECT * FROM reino01_Provincia where ID='$provincia_id'";
			$Resultprov=$mysqli->query($SQLprov) or die (mysqli_error());
			while ($datas=mysqli_fetch_array($Resultprov)):?>
			 	
				<?php $sql="SELECT * from reino01_banner_ciudades where provincia_id='$provincia_id'";
					$listas['nombre']=$datas['Nombre'];
					$result=$mysqli->query($sql) or die (mysqli_error());
					$i=0;
					while ($data=mysqli_fetch_array($result)){
						$lista[$i]['posicion']=$data['posicion'];
						$lista[$i]['url']=$data['url'];
						$lista[$i]['tiempo']=$data['tiempo'];
						$lista[$i]['imagen']=$data['imagen'];
						$lista[$i]['id']=$data['id'];
						$lista[$i]['estado']=$data['estado'];
						$i++;
					}	
				?>
		<?php endwhile;?>
		<table border="0" cellpadding="3" cellspacing="0" class="admin_form_derecha">
		  	<tr>
		    	<td class="listado_titulogeneral" colspan="5">BANNER DE LA PROVINCIA DE <?php echo $listas['nombre'];?></td>
			</tr>        
			<tr>
				<td>IMAGENES</td>
				<td>URL</td>
				<td>TIEMPO EN SEGUNDOS</td>
				<td>ELIMINAR</td>
				<td>ACTIVAR / DESACTIVAR</td>
			</tr>
			
			<?php foreach ($lista as $key):?>
				<tr>
					<td><img src="../fotos/banner/<?php echo $key['imagen']?>" width="400px" height="300px">
						<input type="hidden" name="id[]" value="<?php echo $key['id']?>">
						<input type="hidden" name="imagen[]" value="<?php echo $key['imagen']?>">
					</td>
					<td>
						<input type="text" name="url[]" value="<?php echo $key['url']?>"> 
					</td>
					<td>
						<input type="text" name="tiempo[]" value="<?php echo $key['tiempo']?>"> 
					</td>
					<td>
						<a onclick="return confirm('Esta seguro de borrar la imagen?');" href="eliminarbanner.php?id=<?php echo $key['id']?>&provincia_id=<?php echo $provincia_id?>">ELIMINAR</a>
					</td>
					<td>
						<?php 
							$idBanner = $key['id'];
							$estadoBanner = $key['estado'];
							if ($estadoBanner == 0) {
								$estado = 1;
							} else {
								$estado = 0;
							}
						?>
							<input type="checkbox" name="cuota" value="0" <?php  if($key['estado']==0){ echo "checked";}else{ echo ""; }; ?> onclick="location.href='actualizaCheck.php?id=<? echo $idBanner;?>&valor=<? echo $estado; ?>&url=<?php echo $_SERVER['REQUEST_URI'];?>'">

							<?php  if($key['estado']==0){ echo "Desactivar";}else{ echo "Activar"; }; ?>
						</label>
					</td>
					<input type="hidde" name="path" value=<?php echo $_SERVER['REQUEST_URI'];?>
				</tr>
			<?php $i++;endforeach;?>
			<tr>
				<td><label for="fotos">SUBIR MAS BANNERS</label></td>
				<td align="center" colspan="3">
	          		<div class="dropzone" id="my-dropzone" name="mainFileUploader">
          				<div class="fallback">
                			<input name="file" type="file" multiple />
			            </div>
        			</div>
				</td>	
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><input class="admin_botones" type="submit" value="SUBIR CAMBIOS >>" name="agregar"></td>
			</tr>
			<tr>
				<td class="celdabotones" colspan="4">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td width="50%" valign="top" align="left">
							<a class="admin_botones" href="listar.php?tabla=BannerCiudades"> << Volver</a>
						</td>
						<td width="50%" valign="top" align="right">
							<input class="admin_botones" id="submit-all" type="submit" value="SUBIR MAS FOTOS >>" name="agregar">
						</td>
					</tr>
					</table>	
				</td>
			</tr>
			
		</table>
  </form>
</body>
<script type="text/javascript">
        $(document).ready(function(){
            Dropzone.autoDiscover = false;

            $("#my-dropzone").dropzone({
                url: "editarbanner.php?id=<?php echo $id;?>",
        		addRemoveLinks: true,
        		autoProcessQueue: false,
        		uploadMultiple: true,
        		parallelUploads: 10,
        		maxFiles: 10,
        		dictDefaultMessage: "Por favor arrastre sus imagenes aca o haga click para buscar",


        		// The setting up of the dropzone
			    init: function() {
			        var myDropzone = this;
			        

			        // Here's the change from enyo's tutorial...
			         this.on("sending", function(file, xhr, formData) {
					 	var provincia = $('#provincia').val();
					 	formData.append('provincia', provincia);    	
					  });
			        $("#submit-all").click(function (e) {
			            e.preventDefault();
			            e.stopPropagation();
			            myDropzone.processQueue();

			        });
			        this.on("sendingmultiple", function() {
				      // Gets triggered when the form is actually being sent.
				      // Hide the success button or the complete form.
				    });
				    this.on("successmultiple", function(files, response) {
				      // Gets triggered when the files have successfully been sent.
				      // Redirect user or notify of success.
						window.location.replace(window.location.href);
				       
				    });
				    this.on("errormultiple", function(files, response) {
				      // Gets triggered when there was an error sending the files.
				      // Maybe show form again, and notify user of error
				    });
			    },
		        success: function (file, response) {
            	var imgName = response;

            	file.previewElement.classList.add("dz-success");
            	console.log("Successfully uploaded :" + imgName);
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
            });

        });
    </script>
</html>




