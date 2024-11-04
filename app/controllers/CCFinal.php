<?php
require 'vendor/autoload.php'; // Asegúrate de que la biblioteca de MongoDB esté cargada

class VentasControlador {
    private $collection;

    public function __construct() {
        $client = new MongoDB\Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/"); // Cambia esto según tu configuración
        $this->collection = $client->BDContador->LibroConsumidor; // Reemplaza con tus datos
    }

    public function guardarVentas() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ventas = $_POST['ventas'];
            $fechaRegistro = new MongoDB\BSON\UTCDateTime(); // Fecha actual
            
            foreach ($ventas as $venta) {
                $data = [
                    'fecha' => $_POST['fecha'],
                    'documento_inicio' => $_POST['documento_inicio'],
                    'documento_final' => $_POST['documento_final'],
                    'nro_caja' => (int)$_POST['nro_caja'],
                    'ventas_exentas' => (float)$venta['ventas_exentas'],
                    'ventas_gravadas' => (float)$venta['ventas_gravadas'],
                    'exportaciones' => (float)$venta['exportaciones'],
                    'venta_cuenta_terceros' => (float)$venta['venta_cuenta_terceros'],
                    'fecha_registro' => $fechaRegistro,
                ];
                
                // Inserta en la base de datos
                $this->collection->insertOne($data);
            }

            // Mensaje de confirmación
            $mensaje = 'Ventas guardadas correctamente';
            include '../views/content/ventasconsumidor.php'; // Redirige de nuevo a tu formulario para mostrar el mensaje
            exit;
        }
    }
}

// Instanciar el controlador y llamar al método
$ventasControlador = new VentasControlador();
$ventasControlador->guardarVentas();
