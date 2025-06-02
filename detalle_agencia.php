<?php

include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

$donde='mapa.php';
//print_r($_SESSION);exit;
//print_r($_GET);
$idag = isset($_GET['id']) ? intval($_GET['id']) : 0; // Seguridad básica: solo enteros

$prefijo = "reino01_";

$sql = "SELECT DISTINCT a.id, a.nombre_agencia, a.descripcion, a.imagen_principal, a.web, 
               a.telefono_1, a.direccion, a.pais_id, a.provincia_id, a.ciudad_id, a.usuario_id,
               p.Nombre AS nombre_provincia,
               c.Nombre AS ciudadNombre,
               pa.Nombre AS nombre_pais
        FROM agencias a
        JOIN {$prefijo}Ciudad c ON a.ciudad_id = c.ID
        JOIN {$prefijo}Provincia p ON a.provincia_id = p.ID
        JOIN {$prefijo}Pais pa ON a.pais_id = pa.ID
        WHERE a.id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $idag);
$stmt->execute();
$res = $stmt->get_result();

if ($res && $agencia = $res->fetch_assoc()) {
    $nombreAgencia     = $agencia['nombre_agencia'];
    $descrAgencia      = $agencia['descripcion'];
    $telefonoAgencia   = $agencia['telefono_1'];
    $direccionAgencia  = $agencia['direccion'];
    $webAgencia        = $agencia['web'];
    $paisAgencia       = $agencia['nombre_pais'];
    $provinciaAgencia  = $agencia['nombre_provincia'];
    $ciudadAgencia     = $agencia['ciudadNombre'];
    $imagenAgencia     = $agencia['imagen_principal'];
    $usuarioId     = $agencia['usuario_id'];
} else {
    echo "Agencia no encontrada.";
}
//print_r($sql);exit;
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
a{
    color:#793a57;
    text-decoration: none;
   
}
a:hover{
    color: #f4b900;
  text-decoration: underline;
   
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

            <?php
            // $id= $_GET['id'];  
            // $sqlEscortsProvinciaInicio= $mysqli->query("SELECT a.*, p.Nombre as provincia from agencias a left join reino01_Provincia p on a.provincia_id = p.ID WHERE a.id= ".$id."");
            // print_r($sqlEscortsProvinciaInicio); 
            // while($Escort = mysqli_fetch_array($sqlEscortsProvinciaInicio)){
            ?>
            <div class="container my-4">
  <div class="row">
    <!-- LEFT COLUMN -->
    <div class="col-md-5">

      <!-- MAIN IMAGE -->
      <div class="section-box1 text-center">
                                <div class="login-box" >
                                    <img src="<?php echo $URLSitio?>fotos/<?php echo $imagenAgencia;?>">
                                    <p class="text-age"><?php echo $descrAgencia;?> 
                                    <!-- <span><a href=""><strong>more...</strong></a></span> -->
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
                                    <h1 style="text-transform:uppercase;"><?php  echo $nombreAgencia; ?></h1>
                                    <p><span class="agencia-datos"><i class="fa-solid fa-globe" style="color: #793a57;"></i> Sitio web:</span> <a href="<?php echo $webAgencia;?>" target="_blank"><strong><?php echo $webAgencia;?></strong></a></p>
                                    <p><span class="agencia-datos"><i class="fa-solid fa-phone-volume" style="color: #793a57;"></i> Telefono:</span> <?php echo $telefonoAgencia;?></p>
                                    <p><span class="agencia-datos"><i class="fa-solid fa-earth-americas" style="color: #793a57;"></i> Country:</span> <?php echo $paisAgencia;?></p>
                                   <p><span class="agencia-datos"><i class="fa-solid fa-building" style="color: #793a57;"></i> Provincia:</span> <?php echo $provinciaAgencia;?></p>
                                   <p><span class="agencia-datos"><i class="fas fa-map-marker-alt" style="color: #793a57;"></i> Ciudad:</span> <?php echo $ciudadAgencia;?></p>
                                   <p><span class="agencia-datos"><i class="fa-solid fa-face-kiss-wink-heart" style="color: #793a57;"></i> Escorts:</span> 5</p>

                                </div>  
                            </div>
            
            
             </div>       
            
            
            
            
            
            <div class="container mt-4">
                 <h2>ESCORTS DE LA AGENCIA</h2>
           <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4" style="margin-top: 1.5rem;">
                
                           
    
           
<?php
$sql = "SELECT DISTINCT fe.Imagen, e.Nombre, e.CategoriaID, e.ID AS id_es,
               pa.Nombre AS nombre_pais,
               p.Nombre AS nombre_provincia,
               c.Nombre AS ciudadNombre,
               pa.ID
        FROM reino01_Escort AS e
        JOIN {$prefijo}foto_escort AS fe ON e.ID = fe.IdEscort
        JOIN {$prefijo}Pais AS pa ON e.PaisID = pa.ID
        JOIN {$prefijo}Provincia AS p ON e.ProvinciaID = p.ID
        JOIN {$prefijo}Ciudad AS c ON e.CiudadID = c.ID
        WHERE fe.Principal = 1
          AND e.usuario_id = {$usuarioId}
          AND e.Publico IN (1,0)";
//print_r($sql);
// Ejecutar la consulta
$resultado = $mysqli->query($sql);

if ($resultado) {
    while ($Escort = $resultado->fetch_assoc()) {
        $nombre = stripslashes($Escort['Nombre']);
        $foto = $Escort['Imagen'];
        $nombre_provincia = $Escort['nombre_provincia'];
        $nombre_ciudad = $Escort['ciudadNombre'];
        $id = $Escort['id_es'];
        $url_ciudad = urls_amigables($nombre_ciudad);
        $url_nombre = urls_amigables($nombre);
        
//print_r($id);
        // Construcción de enlace
        $href = "{$URLSitio}escort/{$url_ciudad}/{$id}/{$url_nombre}.php";
        ?>

    <div class="col">
      <a href="<?php echo $href?>" class="text-decoration-none text-dark">
      <div class="card h-100">
        <img src="<?php echo $URLSitio?>fotos/<?php echo $foto;?>" class="card-img-top" alt="Modelo">
        <div class="card-body p-2">
          <h3 class="card-title mb-1"><?php echo $nombre;?></h3>
          <p class="card-text small text-muted">Escort <?php echo $nombre_provincia;?>  </p>
        </div>
      </div>
    </a>
    </div>


<?php    }
} else {
    echo "Error en la consulta: " . $mysqli->error;
}
?>






    <!-- Card con VIP -->
    <!-- <div class="col">
      <div class="card h-100 position-relative vip-card">
             <img src="http://reinovip.com/fotos/1200_480496.jpg" class="card-img-top" alt="Modelo VIP">
        <div class="card-body p-2">
          <h3 class="card-title mb-1">Nombre VIP</h3>
          <p class="card-text small text-muted">Ciudad, Provincia</p>
        </div>
      </div>
    </div> -->

  

  
             </div>
            
            
                           
                           
                
                </div>
           
            
            
    
                                   
    
  </div>
</div>
                                    </div>
<!-- Footer -->
<?php include ('footer.php') ?>



  