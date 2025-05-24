<?php
require_once '../config/database.php';

class OrderController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        $query = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $viewPath = __DIR__ . '/../views/order/index.php';
        if (!file_exists($viewPath)) {
            die("Error: Order index view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }
}
?>