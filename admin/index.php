<?php
session_start();

// Debug: Kiểm tra session
if (!isset($_SESSION['user'])) {
    echo "Debug: Session user not set.<br>";
} else {
    echo "Debug: Session user: " . print_r($_SESSION['user'], true) . "<br>";
}

// Không chuyển hướng nếu đang ở trang đăng nhập
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'category';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
if ($controller === 'user' && $action === 'login') {
    // Không làm gì, để UserController xử lý
} else {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: ?controller=user&action=login');
        exit();
    }
}

require_once '../config/database.php';

$controllerFile = "controllers/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . "Controller";
    $controllerInstance = new $controllerClass();
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        echo "Action not found!";
    }
} else {
    echo "Controller not found!";
}
?>