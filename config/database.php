<?php
require 'vendor/autoload.php'; 

class MongoDBConnection {
    private $client;
    private $db;

    public function __construct($db_name = 'DBContador') {
        try {
            // Estableciendo la conexión
            $this->client = new MongoDB\Client("mongodb://localhost:27017");
            // Selecciona la base de datos de forma segura
            $this->db = $this->client->selectDatabase($db_name);
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al conectar con MongoDB: " . $e->getMessage();
            exit();
        }
    }

    // Obtener una colección de la base de datos
    public function getCollection($collection_name) {
        try {
            return $this->db->selectCollection($collection_name);
        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al obtener la colección: " . $e->getMessage();
            return null;
        }
    }
}


