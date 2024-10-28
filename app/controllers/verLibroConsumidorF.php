<?php
// Incluir archivo de conexión
require 'conexion.php';

header('Content-Type: application/json');

try {
    $conexion = new MongoDBConnection();
    $collection = $conexion->getCollection('LibroVentas');

    $mes = $_GET['mes'] ?? '';
    $anio = $_GET['anio'] ?? '';
    $buscar = $_GET['buscar'] ?? '';

    $filtros = [];

    if (!empty($anio)) {
        $regexFecha = "^$anio";
        if (!empty($mes)) {
            $regexFecha .= "-$mes";
        }
        $filtros['fecha'] = ['$regex' => $regexFecha];
    }

    if (!empty($buscar)) {
        $filtros['$or'] = [
            ['documento_inicial' => ['$regex' => $buscar, '$options' => 'i']],
            ['nombre_proveedor' => ['$regex' => $buscar, '$options' => 'i']]
        ];
    }

    $ventas = $collection->find($filtros);
    $resultado = iterator_to_array($ventas);

    echo json_encode(['status' => 'success', 'data' => $resultado]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al acceder a los datos']);
}
