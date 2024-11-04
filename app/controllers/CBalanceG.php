<?php
require 'database.php'; // Archivo donde configuras tu conexión a MongoDB

// Asegúrate de que los datos estén disponibles y que sean válidos
if (isset($_POST['totalActivos']) && isset($_POST['totalPasivos'])) {
    try {
        // Conexión a la colección de MongoDB
        $collection = $client->miBaseDeDatos->miColeccionBalance;

        // Obtén los datos del formulario y conviértelos a flotantes
        $totalActivos = (float) $_POST['totalActivos'];
        $totalPasivos = (float) $_POST['totalPasivos'];

        // Inserta los datos en la colección
        $documento = [
            'total_activos' => $totalActivos,
            'total_pasivos' => $totalPasivos,
            'fecha' => new MongoDB\BSON\UTCDateTime() // Fecha y hora de inserción en UTC
        ];

        // Realiza la inserción en MongoDB
        $collection->insertOne($documento);

        // Mensaje de éxito
        echo "Datos guardados correctamente en MongoDB.";
    } catch (Exception $e) {
        // Manejo de errores
        echo "Error al guardar en MongoDB: " . $e->getMessage();
    }
} else {
    // Mensaje en caso de que falten datos
    echo "Faltan datos en el formulario. Verifica e intenta nuevamente.";
}
?>
