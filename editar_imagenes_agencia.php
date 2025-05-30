<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
$usuario_id=$_GET['id'];

//$buscDatos=$mysqli->query("");

	$sql="select *  from reino01_Escort where ID='$usuario_id' AND  Publico IN (1,0)";
    //echo $sql;exit;

	$ResultCat=$mysqli->query($sql);
	$i=0;
	while ($datos=mysqli_fetch_array($ResultCat)){

        $escort_id=$datos['ID'];
      


        $sql2 = "SELECT * FROM reino01_escort_lugares_atencion_registro WHERE ID_escort = $escort_id";
        //echo $sql2;exit;
        $res=$mysqli->query($sql2);
        $j = 0;
        while ($servi=mysqli_fetch_array($res)){
            $list[$i]['lugares'][$j]['id']= $servi['ID_lugar_atencion'];
            $j++;
        
        }

        $sql2 = "SELECT * FROM reino01_escort_servicios_registro WHERE ID_escort = $escort_id";
        //echo $sql2;exit;
        $res=$mysqli->query($sql2);
        $j = 0;
        while ($servi=mysqli_fetch_array($res)){
            $list[$i]['servicios'][$j]= $servi['ID_servicio'];
            $j++;
        
        }


        //pagos 
        
        $sql2 = "SELECT * FROM reino01_escort_formas_pagos_registro WHERE ID_escort = $escort_id";
        //echo $sql2;exit;
        $res=$mysqli->query($sql2);
        $j = 0;
        while ($servi=mysqli_fetch_array($res)){
            $list[$i]['pagos'][$j]= $servi['ID_forma_pago'];
            $j++;
        
        }

        //idiomas
        
        $sql2 = "SELECT * FROM reino01_escort_idiomas_registro WHERE ID_escort = $escort_id";
       
        $res=$mysqli->query($sql2);
        $j = 0;
        while ($servi=mysqli_fetch_array($res)){
            $list[$i]['idiomas'][$j]= $servi['idioma_id'];
            $j++;
        
        }


        $list[$i]['id']=$datos['ID'];
		$list[$i]['nombre']=$datos['Nombre'];
        $list[$i]['comentario']=$datos['Comentario'];
        $list[$i]['categoriaID']=$datos['CategoriaID'];
        $list[$i]['edad']=$datos['Edad'];
        $list[$i]['horario']=$datos['Horario'];
        $list[$i]['nacionalidad']=$datos['Nacionalidad'];
        $list[$i]['altura']=$datos['Altura'];
        $list[$i]['medidas']=$datos['Medidas'];
        $list[$i]['ojos']=$datos['ojos'];
        $list[$i]['peso']=$datos['peso'];
        $list[$i]['pelo']=$datos['pelo'];
        $list[$i]['ciudadID']=$datos['CiudadID'];
        $list[$i]['provinciaID']=$datos['ProvinciaID'];
        $list[$i]['paisID']=$datos['PaisID'];
        $list[$i]['telefono']=$datos['Telefono'];
		$list[$i]['id']=$escort_id;
		$list[$i]['usuario_id']=$datos['usuario_id'];
        $list[$i]['whatsapp']=$datos['whatsapp'];
        $list[$i]['telegram']=$datos['telegram'];
		$sql2="select imagen  from reino01_foto_escort where IdEscort='$escort_id' and Principal='1'";

		$imagen=$mysqli->query($sql2);
		while ($images=mysqli_fetch_array($imagen)){
			$list[$i]['imagen']=$images['imagen'];
		}
        $sql3="select imagen,ID  from reino01_foto_escort where IdEscort='$escort_id' and Principal='0'";

		$imagens=$mysqli->query($sql3);
        $j=0;
        while ($imagenes=mysqli_fetch_array($imagens)){
			$list[$i]['imagenes'][$j]['imagen']=$imagenes['imagen'];
            $list[$i]['imagenes'][$j]['id']=$imagenes['ID'];
            $j++;
		}
		$i++;
	}
	//print_r($list);
