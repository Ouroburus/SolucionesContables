<?php
require __DIR__ . '/../vendor/autoload.php';

class MongoDBConnection {
    private $client;
    private $db;

    public function __construct() {
        try {
            // Conexión a MongoDB, cambia la URI si usas autenticación o un puerto diferente
            $this->client = new MongoDB\Client("mongodb://localhost:27017");

            // Selecciona la base de datos 'BDContador' (ajústalo según tu base de datos)
            $this->db = $this->client->BDContador;
        } catch (Exception $e) {
            // Manejar cualquier error de conexión
            die("Error de conexión a MongoDB: " . $e->getMessage());
        }
    }

    // Método para obtener una colección específica
    public function obtenerColeccion($nombreColeccion) {
        // Retorna la colección solicitada de la base de datos
        return $this->db->$nombreColeccion;
    }
}
