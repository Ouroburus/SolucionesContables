<!DOCTYPE html>
<html lang="en">
<?php
// Iniciar sesión
session_start();

// Incluir la conexión a MongoDB
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

// Conectar a la base de datos
$client = new MongoDB\Client("mongodb://localhost:27017");
$database = $client->tu_base_de_datos; // Reemplaza con el nombre de tu base de datos
$collection = $database->usuarios; // Reemplaza con el nombre de tu colección

// Recibir datos de login
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Buscar al usuario en la base de datos
$usuarioEncontrado = $collection->findOne(['usuario' => $usuario]);

if ($usuarioEncontrado) {
    // Verificar si la contraseña es correcta
    if (password_verify($password, $usuarioEncontrado['password'])) {
        // Establecer la sesión del usuario
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo_usuario'] = $usuarioEncontrado['tipo']; // Puede ser 'admin', 'user', o 'userPro'

        // Redirigir según el tipo de usuario
        if ($usuarioEncontrado['tipo'] === 'admin') {
            header("Location: admin_dashboard.php");
        } elseif ($usuarioEncontrado['tipo'] === 'userPro') {
            header("Location: userPro_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        // Contraseña incorrecta
        $error = "Contraseña incorrecta.";
    }
} else {
    // Usuario no encontrado
    $error = "Usuario no encontrado.";
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>Bienvenido a mi Formulario</title>
    
</head>

<body>
    <div class="container-form sign-up">
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido a Soluciones Contables</h2>
                <p>Si ya tienes una cuenta por favor inicia sesion aqui</p>
                <button class="sign-up-btn">Iniciar Sesion</button>
            </div>
        </div>
        <form class="formulario">
            <h2 class="create-account">Crear una cuenta</h2>
            <p class="cuenta-gratis">Crear una cuenta gratis</p>
            <input type="text" placeholder="Nombre">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Contraseña">
            <input type="button" value="Registrarse">
        </form>
    </div>
    <div class="container-form sign-in">
        <form class="formulario">
            <h2 class="create-account">Iniciar Sesion</h2>
            <p class="cuenta-gratis">¿Aun no tienes una cuenta?</p>
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Contraseña">
            <input type="button" value="Iniciar Sesion">
        </form>
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido de nuevo</h2>
                <p>Si aun no tienes una cuenta por favor registrese aqui</p>
                <button class="sign-in-btn">Registrarse</button>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>