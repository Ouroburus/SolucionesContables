<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí puedes llamar a la función que está en procesar_libro.php para procesar los datos
    require_once('../../controllers/procesar_libro.php');
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
<?php include 'app/views/layouts/header.php'?>
<div class="container-fluid">
    <h1 class="mt-5">LIBRO DE VENTAS A CONTRIBUYENTES</h1>

    <div class="contenido">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                </table>
            </div>

            <button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>
            <br><br>
            <input type="submit" class="btn btn-success" value="Guardar">
        </form>
    </div>
</div>
<?php include 'app/views/layouts/footer.php'?>
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
        <td><input type="number" class="form-control" name="propias_exentas[]" step="0.01"></td>
        <td><input type="number" class="form-control" name="propias_gravadas[]" step="0.01"></td>
        <td><input type="number" class="form-control" name="debito_fiscal[]" step="0.01"></td>
        <td><input type="number" class="form-control" name="terceros_exentas[]" step="0.01"></td>
        <td><input type="number" class="form-control" name="terceros_gravadas[]" step="0.01"></td>
        <td><input type="number" class="form-control" name="total[]" step="0.01"></td>
        <td><input type="number" class="form-control" name="iva_retenido[]" step="0.01"></td>
        <td><button type="button" class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button></td>
    `;
    tabla.appendChild(fila);
}

function eliminarFila(boton) {
    const fila = boton.parentNode.parentNode; // Obtiene la fila que contiene el botón
    fila.parentNode.removeChild(fila); // Elimina la fila
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
