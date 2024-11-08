<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto según tu configuración de XAMPP
$dbname = "users_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_FILES['file']['name'])) {
    $fileName = $_FILES['file']['tmp_name'];

    // Abrir el archivo CSV
    if (($handle = fopen($fileName, "r")) !== FALSE) {
        // Leer cada línea del CSV
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Insertar los datos en la tabla 'artículos'
            $sql = "INSERT INTO articulos (
                Consecutivo, Comprobante, Tipo_Comprobante, Tercero, Fecha_Recepcion,
                Fecha_Inspeccion, Factura_o_Remision, Fecha_Factura_o_Remision, Codigo_Interno, Cod_Cum, 
                Cod_ATC, nombre, Nombre_Generico, Forma_Farmaceutica, No_Lote, Fecha_de_Vencimiento,
                unidad, Reg_Sanitario_Invima, Expediente_Reg_Sanitario_Invima, Vigencia_Reg_Sanitario_Invima,
                Fecha_Vigencia_Reg_Sanitario_Invima, Laboratorio, Cantidad_Recepcionada, Observaciones, Usuario
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "issssssssssssssssssssisss",
                $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7],
                $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], 
                $data[15], $data[16], $data[17], $data[18], $data[19], $data[20], $data[21],
                $data[22], $data[23], $data[24]
            );
            $stmt->execute();
        }
        fclose($handle);
        echo "Inventario cargado correctamente";
    } else {
        echo "Error al abrir el archivo";
    }
} else {
    echo "No se ha seleccionado un archivo";
}

$conn->close();
?>
