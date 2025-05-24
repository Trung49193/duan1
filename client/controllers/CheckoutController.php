<?php
require_once '../config/database.php';

class CheckoutController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        if (empty($_SESSION['cart'])) {
            header('Location: ?controller=cart&action=index');
            exit();
        }

        $cart = $_SESSION['cart'];
        $products = [];
        if (!empty($cart)) {
            $product_ids = array_keys($cart);
            $query = "SELECT * FROM products WHERE id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")";
            $stmt = $this->db->prepare($query);
            $stmt->execute($product_ids);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $viewPath = __DIR__ . '/../views/checkout/index.php';
        if (!file_exists($viewPath)) {
            die("Error: Checkout index view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_phone = $_POST['customer_phone'];
            $customer_address = $_POST['customer_address'];

            if (empty($_SESSION['cart'])) {
                header('Location: ?controller=cart&action=index');
                exit();
            }

            $cart = $_SESSION['cart'];
            $product_ids = array_keys($cart);
            $query = "SELECT * FROM products WHERE id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")";
            $stmt = $this->db->prepare($query);
            $stmt->execute($product_ids);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $total_amount = 0;
            foreach ($products as $product) {
                $quantity = $cart[$product['id']];
                $total_amount += $product['price'] * $quantity;
            }

            // Lưu đơn hàng
            $query = "INSERT INTO orders (customer_name, customer_email, customer_phone, customer_address, total_amount, payment_method) 
                      VALUES (:customer_name, :customer_email, :customer_phone, :customer_address, :total_amount, 'COD')";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':customer_name', $customer_name);
            $stmt->bindParam(':customer_email', $customer_email);
            $stmt->bindParam(':customer_phone', $customer_phone);
            $stmt->bindParam(':customer_address', $customer_address);
            $stmt->bindParam(':total_amount', $total_amount);
            $stmt->execute();
            $order_id = $this->db->lastInsertId();

            // Lưu chi tiết đơn hàng
            foreach ($products as $product) {
                $quantity = $cart[$product['id']];
                $price = $product['price'];
                $query = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                          VALUES (:order_id, :product_id, :quantity, :price)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':order_id', $order_id);
                $stmt->bindParam(':product_id', $product['id']);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->bindParam(':price', $price);
                $stmt->execute();
            }

            // Xóa giỏ hàng sau khi đặt hàng
            unset($_SESSION['cart']);

            // Chuyển hướng đến trang xác nhận
            header('Location: ?controller=checkout&action=success');
            exit();
        }
    }

    public function success() {
        $viewPath = __DIR__ . '/../views/checkout/success.php';
        if (!file_exists($viewPath)) {
            die("Error: Checkout success view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }
}
?>