<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Ventas a Consumidores</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .header, .header td {
            border: none;
            text-align: left;
        }
        .header td {
            padding: 2px;
        }
        .total {
            font-weight: bold;
        }
        .signature {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Encabezado principal -->
    <h2 style="text-align: center;">LIBRO DE VENTAS A CONSUMIDORES</h2>

    <!-- Información del contribuyente -->
    <table class="header">
        <tr>
            <td>CONTRIBUYENTE:</td>
            <td style="border-bottom: 1px solid black;"></td>
            <td></td>
            <td>AÑO:</td>
            <td style="border-bottom: 1px solid black;"></td>
            <td>NRC:</td>
            <td style="border-bottom: 1px solid black;"></td>
        </tr>
    </table>

    <!-- Tabla de ventas -->
    <table>
        <tr>
            <th>DÍA</th>
            <th colspan="2">DOCUMENTO EMITIDO</th>
            <th>VENTAS EXENTAS</th>
            <th>VENTAS INTERNAS GRAVADAS</th>
            <th>EXPORTACIONES</th>
            <th>TOTAL VTAS. DIARIAS PROPIAS</th>
            <th>VENTAS A CUENTA DE TERCEROS</th>
        </tr>
        <tr>
            <td></td>
            <td>DEL N°</td>
            <td>AL N°</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <?php
        // Aquí puedes agregar un ciclo para mostrar cada día del mes
        for ($i = 1; $i <= 31; $i++) {
            echo "<tr>
                    <td>8/$i/2024</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
        }
        ?>

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
    <!-- Determinación del débito fiscal -->
    <table>
        <tr>
            <td class="total">DETERMINACIÓN DEL DÉBITO FISCAL</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>VENTA NETA</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>DÉBITO FISCAL</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- Firma -->
    <div class="signature">
        <p>NOMBRE DE LA PERSONA QUE REALIZÓ LAS ANOTACIONES: Iliana Jasmin Jacobo, FIRMA: ___________</p>
    </div>
</body>
</html>
