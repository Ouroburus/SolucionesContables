<?php
require_once '../../controllers/ControllVCF.php';

$controlador = new VentasControlador();

// Manejar la inserción de venta
$mensaje = $controlador->guardarVenta();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ventas a Consumidor Final</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Registro de Venta a Consumidor Final</h1>

        <!-- Mensaje de confirmación -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <?php echo $mensaje; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form method="POST" action="ventasconsumidor.php">
            <table>
                <tr>
                    <td>Fecha:</td>
                    <td><input type="date" name="fecha" required></td>
                    <td>Documento Inicio:</td>
                    <td><input type="text" name="documento_inicio" required></td>
                </tr>
                <tr>
                    <td>Documento Final:</td>
                    <td><input type="text" name="documento_final" required></td>
                    <td>Ventas Exentas:</td>
                    <td><input type="number" step="0.01" name="ventas_exentas" required></td>
                </tr>
                <tr>
                    <td>Ventas Internas Gravadas:</td>
                    <td><input type="number" step="0.01" name="ventas_gravadas" required></td>
                    <td>Exportaciones:</td>
                    <td><input type="number" step="0.01" name="exportaciones"></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
