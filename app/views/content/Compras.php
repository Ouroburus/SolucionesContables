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
        <div class="col-md-3 menu-lateral">
            <?php include "../layouts/MenuLateral.php"; ?>
        </div>
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
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                        <td><input type="text" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" id="addRowBtn">Agregar Fila</button>
            <button class="btn btn-success" id="saveDataBtn">Guardar Datos</button>
            
            <!-- Sección para mostrar las filas agregadas -->
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
                            <th>Compras Gravadas</th>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let rowCount = 1;

            // Función para agregar una nueva fila a la tabla
            $('#addRowBtn').click(function() {
                let currentRow = $('#libroComprasTable tbody tr').last();
                let row = {
                    'num': rowCount,
                    'emision': currentRow.find('input').eq(0).val(),
                    'numero_documento': currentRow.find('input').eq(1).val(),
                    'nit_dui': currentRow.find('input').eq(2).val(),
                    'nrc': currentRow.find('input').eq(3).val(),
                    'nombre_proveedor': currentRow.find('input').eq(4).val(),
                    'compras_exentas': currentRow.find('input').eq(5).val(),
                    'compras_gravadas': currentRow.find('input').eq(6).val(),
                    'credito_fiscal': currentRow.find('input').eq(7).val(),
                    'iva_percibido': currentRow.find('input').eq(8).val(),
                    'total_compras': currentRow.find('input').eq(9).val(),
                    'compras_excluidos': currentRow.find('input').eq(10).val()
                };

                // Agregar los datos a la vista de datos agregados con botones de acción
                let newRow = `<tr>
                    <td>${row['num']}</td>
                    <td>${row['emision']}</td>
                    <td>${row['numero_documento']}</td>
                    <td>${row['nit_dui']}</td>
                    <td>${row['nrc']}</td>
                    <td>${row['nombre_proveedor']}</td>
                    <td>${row['compras_exentas']}</td>
                    <td>${row['compras_gravadas']}</td>
                    <td>${row['credito_fiscal']}</td>
                    <td>${row['iva_percibido']}</td>
                    <td>${row['total_compras']}</td>
                    <td>${row['compras_excluidos']}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-row">Editar</button>
                        <button class="btn btn-danger btn-sm delete-row">Eliminar</button>
                    </td>
                </tr>`;
                $('#vistaDatosAgregados tbody').append(newRow);

                // Limpiar los inputs de la fila actual
                currentRow.find('input').val('');

                rowCount++;
            });

            // Función para eliminar una fila de la vista de datos agregados
            $(document).on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
            });

            // Función para editar una fila de la vista de datos agregados
            $(document).on('click', '.edit-row', function() {
                let row = $(this).closest('tr');
                
                // Pasar los datos de la fila a los inputs del formulario para edición
                $('#libroComprasTable tbody tr').last().find('input').eq(0).val(row.find('td').eq(1).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(1).val(row.find('td').eq(2).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(2).val(row.find('td').eq(3).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(3).val(row.find('td').eq(4).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(4).val(row.find('td').eq(5).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(5).val(row.find('td').eq(6).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(6).val(row.find('td').eq(7).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(7).val(row.find('td').eq(8).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(8).val(row.find('td').eq(9).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(9).val(row.find('td').eq(10).text());
                $('#libroComprasTable tbody tr').last().find('input').eq(10).val(row.find('td').eq(11).text());
                
                // Remover la fila editada de la vista de datos agregados
                row.remove();
            });

            // Función para guardar los datos de la tabla y limpiar la vista
            $('#saveDataBtn').click(function() {
                let rows = [];

                $('#vistaDatosAgregados tbody tr').each(function() {
                    let row = {};
                    row['num'] = $(this).find('td').eq(0).text();
                    row['emision'] = $(this).find('td').eq(1).text();
                    row['numero_documento'] = $(this).find('td').eq(2).text();
                    row['nit_dui'] = $(this).find('td').eq(3).text();
                    row['nrc'] = $(this).find('td').eq(4).text();
                    row['nombre_proveedor'] = $(this).find('td').eq(5).text();
                    row['compras_exentas'] = $(this).find('td').eq(6).text();
                    row['compras_gravadas'] = $(this).find('td').eq(7).text();
                    row['credito_fiscal'] = $(this).find('td').eq(8).text();
                    row['iva_percibido'] = $(this).find('td').eq(9).text();
                    row['total_compras'] = $(this).find('td').eq(10).text();
                    row['compras_excluidos'] = $(this).find('td').eq(11).text();
                    rows.push(row);
                });

                // Enviar los datos al servidor
                $.ajax({
                    url: '../../controllers/save_data.php',
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
</div>
</body>
</html>