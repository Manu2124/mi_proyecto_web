<?php
session_start();
include 'database_connection.php';  // Archivo donde tienes la conexión a MySQL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario en la base de datos
    $stmt = $pdo->prepare(query: "SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(param: ':username', var: $username);
    $stmt->execute();
    $user = $stmt->fetch(mode: PDO::FETCH_ASSOC);

    if ($user && password_verify(password: $password, hash: $user['password'])) {
        // Si la contraseña es correcta, iniciamos sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];  // Esto nos permite conocer el rol

        // Redireccionamos según el rol del usuario
        if ($user['role'] === 'admin') {
            header(header: "Location: admin_dashboard.php");
        } else {
            header(header: "Location: user_dashboard.php");
        }
        exit();
    } else {
        // Si las credenciales son incorrectas, mostramos un error
        echo "<p>Nombre de usuario o contraseña incorrectos</p>";
    }
}
?>
