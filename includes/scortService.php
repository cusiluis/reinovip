<?php
class EscortService {
    private $mysqli;
    private $prefijo;
    private $registrosPorPagina = 50;

    public function __construct($mysqli, $prefijo = "reino01_") {
        $this->mysqli = $mysqli;
        $this->prefijo = $prefijo;
    }

    public function buscarEscorts($filtros) {
        $queryFiltros = $this->construirQueryFiltros($filtros);

        if (isset($filtros['categoria']) && $filtros['categoria'] == 4) {
            return [
                'resultados' => $this->mysqli->query("SELECT * FROM agencias"),
                'pagina_actual' => 1,
                'total_paginas' => 1
            ];
        }

        $pagina = isset($filtros['pagina']) ? (int)$filtros['pagina'] : 1;
        $inicio = ($pagina - 1) * $this->registrosPorPagina;

        $totalSql = "SELECT COUNT(DISTINCT e.ID) as total
                    FROM {$this->prefijo}Escort e
                    JOIN {$this->prefijo}foto_escort fe ON e.ID = fe.IdEscort
                    JOIN {$this->prefijo}Ciudad c ON e.CiudadID = c.ID
                    JOIN {$this->prefijo}Provincia p ON e.ProvinciaID = p.ID
                    JOIN {$this->prefijo}Pais pa ON e.PaisID = pa.ID
                    WHERE fe.Principal = 1 AND e.Publico = 1 $queryFiltros";

        $totalRes = $this->mysqli->query($totalSql);
        $totalRow = mysqli_fetch_assoc($totalRes);
        $totalPaginas = ceil($totalRow['total'] / $this->registrosPorPagina);

        $sql = "SELECT DISTINCT fe.Imagen, e.ID, e.Nombre, e.CategoriaID, 
                        p.Nombre as nombre_provincia, c.Nombre AS ciudadNombre, pa.Nombre as nombre_pais
                FROM {$this->prefijo}Escort e
                JOIN {$this->prefijo}foto_escort fe ON e.ID = fe.IdEscort
                JOIN {$this->prefijo}Ciudad c ON e.CiudadID = c.ID
                JOIN {$this->prefijo}Provincia p ON e.ProvinciaID = p.ID
                JOIN {$this->prefijo}Pais pa ON e.PaisID = pa.ID
                WHERE fe.Principal = 1 AND e.Publico = 1 $queryFiltros
                LIMIT $inicio, {$this->registrosPorPagina}";

        return [
            'resultados' => $this->mysqli->query($sql),
            'pagina_actual' => $pagina,
            'total_paginas' => $totalPaginas
        ];
    }

    private function construirQueryFiltros($filtros) {
        $where = '';

        if (!empty($filtros['localidad'])) {
            $where .= ' AND pa.ID = ' . intval($filtros['localidad']);
        }
        if (!empty($filtros['provincia'])) {
            $where .= ' AND p.ID = ' . intval($filtros['provincia']);
        }
        if (!empty($filtros['ciudad'])) {
            $where .= ' AND c.ID = ' . intval($filtros['ciudad']);
        }
        if (!empty($filtros['categoria'])) {
            $where .= ' AND e.CategoriaID = ' . intval($filtros['categoria']);
        }

        return $where;
    }

    public function getConfiguracion($nombre) {
        $sql = "SELECT valor FROM {$this->prefijo}configuraciones WHERE Nombre = '$nombre' AND Publico='1'";
        $res = $this->mysqli->query($sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            return $row['valor'];
        }
        return null;
    }

    public function getProvinciasDestacadas($limite = 10) {
        $sql = "SELECT * FROM {$this->prefijo}Provincia WHERE Publico='1' AND enInicioEscorts='1' ORDER BY RAND() LIMIT $limite";
        return $this->mysqli->query($sql);
    }

    public function getEscortsPorProvincia($provinciaId, $categoriaId = null, $limite = 10) {
        $filtros = "AND p.ID = $provinciaId";
        if ($categoriaId !== null) {
            $filtros .= " AND e.CategoriaID = " . intval($categoriaId);
        }

        $sql = "SELECT DISTINCT fe.Imagen, e.ID, e.Nombre, e.CategoriaID, 
                        p.Nombre as nombre_provincia, c.Nombre AS ciudadNombre
                FROM {$this->prefijo}Escort e
                JOIN {$this->prefijo}foto_escort fe ON e.ID = fe.IdEscort
                JOIN {$this->prefijo}Ciudad c ON e.CiudadID = c.ID
                JOIN {$this->prefijo}Provincia p ON e.ProvinciaID = p.ID
                WHERE fe.Principal = 1 AND e.Publico = 1 $filtros
                LIMIT $limite";

        return $this->mysqli->query($sql);
    }

    public function renderEscort($escort, $URLSitio) {
        // Escapar datos
        $nombre = htmlspecialchars($escort['Nombre'], ENT_QUOTES);
        $ciudad = htmlspecialchars($escort['ciudadNombre'], ENT_QUOTES);
        $provincia = htmlspecialchars($escort['nombre_provincia'], ENT_QUOTES);
        $pais = htmlspecialchars($escort['nombre_pais'], ENT_QUOTES);
        $foto = "http://reinovip.com/fotos/" . $escort['Imagen'];

        // URLs amigables
        $url_ciudad = urls_amigables($escort['ciudadNombre']);
        $url_nombre = urls_amigables($escort['Nombre']);
        $id = $escort['ID'];

        // Construcción de enlace
        $href = "{$URLSitio}escort/{$url_ciudad}/{$id}/{$url_nombre}.php";

        echo <<<HTML
        <div class="col">
        <a href="$href" class="text-decoration-none text-dark">
            <div class="card h-100">
            <img src="$foto" class="card-img-top" alt="Modelo">
            <div class="card-body p-2">
                <h3 class="card-title mb-1">$nombre</h3>
                <p class="card-text small text-muted">Escort $provincia $ciudad</p>
            </div>
            </div>
        </a>
        </div>
        HTML;
    }
}
?>
