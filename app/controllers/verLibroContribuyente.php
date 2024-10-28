<?php
// Incluir archivo de conexión
require_once(__DIR__ . '/../../config/database.php'); 

header('Content-Type: application/json');

try {
    // Crear instancia de la conexión
    $mongoConnection = new MongoDBConnection();
    $collection = $mongoConnection->getCollection('LibroContribuyente');

    // Verificar la conexión
    if (!$collection) {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo conectar a la colección.']);
        exit;
    }

    // Realizar consulta a la base de datos sin filtros
    $ventas = $collection->find();
    $resultado = iterator_to_array($ventas);

    // Verificar si hay resultados
    if (empty($resultado)) {
        echo json_encode(['status' => 'error', 'message' => 'No se encontraron resultados']);
        exit;
    }

   // Transformar los resultados
$datos = [];
foreach ($resultado as $item) {
    $dato = []; // Inicializar un array temporal para cada documento

    if (isset($item['dia'])) {
        $dato['numero_dia'] = $item['dia'];
    }
    if (isset($item['numero_correlativo'])) {
        $dato['numero_correlativo'] = $item['numero_correlativo'];
    }
    if (isset($item['nombre_cliente'])) {
        $dato['nombre_cliente'] = $item['nombre_cliente'];
    }
    if (isset($item['ncr_exentas'])) {
        $dato['ncr_exentas'] = $item['ncr_exentas'];
    }
    if (isset($item['propias_gravadas'])) {
        $dato['propias_gravadas'] = $item['propias_gravadas'];
    }
    if (isset($item['debito_fiscal'])) {
        $dato['debito_fiscal'] = $item['debito_fiscal'];
    }
    if (isset($item['a_cuentas_exentas'])) {
        $dato['a_cuentas_exentas'] = $item['a_cuentas_exentas'];
    }
    if (isset($item['a_cuentas_gravadas'])) {
        $dato['a_cuentas_gravadas'] = $item['a_cuentas_gravadas'];
    }
    if (isset($item['total'])) {
        $dato['total'] = $item['total'];
    }
    if (isset($item['iva_retenido'])) {
        $dato['iva_retenido'] = $item['iva_retenido'];
    }

    // Agregar el array temporal solo si contiene datos
    if (!empty($dato)) {
        $datos[] = $dato;
    }
}

// Enviar la respuesta en JSON
echo json_encode(['status' => 'success', 'data' => $datos]);



    // Enviar la respuesta en JSON
    echo json_encode(['status' => 'success', 'data' => $datos]);

} catch (Exception $e) {
    // En caso de error, enviar un mensaje de error
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
