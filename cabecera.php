 <link href="./css/styles.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&amp;display=swap" rel="stylesheet">
<!-- Bootstrap + Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" />
</head>
<body>

<header class="bg-white shadow-sm py-3">
  <div class="container-fluid">
    <div class="row align-items-center">
      
      <!-- LOGO -->
      <div class="col-md-2 d-flex align-items-center">
        <img src="images/logo-reino-vip.png" alt="Logo" class="img-fluid1">
      </div>

      <!-- FILTROS (2 filas) -->
      <div class="col-md-7">
        <!-- Fila 1: Selectores -->
        <div class="row g-2">

          <div class="d-flex justify-content-end align-items-center gap-2 flex-wrap">
            <a class="btn-cuenta">
              <i class="fas fa-user-plus"></i> Crear cuenta
            </a>
            <span><input type="text" name="usuario" class="username form-control c-usuario" placeholder="Correo electronico"></span>
          <span><input type="password" name="contrasena" class="password form-control c-password" placeholder="Contraseña"></span>
          <a class="button-anuncio">
            <i class="fas fa-sign-in-alt"></i> Ingresar
          </a>  
          <a class="btn-ingreso">
               Olvidaste tu contraseña?
            </a>
            <a class="button-anuncio">
              <i class="fas fa-bullhorn"></i> PUBLICAR GRATIS
            </a>
          </div>
          
        </div>
        <!-- Botón de filtros para móvil -->
        <div class="container mt-3 d-md-none text-end">
          <button id="mobile-filters-btn" class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#filtersModal">
            <i class="bi bi-sliders"></i> Filtros
          </button>
        </div>
        <!-- Fila 2: Buscador -->
        <div class="row mt-2 g-2" id="desktop-filters">

          <div class="col-md-3">
            <select class="form-select shadow-sm">
              <option selected>España</option>
              <option>Otro país</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select shadow-sm">
              <option selected>Categoría</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select shadow-sm">
              <option selected>Provincia</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select shadow-sm">
              <option selected>Ciudad</option>
            </select>
          </div>
          <div class="col-md-buscar">
            <a class="button-buscar ">
           <i class="fas fa-search" style="color:#333;"></i> Buscar
              
            </a>
          </div>
         
        </div>
      </div>

      <!-- BOTONES -->
     

    </div>
  </div>

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
          <div class="col-12">
            <select class="form-select rounded-pill">
              <option selected>España</option>
            </select>
          </div>
          <div class="col-12">
            <select class="form-select rounded-pill">
              <option selected>Categoría</option>
            </select>
          </div>
          <div class="col-12">
            <select class="form-select rounded-pill">
              <option selected>Provincia</option>
            </select>
          </div>
          <div class="col-12">
            <select class="form-select rounded-pill">
              <option selected>Ciudad</option>
            </select>
          </div>
          <div class="col-12">
            <input type="text" class="form-control rounded-pill" placeholder="Buscar...">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-gold w-100" data-bs-dismiss="modal"><i class="bi bi-search"></i> Buscar</button>
      </div>
    </div>
  </div>
</div>

</header>


