<?php
// Iniciamos la sesión para almacenar los datos ingresados
session_start();

// Inicializamos las variables para los totales
$ventasExentasTotal = 0;
$ventasGravadasTotal = 0;

// Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos los valores del formulario
    $fecha = $_POST['fecha'];
    $documentoInicio = $_POST['documento_inicio'];
    $documentoFinal = $_POST['documento_final'];
    $ventasExentas = $_POST['ventas_exentas'];
    $ventasGravadas = $_POST['ventas_gravadas'];
    $exportaciones = $_POST['exportaciones'];

    // Si la variable de sesión no existe, la creamos como un array
    if (!isset($_SESSION['ventas'])) {
        $_SESSION['ventas'] = [];
    }

    // Almacenamos los datos ingresados en el array de sesión
    $_SESSION['ventas'][] = [
        'fecha' => $fecha,
        'documento_inicio' => $documentoInicio,
        'documento_final' => $documentoFinal,
        'ventas_exentas' => $ventasExentas,
        'ventas_gravadas' => $ventasGravadas,
        'exportaciones' => $exportaciones
    ];

    // Redireccionamos a la misma página para evitar el reenvío de datos al refrescar
    header("Location: ventasconsumidor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta a Consumidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Registro de Venta a Consumidor Final</h1>

        <!-- Formulario -->
        <form method="POST" action="ventasconsumidor.php" class="mt-4">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control" id="fecha" required>
            </div>
            <div class="row">
    <div class="col-md-6 mb-3">
        <label for="documento_inicio" class="form-label">Documento Inicio</label>
        <input type="text" name="documento_inicio" class="form-control" id="documento_inicio" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="documento_final" class="form-label">Documento Final</label>
        <input type="text" name="documento_final" class="form-control" id="documento_final" required>
    </div>
</div>
            <div class="mb-3">
                <label for="ventas_exentas" class="form-label">Ventas Exentas</label>
                <input type="number" step="0.01" name="ventas_exentas" class="form-control" id="ventas_exentas" required>
            </div>
            <div class="mb-3">
                <label for="ventas_gravadas" class="form-label">Ventas Internas Gravadas</label>
                <input type="number" step="0.01" name="ventas_gravadas" class="form-control" id="ventas_gravadas" required>
            </div>
            <div class="mb-3">
                <label for="exportaciones" class="form-label">Exportaciones</label>
                <input type="number" step="0.01" name="exportaciones" class="form-control" id="exportaciones">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <!-- Mostrar la tabla si se han registrado ventas -->
        <?php if (isset($_SESSION['ventas']) && count($_SESSION['ventas']) > 0) { ?>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Documento Inicio</th>
                        <th>Documento Final</th>
                        <th>Ventas Exentas</th>
                        <th>Ventas Internas Gravadas</th>
                        <th>Exportaciones</th>
                        <th>Total Ventas Diarias</th>
                        <th>Ventas a Cuenta de Terceros</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['ventas'] as $venta) { 
                        // Sumamos los totales
                        $ventasExentasTotal += $venta['ventas_exentas'];
                        $ventasGravadasTotal += $venta['ventas_gravadas'];
                    ?>
                    <tr>
                        <td><?php echo $venta['fecha']; ?></td>
                        <td><?php echo $venta['documento_inicio']; ?></td>
                        <td><?php echo $venta['documento_final']; ?></td>
                        <td><?php echo $venta['ventas_exentas']; ?></td>
                        <td><?php echo $venta['ventas_gravadas']; ?></td>
                        <td><?php echo $venta['exportaciones']; ?></td>
                        <td><?php echo $venta['ventas_gravadas']; ?></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Mostrar los totales -->
            <div class="mt-4">
                <h3>Totales</h3>
                <p><strong>Total Ventas Exentas:</strong> $<?php echo $ventasExentasTotal; ?></p>
                <p><strong>Total Ventas Internas Gravadas:</strong> $<?php echo $ventasGravadasTotal; ?></p>
            </div>
        <?php } ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
