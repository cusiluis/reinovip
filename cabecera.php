 <link rel="shortcut icon" href="<?php echo $URLSitio?>images/favicon.ico">
 <link href="<?php echo $URLSitio?>css/styles.css?ver=1.9" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
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
        <a href="<?php echo $URLSitio?>"><img src="<?php echo $URLSitio?>images/logo-reino-vip.png" alt="Logo" class="logop img-fluid1"></a>
      </div>

      <!-- FILTROS (2 filas) -->
      <div class="col-md-7">
        <!-- Fila 1: Selectores -->
        <div class="row g-2" style="border-bottom: 1px solid #ccc;padding-bottom: 9px;">

        <?php if(isset($_SESSION['nombre']) and $_SESSION['nombre']!=''):?>

              <div class="d-flex justify-content-end align-items-center gap-2 flex-wrap">
                <a href="<?php echo $URLSitio?>publicaciones.php" class="btn-cuenta">
                  <i class="fas fa-user"></i> <?php print_r($_SESSION['nombre']); ?>
                </a>
          <a href="<?php echo $URLSitio?>salir.php" class="button-ingresar"  name="Search">Salir</a> 
              </div>		
          <?php else:?>
            <div class="d-flex justify-content-end align-items-center gap-2 flex-wrap">
                <a href="<?php echo $URLSitio?>crear_usuario.php" class="btn-cuenta">
                  <i class="fas fa-user-plus"></i> Crear cuenta
                </a>
                <form action="<?php echo $URLSitio?>login_usuario.php" method="POST" style="display: contents;">
                  <span><input type="text" name="usuario" class="username form-control c-usuario" placeholder="Correo electronico" require></span>
                  <span><input type="password" name="contrasenia" class="password form-control c-password" placeholder="Contraseña" require></span>
                  <button class="button-ingresar" type="submit" name="Search">
                    Ingresar
                  </button>  
                  <a href="<?php echo $URLSitio?>recuperar_contrasena.php" class="btn-ingreso">
                      Olvidaste tu contraseña?
                    </a>
                </form>
              </div>
        <?php endif;?>
          
        </div>
        <!-- Botón de filtros para móvil -->
      <div class="container mt-3 d-md-none">
        <div class="d-flex justify-content-between align-items-center">
          <!-- Logo -->
          <a href="<?php echo $URLSitio ?>">
            <img src="<?php echo $URLSitio ?>images/logo-reino-vip.png" alt="Logo Reino VIP" class="img-fluid" style="max-height: 40px;">
          </a>

          <div class="d-flex align-items-center gap-2">
            <!-- Botón Filtros -->
            <button id="mobile-filters-btn" class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#filtersModal">
              <i class="bi bi-sliders"></i> Filtros
            </button>

            <!-- Botón Publicate Gratis -->
            <a href="<?php echo $URLSitio ?>modificar.php" class="btn btn-outline-warning fw-bold btn-publim">
              PUBLICATE&nbsp;GRATIS
            </a>
          </div>
        </div>
      </div>

        <!-- Fila 2: Buscador -->
       <form name="qsearch" id="qsearch" method="GET" action="<?php echo $URLSitio?>index.php">  
        <div class="row mt-2 g-2" id="desktop-filters">
          <div class="col-md-3">
            <select id="selectPais" name="qs_localidad" class="form-select shadow-sm">
              <option value="" selected> País</option>
            </select>
          </div>
          <div class="col-md-3">
            <select id="selectCategoria" name="qs_categoria" class="form-select shadow-sm" disabled>
              <option value="">Seleccione Categoría</option>
            </select>
          </div>
          <div class="col-md-3">
            <select id="selectProvincia" name="qs_provincia" class="form-select shadow-sm" disabled>
              <option value="" selected>Seleccione Provincia</option>
            </select>
          </div>
          <div class="col-md-3">
            <select id="selectCiudad" name="qs_ciudad" class="form-select shadow-sm" disabled>
              <option value="" selected>Seleccione Ciudad</option>
            </select>
          </div>
          <div class="col-md-buscar">
            <!-- <a class="button-buscar">
              <i class="fas fa-search" style="color:#333;"></i> Buscar
            </a> -->
            <button class="button-buscar" type="submit" name="Search"> Buscar</button>

          </div>
          <div class="col-md-buscar">
           <a href="<?php echo $URLSitio?>modificar.php" class="button-anuncio">
              PUBLICATE&nbsp;GRATIS
            </a>
          </div>  
        </div>
      </form> 
      </div>

      <!-- BOTONES -->
     

    </div>
  </div>

  <!-- Modal para filtros móviles -->
