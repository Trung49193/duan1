<?php
require_once '../config/database.php';

class UserController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email']; // Changed from 'username' to 'email'
            $password = $_POST['password'];

            $query = "SELECT * FROM users WHERE email = :email AND role = 'admin'"; // Changed 'username' to 'email', added role check
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: ?controller=category&action=index');
                exit();
            } else {
                $error = "Email hoặc mật khẩu không đúng, hoặc bạn không có quyền truy cập Admin.";
            }
        }

        $viewPath = __DIR__ . '/../views/user/login.php';
        if (!file_exists($viewPath)) {
            die("Error: Login view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location: ?controller=user&action=login');
        exit();
    }
}
?>