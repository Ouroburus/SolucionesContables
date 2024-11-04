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
    <?php include '../layouts/Header.php' ?>
    <div class="container">
        <h1 class="mt-4">Registro de Venta a Consumidor Final</h1>

        <!-- Mensaje de confirmación -->
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <?php echo $mensaje; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form id="formulario" method="POST" action="CCFinal.php">
            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="documento_inicio" class="form-label">Documento Inicio</label>
                <input type="text" id="documento_inicio" name="documento_inicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="documento_final" class="form-label">Documento Final</label>
                <input type="text" id="documento_final" name="documento_final" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nro_caja" class="form-label">Nº Caja</label>
                <input type="number" id="nro_caja" name="nro_caja" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ventas_exentas" class="form-label">Ventas Exentas</label>
                <input type="number" id="ventas_exentas" name="ventas_exentas" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ventas_gravadas" class="form-label">Ventas Gravadas</label>
                <input type="number" id="ventas_gravadas" name="ventas_gravadas" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="exportaciones" class="form-label">Exportaciones</label>
                <input type="number" id="exportaciones" name="exportaciones" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="venta_cuenta_terceros" class="form-label">Ventas a Cuentas de Terceros</label>
                <input type="number" id="venta_cuenta_terceros" name="venta_cuenta_terceros" class="form-control" required>
            </div>

            <h2 class="mt-4">Detalles de Ventas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Fecha</th>
                        <th>Documento Inicio</th>
                        <th>Documento Final</th>
                        <th>Nº Caja</th>
                        <th>Ventas Exentas</th>
                        <th>Ventas Gravadas</th>
                        <th>Exportaciones</th>
                        <th>Total Ventas Diarias Propias</th>
                        <th>Ventas a Cuentas de Terceros</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla_ventas">
                    <!-- Filas dinámicas -->
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Totales:</th>
                        <td id="total_ventas_exentas">0.00</td>
                        <td id="total_ventas_gravadas">0.00</td>
                        <td id="total_exportaciones">0.00</td>
                        <td id="total_ventas_diarias">0.00</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <button type="button" class="btn btn-secondary mt-3" onclick="agregarFila()">Agregar Fila</button>
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
    <?php include '../layouts/footer.php' ?>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function agregarFila() {
        const tabla = document.getElementById('tabla_ventas');
        const fila = document.createElement('tr');

        // Obtén los valores del formulario
        const fecha = document.getElementById('fecha').value;
        const documentoInicio = document.getElementById('documento_inicio').value;
        const documentoFinal = document.getElementById('documento_final').value;
        const nroCaja = document.getElementById('nro_caja').value;
        const ventasExentas = document.getElementById('ventas_exentas').value;
        const ventasGravadas = document.getElementById('ventas_gravadas').value;
        const exportaciones = document.getElementById('exportaciones').value;
        const totalVentasDiarias = parseFloat(ventasGravadas) || 0;  // Suponiendo que totalVentasDiarias es igual a ventas gravadas
        const ventaCuentaTerceros = document.getElementById('venta_cuenta_terceros').value;

        // Crea las celdas de la fila
        fila.innerHTML = `
    <td>${tabla.children.length + 1}</td>
    <td>${fecha}</td>
    <td>${documentoInicio}</td>
    <td>${documentoFinal}</td>
    <td>${nroCaja}</td>
    <td><input type="hidden" name="ventas[${tabla.children.length}][ventas_exentas]" value="${parseFloat(ventasExentas).toFixed(2)}">${parseFloat(ventasExentas).toFixed(2)}</td>
    <td><input type="hidden" name="ventas[${tabla.children.length}][ventas_gravadas]" value="${parseFloat(ventasGravadas).toFixed(2)}">${parseFloat(ventasGravadas).toFixed(2)}</td>
    <td><input type="hidden" name="ventas[${tabla.children.length}][exportaciones]" value="${parseFloat(exportaciones).toFixed(2)}">${parseFloat(exportaciones).toFixed(2)}</td>
    <td>${totalVentasDiarias.toFixed(2)}</td>
    <td><input type="hidden" name="ventas[${tabla.children.length}][venta_cuenta_terceros]" value="${parseFloat(ventaCuentaTerceros).toFixed(2)}">${parseFloat(ventaCuentaTerceros).toFixed(2)}</td>
    <td><button class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button></td>
`;

        tabla.appendChild(fila);
        
        // Limpiar campos
        document.getElementById('fecha').value = '';
        document.getElementById('documento_inicio').value = '';
        document.getElementById('documento_final').value = '';
        document.getElementById('nro_caja').value = '';
        document.getElementById('ventas_exentas').value = '';
        document.getElementById('ventas_gravadas').value = '';
        document.getElementById('exportaciones').value = '';
        document.getElementById('venta_cuenta_terceros').value = '';
    }

    function eliminarFila(boton) {
        const fila = boton.parentElement.parentElement;
        fila.remove();
    }
    </script>
</body>
</html>