<div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="filtersModalLabel" style="color: #793a57 !important;">Filtros de Búsqueda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form class="row g-2" name="qsearchm" id="qsearchm" method="GET" action="<?php echo $URLSitio?>index.php">
          <div class="col-12">
            <select id="selectPaisM" name="qs_localidad" class="form-select shadow-sm">
              <option value="" selected> País</option>
            </select>
          </div>
          <div class="col-12">
            <select id="selectCategoriaM" name="qs_categoria" class="form-select shadow-sm" disabled>
              <option value="">Seleccione Categoría</option>
            </select>
          </div>
          <div class="col-12">
            <select id="selectProvinciaM" name="qs_provincia" class="form-select shadow-sm" disabled>
              <option value="" selected>Seleccione Provincia</option>
            </select>
          </div>
          <div class="col-12">
            <select id="selectCiudadM" name="qs_ciudad" class="form-select shadow-sm" disabled>
              <option value="" selected>Seleccione Ciudad</option>
            </select>
          </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-gold w-100" type="submit" name="Searchm"><i class="bi bi-search"></i> Buscar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const URLSitio = '<?php echo $URLSitio ?>';

  // Obtener parámetros de la URL
  const urlParams = new URLSearchParams(window.location.search);
  //const getLocalidad = urlParams.get('qs_localidad') || '';
  const getLocalidad = 41;
  const getProvincia = urlParams.get('qs_provincia') || '';
  const getCiudad = urlParams.get('qs_ciudad') || '';
  const getCategoria = urlParams.get('qs_categoria') || '';

  // Referencias a los selects de escritorio
  const selectPais = document.getElementById('selectPais');
  const selectProvincia = document.getElementById('selectProvincia');
  const selectCiudad = document.getElementById('selectCiudad');
  const selectCategoria = document.getElementById('selectCategoria');

  // Referencias a los selects de móvil
  const selectPaisM = document.getElementById('selectPaisM');
  const selectProvinciaM = document.getElementById('selectProvinciaM');
  const selectCiudadM = document.getElementById('selectCiudadM');
  const selectCategoriaM = document.getElementById('selectCategoriaM');

  // Función para resetear un select
  function resetSelect(selectElement, placeholder) {
    selectElement.innerHTML = `<option value="">${placeholder}</option>`;
    selectElement.disabled = true;
  }

  // Función para cargar opciones en un select
  function populateSelect(selectElement, data, selectedValue = '') {
    data.forEach(item => {
      const option = document.createElement('option');
      option.value = item.ID;
      option.textContent = item.Nombre;
      if (item.ID == selectedValue) {
        option.selected = true;
      }
      selectElement.appendChild(option);
    });
    selectElement.disabled = false;
  }

  // Función para cargar países
  function loadPaises() {
    fetch(`${URLSitio}includes/get_paises.php`)
      .then(res => res.json())
      .then(data => {
        // Cargar países en ambos selects
        populateSelect(selectPais, data, getLocalidad);
        populateSelect(selectPaisM, data, getLocalidad);

        // Si hay una localidad seleccionada, cargar provincias
        if (getLocalidad) {
          loadProvincias(getLocalidad);
        }
      })
      .catch(error => console.error('Error al cargar los países:', error));
  }

  // Función para cargar provincias
  function loadProvincias(paisID) {
    fetch(`${URLSitio}includes/get_provincias.php?paisID=${paisID}`)
      .then(res => res.json())
      .then(data => {
        // Resetear y cargar provincias en ambos selects
        resetSelect(selectProvincia, 'Seleccione Provincia');
        resetSelect(selectProvinciaM, 'Seleccione Provincia');
        populateSelect(selectProvincia, data, getProvincia);
        populateSelect(selectProvinciaM, data, getProvincia);

        // Si hay una provincia seleccionada, cargar ciudades
        if (getProvincia) {
          loadCiudades(getProvincia);
        }
      })
      .catch(error => console.error('Error al cargar las provincias:', error));
  }

  // Función para cargar ciudades
  function loadCiudades(provinciaID) {
    fetch(`${URLSitio}includes/get_ciudades.php?provinciaID=${provinciaID}`)
      .then(res => res.json())
      .then(data => {
        // Resetear y cargar ciudades en ambos selects
        resetSelect(selectCiudad, 'Seleccione Ciudad');
        resetSelect(selectCiudadM, 'Seleccione Ciudad');
        populateSelect(selectCiudad, data, getCiudad);
        populateSelect(selectCiudadM, data, getCiudad);
      })
      .catch(error => console.error('Error al cargar las ciudades:', error));
  }

  // Función para cargar categorías
  function loadCategorias() {
    fetch(`${URLSitio}includes/get_categorias.php`)
      .then(res => res.json())
      .then(data => {
        // Cargar categorías en ambos selects
        populateSelect(selectCategoria, data, getCategoria);
        populateSelect(selectCategoriaM, data, getCategoria);
      })
      .catch(error => console.error('Error al cargar las categorías:', error));
  }

  // Event listeners para cambios en selects de escritorio
  selectPais.addEventListener('change', () => {
    const paisID = selectPais.value;
    resetSelect(selectProvincia, 'Seleccione Provincia');
    resetSelect(selectCiudad, 'Seleccione Ciudad');
    if (paisID) {
      loadProvincias(paisID);
    }
  });

  selectProvincia.addEventListener('change', () => {
    const provinciaID = selectProvincia.value;
    resetSelect(selectCiudad, 'Seleccione Ciudad');
    if (provinciaID) {
      loadCiudades(provinciaID);
    }
  });

  // Event listeners para cambios en selects de móvil
  selectPaisM.addEventListener('change', () => {
    const paisID = selectPaisM.value;
    resetSelect(selectProvinciaM, 'Seleccione Provincia');
    resetSelect(selectCiudadM, 'Seleccione Ciudad');
    if (paisID) {
      loadProvincias(paisID);
    }
  });

  selectProvinciaM.addEventListener('change', () => {
    const provinciaID = selectProvinciaM.value;
    resetSelect(selectCiudadM, 'Seleccione Ciudad');
    if (provinciaID) {
      loadCiudades(provinciaID);
    }
  });

  // Inicializar carga de datos
  loadPaises();
  loadCategorias();
});
</script>

</header>


