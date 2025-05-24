<?php
$pageTitle = "Danh sách Đơn hàng";
$content = __FILE__;
// Kiểm tra file trước khi include
$layoutPath = __DIR__ . '/../layout.php';
if (!file_exists($layoutPath)) {
    die("Error: Layout file not found at: " . $layoutPath);
}
require_once $layoutPath;
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <h3 class="mb-0 text-dark">Danh sách Đơn hàng</h3>
    </div>
    <div class="card-body">
        <?php if (empty($orders)): ?>
            <div class="alert alert-info">Không có đơn hàng nào.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th class="text-center">Tổng tiền</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Ngày đặt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="text-center"><?php echo $order['id']; ?></td>
                                <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['customer_email']); ?></td>
                                <td><?php echo htmlspecialchars($order['customer_phone']); ?></td>
                                <td><?php echo htmlspecialchars($order['customer_address']); ?></td>
                                <td class="text-center"><?php echo number_format($order['total_amount'], 2); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($order['status']); ?></td>
                                <td class="text-center"><?php echo $order['created_at']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>