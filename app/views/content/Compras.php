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
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Libro de Compras</h1>
    <?php include "../layouts/MenuLateral.php"; ?>
    
    <div class="">
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
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                </tr>`;
                $('#libroComprasTable tbody').append(newRow);
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
                    row['compras_exentas'] = $(this).find('input').eq(5).val();
                    row['compras_gravadas'] = $(this).find('input').eq(6).val();
                    row['credito_fiscal'] = $(this).find('input').eq(7).val();
                    row['iva_percibido'] = $(this).find('input').eq(8).val();
                    row['total_compras'] = $(this).find('input').eq(9).val();
                    row['compras_excluidos'] = $(this).find('input').eq(10).val();
                    rows.push(row);
                });

                // Enviar los datos al servidor
                $.ajax({
                    url: 'save_data.php',  // Archivo PHP que procesará los datos
                    method: 'POST',
                    data: { rows: rows },
                    success: function(response) {
                        alert('Datos guardados con éxito: ' + response);
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
