<?php
session_start();

// Verificar que el usuario ha iniciado sesión y tiene rol de administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Acceso denegado. Solo los administradores pueden ver esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="icon" href="/mis_proyectos/img/icon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/mis_proyectos/img/SANJOSE.gif'); /* Fondo de pantalla */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
        }

        .panel {
            background-color: rgba(255, 255, 255, 0.85); /* Fondo semitransparente */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #333;
        }

        .boton {
            padding: 15px 25px;
            font-size: 16px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

        .boton:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="panel">
        <h1>Bienvenido, Administrador</h1>
        <p>Este es tu panel de administración.</p>
        <p>Aquí puedes gestionar las configuraciones del sistema.</p>

        <!-- Botón que redirige a otra página HTML -->
        <form action="/mis_proyectos/menu.html" method="get">
            <button type="submit" class="boton">Ir al sistema</button>
        </form>
    </div>

</body>
</html>
