<?php

include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

// $donde='mapa.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reino VIP</title>
   
<style>
.datosEspecificacion0 {

	font-size: 1.1em;
	padding-left: 5px;
	padding-right: 5px;
	display: inline-block;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	margin-left: 2px;
	margin-right: 2px;
	text-align: justify;	
	color: #1C2A1D;
}    
.datosEspecificacion0 span {
    font-size: 1.0em;
    color: #CA2D46;
}
</style>    
<?php include ('cabecera.php') ?>

  <?php
 
				$id=$_GET['id'];
				//$foto=$_GET['foto'];
				  //echo "llololo*-";
				  $URLSitio2 = "https://reinovip.com/";
				$EscortT=$Prefijo."Escort";
				$EscortC=$Prefijo."Ciudad";
				$EscortP=$Prefijo."Provincia";
				$SQL="SELECT ec.Nombre as CiudadNombre, ep.Nombre as ProvinciaNombre, e.* ,a.nombre_agencia , a.id as agencia_id
                FROM $EscortT e
				LEFT JOIN $EscortC ec on e.CiudadID=ec.ID
				LEFT JOIN $EscortP ep on e.ProvinciaID=ep.ID
                left join reino01_escort_usuarios u on u.id = e.usuario_id              
                left join agencias a on a.usuario_id = u.id 
				WHERE e.Publico=1 AND e.ID=$id";
                //echo $SQL;exit;
				$EscortResult=$mysqli->query($SQL) or die(mysqli_error());
				$cantReg=mysqli_num_rows($EscortResult);
					$Escort=mysqli_fetch_array($EscortResult);
				//	echo '<pre>';print_r($Escort);exit;
                    $nombreAgencia = stripslashes($Escort['nombre_agencia']);
                    $agenciaId =$Escort['agencia_id'];
					$nombre=stripslashes($Escort['Nombre']);
					$medida=stripslashes($Escort['Medidas']);				
					$categoriaID=stripslashes($Escort['CategoriaID']);
					$ciudadID=stripslashes($Escort['CiudadID']);
					$altura=stripslashes($Escort['Altura']);
					$nacionalidad=stripslashes($Escort['Nacionalidad']);
					$idiomas_ = '';
                    
                    $idiomas_=stripslashes($Escort['Idioma']);
                    if($idiomas_ == ''){
                    $sqlIdiomas = $mysqli->query("SELECT i.nombre FROM reino01_escort_idiomas i inner join reino01_escort_idiomas_registro ir on ir.idioma_id = i.ID where ir.ID_escort = ".$id."");
                   
                        while($lang = mysqli_fetch_array($sqlIdiomas)){
                            $idiomas_.= $lang['nombre'].' ';
                        }
                    }
            
					$viaje=stripslashes($Escort['Viaje']);
					$horario=stripslashes($Escort['Horario']);
					$web=stripslashes($Escort['Web']);				
					$comentario=stripslashes($Escort['Comentario']);								
					$telefonoBD=stripslashes($Escort['Telefono']);
					
					
					$telefonoBD=str_replace(" ","",$telefonoBD);
					$telefonoBD=str_replace("<br>","",$telefonoBD);
					$telefonoBD=str_replace("\n","",$telefonoBD);	
					$telefono="";
					for ($it=0;$it<strlen($telefonoBD);$it++)
					{
						if($it==3 or $it==6)
						{$telefono.=" ";}
						$telefono.=$telefonoBD[$it];
					}
					
					$edad=stripslashes($Escort['Edad']);
					$medidas=stripslashes($Escort['Medidas']);
					$altura=stripslashes($Escort['Altura']);
					$nacionalidad=stripslashes($Escort['Nacionalidad']);
					$idiomas=stripslashes($Escort['Idioma']);
					$horario=stripslashes($Escort['Horario']);
					$peso=stripslashes($Escort['peso']);
					$pelo=stripslashes($Escort['pelo']);
					$ojos=stripslashes($Escort['ojos']);
					
					$ProvinciaID=stripslashes($Escort['ProvinciaID']);
					$CiudadID=stripslashes($Escort['CiudadID']);
					
					$ciudadEscort=stripslashes($Escort['CiudadNombre']);
					$provinciaEscort=stripslashes($Escort['ProvinciaNombre']);
					
					$EscortFEP=$Prefijo."foto_escort";
					$sqlImgPrinc="select * from $EscortFEP where IdEscort='$id' and Principal=1";
					$ejecImgPrin=$mysqli->query($sqlImgPrinc);
					$cantImPrinc=mysqli_num_rows($ejecImgPrin);
					$arryFotoPrinc=mysqli_fetch_array($ejecImgPrin);
					
					$EscortFPago=$Prefijo."escort_formas_pagos";
					$EscortFPagoRegistro=$Prefijo."escort_formas_pagos_registro";
					$sqlFormasPago="select fp.Nombre from $EscortFPagoRegistro fpr, $EscortFPago fp where fpr.ID_forma_pago=fp.ID and fpr.ID_escort='$id' ";
					$ejecFormaPago=$mysqli->query($sqlFormasPago) or die (mysqli_error());
					
					$EscortLAtencion=$Prefijo."escort_lugares_atencion";
					$EscortLAtencionRegistro=$Prefijo."escort_lugares_atencion_registro";
					$sqlLugaresAtencion="select la.Nombre from $EscortLAtencionRegistro lar, $EscortLAtencion la where lar.ID_lugar_atencion=la.ID and lar.ID_escort='$id' ";
					$ejecLugaresAtencion=$mysqli->query($sqlLugaresAtencion) or die (mysqli_error());
					
					$EscortServicios=$Prefijo."escort_servicios";
					$EscortServiciosRegistro=$Prefijo."escort_servicios_registro";
					$sqlServicios="select s.Nombre from $EscortServiciosRegistro sr, $EscortServicios s where sr.ID_servicio=s.ID and sr.ID_escort='$id' ";
					$ejecServicios=$mysqli->query($sqlServicios) or die (mysqli_error());
					
					if(strstr($arryFotoPrinc['Imagen'],'http')){ 
						$fotoPrinc=$arryFotoPrinc['Imagen'];
					}
					else
					{
						if ($cantImPrinc>0) {
							$fotoPrinc=$URLSitio.'resize/perfil/'.$arryFotoPrinc['Imagen'];
						}	else {
							$fotoPrinc=$URLSitio.'img/nofoto306x407.jpg';
						}
					}
					$swIdVideo="";
					$EscortVideo=$Prefijo."video_escort";
					$VideoSQL="SELECT * FROM $EscortVideo WHERE Principal=1 AND IdEscort=$id";
					$EscortVideoResult=$mysqli->query($VideoSQL) or die(mysqli_error());
					//mysqli_query("SET NAMES 'utf8';"); 
					//mysqli_query("SET CHARACTER SET 'utf8';"); 
					//mysqli_query("SET SESSION collation_connection = 'utf8_general_ci';");
					$cantreg=mysqli_num_rows($EscortVideoResult);
					$recVideoDat=mysqli_fetch_array($EscortVideoResult);
					if($cantreg>0)
					{$swIdVideo="Video";}
                  
				?>
    <?php 
					$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$EscortFEP=$Prefijo."foto_escort";
					$sqlImgPrinc="select * from $EscortFEP where IdEscort='$id' and Principal=1";
					$ejecImgPrin=$mysqli->query($sqlImgPrinc);
					$cantImPrinc=mysqli_num_rows($ejecImgPrin);
					$arryFotoPrinc=mysqli_fetch_array($ejecImgPrin);
					if(strstr($arryFotoPrinc['Imagen'],'http')){ 
						$fotoPrinc=$arryFotoPrinc['Imagen'];
					}
					else
					{
						if ($cantImPrinc>0) {
							$fotoPrinc=$URLSitio2.'fotos/'.$arryFotoPrinc['Imagen'];
						}	else {
							$fotoPrinc=$URLSitio.'img/nofoto306x407.jpg';
						}
					}
    
				?>

