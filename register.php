<?php
$connection = new mysqli("localhost", "root", "", "proyecto_fitness");

if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $connection->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header('Location: login.php?registered=success'); // Redirige al login
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambia tus hábitos de salud - Registro</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye la hoja de estilos -->
</head>
<body>
    <div class="container">
        <h1>Bienvenido a Fitness y Salud</h1>
        <form method="POST" action="register.php">
            <h2>Registrarse</h2>
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        <a href="informacion.php" target="_blank" class="info-button">Más Información sobre la Obesidad y el Deporte</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
