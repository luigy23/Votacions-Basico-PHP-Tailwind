<?php
class CandidatoModel {
    private $conn;
    private $table = 'candidatos';

    // Propiedades
    public $id;
    public $nombre;
    public $descripcion;
    public $partido;
    public $estado;
    public $created_at;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear candidato
    public function crear() {
        $query = "INSERT INTO " . $this->table . " 
                (nombre, descripcion, partido, estado, created_at) 
                VALUES (:nombre, :descripcion, :partido, :estado, NOW())";
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->partido = htmlspecialchars(strip_tags($this->partido));
        $this->estado = htmlspecialchars(strip_tags($this->estado));

        // Vincular valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":partido", $this->partido);
        $stmt->bindParam(":estado", $this->estado);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Leer todos los candidatos
    public function leerTodos() {
        $query = "SELECT * FROM " . $this->table ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un candidato
    public function leer($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar candidato
    public function actualizar() {
        $query = "UPDATE " . $this->table . "
                SET nombre = :nombre,
                    descripcion = :descripcion,
                    partido = :partido,
                    estado = :estado
                WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->partido = htmlspecialchars(strip_tags($this->partido));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Vincular valores
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":partido", $this->partido);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar candidato
    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>