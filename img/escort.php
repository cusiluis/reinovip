<?
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<? echo $URLSitio?>reinovip.ico" type="image/x-icon" />
<title><? echo $TituloSitio?></title>
<link href="<? echo $URLSitio?>reinovip.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<? echo $URLSitio?>jquery.lightbox-0.5.css" rel="stylesheet" />

<script src="<? echo $URLSitio?>Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

<script src="<? echo $URLSitio?>flash.js" type="text/javascript"></script>
<script src="<? echo $URLSitio?>select.js" type="text/javascript"></script>

<script src="<? echo $URLSitio?>jquery.js" type="text/javascript"></script>
<script src="<? echo $URLSitio?>jquery.lightbox-0.5.js" type="text/javascript"></script>

<!-- scripts para SHADOWBOX -->
<script type="text/javascript" src="<? echo $URLSitio?>src/adapter/shadowbox-base.js"></script>
<script type="text/javascript" src="<? echo $URLSitio?>src/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.loadSkin('classic', '<? echo $URLSitio?>src/skin');
Shadowbox.loadLanguage('es', '<? echo $URLSitio?>src/lang');
Shadowbox.loadPlayer(['flv', 'html', 'iframe', 'img', 'qt', 'swf', 'wmp'], '<? echo $URLSitio?>src/player');


function openShadowbox(content, player, title){
    Shadowbox.open({
        content:    content,
        player:     player,
		width: 600,
		height: 450,
        title:      title
    });
}
function openShadowbox2(content, player, title){
    Shadowbox.open({
        content:    content,
        player:     player,
	gallery: "galeria",
        title:      title
    });
}
</script>
<!-- fin scripts para SHADOWBOX -->
    <!-- Ativando o jQuery lightBox plugin -->
    <script type="text/javascript">
	var $j = $.noConflict(true);
	$j(function($) {
		$('#gallery a').lightBox();
	});
    </script>
   	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		padding: 10px;
		width: 950px;
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 1px solid #3e3e3e;
		border-width: 1px 1px 1px;
	}
	#gallery ul a:hover img {
		border: 2px solid #fff;
		border-width: 2px 2px 2px;
		color: #fff;
	}
	#gallery ul a:hover { color: #fff; }
	</style>
</head>

<body>

<script type="text/javascript" src="<? echo $URLSitio?>libraries/formDialog/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="<? echo $URLSitio?>libraries/formDialog/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<? echo $URLSitio?>libraries/formDialog/subform.js"></script>
<link rel="stylesheet" href="<? echo $URLSitio?>libraries/formDialog/jquery-ui-1.8.16.custom.css" />
<script src="<? echo $URLSitio?>flash.js" type="text/javascript"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#nuevo').click(function(){
			$('#dialog-form').dialog("open");
		});
		fn = function(obj){
			$(obj).dialog("close");
		}
		initSubform($('#dialog-form'), null, fn);

	});
	
	$(document).ready(function(){
		$('#cancelar_c').click(function(){
			$('#dialog-diag').dialog("close");
		});
	});
	
	$(document).ready(function(){
		$('#Video').click(function(){
			$('#dialog-diag').dialog("open");
		});

		initSubform($('#dialog-diag'), null, fn);
	});
	
	function verVideo(sw)
	{
		if(sw=="")
		{alert("No existen videos...");}
		else
		{$('#dialog-diag').dialog("open");}
	}
	
