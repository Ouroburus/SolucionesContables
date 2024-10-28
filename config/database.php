<?php
// Archivo de configuración para conectar a MongoDB
require __DIR__ . '/../vendor/autoload.php';


use MongoDB\Client;

// Clase para manejar la conexión a MongoDB
class MongoDBConnection {
    private $client;
    private $db;

    public function __construct() {
        // Configura la URL de conexión a MongoDB (ajusta según sea necesario)
        $this->client = new Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/");

        // Selecciona la base de datos (ajusta el nombre a tu base de datos real)
        $this->db = $this->client->BDContador;
    }

    // Método para obtener una colección
    public function getCollection($collectionName) {
        return $this->db->$collectionName;
    }
}
