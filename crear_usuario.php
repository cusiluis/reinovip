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
  .content-container-crear {
  max-width: 500px;
  margin: 0 auto;
  padding: 0 36px;
  margin-top: 2em;
  }
 .content-container-crear h1{
      color: #793a57;
      font-size: 1.5rem;
      text-align: center;
    }
.content-container-crear h2{
    color: #793a57;
  font-size: 1.1rem;
  margin-bottom: 20px;
    }
    p {
      color: #333;
      line-height: 1.6;
      margin-top: 1em;
      text-align: justify;
    }
    .content-container-crear ul.listado li{
      font-size: 0.9rem;
    list-style-type: square !important;
  display: list-item;
  border: none;
  padding: 0;
  margin: 10px 18px;
    }

    @media (max-width: 600px) {
      .content-container-crear {
        padding: 0;
      }
    }

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
<div class="container">
   <div class="content-container-crear">

                           <h1>CREAR CUENTA COMO: </h1>
 
                        <div class="login-box">

                          <h2>ESCORT INDEPENDIENTE</h2>
                            <ul class="listado">
                                <li>Inscripción gratuita</li>
                                <li>Gestione su perfil</li>
                                <li>Anuncie sus servicios</li>
                            </ul>
                            <a href="crear_usuario_escort.php">
                              <button type="submit" class="submit-btn">Crear cuenta</button>
                            </a>
                        </div>

                        <div class="login-box" >

                          <h2>AGENCIA</h2>                                
                            <ul class="listado">
                                <li>Inscripción gratuita</li>
                                <li>Gestione su perfil</li>
                                <li>Añadir escorts</li>
                                <li>Promocionar su agencia</li>
                            </ul>
                            <a href="crear_usuario_agencia.php">
                                    <button type="submit" class="submit-btn">Crear cuenta</button>
                            </a>
                        </div>
  </div>
 
</div>


<!-- Footer -->
<?php include ('footer.php') ?>