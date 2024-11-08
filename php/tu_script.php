<?php
// Incluir el archivo de conexión a la base de datos
include 'conectar.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario principal
    $nombre = $_POST['nombre'] ?? '';
    $servicio = $_POST['servicio'] ?? '';
    $pedido = $_POST['pedido'] ?? '';

    // Decodificar la lista de artículos enviada como JSON
    $listaDeArticulos = json_decode($_POST['listaDeArticulos'], true);

    // Verificar que la lista no esté vacía
    if (!empty($listaDeArticulos)) {
        // Preparar la consulta para insertar los datos en la base de datos
        $consulta = $conexion->prepare("INSERT INTO solicitudes (nombre, servicio, tipo_pedido, articulo, unidad, cantidad, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($listaDeArticulos as $articuloData) {
            // Extraer los datos del artículo individual
            $articulo = $articuloData['articulo'];
            $unidad = $articuloData['unidad'];
            $cantidad = $articuloData['cantidad'];
            $observaciones = $articuloData['observaciones'];

            // Vincular los parámetros para cada artículo
            $consulta->bind_param("sssssis", $nombre, $servicio, $pedido, $articulo, $unidad, $cantidad, $observaciones);

            // Ejecutar la consulta
            if (!$consulta->execute()) {
                echo "Error al guardar el artículo $articulo: " . $consulta->error;
                exit; // Salir si ocurre un error para no continuar insertando
            }
        }

        echo "Solicitud enviada con éxito.";
    } else {
        echo "La lista de artículos está vacía.";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
