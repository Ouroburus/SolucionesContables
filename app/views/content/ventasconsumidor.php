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
    <?php include '../layouts/header.php' ?>
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
        <form id="formulario" method="POST" action="ventasconsumidor.php" onsubmit="return agregarDatosATabla()">
            <!-- Campos del formulario -->
            <!-- ... Tu código HTML de entrada aquí ... -->

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

            <!-- Mini tabla de Venta Neta y Débito Fiscal -->
            <h3 class="mt-4">Resumen Fiscal</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Venta Neta</th>
                        <th>Débito Fiscal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="venta_neta">0.00</td>
                        <td id="debito_fiscal">0.00</td>
                        <td id="total_fiscal">0.00</td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-secondary mt-3" onclick="agregarFila()">Agregar Fila</button>
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
    <?php include '../layouts/footer.php' ?>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let filaEditada = null;

    function calcularTotales() {
        let totalVentasExentas = 0, totalVentasGravadas = 0, totalExportaciones = 0, totalVentasDiarias = 0;

        document.querySelectorAll('#tabla_ventas tr').forEach(row => {
            totalVentasExentas += parseFloat(row.cells[5].innerText) || 0;
            totalVentasGravadas += parseFloat(row.cells[6].innerText) || 0;
            totalExportaciones += parseFloat(row.cells[7].innerText) || 0;
            totalVentasDiarias += parseFloat(row.cells[8].innerText) || 0;
        });

        document.getElementById('total_ventas_exentas').innerText = totalVentasExentas.toFixed(2);
        document.getElementById('total_ventas_gravadas').innerText = totalVentasGravadas.toFixed(2);
        document.getElementById('total_exportaciones').innerText = totalExportaciones.toFixed(2);
        document.getElementById('total_ventas_diarias').innerText = totalVentasDiarias.toFixed(2);

        // Calcula Venta Neta y Débito Fiscal
        const ventaNeta = totalVentasDiarias / 1.13;
        const debitoFiscal = totalVentasDiarias * 0.13;
        const totalFiscal = ventaNeta + debitoFiscal;

        document.getElementById('venta_neta').innerText = ventaNeta.toFixed(2);
        document.getElementById('debito_fiscal').innerText = debitoFiscal.toFixed(2);
        document.getElementById('total_fiscal').innerText = totalFiscal.toFixed(2);
    }

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
        const totalVentasDiarias = ventasGravadas;
        const ventaCuentaTerceros = document.getElementById('venta_cuenta_terceros').value;

        fila.innerHTML = `
            <td>${tabla.rows.length + 1}</td>
            <td>${fecha}</td>
            <td>${documentoInicio}</td>
            <td>${documentoFinal}</td>
            <td>${nroCaja}</td>
            <td>${ventasExentas}</td>
            <td>${ventasGravadas}</td>
            <td>${exportaciones}</td>
            <td>${totalVentasDiarias}</td>
            <td>${ventaCuentaTerceros}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="editarFila(this)">Editar</button>
                <button type="button" class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button>
            </td>
        `;

        if (filaEditada) {
            filaEditada.replaceWith(fila);
            filaEditada = null;
        } else {
            tabla.appendChild(fila);
        }

        calcularTotales();
        limpiarFormulario();
    }

    function eliminarFila(boton) {
        const fila = boton.parentNode.parentNode;
        fila.parentNode.removeChild(fila);
        calcularTotales();
    }
    </script>
</body>
</html>
