<?php
require 'vendor/autoload.php'; // Asegúrate de instalar el paquete de MongoDB

class MongoDBConnection {
    private $client;
    private $db;

    public function __construct($db_name = 'nombre_base_de_datos') {
        $this->client = new MongoDB\Client("mongodb://localhost:27017");
        $this->db = $this->client->$db_name;
    }

    public function getCollection($collection_name) {
        return $this->db->$collection_name;
    }
}
?>

