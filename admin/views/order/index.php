<?php
$pageTitle = "Danh sách Đơn hàng";
$content = __FILE__;
// Kiểm tra file trước khi include
$layoutPath = __DIR__ . '/../layout.php';
if (!file_exists($layoutPath)) {
    die("Error: Layout file not found at: " . $layoutPath);
}
require_once $layoutPath;

// Danh sách trạng thái có thể chọn
$allStatuses = ['Pending', 'Shipped', 'Delivered', 'Cancelled'];

// Hàm lọc trạng thái dựa trên trạng thái hiện tại
function getAvailableStatuses($currentStatus) {
    $allStatuses = ['Pending', 'Shipped', 'Delivered', 'Cancelled'];
    $index = array_search($currentStatus, $allStatuses);
    if ($index === false) {
        return [];
    }
    // Trả về các trạng thái sau trạng thái hiện tại
    return array_slice($allStatuses, $index + 1);
}

// Kiểm tra trạng thái cuối
$finalStatuses = ['Delivered', 'Cancelled'];
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
                            <th class="text-center">Sản phẩm</th>
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
                                <td class="text-center">
                                    <?php if (!empty($order['items'])): ?>
                                        <?php foreach ($order['items'] as $item): ?>
                                            <?php
                                            $imagePath = '/duan1/assets/images/' . htmlspecialchars($item['image']);
                                            $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;
                                            $externalLink = !empty($item['external_link']) ? $item['external_link'] : '#';
                                            ?>
                                            <?php if (file_exists($absolutePath) && !empty($item['image'])): ?>
                                                <a href="<?php echo htmlspecialchars($externalLink); ?>" target="_blank">
                                                    <img src="<?php echo $imagePath; ?>" alt="Product Image" class="order-product-image">
                                                </a>
                                                <span>(x<?php echo $item['quantity']; ?>)</span>
                                            <?php else: ?>
                                                <span class="text-muted">Hình ảnh không tồn tại</span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        Không có sản phẩm
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php echo number_format($order['total_amount'], 2); ?></td>
                                <td class="text-center">
                                    <?php if (in_array($order['status'], $finalStatuses)): ?>
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($order['status']); ?></span>
                                    <?php else: ?>
                                        <?php $availableStatuses = getAvailableStatuses($order['status']); ?>
                                        <?php if (!empty($availableStatuses)): ?>
                                            <form method="POST" action="?controller=order&action=updateStatus" class="d-flex align-items-center justify-content-center">
                                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                                <select name="status" class="form-select d-inline-block w-auto me-2">
                                                    <?php foreach ($availableStatuses as $statusOption): ?>
                                                        <option value="<?php echo $statusOption; ?>">
                                                            <?php echo htmlspecialchars($statusOption); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Bạn có chắc chắn muốn thay đổi trạng thái đơn hàng này?')">
                                                    <i class="fas fa-check me-1"></i> Xác nhận
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?php echo htmlspecialchars($order['status']); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php echo $order['created_at']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>