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
                <th>Firma</th>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    
    function agregarFila() {
        const tabla = document.getElementById('tablaSalarios').getElementsByTagName('tbody')[0];
        const fila = tabla.insertRow();
        const columnas = [
            tabla.rows.length,
            '<input type="text" class="form-control" placeholder="Nombre">',
            '<input type="number" class="form-control" placeholder="$ Sueldo">',
            '<input type="number" class="form-control" placeholder="Días">',
            '<input type="number" class="form-control" placeholder="$ Comisiones">',
            '<input type="number" class="form-control" placeholder="$ H. Extras Diurnas">',
            '<input type="number" class="form-control" placeholder="$ H. Extras Nocturnas">',
            '<input type="number" class="form-control" placeholder="$ Total Horas Extras">',
            '<input type="number" class="form-control" placeholder="$ Sub Total">',
            '<input type="number" class="form-control" placeholder="$ ISSS">',
            '<input type="number" class="form-control" placeholder="$ AFP">',
            '<input type="number" class="form-control" placeholder="$ RENTA">',
            '<input type="number" class="form-control" placeholder="$ Otras Deducciones">',
            '<input type="number" class="form-control" placeholder="$ Líquido a Pagar">',
            '<input type="text" class="form-control" placeholder="Firma">'
        ];
        columnas.forEach((col, index) => {
            const celda = fila.insertCell(index);
            celda.innerHTML = col;
        });
    }

    
    function guardarDatos() {
        alert('Datos guardados con éxito.');
    }
</script>

</body>
</html>