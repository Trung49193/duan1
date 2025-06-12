// client/controllers/productController.php
<?php
require_once "config/database.php";
require_once "models/ProductModel.php";

function product_detail() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product = getProductById($id); // model gọi DB

        if ($product) {
            include "views/product/detail.php";
        } else {
            echo "Sản phẩm không tồn tại.";
        }
    } else {
        echo "Thiếu ID sản phẩm.";
    }
}
?>
