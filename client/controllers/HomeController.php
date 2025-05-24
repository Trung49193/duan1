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

        require_once '../views/home/index.php';
    }
}
?>