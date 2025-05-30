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
	<link href="css/bootstrap.css?v=1.2" rel="stylesheet" type="text/css" />
	<link href="css/dropzone.css" rel="stylesheet" type="text/css" />
	<link href="css/cropper.css" rel="stylesheet" type="text/css" />
	<link href="css/jquery.validate.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/CssRegistro.css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" rel="stylesheet" type="text/css" />  
  
  <script src="js/ajax.js?v=1.0" type="text/javascript"></script>

	<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
	
	<script src="js/dropzone.js" type="text/javascript"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" type="text/javascript"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <link rel="stylesheet" href="css/jquery-ui.css" />
  <link rel="stylesheet" href="css/CssIndex.css?v=1.4" />

<?php 
  include ('cabecera.php');
  
?>


<style>
p {
	color: #333;
	line-height: 1.6;
	margin-top: 1em;
	text-align: justify;
}
    .login-box {
    	background-color: #fff;
    	border-radius: 10px;
    	box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    	max-width: 100%;
    	padding: 22px 15px;
    	margin-bottom: 17px;
    }


    .input-group {
    	margin-bottom: 20px;
    	width: 100%;
    }

    .input-group label {
    	font-size: .8rem !important;
    	color: #666;
    }

    .input-group input {
    	width: 100%;
    	padding: 12px;
    	border: 1px solid #ddd;
    	border-radius: 5px;
    	margin-top: 5px;
    	font-size: .8rem;
    }

    .input-group input:focus {
    	border-color: #00a850;
    	outline: none;
    }

    .error-message {
    	color: red;
    	font-size: .7rem;
    	margin-top: 5px;
    }

    @media (max-width: 480px) {

    	.login-box {
    		padding: 20px;
    	}

    	.services {
    		min-height: 350px;
    		padding: 0px;
    		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    		width: 86%;
    		max-width: 86%;
    		margin-top: 29px;
    		padding-top: 10px;
    	}
    }
@media (min-width: 350px) {
    .login-box {
        padding: 15px;
    }
  }  
.form-control {
  display: inline !important;
  width: 100% !important;
  height: 34px !important;
  padding: 6px 12px !important;
  font-size: 0.7rem !important;
  line-height: 1.42857143 !important;
  color: #555 !important;
  background-color: #fff !important;
  background-image: none !important;
  border: 1px solid #ccc;
  border-radius: 4px !important;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}  
.submit-btn {
  background-color: #702343;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: background-color 0.4s ease, transform 0.3s ease;
  width: 100%;
  margin-top: 30px;
}

/* Hover: agrandar y tono más claro */
.submit-btn:hover {
  background-color: #8a2d52;
  /* transform: scale(1.05); */
}

/* Línea brillante dorada */
.submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    120deg,
    transparent,
    rgba(255, 215, 0, 0.6),
    transparent
  );
  transition: all 0.5s ease;
}

/* Animación al pasar el mouse */
.submit-btn:hover::before {
  left: 100%;
}
</style>

