<?php
require "../../controllers/save_data.php";
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
       
        .contenido {
            padding: 0px;
        }
        .datos-agregados {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php include '../layouts/header.php'?>
<div class="container-fluid">
    <h1 class="mt-5">Libro de Compras</h1>
    <div class="row">
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
                        <th>Importaciones/Exportaciones Exentas</th>
                        <th>Compras Gravadas</th>
                        <th>Importaciones/Exportaciones Gravadas</th>
                        <th>Crédito Fiscal</th>
                        <th>IVA Percibido</th>
                        <th>Total Compras</th>
                        <th>Compras a Sujetos Excluidos</th>
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
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="text" class="form-control" readonly></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="text" class="form-control" readonly></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="text-end">Totales:</td>
                        <td id="totalComprasExentas">0.00</td>
                        <td id="totalImportExentas">0.00</td>
                        <td id="totalComprasGravadas">0.00</td>
                        <td id="totalImportGravadas">0.00</td>
                        <td id="totalCreditoFiscal">0.00</td>
                        <td id="totalIvaPercibido">0.00</td>
                        <td id="totalCompras">0.00</td>
                        <td id="totalComprasExcluidas">0.00</td>
                    </tr>
                </tfoot>
            </table>
            <button class="btn btn-primary" id="addRowBtn">Agregar Fila</button>
            <button class="btn btn-success" id="saveDataBtn">Guardar Datos</button>
            
            <div class="datos-agregados">
                <h3>Datos Agregados:</h3>
                <table class="table table-bordered" id="vistaDatosAgregados">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Emisión</th>
                            <th>Número Documento</th>
                            <th>NIT o DUI</th>
                            <th>NRC</th>
                            <th>Nombre del Proveedor</th>
                            <th>Compras Exentas</th>
                            <th>Importaciones/Exportaciones Exentas</th>
                            <th>Compras Gravadas</th>
                            <th>Importaciones/Exportaciones Gravadas</th>
                            <th>Crédito Fiscal</th>
                            <th>IVA Percibido</th>
                            <th>Total Compras</th>
                            <th>Compras a Sujetos Excluidos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include '../layouts/footer.php'?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let rowCount = 1;

            function updateTotals() {
                let totalComprasExentas = 0;
                let totalImportExentas = 0;
                let totalComprasGravadas = 0;
                let totalImportGravadas = 0;
                let totalCreditoFiscal = 0;
                let totalIvaPercibido = 0;
                let totalCompras = 0;
                let totalComprasExcluidas = 0;

                $('#vistaDatosAgregados tbody tr').each(function() {
                    totalComprasExentas += parseFloat($(this).find('td').eq(6).text()) || 0;
                    totalImportExentas += parseFloat($(this).find('td').eq(7).text()) || 0;
                    totalComprasGravadas += parseFloat($(this).find('td').eq(8).text()) || 0;
                    totalImportGravadas += parseFloat($(this).find('td').eq(9).text()) || 0;
                    totalCreditoFiscal += parseFloat($(this).find('td').eq(10).text()) || 0;
                    totalIvaPercibido += parseFloat($(this).find('td').eq(11).text()) || 0;
                    totalCompras += parseFloat($(this).find('td').eq(12).text()) || 0;
                    totalComprasExcluidas += parseFloat($(this).find('td').eq(13).text()) || 0;
                });

                $('#totalComprasExentas').text(totalComprasExentas.toFixed(2));
                $('#totalImportExentas').text(totalImportExentas.toFixed(2));
                $('#totalComprasGravadas').text(totalComprasGravadas.toFixed(2));
                $('#totalImportGravadas').text(totalImportGravadas.toFixed(2));
                $('#totalCreditoFiscal').text(totalCreditoFiscal.toFixed(2));
                $('#totalIvaPercibido').text(totalIvaPercibido.toFixed(2));
                $('#totalCompras').text(totalCompras.toFixed(2));
                $('#totalComprasExcluidas').text(totalComprasExcluidas.toFixed(2));
            }

            $('#addRowBtn').click(function() {
                let currentRow = $('#libroComprasTable tbody tr').last();
                let comprasExentas = parseFloat(currentRow.find('input').eq(5).val()) || 0;
                let importExentas = parseFloat(currentRow.find('input').eq(6).val()) || 0;
                let comprasGravadas = parseFloat(currentRow.find('input').eq(7).val()) || 0;
                let importGravadas = parseFloat(currentRow.find('input').eq(8).val()) || 0;
                let creditoFiscal = (comprasGravadas + importGravadas) * 0.13;
                let totalCompras = comprasExentas + importExentas + comprasGravadas + importGravadas + creditoFiscal;

                let newRow = `<tr>
                    <td>${rowCount}</td>
                    <td>${currentRow.find('input').eq(0).val()}</td>
                    <td>${currentRow.find('input').eq(1).val()}</td>
                    <td>${currentRow.find('input').eq(2).val()}</td>
                    <td>${currentRow.find('input').eq(3).val()}</td>
                    <td>${currentRow.find('input').eq(4).val()}</td>
                    <td>${comprasExentas.toFixed(2)}</td>
                    <td>${importExentas.toFixed(2)}</td>
                    <td>${comprasGravadas.toFixed(2)}</td>
                    <td>${importGravadas.toFixed(2)}</td>
                    <td>${creditoFiscal.toFixed(2)}</td>
                    <td>${parseFloat(currentRow.find('input').eq(9).val() || 0).toFixed(2)}</td>
                    <td>${totalCompras.toFixed(2)}</td>
                    <td>${parseFloat(currentRow.find('input').eq(11).val() || 0).toFixed(2)}</td>
                    <td><button class="btn btn-danger btn-sm deleteRowBtn">Eliminar</button></td>
                </tr>`;
                $('#vistaDatosAgregados tbody').append(newRow);
                rowCount++;
                updateTotals();
            });

            $('#vistaDatosAgregados').on('click', '.deleteRowBtn', function() {
                $(this).closest('tr').remove();
                updateTotals();
            });
        });
    </script>
</body>
</html>
