<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reino VIP</title>
   

<?php include ('cabecera.php') ?>

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
<!-- Cards -->
<div class="container mt-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

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
        <span class="vip-ribbon">VIP</span>
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
        <span class="vip-ribbon">VIP</span>
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

 <!-- Card con VIP -->
 <div class="col">
  <div class="card h-100 position-relative vip-card">
    <span class="vip-ribbon">VIP</span>
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

 <!-- Card con VIP -->
 <div class="col">
  <div class="card h-100 position-relative vip-card">
    <span class="vip-ribbon">VIP</span>
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
    <!-- Más cards aquí... -->

  </div>
</div>

<!-- Footer -->
<?php include ('footer.php') ?>

