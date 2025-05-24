<?php
$pageTitle = "Thanh toán";
$content = __FILE__;
// Kiểm tra file trước khi include
$layoutPath = __DIR__ . '/../layout.php';
if (!file_exists($layoutPath)) {
    die("Error: Layout file not found at: " . $layoutPath);
}
require_once $layoutPath;
?>

<div class="container">
    <h2 class="mb-4">Thanh toán</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Thông tin khách hàng</h4>
            <form method="POST" action="?controller=checkout&action=placeOrder">
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                </div>
                <div class="mb-3">
                    <label for="customer_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                </div>
                <div class="mb-3">
                    <label for="customer_phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                </div>
                <div class="mb-3">
                    <label for="customer_address" class="form-label">Địa chỉ giao hàng</label>
                    <textarea class="form-control" id="customer_address" name="customer_address" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phương thức thanh toán</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="COD" checked disabled>
                        <label class="form-check-label">Thanh toán khi nhận hàng (COD)</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success"><i class="fas fa-money-check-alt me-1"></i> Đặt hàng</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Đơn hàng của bạn</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Tên Sản phẩm</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($products as $product):
                            $quantity = $_SESSION['cart'][$product['id']];
                            $subtotal = $product['price'] * $quantity;
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td class="text-center"><?php echo number_format($product['price'], 2); ?></td>
                                <td class="text-center"><?php echo $quantity; ?></td>
                                <td class="text-center"><?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                            <td class="text-center fw-bold"><?php echo number_format($total, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>