<?php
require_once '../config/database.php';

class OrderController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        // Lấy danh sách đơn hàng
        $query = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Lấy chi tiết đơn hàng và hình ảnh sản phẩm
        foreach ($orders as &$order) {
            $query = "SELECT od.*, p.image, p.external_link 
                      FROM order_details od 
                      JOIN products p ON od.product_id = p.id 
                      WHERE od.order_id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':order_id', $order['id']);
            $stmt->execute();
            $order['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $viewPath = __DIR__ . '/../views/order/index.php';
        if (!file_exists($viewPath)) {
            die("Error: Order index view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'];
            $status = $_POST['status'];

            $query = "UPDATE orders SET status = :status WHERE id = :order_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->execute();

            header('Location: ?controller=order&action=index');
            exit();
        }
    }
}
?>