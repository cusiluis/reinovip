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
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

<?php


$escortService = new EscortService($mysqli);

// Recolectamos filtros del usuario
$filtros = [
    'localidad' => $_GET['qs_localidad'] ?? null,
    'ciudad' => $_GET['qs_ciudad'] ?? null,
    'provincia' => $_GET['qs_provincia'] ?? null,
    'categoria' => $_GET['qs_categoria'] ?? null,
    'pagina' => $_GET['pagina'] ?? 1
];

// Si hay filtros, buscar escorts con filtros
if ($filtros['ciudad'] || $filtros['provincia'] || $filtros['localidad'] || $filtros['categoria']) {
    $resultados = $escortService->buscarEscorts($filtros);
    while ($escort = mysqli_fetch_assoc($resultados)) {
        $escortService->renderEscort($escort, $URLSitio);
    }
} else {
    // Si no hay filtros, mostrar provincias destacadas
    $limiteProv = $escortService->getConfiguracion("CANT_PROV_INICIO_LISTA_ESCORTS") ?? 5;
    $limiteEscorts = $escortService->getConfiguracion("CANT_ESCORTS_INICIO") ?? 10;

    $provincias = $escortService->getProvinciasDestacadas($limiteProv);
    while ($provincia = mysqli_fetch_assoc($provincias)) {
        $idProvincia = $provincia['ID'];
        $resultados = $escortService->getEscortsPorProvincia($idProvincia, $filtros['categoria'], $limiteEscorts);
        while ($escort = mysqli_fetch_assoc($resultados)) {
            $escortService->renderEscort($escort, $URLSitio);
        }
    }
}
?>

  </div>
</div>

<!-- Footer -->
<?php include ('footer.php') ?>

