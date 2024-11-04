<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../../controllers/CContribuyente.php');
    procesar_libro($_POST);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Ventas a Contribuyentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .contenido {
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table-wrapper {
            margin-top: 20px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php include '../layouts/Header.php' ?>
<div class="container-fluid">
    <h1 class="mt-5">LIBRO DE VENTAS A CONTRIBUYENTES</h1>

    <div class="contenido">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="libroVentasForm">
            <table class="table table-bordered">
                <tr>
                    <td>Nombre del Contribuyente:</td>
                    <td><input type="text" class="form-control" name="nombre_contribuyente" required></td>
                    <td>NRC:</td>
                    <td><input type="text" class="form-control" name="nrc" required></td>
                </tr>
                <tr>
                    <td>Mes:</td>
                    <td><input type="text" class="form-control" name="mes" required></td>
                    <td>Año:</td>
                    <td><input type="text" class="form-control" name="anio" value="2024" required></td>
                </tr>
            </table>

            <h2>Operaciones de Ventas Propias y a Cuenta de Terceros</h2>
            <div class="table-wrapper">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Día</th>
                            <th>N° Correlativo</th>
                            <th>Nombre del Cliente</th>
                            <th>NRC</th>
                            <th>Propias Exentas</th>
                            <th>Propias Gravadas</th>
                            <th>Débito Fiscal</th>
                            <th>A Cuenta de Terceros Exentas</th>
                            <th>A Cuenta de Terceros Gravadas</th>
                            <th>Total</th>
                            <th>IVA Retenido</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_ventas">
                        <!-- Filas dinámicas -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Totales</th>
                            <th><input type="number" id="total_exentas" class="form-control" value="0" readonly></th>
                            <th><input type="number" id="total_gravadas" class="form-control" value="0" readonly></th>
                            <th><input type="number" id="total_debito_fiscal" class="form-control" value="0" readonly></th>
                            <th><input type="number" id="total_terceros_exentas" class="form-control" value="0" readonly></th>
                            <th><input type="number" id="total_terceros_gravadas" class="form-control" value="0" readonly></th>
                            <th><input type="number" id="total_general" class="form-control" value="0" readonly></th>
                            <th><input type="number" id="total_iva_retenido" class="form-control" value="0" readonly></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>
            <br><br>
            <input type="submit" class="btn btn-success" value="Guardar">
        </form>
    </div>
</div>

<script>
function agregarFila() {
    const tabla = document.getElementById('tabla_ventas');
    const fila = document.createElement('tr');
    fila.innerHTML = `
        <td>${tabla.rows.length + 1}</td>
        <td><input type="text" class="form-control" name="dia[]" required></td>
        <td><input type="text" class="form-control" name="correlativo[]" required></td>
        <td><input type="text" class="form-control" name="nombre_cliente[]" required></td>
        <td><input type="text" class="form-control" name="nrc_cliente[]"></td>
        <td><input type="number" class="form-control sumable" name="propias_exentas[]" step="0.01" onchange="actualizarTotales()"></td>
        <td><input type="number" class="form-control sumable" name="propias_gravadas[]" step="0.01" onchange="actualizarTotales()"></td>
        <td><input type="number" class="form-control" name="debito_fiscal[]" step="0.01" readonly></td>
        <td><input type="number" class="form-control sumable" name="terceros_exentas[]" step="0.01" onchange="actualizarTotales()"></td>
        <td><input type="number" class="form-control sumable" name="terceros_gravadas[]" step="0.01" onchange="actualizarTotales()"></td>
        <td><input type="number" class="form-control" name="total[]" step="0.01" readonly></td>
        <td><input type="number" class="form-control sumable" name="iva_retenido[]" step="0.01" onchange="actualizarTotales()"></td>
        <td><button type="button" class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button></td>
    `;
    tabla.appendChild(fila);
    actualizarTotales();
}

function eliminarFila(boton) {
    const fila = boton.parentNode.parentNode;
    fila.parentNode.removeChild(fila);
    actualizarTotales();
}

function actualizarTotales() {
    let totalExentas = 0;
    let totalGravadas = 0;
    let totalDebitoFiscal = 0;
    let totalTercerosExentas = 0;
    let totalTercerosGravadas = 0;
    let totalGeneral = 0;
    let totalIvaRetenido = 0;

    const filas = document.querySelectorAll('#tabla_ventas tr');
    filas.forEach(fila => {
        const propiasExentas = parseFloat(fila.querySelector('input[name="propias_exentas[]"]').value) || 0;
        const propiasGravadas = parseFloat(fila.querySelector('input[name="propias_gravadas[]"]').value) || 0;
        const tercerosExentas = parseFloat(fila.querySelector('input[name="terceros_exentas[]"]').value) || 0;
        const tercerosGravadas = parseFloat(fila.querySelector('input[name="terceros_gravadas[]"]').value) || 0;
        const ivaRetenido = parseFloat(fila.querySelector('input[name="iva_retenido[]"]').value) || 0;

        const debitoFiscal = propiasGravadas * 0.13; // Suponiendo un IVA del 13%
        const total = propiasExentas + propiasGravadas + tercerosExentas + tercerosGravadas;

        fila.querySelector('input[name="debito_fiscal[]"]').value = debitoFiscal.toFixed(2);
        fila.querySelector('input[name="total[]"]').value = total.toFixed(2);

        totalExentas += propiasExentas;
        totalGravadas += propiasGravadas;
        totalDebitoFiscal += debitoFiscal;
        totalTercerosExentas += tercerosExentas;
        totalTercerosGravadas += tercerosGravadas;
        totalGeneral += total;
        totalIvaRetenido += ivaRetenido;
    });

    // Actualizar totales en la fila de totales
    document.getElementById('total_exentas').value = totalExentas.toFixed(2);
    document.getElementById('total_gravadas').value = totalGravadas.toFixed(2);
    document.getElementById('total_debito_fiscal').value = totalDebitoFiscal.toFixed(2);
    document.getElementById('total_terceros_exentas').value = totalTercerosExentas.toFixed(2);
    document.getElementById('total_terceros_gravadas').value = totalTercerosGravadas.toFixed(2);
    document.getElementById('total_general').value = totalGeneral.toFixed(2);
    document.getElementById('total_iva_retenido').value = totalIvaRetenido.toFixed(2);
}
</script>

<?php include '../layouts/footer.php'?>
</body>
</html>
