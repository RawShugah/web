<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Fitness y Salud</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye la misma hoja de estilos -->
</head>

<body>
    <div class="container">
        <h1>Bienvenido a Fitness y Salud</h1>
        
        <!-- Formulario de inicio de sesión -->
        <form action="login.php" method="POST">
            <h2>Iniciar Sesión</h2>
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>

        <!-- Formulario de registro -->
        <form action="register.php" method="POST">
            <h2>Registrarse</h2>
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

        <!-- Botón o enlace para abrir la página de información sobre la obesidad y el deporte -->
        <a href="informacion.php" target="_blank" class="info-button">Más Información sobre la Obesidad y el Deporte</a>
    </div>
</body>
</html>
