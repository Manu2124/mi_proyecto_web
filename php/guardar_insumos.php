<?php
require 'conectar.php';

$data = json_decode(file_get_contents('php://input'), true);

foreach ($data as $insumo) {
    $id = $insumo['id'];
    $cantidad_entra = $insumo['cantidad_entra'];

    $sql = "UPDATE solicitudes SET cantidad_entra = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $cantidad_entra, $id);
    $stmt->execute();
}

echo "Datos guardados correctamente";
?>
