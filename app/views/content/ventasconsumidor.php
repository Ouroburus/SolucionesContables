<?php
require_once '../../controllers/ControllVCF.php';

$controlador = new VentasControlador();

// Manejar la inserción de venta
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Guardar los datos, se supone que los datos se envían desde el formulario
    $mensaje = $controlador->guardarVenta(); // Asegúrate de que tu método guarda correctamente
}

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
<?php include 'app/views/layouts/header.php'?>
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
        <table>
    <tr>
        <td>Fecha:</td>
        <td><input type="date" name="fecha" id="fecha"></td>
        <td>Documento Inicio:</td>
        <td><input type="text" name="documento_inicio" id="documento_inicio"></td>
    </tr>
    <tr>
        <td>Documento Final:</td>
        <td><input type="text" name="documento_final" id="documento_final"></td>
        <td>Nº CAJA O SIST. COMPUTARIZADO:</td>
        <td><input type="text" name="nro_caja" id="nro_caja"></td>
    </tr>
    <tr>
        <td>Ventas Exentas:</td>
        <td><input type="number" step="0.01" name="ventas_exentas" id="ventas_exentas"></td>
        <td>Ventas Internas Gravadas:</td>
        <td><input type="number" step="0.01" name="ventas_gravadas" id="ventas_gravadas"></td>
    </tr>
    <tr>
        <td>Exportaciones:</td>
        <td><input type="number" step="0.01" name="exportaciones" id="exportaciones"></td>
        <td>Total Ventas Diarias Propias:</td>
        <td><input type="number" step="0.01" name="total_ventas_diarias" id="total_ventas_diarias" readonly></td>
    </tr>
    <tr>
        <td>Venta a Cuentas de Terceros:</td>
        <td><input type="number" step="0.01" name="venta_cuenta_terceros" id="venta_cuenta_terceros"></td>
    </tr>
</table>


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
            </table>
            <div class="row mb-3">
                <label for="total_acumulado_ventas_diarias" class="col-sm-2 col-form-label">Total Acumulado Ventas Diarias</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" class="form-control" id="total_acumulado_ventas_diarias" readonly>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mt-3" onclick="agregarFila()">Agregar Fila</button>
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
    <?php include 'app/views/layouts/footer.php'?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let filaEditada = null; // Para almacenar la fila que se está editando

    function actualizarTotalVentasDiarias() {
        // Obtiene el valor de ventas gravadas e inserta en total ventas diarias
        const ventasGravadas = parseFloat(document.getElementById('ventas_gravadas').value) || 0;
        document.getElementById('total_ventas_diarias').value = ventasGravadas;
    }

    function agregarFila() {
        const tabla = document.getElementById('tabla_ventas');
        const fila = document.createElement('tr');

        const fecha = document.getElementById('fecha').value;
        const documentoInicio = document.getElementById('documento_inicio').value;
        const documentoFinal = document.getElementById('documento_final').value;
        const nroCaja = document.getElementById('nro_caja').value;
        const ventasExentas = document.getElementById('ventas_exentas').value;
        const ventasGravadas = document.getElementById('ventas_gravadas').value;
        const exportaciones = document.getElementById('exportaciones').value;
        const totalVentasDiarias = ventasGravadas; // Valor bloqueado
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

        limpiarFormulario();
    }

    function limpiarFormulario() {
        document.getElementById('fecha').value = '';
        document.getElementById('documento_inicio').value = '';
        document.getElementById('documento_final').value = '';
        document.getElementById('nro_caja').value = '';
        document.getElementById('ventas_exentas').value = '';
        document.getElementById('ventas_gravadas').value = '';
        document.getElementById('exportaciones').value = '';
        document.getElementById('total_ventas_diarias').value = ''; // Valor bloqueado
        document.getElementById('venta_cuenta_terceros').value = ''; // Nuevo campo
    }

    function eliminarFila(boton) {
        const fila = boton.parentNode.parentNode;
        fila.parentNode.removeChild(fila);
    }

    function editarFila(boton) {
        const fila = boton.parentNode.parentNode;

        document.getElementById('fecha').value = fila.cells[1].innerText;
        document.getElementById('documento_inicio').value = fila.cells[2].innerText;
        document.getElementById('documento_final').value = fila.cells[3].innerText;
        document.getElementById('nro_caja').value = fila.cells[4].innerText;
        document.getElementById('ventas_exentas').value = fila.cells[5].innerText;
        document.getElementById('ventas_gravadas').value = fila.cells[6].innerText;
        document.getElementById('exportaciones').value = fila.cells[7].innerText;
        document.getElementById('total_ventas_diarias').value = fila.cells[8].innerText; // Valor bloqueado
        document.getElementById('venta_cuenta_terceros').value = fila.cells[9].innerText; // Nuevo campo

        filaEditada = fila;
    }

    function agregarDatosATabla() {
        const tabla = document.getElementById('tabla_ventas');
        const datosTabla = [];

        for (let i = 0; i < tabla.rows.length; i++) {
            const fila = tabla.rows[i];
            datosTabla.push({
                fecha: fila.cells[1].innerText,
                documento_inicio: fila.cells[2].innerText,
                documento_final: fila.cells[3].innerText,
                nro_caja: fila.cells[4].innerText,
                ventas_exentas: fila.cells[5].innerText,
                ventas_gravadas: fila.cells[6].innerText,
                exportaciones: fila.cells[7].innerText,
                total_ventas_diarias: fila.cells[8].innerText,
                venta_cuenta_terceros: fila.cells[9].innerText // Nuevo campo
            });
        }

        console.log(datosTabla);
        return false; // Evita la recarga de la página
    }
    </script>
</body>
</html>