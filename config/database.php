<?php
// Archivo de configuración para conectar a MongoDB

// Clase para manejar la conexión a MongoDB
class MongoDBConnection {
    private $client;
    private $db;

    public function __construct() {
        // Configura la URL de conexión a MongoDB (ajusta según sea necesario)
        $this->client = new MongoDB\Client("mongodb://localhost:27017");

        // Selecciona la base de datos (ajusta el nombre a tu base de datos real)
        $this->db = $this->client->BDContador;
    }

    // Método para obtener una colección
    public function getCollection($LibroCompras) {
        return $this->db->$LibroCompras;
        
    }


     

}
