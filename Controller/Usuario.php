<?php
// Controller/Usuario.php
require_once __DIR__ . '/../Model/Usuario.php';
require_once __DIR__ . '/../conexion.php';

class UsuarioController {
    private $userModel;
    private $db;

    public function __construct() {
        $database = new Database(); //creamos una instancia de la clase Database (conexion.php)
        $this->db = $database->getConnection(); //obtenemos la conexión
        $this->userModel = new Usuario($this->db); //creamos una instancia de la clase Usuario (Model/Usuario.php)
    }

    public function register($data) {
        // Validate input data
        if (empty($data['nombre']) || empty($data['email']) || empty($data['password'])) {
            return [
                'success' => false,
                'message' => 'Todos los campos son requeridos'
            ];
        }

        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => 'Formato de email inválido'
            ];
        }

        // Check if email already exists
        $this->userModel->email = $data['email'];
        if ($this->userModel->emailExiste()) {
            return [
                'success' => false,
                'message' => 'El email ya está registrado'
            ];
        }

        // Set user data
        $this->userModel->nombre = $data['nombre'];
        $this->userModel->password = $data['password'];
        $this->userModel->rol = 'usuario'; // Default role

        // Create user
        if ($this->userModel->crear()) {
            return [
                'success' => true,
                'message' => 'Usuario registrado exitosamente'
            ];
        }

        return [
            'success' => false,
            'message' => 'Error al registrar usuario'
        ];
    }

    public function login($email, $password) {
        $query = "SELECT id, nombre, password, rol FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['nombre'];
                $_SESSION['user_rol'] = $row['rol'];
                
                return [
                    'success' => true,
                    'message' => 'Login exitoso'
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Email o contraseña incorrectos'
        ];
    }

    public function logout() {
        session_start();
        session_destroy();
        return [
            'success' => true,
            'message' => 'Sesión cerrada'
        ];
    }

    public function getCurrentUser() {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'nombre' => $_SESSION['user_name'],
            'rol' => $_SESSION['user_rol']
        ];
    }
}
?>