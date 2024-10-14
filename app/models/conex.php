<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Conectar a la base de datos
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->BDContador->LibroConsumidor;
?>