//echo 123;exit;
    //echo '<pre>';print_r($list);exit;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $TituloSitio; ?></title>
  <meta name="description" content="Guía Erótica de España donde encontraras acompañantes vip, chicas, escorts, travestis, eros,  etc.  Publica tu anuncio GRATIS">
  <meta name="keywords" content="acompañantes vip, chicas, escorts, travestis, eros, gays, chicas en las palmas, transexuales,">

	<link href="css/formulario.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/dropzone.css" rel="stylesheet" type="text/css" />
	<link href="css/cropper.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery.validate.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/CssRegistro.css?v=2.1" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" rel="stylesheet" type="text/css" />
	

	<script src="js/ajax.js?v=2.0" type="text/javascript"></script>
	
	
	<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="js/jquery.validate.js" type="text/javascript"></script>

	<script src="js/dropzone.js" type="text/javascript"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" type="text/javascript"></script>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="<?php echo $URLSitio?>css/jqueryscrollTo-min.js" type="text/javascript"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- ####### ED- ######## -->
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <link rel="stylesheet" href="css/CssIndex.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />
	 

<?php 
  include ('cabecera.php');
  
?>
<style>
.input-group {
margin-bottom: 20px;
width: 100%;
}

.input-group label {
font-size: 14px;
color: #666;
}

.input-group input {
width: 100%;
padding: 12px;
border: 1px solid #ddd;
border-radius: 5px;
margin-top: 5px;
font-size: 14px;
}

.input-group input:focus {
border-color: #78787a;
outline: none;
}

.error-message {
color: red;
font-size: 12px;
margin-top: 5px;
}

.submit-btn {
    width: 190px !important;
    padding: 12px;
    background-color: #78787a !important;
    border: none;
    color: white !important;
    font-size: .8rem;
    cursor: pointer;
    border-radius: 5px;
  }
  .select2-container .select2-selection--single{
  	height:35px !important;
  }

.forgot-password {
text-align: center;
margin-top: 10px;
}

.forgot-password a {
color: #00a850;
text-decoration: none;
}

.forgot-password a:hover {
text-decoration: underline;
}

.signup-link {
text-align: center;
margin-top: 15px;
}

.signup-link a {
color: #00a850;
text-decoration: none;
}

.signup-link a:hover {
text-decoration: underline;
}

@media (max-width: 480px) {
.login-box {
	padding: 20px;
}
.services{
	min-height:350px;
	padding: 0px;
	box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
	width: 86%;
	max-width: 86%;
	margin-top: 29px;
	padding-top: 10px;
}
}
@media (min-width: 992px) {
	.col-lg-9 {
	margin-left:120px;
	}
	.services{
margin-left:17px;
min-height:350px;
padding: 0px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
width: 96%;
max-width: 100%;
margin-top: 10px;
padding-top: 29px;
padding-left:50px;
}
	}
	.form-group label{
		font-size:.8rem;
	}

.form-control {
height: 35px !important;
}
@media (max-width: 480px) {
	.login-box {
		padding: 20px;
		margin:  10px !important;
	}
	.titulo {
		color:#793a57;font-size:1.1rem;text-transform:uppercase;padding:0 20px;
	}
	.form-control{
		width: 350px !important;
	}
.login-box {
padding: 0px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
width: 97%;
max-width: 100%;
margin-top: 29px;
}
.services{
min-height:350px;
padding: 0px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
width: 96%;
max-width: 100%;
margin-top: 10px;
padding-top: 10px;
margin-left:17px;
}
.titulo {
text-align:left;color:#793a57;font-size:1.1rem;margin-top:35px;text-transform:uppercase;
}
}
@media (min-width: 992px) {
.form-control{
width: 200px !important;
}
.services{
margin-left:17px;
min-height:350px;
padding: 0px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
width: 96%;
max-width: 100%;
margin-top: 10px;
}
}