</script>
            	<?php
				$id=$_GET['id'];
				$foto=$_GET['foto'];
				
				$EscortT=$Prefijo."Escort";
				$EscortC=$Prefijo."Ciudad";
				$EscortP=$Prefijo."Provincia";
				$SQL="SELECT ec.Nombre as CiudadNombre, ep.Nombre as ProvinciaNombre, e.* FROM $EscortT e
				LEFT JOIN $EscortC ec on e.CiudadID=ec.ID
				LEFT JOIN $EscortP ep on e.ProvinciaID=ep.ID
				WHERE e.Publico=1 AND e.ID=$id";
				$EscortResult=mysql_query($SQL) or die(mysql_error());
				$cantReg=mysql_num_rows($EscortResult);
					$Escort=mysql_fetch_array($EscortResult);
					$nombre=stripslashes($Escort['Nombre']);
					$medida=stripslashes($Escort['Medidas']);				
					$categoriaID=stripslashes($Escort['CategoriaID']);
					$ciudadID=stripslashes($Escort['CiudadID']);
					$altura=stripslashes($Escort['Altura']);
					$nacionalidad=stripslashes($Escort['Nacionalidad']);
					$idioma=stripslashes($Escort['Idioma']);
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
					$ejecImgPrin=mysql_query($sqlImgPrinc);
					$cantImPrinc=mysql_num_rows($ejecImgPrin);
					$arryFotoPrinc=mysql_fetch_array($ejecImgPrin);
					
					$EscortFPago=$Prefijo."escort_formas_pagos";
					$EscortFPagoRegistro=$Prefijo."escort_formas_pagos_registro";
					$sqlFormasPago="select fp.Nombre from $EscortFPagoRegistro fpr, $EscortFPago fp where fpr.ID_forma_pago=fp.ID and fpr.ID_escort='$id' ";
					$ejecFormaPago=mysql_query($sqlFormasPago) or die (mysql_error());
					
					$EscortLAtencion=$Prefijo."escort_lugares_atencion";
					$EscortLAtencionRegistro=$Prefijo."escort_lugares_atencion_registro";
					$sqlLugaresAtencion="select la.Nombre from $EscortLAtencionRegistro lar, $EscortLAtencion la where lar.ID_lugar_atencion=la.ID and lar.ID_escort='$id' ";
					$ejecLugaresAtencion=mysql_query($sqlLugaresAtencion) or die (mysql_error());
					
					$EscortServicios=$Prefijo."escort_servicios";
					$EscortServiciosRegistro=$Prefijo."escort_servicios_registro";
					$sqlServicios="select s.Nombre from $EscortServiciosRegistro sr, $EscortServicios s where sr.ID_servicio=s.ID and sr.ID_escort='$id' ";
					$ejecServicios=mysql_query($sqlServicios) or die (mysql_error());
					
					if(strstr($arryFotoPrinc['Imagen'],'http')){ 
						$fotoPrinc=$arryFotoPrinc['Imagen'];
					}
					else
					{
						if ($cantImPrinc>0) {
							$fotoPrinc=$URLSitio.'fotos/'.$arryFotoPrinc['Imagen'];
						}	else {
							$fotoPrinc=$URLSitio.'img/nofoto306x407.jpg';
						}
					}
					$swIdVideo="";
					$EscortVideo=$Prefijo."video_escort";
					$VideoSQL="SELECT * FROM $EscortVideo WHERE Principal=1 AND IdEscort=$id";
					$EscortVideoResult=mysql_query($VideoSQL) or die(mysql_error());
					$cantreg=mysql_num_rows($EscortVideoResult);
					$recVideoDat=mysql_fetch_array($EscortVideoResult);
					if($cantreg>0)
					{$swIdVideo="Video";}
				?>
    <div id="dialog-diag" title="Video de <?php echo $nombre; ?>">
        
	<center>
			<?php 
			if($swIdVideo=="")
			{
			echo "<img src='".$URLSitio."images/anunciate.jpg' width='380' height='400'><br> No hay videos de esta Escort";
			}
			else
			{
			echo "
			<object width='450' height='400'><param name='movie' value='http://www.youtube.com/v/".$recVideoDat['Video']."'></param><embed src='http://www.youtube.com/v/".$recVideoDat['Video']."' type='application/x-shockwave-flash' width='400' height='400'></embed></object>
			";
			}
			?>
	<br><img src="<? echo $URLSitio."images/cerrar.jpg"?>" id="cancelar_c" title="Cerrar" alt="Cerrar" style="overflow:hidden" />
    </center>
    </div>
	    <?php if($cantReg>0) { ?>
	<center>  
	<div id="contenedor">
		<? include ("top.inc.php")?>
		<div id="medio">
			<div class="col_izq">
				<div class="modulos">
					<div class="modulo01">
						<div class="top"></div>
                        <?php if($cantReg>0) { 
						?>
						<a href="#"><img src="<? echo $fotoPrinc; ?>" width="370" height="470"/></a>
                        <?php } ?>
						<div class="pie"></div>
					</div>		
					<div class="final"></div>
				</div><!-- fin "modulos" -->
			</div><!-- fin "col_izq" -->

			<div class="col_der">
				<div class="tit">
					<span id="tit01"><? echo $nombre ?></span>
					<script language="" type="text/javascript">
						var flash=new SWFObject("<? echo $URLSitio?>tit.swf","","462","62","8","#ffffff");
						flash.addParam("quality", "high");
						flash.addParam("menu", "false");
						flash.addParam("wmode", "transparent");
						flash.addVariable("texto", "<? echo $nombre ?>");
						flash.write("tit01");
					</script>
				</div>
                
                <div class="tituloDatosEspecificacion">Sobre mi</div>
                <div class="datosEspecificacion1"  style=" height: 161px;">
                	<p><? echo $comentario?></p>
                </div>
                
                
                <div class="tituloDatosEspecificacion">Información</div>
                <div class="datosEspecificacion1" style=" height: 50px; ">
							<div class="datosEspecificacion4"><span>&raquo;</span><font style="color:#993300;font-weight: bold;">Edad:&nbsp;</font><?php echo $edad;?></div>
                            <div class="datosEspecificacion4"><span>&raquo;</span><font style="color:#993300;font-weight: bold;">Medias:&nbsp;</font><?php echo $medidas;?></div>
                            <div class="datosEspecificacion4"><span>&raquo;</span><font style="color:#993300;font-weight: bold;">Altura:&nbsp;</font><?php echo $altura;?></div>
                            <div class="datosEspecificacion4"><span>&raquo;</span><font style="color:#993300;font-weight: bold;">Peso:&nbsp;</font><?php echo $peso;?></div>
                            <div class="datosEspecificacion4"><span>&raquo;</span><font style="color:#993300;font-weight: bold;">Pelo:&nbsp;</font><?php echo $pelo;?></div>
                            <div class="datosEspecificacion4"><span>&raquo;</span><font style="color:#993300;font-weight: bold;">Ojos:&nbsp;</font><?php echo $ojos;?></div>
                            
                            <div class="datosEspecificacion4" style=" width: 250px; "><span>&raquo;</span><font style="color:#993300;font-weight: bold;">Nacionalidad:&nbsp;</font><?php echo $nacionalidad;?></div>
                            <div style="font-size: 1.1em;"><span style="font-size: 1.1em;color: #CA2D46;">&raquo;</span><font style="color:#993300;font-weight: bold;">Idiomas:&nbsp;</font><?php echo $idiomas;?></div>
			  </div>
              
              <div class="tituloDatosEspecificacion">Horarios y Tarifas</div>
                <div class="datosEspecificacion1" style="height: 50px; ">
                <div style="font-size: 1.1em;"><?php echo $horario;?></div>
			  
              
                <div style="font-size: 1.1em;"><span style="font-size: 1.1em;color: #CA2D46;">&raquo;</span><font style="color:#993300;font-weight: bold;">Formas de Pago: &nbsp;</font><?php $contFormasPago=0; while($arryFormasPago = mysql_fetch_array($ejecFormaPago)) { $contFormasPago++; if($contFormasPago==1){echo $arryFormasPago["Nombre"];} else {echo " - ".$arryFormasPago["Nombre"];} }?></div>
                <div style="font-size: 1.1em;"><span style="font-size: 1.1em;color: #CA2D46;">&raquo;</span><font style="color:#993300;font-weight: bold;">Atiendo en: &nbsp;</font><?php $contLugAtencion=0; while($arryLugaresAtencion = mysql_fetch_array($ejecLugaresAtencion)) { $contLugAtencion++; if($contLugAtencion==1){echo $arryLugaresAtencion["Nombre"];} else {echo " - ".$arryLugaresAtencion["Nombre"];} }?></div>
			  </div>
                
                
                <!--<div class="datosEspecificacion4"><span>&raquo;</span><font style="color:#993300">Horarios y tarifas&nbsp;</font>De Lunes a Sábados de 09.00 a 23.00 horas</div>-->
                
                
               <!-- <div class="datosEspecificacion2">
                	<div class="lineaDatosEspecificacion"><hr width="300px" style="width: 50%; margin-top: 10px; border-color: #AF646D;" /></div>
                        	<div class="tituloDatosEspecificacion">Servicios</div>
                        	<?php
							/*
								$arrayServicios=array("69","Ama","Atención a mujeres","Atención a parejas","Besos","Besos en la boca","Beso negro","Cubana","Dúplex","Fetichismo","Fiestas","Francés","Francés Natural","Francés Natural Completo","Griego","Juegos Eróticos","Juguetes","Lésbico","Lluvia","Masaje","Masaje Anal","Masajes Eróticos","Masaje Prostático","Masaje relajantes","Orgías","Sado Light","Strip-tease","Transformismo","Tríos");
								//$arrayServicios=array("69","Ama","Atención a mujeres","Atención a parejas","Besos");
								
								foreach($arrayServicios as $servicio) :
									echo '<div class="datosEspecificacion0"><span>&raquo;&nbsp;</span>'.$servicio.'</div>';
								endforeach;
								*/
							?>
                </div>-->
                
                <div>
				<div class="pieComentario">
					<span id="pieComentario"><? echo $telefono?></span>
                    
					<script language="" type="text/javascript">
						var flash=new SWFObject("<? echo $URLSitio?>tit.swf","","350","48","10","#ffffff");
						flash.addParam("quality", "high");
						flash.addParam("menu", "false");
						flash.addParam("wmode", "transparent");
						flash.addVariable("texto", "<? echo $telefono?>");
						flash.write("pieComentario");
					</script>
			  </div>
              <div class="pieComentarioUbicacion" >
			  <a href="<? echo $URLSitio?>escorts/provincia/<? echo $ProvinciaID?>/<? echo urls_amigables(stripslashes($provinciaEscort))?>.php">
			  <?php echo $provinciaEscort." - ".$ciudadEscort; ?></a></div>
			  </div>
              </div>
   
            <!-- fin "col_der" -->
			<div class="final" ></div>
            <?php if(mysql_num_rows($ejecServicios) > 0) { ?>
            <div class="tituloDatosEspecificacion">Servicios</div>
                <div class="datosEspecificacion1" style="height:auto; text-align: center;">
				<?php
                    //$arrayServicios=array("69","Ama","Atención a mujeres","Atención a parejas","Besos","Besos en la boca","Beso negro","Cubana","Dúplex","Fetichismo","Fiestas","Francés","Francés Natural","Francés Natural Completo","Griego","Juegos Eróticos","Juguetes","Lésbico","Lluvia","Masaje","Masaje Anal","Masajes Eróticos","Masaje Prostático","Masaje relajantes","Orgías","Sado Light","Strip-tease","Transformismo","Tríos");
                    /*$arrayServicios=array("69");
                    
                    foreach($arrayServicios as $servicio) :
                        echo '<div class="datosEspecificacion0"><span>&raquo;&nbsp;</span>'.$servicio.'</div>';
                    endforeach;*/					

					while($arryServiciosEscort = mysql_fetch_array($ejecServicios)) 
					{ echo '<div class="datosEspecificacion0"><span>&raquo;&nbsp;</span>'.$arryServiciosEscort["Nombre"].'</div>'; }

                ?>
			  </div>
              <?php } ?>
    <center>
    <?php 
        if($cantReg>0)
        {
        $sqlGaleria="select * from reino01_foto_escort where IdEscort='$id' and Principal=0";
        $ejecGaleria=mysql_query($sqlGaleria);
        $cantImgGaleria=mysql_num_rows($ejecGaleria);
        if($cantImgGaleria>0)
        {
    ?>
        <div id="gallery">
            <ul>
                <?php while($arryGaleria = mysql_fetch_array($ejecGaleria)) { 
					if(strstr($arryGaleria['Imagen'],'http')){ 
						$urlIMGrv=$arryGaleria['Imagen'];
					}
					else
					{
						$urlIMGrv=$URLSitio."fotos/".$arryGaleria['Imagen'];
					}
				?>
                <li>
                    <a href="<? echo $urlIMGrv; ?>" title="">
                        <img src="<? echo $urlIMGrv; ?>" width="150px" height="150px" alt="" />
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php } } ?>
    </center>
    <br>
			<div style="width:150px; float:left">
				<div id="accesos"><a href="javascript:verVideo('<?php echo $swIdVideo; ?>')"><img src="<? echo $URLSitio?>img/accesos.gif" alt="" border="0"  /></a></div>
			</div>
			<div  style="width:50px;">
					<div class="tit_tel">
						<span id="tel"><? echo $telefono?></span>
						<script language="" type="text/javascript">
							var flash=new SWFObject("<? echo $URLSitio?>tit.swf","","462","62","8","#ffffff");
							flash.addParam("quality", "high");
							flash.addParam("menu", "false");
							flash.addParam("wmode", "transparent");
							flash.addVariable("texto", "<? echo $telefono?>");
							flash.write("tel");
						</script>
					</div>
			</div>
		</div>
	</div><!-- fin "contenedor" -->
	<div class="final"></div>
    <div><br><br>
    <?php 
	$BannerT=$Prefijo."Banner";
	$BannerProvinciaT=$Prefijo."banner_provincia";
	$prefBannerPos=$Prefijo."banner_posicion";

	$sqlBannerPerfilCliente=mysql_query("select * from $BannerT b, $BannerProvinciaT bp, $prefBannerPos bpos where bp.IDProvincia='$ProvinciaID' and b.Posicion=bpos.ID and  b.ID=bp.IDBanner and b.PerfilCliente='1' and bpos.ID='2' and b.Publico='1' order by RAND()"); 
	if(mysql_num_rows($sqlBannerPerfilCliente))
	{
		$arryMostBan=mysql_fetch_array($sqlBannerPerfilCliente);
		
		$BannerMost=$arryMostBan['ArchivoMultimedia'];
		$obtTipoBan=explode(".",$BannerMost);
		$nombreBannerSinExtencion=$obtTipoBan[0];
		$tipoBann=strtolower($obtTipoBan[1]);
		$banAncho=$arryMostBan['Ancho'];
		$banAlto=$arryMostBan['Alto'];
		$desc=$arryMostBan['Descripcion'];
		$url=$arryMostBan['Nombre'];
		
		if($obtTipoBan[1]=="swf")
		{ 
		?>
		<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10.0.0.0','width','<?php echo $banAncho;?>','height','<?php echo $banAlto;?>','src','<?php echo $URLSitio."banners/".$BannerMost; ?>','quality','high','wmode','window','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','<?php echo $URLSitio."banners/".$nombreBannerSinExtencion; ?>' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10.0.0.0" width="<?php echo $banAncho;?>" height="<?php echo $banAlto;?>">
			<param name="movie" value="<?php echo $URLSitio."banners/".$BannerMost; ?>" />
			<param name="quality" value="high" />
			<param name="wmode" value="window">
			<embed src="<?php echo $URLSitio."banners/".$BannerMost; ?>" quality="high" wmode="transparent" type="application/x-shockwave-flash" width="<?php echo $banAncho;?>" height="<?php echo $banAlto;?>" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
		</object></noscript><br><br>
  <?php }
		else
		{echo "<a href='http://".$url."' target='_blank'><img src='".$URLSitio."banners/".$BannerMost."' alt='".$desc."' title='".$desc."' height='".$banAlto."' width='".$banAncho."' border='0' /></a><br><br>";
		}
		
	}
	?>
    </div>
		<div id="pie">
        
   			<? include ("pie.inc.php")?>
	    </div><!-- fin "pie" -->
    </center>
   <?php } 
   else 
   { ?>
   	<div id="contenedor_mapa">
       	<? include ("top.inc.php")?>
		<div id="medio">
			<div class="col_lateral_izq">
       	    	<? include ("col_izq.inc.php")?>
       	    </div>
                <div class="col_central">
                    <div class="modulo03">
						<div class="modulo03"><br /><br>
						<span id="tit01">No encontrado</span>
						<script language="" type="text/javascript">
						var flash=new SWFObject("<? echo $URLSitio?>tit_verde.swf","","462","62","8","#ffffff");
						flash.addParam("quality", "high");
						flash.addParam("menu", "false");
						flash.addParam("wmode", "transparent");
						flash.addVariable("texto", "No encontrado");
						flash.write("tit01");
						</script>
						<div align="center">
						<?php
							echo '<table align="center" border="0" width="400" height="100" class="final"><tr>
							<td>LO SENTIMOS...<br>
							<p>La informaci&oacute;n que estas buscando no esta disponible...</p></td>
							</tr>
							</table>';
							echo '<table border="4" bordercolor="#166367"><tr><td><img src="'.$URLSitio.'images/aviso.png" width="240" alt="" border="0" /></td></tr></table>';
						?>
                        </div>
                        </div>
                </div>
                </div>
			<div class="col_lateral_der">
	    		<? include ("col_der.inc.php")?>
			</div>
		</div>
	<!-- fin "pie" -->
   </div><!-- fin "contenedor" -->
   		<div class="final"></div>
		<div id="pie">
   			<? include ("pie.inc.php")?>
	    </div>
      <?php }  ?>
</body>
</html>

