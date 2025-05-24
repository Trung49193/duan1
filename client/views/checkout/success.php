<?php
$pageTitle = "Đặt hàng thành công";
$content = __FILE__;
// Kiểm tra file trước khi include
$layoutPath = __DIR__ . '/../layout.php';
if (!file_exists($layoutPath)) {
    die("Error: Layout file not found at: " . $layoutPath);
}
require_once $layoutPath;
?>

<div class="container">
    <h2 class="mb-4">Đặt hàng thành công</h2>
    <div class="alert alert-success">
        Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đã được ghi nhận và sẽ được giao trong thời gian sớm nhất.
    </div>
    <a href="?controller=home&action=index" class="btn btn-primary"><i class="fas fa-home me-1"></i> Quay lại trang chủ</a>
</div>