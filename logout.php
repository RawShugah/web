<?php
session_start();
session_destroy(); // Cerrar sesión
header('Location: register_login.php'); // Redirige a la página de registro e inicio de sesión
exit();
?>
