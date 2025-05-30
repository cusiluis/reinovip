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
  require 'includes/scortService.php';
?>

<!-- Cards -->
<div class="container mt-4">

<?php
if (!$_GET['qs_categoria'] == '12') {
  
?>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

<?php } ?>

<?php


$escortService = new EscortService($mysqli);

// Recolectamos filtros del usuario
$filtros = [
    'categoria' => $_GET['qs_categoria'] ?? null,
    'provincia' => $_GET['qs_provincia'] ?? null,
    'ciudad'    => $_GET['qs_ciudad'] ?? null,
    'localidad' => $_GET['qs_localidad'] ?? null,
    'pagina'    => $_GET['pagina'] ?? 1
];

// Detecta si hay filtros activos
$hayFiltros = $filtros['ciudad'] || $filtros['provincia'] || $filtros['localidad'] || $filtros['categoria'];
$hayCategoria = $filtros['categoria'];



if ($hayFiltros) {
    $datos = $escortService->buscarEscorts($filtros);
    $resultados = $datos['resultados'];
    $pagina_actual = $datos['pagina_actual'];
    $total_paginas = $datos['total_paginas'];

  if ($filtros['categoria'] == '12') {
    //print_r($resultados);
        while ($escort = mysqli_fetch_assoc($resultados)) {
        $escortService->renderAgencias($escort, $URLSitio);
    }
  }else{
        while ($escort = mysqli_fetch_assoc($resultados)) {
        $escortService->renderEscort($escort, $URLSitio);
    }
  }



}else {
    $limiteProv = $escortService->getConfiguracion("CANT_PROV_INICIO_LISTA_ESCORTS") ?? 5;
    $limiteEscorts = $escortService->getConfiguracion("CANT_ESCORTS_INICIO") ?? 10;

    $provincias = $escortService->getProvinciasDestacadas($limiteProv);
    while ($provincia = mysqli_fetch_assoc($provincias)) {
        $idProvincia = $provincia['ID'];
        $escorts = $escortService->getEscortsPorProvincia($idProvincia, $filtros['categoria'], $limiteEscorts);
        while ($escort = mysqli_fetch_assoc($escorts)) {
            $escortService->renderEscort($escort, $URLSitio);
        }
    }
}

?>

<?php
if (!$_GET['qs_categoria'] == '12') {
  
?>
  </div>
<?php } ?>

</div>

<?php if ($hayFiltros && $total_paginas > 1): ?>
  <nav aria-label="Paginación de resultados" class="mt-4">
    <ul class="pagination justify-content-center">

      <!-- Botón anterior -->
      <?php if ($pagina_actual > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $pagina_actual - 1])); ?>">Anterior</a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link">Anterior</span>
        </li>
      <?php endif; ?>

      <!-- Números de página -->
      <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <li class="page-item <?php echo ($i == $pagina_actual) ? 'active' : ''; ?>">
          <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $i])); ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php endfor; ?>

      <!-- Botón siguiente -->
      <?php if ($pagina_actual < $total_paginas): ?>
        <li class="page-item">
          <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $pagina_actual + 1])); ?>">Siguiente</a>
        </li>
      <?php else: ?>
        <li class="page-item disabled">
          <span class="page-link">Siguiente</span>
        </li>
      <?php endif; ?>

    </ul>
  </nav>
<?php endif; ?>


