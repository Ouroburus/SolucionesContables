<?php
// Incluir el archivo de conexión a MongoDB
include '../../../config/database.php'; // Asegúrate de tener la función de conexión a MongoDB
require '../../../vendor/autoload.php'; // Asegúrate de que tienes el autoload de Composer

// Conexión a MongoDB
try {
    $mongoClient = new MongoDB\Client('mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/'); // Cambia la URI según tu configuración
} catch (Exception $e) {
    die("Error al conectar a MongoDB: " . $e->getMessage());
}

// Función para obtener todos los datos de la colección
function obtenerTodosLosDatosIngresos($collectionName) {
    global $mongoClient; // Asegúrate de que $mongoClient esté definido aquí
    $collection = $mongoClient->selectCollection('BDContador', $collectionName); // Usa tu base de datos 'BDContador'

    // Obtener todos los documentos de la colección
    $documentos = $collection->find(); // Obtiene todos los documentos

    return $documentos;
}

// Obtener todos los datos
$datos = obtenerTodosLosDatosIngresos('catalogoCuentas'); // Usa tu colección 'catalogoCuentas'

// Mostrar los datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vista de Catálogo de Cuentas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Detalles del Catálogo de Cuentas</h1>
        
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $documento): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($documento->codigo); ?></td>
                        <td><?php echo htmlspecialchars($documento->nombre); ?></td>
                        <td><?php echo htmlspecialchars($documento->tipo); ?></td>
                        <td>
                            <!-- Botón para agregar en otro formulario -->
                            <form method="POST" action="otroFormulario.php" style="display:inline;">
                                <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($documento->codigo); ?>">
                                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($documento->nombre); ?>">
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
