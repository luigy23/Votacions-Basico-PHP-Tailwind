<?php
class ResultadoModel {
    private $conn;
    private $table = 'votos';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Leer todos los resultados
    public function leerTodos() {
        $query = "SELECT c.nombre, c.partido, COUNT(v.id) as votos 
                  FROM " . $this->table . " v
                  JOIN candidatos c ON v.candidato_id = c.id
                  GROUP BY c.id, c.nombre, c.partido
                  ORDER BY votos DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un resultado por ID de candidato
    public function leer($id) {
        $query = "SELECT c.nombre, c.partido, COUNT(v.id) as votos 
                  FROM " . $this->table . " v
                  JOIN candidatos c ON v.candidato_id = c.id
                  WHERE c.id = :id
                  GROUP BY c.id, c.nombre, c.partido";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>