<!-- MAIN CONTENT -->
<div class="container my-4">
  <div class="row">
    <!-- LEFT COLUMN -->
    <div class="col-md-5">

      <!-- MAIN IMAGE -->
      <div class="section-box1 text-center">
        <a href="<?php echo $fotoPrinc; ?>" class="glightbox card1 h-100 position-relative" data-gallery="perfil">
                <img src="<?php echo $fotoPrinc; ?>" alt="Foto principal" class="img-fluid rounded">
        </a>
      </div>

      <!-- GALLERY -->
      <div class="section-box-galeria">
               <div class="d-flex flex-wrap gap-2 gallery">
          <!-- <a href="http://reinovip.com/fotos/1200_480496.jpg" class="glightbox" data-gallery="perfil">
            <img src="http://www.reinovip.com/resize/perfil/1200_351495.jpg" alt="Mini 1">
          </a>
          <a href="http://reinovip.com/fotos/1200_480496.jpg" class="glightbox" data-gallery="perfil">
            <img src="http://www.reinovip.com/resize/perfil/1200_408586.jpg" alt="Mini 2">
          </a>
         <a href="http://reinovip.com/fotos/1200_480496.jpg" class="glightbox" data-gallery="perfil">
            <img src="http://www.reinovip.com/resize/perfil/1200_351495.jpg" alt="Mini 3">
          </a>
          <a href="http://reinovip.com/fotos/1200_480496.jpg" class="glightbox" data-gallery="perfil">
            <img src="http://www.reinovip.com/resize/perfil/1200_408586.jpg" alt="Mini 4">
          </a> -->
		<?php 
		if($cantReg>0){
		   $sqlGaleria="select * from reino01_foto_escort where IdEscort='$id' and Principal=0";
		   $ejecGaleria=$mysqli->query($sqlGaleria);
		   $cantImgGaleria=mysqli_num_rows($ejecGaleria);
		   if($cantImgGaleria>0){
			  $poc=0;
			  while($arryGaleria = mysqli_fetch_array($ejecGaleria)) { 
				if(strstr($arryGaleria['Imagen'],'http')){ 
					$urlIMGrv=$arryGaleria['Imagen'];
				}else{
						$urlIMGrv=$URLSitio2."resize/perfil/".$arryGaleria['Imagen'];
						$gal[$poc]= $arryGaleria['Imagen'];
						$poc++;
						}
		?>
        <a href="<?php echo $urlIMGrv; ?>" class="glightbox" data-gallery="perfil">
        <img src="<?php echo $urlIMGrv; ?>" alt="Mini 1">
        </a>
        <?php } 
		   	} 
		} 
		?>
          
        </div>
      </div>

    </div>

    <!-- RIGHT COLUMN -->
    <div class="col-md-8">

      <!-- PERFIL -->
      <div class="section-box">
        <h1><?php echo $nombre; ?></h1>
        <p><?php echo strip_tags($comentario);?> </p>
      </div>

      <!-- DATOS PERSONALES -->
      <div class="section-box-datos">
        <h2 class="section-title">Datos personales</h2>
          <div class="columns">
      <div class="column">
        <ul>
          <li><span class="txt-datos">Edad:</span><span class="txt-valor"><?php echo $edad;?></span></li>
          <li><span class="txt-datos">Medidas:</span><span class="txt-valor"><?php echo $medidas;?></span></li>
          <li><span class="txt-datos">Altura:</span><span class="txt-valor"><?php echo $altura;?> cm</span></li>
          <li><span class="txt-datos">Peso:</span><span class="txt-valor"><?php echo $peso;?></span></li>
          
                  </ul>
      </div>
      <div class="column">
        <ul>
          <li><span class="txt-datos">Cabello:</span><span class="txt-valor"><?php echo mb_convert_encoding($pelo, 'UTF-8');?></span></li>
          <li><span class="txt-datos">Ojos:</span><span class="txt-valor"><?php echo mb_convert_encoding($ojos, 'UTF-8');?></span></li>
          <li><span class="txt-datos">Nacionalidad:</span><span class="txt-valor"><?php echo mb_convert_encoding($nacionalidad, 'UTF-8');?></span></li>
          <li><span class="txt-datos">Idiomas:</span><span class="txt-valor"><?php echo  mb_convert_encoding($idiomas_, 'UTF-8');?></span></li>
          </ul>
      </div>
    </div>
