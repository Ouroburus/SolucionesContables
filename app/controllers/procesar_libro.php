<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload para cargar MongoDB y otras dependencias

// Verifica que el archivo de configuración existe y carga las credenciales de la BD
if (!file_exists(__DIR__ . '/../../config/database.php')) {
    die('El archivo database.php no se encuentra en la ruta especificada.');
}
require_once __DIR__ . '/../../config/database2.php'; // Incluye la configuración

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibe los datos del formulario
    $nombre_contribuyente = $_POST['nombre_contribuyente'];
    $nrc = $_POST['nrc'];
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];

    // Crear conexión con MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->BDContador; // Asegúrate de que tu base de datos MongoDB se llame "BDContador"
    $collection = $db->LibroContribuyente; // Cambia a "LibroVentas" o el nombre que desees

    // Construir el documento a insertar
    $document = [
        'nombre_contribuyente' => $nombre_contribuyente,
        'nrc' => $nrc,
        'mes' => $mes,
        'anio' => $anio,
        'fecha_registro' => new MongoDB\BSON\UTCDateTime(), // Fecha de registro
        'operaciones' => [] // Inicializa el array de operaciones
    ];

    // Recolectar las operaciones de ventas
    foreach ($_POST['dia'] as $key => $dia) {
        if (!empty($dia)) { // Asegúrate de que el día no esté vacío
            // Añadir la operación al array de operaciones
            $document['operaciones'][] = [
                'dia' => $dia,
                'correlativo' => $_POST['correlativo'][$key],
                'nombre_cliente' => $_POST['nombre_cliente'][$key],
                'nrc_cliente' => $_POST['nrc_cliente'][$key],
                'propias_exentas' => $_POST['propias_exentas'][$key],
                'propias_gravadas' => $_POST['propias_gravadas'][$key],
                'debito_fiscal' => $_POST['debito_fiscal'][$key],
                'terceros_exentas' => $_POST['terceros_exentas'][$key],
                'terceros_gravadas' => $_POST['terceros_gravadas'][$key],
                'total' => $_POST['total'][$key],
                'iva_retenido' => $_POST['iva_retenido'][$key]
            ];
        }
    }

    // Insertar el documento en la colección
    $result = $collection->insertOne($document);

    if ($result->getInsertedCount() === 1) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos.";
    }
}
?>
