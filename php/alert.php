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

// Procesar el formulario al recibir una alerta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $user_id = 1; // Aquí asumo que el `user_id` es 1, pero puedes obtenerlo dinámicamente según tu lógica.
    $resolved = 0; // Las alertas se crean como no resueltas por defecto.

    // Si se sube una imagen, guardarla
    if ($image) {
        $imagePath = 'uploads/' . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = null; // Si no hay imagen
    }

    // Insertar alerta en la base de datos
    $stmt = $conn->prepare("INSERT INTO alerts (user_id, content, image, date_created, resolved) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->bind_param("isss", $user_id, $content, $imagePath, $resolved);
    $stmt->execute();
    $stmt->close();

    // Redireccionar de vuelta a la página principal después de enviar la alerta
    header("Location: /");
}

$conn->close();
?>
