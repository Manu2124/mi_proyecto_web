<?php
header('Content-Type: application/json');

$conexion = new mysqli('localhost', 'root', '', 'users_db');
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT nombre, servicio, articulo, unidad, cantidad, observaciones FROM solicitudes";
$resultado = $conexion->query($sql);

$data = [];
while ($fila = $resultado->fetch_assoc()) {
    $data[] = $fila;
}

echo json_encode($data);
$conexion->close();
?>
