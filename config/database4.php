<?php
// Cargar el autoload de Composer (si estás usando Composer para instalar dependencias)
require_once(__DIR__ . '/../vendor/autoload.php');

class Database {
    // Configuración de la conexión a MongoDB
    private $mongoClient;
    private $database;
    private $collection;

    public function __construct() {
        try {
            // Conexión a MongoDB (puedes ajustar la cadena de conexión si usas autenticación o un puerto diferente)
            $this->mongoClient = new MongoDB\Client("mongodb://localhost:27017");

            // Seleccionar la base de datos 'BDContador'
            $this->database = $this->mongoClient->BDContador;

            // Seleccionar la colección 'user'
            $this->collection = $this->database->users;

        } catch (Exception $e) {
            echo "Error de conexión a MongoDB: " . $e->getMessage();
        }
    }

    // Método para insertar un documento en la colección 'user'
    public function insertarUsuario($datosUsuario) {
        try {
            $result = $this->collection->insertOne($datosUsuario);
            return $result->getInsertedId(); // Retorna el ID del documento insertado
        } catch (Exception $e) {
            echo "Error al insertar usuario: " . $e->getMessage();
        }
    }

    // Método para obtener todos los documentos de la colección 'user'
    public function obtenerUsuarios() {
        try {
            $usuarios = $this->collection->find();
            return $usuarios->toArray(); // Convertir el resultado a un array
        } catch (Exception $e) {
            echo "Error al obtener usuarios: " . $e->getMessage();
        }
    }

    // Método para actualizar un documento en la colección 'user' basado en el ID
    public function actualizarUsuario($id, $datosActualizados) {
        try {
            $result = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)], // Filtro
                ['$set' => $datosActualizados] // Datos que se actualizarán
            );
            return $result->getModifiedCount(); // Retorna el número de documentos modificados
        } catch (Exception $e) {
            echo "Error al actualizar usuario: " . $e->getMessage();
        }
    }

    // Método para eliminar un documento de la colección 'user' basado en el ID
    public function eliminarUsuario($id) {
        try {
            $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            return $result->getDeletedCount(); // Retorna el número de documentos eliminados
        } catch (Exception $e) {
            echo "Error al eliminar usuario: " . $e->getMessage();
        }
    }
}
