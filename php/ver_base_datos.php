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


// Obtener los valores únicos de cada columna para los desplegables
function obtenerValoresUnicos($columna, $conn) {
    $valoresUnicos = [];
    $sql = "SELECT DISTINCT $columna FROM articulos";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $valoresUnicos[] = $row[$columna];
        }
    }
    return $valoresUnicos;
}

// Obtener los valores únicos para cada columna
$valoresID = obtenerValoresUnicos('ID', $conn);
$valoresConsecutivo = obtenerValoresUnicos('Consecutivo', $conn);
$valoresComprobante = obtenerValoresUnicos('Comprobante', $conn);
$valoresTipoComprobante = obtenerValoresUnicos('Tipo_Comprobante', $conn);
$valoresTercero = obtenerValoresUnicos('Tercero', $conn);
$valoresFecha_Recepcion = obtenerValoresUnicos('Fecha_Recepcion', $conn);
$valoresFecha_Inspeccion = obtenerValoresUnicos('Fecha_Inspeccion', $conn);
$valoresFactura_o_Remision = obtenerValoresUnicos('Factura_o_Remision', $conn);
$valoresFecha_Factura_o_Remision = obtenerValoresUnicos('Fecha_Factura_o_Remision', $conn);
$valoresCodigo_Interno = obtenerValoresUnicos('Codigo_Interno', $conn);
$valoresCod_Cum = obtenerValoresUnicos('Cod_Cum', $conn);
$valoresCod_ATC = obtenerValoresUnicos('Cod_ATC', $conn);
$valoresnombre = obtenerValoresUnicos('nombre', $conn);
$valoresNombre_Generico = obtenerValoresUnicos('Nombre_Generico', $conn);
$valoresForma_Farmaceutica = obtenerValoresUnicos('Forma_Farmaceutica', $conn);
$valoresNo_Lote = obtenerValoresUnicos('No_Lote', $conn);
$valoresFecha_de_Vencimiento = obtenerValoresUnicos('Fecha_de_Vencimiento', $conn);
$valoresunidad = obtenerValoresUnicos('unidad', $conn);
$valoresReg_Sanitario_Invima = obtenerValoresUnicos('Reg_Sanitario_Invima', $conn);
$valoresExpediente_Reg_Sanitario_Invima = obtenerValoresUnicos('Expediente_Reg_Sanitario_Invima', $conn);
$valoresVigencia_Reg_Sanitario_Invima = obtenerValoresUnicos('Vigencia_Reg_Sanitario_Invima', $conn);
$valoresFecha_Vigencia_Reg_Sanitario_Invima = obtenerValoresUnicos('Fecha_Vigencia_Reg_Sanitario_Invima', $conn);
$valoresLaboratorio = obtenerValoresUnicos('Laboratorio', $conn);
$valoresCantidad_Recepcionada = obtenerValoresUnicos('Cantidad_Recepcionada', $conn);
$valoresObservaciones = obtenerValoresUnicos('Observaciones', $conn);
$valoresUsuario = obtenerValoresUnicos('Usuario', $conn);

// ... Repite para todas las columnas que quieras filtrar

