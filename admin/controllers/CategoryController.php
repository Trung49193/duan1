<?php
require_once '../config/database.php';

class CategoryController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        if (!$this->db) {
            die("Database connection failed.");
        }
    }

    public function index() {
        // Số danh mục trên mỗi trang
        $limit = 5;
        // Trang hiện tại (mặc định là 1)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page); // Đảm bảo trang không nhỏ hơn 1
        $offset = ($page - 1) * $limit;

        // Tìm kiếm
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        if ($search) {
            $query = "SELECT * FROM categories WHERE name LIKE :search LIMIT :offset, :limit";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':search', '%' . $search . '%');
        } else {
            $query = "SELECT * FROM categories LIMIT :offset, :limit";
            $stmt = $this->db->prepare($query);
        }
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Tính tổng số danh mục để tạo phân trang
        $totalQuery = $search ? "SELECT COUNT(*) FROM categories WHERE name LIKE :search" : "SELECT COUNT(*) FROM categories";
        $totalStmt = $this->db->prepare($totalQuery);
        if ($search) {
            $totalStmt->bindValue(':search', '%' . $search . '%');
        }
        $totalStmt->execute();
        $totalCategories = $totalStmt->fetchColumn();
        $totalPages = ceil($totalCategories / $limit);

        $viewPath = __DIR__ . '/../views/category/index.php';
        if (!file_exists($viewPath)) {
            die("Error: Category index view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $query = "INSERT INTO categories (name) VALUES (:name)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            if ($stmt->execute()) {
                header('Location: ?controller=category&action=index');
                exit();
            }
        }
        $viewPath = __DIR__ . '/../views/category/add.php';
        if (!file_exists($viewPath)) {
            die("Error: Add category view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function edit() {
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $query = "UPDATE categories SET name = :name WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                header('Location: ?controller=category&action=index');
                exit();
            }
        }
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        $viewPath = __DIR__ . '/../views/category/edit.php';
        if (!file_exists($viewPath)) {
            die("Error: Edit category view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function delete() {
        $id = $_GET['id'];

        // Kiểm tra xem có sản phẩm nào thuộc danh mục này không
        $checkQuery = "SELECT COUNT(*) FROM products WHERE category_id = :id";
        $checkStmt = $this->db->prepare($checkQuery);
        $checkStmt->bindParam(':id', $id);
        $checkStmt->execute();
        $productCount = $checkStmt->fetchColumn();

        if ($productCount > 0) {
            // Nếu có sản phẩm, chuyển hướng về trang danh sách với thông báo lỗi
            header('Location: ?controller=category&action=index&error=' . urlencode('Không thể xóa danh mục này vì có ' . $productCount . ' sản phẩm thuộc danh mục.'));
            exit();
        }

        // Nếu không có sản phẩm, tiến hành xóa danh mục
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: ?controller=category&action=index');
        exit();
    }
}
?>