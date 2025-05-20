<?php
include ('globales.inc.php');
include ('conexion.inc.php');

$provinciaID = isset($_GET['provinciaID']) ? intval($_GET['provinciaID']) : 0;

$query = "SELECT DISTINCT c.ID, c.Nombre
          FROM reino01_Ciudad c
          INNER JOIN reino01_Escort e ON e.CiudadID = c.ID
          WHERE c.ProvinciaID = $provinciaID AND c.Publico = 1 AND e.Publico = 1
          ORDER BY c.Nombre";

$result = $mysqli->query($query);

$ciudades = [];
while ($row = $result->fetch_assoc()) {
    $ciudades[] = $row;
}

header('Content-Type: application/json');
echo json_encode($ciudades);
?>