// Procesar la búsqueda basada en los filtros seleccionados
$where = [];
if (isset($_POST['ID']) && $_POST['ID'] != "") {
    $where[] = "ID = '" . $conn->real_escape_string($_POST['ID']) . "'";
}
if (isset($_POST['Consecutivo']) && $_POST['Consecutivo'] != "") {
    $where[] = "Consecutivo = '" . $conn->real_escape_string($_POST['Consecutivo']) . "'";
}
if (isset($_POST['Comprobante']) && $_POST['Comprobante'] != "") {
    $where[] = "Comprobante = '" . $conn->real_escape_string($_POST['Comprobante']) . "'";
}
if (isset($_POST['Tipo_Comprobante']) && $_POST['Tipo_Comprobante'] != "") {
    $where[] = "Tipo_Comprobante = '" . $conn->real_escape_string($_POST['Tipo_Comprobante']) . "'";
}
if (isset($_POST['Tercero']) && $_POST['Tercero'] != "") {
    $where[] = "Tercero = '" . $conn->real_escape_string($_POST['Tercero']) . "'";
}
if (isset($_POST['Fecha_Recepcion']) && $_POST['Fecha_Recepcion'] != "") {
    $where[] = "Fecha_Recepcion = '" . $conn->real_escape_string($_POST['Fecha_Recepcion']) . "'";
}
if (isset($_POST['Fecha_Inspeccion']) && $_POST['Fecha_Inspeccion'] != "") {
    $where[] = "Fecha_Inspeccion = '" . $conn->real_escape_string($_POST['Fecha_Inspeccion']) . "'";
}
if (isset($_POST['Factura_o_Remision']) && $_POST['Factura_o_Remision'] != "") {
    $where[] = "Factura_o_Remision = '" . $conn->real_escape_string($_POST['Factura_o_Remision']) . "'";
}
if (isset($_POST['Fecha_Factura_o_Remision']) && $_POST['Fecha_Factura_o_Remision'] != "") {
    $where[] = "Fecha_Factura_o_Remision = '" . $conn->real_escape_string($_POST['Fecha_Factura_o_Remision']) . "'";
}
if (isset($_POST['Codigo_Interno']) && $_POST['Codigo_Interno'] != "") {
    $where[] = "Codigo_Interno = '" . $conn->real_escape_string($_POST['Codigo_Interno']) . "'";
}
if (isset($_POST['Cod_Cum']) && $_POST['Cod_Cum'] != "") {
    $where[] = "Cod_Cum = '" . $conn->real_escape_string($_POST['Cod_Cum']) . "'";
}
if (isset($_POST['Cod_ATC']) && $_POST['Cod_ATC'] != "") {
    $where[] = "Cod_ATC = '" . $conn->real_escape_string($_POST['Cod_ATC']) . "'";
}
if (isset($_POST['nombre']) && $_POST['nombre'] != "") {
    $where[] = "nombre = '" . $conn->real_escape_string($_POST['nombre']) . "'";
}
if (isset($_POST['Nombre_Generico']) && $_POST['Nombre_Generico'] != "") {
    $where[] = "Nombre_Generico = '" . $conn->real_escape_string($_POST['Nombre_Generico']) . "'";
}
if (isset($_POST['Forma_Farmaceutica']) && $_POST['Forma_Farmaceutica'] != "") {
    $where[] = "Forma_Farmaceutica = '" . $conn->real_escape_string($_POST['Forma_Farmaceutica']) . "'";
}
if (isset($_POST['No_Lote']) && $_POST['No_Lote'] != "") {
    $where[] = "No_Lote = '" . $conn->real_escape_string($_POST['No_Lote']) . "'";
}
if (isset($_POST['Fecha_de_Vencimiento']) && $_POST['Fecha_de_Vencimiento'] != "") {
    $where[] = "Fecha_de_Vencimiento = '" . $conn->real_escape_string($_POST['Fecha_de_Vencimiento']) . "'";
}
if (isset($_POST['unidad']) && $_POST['unidad'] != "") {
    $where[] = "unidad = '" . $conn->real_escape_string($_POST['unidad']) . "'";
}
if (isset($_POST['Reg_Sanitario_Invima']) && $_POST['Reg_Sanitario_Invima'] != "") {
    $where[] = "Reg_Sanitario_Invima = '" . $conn->real_escape_string($_POST['Reg_Sanitario_Invima']) . "'";
}
if (isset($_POST['Expediente_Reg_Sanitario_Invima']) && $_POST['Expediente_Reg_Sanitario_Invima'] != "") {
    $where[] = "Expediente_Reg_Sanitario_Invima = '" . $conn->real_escape_string($_POST['Expediente_Reg_Sanitario_Invima']) . "'";
}
if (isset($_POST['Vigencia_Reg_Sanitario_Invima']) && $_POST['Vigencia_Reg_Sanitario_Invima'] != "") {
    $where[] = "Vigencia_Reg_Sanitario_Invima = '" . $conn->real_escape_string($_POST['Vigencia_Reg_Sanitario_Invima']) . "'";
}
if (isset($_POST['Fecha_Vigencia_Reg_Sanitario_Invima']) && $_POST['Fecha_Vigencia_Reg_Sanitario_Invima'] != "") {
    $where[] = "Fecha_Vigencia_Reg_Sanitario_Invima = '" . $conn->real_escape_string($_POST['Fecha_Vigencia_Reg_Sanitario_Invima']) . "'";
}
if (isset($_POST['Laboratorio']) && $_POST['Laboratorio'] != "") {
    $where[] = "Laboratorio = '" . $conn->real_escape_string($_POST['Laboratorio']) . "'";
}
if (isset($_POST['Cantidad_Recepcionada']) && $_POST['Cantidad_Recepcionada'] != "") {
    $where[] = "Cantidad_Recepcionada = '" . $conn->real_escape_string($_POST['Cantidad_Recepcionada']) . "'";
}
if (isset($_POST['Observaciones']) && $_POST['Observaciones'] != "") {
    $where[] = "Observaciones = '" . $conn->real_escape_string($_POST['Observaciones']) . "'";
}
if (isset($_POST['Usuario']) && $_POST['Usuario'] != "") {
    $where[] = "Usuario = '" . $conn->real_escape_string($_POST['Usuario']) . "'";
}
// ... Repite para todas las columnas que quieras filtrar
            // Búsqueda (si se ha ingresado un término de búsqueda)
            $search = '';
            if (isset($_POST['search'])) {
                $search = $conn->real_escape_string($_POST['search']);
            }

            // Procesar la búsqueda y los filtros
            $where = [];
            if (!empty($search)) {
                // Filtro de búsqueda para todos los campos
                $where[] = "(
                    ID LIKE '%$search%' OR
                    Consecutivo LIKE '%$search%' OR 
                    Comprobante LIKE '%$search%' OR 
                    Tipo_Comprobante LIKE '%$search%' OR 
                    Tercero LIKE '%$search%' OR 
                    Fecha_Recepcion LIKE '%$search%' OR 
                    Fecha_Inspeccion LIKE '%$search%' OR 
                    Factura_o_Remision LIKE '%$search%' OR 
                    Fecha_Factura_o_Remision LIKE '%$search%' OR 
                    Codigo_Interno LIKE '%$search%' OR 
                    Cod_Cum LIKE '%$search%' OR 
                    Cod_ATC LIKE '%$search%' OR 
                    nombre LIKE '%$search%' OR 
                    Nombre_Generico LIKE '%$search%' OR 
                    Forma_Farmaceutica LIKE '%$search%' OR 
                    No_Lote LIKE '%$search%' OR 
                    Fecha_de_Vencimiento LIKE '%$search%' OR 
                    unidad LIKE '%$search%' OR 
                    Reg_Sanitario_Invima LIKE '%$search%' OR 
                    Expediente_Reg_Sanitario_Invima LIKE '%$search%' OR 
                    Vigencia_Reg_Sanitario_Invima LIKE '%$search%' OR 
                    Fecha_Vigencia_Reg_Sanitario_Invima LIKE '%$search%' OR 
                    Laboratorio LIKE '%$search%' OR 
                    Cantidad_Recepcionada LIKE '%$search%' OR 
                    Observaciones LIKE '%$search%' OR 
                    Usuario LIKE '%$search%'
                )";
            }

            // Añadir filtros de las columnas si existen
            if (isset($_POST['Consecutivo']) && $_POST['Consecutivo'] != "") {
                $where[] = "Consecutivo = '" . $conn->real_escape_string($_POST['Consecutivo']) . "'";
            }
            // Repite para las demás columnas que quieras filtrar...

            // Crear la consulta SQL final
            $sql = "SELECT * FROM articulos";
            if (count($where) > 0) {
                $sql .= " WHERE " . implode(' AND ', $where);
            }

            // Ejecutar la consulta
            $result = $conn->query($sql);

