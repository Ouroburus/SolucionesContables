<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload para cargar MongoDB y otras dependencias

// Verifica que el archivo de configuración existe y carga las credenciales de la BD
if (!file_exists(__DIR__ . '/../../config/database.php')) {
    die('El archivo database.php no se encuentra en la ruta especificada.');
}
require_once __DIR__ . '/../../config/database.php'; // Incluye la configuración

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rows = $_POST['rows']; // Recibimos las filas enviadas desde el formulario

    // Crear conexión con MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->BDContador; // Asegúrate de que tu base de datos MongoDB se llame "BDContador"
    // La colección en MongoDB donde guardarás los datos
    $collection = $db->LibroCompras; 

    // Guardar cada fila en la base de datos
    foreach ($rows as $row) {
        $document = [
            'numero' => $row['num'],
            'emision' => $row['emision'],
            'numero_documento' => $row['numero_documento'],
            'nit_dui' => $row['nit_dui'],
            'nrc' => $row['nrc'],
            'nombre_proveedor' => $row['nombre_proveedor'],
            'compras_exentas' => $row['compras_exentas'],
            'compras_gravadas' => $row['compras_gravadas'],
            'credito_fiscal' => $row['credito_fiscal'],
            'iva_percibido' => $row['iva_percibido'],
            'total_compras' => $row['total_compras'],
            'compras_excluidos' => $row['compras_excluidos'],
            'fecha_registro' => new MongoDB\BSON\UTCDateTime() // Inserta la fecha de registro actual
        ];
        $collection->insertOne($document); // Inserta el documento en la colección
    }

    echo "Datos guardados correctamente.";
}
