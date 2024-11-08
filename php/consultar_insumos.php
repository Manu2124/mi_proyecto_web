<?php
$conn = new mysqli("localhost", "root", "", "users_db");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$sql = "SELECT id, nombre, servicio, articulo, unidad, cantidad, observaciones FROM solicitudes";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$conn->close();
?>
