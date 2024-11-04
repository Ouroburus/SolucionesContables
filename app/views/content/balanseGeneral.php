<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../layouts/Header.php'?>
<div class="container mt-5">
    <h3 class="text-center mb-4">Balance General</h3>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Notas</th>
                <th>2020</th>
                <th>2019</th>
            </tr>
        </thead>
        <tbody>
            <!-- Activos -->
            <tr>
                <td colspan="4"><strong>Activos</strong></td>
            </tr>
            <tr>
                <td>Activos de intermediación:</td>
                <td></td>
                <td><input type="number" class="form-control activo-input" oninput="actualizarTotalActivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Caja y bancos</td>
                <td></td>
                <td><input type="number" class="form-control activo-input" oninput="actualizarTotalActivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Inversiones financieras</td>
                <td></td>
                <td><input type="number" class="form-control activo-input" oninput="actualizarTotalActivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Cartera de préstamos (neto)</td>
                <td></td>
                <td><input type="number" class="form-control activo-input" oninput="actualizarTotalActivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Inversiones accionarias</td>
                <td></td>
                <td><input type="number" class="form-control activo-input" oninput="actualizarTotalActivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Diversos (neto)</td>
                <td></td>
                <td><input type="number" class="form-control activo-input" oninput="actualizarTotalActivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Total activos</strong></td>
                <td></td>
                <td><strong id="totalActivos">0.00</strong></td>
                <td></td>
            </tr>

            <!-- Pasivos -->
            <tr>
                <td colspan="4"><strong>Pasivos y Patrimonio</strong></td>
            </tr>
            <tr>
                <td>Pasivos de intermediación:</td>
                <td></td>
                <td><input type="number" class="form-control pasivo-input" oninput="actualizarTotalPasivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Depósitos de clientes</td>
                <td></td>
                <td><input type="number" class="form-control pasivo-input" oninput="actualizarTotalPasivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Préstamos del Banco de Desarrollo de El Salvador</td>
                <td></td>
                <td><input type="number" class="form-control pasivo-input" oninput="actualizarTotalPasivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Préstamos de otros bancos</td>
                <td></td>
                <td><input type="number" class="form-control pasivo-input" oninput="actualizarTotalPasivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td>Títulos de emisión propia</td>
                <td></td>
                <td><input type="number" class="form-control pasivo-input" oninput="actualizarTotalPasivos()" step="0.01"></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Total pasivos</strong></td>
                <td></td>
                <td><strong id="totalPasivos">0.00</strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <!-- Botón para guardar los datos en MongoDB -->
    <button class="btn btn-primary mt-3" onclick="guardarEnMongoDB()">Guardar en MongoDB</button>
    <p id="resultado" class="mt-2"></p>
</div>

<?php include '../layouts/footer.php'?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Función para actualizar el total de activos
function actualizarTotalActivos() {
    const activosInputs = document.querySelectorAll('.activo-input');
    let totalActivos = 0;

    activosInputs.forEach(input => {
        totalActivos += parseFloat(input.value) || 0; // Suma cada valor o 0 si está vacío
    });

    document.getElementById('totalActivos').textContent = totalActivos.toFixed(2); // Actualiza el total de activos
}

// Función para actualizar el total de pasivos
function actualizarTotalPasivos() {
    const pasivosInputs = document.querySelectorAll('.pasivo-input');
    let totalPasivos = 0;

    pasivosInputs.forEach(input => {
        totalPasivos += parseFloat(input.value) || 0; // Suma cada valor o 0 si está vacío
    });

    document.getElementById('totalPasivos').textContent = totalPasivos.toFixed(2); // Actualiza el total de pasivos
}

// Función para guardar en MongoDB usando AJAX
function guardarEnMongoDB() {
    const totalActivos = parseFloat(document.getElementById('totalActivos').textContent);
    const totalPasivos = parseFloat(document.getElementById('totalPasivos').textContent);

    // Realiza la petición AJAX
    fetch('guardarBalance.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `totalActivos=${totalActivos}&totalPasivos=${totalPasivos}`
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('resultado').textContent = data; // Muestra el mensaje de respuesta
    })
    .catch(error => {
        document.getElementById('resultado').textContent = 'Error al guardar en MongoDB';
        console.error('Error:', error);
    });
}
</script>
</body>
</html>
