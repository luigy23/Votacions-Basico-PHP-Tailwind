<?php
// Model/Voto.php
class Voto {
    private $conn;
    private $table = 'votos';

    public $id;
    public $usuario_id;
    public $candidato_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table . " (usuario_id, candidato_id) VALUES (:usuario_id, :candidato_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':candidato_id', $this->candidato_id);

        return $stmt->execute();
    }

    public function hasUserVoted($usuario_id) {
        $query = "SELECT id FROM " . $this->table . " WHERE usuario_id = :usuario_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}