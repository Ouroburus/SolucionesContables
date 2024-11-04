<?php
require "../../controllers/CCompras.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .menu-lateral {
            background-color: #ffffff;
            border-right: 0px solid #dee2e6;
        }
        .contenido {
            padding: 10px;
        }
        .datos-agregados {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <h1 class="mt-5">Libro de Compras</h1>
    <div class="row">

            <?php include "../layouts/Header.php"; ?>

        <div class="col-md-9 contenido">
            <table class="table table-bordered mt-4" id="libroComprasTable">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Emisión</th>
                        <th>Número Documento</th>
                        <th>NIT o DUI</th>
                        <th>NRC</th>
                        <th>Nombre del Proveedor</th>
                        <th>Compras Exentas</th>
                        <th>Compras Gravadas</th>
                        <th>Crédito Fiscal</th>
                        <th>IVA Percibido</th>
                        <th>Total Compras</th>
                        <th>Compras a Sujetos Excluidos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><input type="date" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="number" class="form-control exentas" value="0"></td>
                        <td><input type="number" class="form-control gravadas" value="0"></td>
                        <td><input type="text" class="form-control credito-fiscal" value="0" readonly></td>
                        <td><input type="text" class="form-control iva-percibido" value="0" ></td>
                        <td><input type="text" class="form-control total-compras" value="0" readonly></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-danger removeRowBtn">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" id="addRowBtn">Agregar Fila</button>
            <button class="btn btn-success" id="saveDataBtn">Guardar Datos</button>
            
            <!-- Sección para mostrar los totales -->
            <div class="datos-agregados">
                <h3>Totales:</h3>
                <table class="table table-bordered" id="totalesTable">
                    <thead>
                        <tr>
                            <th>Compras Exentas</th>
                            <th>Compras Gravadas</th>
                            <th>Crédito Fiscal Total</th>
                            <th>IVA Percibido Total</th>
                            <th>Total Compras Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="totalExentas">0</td>
                            <td id="totalGravadas">0</td>
                            <td id="totalCreditoFiscal">0</td>
                            <td id="totalIva">0</td>
                            <td id="totalCompras">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let rowCount = 1;

            // Función para agregar una nueva fila a la tabla
            $('#addRowBtn').click(function() {
                rowCount++;
                let newRow = `<tr>
                    <td>${rowCount}</td>
                    <td><input type="date" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="number" class="form-control exentas" value="0"></td>
                    <td><input type="number" class="form-control gravadas" value="0"></td>
                    <td><input type="text" class="form-control credito-fiscal" value="0" readonly></td>
                    <td><input type="text" class="form-control iva-percibido" value="0" readonly></td>
                    <td><input type="text" class="form-control total-compras" value="0" readonly></td>
                    <td><input type="text" class="form-control" value="0"></td>
                    <td><button class="btn btn-danger removeRowBtn">Eliminar</button></td>
                </tr>`;
                $('#libroComprasTable tbody').append(newRow);
                calculateTotals();
            });

            // Función para calcular totales
            function calculateTotals() {
                let totalExentas = 0;
                let totalGravadas = 0;
                let totalCreditoFiscal = 0;
                let totalIva = 0;
                let totalCompras = 0;

                $('#libroComprasTable tbody tr').each(function() {
                    let exentas = parseFloat($(this).find('.exentas').val()) || 0;
                    let gravadas = parseFloat($(this).find('.gravadas').val()) || 0;

                    // Calcular Crédito Fiscal y IVA
                    let creditoFiscal = gravadas * 0.13; // Ejemplo: 15% de crédito fiscal
                    let iva = gravadas * 0.13; // Ejemplo: 15% de IVA
                    let percivido = gravadas * 0.01;
                    $(this).find('.credito-fiscal').val(creditoFiscal.toFixed(2));
                    $(this).find('.iva-percibido').val(percivido.toFixed(2));

                    // Calcular Total Compras
                    let total = exentas + gravadas + creditoFiscal + iva;
                    $(this).find('.total-compras').val(total.toFixed(2));

                    // Sumar a totales
                    totalExentas += exentas;
                    totalGravadas += gravadas;
                    totalCreditoFiscal += creditoFiscal;
                    totalIva += percivido;
                    totalCompras += total;
                });

                // Actualizar los totales en la tabla
                $('#totalExentas').text(totalExentas.toFixed(2));
                $('#totalGravadas').text(totalGravadas.toFixed(2));
                $('#totalCreditoFiscal').text(totalCreditoFiscal.toFixed(2));
                $('#totalIva').text(totalIva.toFixed(2));
                $('#totalCompras').text(totalCompras.toFixed(2));
            }

            // Al modificar los campos de exentas y gravadas
            $(document).on('input', '.exentas, .gravadas', function() {
                calculateTotals();
            });

            // Función para eliminar la fila
            $(document).on('click', '.removeRowBtn', function() {
                $(this).closest('tr').remove();
                calculateTotals();
            });

            // Función para guardar los datos de la tabla
            $('#saveDataBtn').click(function() {
                let rows = [];

                $('#libroComprasTable tbody tr').each(function() {
                    let row = {};
                    row['num'] = $(this).find('td').eq(0).text();
                    row['emision'] = $(this).find('input').eq(0).val();
                    row['numero_documento'] = $(this).find('input').eq(1).val();
                    row['nit_dui'] = $(this).find('input').eq(2).val();
                    row['nrc'] = $(this).find('input').eq(3).val();
                    row['nombre_proveedor'] = $(this).find('input').eq(4).val();
                    row['compras_exentas'] = $(this).find('.exentas').val();
                    row['compras_gravadas'] = $(this).find('.gravadas').val();
                    row['credito_fiscal'] = $(this).find('.credito-fiscal').val();
                    row['iva_percibido'] = $(this).find('.iva-percibido').val();
                    row['total_compras'] = $(this).find('.total-compras').val();
                    row['compras_sujetos_excluidos'] = $(this).find('input').eq(10).val();
                    rows.push(row);
                });

                $.ajax({
                    url: '../../controllers/CCompras.php',
                    method: 'POST',
                    data: { rows: rows },
                    success: function(response) {
                        alert('Datos guardados con éxito: ' + response);

                        // Limpiar la vista de datos agregados
                        $('#vistaDatosAgregados tbody').empty();
                    },
                    error: function() {
                        alert('Error al guardar los datos.');
                    }
                });
            });
        });
    </script>

<?php include '../layouts/footer.php'?>
</body>
</html>
