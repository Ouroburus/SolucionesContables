<?php
// Incluir el archivo de conexión a la base de datos
require_once 'path/to/tu_archivo_de_conexion.php'; // Asegúrate de ajustar la ruta

header('Content-Type: application/json');

try {
    // Conexión a MongoDB
    $mongoClient = new MongoDB\Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/"); // Reemplaza con tus credenciales
    $db = $mongoClient->selectDatabase('BDContador'); // Selecciona tu base de datos
    $coleccion = $db->selectCollection('catalogoCuentas'); // Selecciona la colección que contiene las cuentas

    // Obtener todas las cuentas
    $cuentas = $coleccion->find();

    // Formatear los resultados en un array
    $resultado = [];
    foreach ($cuentas as $cuenta) {
        $resultado[] = [
            'codigo' => $cuenta['codigo'], // Asegúrate de que estos campos existan en tu documento
            'nombre' => $cuenta['nombre']
        ];
    }

    // Enviar el resultado como JSON
    echo json_encode($resultado);
} catch (Exception $e) {
    // Manejo de errores
    http_response_code(500); // Establecer código de respuesta HTTP 500
    echo json_encode(['error' => 'Error al conectar a la base de datos: ' . $e->getMessage()]);
}

header('Content-Type: application/json');

// Simulación de datos para el catálogo de cuentas
$cuentas = [
    ["codigo" => "101", "nombre" => "Caja"],
    ["codigo" => "102", "nombre" => "Bancos"],
    ["codigo" => "103", "nombre" => "Cuentas por cobrar"],
    // Agrega más cuentas según sea necesario
];

echo json_encode($cuentas);
?>

