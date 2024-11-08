<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener todas las alertas no resueltas
$sql = "SELECT content, image, date_created FROM alerts WHERE resolved = 0 ORDER BY date_created DESC";
$result = $conn->query($sql);

$alerts = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $alerts[] = $row;
    }
}

echo json_encode($alerts);

$conn->close();
?>
