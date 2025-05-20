<?php
header('Content-Type: application/json');
include ('globales.inc.php');
include ('conexion.inc.php');

$sql = "SELECT ID, Nombre FROM reino01_Categoria WHERE Publico = 1 ORDER BY Nombre";
$result = $mysqli->query($sql);

$categorias = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = [
            'ID' => $row['ID'],
            'Nombre' => $row['Nombre']
        ];
    }
}

echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
?>