<!-- Cards -->
<div class="container mt-4">
   <div class="content-container">

   
    <div class="login-box">	
                                    <h2>
                                        EDITAR ANUNCIO - <?php echo $list[0]['nombre']?>
                                    </h2>	
                                </div>
                    <form class="formRegistro" action="editar_datos.php"  name="formC" id="formC" method="POST" onsubmit=""> 
                        <div class="login-box" style="height:1200px;margin-bottom:50px;">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="categoria">Categoria:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    <input type="hidden" name="escort_id" id = "escort_id" value ="<?php echo $escort_id?>">
                                    <select name="f_categoria" class="form-control" id="f_categoria" style="height: 35px !important;width: 80% !important;">
                                        <option value="0" >---o---</option>
                                            <?php
                                            $catT=$Prefijo."Categoria";
                                            $SQLcat="SELECT * FROM $catT WHERE Publico=1 ORDER BY Nombre";
                                            $catT=$Prefijo."Categoria";
                                            
                                    
                                            $ResultCat=$mysqli->query($SQLcat);
                                            while ($categoria=mysqli_fetch_array($ResultCat)){
                                                if($categoria['ID']==$list[0]['categoriaID']){ ?>
                                                    <option value="<?php echo $categoria['ID']?>" selected="selected" ><?php echo $categoria['Nombre']?></option>
                                                <?php } else {?>
                                                    <option value="<?php echo $categoria['ID']?>" ><?php echo $categoria['Nombre']?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre (Sin Adjetivos):<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    <input type="text" value="<?php echo $list[0]['nombre']?>" class="form-control form_celdainput" style="height: 35px !important;width: 80% !important;" maxlength="20" id="f_nombre" name="f_nombre">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group" style="text-align:left;display:inline-block">
                                <div style="float:left;width:130px;">
                                    <label for="fono">Tel&eacute;fono a publicar:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    <input value="<?php echo $list[0]['telefono']?>" name="f_telefono" id="f_telefono" style="height: 34px !important;width: 130px !important;" type="text" class="form-control form_celdainput" maxlength="9" />
                                    </div>
                                    <div style="float:left;width:100px;margin-top: 16px;margin-left: 10px;">
                                    <input style="width:10px;" id= "f_whatsapp" type="checkbox" name="f_whatsapp" <?php if($list[0]['whatsapp']==1):?>checked<?php endif;?>/><img src="img/wp.png" style="width:14px;margin: 0 4px;"><label style="width:65px;font-size:.7rem;">Whatsapp </label>
                                    <input style="width:10px;margin-top:0px;" type="checkbox" name="f_telegram" <?php if($list[0]['telegram']==1):?>checked<?php endif;?>/><img src="img/tg.png" style="width:14px;margin: 0 4px;"><label style="width:65px;font-size:.7rem;">Telegram </label>
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="edad">Edad:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    <select name="f_edad" id="f_edad" style="height: 34px !important;width: 80% !important;" class="edad form-control">
                                        <option value=""></option>
                                        <option value="18" <?php if($list[0]['edad']==18):?>selected<?php endif;?>>18</option>
                                        <option value="19" <?php if($list[0]['edad']==19):?>selected<?php endif;?>>19</option>
                                        <option value="20" <?php if($list[0]['edad']==20):?>selected<?php endif;?>>20</option>
                                        <option value="21" <?php if($list[0]['edad']==21):?>selected<?php endif;?>>21</option>
                                        <option value="22" <?php if($list[0]['edad']==22):?>selected<?php endif;?>>22</option>
                                        <option value="23" <?php if($list[0]['edad']==23):?>selected<?php endif;?>>23</option>
                                        <option value="24" <?php if($list[0]['edad']==24):?>selected<?php endif;?>>24</option>
                                        <option value="25" <?php if($list[0]['edad']==25):?>selected<?php endif;?>>25</option>
                                        <option value="26" <?php if($list[0]['edad']==26):?>selected<?php endif;?>>26</option>
                                        <option value="27" <?php if($list[0]['edad']==27):?>selected<?php endif;?>>27</option>
                                        <option value="28" <?php if($list[0]['edad']==28):?>selected<?php endif;?>>28</option>
                                        <option value="29" <?php if($list[0]['edad']==29):?>selected<?php endif;?>>29</option>
                                        <option value="30" <?php if($list[0]['edad']==30):?>selected<?php endif;?>>30</option>
                                        <option value="31" <?php if($list[0]['edad']==31):?>selected<?php endif;?>>31</option>
                                        <option value="32" <?php if($list[0]['edad']==32):?>selected<?php endif;?>>32</option>
                                        <option value="33" <?php if($list[0]['edad']==33):?>selected<?php endif;?>>33</option>
                                        <option value="34" <?php if($list[0]['edad']==34):?>selected<?php endif;?>>34</option>
                                        <option value="35" <?php if($list[0]['edad']==35):?>selected<?php endif;?>>35</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="atencion">Lugares de atenci&oacute;n:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                  <select name="f_lugares[]" id="f_lugares" class="lugares form-control" multiple="multiple" style="width: 80% !important;">
                                  <?php
                                      $tablaLA = $Prefijo . "escort_lugares_atencion";
                                      $lugaresSeleccionados = array_column($list[0]['lugares'], 'id'); // Array con IDs seleccionados

                                      $sqlLA = $mysqli->query("SELECT * FROM $tablaLA WHERE Publico='1'");

                                      while ($arryLA = mysqli_fetch_assoc($sqlLA)) {
                                          $id = $arryLA["ID"];
                                          $nombre = $arryLA["Nombre"];
                                          $selected = in_array($id, $lugaresSeleccionados) ? 'selected="selected"' : '';
                                          echo "<option value=\"$id\" $selected>$nombre</option>";
                                      }
                                  ?>
                                  </select>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="horarios">Horarios de trabajo:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    <input value="<?php echo $list[0]['horario']?>"  name="f_horario" id="f_horario" type="text" maxlength="40"  class="form-control form_celdainput" style="height: 35px !important;width: 80% !important;" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="pais">Pais:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                        <select name="f_pais" class="form-control form_selector pais" id="f_pais" onchange="verProvincias(this.value,0)" style="height: 35px !important;width: 80% !important;">
                                            <option value="0">---o---</option>
                                            <?php
                                              
                                                $PaisT=$Prefijo."Pais";
                                                $SQL="SELECT * FROM $PaisT WHERE Publico=1 ORDER BY Nombre";
                                                $Result=$mysqli->query($SQL);
                                                while ($Pais=mysqli_fetch_array($Result)){
                                                  // echo '<pre>';var_dump($list[0]['paisID']);
                                                  if($Pais['ID']==41){ 
                                                    //if($Pais['ID']==$list[0]['paisID']){ 
                                                       
                                                    ?>
                                                    
                                                    <option value="<?php echo $Pais['ID']?>" selected="selected"><?php echo $Pais['Nombre']; ?></option>
                                                    <?php } else {?>
                                                    <option value="<?php echo $Pais['ID']?>"><?php echo $Pais['Nombre']; ?></option>
                                            <?php }} ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="provincia">Provincia:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                        <select name="f_provincia" onChange="verCiudades(this.value,0)" class="form-control form_selector f_provincia" id="f_provincia" disabled="disabled" style="height: 35px !important;width: 80% !important;">
                                            <option value="0">---o---</option>
                                        </select>&nbsp;&nbsp;<img src="images/cargando.gif" width="15" height="15" style="display:none" id="cargProv" />
                                        
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                        <select name="f_ciudad" class="form-control form_selector f_ciudad" id="f_ciudad" disabled="disabled" style="height: 35px !important;width: 80% !important;">
                                            <option value="0">---o---</option>
                                        </select>&nbsp;&nbsp;<img src="images/cargando.gif" width="15" height="15" style="display:none" id="cargCiu" />
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="peso">Texto a publicar:<span class="campObligatorio">&nbsp;&nbsp;* </span><span id="numcar" class="texto"></span></label>        
                                        <textarea style="height:120px;width:96% !important;" name="f_descripcion" id="f_descripcion" cols="70" rows="6" maxleng class="form-control-2 form_campo_comentarios"><?php echo $list[0]['comentario']?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                </div>
                                <div class="col-lg-12">
                                    
                                    <div class="form-group">
                                        <label for="peso">Servicios:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    </div>
                                    <div class="form-group services" style="border-radius:5px;display: flow-root;">
                                        
                                        <?php 
                                        $tablaS=$Prefijo."escort_servicios";
                                        $tablaSReg=$Prefijo."escort_servicios_registro";
                                        
                                        $sqlS = $mysqli->query("select * from $tablaS where Publico='1'");
                                        
                                           
                                        
                                            
                                            
                                        while($arryS = mysqli_fetch_array($sqlS))
                                        {
                                           
                                           
                                  
                                            $checkS=0;
                                            $nomCampS="S_".$arryS["ID"];
                                            if (in_array($arryS["ID"], $list[0]['servicios']))
                                            {$checkS=1;}
                                            echo "<div class='col-lg-4'><div style='display: inline;color: #555;background: none;background-image: none;border:none;box-shadow: none;' class='form-control checkEspecificacion3'><label><input style='width:auto;' type='checkbox' id='S_".$arryS["ID"]."'  name='S_".$arryS["ID"]."' value='1' ".($checkS==1 ? "checked='checked'" : "").">&nbsp;&nbsp;".mb_convert_encoding($arryS["Nombre"],'UTF-8')."</label></div></div>";
                                            
                                            
                                            
                                        }
                                    ?> 
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                    <h2 class="titulo" style="text-align:left;color:#793a57;font-size:18px;margin-top:29px;">INFORMACION OPCIONAL </h2>
                                </div>
                                
                                <div class="col-lg-4">
                                
                                    <div class="form-group">
                                        <label for="idiomas">Idiomas:</label><br>
                                        <select name="f_idiomas[]" id="f_idiomas" class="idioma form-control" multiple="multiple" style="height: 35px !important;width: 80% !important;">
                                            
                                            <?php 
                                            $tablaFP=$Prefijo."escort_idiomas";
                                            $tablaFPReg=$Prefijo."escort_idiomas_registro";
                                            $sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
                                          
                                       
                                            while($arryFP = mysqli_fetch_array($sqlFP)){
                                               
                                                   
                                                
                                                $checkFP=0;
                                                $nomCampo="FP_".$arryFP["ID"];
                                                if (in_array($arryFP["ID"], $list[0]['idiomas']))
                                                
                                                {$checkFP=1;}
                                                echo "<option value='".$arryFP['ID']."'  ".($checkFP==1 ? "selected='selected'" : "").">".$arryFP['Nombre']."</option>";
                                                
                                                //echo "<div class='form-control checkEspecificacion'><label><input type='checkbox' id='FP_".$arryFP["ID"]."' name='FP_".$arryFP["ID"]."' value='1' ".($checkFP==1 ? "checked='checked'" : "").">&nbsp;".$arryFP["Nombre"]."</label></div>";
                                            }
                                        
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                

                                <!-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email">E-mail (No se publicar&aacute;):<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    <input name="f_email" id="f_email" type="text" maxlength="40"  class="form-control form_celdainput"  />
                                </div>
                                </div> -->
                                
                                
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="pago">Formas de pago:</label>
                                        <select name="forma_pago[]" class="forma_pago form-control" multiple="multiple" style="height: 35px !important;width: 80% !important;">
                                          <?php 
                                            $tablaFP=$Prefijo."escort_formas_pagos";
                                            $tablaFPReg=$Prefijo."escort_formas_pagos_registro";
                                            $sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
                                            
                                            while($arryFP = mysqli_fetch_array($sqlFP)){
                                                $checkFP=0;
                                                $nomCampo="FP_".$arryFP["ID"];
                                                if (in_array($arryFP["ID"], $list[0]['pagos']))
                                                {$checkFP=1;}
                                                echo "<option value='".$arryFP['ID']."' ".($checkFP==1 ? "selected='selectd'" :"").">".$arryFP['Nombre']."</option>";
                                                //echo "<div class='form-control checkEspecificacion'><label><input type='checkbox' id='FP_".$arryFP["ID"]."' name='FP_".$arryFP["ID"]."' value='1' ".($checkFP==1 ? "checked='checked'" : "").">&nbsp;".$arryFP["Nombre"]."</label></div>";
                                            }
                                        ?>
                                        </select>	
                                </div>
                            </div>

                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="medidad">Medida (Ejem: 90-60-90):</label>
                                    <input value="<?php echo $list[0]['medidas']?>" name="f_medidas" id="f_medidas" type="text" maxlength="20" class="form-control form_celdainput" style="height: 35px !important;width: 80% !important;" />
                                </div>
                                </div>
                                <div class="col-lg-12">
                                </div>							
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="altura">Altura:</label>
                                    <select name="f_altura" id="f_altura" class="altura form-control form_celdainput" style="height: 35px !important;width: 80% !important;" >
                                        <option value=""></option>
                                        <option value="130" <?php if($list[0]['altura']==130):?>selected="selected"<?php endif;?>>130 cm / 4'3''</option>
                                        <option value="131" <?php if($list[0]['altura']==131):?>selected="selected"<?php endif;?>>131 cm / 4'4''</option>
                                        <option value="132" <?php if($list[0]['altura']==132):?>selected="selected"<?php endif;?>>132 cm / 4'4''</option>
                                        <option value="133" <?php if($list[0]['altura']==133):?>selected="selected"<?php endif;?>>133 cm / 4'4''</option>
                                        <option value="134" <?php if($list[0]['altura']==134):?>selected="selected"<?php endif;?>>134 cm / 4'5''</option>
                                        <option value="135" <?php if($list[0]['altura']==135):?>selected="selected"<?php endif;?>>135 cm / 4'5''</option>
                                        <option value="136" <?php if($list[0]['altura']==136):?>selected="selected"<?php endif;?>>136 cm / 4'6''</option>
                                        <option value="137" <?php if($list[0]['altura']==137):?>selected="selected"<?php endif;?>>137 cm / 4'6''</option>
                                        <option value="138" <?php if($list[0]['altura']==138):?>selected="selected"<?php endif;?>>138 cm / 4'6''</option>
                                        <option value="139" <?php if($list[0]['altura']==139):?>selected="selected"<?php endif;?>>139 cm / 4'7''</option>
                                        <option value="140" <?php if($list[0]['altura']==140):?>selected="selected"<?php endif;?>>140 cm / 4'7''</option>
                                        <option value="141" <?php if($list[0]['altura']==141):?>selected="selected"<?php endif;?>>141 cm / 4'8''</option>
                                        <option value="142" <?php if($list[0]['altura']==142):?>selected="selected"<?php endif;?>>142 cm / 4'8''</option>
                                        <option value="143" <?php if($list[0]['altura']==143):?>selected="selected"<?php endif;?>>143 cm / 4'8''</option>
                                        <option value="144" <?php if($list[0]['altura']==144):?>selected="selected"<?php endif;?>>144 cm / 4'9''</option>
                                        <option value="145" <?php if($list[0]['altura']==145):?>selected="selected"<?php endif;?>>145 cm / 4'9''</option>
                                        <option value="146" <?php if($list[0]['altura']==146):?>selected="selected"<?php endif;?>>146 cm / 4'9''</option>
                                        <option value="147" <?php if($list[0]['altura']==147):?>selected="selected"<?php endif;?>>147 cm / 4'10''</option>
                                        <option value="148" <?php if($list[0]['altura']==148):?>selected="selected"<?php endif;?>>148 cm / 4'10''</option>
                                        <option value="149" <?php if($list[0]['altura']==149):?>selected="selected"<?php endif;?>>149 cm / 4'11''</option>
                                        <option value="150" <?php if($list[0]['altura']==150):?>selected="selected"<?php endif;?>>150 cm / 4'11''</option>
                                        <option value="151" <?php if($list[0]['altura']==151):?>selected="selected"<?php endif;?>>151 cm / 4'11''</option>
                                        <option value="152" <?php if($list[0]['altura']==152):?>selected="selected"<?php endif;?>>152 cm / 4'12''</option>
                                        <option value="153" <?php if($list[0]['altura']==153):?>selected="selected"<?php endif;?>>153 cm / 5'0''</option>
                                        <option value="154" <?php if($list[0]['altura']==154):?>selected="selected"<?php endif;?>>154 cm / 5'1''</option>
                                        <option value="155" <?php if($list[0]['altura']==155):?>selected="selected"<?php endif;?>>155 cm / 5'1''</option>
                                        <option value="156" <?php if($list[0]['altura']==156):?>selected="selected"<?php endif;?>>156 cm / 5'1''</option>
                                        <option value="157" <?php if($list[0]['altura']==157):?>selected="selected"<?php endif;?>>157 cm / 5'2''</option>
                                        <option value="158" <?php if($list[0]['altura']==158):?>selected="selected"<?php endif;?>>158 cm / 5'2''</option>
                                        <option value="159" <?php if($list[0]['altura']==159):?>selected="selected"<?php endif;?>>159 cm / 5'3''</option>
                                        <option value="160" <?php if($list[0]['altura']==160):?>selected="selected"<?php endif;?>>160 cm / 5'3''</option>
                                        <option value="161" <?php if($list[0]['altura']==161):?>selected="selected"<?php endif;?>>161 cm / 5'3''</option>
                                        <option value="162" <?php if($list[0]['altura']==162):?>selected="selected"<?php endif;?>>162 cm / 5'4''</option>
                                        <option value="163" <?php if($list[0]['altura']==163):?>selected="selected"<?php endif;?>>163 cm / 5'4''</option>
                                        <option value="164" <?php if($list[0]['altura']==164):?>selected="selected"<?php endif;?>>164 cm / 5'5''</option>
                                        <option value="165" <?php if($list[0]['altura']==165):?>selected="selected"<?php endif;?>>165 cm / 5'5''</option>
                                        <option value="166" <?php if($list[0]['altura']==166):?>selected="selected"<?php endif;?>>166 cm / 5'5''</option>
                                        <option value="167" <?php if($list[0]['altura']==167):?>selected="selected"<?php endif;?>>167 cm / 5'6''</option>
                                        <option value="168" <?php if($list[0]['altura']==168):?>selected="selected"<?php endif;?>>168 cm / 5'6''</option>
                                        <option value="169" <?php if($list[0]['altura']==169):?>selected="selected"<?php endif;?>>169 cm / 5'7''</option>
                                        <option value="170" <?php if($list[0]['altura']==170):?>selected="selected"<?php endif;?>>170 cm / 5'7''</option>
                                        <option value="171" <?php if($list[0]['altura']==171):?>selected="selected"<?php endif;?>>171 cm / 5'7''</option>
                                        <option value="172" <?php if($list[0]['altura']==172):?>selected="selected"<?php endif;?>>172 cm / 5'8''</option>
                                        <option value="173" <?php if($list[0]['altura']==173):?>selected="selected"<?php endif;?>>173 cm / 5'8''</option>
                                        <option value="174" <?php if($list[0]['altura']==174):?>selected="selected"<?php endif;?>>174 cm / 5'9''</option>
                                        <option value="175" <?php if($list[0]['altura']==175):?>selected="selected"<?php endif;?>>175 cm / 5'9''</option>
                                        <option value="176" <?php if($list[0]['altura']==176):?>selected="selected"<?php endif;?>>176 cm / 5'9''</option>
                                        <option value="177" <?php if($list[0]['altura']==177):?>selected="selected"<?php endif;?>>177 cm / 5'10''</option>
                                        <option value="178" <?php if($list[0]['altura']==178):?>selected="selected"<?php endif;?>>178 cm / 5'10''</option>
                                        <option value="179" <?php if($list[0]['altura']==179):?>selected="selected"<?php endif;?>>179 cm / 5'10''</option>
                                        <option value="180" <?php if($list[0]['altura']==180):?>selected="selected"<?php endif;?>>180 cm / 5'11''</option>
                                        <option value="181" <?php if($list[0]['altura']==181):?>selected="selected"<?php endif;?>>181 cm / 5'11''</option>
                                        <option value="182" <?php if($list[0]['altura']==182):?>selected="selected"<?php endif;?>>182 cm / 5'12''</option>
                                        <option value="183" <?php if($list[0]['altura']==183):?>selected="selected"<?php endif;?>>183 cm / 6'0''</option>
                                        <option value="184" <?php if($list[0]['altura']==184):?>selected="selected"<?php endif;?>>184 cm / 6'0''</option>
                                        <option value="185" <?php if($list[0]['altura']==185):?>selected="selected"<?php endif;?>>185 cm / 6'1''</option>
                                        <option value="186" <?php if($list[0]['altura']==186):?>selected="selected"<?php endif;?>>186 cm / 6'1''</option>
                                        <option value="187" <?php if($list[0]['altura']==187):?>selected="selected"<?php endif;?>>187 cm / 6'2''</option>
                                        <option value="188" <?php if($list[0]['altura']==188):?>selected="selected"<?php endif;?>>188 cm / 6'2''</option>
                                        <option value="189" <?php if($list[0]['altura']==189):?>selected="selected"<?php endif;?>>189 cm / 6'2''</option>
                                        <option value="190" <?php if($list[0]['altura']==190):?>selected="selected"<?php endif;?>>190 cm / 6'3''</option>
                                        <option value="191" <?php if($list[0]['altura']==191):?>selected="selected"<?php endif;?>>191 cm / 6'3''</option>
                                        <option value="192" <?php if($list[0]['altura']==192):?>selected="selected"<?php endif;?>>192 cm / 6'4''</option>
                                        <option value="193" <?php if($list[0]['altura']==193):?>selected="selected"<?php endif;?>>193 cm / 6'4''</option>
                                        <option value="194" <?php if($list[0]['altura']==194):?>selected="selected"<?php endif;?>>194 cm / 6'4''</option>
                                        <option value="195" <?php if($list[0]['altura']==195):?>selected="selected"<?php endif;?>>195 cm / 6'5''</option>
                                        <option value="196" <?php if($list[0]['altura']==196):?>selected="selected"<?php endif;?>>196 cm / 6'5''</option>
                                        <option value="197" <?php if($list[0]['altura']==197):?>selected="selected"<?php endif;?>>197 cm / 6'6''</option>
                                        <option value="198" <?php if($list[0]['altura']==198):?>selected="selected"<?php endif;?>>198 cm / 6'6''</option>
                                        <option value="199" <?php if($list[0]['altura']==199):?>selected="selected"<?php endif;?>>199 cm / 6'6''</option>
                                        <option value="200" <?php if($list[0]['altura']==200):?>selected="selected"<?php endif;?>>200 cm / 6'7''</option>
                                    </select>
                                    
                                </div>
                            </div>
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ojos">Color de ojos:</label>
                                    <select  name="f_ojos" id="f_ojos" class="ojos form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
                                        <option value=""> </option>
                                        <option value="Negro" <?php if($list[0]['ojos']=='Negro'):?>selected="selected"<?php endif;?>>Negro</option>
                                        <option value="Azules" <?php if($list[0]['ojos']=='Azules'):?>selected="selected"<?php endif;?>>Azules</option>
                                        <option value="Azules-Verde" <?php if($list[0]['ojos']=='Azules-Verde'):?>selected="selected"<?php endif;?>>Azules-Verde</option>
                                        <option value="Pardos" <?php if($list[0]['ojos']=='Pardos'):?>selected="selected"<?php endif;?>>Pardos</option>
                                        <option value="Verdes" <?php if($list[0]['ojos']=='Verdes'):?>selected="selected"<?php endif;?>>Verdes</option>
                                        <option value="Grises" <?php if($list[0]['ojos']=='Grises'):?>selected="selected"<?php endif;?>>Grises</option>
                                        <option value="Avellana" <?php if($list[0]['ojos']=='Avellana'):?>selected="selected"<?php endif;?>>Avellana</option>
                                    </select>
                                </div>
                                </div>

                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="peso">Peso:</label>
                                    
                                    <select  name="f_peso" id="f_peso" class="peso form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
                                        <option value=""> </option>
                                        <option value="40" <?php if($list[0]['peso']==40):?>selected="selected"<?php endif;?>>40 kg / 88 lbs   </option>
                                        <option value="41" <?php if($list[0]['peso']==41):?>selected="selected"<?php endif;?>>41 kg / 90 lbs   </option>
                                        <option value="42" <?php if($list[0]['peso']==42):?>selected="selected"<?php endif;?>>42 kg / 93 lbs   </option>
                                        <option value="43" <?php if($list[0]['peso']==43):?>selected="selected"<?php endif;?>>43 kg / 95 lbs   </option>
                                        <option value="44" <?php if($list[0]['peso']==44):?>selected="selected"<?php endif;?>>44 kg / 97 lbs   </option>
                                        <option value="45" <?php if($list[0]['peso']==45):?>selected="selected"<?php endif;?>>45 kg / 99 lbs   </option>
                                        <option value="46" <?php if($list[0]['peso']==46):?>selected="selected"<?php endif;?>>46 kg / 101 lbs  </option>
                                        <option value="47" <?php if($list[0]['peso']==47):?>selected="selected"<?php endif;?>>47 kg / 104 lbs  </option>
                                        <option value="48" <?php if($list[0]['peso']==48):?>selected="selected"<?php endif;?>>48 kg / 106 lbs  </option>
                                        <option value="49" <?php if($list[0]['peso']==49):?>selected="selected"<?php endif;?>>49 kg / 108 lbs  </option>
                                        <option value="50" <?php if($list[0]['peso']==50):?>selected="selected"<?php endif;?>>50 kg / 110 lbs  </option>
                                        <option value="51" <?php if($list[0]['peso']==51):?>selected="selected"<?php endif;?>>51 kg / 112 lbs  </option>
                                        <option value="52" <?php if($list[0]['peso']==52):?>selected="selected"<?php endif;?>>52 kg / 115 lbs  </option>
                                        <option value="53" <?php if($list[0]['peso']==53):?>selected="selected"<?php endif;?>>53 kg / 117 lbs  </option>
                                        <option value="54" <?php if($list[0]['peso']==54):?>selected="selected"<?php endif;?>>54 kg / 119 lbs  </option>
                                        <option value="55" <?php if($list[0]['peso']==55):?>selected="selected"<?php endif;?>>55 kg / 121 lbs  </option>
                                        <option value="56" <?php if($list[0]['peso']==56):?>selected="selected"<?php endif;?>>56 kg / 123 lbs  </option>
                                        <option value="57" <?php if($list[0]['peso']==57):?>selected="selected"<?php endif;?>>57 kg / 126 lbs  </option>
                                        <option value="58" <?php if($list[0]['peso']==58):?>selected="selected"<?php endif;?>>58 kg / 128 lbs  </option>
                                        <option value="59" <?php if($list[0]['peso']==59):?>selected="selected"<?php endif;?>>59 kg / 130 lbs  </option>
                                        <option value="60" <?php if($list[0]['peso']==60):?>selected="selected"<?php endif;?>>60 kg / 132 lbs  </option>
                                        <option value="61" <?php if($list[0]['peso']==61):?>selected="selected"<?php endif;?>>61 kg / 134 lbs  </option>
                                        <option value="62" <?php if($list[0]['peso']==62):?>selected="selected"<?php endif;?>>62 kg / 137 lbs  </option>
                                        <option value="63" <?php if($list[0]['peso']==63):?>selected="selected"<?php endif;?>>63 kg / 139 lbs  </option>
                                        <option value="64" <?php if($list[0]['peso']==64):?>selected="selected"<?php endif;?>>64 kg / 141 lbs  </option>
                                        <option value="65" <?php if($list[0]['peso']==65):?>selected="selected"<?php endif;?>>65 kg / 143 lbs  </option>
                                        <option value="66" <?php if($list[0]['peso']==66):?>selected="selected"<?php endif;?>>66 kg / 146 lbs  </option>
                                        <option value="67" <?php if($list[0]['peso']==67):?>selected="selected"<?php endif;?>>67 kg / 148 lbs  </option>
                                        <option value="68" <?php if($list[0]['peso']==68):?>selected="selected"<?php endif;?>>68 kg / 150 lbs  </option>
                                        <option value="69" <?php if($list[0]['peso']==69):?>selected="selected"<?php endif;?>>69 kg / 152 lbs  </option>
                                        <option value="70" <?php if($list[0]['peso']==70):?>selected="selected"<?php endif;?>>70 kg / 154 lbs  </option>
                                        <option value="71" <?php if($list[0]['peso']==71):?>selected="selected"<?php endif;?>>71 kg / 157 lbs  </option>
                                        <option value="72" <?php if($list[0]['peso']==72):?>selected="selected"<?php endif;?>>72 kg / 159 lbs  </option>
                                        <option value="73" <?php if($list[0]['peso']==73):?>selected="selected"<?php endif;?>>73 kg / 161 lbs  </option>
                                        <option value="74" <?php if($list[0]['peso']==74):?>selected="selected"<?php endif;?>>74 kg / 163 lbs  </option>
                                        <option value="75" <?php if($list[0]['peso']==75):?>selected="selected"<?php endif;?>>75 kg / 165 lbs  </option>
                                        <option value="76" <?php if($list[0]['peso']==76):?>selected="selected"<?php endif;?>>76 kg / 168 lbs  </option>
                                        <option value="77" <?php if($list[0]['peso']==77):?>selected="selected"<?php endif;?>>77 kg / 170 lbs  </option>
                                        <option value="78" <?php if($list[0]['peso']==78):?>selected="selected"<?php endif;?>>78 kg / 172 lbs  </option>
                                        <option value="79" <?php if($list[0]['peso']==79):?>selected="selected"<?php endif;?>>79 kg / 174 lbs  </option>
                                        <option value="80" <?php if($list[0]['peso']==80):?>selected="selected"<?php endif;?>>80 kg / 176 lbs  </option>
                                        <option value="81" <?php if($list[0]['peso']==81):?>selected="selected"<?php endif;?>>81 kg / 179 lbs  </option>
                                        <option value="82" <?php if($list[0]['peso']==82):?>selected="selected"<?php endif;?>>82 kg / 181 lbs  </option>
                                        <option value="83" <?php if($list[0]['peso']==83):?>selected="selected"<?php endif;?>>83 kg / 183 lbs  </option>
                                        <option value="84" <?php if($list[0]['peso']==84):?>selected="selected"<?php endif;?>>84 kg / 185 lbs  </option>
                                        <option value="85" <?php if($list[0]['peso']==85):?>selected="selected"<?php endif;?>>85 kg / 187 lbs  </option>
                                        <option value="86" <?php if($list[0]['peso']==86):?>selected="selected"<?php endif;?>>86 kg / 190 lbs  </option>
                                        <option value="87" <?php if($list[0]['peso']==87):?>selected="selected"<?php endif;?>>87 kg / 192 lbs  </option>
                                        <option value="88" <?php if($list[0]['peso']==88):?>selected="selected"<?php endif;?>>88 kg / 194 lbs  </option>
                                        <option value="89" <?php if($list[0]['peso']==89):?>selected="selected"<?php endif;?>>89 kg / 196 lbs  </option>
                                        <option value="90" <?php if($list[0]['peso']==90):?>selected="selected"<?php endif;?>>90 kg / 198 lbs  </option>
                                        <option value="91" <?php if($list[0]['peso']==91):?>selected="selected"<?php endif;?>>91 kg / 201 lbs  </option>
                                        <option value="92" <?php if($list[0]['peso']==92):?>selected="selected"<?php endif;?>>92 kg / 203 lbs  </option>
                                        <option value="93" <?php if($list[0]['peso']==93):?>selected="selected"<?php endif;?>>93 kg / 205 lbs  </option>
                                        <option value="94" <?php if($list[0]['peso']==94):?>selected="selected"<?php endif;?>>94 kg / 207 lbs  </option>
                                        <option value="95" <?php if($list[0]['peso']==95):?>selected="selected"<?php endif;?>>95 kg / 209 lbs  </option>
                                        <option value="96" <?php if($list[0]['peso']==96):?>selected="selected"<?php endif;?>>96 kg / 212 lbs  </option>
                                        <option value="97" <?php if($list[0]['peso']==97):?>selected="selected"<?php endif;?>>97 kg / 214 lbs  </option>
                                        <option value="98" <?php if($list[0]['peso']==98):?>selected="selected"<?php endif;?>>98 kg / 216 lbs  </option>
                                        <option value="99" <?php if($list[0]['peso']==99):?>selected="selected"<?php endif;?>>99 kg / 218 lbs  </option>
                                        <option value="100"  <?php if($list[0]['peso']==100):?>selected="selected"<?php endif;?>>100 kg / 220 lbs</option>
                                        <option value="101"  <?php if($list[0]['peso']==101):?>selected="selected"<?php endif;?>>101 kg / 223 lbs</option>
                                        <option value="102"  <?php if($list[0]['peso']==102):?>selected="selected"<?php endif;?>>102 kg / 225 lbs</option>
                                        <option value="103"  <?php if($list[0]['peso']==103):?>selected="selected"<?php endif;?>>103 kg / 227 lbs</option>
                                        <option value="104"  <?php if($list[0]['peso']==104):?>selected="selected"<?php endif;?>>104 kg / 229 lbs</option>
                                        <option value="105"  <?php if($list[0]['peso']==105):?>selected="selected"<?php endif;?>>105 kg / 231 lbs</option>
                                        <option value="106"  <?php if($list[0]['peso']==106):?>selected="selected"<?php endif;?>>106 kg / 234 lbs</option>
                                        <option value="107"  <?php if($list[0]['peso']==107):?>selected="selected"<?php endif;?>>107 kg / 236 lbs</option>
                                        <option value="108"  <?php if($list[0]['peso']==108):?>selected="selected"<?php endif;?>>108 kg / 238 lbs</option>
                                        <option value="109"  <?php if($list[0]['peso']==109):?>selected="selected"<?php endif;?>>109 kg / 240 lbs</option>
                                        <option value="110"  <?php if($list[0]['peso']==110):?>selected="selected"<?php endif;?>>110 kg / 243 lbs</option>
                                        <option value="111"  <?php if($list[0]['peso']==111):?>selected="selected"<?php endif;?>>111 kg / 245 lbs</option>
                                        <option value="112"  <?php if($list[0]['peso']==112):?>selected="selected"<?php endif;?>>112 kg / 247 lbs</option>
                                        <option value="113"  <?php if($list[0]['peso']==113):?>selected="selected"<?php endif;?>>113 kg / 249 lbs</option>
                                        <option value="114"  <?php if($list[0]['peso']==114):?>selected="selected"<?php endif;?>>114 kg / 251 lbs</option>
                                        <option value="115"  <?php if($list[0]['peso']==115):?>selected="selected"<?php endif;?>>115 kg / 254 lbs</option>
                                        <option value="116"  <?php if($list[0]['peso']==116):?>selected="selected"<?php endif;?>>116 kg / 256 lbs</option>
                                        <option value="117"  <?php if($list[0]['peso']==117):?>selected="selected"<?php endif;?>>117 kg / 258 lbs</option>
                                        <option value="118"  <?php if($list[0]['peso']==118):?>selected="selected"<?php endif;?>>118 kg / 260 lbs</option>
                                        <option value="119"  <?php if($list[0]['peso']==119):?>selected="selected"<?php endif;?>>119 kg / 262 lbs</option>
                                        <option value="120"  <?php if($list[0]['peso']==120):?>selected="selected"<?php endif;?>>120 kg / 265 lbs</option>
                                        <option value="121"  <?php if($list[0]['peso']==121):?>selected="selected"<?php endif;?>>121 kg / 267 lbs</option>
                                        <option value="122"  <?php if($list[0]['peso']==122):?>selected="selected"<?php endif;?>>122 kg / 269 lbs</option>
                                        <option value="123"  <?php if($list[0]['peso']==123):?>selected="selected"<?php endif;?>>123 kg / 271 lbs</option>
                                        <option value="124"  <?php if($list[0]['peso']==124):?>selected="selected"<?php endif;?>>124 kg / 273 lbs</option>
                                        <option value="125"  <?php if($list[0]['peso']==125):?>selected="selected"<?php endif;?>>125 kg / 276 lbs</option>
                                        <option value="126"  <?php if($list[0]['peso']==126):?>selected="selected"<?php endif;?>>126 kg / 278 lbs</option>
                                        <option value="127"  <?php if($list[0]['peso']==127):?>selected="selected"<?php endif;?>>127 kg / 280 lbs</option>
                                        <option value="128"  <?php if($list[0]['peso']==128):?>selected="selected"<?php endif;?>>128 kg / 282 lbs</option>
                                        <option value="129"  <?php if($list[0]['peso']==129):?>selected="selected"<?php endif;?>>129 kg / 284 lbs</option>
                                        <option value="130"  <?php if($list[0]['peso']==130):?>selected="selected"<?php endif;?>>130 kg / 287 lbs</option>
                                        <option value="131"  <?php if($list[0]['peso']==131):?>selected="selected"<?php endif;?>>131 kg / 289 lbs</option>
                                        <option value="132"  <?php if($list[0]['peso']==132):?>selected="selected"<?php endif;?>>132 kg / 291 lbs</option>
                                        <option value="133"  <?php if($list[0]['peso']==133):?>selected="selected"<?php endif;?>>133 kg / 293 lbs</option>
                                        <option value="134"  <?php if($list[0]['peso']==134):?>selected="selected"<?php endif;?>>134 kg / 295 lbs</option>
                                        <option value="135"  <?php if($list[0]['peso']==135):?>selected="selected"<?php endif;?>>135 kg / 298 lbs</option>
                                        <option value="136"  <?php if($list[0]['peso']==136):?>selected="selected"<?php endif;?>>136 kg / 300 lbs</option>
                                        <option value="137"  <?php if($list[0]['peso']==137):?>selected="selected"<?php endif;?>>137 kg / 302 lbs</option>
                                        <option value="138"  <?php if($list[0]['peso']==138):?>selected="selected"<?php endif;?>>138 kg / 304 lbs</option>
                                        <option value="139"  <?php if($list[0]['peso']==139):?>selected="selected"<?php endif;?>>139 kg / 306 lbs</option>
                                        <option value="140"  <?php if($list[0]['peso']==140):?>selected="selected"<?php endif;?>>140 kg / 309 lbs</option>
                                        <option value="141"  <?php if($list[0]['peso']==141):?>selected="selected"<?php endif;?>>141 kg / 311 lbs</option>
                                        <option value="142"  <?php if($list[0]['peso']==142):?>selected="selected"<?php endif;?>>142 kg / 313 lbs</option>
                                        <option value="143"  <?php if($list[0]['peso']==143):?>selected="selected"<?php endif;?>>143 kg / 315 lbs</option>
                                        <option value="144"  <?php if($list[0]['peso']==144):?>selected="selected"<?php endif;?>>144 kg / 317 lbs</option>
                                        <option value="145"  <?php if($list[0]['peso']==145):?>selected="selected"<?php endif;?>>145 kg / 320 lbs</option>
                                        <option value="146"  <?php if($list[0]['peso']==146):?>selected="selected"<?php endif;?>>146 kg / 322 lbs</option>
                                        <option value="147"  <?php if($list[0]['peso']==147):?>selected="selected"<?php endif;?>>147 kg / 324 lbs</option>
                                        <option value="148"  <?php if($list[0]['peso']==148):?>selected="selected"<?php endif;?>>148 kg / 326 lbs</option>
                                        <option value="149"  <?php if($list[0]['peso']==149):?>selected="selected"<?php endif;?>>149 kg / 328 lbs</option>
                                        <option value="150"  <?php if($list[0]['peso']==150):?>selected="selected"<?php endif;?>>150 kg / 331 lbs</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                </div>
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nacionalidad">Nacionalidad:<span class="campObligatorio">&nbsp;&nbsp;*</span></label>
                                    <select name="f_nacionalidad" id="f_nacionalidad"class="nacionalidad form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
                                        <option  <?php if($list[0]['nacionalidad']==''):?>selected="selected"<?php endif;?> value=""></option>
                                        <option  <?php if($list[0]['nacionalidad']=='Afghan'):?>selected="selected"<?php endif;?> value="Afghan">Afghan  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='albanesa'):?>selected="selected"<?php endif;?> value="albanesa">albanesa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='alemana'):?>selected="selected"<?php endif;?> value="alemana">alemana  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='americana'):?>selected="selected"<?php endif;?> value="americana">americana</option>
                                        <option  <?php if($list[0]['nacionalidad']=='argentina'):?>selected="selected"<?php endif;?> value="argentina">argentina</option>
                                        <option  <?php if($list[0]['nacionalidad']=='armenia'):?>selected="selected"<?php endif;?> value="armenia">armenia </option>
                                        <option  <?php if($list[0]['nacionalidad']=='australiana'):?>selected="selected"<?php endif;?> value="australiana">australiana</option>
                                        <option  <?php if($list[0]['nacionalidad']=='austriaca'):?>selected="selected"<?php endif;?> value="austriaca">austríaca</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Azerbaiyan'):?>selected="selected"<?php endif;?> value="Azerbaiyán ">Azerbaiyán</option>
                                        <option  <?php if($list[0]['nacionalidad']=='bahamas'):?>selected="selected"<?php endif;?> value="bahamas">bahamas </option>
                                        <option  <?php if($list[0]['nacionalidad']=='bahraini'):?>selected="selected"<?php endif;?> value="bahraini">bahraini </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Bangladesh'):?>selected="selected"<?php endif;?> value="Bangladesh">Bangladesh</option>
                                        <option  <?php if($list[0]['nacionalidad']=='barbadense'):?>selected="selected"<?php endif;?> value="barbadense">barbadense </option>
                                        <option  <?php if($list[0]['nacionalidad']=='belga'):?>selected="selected"<?php endif;?> value="belga">belga </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Beliceño'):?>selected="selected"<?php endif;?> value="Beliceño">Beliceño</option>
                                        <option  <?php if($list[0]['nacionalidad']=='bielorrusa'):?>selected="selected"<?php endif;?> value="bielorrusa">bielorrusa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='boliviana'):?>selected="selected"<?php endif;?> value="boliviana">boliviana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Bosnian'):?>selected="selected"<?php endif;?> value="Bosnian">Bosnian </option>
                                        <option  <?php if($list[0]['nacionalidad']=='brasileña'):?>selected="selected"<?php endif;?> value="brasileña">brasileña</option>
                                        <option  <?php if($list[0]['nacionalidad']=='britanica'):?>selected="selected"<?php endif;?> value="britanica">británica</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Bruneian'):?>selected="selected"<?php endif;?> value="Bruneian">Bruneian</option>
                                        <option  <?php if($list[0]['nacionalidad']=='bulgara'):?>selected="selected"<?php endif;?> value="bulgara">búlgara  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Burmese'):?>selected="selected"<?php endif;?> value="Burmese">Burmese </option>
                                        <option  <?php if($list[0]['nacionalidad']=='camerunes'):?>selected="selected"<?php endif;?> value="camerunés">camerunés</option>
                                        <option  <?php if($list[0]['nacionalidad']=='canadiense'):?>selected="selected"<?php endif;?> value="canadiense">canadiense </option>
                                        <option  <?php if($list[0]['nacionalidad']=='checa'):?>selected="selected"<?php endif;?> value="checa">checa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='chilena'):?>selected="selected"<?php endif;?> value="chilena">chilena  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='china'):?>selected="selected"<?php endif;?> value="china">china </option>
                                        <option  <?php if($list[0]['nacionalidad']=='colombiana'):?>selected="selected"<?php endif;?> value="colombiana">colombiana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='coreana'):?>selected="selected"<?php endif;?> value="coreana">coreana  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='costarricense'):?>selected="selected"<?php endif;?> value="costarricense">costarricense </option>
                                        <option  <?php if($list[0]['nacionalidad']=='croata'):?>selected="selected"<?php endif;?> value="croata">croata</option>
                                        <option  <?php if($list[0]['nacionalidad']=='cubana'):?>selected="selected"<?php endif;?> value="cubana">cubana</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Cyprus'):?>selected="selected"<?php endif;?> value="Cyprus">Cyprus  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='danesa'):?>selected="selected"<?php endif;?> value="danesa">danesa</option>
                                        <option  <?php if($list[0]['nacionalidad']=='dominicana'):?>selected="selected"<?php endif;?> value="dominicana">dominicana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='ecuatoriana'):?>selected="selected"<?php endif;?> value="ecuatoriana">ecuatoriana  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Egyptian'):?>selected="selected"<?php endif;?> value="Egyptian">Egyptian</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Emiratis'):?>selected="selected"<?php endif;?> value="Emiratis">Emiratis</option>
                                        <option  <?php if($list[0]['nacionalidad']=='eslovaca'):?>selected="selected"<?php endif;?> value="eslovaca">eslovaca </option>
                                        <option  <?php if($list[0]['nacionalidad']=='eslovena'):?>selected="selected"<?php endif;?> value="eslovena">eslovena </option>
                                        <option  <?php if($list[0]['nacionalidad']=='española'):?>selected="selected"<?php endif;?> value="española">española </option>
                                        <option  <?php if($list[0]['nacionalidad']=='estonia'):?>selected="selected"<?php endif;?> value="estonia">estonia  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Ethiopian'):?>selected="selected"<?php endif;?> value="Ethiopian">Ethiopian </option>
                                        <option  <?php if($list[0]['nacionalidad']=='filipina'):?>selected="selected"<?php endif;?> value="filipina">filipina </option>
                                        <option  <?php if($list[0]['nacionalidad']=='finlandesa'):?>selected="selected"<?php endif;?> value="finlandesa">finlandesa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='francesa'):?>selected="selected"<?php endif;?> value="francesa">francesa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='georgiana'):?>selected="selected"<?php endif;?> value="georgiana">georgiana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='ghanesa'):?>selected="selected"<?php endif;?> value="ghanesa">ghanesa  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='griega'):?>selected="selected"<?php endif;?> value="griega">griega</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Hondureño'):?>selected="selected"<?php endif;?> value="Hondureño">Hondureño </option>
                                        <option  <?php if($list[0]['nacionalidad']=='hungara'):?>selected="selected"<?php endif;?> value="hungara">húngara  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='india'):?>selected="selected"<?php endif;?> value="india">india </option>
                                        <option  <?php if($list[0]['nacionalidad']=='indonesia'):?>selected="selected"<?php endif;?> value="indonesia">indonesia</option>
                                        <option  <?php if($list[0]['nacionalidad']=='inglesa'):?>selected="selected"<?php endif;?> value="inglesa">inglesa  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='irani'):?>selected="selected"<?php endif;?> value="irani">iraní</option>
                                        <option  <?php if($list[0]['nacionalidad']=='irlandesa'):?>selected="selected"<?php endif;?> value="irlandesa">irlandesa</option>
                                        <option  <?php if($list[0]['nacionalidad']=='israelí'):?>selected="selected"<?php endif;?> value="israelí">israelí  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='italiana'):?>selected="selected"<?php endif;?> value="italiana">italiana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='jamaicano'):?>selected="selected"<?php endif;?> value="jamaicano">jamaicano</option>
                                        <option  <?php if($list[0]['nacionalidad']=='japonesa'):?>selected="selected"<?php endif;?> value="japonesa">japonesa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Jordanian'):?>selected="selected"<?php endif;?> value="Jordanian">Jordanian </option>
                                        <option  <?php if($list[0]['nacionalidad']=='kazaja'):?>selected="selected"<?php endif;?> value="kazaja">kazaja  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='keniana'):?>selected="selected"<?php endif;?> value="keniana">keniana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Kosovar'):?>selected="selected"<?php endif;?> value="Kosovar">Kosovar </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Kuwaiti'):?>selected="selected"<?php endif;?> value="Kuwaiti">Kuwaiti </option>
                                        <option  <?php if($list[0]['nacionalidad']=='laosiana'):?>selected="selected"<?php endif;?> value="laosiana">laosiana</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Laotian'):?>selected="selected"<?php endif;?> value="Laotian">Laotian </option>
                                        <option  <?php if($list[0]['nacionalidad']=='leton'):?>selected="selected"<?php endif;?> value="leton">letón </option>
                                        <option  <?php if($list[0]['nacionalidad']=='libanesa'):?>selected="selected"<?php endif;?> value="libanesa">libanesa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='lituano'):?>selected="selected"<?php endif;?> value="lituano">lituano  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='luxemburguesa'):?>selected="selected"<?php endif;?> value="luxemburguesa">luxemburguesa</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Macau'):?>selected="selected"<?php endif;?> value="Macau">Macau</option>
                                        <option  <?php if($list[0]['nacionalidad']=='malaya'):?>selected="selected"<?php endif;?> value="malaya">malaya</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Maldivian'):?>selected="selected"<?php endif;?> value="Maldivian">Maldivian </option>
                                        <option  <?php if($list[0]['nacionalidad']=='maltesa'):?>selected="selected"<?php endif;?> value="maltesa">maltesa  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='marfileña'):?>selected="selected"<?php endif;?> value="marfileña">marfileña </option>
                                        <option  <?php if($list[0]['nacionalidad']=='maroquí'):?>selected="selected"<?php endif;?> value="maroquí">maroquí </option>
                                        <option  <?php if($list[0]['nacionalidad']=='mexicana'):?>selected="selected"<?php endif;?> value="mexicana">mexicana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='moldava'):?>selected="selected"<?php endif;?> value="moldava">moldava  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='mongola'):?>selected="selected"<?php endif;?> value="mongola">mongola  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='montenegrina'):?>selected="selected"<?php endif;?> value="montenegrina">montenegrina  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Mozambican'):?>selected="selected"<?php endif;?> value="Mozambican">Mozambican</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Namibian'):?>selected="selected"<?php endif;?> value="Namibian">Namibian</option>
                                        <option  <?php if($list[0]['nacionalidad']=='neerlandesa'):?>selected="selected"<?php endif;?> value="neerlandesa">neerlandesa</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Neozelandes'):?>selected="selected"<?php endif;?> value="Neozelandes">Neozelandés  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Nepali'):?>selected="selected"<?php endif;?> value="Nepali">Nepalí  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='nigeriana'):?>selected="selected"<?php endif;?> value="nigeriana">nigeriana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='noruega'):?>selected="selected"<?php endif;?> value="noruega">noruega  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Omani'):?>selected="selected"<?php endif;?> value="Omani">Omani</option>
                                        <option  <?php if($list[0]['nacionalidad']=='pakistaní'):?>selected="selected"<?php endif;?> value="pakistaní">pakistaní</option>
                                        <option  <?php if($list[0]['nacionalidad']=='panameña'):?>selected="selected"<?php endif;?> value="panameña">panameña </option>
                                        <option  <?php if($list[0]['nacionalidad']=='paraguaya'):?>selected="selected"<?php endif;?> value="paraguaya">paraguaya</option>
                                        <option  <?php if($list[0]['nacionalidad']=='peruana'):?>selected="selected"<?php endif;?> value="peruana">peruana  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='polaca'):?>selected="selected"<?php endif;?> value="polaca">polaca</option>
                                        <option  <?php if($list[0]['nacionalidad']=='portuguesa'):?>selected="selected"<?php endif;?> value="portuguesa">portuguesa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='puertorriqueña'):?>selected="selected"<?php endif;?> value="puertorriqueña">puertorriqueña</option>
                                        <option  <?php if($list[0]['nacionalidad']=='rumana'):?>selected="selected"<?php endif;?> value="rumana">rumana</option>
                                        <option  <?php if($list[0]['nacionalidad']=='rusa'):?>selected="selected"<?php endif;?> value="rusa">rusa</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Saudi'):?>selected="selected"<?php endif;?> value="Saudi">Saudí</option>
                                        <option  <?php if($list[0]['nacionalidad']=='serbia'):?>selected="selected"<?php endif;?> value="serbia">serbia</option>
                                        <option  <?php if($list[0]['nacionalidad']=='singapurense'):?>selected="selected"<?php endif;?> value="singapurense">singapurense  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Sri'):?>selected="selected"<?php endif;?> value="Sri Lankan">Sri Lankan</option>
                                        <option  <?php if($list[0]['nacionalidad']=='sudafricana'):?>selected="selected"<?php endif;?> value="sudafricana">sudafricana</option>
                                        <option  <?php if($list[0]['nacionalidad']=='sueca'):?>selected="selected"<?php endif;?> value="sueca">sueca </option>
                                        <option  <?php if($list[0]['nacionalidad']=='suiza'):?>selected="selected"<?php endif;?> value="suiza">suiza </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Syrian'):?>selected="selected"<?php endif;?> value="Syrian">Syrian  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='tailandesa'):?>selected="selected"<?php endif;?> value="tailandesa">tailandesa </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Taiwán'):?>selected="selected"<?php endif;?> value="Taiwán">Taiwán  </option>
                                        <option  <?php if($list[0]['nacionalidad']=='Tanzano'):?>selected="selected"<?php endif;?> value="Tanzano">Tanzano </option>
                                        <option  <?php if($list[0]['nacionalidad']=='trinitense'):?>selected="selected"<?php endif;?> value="trinitense">trinitense</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Tunisian'):?>selected="selected"<?php endif;?> value="Tunisian">Tunisian</option>
                                        <option  <?php if($list[0]['nacionalidad']=='turca'):?>selected="selected"<?php endif;?> value="turca">turca </option>
                                        <option  <?php if($list[0]['nacionalidad']=='ucraniana'):?>selected="selected"<?php endif;?> value="ucraniana">ucraniana</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Ugandés'):?>selected="selected"<?php endif;?> value="Ugandés">Ugandés </option>
                                        <option  <?php if($list[0]['nacionalidad']=='uruguayo'):?>selected="selected"<?php endif;?> value="uruguayo">uruguayo</option>
                                        <option  <?php if($list[0]['nacionalidad']=='Uzbek'):?>selected="selected"<?php endif;?> value="Uzbek">Uzbek</option>
                                        <option  <?php if($list[0]['nacionalidad']=='venezolana'):?>selected="selected"<?php endif;?> value="venezolana">venezolana </option>
                                        <option  <?php if($list[0]['nacionalidad']=='vietnamita'):?>selected="selected"<?php endif;?> value="vietnamita">vietnamita </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="pelo">Color de pelo:</label>
                                    <select  name="f_pelo" id="f_pelo" class="pelo form-control form_celdainput" style="height: 35px !important;width: 80% !important;">
                                        <option value=""></option>
                                        <option <?php if($list[0]['pelo']=='Rubio'):?>selected="selected"<?php endif;?> value="Rubio">Rubio </option>
                                        <option <?php if($list[0]['pelo']=='Pardo'):?>selected="selected"<?php endif;?> value="Pardo">Pardo </option>
                                        <option <?php if($list[0]['pelo']=='Negro'):?>selected="selected"<?php endif;?> value="Negro">Negro </option>
                                        <option <?php if($list[0]['pelo']=='Pelirrojo'):?>selected="selected"<?php endif;?> value="Pelirrojo">Pelirrojo </option>
                                    </select>
                                </div>
                            </div>
                        <div class="col-lg-12">
							<div class="form-group form-inline">
								<button type="submit"  class="submit-btn" >EDITAR ANUNCIO</button>
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
             $(document).ready(function(){
        
            verProvincias(41,<?php echo $list[0]['provinciaID'] ?>);
            verCiudades(<?php echo $list[0]['provinciaID'] ?>, <?php echo $list[0]['ciudadID'] ?>)
        });
        </script>
<!-- Footer -->
<?php include ('footer.php') ?>

