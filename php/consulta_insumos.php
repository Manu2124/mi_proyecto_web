<?php
require 'conectar.php'; // Asegúrate de tener el archivo de conexión a la base de datos

$sql = "SELECT id, nombre_solicitante, servicio, articulo, unidad, cantidad_solicitada, observaciones, cantidad_entra FROM solicitudes";
$result = $conn->query($sql);

$insumos = array();
while ($row = $result->fetch_assoc()) {
    $insumos[] = $row;
}

echo json_encode($insumos);
?>