// Crear la consulta SQL final
$sql = "SELECT * FROM articulos";
if (count($where) > 0) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

$result = $conn->query($sql);
?>




<center><h2>Base de Datos de Artículos</h2></center>
<style>
    body {
        background-image: url('/mi_proyecto/php/img/R.jpg');
        background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        background-attachment: fixed; /* Mantiene la imagen fija al hacer scroll */
        }
</style>
<!-- Formulario con filtros desplegables -->
<form method="POST">
    <table id="filter-table">
        <thead>
            <tr>
                <th>ID
                    <br>
                    <select name="ID">
                        <option value="">Todos</option>
                        <?php foreach ($valoresID as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['ID']) && $_POST['ID'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>

                <th>Consecutivo
                    <br>
                    <select name="Consecutivo">
                        <option value="">Todos</option>
                        <?php foreach ($valoresConsecutivo as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Consecutivo']) && $_POST['Consecutivo'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Comprobante
                    <br>
                    <select name="Comprobante">
                        <option value="">Todos</option>
                        <?php foreach ($valoresComprobante as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Comprobante']) && $_POST['Comprobante'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Tipo_Comprobante
                    <br>
                    <select name="Tipo_Comprobante">
                        <option value="">Todos</option>
                        <?php foreach ($valoresTipoComprobante as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Tipo_Comprobante']) && $_POST['Tipo_Comprobante'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Tercero
                    <br>
                    <select name="Tercero">
                        <option value="">Todos</option>
                        <?php foreach ($valoresTercero as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Tercero']) && $_POST['Tercero'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Fecha_Recepcion
                    <br>
                    <select name="Fecha_Recepcion">
                        <option value="">Todos</option>
                        <?php foreach ($valoresFecha_Recepcion as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Fecha_Recepcion']) && $_POST['Fecha_Recepcion'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Fecha_Inspeccion
                    <br>
                    <select name="Fecha_Inspeccion">
                        <option value="">Todos</option>
                        <?php foreach ($valoresFecha_Inspeccion as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Fecha_Inspeccion']) && $_POST['Fecha_Inspeccion'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Factura_o_Remision
                    <br>
                    <select name="Factura_o_Remision">
                        <option value="">Todos</option>
                        <?php foreach ($valoresTercero as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Factura_o_Remision']) && $_POST['Factura_o_Remision'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Fecha_Factura_o_Remision 
                    <br>
                    <select name="Fecha_Factura_o_Remision">
                        <option value="">Todos</option>
                        <?php foreach ($valoresFactura_o_Remision as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Fecha_Factura_o_Remision']) && $_POST['Fecha_Factura_o_Remision'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Codigo_Interno
                    <br>
                    <select name="Codigo_Interno">
                        <option value="">Todos</option>
                        <?php foreach ($valoresCodigo_Interno as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Codigo_Interno']) && $_POST['Codigo_Interno'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Cod_Cum
                    <br>
                    <select name="Cod_Cum">
                        <option value="">Todos</option>
                        <?php foreach ($valoresCod_Cum as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Cod_Cum']) && $_POST['Cod_Cum'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Cod_ATC
                    <br>
                    <select name="Cod_ATC">
                        <option value="">Todos</option>
                        <?php foreach ($valoresCod_ATC as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Cod_ATC']) && $_POST['Cod_ATC'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Nombre
                    <br>
                    <select name="nombre">
                        <option value="">Todos</option>
                        <?php foreach ($valoresnombre as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['nombre']) && $_POST['nombre'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Nombre_Generico
                    <br>
                    <select name="Nombre_Generico">
                        <option value="">Todos</option>
                        <?php foreach ($valoresNombre_Generico as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Nombre_Generico']) && $_POST['Nombre_Generico'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Forma_Farmaceutica 
                    <br>
                    <select name="Forma_Farmaceutica">
                        <option value="">Todos</option>
                        <?php foreach ($valoresForma_Farmaceutica as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Forma_Farmaceutica']) && $_POST['Forma_Farmaceutica'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>No_Lote
                    <br>
                    <select name="No_Lote">
                        <option value="">Todos</option>
                        <?php foreach ($valoresNo_Lote as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['No_Lote']) && $_POST['No_Lote'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Fecha_de_Vencimiento
                    <br>
                    <select name="Fecha_de_Vencimiento">
                        <option value="">Todos</option>
                        <?php foreach ($valoresFecha_de_Vencimiento as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Fecha_de_Vencimiento']) && $_POST['Fecha_de_Vencimiento'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Unidad
                    <br>
                    <select name="unidad">
                        <option value="">Todos</option>
                        <?php foreach ($valoresunidad as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['unidad']) && $_POST['unidad'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Reg_Sanitario_Invima
                    <br>
                    <select name="Reg_Sanitario_Invima">
                        <option value="">Todos</option>
                        <?php foreach ($valoresReg_Sanitario_Invima as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Reg_Sanitario_Invima']) && $_POST['Reg_Sanitario_Invima'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Expediente_Reg_Sanitario_Invima
                    <br>
                    <select name="Expediente_Reg_Sanitario_Invima">
                        <option value="">Todos</option>
                        <?php foreach ($valoresExpediente_Reg_Sanitario_Invima as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Expediente_Reg_Sanitario_Invima']) && $_POST['Expediente_Reg_Sanitario_Invima'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Vigencia_Reg_Sanitario_Invima
                    <br>
                    <select name="Vigencia_Reg_Sanitario_Invima">
                        <option value="">Todos</option>
                        <?php foreach ($valoresVigencia_Reg_Sanitario_Invima as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Vigencia_Reg_Sanitario_Invima']) && $_POST['Vigencia_Reg_Sanitario_Invima'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Fecha_Vigencia_Reg_Sanitario_Invima
                    <br>
                    <select name="Fecha_Vigencia_Reg_Sanitario_Invima">
                        <option value="">Todos</option>
                        <?php foreach ($valoresFecha_Vigencia_Reg_Sanitario_Invima as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Fecha_Vigencia_Reg_Sanitario_Invima']) && $_POST['Fecha_Vigencia_Reg_Sanitario_Invima'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Laboratorio
                    <br>
                    <select name="Laboratorio">
                        <option value="">Todos</option>
                        <?php foreach ($valoresLaboratorio as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Laboratorio']) && $_POST['Laboratorio'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Cantidad_Recepcionada
                    <br>
                    <select name="Cantidad_Recepcionada">
                        <option value="">Todos</option>
                        <?php foreach ($valoresCantidad_Recepcionada as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Cantidad_Recepcionada']) && $_POST['Cantidad_Recepcionada'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Observaciones 
                    <br>
                    <select name="Observaciones">
                        <option value="">Todos</option>
                        <?php foreach ($valoresObservaciones as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Observaciones']) && $_POST['Observaciones'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th>Usuario
                    <br>
                    <select name="Usuario">
                        <option value="">Todos</option>
                        <?php foreach ($valoresUsuario as $valor) { ?>
                            <option value="<?= $valor ?>" <?= isset($_POST['Usuario']) && $_POST['Usuario'] == $valor ? 'selected' : '' ?>><?= $valor ?></option>
                        <?php } ?>
                    </select>
                </th>
                <!-- Repite para las demás columnas -->
            </tr>
        </thead>
    </table>

    <input type="submit" value="Filtrar">
</form>

<!-- Formulario de búsqueda -->
<form method="POST">
    <input type="text" name="search" placeholder="Buscar...">
    <input type="submit" value="Buscar">
</form>

<!-- Botón para volver 
<form action="index.php" method="POST">
    <input type="submit" value="Volver">
</form>-->


<div id="table-container">
    <?php
    if ($result->num_rows > 0) {
        echo "<table id='article-table' border='1'>
                <thead>
                    <tr>
                        <th>ID <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Consecutivo <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Comprobante <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Tipo_Comprobante <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Tercero <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Fecha_Recepcion <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Fecha_Inspeccion <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Factura_o_Remision <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Fecha_Factura_o_Remision <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Codigo_Interno <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Cod_Cum <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Cod_ATC <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Nombre <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Nombre_Generico <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Forma_Farmaceutica <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>No_Lote <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Fecha_de_Vencimiento <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Unidad <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Reg_Sanitario_Invima <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Expediente_Reg_Sanitario_Invima <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Vigencia_Reg_Sanitario_Invima <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Fecha_Vigencia_Reg_Sanitario_Invima <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Laboratorio <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Cantidad_Recepcionada <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Observaciones <input type='text' class='filter' onkeyup='filterTable()'></th>
                        <th>Usuario <input type='text' class='filter' onkeyup='filterTable()'></th>
                    </tr>
                </thead>
                <tbody>";

        // Mostrar los datos en la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "No se encontraron registros";
    }
    ?>
</div>
