<?php
require '../../vendor/autoload.php'; // Cargar el autoload de Composer

// Incluir el archivo de conexión
include '../../config/database.php'; // Asegúrate de tener la función de conexión a MongoDB

// Obtener los datos JSON enviados
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data) && is_array($data)) {
    $client = new MongoDB\Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/"); // Cambia la URI si es necesario
    $collection = $client->BDContador->planillas; // Cambia 'tu_base_de_datos' por el nombre de tu base de datos

    foreach ($data as $registro) {
        // Prepara el documento a insertar
        $documento = [
            'nombre' => $registro['nombre'],
            'sueldo' => $registro['sueldo'],
            'dias' => $registro['dias'],
            'comisiones' => $registro['comisiones'],
            'hExtrasDiurnas' => $registro['hExtrasDiurnas'],
            'hExtrasNocturnas' => $registro['hExtrasNocturnas'],
            'totalHorasExtras' => $registro['totalHorasExtras'],
            'subTotal' => $registro['subTotal'],
            'isss' => $registro['isss'],
            'afp' => $registro['afp'],
            'renta' => $registro['renta'],
            'otrasDeducciones' => $registro['otrasDeducciones'],
            'liquidoAPagar' => $registro['liquidoAPagar'],
        ];

        // Inserta el documento en la colección
        $resultado = $collection->insertOne($documento);
        
        if (!$resultado->isAcknowledged()) {
            // Error al ejecutar la consulta
            echo json_encode(['success' => false, 'message' => 'Error al guardar los datos.']);
            exit;
        }
    }

    // Respuesta de éxito
    echo json_encode(['success' => true]);
} else {
    // Respuesta de error
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos válidos.']);
}
?>
