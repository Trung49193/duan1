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
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: ?controller=home&action=index');
                exit();
            } else {
                $error = "Email hoặc mật khẩu không đúng.";
            }
        }

        $viewPath = __DIR__ . '/../views/user/login.php';
        if (!file_exists($viewPath)) {
            die("Error: Login view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $phone = $_POST['phone'];

            // Debug: Check table structure
            $stmt = $this->db->query("DESCRIBE users");
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            if (!in_array('name', $columns)) {
                die("Error: The 'name' column does not exist in the 'users' table. Current columns: " . implode(', ', $columns));
            }

            $query = "INSERT INTO users (name, email, password, phone, role) VALUES (:name, :email, :password, :phone, 'client')";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':phone', $phone);

            try {
                $stmt->execute();
                header('Location: ?controller=user&action=login&success=Đăng ký thành công! Vui lòng đăng nhập.');
                exit();
            } catch (PDOException $e) {
                $error = "Lỗi đăng ký: " . $e->getMessage();
            }
        }

        $viewPath = __DIR__ . '/../views/user/register.php';
        if (!file_exists($viewPath)) {
            die("Error: Register view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location: ?controller=home&action=index');
        exit();
    }
}
?>