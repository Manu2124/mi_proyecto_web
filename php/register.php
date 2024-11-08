<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto según tu configuración
$username_db = "root"; // Tu usuario de la base de datos
$password_db = ""; // Tu contraseña de la base de datos
$dbname = "user_db"; // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (!empty($username) && !empty($password)) {
        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar el nuevo usuario
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        // Preparar la sentencia
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("ss", $username, $hashed_password);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Registro exitoso";
                // Redireccionar al inicio de sesión o a otra página
                header("Location: index.html");
                exit();
            } else {
                echo "Error en el registro: " . $stmt->error;
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }
    } else {
        echo "Por favor, completa todos los campos";
    }
}

// Cerrar la conexión
$conn->close();
?>
