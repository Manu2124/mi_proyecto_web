<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia según tu configuración
$username = "root"; // Cambia según tu configuración
$password = ""; // Cambia según tu configuración
$dbname = "almacen_db"; // Cambia según tu configuración

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta a la base de datos
$sql = "SELECT nombre_solicitante, servicio, articulo, unidad, cantidad_solicitada, observaciones, cantidad_entra FROM insumos";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Devuelve los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
