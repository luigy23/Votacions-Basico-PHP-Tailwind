<?php
require_once __DIR__ . '/../Model/Candidato.php';
require_once __DIR__ . '/../conexion.php';

class CandidatoController {
    private $candidatoModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->candidatoModel = new CandidatoModel($this->db);
    }

    public function create($data) {
        if (empty($data['nombre']) || empty($data['descripcion']) || empty($data['partido'])) {
            return [
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ];
        }

        $this->candidatoModel->nombre = $data['nombre'];
        $this->candidatoModel->descripcion = $data['descripcion'];
        $this->candidatoModel->partido = $data['partido'];
        $this->candidatoModel->estado = 'activo';

        if ($this->candidatoModel->crear()) {
            return [
                'success' => true,
                'message' => 'Candidato creado exitosamente'
            ];
        }

        return [
            'success' => false,
            'message' => 'Error al crear candidato'
        ];
    }

    public function update($data) {
        if (empty($data['id']) || empty($data['nombre']) || empty($data['descripcion']) || empty($data['partido'])) {
            return [
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ];
        }

        $this->candidatoModel->id = $data['id'];
        $this->candidatoModel->nombre = $data['nombre'];
        $this->candidatoModel->descripcion = $data['descripcion'];
        $this->candidatoModel->partido = $data['partido'];
        $this->candidatoModel->estado = 'activo';

        if ($this->candidatoModel->actualizar()) {
            return [
                'success' => true,
                'message' => 'Candidato actualizado exitosamente'
            ];
        }

        return [
            'success' => false,
            'message' => 'Error al actualizar candidato'
        ];
    }

    public function delete($id) {
        if (empty($id)) {
            return [
                'success' => false,
                'message' => 'ID del candidato es requerido'
            ];
        }

        $this->candidatoModel->id = $id;

        if ($this->candidatoModel->eliminar()) {
            return [
                'success' => true,
                'message' => 'Candidato eliminado exitosamente'
            ];
        }

        return [
            'success' => false,
            'message' => 'Error al eliminar candidato'
        ];
    }

    public function getAll() {
        return $this->candidatoModel->leerTodos();
    }

    public function getById($id) {
        if (empty($id)) {
            return null;
        }

        return $this->candidatoModel->leer($id);
    }
}
?>