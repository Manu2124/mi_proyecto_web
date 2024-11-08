<?php
session_start();

// Verificar que el usuario ha iniciado sesión y tiene rol de usuario regular
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    echo "Acceso denegado. Solo los usuarios regulares pueden ver esta página.";
    exit();
}

// Contenido del dashboard del usuario regular
echo "<h1>Bienvenido, Usuario</h1>";
echo "<p>Este es tu panel de usuario.</p>";


// Aquí puedes agregar contenido específico para usuarios regulares...
?>
