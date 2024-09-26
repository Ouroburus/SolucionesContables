<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Ventas a Consumidores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
        .right {
            text-align: right;
        }
    </style>
</head>
<body>

<h1>LIBRO DE VENTAS A CONSUMIDORES</h1>

<table>
    <thead>
        <tr>
            <th colspan="5">CONTRIBUYENTE:</th>
            <th>MES:</th>
            <th>AÑO:</th>
            <th>NRC:</th>
        </tr>
        <tr>
            <th>Día</th>
            <th>Documento Emitido</th>
            <th>No. CAJA o SIST. COMPUTARIZADO</th>
            <th>Ventas Exentas</th>
            <th>Ventas Internas Gravadas</th>
            <th>Exportaciones</th>
            <th>Total Vtas. Diarias Propias</th>
            <th>Ventas a Cuenta de Terceros</th>
        </tr>
    </thead>
    <tbody>
        <!-- Ejemplo de fila vacía -->
        <?php
        // Generar filas para los días del mes (agosto de ejemplo con 31 días)
        for ($day = 1; $day <= 31; $day++) {
            echo "<tr>";
            echo "<td>$day/9/2024</td>";
            echo "<td></td>"; // Documento emitido
            echo "<td></td>"; // No. CAJA o SIST. COMPUTARIZADO
            echo "<td></td>"; // Ventas Exentas
            echo "<td></td>"; // Ventas Internas Gravadas
            echo "<td></td>"; // Exportaciones
            echo "<td></td>"; // Total Vtas. Diarias Propias
            echo "<td></td>"; // Ventas a Cuenta de Terceros
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<button type="button" onclick="agregarfila()">Agregar Fila</button>
<br><br>
<input type="submit" value="Guardar">

<script>
    function agregarfila() {
        const tabla = documento.getElementById('tabla_ventas');
        const fila = documento.createElement('tr');
        fila.innerHTML = `
        <td>${tabla.rows.length + 1}</td
        <td><input type="text" name="dia[]></td>
        <td><input type="text" name="correlativo[]></td>
        <td><input type="text" name="nombre_cliente[]></td>
        <td><input type="text" name="nrc_cliente[]></td>
        <td><input type="text" name="propias_exentas[]></td>
        <td><input type="text" name="propias_gravadas[]></td>
        <td><input type="text" name="debito_fiscal[]></td>
        <td><input type="text" name="terceros_exentas]></td>
        <td><input type="text" name="terceros_gravadas[]></td>
        <td><input type="text" name="total[]></td>
        <td><input type="text" name="iva_retenido[]></td>
    `;
      tabla.appendChild(file)  
    }
</script>

<h2>DETERMINACIÓN DEL DÉBITO FISCAL</h2>
<table>
    <tr>
        <td>Venta Neta</td>
        <td>$</td>
    </tr>
    <tr>
        <td>Débito Fiscal</td>
        <td>$</td>
    </tr>
    <tr>
        <td>Total</td>
        <td>$</td>
    </tr>
</table>

<p>Nombre de la persona que realizó las anotaciones: <strong>Iliana Jasmin Jacobo</strong>, Firma: ___________________</p>

</body>
</html>

