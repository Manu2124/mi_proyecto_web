<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
