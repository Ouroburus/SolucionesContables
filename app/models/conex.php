<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// Conectar a la base de datos
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->Nombre_de_la_base_de_datos_que_se_llama->Nombre_de_la_coleccion_que_se_llama;
?>
