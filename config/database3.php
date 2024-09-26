<?php
// conexion.php
require 'vendor/autoload.php'; // Asegúrate de que tienes instalado el paquete de MongoDB

class Conexion {
    private $cliente;
    private $baseDatos;

    public function __construct($nombreBD) {
        try {
            $this->cliente = new MongoDB\Client("mongodb://localhost:27017"); // Cambia la URI según tu configuración
            $this->baseDatos = $this->cliente->$nombreBD;
        } catch (Exception $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function obtenerColeccion($LibroConsumidor) {
        return $this->baseDatos->$LibroConsumidor;
    }
}
?>
