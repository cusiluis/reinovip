<?php

include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

$donde='mapa.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reino VIP</title>
   

<?php include ('cabecera.php') ?>
<style>
    .container {
   margin-top: 2rem !important;
   
  }

    .login-box img{
      width: 90%;
  border-radius: 15px;
  object-fit: cover;
  border-radius: 10px;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(0,0,0,0.5);
  height: 260px;
}
    
    .section-box1 {

  border-radius: 15px;
 
  margin-bottom: 20px;
}
.section-box h1 {
  color: #793a57;
  font-size: 1.5rem;
  font-weight: 500;
  font-family: "Raleway", sans-serif !important;
  margin: 15px 0px 30px 0;
  text-align: center;
}

 
  .container h2{
    font-size: 1.2rem;
    color:#793a57;
  }
p.text-age {
 width: 90%;
  margin: 0px auto;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
  padding: 12px;
  border-radius: 10px;
  font-size: 0.9rem;
}
.section-box p {
  color: #333;
  font-size: 1rem;
  font-weight: normal;
  font-family: "Raleway", sans-serif !important;
  text-align: justify;
}
.agencia-datos{
  width: 120px;
  display: inline-block;
  font-size: 1rem;
  color: #793a57;
}
    </style>
<!-- Modal para filtros móviles -->
<div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="filtersModalLabel">Filtros de Búsqueda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form class="row g-2">
          <div class="col-12"><select class="form-select"><option selected>España</option></select></div>
          <div class="col-12"><select class="form-select"><option selected>Categoría</option></select></div>
          <div class="col-12"><select class="form-select"><option selected>Provincia</option></select></div>
          <div class="col-12"><select class="form-select"><option selected>Ciudad</option></select></div>
          <div class="col-12"><input type="text" class="form-control" placeholder="Buscar..."></div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-gold w-100" data-bs-dismiss="modal"><i class="bi bi-search"></i> Buscar</button>
      </div>
    </div>
  </div>
</div>
            <?php $id= $_GET['id'];  $sqlEscortsProvinciaInicio= $mysqli->query("SELECT a.*, p.Nombre as provincia from agencias a left join reino01_Provincia p on a.provincia_id = p.ID WHERE a.id= ".$id."");
             while($Escort = mysqli_fetch_array($sqlEscortsProvinciaInicio)){
            ?>
            <div class="container my-4">
  <div class="row">
    <!-- LEFT COLUMN -->
    <div class="col-md-5">

      <!-- MAIN IMAGE -->
      <div class="section-box1 text-center">
                                <div class="login-box" >
                                    <img src="/fotos/<?php echo $Escort['imagen_principal'];?>">
                                    <p class="text-age"><?php echo $Escort['descripcion'];?> <span><a href="" style="color: #793a57;font-weight: bold;">more</a></span>
                                <br>&nbsp;
                                </p>
                                    
                                </div>
                               
                            </div>

    

    </div>

    <!-- RIGHT COLUMN -->
    <div class="col-md-8">

      <!-- PERFIL -->
      <div class="section-box">
                <div class="login-box">
                                    <h1 style="text-transform:uppercase;"><?php echo $Escort['nombre_agencia'];?></h1>
                                    <p><span class="agencia-datos"><i class="fa-solid fa-globe" style="color: #793a57;"></i> Sitio web:</span> <a href="<?php echo $Escort['web'];?>" target="_blank"><?php echo $Escort['web'];?></a></p>
                                    <p><span class="agencia-datos"><i class="fa-solid fa-phone-volume" style="color: #793a57;"></i> Telefono:</span> <?php echo $Escort['telefono_1'];?></p>
                                    <p><span class="agencia-datos"><i class="fa-solid fa-earth-americas" style="color: #793a57;"></i> Country:</span> Portugal</p>
                                   <p><span class="agencia-datos"><i class="fa-solid fa-building" style="color: #793a57;"></i> City:</span> Lisbon</p>
                                   <p><span class="agencia-datos"><i class="fas fa-map-marker-alt" style="color: #793a57;"></i> Localidad:</span> <?php echo $Escort['provincia'];?></p>
                                   <p><span class="agencia-datos"><i class="fa-solid fa-face-kiss-wink-heart" style="color: #793a57;"></i> Escorts:</span> 5</p>

                                </div>  
                            </div>
            
            
             </div>       
            
            
            
            
            
            <div class="container">
                 <h2>ESCORTS DE LA AGENCIA</h2>
           <div class="row" style="margin-top: 1.5rem;">
                
                           
            

    <!-- Card normal -->
    <div class="col">
      <div class="card h-100">
        <img src="http://reinovip.com/fotos/1200_480496.jpg" class="card-img-top" alt="Modelo">
        <div class="card-body p-2">
          <h3 class="card-title mb-1">Ana paula </h3>
          <p class="card-text small text-muted">Escort Las Palmas 7 palmas</p>
        </div>
      </div>
    </div>

    <!-- Card con VIP -->
    <div class="col">
      <div class="card h-100 position-relative vip-card">
             <img src="http://reinovip.com/fotos/1200_480496.jpg" class="card-img-top" alt="Modelo VIP">
        <div class="card-body p-2">
          <h3 class="card-title mb-1">Nombre VIP</h3>
          <p class="card-text small text-muted">Ciudad, Provincia</p>
        </div>
      </div>
    </div>

     <!-- Card normal -->
     <div class="col">
      <div class="card h-100">
        <img src="http://reinovip.com/fotos/1200_480496.jpg" class="card-img-top" alt="Modelo">
        <div class="card-body p-2">
          <h3 class="card-title mb-1">Nombre</h3>
          <p class="card-text small text-muted">Ciudad, Provincia</p>
        </div>
      </div>
    </div>

    <!-- Card con VIP -->
    <div class="col">
      <div class="card h-100 position-relative vip-card">
              <img src="http://reinovip.com/fotos/wjqvt3.jpg" class="card-img-top" alt="Modelo VIP">
        <div class="card-body p-2">
          <h3 class="card-title mb-1">Nombre VIP</h3>
          <p class="card-text small text-muted">Ciudad, Provincia</p>
        </div>
      </div>
    </div>

     <!-- Card normal -->
     <div class="col">
      <div class="card h-100">
        <img src="http://reinovip.com/fotos/1200_480496.jpg" class="card-img-top" alt="Modelo">
        <div class="card-body p-2">
          <h3 class="card-title mb-1">Nombre</h3>
          <p class="card-text small text-muted">Ciudad, Provincia</p>
        </div>
      </div>
    </div>
             </div>
            
            
                            <?php }?>
                           
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
                            
                            
                            
                          
                           
                        
                        <?php  } ?>
               
                </div>
                </div>
           
            
            
    
                                   
    
  </div>
</div>
                                    </div>
<!-- Footer -->
<?php include ('footer.php') ?>



  