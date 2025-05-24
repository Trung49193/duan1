<?php
$pageTitle = "Giỏ hàng";
$content = __FILE__;
// Kiểm tra file trước khi include
$layoutPath = __DIR__ . '/../layout.php';
if (!file_exists($layoutPath)) {
    die("Error: Layout file not found at: " . $layoutPath);
}
require_once $layoutPath;
?>

<div class="container">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>
    <?php if (empty($products)): ?>
        <div class="alert alert-info">Giỏ hàng của bạn đang trống. <a href="?controller=home&action=index">Mua sắm ngay!</a></div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Tên Sản phẩm</th>
                        <th class="text-center">Giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Tổng</th>
                        <th class="text-center">Hành động</th>
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
                            <td class="text-center">
                                <form method="POST" action="?controller=cart&action=update" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" class="form-control d-inline-block w-auto" style="width: 80px;">
                                    <button type="submit" class="btn btn-primary btn-sm ms-1"><i class="fas fa-sync-alt"></i></button>
                                </form>
                            </td>
                            <td class="text-center"><?php echo number_format($subtotal, 2); ?></td>
                            <td class="text-center">
                                <a href="?controller=cart&action=remove&product_id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                        <td class="text-center fw-bold"><?php echo number_format($total, 2); ?></td>
                        <td class="text-center">
                            <a href="?controller=checkout&action=index" class="btn btn-success"><i class="fas fa-money-check-alt me-1"></i> Thanh toán</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>