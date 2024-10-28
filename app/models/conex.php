<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Conectar a la base de datos
$client = new MongoDB\Client("mongodb+srv://Morales:Back1234@cluster0.mvf44.mongodb.net/");
$collection = $client->BDContador->LibroConsumidor;
?>
