<?php
// Controller/Resultados.php
require_once __DIR__ . '/../Model/Resultados.php';
require_once __DIR__ . '/../conexion.php';

class ResultadoController {
    private $resultadoModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->resultadoModel = new ResultadoModel($this->db);
    }

    public function getAll() {
        return $this->resultadoModel->leerTodos();
    }

    public function getById($id) {
        if (empty($id)) {
            return null;
        }
        return $this->resultadoModel->leer($id);
    }
}
?>