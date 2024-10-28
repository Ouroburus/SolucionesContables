<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Venta Contribuyente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Vista Venta Contribuyente</h3>

    <div class="row mb-4">
        <div class="col-md-3">
            <label for="selectMes" class="form-label">Mes</label>
            <select id="selectMes" class="form-select">
                <option value="">Seleccionar mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <!-- Agregar más meses según sea necesario -->
            </select>
        </div>
        <div class="col-md-3">
            <label for="selectAnio" class="form-label">Año</label>
            <select id="selectAnio" class="form-select">
                <option value="">Seleccionar año</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <!-- Agregar más años según sea necesario -->
            </select>
        </div>
        <div class="col-md-4">
            <label for="buscarCliente" class="form-label">Buscar cliente</label>
            <div class="input-group">
                <input type="text" class="form-control" id="buscarCliente" placeholder="Buscar por NCR o nombre del cliente">
                <button class="btn btn-outline-secondary" type="button" id="buttonBuscar">
                    <i class="bi bi-search"></i> 
                </button>
            </div>
        </div>
        <div class="col-md-2 text-end align-self-end">
            <button class="btn btn-primary" id="btnBuscar">Buscar</button>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>N° de Día</th>
                <th>N° de Correlativo</th>
                <th>Nombre del Cliente</th>
                <th>NCR Propias Exentas</th>
                <th>Propias Gravadas</th>
                <th>Débito Fiscal</th>
                <th>A Cuentas de Terceros Exentas</th>
                <th>A Cuentas de Terceros Gravadas</th>
                <th>Total</th>
                <th>IVA Retenido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaDatos">
            <!-- Aquí se cargarán los datos de ventas -->
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
<script>
// Función para buscar y mostrar datos
document.getElementById('btnBuscar').addEventListener('click', function () {
    const mes = document.getElementById('selectMes').value;
    const anio = document.getElementById('selectAnio').value;
    const buscar = document.getElementById('buscarCliente').value;

    fetch(`../../controllers/verLibroContribuyente.php?mes=${mes}&anio=${anio}&buscar=${buscar}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Imprime la respuesta para ver qué se está devolviendo
        const tbody = document.getElementById('tablaDatos');
        tbody.innerHTML = ''; // Limpiar la tabla antes de cargar nuevos datos

        // Verificar si hubo error en la respuesta
        if (data.status === 'error') {
            tbody.innerHTML = `<tr><td colspan="11" class="text-center text-danger">${data.message}</td></tr>`;
            return;
        }

        // Comprobar si hay datos disponibles
        if (data.data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="11" class="text-center">No se encontraron resultados</td></tr>';
            return;
        }

        // Iterar sobre los datos y construir filas de la tabla
        data.data.forEach((venta) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${venta.numero_dia ?? 'N/A'}</td>
                <td>${venta.numero_correlativo ?? 'N/A'}</td>
                <td>${venta.nombre_cliente ?? 'N/A'}</td>
                <td>${venta.ncr_exentas ?? 'N/A'}</td>
                <td>${venta.propias_gravadas ?? 'N/A'}</td>
                <td>${venta.debito_fiscal ?? 'N/A'}</td>
                <td>${venta.cuentas_terceros_exentas ?? 'N/A'}</td>
                <td>${venta.cuentas_terceros_gravadas ?? 'N/A'}</td>
                <td>${venta.total ?? 'N/A'}</td>
                <td>${venta.iva_retenido ?? 'N/A'}</td>
                <td>
                    <button class="btn btn-info btn-sm">Editar</button>
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('Error:', error);
        const tbody = document.getElementById('tablaDatos');
        tbody.innerHTML = `<tr><td colspan="11" class="text-center text-danger">Error al cargar los datos</td></tr>`;
    });

});
</script>
</body>
</html>
