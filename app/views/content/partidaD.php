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
    
    <form id="formRegistroDiario">
        <table class="table table-bordered table-hover table-striped" id="tablaCuentas">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cuenta Contable</th>
                    <th>Parcial</th>
                    <th>Debe</th>
                    <th>Haber</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tablaBody">
                <!-- Filas dinámicas aquí -->
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th id="totalDebe">0.00</th>
                    <th id="totalHaber">0.00</th>
                </tr>
            </tfoot>
        </table>
    </form>
    
    <div class="text-end mb-3">
        <button class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>
        <button type="button" class="btn btn-success" onclick="guardarDatos()">Guardar</button>
        <button type="button" class="btn btn-info" onclick="mostrarCatalogoDesdeDB()">Mostrar Catálogo</button>
    </div>

    <!-- Modal del Catálogo -->
    <div class="modal fade" id="modalCatalogo" tabindex="-1" aria-labelledby="catalogoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catalogoModalLabel">Catálogo de Cuentas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="busquedaCuenta" class="form-control mb-3" placeholder="Buscar cuenta..." oninput="filtrarCatalogo()">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Cuenta</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="catalogoBody">
                            <!-- Filas del catálogo de cuentas -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>

    function agregarFila() {
        const tablaBody = document.getElementById('tablaBody');
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td><input type="text" class="form-control codigo" onfocus="mostrarCatalogo(this)"></td>
            <td><input type="text" class="form-control cuenta" readonly></td>
            <td><input type="number" class="form-control parcial"></td>
            <td><input type="number" class="form-control debe" oninput="actualizarTotales()"></td>
            <td><input type="number" class="form-control haber" oninput="actualizarTotales()"></td>
            <td><button class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button></td>
        `;
        tablaBody.appendChild(fila);
    }

    function mostrarCatalogo(input) {
        const modal = new bootstrap.Modal(document.getElementById('modalCatalogo'));
        modal.show();
        document.getElementById('catalogoBody').innerHTML = catalogoCuentas.map(cuenta => `
            <tr>
                <td>${cuenta.codigo}</td>
                <td>${cuenta.cuenta}</td>
                <td><button class="btn btn-success" onclick="seleccionarCuenta('${cuenta.codigo}', '${cuenta.cuenta}', this)">Seleccionar</button></td>
            </tr>
        `).join('');
    }

    function seleccionarCuenta(codigo, cuenta, boton) {
        const fila = boton.closest('tr').parentNode.parentNode.parentNode.parentNode.querySelector('input.codigo');
        fila.value = codigo;
        fila.nextElementSibling.value = cuenta;
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalCatalogo'));
        modal.hide();
    }

    function filtrarCatalogo() {
        const busqueda = document.getElementById('busquedaCuenta').value.toLowerCase();
        const filas = cuentasCatalogo.filter(cuenta => cuenta.cuenta.toLowerCase().includes(busqueda));
        const catalogoBody = document.getElementById('catalogoBody');
        catalogoBody.innerHTML = filas.map(cuenta => `
            <tr>
                <td>${cuenta.codigo}</td>
                <td>${cuenta.cuenta}</td>
                <td><button class="btn btn-success" onclick="seleccionarCuenta('${cuenta.codigo}', '${cuenta.cuenta}', this)">Seleccionar</button></td>
            </tr>
        `).join('');
    }

    function actualizarTotales() {
        let totalDebe = 0;
        let totalHaber = 0;

        document.querySelectorAll('.debe').forEach(input => {
            totalDebe += parseFloat(input.value) || 0;
        });

        document.querySelectorAll('.haber').forEach(input => {
            totalHaber += parseFloat(input.value) || 0;
        });

        document.getElementById('totalDebe').textContent = totalDebe.toFixed(2);
        document.getElementById('totalHaber').textContent = totalHaber.toFixed(2);
    }

    function guardarDatos() {
        const filas = document.querySelectorAll('#tablaBody tr');
        const datos = Array.from(filas).map(fila => ({
            codigo: fila.querySelector('.codigo').value,
            cuenta: fila.querySelector('.cuenta').value,
            parcial: parseFloat(fila.querySelector('.parcial').value) || 0,
            debe: parseFloat(fila.querySelector('.debe').value) || 0,
            haber: parseFloat(fila.querySelector('.haber').value) || 0
        }));

        fetch('../../controllers/CPartida.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ partidas: datos })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Datos guardados exitosamente');
                limpiarTabla(); // Limpia la tabla después de guardar
            } else {
                alert('Error al guardar los datos');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error de conexión al guardar los datos');
        });
    }

    function limpiarTabla() {
        const tablaBody = document.getElementById('tablaBody');
        tablaBody.innerHTML = ''; // Limpia las filas de la tabla
        actualizarTotales(); // Actualiza los totales
    }

    function eliminarFila(boton) {
        const fila = boton.closest('tr');
        fila.remove();
        actualizarTotales(); // Actualiza los totales después de eliminar la fila
    }

    function mostrarCatalogoDesdeDB() {
        fetch('../../controllers/cargar_catalogo.php') // Cambia la ruta a tu archivo PHP
            .then(response => response.json())
            .then(data => {
                catalogoCuentas = data; // Asumiendo que tu archivo PHP devuelve un JSON con los datos
                mostrarCatalogo();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar el catálogo de cuentas');
            });
    }
</script>
</body>
</html>
