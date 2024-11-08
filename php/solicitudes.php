<?php
// Conexión a la base de datos
$servername = "localhost";  // O la IP del servidor MySQL
$username = "root";         // Cambiar por tu usuario MySQL
$password = "";             // Cambiar por tu contraseña MySQL
$dbname = "users_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los datos de la tabla solicitudes
$sql = "SELECT * FROM solicitudes";
$result = $conn->query($sql);

?>

<!-- Modal para la consulta de insumos -->
<div id="consultaModal" class="modal" style="display: none;">
  <div class="modal-content">
      <h2>Consulta de Insumos</h2>
      <table border="1">
          <thead>
              <tr>
                  <th>Nombre Solicitante</th>
                  <th>Servicio</th>
                  <th>Artículo</th>
                  <th>Unidad</th>
                  <th>Cantidad Solicitada</th>
                  <th>Observaciones</th>
                  <th>Cantidad Entra</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
              <?php
              // Mostrar los datos de la consulta
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['nombre_solicitante'] . "</td>";
                      echo "<td>" . $row['servicio'] . "</td>";
                      echo "<td>" . $row['articulo'] . "</td>";
                      echo "<td>" . $row['unidad'] . "</td>";
                      echo "<td>" . $row['cantidad_solicitada'] . "</td>";
                      echo "<td>" . $row['observaciones'] . "</td>";
                      // Campo editable para cantidad entra
                      echo "<td><input type='number' name='cantidad_entra' id='cantidad_entra_" . $row['id'] . "' value='" . $row['cantidad_entra'] . "'></td>";
                      // Botón para guardar
                      echo "<td><button onclick='guardarCantidad(" . $row['id'] . ")'>Guardar</button></td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='8'>No hay resultados</td></tr>";
              }
              ?>
          </tbody>
      </table>
      <button class="close-btn" onclick="closeModal()">Cerrar</button>
  </div>
</div>

<script>
// Función para guardar la cantidad entra
function guardarCantidad(id) {
    const cantidad = document.getElementById('cantidad_entra_' + id).value;

    // Realizar la petición AJAX para guardar la cantidad entra
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_cantidad.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            alert('Cantidad actualizada correctamente');
        } else {
            alert('Error al actualizar la cantidad');
        }
    };
    xhr.send('id=' + id + '&cantidad_entra=' + cantidad);
}
</script>
