<?php
include ('globales.inc.php');
include ('conexion.inc.php');

$paisID = isset($_GET['paisID']) ? intval($_GET['paisID']) : 0;

$query = "SELECT DISTINCT pr.ID, pr.Nombre
          FROM reino01_Provincia pr
          JOIN reino01_Escort e ON e.ProvinciaID = pr.ID AND pr.PaisID = e.PaisID
          WHERE pr.Publico = 1 AND e.Publico = 1 AND pr.PaisID = $paisID
          ORDER BY pr.Nombre";

$result = $mysqli->query($query);

$provincias = [];
while ($row = $result->fetch_assoc()) {
    $provincias[] = $row;
}

header('Content-Type: application/json');
echo json_encode($provincias);
?>
