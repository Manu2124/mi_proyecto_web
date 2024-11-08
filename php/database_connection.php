<?php
// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Conexión a MySQL
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
