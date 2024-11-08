<?php
// Habilita la visualización de errores en formato de texto plano
error_reporting(error_level: E_ALL);
ini_set(option: 'display_errors', value: 1);
header(header: 'Content-Type: application/json');  // Asegura que la salida sea JSON

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "almacen_db";

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

// Verifica la conexión y maneja cualquier error
if ($conn->connect_error) {
    // En caso de error, detiene el proceso y devuelve un error en JSON
    echo json_encode(value: ["error" => "Error de conexión: " . $conn->connect_error]);
    exit();
}

// Consulta SQL para obtener los datos con el estado calculado
$sql = "SELECT id, nombre, cantidad, 
               CASE 
                   WHEN cantidad IS NULL OR cantidad = 0 THEN 'No aprobado' 
                   ELSE 'Aprobado' 
               END AS estado 
        FROM insumos";
$result = $conn->query($sql);

// Verifica si la consulta fue exitosa y si hay datos
$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(value: $data);  // Envía la respuesta en formato JSON
} else {
    // En caso de error en la consulta, envía un mensaje en JSON
    echo json_encode(value: ["error" => "Error en la consulta: " . $conn->error]);
}

// Cierra la conexión después de completar la consulta
$conn->close();
?>
