<?php
// controllers/HomeController.php
require_once '../commons/function.php';


class HomeController {
    public function index() {
        $filePath = '../views/home.php';
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            die("File home.php not found at: " . realpath($filePath));
        }
    }

    public function showLogin() {
        require_once '../views/login.php';
    }

    public function showRegister() {
        require_once '../views/register.php';
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (registerUser($email, $password)) {
                header("Location: ?action=login&success=Registration successful! Please login.");
            } else {
                header("Location: ?action=register&error=Registration failed!");
            }
        }
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (loginUser($email, $password)) {
                $_SESSION['user'] = $email;
                header("Location: ?action=home");
            } else {
                header("Location: ?action=login&error=Invalid email or password!");
            }
        }
    }

    public function handleLogout() {
        logoutUser();
        header("Location: ?action=login");
    }
}
?>