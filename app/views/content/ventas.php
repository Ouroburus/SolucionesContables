<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Libro de Compras</h1>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        let rowCount = 1;

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
    });
</script>

</body>
</html>
