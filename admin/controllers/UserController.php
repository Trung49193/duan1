<?php
require_once '../config/database.php';

class UserController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        if (!$this->db) {
            die("Database connection failed.");
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    if ($user['role'] === 'admin') {
                        header('Location: ?controller=category&action=index');
                    } else {
                        header('Location: ../client/?controller=home&action=index');
                    }
                    exit();
                } else {
                    $error = "Sai mật khẩu!";
                }
            } else {
                $error = "Sai tên đăng nhập!";
            }
        }

        $viewPath = __DIR__ . '/../views/login.php';
        if (!file_exists($viewPath)) {
            die("Error: Login view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function logout() {
        session_destroy();
        header('Location: ?controller=user&action=login');
        exit();
    }
}
?>