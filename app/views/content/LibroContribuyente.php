<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Ventas a Contribuyentes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>LIBRO DE VENTAS A CONTRIBUYENTES</h1>

<form action="../../controllers/procesar_libro.php" method="POST">
    <table>
        <tr>
            <td>Nombre del Contribuyente:</td>
            <td><input type="text" name="nombre_contribuyente" required></td>
            <td>NRC:</td>
            <td><input type="text" name="nrc" required></td>
        </tr>
        <tr>
            <td>Mes:</td>
            <td><input type="text" name="mes" required></td>
            <td>Año:</td>
            <td><input type="text" name="anio" value="2024" required></td>
        </tr>
    </table>

    <h2>Operaciones de Ventas Propias y a Cuenta de Terceros</h2>
    <table>
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

    <button type="button" onclick="agregarFila()">Agregar Fila</button>
    <br><br>
    <input type="submit" value="Guardar">
</form>

<script>
function agregarFila() {
    const tabla = document.getElementById('tabla_ventas');
    const fila = document.createElement('tr');
    fila.innerHTML = `
        <td>${tabla.rows.length + 1}</td>
        <td><input type="text" name="dia[]" required></td>
        <td><input type="text" name="correlativo[]" required></td>
        <td><input type="text" name="nombre_cliente[]" required></td>
        <td><input type="text" name="nrc_cliente[]"></td>
        <td><input type="number" name="propias_exentas[]" step="0.01"></td>
        <td><input type="number" name="propias_gravadas[]" step="0.01"></td>
        <td><input type="number" name="debito_fiscal[]" step="0.01"></td>
        <td><input type="number" name="terceros_exentas[]" step="0.01"></td>
        <td><input type="number" name="terceros_gravadas[]" step="0.01"></td>
        <td><input type="number" name="total[]" step="0.01"></td>
        <td><input type="number" name="iva_retenido[]" step="0.01"></td>
        <td><button type="button" onclick="eliminarFila(this)">Eliminar</button></td>
    `;
    tabla.appendChild(fila);
}

function eliminarFila(boton) {
    const fila = boton.parentNode.parentNode; // Obtiene la fila que contiene el botón
    fila.parentNode.removeChild(fila); // Elimina la fila
}
</script>

</body>
</html>
