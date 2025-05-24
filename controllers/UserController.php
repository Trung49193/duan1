<?php
require_once './models/User.php';
require_once './commons/env.php';

class UserController {
    private $user;

    public function __construct() {
        global $db;
        $this->user = new User($db);
    }

    public function login() {
        include './views/login.php';
    }

    public function register() {
        include './views/register.php';
    }

    public function handleLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $this->user->login($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: index.php");
        } else {
            echo "Sai tên đăng nhập hoặc mật khẩu.";
        }
    }

    public function handleRegister() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $result = $this->user->register($username, $password, $email);
        if ($result) {
            header("Location: index.php?controller=user&action=login");
        } else {
            echo "Đăng ký thất bại. Có thể tài khoản đã tồn tại.";
        }
    }
}
