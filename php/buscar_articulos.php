<?php
// Datos de conexión a la base de datos MySQL
$servername = "localhost";
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "users_db"; // Nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el término de búsqueda desde el parámetro GET
$q = $conexion->real_escape_string($_GET['q']);

// Preparar la consulta para buscar los artículos que coincidan con el término
$sql = "SELECT nombre, unidad FROM articulos WHERE nombre LIKE CONCAT('%', ?, '%') LIMIT 10";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $q);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        // Mostrar tanto el nombre como la cantidad de la columna 'unidad'
        // Aseguramos que ambos parámetros estén entre comillas
        echo "<div onclick=\"seleccionarArticulo('" . $fila['nombre'] . "', '" . $fila['unidad'] . "')\">" . $fila['nombre'] . " - Unidad: " . $fila['unidad'] . "</div>";
    }
} else {
    echo "<div onclick=\"seleccionarArticulo('Otro', '0')\">Otro...</div>";
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
