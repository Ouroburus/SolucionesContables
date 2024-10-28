<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Diario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Libro Registro Diario</h3>
    
    <div class="row mb-3">
        <div class="col-md-4">
            <p><strong>COMPUCARU</strong></p>
            <p>NIT: 0210-021120-102-4</p>
        </div>
        <div class="col-md-4 text-center">
            <p><strong>COMPROBANTE DIARIO N° 01</strong></p>
        </div>
        <div class="col-md-4 text-end">
            <p><strong>Fecha: 02-11-2020</strong></p>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped" id="tablaCuentas">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cuenta Contable</th>
                <th>Parcial</th>
                <th>Debe</th>
                <th>Haber</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>111</td>
                <td>Efectivo y Equivalentes de Efectivo</td>
                <td>$100,000.00</td>
                <td>$100,000.00</td>
                <td></td>
            </tr>
            <tr>
                <td>115</td>
                <td>Accionistas</td>
                <td>$100,000.00</td>
                <td></td>
                <td>$100,000.00</td>
            </tr>
            
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>$200,000.00</th>
                <th>$200,000.00</th>
            </tr>
        </tfoot>
    </table>

    <div class="text-end">
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCatalogo">Catálogo</button>
        <button class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>
    </div>

    
    <div class="modal fade" id="modalCatalogo" tabindex="-1" aria-labelledby="catalogoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catalogoModalLabel">Catálogo de Cuentas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Cuenta</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>111</td>
                                <td>Efectivo y Equivalentes de Efectivo</td>
                                <td><button class="btn btn-sm btn-success" onclick="seleccionarCuenta('111', 'Efectivo y Equivalentes de Efectivo')">Seleccionar</button></td>
                            </tr>
                            <tr>
                                <td>115</td>
                                <td>Accionistas</td>
                                <td><button class="btn btn-sm btn-success" onclick="seleccionarCuenta('115', 'Accionistas')">Seleccionar</button></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    
    function agregarFila() {
        const tabla = document.getElementById('tablaCuentas').getElementsByTagName('tbody')[0];
        const fila = tabla.insertRow();
        const columnas = [
            '<input type="text" class="form-control" placeholder="Código">',
            '<input type="text" class="form-control" placeholder="Cuenta Contable">',
            '<input type="text" class="form-control" placeholder="Parcial">',
            '<input type="text" class="form-control" placeholder="Debe">',
            '<input type="text" class="form-control" placeholder="Haber">'
        ];
        columnas.forEach((col, index) => {
            const celda = fila.insertCell(index);
            celda.innerHTML = col;
        });
    }

    
    function seleccionarCuenta(codigo, cuenta) {
        const tabla = document.getElementById('tablaCuentas').getElementsByTagName('tbody')[0];
        const fila = tabla.insertRow();
        fila.insertCell(0).innerHTML = codigo;
        fila.insertCell(1).innerHTML = cuenta;
        fila.insertCell(2).innerHTML = '<input type="text" class="form-control" placeholder="Parcial">';
        fila.insertCell(3).innerHTML = '<input type="text" class="form-control" placeholder="Debe">';
        fila.insertCell(4).innerHTML = '<input type="text" class="form-control" placeholder="Haber">';
        // Cerrar el modal después de agregar la cuenta
        const modal = document.getElementById('modalCatalogo');
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    }
</script>

</body>
</html>
