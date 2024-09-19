<?php
// config/database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'soluciones_contables';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name.";charset=utf8", $this->username, $this->password);
            // Configurar el modo de error de PDO a excepción
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception){
            echo "Error de conexión: " . $exception->getMessage();
            exit;
        }

        return $this->conn;
    }
}
?>