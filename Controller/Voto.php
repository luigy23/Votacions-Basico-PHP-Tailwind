<?php
// Controller/Voto.php
require_once __DIR__ . '/../Model/Voto.php';

class VotoController {
    private $votoModel;

    public function __construct($db) {
        $this->votoModel = new Voto($db);
    }

    public function castVote($usuario_id, $candidato_id) {
        // Check if user has already voted
        if ($this->votoModel->hasUserVoted($usuario_id)) {
            return [
                'success' => false,
                'message' => 'Ya has votado.'
            ];
        }

        // Record the vote
        $this->votoModel->usuario_id = $usuario_id;
        $this->votoModel->candidato_id = $candidato_id;

        if ($this->votoModel->crear()) {
            return [
                'success' => true,
                'message' => 'Tu voto ha sido registrado correctamente.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Error al registrar el voto.'
        ];
    }
}