<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Cuentas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Catálogo de Cuentas</h3>

    <table class="table table-bordered table-hover table-striped" id="tablaCatalogo">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cuenta</th>
                <th>Tipo</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCuenta">Agregar Cuenta</button>
    </div>

    <div class="modal fade" id="modalAgregarCuenta" tabindex="-1" aria-labelledby="modalAgregarCuentaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarCuentaLabel">Agregar Nueva Cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarCuenta">
                        <div class="mb-3">
                            <label for="codigoCuenta" class="form-label">Código</label>
                            <input type="text" class="form-control" id="codigoCuenta" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombreCuenta" class="form-label">Cuenta</label>
                            <input type="text" class="form-control" id="nombreCuenta" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipoCuenta" class="form-label">Tipo</label>
                            <select class="form-select" id="tipoCuenta" required>
                                <option value="Activo">Activo</option>
                                <option value="Pasivo">Pasivo</option>
                                <option value="Patrimonio">Patrimonio</option>
                                <option value="Ingresos">Ingresos</option>
                                <option value="Gastos">Gastos</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionCuenta" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcionCuenta" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('formAgregarCuenta').addEventListener('submit', function(event) {
        event.preventDefault();

        const codigo = document.getElementById('codigoCuenta').value;
        const cuenta = document.getElementById('nombreCuenta').value;
        const tipo = document.getElementById('tipoCuenta').value;
        const descripcion = document.getElementById('descripcionCuenta').value;

        const tabla = document.getElementById('tablaCatalogo').getElementsByTagName('tbody')[0];
        const fila = tabla.insertRow();
        fila.insertCell(0).innerText = codigo;
        fila.insertCell(1).innerText = cuenta;
        fila.insertCell(2).innerText = tipo;
        fila.insertCell(3).innerText = descripcion;

        document.getElementById('formAgregarCuenta').reset();
        const modal = document.getElementById('modalAgregarCuenta');
        const modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    });
</script>

</body>
</html>