</div>
      <!-- DISPONIBILIDAD -->
      <div class="section-box">
        <h3 class="section-title"><i class="fas fa-clock" style="color: #793a57;font-size: 17px;"></i> Horarios de trabajo y Tarifas</h3>
          <p> <?php echo $horario;?></p>
         <h3 class="section-title"><i class="fas fa-money-check-alt" style="color: #793a57;font-size: 17px;"></i> Formas de pago</h3>
          <p><?php $contFormasPago=0; while($arryFormasPago = mysqli_fetch_array($ejecFormaPago)) { $contFormasPago++; if($contFormasPago==1){echo $arryFormasPago["Nombre"];} else {echo " - ".$arryFormasPago["Nombre"];} }?></p>
          <h3 class="section-title"><i class="fas fa-hotel" style="color: #793a57;font-size: 17px;"></i> Lugares de Atención:</h3>
          <p> <?php 
                             while($arryLugaresAtencion = mysqli_fetch_array($ejecLugaresAtencion)) { $contLugAtencion++; if($contLugAtencion==1){echo $arryLugaresAtencion["Nombre"];} else {echo " - ".$arryLugaresAtencion["Nombre"];} }
                            ?></p>
      
      </div>
 <!-- SERVICIOS -->
      <div class="section-box">
        <h2 class="section-title">Servicios</h2>
                    <div class="login-box-detail" style="padding:20px;font-size:.8rem;">
                        <?php		
                            $i=1;		
                                while($arryServiciosEscort = mysqli_fetch_array($ejecServicios)){ 
                                    
                                    echo '<div class="datosEspecificacion0" style="color:#2b2b2b;min-width:150px;line-height:25px;"><span>&raquo;&nbsp;</span>'.mb_convert_encoding($arryServiciosEscort["Nombre"], 'UTF-8').'</div>'; 
                                    if($i==4 or $i==8 or $i==12){
                                         echo '<br>';
                                    }
                                    $i++;
                                
                                }
                            ?>
                    </div>  
      </div>
     
      <!-- CONTACTO -->
      <div class="section-box d-flex justify-content-between align-items-center">
         <a href="https://api.whatsapp.com/send/?phone=34<?php echo trim($telefono);?>&amp;text=Hola!+te+he+visto+en+Reino+Vip+y+me+gustaria+ir.+Cuando+estas+disponible?&amp;type=phone_number&amp;app_absent=0" target="_blank" title="Share this post on Whatsapp" class="whatsapp" style="text-decoration:none;">
                          <span class="btn-chat"><?php echo trim($telefono);?></span>      <img src="http://reinovip.com/img/chat2.png" style="width: 90px;" alt="Whatsapp">
                            </a>
         <span > <i class="fas fa-map-marker-alt" style="color: #793a57;font-size: 20px;"></i>  España - <?php echo $ciudadEscort ?></span>
         
        </div>

    </div>
  </div>
</div>

  </div>
</div>

<!-- Footer -->
<?php include ('footer.php') ?>

