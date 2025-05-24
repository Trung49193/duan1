<?php
// index.php
session_start();
require_once 'controllers/HomeController.php';

$controller = new HomeController();
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'login':
        $controller->showLogin();
        break;
    case 'register':
        $controller->showRegister();
        break;
    case 'handleLogin':
        $controller->handleLogin();
        break;
    case 'handleRegister':
        $controller->handleRegister();
        break;
    case 'logout':
        $controller->handleLogout();
        break;
    case 'home':
    default:
        $controller->index();
        break;
}
?>