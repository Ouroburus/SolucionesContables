<?php
require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload para cargar MongoDB y otras dependencias

// Verifica que el archivo de configuración existe y carga las credenciales de la BD
if (!file_exists(__DIR__ . '/../../config/database.php')) {
    die('El archivo database.php no se encuentra en la ruta especificada.');
}
require_once __DIR__ . '/../../config/database.php'; // Incluye la configuración

class VentasControlador {
    private $collection;

    public function __construct() {
        // Crear conexión con MongoDB
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $db = $client->BDContador; // Cambia 'tu_base_de_datos' por el nombre de tu base de datos
        $this->collection = $db->LibroConsumidor; // Cambia 'ventas' por el nombre de tu colección
    }

    public function guardarVenta() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $venta = [
                'fecha' => $_POST['fecha'],
                'documento_inicio' => $_POST['documento_inicio'],
                'documento_final' => $_POST['documento_final'],
                'ventas_exentas' => (float) $_POST['ventas_exentas'],
                'ventas_gravadas' => (float) $_POST['ventas_gravadas'],
                'exportaciones' => (float) $_POST['exportaciones'],
                'fecha_registro' => new MongoDB\BSON\UTCDateTime() // Fecha actual
            ];

            // Insertar datos en la colección
            try {
                $resultado = $this->collection->insertOne($venta);
                return "Venta registrada con éxito. ID: " . $resultado->getInsertedId();
            } catch (Exception $e) {
                return "Error al registrar la venta: " . $e->getMessage();
            }
        }
    }

    public function mostrarVentas() {
        // Obtener todas las ventas
        return $this->collection->find()->toArray();
    }
}
?>
