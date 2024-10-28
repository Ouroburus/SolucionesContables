<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libro de Ventas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Libro de Consumidor Final</h2>
        
        <!-- Filtros de búsqueda -->
        <div class="form-row align-items-center">
            <div class="col-auto">
                <select id="selectMes" class="form-control">
                    <option value="">Selecciona el Mes</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <!-- Agrega más opciones según corresponda -->
                </select>
            </div>
            <div class="col-auto">
                <select id="selectAnio" class="form-control">
                    <option value="">Selecciona el Año</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <!-- Agrega más años según corresponda -->
                </select>
            </div>
            <div class="col-auto">
                <input type="text" id="buscarVenta" class="form-control" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                <button id="btnBuscar" class="btn btn-primary">Buscar</button>
            </div>
        </div>

        <!-- Tabla de ventas -->
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Emisión</th>
                    <th>Número de Documento</th>
                    <th>Ventas Exentas</th>
                    <th>Ventas Gravadas</th>
                    <th>Exportaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se cargarán los datos de ventas -->
            </tbody>
        </table>
    </div>

    <!-- Script de búsqueda y actualización de la tabla -->
    <script>
        document.getElementById('btnBuscar').addEventListener('click', function () {
            const mes = document.getElementById('selectMes').value;
            const anio = document.getElementById('selectAnio').value;
            const buscar = document.getElementById('buscarVenta').value;

            fetch(`../../controllers/verLibroConsumidorF.php?mes=${mes}&anio=${anio}&buscar=${buscar}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = ''; // Limpiar la tabla antes de cargar nuevos datos

                    if (data.status === 'error') {
                        tbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">${data.message}</td></tr>`;
                        return;
                    }

                    if (data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="7" class="text-center">No se encontraron resultados</td></tr>';
                        return;
                    }

                    data.data.forEach((venta, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${venta.fecha ?? 'N/A'}</td>
                            <td>${venta.documento_inicial ?? 'N/A'}</td>
                            <td>${venta.ventas_exentas ?? 'N/A'}</td>
                            <td>${venta.ventas_gravadas ?? 'N/A'}</td>
                            <td>${venta.exportaciones ?? 'N/A'}</td>
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
                    const tbody = document.querySelector('table tbody');
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error al cargar los datos</td></tr>`;
                });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
