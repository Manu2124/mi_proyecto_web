<?php
// Datos de conexión a la base de datos MySQL
$servername = "localhost"; // Cambia esto si tu servidor MySQL está en otra dirección
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "users_db"; // Nombre de tu base de datos

// Crear conexión
$conexion = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Si deseas usar esta conexión en otros archivos, puedes incluir este archivo así:
// include 'conectar.php';
?>