.login-box {
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	max-width: 100%;
	padding: 22px 15px;
	margin-bottom: 17px;
}
.filepreviewprofile {
  position: absolute;
  top: 0;
  right: 30px;
  width: 100%;
  height: 250px; 
  opacity: 0;
    }
button.botones {
	color: #fff;
	background-color: #793a57;
	padding: 5px 10px;
	border-radius: 5px;
}  
    a.botones {
    	color: #fff;
    	background-color: #793a57;
    	padding: 5px 10px;
    	border-radius: 5px;
    	text-decoration: none;

    }

</style>

<!-- Cards -->
<div class="container mt-4">
   <div class="content-container">


                <form class="formRegistro" action="editar_imagen_principal.php" enctype="multipart/form-data" name="formC" id="formC" method="POST" onsubmit="">
                       
		
             <div class="login-box">	
                                    <h2 style="margin:0;">
                                        EDITAR IMAGENES
                                    </h2>	
                                </div>
                                <div class="login-box" style="min-height: 800px;">
                                  <div class="content">
                                      <div class="row">
                                        <input type="hidden" name="id_escort" value="<?php echo  $escort_id;?>">
                                          <div class="form-group">
                                              <div class="confirm-identity">
                                              
                                              <div class="ci-user-btn text-center mt-4">
                                                <div class="ci-user d-flex align-items-center justify-content-center">
                                                    
                                                  </div>
                                                      <a style="width:100%;color:#793a57 !important; !important; font-size:.8rem; text-decoratio: none;" href="javascript:;" class="userEditeBtn btn-default bg-blue position-relative">
                                                          <div class="ci-user-picture" style="float:left;">
                                                            <input type="hidden" name="imagen_principal_edit" id="imagen_principal_edit" value="">
                                                              <img style="width:120px;border: 2px solid #000;border-radius:5px;" src="fotos/<?php echo $list[0]['imagen']?>" id="item-img-output" data-src="" class="imgpreviewPrf img-fluid" alt="">
                                                          </div>
                                                          <input type="file" class="item-img file center-block filepreviewprofile" style="display:inherit;" name="file">IMAGEN PRINCIPAL
                                                          <div class="login-box" style="width:400px;float:right;border-radius:5px;">
                                                            <p style="text-align:center; color:#793a57 !important;">
                                                                <span styl class="submit-btn2">Selecciona tu archivo o Sube tu foto ahora</span>
                                                            </p><br>
                                                            <p style="text-align:center; color:#793a57 !important;">
                                                                Arrastra tu archivo aqui
                                                            </p>
                                                          </div>
                                                      </a>
                                                      
                                                  </div>
                                                </div>
                                              
                                              
                                              </div>
                                              <div class="col-lg-12">
                                                  <div class="form-group form-inline" style="text-align:center">
                                                      <button  type="submit"  class="botones" >EDITAR IMAGEN PRINCIPAL </button>
                                                  </div>
                                              </div>
                                    
                                </div>
                                </div>

                                <div class="modal fade cropImageModal" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <button type="button" class="close-modal-custom" data-dismiss="modal" aria-label="Close"><i class="feather icon-x"></i></button>
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-body p-0">
                                              <div class="modal-header-bg"></div>
                                              <div class="up-photo-title">
                                                <h3 class="modal-title">Subir foto de perfil</h3>
                                              </div>
                                              <div class="up-photo-content pb-5">
                                                <div id="upload-demo" class="center-block">
                                                    <!-- <h5><i class="fas fa-arrows-alt mr-1"></i> Drag your photo as you require</h5>-->
                                                </div>
                                                <div class="upload-action-btn text-center px-2">
                                                    <button type="button" id="cropImageBtn" class="btn btn-default btn-medium bg-blue px-3 mr-2">Guardar foto</button>
                                                    <!-- <button type="button" class="btn btn-default btn-medium bg-default-light px-3 ml-sm-2 replacePhoto position-relative">Replace Photo</button>-->
                                                </div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                </form>
                <form class="formRegistro" action="editar_imagenes.php" enctype="multipart/form-data" name="formC" id="formC" method="POST" onsubmit="">
                    <table class="table table-condensed" width="100%">
                          <?php if(!empty($list)):?>
                        <thead>
                        <tr>
                                            <th>FOTO GALERIA</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                                        <tr>
                        <?php foreach ($list[0]['imagenes'] as $data):?>
                          
                                                <td style="text-align: center;"><img src="fotos/<?php echo $data['imagen'];?>" style='width:90px;'>
                                                <br>    
                                                <br>    
                                                <a class="botones" href="http://reinovip.com/borrar_imagenes.php?id=<?php echo $data['id']?>" onclick="return confirm('esta seguro de eliminar la imagen?');">BORRAR IMAGEN</a>
                                                </td>
                          
                        <?php endforeach;?>
                                        </tr>			      	
                      <?php else:?>
                        <tr><td>USTED NO TIENE NINGUN ANUNCIO EN SUS LISTAS</td></tr>
                      <?php endif;?>
                    </tbody>
                  </table>
                    <input type="hidden" name="id_escort_imagen" id="id_escort_imagen"  value="<?php echo  $escort_id;?>">
                    <div class="col-lg-12">
                      <div class="contSubirFoto" style="margin-left:15px;margin-top:10px;">
                        <div class="form-group">
                          <label for="fotos">IMAGENES PARA GALERIA FOTOGRAFICA</label>
                          <div class="dropzone" id="my-dropzone" name="mainFileUploader" style="width:98%;">
                            <div class="fallback">
                              <input name="file[]" type="file" multiple />
                            </div>
                            <span style="text-align:center;">SUBIR MAS FOTOS</span><br>
                          </div>  
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group form-inline" style="text-align:center">
                          <button  id="submit-all"  type="submit"  class="botones" >EDITAR IMAGENES GALERIA</button>
                      </div>
                    </div>
                            </div>
                            
                            </div>

                           
							
                </form>


  </div>
 
