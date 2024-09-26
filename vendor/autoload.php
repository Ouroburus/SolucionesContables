<?php
// Incluye el archivo autoload.php generado por Composer
require_once __DIR__ . '/vendor/autoload.php';

// A partir de aquí puedes usar las clases de MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->nombre_base_de_datos;