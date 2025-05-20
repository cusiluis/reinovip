<?php
// Conexión a BD

include ('globales.inc.php');
include ('conexion.inc.php');

$query = "SELECT DISTINCT p.ID, p.Nombre
          FROM reino01_Pais p
          JOIN reino01_Escort e ON e.PaisID = p.ID
          WHERE p.Publico = 1 AND e.Publico = 1
          ORDER BY p.Nombre";

$result = $mysqli->query($query);

$paises = [];
while ($row = $result->fetch_assoc()) {
    $paises[] = $row;
}

header('Content-Type: application/json');
echo json_encode($paises);

?>
