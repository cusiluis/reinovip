<?php

include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

$donde='mapa.php';

?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <!-- ########################## -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $TituloSitio?></title>
        <meta name="description" content="Guía Erótica de España donde encontraras acompañantes vip, chicas, escorts, travestis, eros,  etc.  Publica tu anuncio GRATIS">
        <meta name="keywords" content="acompañantes vip, chicas, escorts, travestis, eros, gays, chicas en las palmas, transexuales,">
    
        <link rel="shortcut icon" href="<?php echo $URLSitio?>reinovip.ico" type="image/x-icon" />
        <link rel="icon" type="image/png" href="<?php echo $URLSitio?>reinovip.ico" />
        <link href="reinovip.css?v=1.3" rel="stylesheet" type="text/css" />
        <link href="./css/estilos.css" type="text/css" rel="stylesheet"/>
        <link href="./css/jquery.qtip.min.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" href="http://reinovip.com/css/bootstrap.css?v=1.1" />
        
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- ####### ED- ######## -->
        <link rel="stylesheet" href="http://reinovip.com/css/jquery-ui.css" />
        <link rel="stylesheet" href="http://reinovip.com/CssIndex.css?v=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet" />

        <!-- <link rel="stylesheet" href="http://reinovip.coms/CssIndex.css" /> -->
        <!-- ####### ED- ######## -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
        <script src="http://reinovip.com/select.js" type="text/javascript"></script>
        
        <script src="http://reinovip.com/Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
        <script src="./js/jquery-1.10.2.min.js"></script>
        
        <script src="./js/jquery.qtip.min.js"></script>
        <script src="./js/javascript.js"></script>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="http://reinovip.com/jqueryscrollTo-min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- ########################## -->
        
<style>
   @media (min-width: 1901px) {
        .catalogo{
    
            text-align:center;
            padding-top:30px !important;
            
        }
    }
    
    @media (min-width: 350px) {
       
        .catalogo{
            text-align:center;
            padding-top:2%;
            margin-left: 10px;
        }
    }
    @media (min-width: 400px) {
        .catalogo{
           
            
        }
    }
    @media (min-width:300px) and (max-width: 550px){
       
    }
    @media (min-width: 992px) {
        .catalogo{
            margin-left:0px;
            display: grid; 
            grid-template-columns: repeat(5, 1fr);
            gap: 0px;
            width:80%;
        }
    }
    #age-verification {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(40, 40, 40, 0.9);
  -webkit-transition: 500ms;
  transition: 500ms;
  z-index: 90000001;
  
  display: none;
}

.age-verification-main {
  background-color: #fff;
  color: black;
  font-size: .9rem;
  text-align: justify;
  padding: 25px;
  border-radius:5px;
  position: relative;
  top: 10px;
  width: 900px;
  max-width: 80%;
  margin: 0 auto;
  -webkit-box-shadow: 1px 2px 9px 0px rgba(0,0,0,0.3);
  -moz-box-shadow: 1px 2px 9px 0px rgba(0,0,0,0.3);
  box-shadow: 1px 2px 9px 0px rgba(0,0,0,0.3);
}
@media only screen and (min-height: 400px) {
  .age-verification-main {
    top: 15%;
  }
}

.age-title, .age-main-text {
  display: block;
  margin-bottom: 1em;
}
.age-title {
  font-size: 24pt;
  margin-bottom: 0.5em;
}

.age-button {
  -webkit-box-shadow: 1px 2px 9px 0px rgba(0,0,0,0.3);
  -moz-box-shadow: 1px 2px 9px 0px rgba(0,0,0,0.3);
  box-shadow: 1px 2px 9px 0px rgba(0,0,0,0.3);
  border-radius:5px;
}

.age-button {
  
  background-color: white;
  border: none;
  font-size: 1rem;
  
  color: #000;
  
  display: inline-block;
  width: 150px;
  padding: 10px;
  margin: 5px 10px;
}