</div>

<script type="text/javascript">
       
          
		




    $(document).ready(function() {
    $('.idioma').select2();
	$('.edad').select2();
	$('.lugares').select2();
	$('.forma_pago').select2();
	$('.altura').select2();
	$('.nacionalidad').select2();
	$('.pelo').select2();
	$('.servicios').select2();
	$('.peso').select2();
	$('.ojos').select2();
	$('.pais').select2();
	
	
});
    </script>
    <script>
		// -----Crop Image file upload with modal--

var $uploadCrop,
		tempFilename,
		rawImg,
		imageId;
		function readFile(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('.upload-demo').addClass('ready');
					$('#cropImagePop').modal('show');
					rawImg = e.target.result;
				};
				reader.readAsDataURL(input.files[0]);
			}
			else {
				console.log("Sorry - you're browser doesn't support the FileReader API");
			}
		}

		$uploadCrop = $('#upload-demo').croppie({
			viewport: {
				width: 300,
				height: 350,
				type: 'square'
			},
			enforceBoundary: false,
			enableExif: true
		});
		$('#cropImagePop').on('shown.bs.modal', function(){
			$('.cr-slider-wrap').prepend('<p>Image Zoom</p>');
			$uploadCrop.croppie('bind', {
				url: rawImg
			}).then(function(){
				console.log('jQuery bind complete');
			});
		});

		$('#cropImagePop').on('hidden.bs.modal', function(){
			$('.item-img').val('');
			$('.cr-slider-wrap p').remove();
		});

		$('.item-img').on('change', function () { 
			readFile(this); 
		});

		$('.replacePhoto').on('click', function(){
			$('#cropImagePop').modal('hide');
			$('.item-img').trigger('click');
		});
		
		$('#cropImageBtn').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'base64',
				// format: 'jpeg',
        		backgroundColor : "#000000",
        		format: 'jpg',
				size: {width: 300, height: 350}
			}).then(function (resp) {
				
				$('#item-img-output').attr('src', resp);
				resp = resp.replace("data:image/png;base64,", "");
				$('#item-img-output').attr('data-src', resp);
                $('#imagen_principal_edit').val(resp);
				$('#cropImagePop').modal('hide');
				$('.item-img').val('');
			});
		});
       
        $('#editImages').click(function() {
            $('.forms').hide();
            $('.pictures').slideToggle("slow");
            
                $('html, body').animate({
                    scrollTop: $(".pictures").offset().top
                }, 2000);
            
            // Alternative animation for example
            // slideToggle("fast");
        });
        $('#editForm').click(function() {
            $('.pictures').hide();
            $('.forms').slideToggle("slow");

            
                $('html, body').animate({
                    scrollTop: $(".forms").offset().top
                }, 2000);
            
            // Alternative animation for example
            // slideToggle("fast");
        });
       // $('.forms').show();
        $(function() {
            $('#watchButton').click();
        });
	</script>
    <script>
        const selectImage = document.querySelector('.select-image');
