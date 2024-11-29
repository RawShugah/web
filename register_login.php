<?php
session_start();
if (isset($_SESSION['username'])) {
    // Si ya está autenticado, redirige al dashboard
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambia tus hábitos de salud - Registro / Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Cambia tus hábitos de salud</h1>
    <h2>Selecciona una opción:</h2>

    <!-- Formulario de Registro -->
    <h3>Registrarse</h3>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>

    <!-- Opción para iniciar sesión -->
    <h3>¿Ya tienes una cuenta?</h3>
    <form action="login.php" method="GET">
        <button type="submit">Iniciar Sesión</button>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>
