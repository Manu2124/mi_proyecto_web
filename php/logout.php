<?php
session_start();
session_unset();  // Eliminar todas las variables de sesión
session_destroy();  // Destruir la sesión

// Redireccionar al inicio de sesión
header(header: "Location: index.html");
exit();
?>
