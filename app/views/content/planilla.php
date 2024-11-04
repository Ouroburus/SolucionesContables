<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla de Salarios</title>
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
<?php include '../layouts/Header.php'?>
<div class="container mt-5">
    <h3 class="text-center mb-4">Planilla de Salarios</h3>
    
    <table class="table table-bordered table-hover table-striped" id="tablaSalarios">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>Sueldo Base Mensual</th>
                <th>Días</th>
                <th>Comisiones</th>
                <th>Horas Extras Diurnas</th>
                <th>Horas Extras Nocturnas</th>
                <th>Total Horas Extras</th>
                <th>Sub Total</th>
                <th>ISSS</th>
                <th>AFP</th>
                <th>RENTA</th>
                <th>Otras Deducciones</th>
                <th>Líquido a pagar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
        <tfoot>
           
        </tfoot>
    </table>

  
    <div class="text-end">
        <button class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>
        <button class="btn btn-success" onclick="guardarDatos()">Guardar</button>
    </div>
</div>

<?php include '../layouts/footer.php'?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const ISSS_PERCENT = 0.03;
    const AFP_PERCENT = 0.0725;

    function agregarFila() {
        const tabla = document.getElementById('tablaSalarios').getElementsByTagName('tbody')[0];
        const fila = tabla.insertRow();
        const columnas = [
            tabla.rows.length,
            '<input type="text" class="form-control" placeholder="Nombre" onchange="calcularTotales(this)">',
            '<input type="number" class="form-control" placeholder="$ Sueldo" onchange="calcularTotales(this)">',
            '<input type="number" class="form-control" placeholder="Días" onchange="calcularTotales(this)">',
            '<input type="number" class="form-control" placeholder="$ Comisiones" onchange="calcularTotales(this)">',
            '<input type="number" class="form-control" placeholder="$ H. Extras Diurnas" onchange="calcularTotales(this)">',
            '<input type="number" class="form-control" placeholder="$ H. Extras Nocturnas" onchange="calcularTotales(this)">',
            '<input type="number" class="form-control" placeholder="$ Total Horas Extras" readonly>',
            '<input type="number" class="form-control" placeholder="$ Sub Total" readonly>',
            '<input type="number" class="form-control" placeholder="$ ISSS" readonly>',
            '<input type="number" class="form-control" placeholder="$ AFP" readonly>',
            '<input type="number" class="form-control" placeholder="$ RENTA" readonly>',
            '<input type="number" class="form-control" placeholder="$ Otras Deducciones">',
            '<input type="number" class="form-control" placeholder="$ Líquido a Pagar" readonly>',
            '<button class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button>'
        ];
        columnas.forEach((col, index) => {
            const celda = fila.insertCell(index);
            celda.innerHTML = col;
        });
    }

    function calcularTotales(element) {
        const fila = element.closest('tr');
        const sueldo = parseFloat(fila.cells[2].querySelector('input').value) || 0;
        const dias = parseFloat(fila.cells[3].querySelector('input').value) || 0;
        const comisiones = parseFloat(fila.cells[4].querySelector('input').value) || 0;
        const hExtrasDiurnas = parseFloat(fila.cells[5].querySelector('input').value) || 0;
        const hExtrasNocturnas = parseFloat(fila.cells[6].querySelector('input').value) || 0;

        const totalHorasExtras = hExtrasDiurnas + hExtrasNocturnas;
        const subTotal = sueldo + comisiones + totalHorasExtras;
        const isss = subTotal * ISSS_PERCENT;
        const afp = subTotal * AFP_PERCENT;

        // RENTA se calcula según el subtotal (puedes ajustar la lógica aquí según las tablas de El Salvador)
        const renta = calcularRenta(subTotal);

        const otrasDeducciones = parseFloat(fila.cells[12].querySelector('input').value) || 0;
        const liquidoAPagar = subTotal - isss - afp - renta - otrasDeducciones;

        fila.cells[7].querySelector('input').value = totalHorasExtras.toFixed(2);
        fila.cells[8].querySelector('input').value = subTotal.toFixed(2);
        fila.cells[9].querySelector('input').value = isss.toFixed(2);
        fila.cells[10].querySelector('input').value = afp.toFixed(2);
        fila.cells[11].querySelector('input').value = renta.toFixed(2);
        fila.cells[13].querySelector('input').value = liquidoAPagar.toFixed(2);
    }

    function calcularRenta(subTotal) {
        // Lógica para calcular la RENTA según el salario en El Salvador
        // Ajusta esta lógica según las tarifas de RENTA que necesites
        if (subTotal <= 1000) return 0;
        if (subTotal <= 2000) return (subTotal - 1000) * 0.1;
        if (subTotal <= 3000) return (subTotal - 2000) * 0.15 + 100;
        return (subTotal - 3000) * 0.2 + 250;
    }

    function eliminarFila(boton) {
        const fila = boton.closest('tr');
        fila.remove();
    }

    function guardarDatos() {
    const tabla = document.getElementById('tablaSalarios').getElementsByTagName('tbody')[0];
    const datos = [];

    for (let i = 0; i < tabla.rows.length; i++) {
        const fila = tabla.rows[i];
        const nombre = fila.cells[1].querySelector('input').value;
        const sueldo = parseFloat(fila.cells[2].querySelector('input').value) || 0;
        const dias = parseInt(fila.cells[3].querySelector('input').value) || 0;
        const comisiones = parseFloat(fila.cells[4].querySelector('input').value) || 0;
        const hExtrasDiurnas = parseFloat(fila.cells[5].querySelector('input').value) || 0;
        const hExtrasNocturnas = parseFloat(fila.cells[6].querySelector('input').value) || 0;
        const totalHorasExtras = parseFloat(fila.cells[7].querySelector('input').value) || 0;
        const subTotal = parseFloat(fila.cells[8].querySelector('input').value) || 0;
        const isss = parseFloat(fila.cells[9].querySelector('input').value) || 0;
        const afp = parseFloat(fila.cells[10].querySelector('input').value) || 0;
        const renta = parseFloat(fila.cells[11].querySelector('input').value) || 0;
        const otrasDeducciones = parseFloat(fila.cells[12].querySelector('input').value) || 0;
        const liquidoAPagar = parseFloat(fila.cells[13].querySelector('input').value) || 0;

        datos.push({
            nombre,
            sueldo,
            dias,
            comisiones,
            hExtrasDiurnas,
            hExtrasNocturnas,
            totalHorasExtras,
            subTotal,
            isss,
            afp,
            renta,
            otrasDeducciones,
            liquidoAPagar
        });
    }

    fetch('../../controllers/CPlanilla.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Datos guardados con éxito.');
        } else {
            alert('Error al guardar los datos: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error en la conexión: ' + error.message);
    });
}

</script>

</body>
</html>
