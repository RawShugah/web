<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Si no está autenticado, redirigir a la página de registro
    header('Location: register.php');
    exit();
}

// Clave API de Gemini (reemplaza con tu clave real)
$apiKey = 'AIzaSyDwqCUm7BdPlPIuxvGC3KNO7bovHXxLJx4';  // Coloca aquí tu clave API de Google
$endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . $apiKey;

// Procesar la solicitud POST para la IA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $goal = $_POST['goal'];

    // Definir el prompt para la IA
    $data = [
        'contents' => [
            ['parts' => [['text' => "Genera una rutina de ejercicios para $goal. Incluye 5 ejercicios detallados."]]]
        ]
    ];

    // Configuración de la solicitud cURL
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Ejecutar la solicitud cURL
    $response = curl_exec($ch);
    curl_close($ch);

    // Procesar la respuesta de la API
    $result = json_decode($response, true);

    // Verificar si la respuesta es válida
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        $routine = $result['candidates'][0]['content']['parts'][0]['text'];
    } else {
        $routine = "Error al generar la rutina. Intenta nuevamente más tarde.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambia tus hábitos de salud - Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?>!</h1>
    <h2>Elige tu objetivo:</h2>
    <form method="POST" action="dashboard.php">
        <label for="goal">Objetivo:</label>
        <select name="goal" id="goal">
            <option value="ganar masa muscular">Ganar Masa Muscular</option>
            <option value="perder peso">Perder Peso</option>
            <option value="mantenerse en forma">Mantenerse en Forma</option>
        </select>
        <button type="submit">Generar Plan con IA</button>
    </form>

    <?php if (isset($routine)): ?>
        <div class="routine-container">
            <h2>Tu Rutina Generada por IA:</h2>
            <pre><?php echo htmlspecialchars($routine); ?></pre>
        </div>
    <?php endif; ?>

    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
    <?php include 'footer.php'; ?>
</body>
</html>