.age-credits {
  /** credits are not required, but are appreciated **/
  font-family: "Source Sans Pro", sans-serif;
  color: white;
  display: block;
  font-size: 12px;
  text-decoration: normal;
  text-align: right;
  margin-top: 20px;
  margin-bottom: -15px;
}
.age-credits a {
  color: white;
}
ul.lista-condicion li{
    list-style: square;
    margin-left:30px;
}
.login-box{
    border-radius:5px;
}
    </style>
    </head>
    <body>
            <?php $id= $_GET['id'];  $sqlEscortsProvinciaInicio= $mysqli->query("SELECT a.*, p.Nombre as provincia from agencias a left join reino01_Provincia p on a.provincia_id = p.ID WHERE a.id= ".$id."");
             while($Escort = mysqli_fetch_array($sqlEscortsProvinciaInicio)){
            ?>
            <div class="container">
            <div class="row">
                <div class="col-xs-12 hidden-xs col-sm-2 col-md-2 col-lg-2" style="padding:0;">
                    <?php include_once("col_izq.inc.php")?>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-10 col-lg-10" style="padding:0 auto;">
                    
                            <?php include("cabecera.php");?>             
                            
                            <div class="col-xs-12 col-sm-8 col-md-11 col-lg-11 col-xl-11" style=""><!-- cambiar para celular -->
                            <div class="col-md-12">
                                <div class="login-box" style="float:left;width:45%;margin: 30px 30px 30px 0;text-align:center;">
                                    <img src="/fotos/<?php echo $Escort['imagen_principal'];?>" style="width:250px;border-radius:5px;">
                                    <p style="margin-top:5px;"><?php echo $Escort['descripcion'];?></p>
                                </div>
                                <div class="login-box" style="float:left;width:45%">
                                    <h3 style="text-transform:uppercase;color:#793a57;"><?php echo $Escort['nombre_agencia'];?></h3>
                                    <p><span style="width:120px;display:inline-block;">Sitio web:</span> <a href="<?php echo $Escort['web'];?>" target="_blank"><?php echo $Escort['web'];?></a></p>
                                    <p><span style="width:120px;display:inline-block;">Telefono:</span> <?php echo $Escort['telefono_1'];?></p>
                                    <p><span style="width:120px;display:inline-block;">Localidad:</span> <?php echo $Escort['provincia'];?></p>
                                    
                                </div>
                            </div>
                            <h3 style="color:#793a57;">ESCORTS DE LA AGENCIA</h3>
            <?php }?>
                            <div style="clear:both; margin-botton:30px;"></div>
                            <div class="catalogo" >
                            <?php $URLSitio = 'http://reinovip.com/'?>   
                            
                            
                            
                            

                            
                           
                            <?php
                            $qSearch = '';
                           // var_dump($_GET);
                            
                                $EscortT=$Prefijo."Escort";
                                $CiudadT=$Prefijo."Ciudad";
                                $EscortImagen=$Prefijo."foto_escort";
                                $cantMaxPublicacionesInicioEscorts = 10;
                              //  var_dump($_GET);
                                $agenciaId = $_GET['id'];
                                
                               
                                $sqlEscortsProvinciaInicio= $mysqli->query("SELECT DISTINCT (fe.Imagen), e.ID, e.Nombre , e.CategoriaID, p.Nombre as nombre_provincia, c.Nombre AS ciudadNombre 
                                                        FROM reino01_Escort as e 
                                                        left JOIN reino01_foto_escort as fe ON e.ID = fe.IdEscort 
                                                        left JOIN reino01_Provincia as p ON e.ProvinciaID = p.ID 
                                                        left JOIN reino01_ciudad AS c ON e.CiudadID = c.ID 
                                                        left join reino01_escort_usuarios u on u.id = e.usuario_id
                                                        left join agencias a on a.usuario_id = u.id
                                                        WHERE 1 = 1 AND fe.Principal = 1 AND e.Publico = 1
                                                        AND a.id = $agenciaId ");
                                            $i = 0;

                                      
                                    while($Escort = mysqli_fetch_array($sqlEscortsProvinciaInicio)){
                                        
                                    
                                    $nombre=stripslashes($Escort['Nombre']);
                                    //if($Escort['Id_WS']==0){
                                    //  if(fileExists("resize/perfil/".$Escort['Imagen'])){
                                        //    $foto='resize/perfil/'.$Escort['Imagen'];
                                    //    }
                                    //}else{
                                        $foto=$Escort['Imagen'];
                                    //}
                                    $nombre_ciudad = $Escort['ciudadNombre'];
                            ?>
                            
                            
                            <div class="modelo-inicio">
                                <div class="medio" id="<?php print_r($URLSitio);?>">
                                    <a href="<?php echo $URLSitio?>escort/<?php echo urls_amigables($nombre_ciudad)?>/<?php echo $Escort['ID'];?>/<?php echo urls_amigables($Escort['Nombre'])?>.php">
                                         <img class="login-box-perfil" src="<?php echo $URLSitio."fotos/".$foto;?>" alt="<?php echo $nombre?>"/>
                                        <?php //echo $URLSitio.$foto;?>
                                    </a>
                                </div>
                                <div class="ciudad" style="margin-top:10px; text-align:left;">
                                    <ahref="<?php echo $URLSitio?>escort/<?php echo urls_amigables($nombre_ciudad)?>/<?php echo $Escort['ID']?>/<?php echo urls_amigables($nombre)?>.php">
                                    <span  style="font-weight:500;font-size:1rem;color:#793a57"> <?php echo mb_convert_encoding($nombre,  "UTF8"); ?> </span>
                                        <?php 
                                        $adjCli="Escort";
                                        switch($Escort['CategoriaID']){
                                            case 1:
                                                $anchors = array("Escort","Chicas","Acompañantes","Sexo","Mujer","Ninfomana");
                                                shuffle($anchors);
                                                $randanchor = array_rand($anchors,1);
                                                $adjCli = $anchors[$randanchor];

                                            break;
                                            case 2:

                                                $anchors = array("Travesti","Escort travesti","Shemale","Trans","Travestis");

                                                shuffle($anchors);

                                                $randanchor = array_rand($anchors,1);

                                                $adjCli = $anchors[$randanchor];

                                            break;
                                            case 3:
                                                $anchors = array("Gays","Chicos","Escort boy","Chapero","Chaperos");
                                                shuffle($anchors);
                                                $randanchor = array_rand($anchors,1);
                                                $adjCli = $anchors[$randanchor];
                                            break;
                                            case 4:
                                                $anchors = array("Habitaciones","Habitación");
                                                shuffle($anchors);
                                                $randanchor = array_rand($anchors,1);
                                                $adjCli = $anchors[$randanchor];
                                            break;
                                            case 5:
                                                $anchors = array("Masajes","Masajes eróticos");
                                                shuffle($anchors);
                                                $randanchor = array_rand($anchors,1);
                                                $adjCli = $anchors[$randanchor];
                                            break;
                                        }
                                        ?> <div style="margin-top:5px;"></div>
                                        <font style="font-size:12px;color:#2b2b2b;">
                                            <?php echo mb_convert_encoding($Escort['ciudadNombre'], 'UTF-8');?>
                                        </font> 
                                    </a>
                                </div>
                            </div>
                          
                           
                        
                        <?php  } ?>
               
                </div>
                </div>
            </div>
            </div>
            
    
                                   
    
  </div>
</div>
    </body>
</html>




  