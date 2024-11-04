<!DOCTYPE html>
<html lang="en">
<?php
// Iniciar sesión
session_start();

// Incluir la conexión a MongoDB
require 'vendor/autoload.php';

// Conectar a la base de datos
$client = new MongoDB\Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/");
$database = $client->BDContador;
$collection = $database->Users;

// Recibir datos de login
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Buscar al usuario en la base de datos
$usuarioEncontrado = $collection->findOne(['User' => $usuario]);

if ($usuarioEncontrado) {
    // Verificar si la contraseña es correcta
    if ($password === $usuarioEncontrado['password']) {
        // Establecer la sesión del usuario
        $_SESSION['loggedin'] = true;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo_usuario'] = $usuarioEncontrado['type'];

        // Redirigir según el tipo de usuario
        if ($usuarioEncontrado['type'] === 'admin') {
            header("Location: index.php");
        } elseif ($usuarioEncontrado['type'] === 'userPro') {
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
                <p>Si ya tienes una cuenta por favor inicia sesión aquí</p>
                <button class="sign-up-btn" onclick="toggleForm()">Iniciar Sesión</button>
            </div>
        </div>
        <form class="formulario" method="POST" action="register.php">
            <h2 class="create-account">Crear una cuenta</h2>
            <p class="cuenta-gratis">Crear una cuenta gratis</p>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" class="form-button">Registrarse</button>
        </form>
    </div>
    
    <div class="container-form sign-in">
        <form class="formulario" method="POST" action="">
            <h2 class="create-account">Iniciar Sesión</h2>
            <p class="cuenta-gratis">¿Aún no tienes una cuenta?</p>
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" class="form-button">Iniciar Sesión</button>
        </form>
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido de nuevo</h2>
                <p>Si aún no tienes una cuenta, por favor regístrate aquí</p>
                <button class="sign-in-btn" onclick="toggleForm()">Registrarse</button>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            document.querySelector('.container-form.sign-up').classList.toggle('active');
            document.querySelector('.container-form.sign-in').classList.toggle('active');
        }
    </script>

    <?php if (isset($error)): ?>
        <script>alert("<?php echo $error; ?>");</script>
    <?php endif; ?>

</body>
</html>
