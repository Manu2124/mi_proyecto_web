<?php
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "almacen_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

foreach ($data as $item) {
    $id = (int)$item['id'];
    $cantidadEntra = (int)$item['cantidadEntra'];

    $sql = "UPDATE insumos SET cantidad_entra = $cantidadEntra WHERE id = $id";

    if (!$conn->query($sql)) {
        echo json_encode(['message' => 'Error: ' . $conn->error]);
        exit;
    }
}

echo json_encode(['message' => 'Datos guardados correctamente']);
$conn->close();
?>
