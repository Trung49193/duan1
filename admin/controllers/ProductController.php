<?php
require_once '../config/database.php';

class ProductController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        // Số sản phẩm trên mỗi trang
        $limit = 5;
        // Trang hiện tại (mặc định là 1)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page); // Đảm bảo trang không nhỏ hơn 1
        $offset = ($page - 1) * $limit;

        // Tìm kiếm
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        if ($search) {
            $query = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.name LIKE :search LIMIT :offset, :limit";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':search', '%' . $search . '%');
        } else {
            $query = "SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id LIMIT :offset, :limit";
            $stmt = $this->db->prepare($query);
        }
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tính tổng số sản phẩm để tạo phân trang
        $totalQuery = $search ? "SELECT COUNT(*) FROM products WHERE name LIKE :search" : "SELECT COUNT(*) FROM products";
        $totalStmt = $this->db->prepare($totalQuery);
        if ($search) {
            $totalStmt->bindValue(':search', '%' . $search . '%');
        }
        $totalStmt->execute();
        $totalProducts = $totalStmt->fetchColumn();
        $totalPages = ceil($totalProducts / $limit);

        $viewPath = __DIR__ . '/../views/product/index.php';
        if (!file_exists($viewPath)) {
            die("Error: Product index view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function add() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $stock = $_POST['stock'];
            $image = $_POST['image'];

            $query = "INSERT INTO products (category_id, name, price, description, image, stock) VALUES (:category_id, :name, :price, :description, :image, :stock)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':stock', $stock);
            if ($stmt->execute()) {
                header('Location: ?controller=product&action=index');
                exit();
            }
        }
        $viewPath = __DIR__ . '/../views/product/add.php';
        if (!file_exists($viewPath)) {
            die("Error: Add product view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function edit() {
        $id = $_GET['id'];
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $stock = $_POST['stock'];
            $image = $_POST['image'];

            $query = "UPDATE products SET category_id = :category_id, name = :name, price = :price, description = :description, image = :image, stock = :stock WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                header('Location: ?controller=product&action=index');
                exit();
            }
        }
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        $viewPath = __DIR__ . '/../views/product/edit.php';
        if (!file_exists($viewPath)) {
            die("Error: Edit product view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function delete() {
        $id = $_GET['id'];
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: ?controller=product&action=index');
        exit();
    }
}
?>