<div id="age-verification" >
  <div class="age-verification-main">
    <span class="age-title" style="color:#793a57;text-align:center;">Advertencia de contenido para adultos</span>
    <span class="age-main-text" style="font-size:.8rem;line-height:20px;"> 
    
  <p>
    El sitio web <strong>reinovip.com</strong>, incluidas todas sus páginas, enlaces e imágenes, contiene material sexualmente explícito.
    El acceso está estrictamente reservado a adultos que consientan voluntariamente.
    Si usted es menor de edad (menos de 18 años en jurisdicciones donde esta es la mayoría de edad legal), 
    si este tipo de contenido le resulta ofensivo o si visualizar material sexualmente explícito es ilegal en su comunidad, 
    <strong>debe abandonar este sitio</strong> haciendo clic en "SALIR" a continuación.
  </p>
  <p>
    Al hacer clic en "ENTRAR", usted confirma que ha leído, comprendido y acepta los términos establecidos en este aviso y en la declaración legal al pie de página.
  </p>

  <h3 style="color:#793a57;">Política de uso responsable</h3>
  <p>
    <strong>Reino Vip</strong> mantiene una política de <strong>tolerancia cero</strong> hacia la pornografía infantil, 
    la representación de menores de edad, así como la promoción o utilización del sitio con fines ilegales.
    Usted se compromete a <strong>reportar inmediatamente</strong> cualquier contenido, actividad o servicio que infrinja nuestras Condiciones de Uso,
    incluyendo sospechas de explotación infantil o trata de personas, a las autoridades competentes.
  </p>

  <h3 style="color:#793a57;">Al ingresar a reinovip.com usted declara y acepta que:</h3>
  <ul class="lista-condicion">
    <li>Es mayor de edad según las leyes de su país o jurisdicción (al menos 18 años).</li>
    <li>Ha leído y acepta los <strong>Términos y Condiciones</strong> del sitio.</li>
    <li>El contenido sexualmente explícito <strong>no es considerado obsceno ni ilegal</strong> en su comunidad.</li>
    <li>Usted asume <strong>total responsabilidad</strong> por sus acciones y decisiones al acceder al sitio.</li>
    <li>Acepta el uso de <strong>cookies</strong> para mejorar su experiencia de navegación.</li>
  </ul>

  <p>
    Al acceder a este sitio, usted confirma que ha leído este acuerdo, lo comprende y acepta cumplirlo.
  </p>

                                    </span>
                                    <span class="age-main-text" style="text-align:center;">
    <button class="age-button age-yes" onclick="ageVerificationConfirm()">Entrar</button>
    <button class="age-button age-no" onclick="ageVerificationFailed()">Salir</button>
     <span class="age-main-text" style="font-size:.9rem">
                                    </span>
    
    
  </div>
</div>

<script>                 
var ageCookieName = "age-verification-verified-43212342";

function ageSetCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function ageGetCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function ageVerificationHide() {
  var ageVerificationModel = document.getElementById('age-verification');
  ageVerificationModel.style.display = 'none';
}
function ageVerificationShow() {
  var ageVerificationModel = document.getElementById('age-verification');
  ageVerificationModel.style.display = 'block';
}

function ageVerificationLoad() {
    try {
      var agePass = ageGetCookie(ageCookieName);
      if (agePass != "") {
        ageVerificationHide();
        return;
      }
      else {
        ageVerificationShow();
      }
    }
    catch(err) {
      ageVerificationShow();
    }
}

function ageVerificationConfirm() {
  ageSetCookie(ageCookieName, "verified", 365);
  ageVerificationHide();
}

function ageVerificationFailed() {
    window.history.back();
}

/** Run the verification after DOM has been loaded **/
document.addEventListener("DOMContentLoaded", function(event) {
  ageVerificationLoad();
});
                
</script>

<style>
.pagination {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 6px;
  padding-top: 20px;
}

.pagination .page-item {
  list-style: none;
}

.pagination .page-link {
  color: #a66396;
  background-color: #fff;
  border: 1px solid #a66396;
  border-radius: 20px;
  padding: 6px 14px;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
}

.pagination .page-link:hover {
  background-color: #a66396;
  color: #fff;
}

.pagination .page-item.active .page-link {
  background-color: #a66396;
  color: #fff;
  border-color: #a66396;
  font-weight: bold;
}

.pagination .page-item.disabled .page-link {
  background-color: #eee;
  color: #999;
  border-color: #ccc;
  cursor: not-allowed;
}



#age-verification {
  position: absolute;
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
    top: 1%;
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
</style>

<!-- Footer -->
<?php include ('footer.php') ?>

