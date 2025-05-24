<?php
require_once '../config/database.php';

class CartController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function index() {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $products = [];

        if (!empty($cart)) {
            $product_ids = array_keys($cart);
            $query = "SELECT * FROM products WHERE id IN (" . implode(',', array_fill(0, count($product_ids), '?')) . ")";
            $stmt = $this->db->prepare($query);
            $stmt->execute($product_ids);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $viewPath = __DIR__ . '/../views/cart/index.php';
        if (!file_exists($viewPath)) {
            die("Error: Cart index view file not found at: " . $viewPath);
        }
        require_once $viewPath;
    }

    public function add() {
        if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }

            header('Location: ?controller=cart&action=index');
            exit();
        }
    }

    public function update() {
        if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];

            if ($quantity <= 0) {
                unset($_SESSION['cart'][$product_id]);
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }

            header('Location: ?controller=cart&action=index');
            exit();
        }
    }

    public function remove() {
        if (isset($_GET['product_id'])) {
            $product_id = (int)$_GET['product_id'];
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
            header('Location: ?controller=cart&action=index');
            exit();
        }
    }
}
?>