<?php

function procesar_libro($datos) {
    require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload para cargar MongoDB y otras dependencias

    // Verifica que el archivo de configuración existe y carga las credenciales de la BD
    if (!file_exists(__DIR__ . '/../../config/database.php')) {
        die('El archivo database.php no se encuentra en la ruta especificada.');
    }
    require_once __DIR__ . '/../../config/database.php'; // Incluye la configuración

    // Captura de los campos principales
    $nombre_contribuyente = $datos['nombre_contribuyente'] ?? '';
    $nrc = $datos['nrc'] ?? '';
    $mes = $datos['mes'] ?? '';
    $anio = $datos['anio'] ?? '';

    // Verificar que los datos principales no estén vacíos
    if (empty($nombre_contribuyente) || empty($nrc) || empty($mes) || empty($anio)) {
        die('Por favor completa todos los campos principales.');
    }

    // Crear conexión con MongoDB
    $client = new MongoDB\Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/");
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
    foreach ($datos['dia'] as $key => $dia) {
        if (!empty($dia)) { // Asegúrate de que el día no esté vacío
            // Añadir la operación al array de operaciones
            $document['operaciones'][] = [
                'dia' => $dia,
                'correlativo' => $datos['correlativo'][$key],
                'nombre_cliente' => $datos['nombre_cliente'][$key],
                'nrc_cliente' => $datos['nrc_cliente'][$key],
                'propias_exentas' => $datos['propias_exentas'][$key],
                'propias_gravadas' => $datos['propias_gravadas'][$key],
                'debito_fiscal' => $datos['debito_fiscal'][$key],
                'terceros_exentas' => $datos['terceros_exentas'][$key],
                'terceros_gravadas' => $datos['terceros_gravadas'][$key],
                'total' => $datos['total'][$key],
                'iva_retenido' => $datos['iva_retenido'][$key]
            ];
        }
    }

    // Insertar el documento en la colección
    try {
        $result = $collection->insertOne($document);

        if ($result->getInsertedCount() === 1) {
            echo "Los datos han sido guardados correctamente.";
        } else {
            echo "Error al guardar los datos.";
        }
    } catch (Exception $e) {
        die('Error al insertar los datos: ' . $e->getMessage());
    }
}

?>
