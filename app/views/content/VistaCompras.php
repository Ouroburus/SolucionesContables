<?php
require '../../../config/database5.php'; // Incluir el archivo de conexión con MongoDB

// Crear una nueva conexión a MongoDB
$conexion = new MongoDBConnection();

// Obtener la colección 'LibroCompras'
$coleccionCompras = $conexion->obtenerColeccion('LibroCompras');

// Obtener los documentos de la colección 'LibroCompras'
$compras = $coleccionCompras->find();

// Actualizar datos si se envió una modificación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $datosActualizados = [
        'emision' => $_POST['emision'],
        'numero_documento' => $_POST['numero_documento'],
        'nit_dui' => $_POST['nit_dui'],
        'nrc' => $_POST['nrc'],
        'nombre_proveedor' => $_POST['nombre_proveedor'],
        'compras_exentas' => $_POST['compras_exentas'],
        'compras_gravadas' => $_POST['compras_gravadas']
    ];

    // Actualizar el documento en MongoDB
    $coleccionCompras->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => $datosActualizados]
    );

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Eliminar documento si se envía el formulario de eliminación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar'])) {
    $idEliminar = $_POST['id'];
    $coleccionCompras->deleteOne(['_id' => new MongoDB\BSON\ObjectId($idEliminar)]);
    echo "<script>alert('Compra eliminada correctamente');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Tabla de Compras</h2>

    <!-- Filtros y barra de búsqueda -->
    <div class="row mb-3">
        <div class="col-md-3">
            <select name="mes" class="form-control">
                <option value="">Seleccione Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="anio" class="form-control">
                <option value="">Seleccione Año</option>
                <?php for ($i = 2020; $i <= date('Y'); $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar...">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary btn-block">Buscar</button>
        </div>
    </div>

    <!-- Tabla -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Contador para numerar las filas
            $contador = 1;

            // Recorrer los documentos obtenidos de la colección
            foreach ($compras as $compra) {
                echo "<tr>";
                echo "<td>" . $contador++ . "</td>";
                echo "<td>" . $compra['emision'] . "</td>";
                echo "<td>" . $compra['numero_documento'] . "</td>";
                echo "<td>" . $compra['nit_dui'] . "</td>";
                echo "<td>" . $compra['nrc'] . "</td>";
                echo "<td>" . $compra['nombre_proveedor'] . "</td>";
                echo "<td>" . $compra['compras_exentas'] . "</td>";
                echo "<td>" . $compra['compras_gravadas'] . "</td>";
                echo "<td>" . $compra['credito_fiscal'] . "</td>";
                echo "<td>" . $compra['iva_percibido'] . "</td>";
                echo "<td>" . $compra['total_compras'] . "</td>";
                echo "<td>" . $compra['compras_excluidos'] . "</td>";
                echo '<td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editarModal" data-id="' . $compra['_id'] . '" data-emision="' . $compra['emision'] . '" data-numero_documento="' . $compra['numero_documento'] . '" data-nit_dui="' . $compra['nit_dui'] . '" data-nrc="' . $compra['nrc'] . '" data-nombre_proveedor="' . $compra['nombre_proveedor'] . '" data-compras_exentas="' . $compra['compras_exentas'] . '" data-compras_gravadas="' . $compra['compras_gravadas'] . '">Editar</button>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="' . $compra['_id'] . '">
                            <button class="btn btn-danger btn-sm" name="eliminar">Eliminar</button>
                        </form>
                    </td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para editar -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="form-group">
                        <label for="edit-emision">Emisión</label>
                        <input type="text" class="form-control" id="edit-emision" name="emision">
                    </div>
                    <div class="form-group">
                        <label for="edit-numero_documento">Número Documento</label>
                        <input type="text" class="form-control" id="edit-numero_documento" name="numero_documento">
                    </div>
                    <div class="form-group">
                        <label for="edit-nit_dui">NIT o DUI</label>
                        <input type="text" class="form-control" id="edit-nit_dui" name="nit_dui">
                    </div>
                    <div class="form-group">
                        <label for="edit-nrc">NRC</label>
                        <input type="text" class="form-control" id="edit-nrc" name="nrc">
                    </div>
                    <div class="form-group">
                        <label for="edit-nombre_proveedor">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="edit-nombre_proveedor" name="nombre_proveedor">
                    </div>
                    <div class="form-group">
                        <label for="edit-compras_exentas">Compras Exentas</label>
                        <input type="text" class="form-control" id="edit-compras_exentas" name="compras_exentas">
                    </div>
                    <div class="form-group">
                        <label for="edit-compras_gravadas">Compras Gravadas</label>
                        <input type="text" class="form-control" id="edit-compras_gravadas" name="compras_gravadas">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="editar">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('#editarModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var id = button.data('id');
        var emision = button.data('emision');
        var numero_documento = button.data('numero_documento');
        var nit_dui = button.data('nit_dui');
        var nrc = button.data('nrc');
        var nombre_proveedor = button.data('nombre_proveedor');
        var compras_exentas = button.data('compras_exentas');
        var compras_gravadas = button.data('compras_gravadas');

        var modal = $(this);
        modal.find('#edit-id').val(id);
        modal.find('#edit-emision').val(emision);
        modal.find('#edit-numero_documento').val(numero_documento);
        modal.find('#edit-nit_dui').val(nit_dui);
        modal.find('#edit-nrc').val(nrc);
        modal.find('#edit-nombre_proveedor').val(nombre_proveedor);
        modal.find('#edit-compras_exentas').val(compras_exentas);
        modal.find('#edit-compras_gravadas').val(compras_gravadas);
    });
</script>
</body>
</html>
