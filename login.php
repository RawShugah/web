<?php
session_start();
$connection = new mysqli("localhost", "root", "", "proyecto_fitness");

if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
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
    <title>Cambia tus hábitos de salud - Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye la hoja de estilos -->
</head>
<body>
    <div class="container">
        <h1>Bienvenido a Fitness y Salud</h1>
        <?php if (isset($_GET['registered'])): ?>
            <p class="success">Registro exitoso. Ahora puedes iniciar sesión.</p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <h2>Iniciar Sesión</h2>
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
        <a href="informacion.php" target="_blank" class="info-button">Más Información sobre la Obesidad y el Deporte</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