const inputFile = document.querySelector('#imagen_agencia');
const imgArea = document.querySelector('.img-area');

$(selectImage).bind().click(function () {
    //inputFile.click();
});


inputFile.addEventListener('change', function () {
	const image = this.files[0]
	if(image.size < 2000000) {
		const reader = new FileReader();
		reader.onload = ()=> {
			const allImg = imgArea.querySelectorAll('img');
			allImg.forEach(item=> item.remove());
			const imgUrl = reader.result;
			const img = document.createElement('img');
			img.src = imgUrl;
			imgArea.appendChild(img);
			imgArea.classList.add('active');
            imgArea.classList.add('imagen_principal');
			imgArea.dataset.img = image.name;
            $('.load-image').hide();
		}
		reader.readAsDataURL(image);
	} else {
		alert("Image size more than 2MB");
	}
})
    </script>
    <script>
        $('.perfil_agencia').show();
            
        function toggleTab(tabIndex) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tabContent => {
                tabContent.style.display = 'none';
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-btn').forEach(tabBtn => {
                tabBtn.classList.remove('active');
            });

            // Show the selected tab content
            document.getElementById('tab' + tabIndex).style.display = 'block';

            // Add active class to the clicked tab
            document.querySelector('.tab-btn:nth-child(' + tabIndex + ')').classList.add('active');
            
        }
       
    </script>
    <script type="text/javascript">
       
        $(document).ready(function(){
			
            Dropzone.autoDiscover = false;
			
            $("#my-dropzone").dropzone({
                url: "editar_imagenes.php",
        		addRemoveLinks: true,
        		dictRemoveFile: 'Borrar Foto',
        		autoProcessQueue: false,
				renameFile: "files",
        		uploadMultiple: true,
        		parallelUploads: 8,
        		maxFiles: 8,
			
        		dictDefaultMessage: "<span style='font-size:0.7rem'>Por favor arrastre sus imagenes aca o haga click para buscar</span>",


        		// The setting up of the dropzone
			    init: function() {
			        var myDropzone = this;
			        

			        // Here's the change from enyo's tutorial...
			         this.on("sending", function(file, xhr, formData) {
						
			         	cargarmy();
				

						var imagen_principal = $('#item-img-output').attr('data-src');
					 	formData.append('imagen_principal', imagen_principal); 

                         var id_escort_imagen = $('#id_escort_imagen').val();
					 	formData.append('id_escort_imagen', id_escort_imagen); 

					 
						
						
					
					
					  });
                      
			        $("#submit-all").click(function (e) {
                            $('#item-img-output').attr('src','');
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
					  
				     window.location.href = "publicaciones.php";
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
                    console.log(response);
                }
            });

        });
    </script>
    <script>
	function cargarmy() {	
		// Wait for window load
		// Animate loader off screen
		$( ".holas" ).show();
		$(".holas").animate({
		}, 1500);
	}
	</script>
    <div class="holas" style="display:none"><!-- Place at bottom of page --><span>POR FAVOR ESPERE MIENTRAS SE GUARDAN LOS DATOS</span></div>

<!-- Footer -->
<?php include ('footer.php') ?>

