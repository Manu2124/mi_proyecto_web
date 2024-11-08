<?php
// Conexión a la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "users_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de la tabla 'solicitudes'
$sql = "SELECT nombre_solicitante, servicio, articulo, unidad, cantidad_solicitada, observaciones, cantidad_entra FROM solicitudes";
$result = $conn->query($sql);

// Array para enviar los datos al frontend
$solicitudes = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $solicitudes[] = $row;
    }
}

// Retorna los datos en formato JSON para ser utilizados en el frontend
echo json_encode($solicitudes);

$conn->close();
?>
