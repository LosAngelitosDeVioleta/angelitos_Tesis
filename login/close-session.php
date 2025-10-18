<?php
// Iniciar sesión
session_start();

// Limpiar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al index con mensaje opcional
header("location: index.php");
exit;
?>
