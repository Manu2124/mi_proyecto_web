<?php
header('Content-Type: application/json');

// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'almacen_db');

// Verificar la conexión
if ($conexion->connect_error) {
    echo json_encode(['error' => 'Error de conexión a la base de datos: ' . $conexion->connect_error]);
    exit;
}

// Decodificar los datos JSON recibidos
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se reciban datos válidos
if (!is_array($data) || empty($data)) {
    echo json_encode(['error' => 'No se recibieron datos válidos para insertar.']);
    exit;
}

// Preparar la consulta SQL para insertar los datos
$stmt = $conexion->prepare("INSERT INTO insumos (nombre_solicitante, servicio, articulo, unidad, cantidad_solicitada, observaciones, cantidad_entra) VALUES (?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(['error' => 'Error al preparar la consulta: ' . $conexion->error]);
    exit;
}

// Variables para contar inserciones y errores
$filasInsertadas = 0;
$errores = [];

// Recorrer cada entrada de datos y ejecutar la consulta
foreach ($data as $entrada) {
    $cantidad_entra = $entrada['cantidad_entra'];

    // Verificar que la cantidad_entra no esté vacía
    if (!empty($cantidad_entra)) {
        $nombre_solicitante = $entrada['nombre_solicitante'];
        $servicio = $entrada['servicio'];
        $articulo = $entrada['articulo'];
        $unidad = $entrada['unidad'];
        $cantidad_solicitada = $entrada['cantidad_solicitada'];
        $observaciones = $entrada['observaciones'];

        // Asociar parámetros y ejecutar la consulta para cada entrada
        $stmt->bind_param('ssssssi', $nombre_solicitante, $servicio, $articulo, $unidad, $cantidad_solicitada, $observaciones, $cantidad_entra);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $filasInsertadas++;
            }
        } else {
            // Guardar errores específicos de cada registro
            $errores[] = "Error al insertar: " . $stmt->error;
        }
    }
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();

// Respuesta final con el estado de las inserciones
if ($filasInsertadas > 0) {
    echo json_encode([
        'mensaje' => 'Datos guardados correctamente',
        'filas_insertadas' => $filasInsertadas,
        'errores' => $errores
    ]);
} else {
    echo json_encode([
        'advertencia' => 'No se insertaron filas. Verifica los datos enviados.',
        'errores' => $errores
    ]);
}
?>
