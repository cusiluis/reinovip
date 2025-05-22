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
  <title><?php echo $TituloSitio; ?></title>
  <meta name="description" content="Guía Erótica de España donde encontraras acompañantes vip, chicas, escorts, travestis, eros,  etc.  Publica tu anuncio GRATIS">
  <meta name="keywords" content="acompañantes vip, chicas, escorts, travestis, eros, gays, chicas en las palmas, transexuales,">

   

<?php 
  include ('cabecera.php');
  
?>

<style>
    .login-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
        max-width: 100%;
        margin-top: 30px;
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
  transform: scale(1.05);
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

                           <h2>CREAR CUENTA COMO: </h2>
 
                        <div class="login-box">

                          <h2 style="margin:0 0 20px 0;">ESCORT INDEPENDIENTE</h2>
                            <br>
                            <ul class="listado">
                                <li style="font-size: .9rem;">Inscripción gratuita</li><br>
                                <li style="font-size: .9rem;">Gestione su perfil</li><br>
                                <li style="font-size: .9rem;">Anuncie sus servicios</li>
                            </ul>
                            <a href="crear_usuario_escort.php">
                              <button type="submit" class="submit-btn">Crear cuenta</button>
                            </a>
                        </div>

                        <div class="login-box" >

                          <h2 style="margin:0 0 20px 0;">AGENCIA</h2>                                

                            <br>
                            <ul class="listado">
                                <li style="font-size: .9rem;">Inscripción gratuita</li><br>
                                <li style="font-size: .9rem;">Gestione su perfil</li><br>
                                <li style="font-size: .9rem;">Añadir escorts</li><br>
                                <li style="font-size: .9rem;">Promocionar su agencia</li>
                            </ul>
                            <a href="crear_usuario_agencia.php">
                                    <button type="submit" class="submit-btn">Crear cuenta</button>
                            </a>
                        </div>
  </div>
 
</div>


<!-- Footer -->
<?php include ('footer.php') ?>