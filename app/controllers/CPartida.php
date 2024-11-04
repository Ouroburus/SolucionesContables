<?php
require '../../vendor/autoload.php'; // Cargar el autoload de Composer

header('Content-Type: application/json');

// Conexión a MongoDB
$client = new MongoDB\Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/"); // Cambia la URL si es necesario

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['partidas']) && is_array($input['partidas'])) {
    $coleccion = $client->BDContador->partidas;
    
    try {
        $resultado = $coleccion->insertMany($input['partidas']);
        echo json_encode(['success' => true, 'message' => 'Datos guardados correctamente.']);
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al guardar los datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos no válidos.']);
}
?>
