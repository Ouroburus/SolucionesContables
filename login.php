<?php
// Iniciar sesión
session_start();
// Verificar si ya hay una sesión activa
if (isset($_SESSION['usuario'])) {
    // Redirigir al dashboard o página principal
    header('Location: index.php');
    exit();
}
// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Validar credenciales (aquí puedes agregar una validación con base de datos o un usuario estático)
    if ($usuario === 'admin' && $password === 'admin123') {
        // Establecer la sesión del usuario
        $_SESSION['usuario'] = $usuario;

        // Redirigir al dashboard
        header("Location: index.php");
        exit();
    } else {
        // Mostrar un mensaje de error si las credenciales no son correctas
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Soluciones Contables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #d9534f;
            border-color: #d9534f;
        }

        .btn-primary:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Soluciones Contables - Login</h2>
    
    <?php if (isset($error)): ?>
        <div class="error-message">
            <p><?php echo $error; ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
