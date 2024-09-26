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

<form action="procesar_libro.php" method="POST">
    <table>
        <tr>
            <td>Nombre del Contribuyente:</td>
            <td><input type="text" name="nombre_contribuyente"></td>
            <td>NRC:</td>
            <td><input type="text" name="nrc"></td>
        </tr>
        <tr>
            <td>Mes:</td>
            <td><input type="text" name="mes"></td>
            <td>Año:</td>
            <td><input type="text" name="anio" value="2024"></td>
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
            </tr>
        </thead>
        <tbody id="tabla_ventas">
            <!-- Aquí se generarán las filas dinámicamente -->
            <tr>
                <td>1</td>
                <td><input type="text" name="dia[]"></td>
                <td><input type="text" name="correlativo[]"></td>
                <td><input type="text" name="nombre_cliente[]"></td>
                <td><input type="text" name="nrc_cliente[]"></td>
                <td><input type="text" name="propias_exentas[]"></td>
                <td><input type="text" name="propias_gravadas[]"></td>
                <td><input type="text" name="debito_fiscal[]"></td>
                <td><input type="text" name="terceros_exentas[]"></td>
                <td><input type="text" name="terceros_gravadas[]"></td>
                <td><input type="text" name="total[]"></td>
                <td><input type="text" name="iva_retenido[]"></td>
            </tr>
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
            <td><input type="text" name="dia[]"></td>
            <td><input type="text" name="correlativo[]"></td>
            <td><input type="text" name="nombre_cliente[]"></td>
            <td><input type="text" name="nrc_cliente[]"></td>
            <td><input type="text" name="propias_exentas[]"></td>
            <td><input type="text" name="propias_gravadas[]"></td>
            <td><input type="text" name="debito_fiscal[]"></td>
            <td><input type="text" name="terceros_exentas[]"></td>
            <td><input type="text" name="terceros_gravadas[]"></td>
            <td><input type="text" name="total[]"></td>
            <td><input type="text" name="iva_retenido[]"></td>
        `;
        tabla.appendChild(fila);
    }
</script>

</body>
</html>
