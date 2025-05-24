<?php
require_once '../config/database.php';

class HomeController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        $query = "SELECT * FROM products LIMIT 10";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Sử dụng đường dẫn tuyệt đối
        $viewPath = __DIR__ . '/../views/home/index.php';
        if (!file_exists($viewPath)) {
            die("View file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }
}
?>