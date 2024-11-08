<?php
// config.php

$host = 'localhost';
$dbname = 'users_db';
$username = 'root';
$password = ''; // Por defecto en XAMPP la contraseña está vacía

try {
    $pdo = new PDO(dsn: "mysql:host=$host;dbname=$dbname;charset=utf8", username: $username, password: $password);
    $pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
