<?php
require_once '../config/database.php';

class HomeController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        // Lấy từ khóa tìm kiếm từ query string
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        // Truy vấn sản phẩm với điều kiện tìm kiếm
        if ($search) {
            $query = "SELECT * FROM products WHERE name LIKE :search OR description LIKE :search";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':search', '%' . $search . '%');
        } else {
            $query = "SELECT * FROM products";
            $stmt = $this->db->prepare($query);
        }
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debug: Kiểm tra dữ liệu sản phẩm
        echo "Debug: Number of products found: " . count($products) . "<br>";
        echo "Debug: Products data: " . print_r($products, true) . "<br>";

        $viewPath = __DIR__ . '/../views/home/index.php';
        if (!file_exists($viewPath)) {
            die("Error: Home index view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }
}
?>