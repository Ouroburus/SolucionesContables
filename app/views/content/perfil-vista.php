<?php
// Archivo para mostrar el perfil del usuario
require_once __DIR__ . '/../../../config/database4.php';

session_start();

// Verificar si el usuario está autenticado y obtener su ID
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir si no hay sesión activa
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Cargar datos del usuario desde la base de datos
$collection = $db->user; // Reemplaza 'user' con el nombre de tu colección si es diferente
$filtro = ['_id' => new MongoDB\BSON\ObjectId($id_usuario)];
$cliente = $collection->findOne($filtro);

if (!$cliente) {
    echo "Usuario no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        .form-control[readonly] {
            background-color: #e9ecef;
        }
        .small-input {
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="container profile-container mt-5">
        <div class="text-center position-relative" style="display: inline-block;">
            <img src="<?php echo $cliente->foto_perfil ?? 'img/default-profile.jpg'; ?>" alt="Foto de Perfil" class="profile-pic mb-3">
            <a href="cambiar_imagen.php" class="position-absolute" style="right: 10px; bottom: 10px;">
                <img src="lapiz.png" alt="Editar" style="width: 30px; height: 30px;">
            </a>
        </div>

        <!-- Información del cliente -->
        <form id="perfil-form" method="POST" action="../../controllers/save_profile.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente->nombre); ?>" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($cliente->apellido); ?>" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($cliente->usuario); ?>" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($cliente->correo); ?>" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="suscripcion" class="form-label">Tipo de Suscripción:</label>
                <input type="text" id="suscripcion" name="suscripcion" value="<?php echo htmlspecialchars($cliente->suscripcion); ?>" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="fecha_pago" class="form-label">Fecha de Pago:</label>
                <input type="date" id="fecha_pago" name="fecha_pago" value="<?php echo htmlspecialchars($cliente->fecha_pago); ?>" class="form-control" readonly>
            </div>

            <div class="mb-3 d-flex align-items-center">
                <label for="contraseña" class="form-label me-2">Contraseña:</label>
                <input type="password" id="contrasena" name="contraseña" value="<?php echo htmlspecialchars($cliente->contraseña); ?>" class="form-control me-4 small-input" readonly>
                <a href="cambiar_contrasena.php" class="btn btn-danger">Cambiar</a>
            </div>

            <!-- Botones para administración del perfil -->
            <div class="d-flex justify-content-between">
                <button type="button" id="editar-nombres-btn" class="btn btn-primary">Editar Nombres</button>
                <button type="submit" id="guardar-btn" class="btn btn-success" style="display:none;">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <script>
        // Activar la edición de los campos excepto el correo y la contraseña
        document.getElementById('editar-nombres-btn').addEventListener('click', function() {
            document.getElementById('nombre').removeAttribute('readonly');
            document.getElementById('apellido').removeAttribute('readonly');
            document.getElementById('usuario').removeAttribute('readonly');
            document.getElementById('suscripcion').removeAttribute('readonly');
            document.getElementById('fecha_pago').removeAttribute('readonly');

            // Mostrar botón "Guardar Cambios"
            document.getElementById('guardar-btn').style.display = 'block';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
