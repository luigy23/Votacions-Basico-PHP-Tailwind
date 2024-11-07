<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'votos';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Constructor para inicializar la conexión
    public function __construct() {
        $this->connect();
    }

    // Método para conectar a la base de datos
    private function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }

    // Método para cerrar la conexión
    public function disconnect() {
        $this->conn = null;
    }

    // Método para obtener la conexión
    public function getConnection() {
        return $this->conn;
    }
}
?>