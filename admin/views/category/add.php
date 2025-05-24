<?php
$content = __FILE__;
// Kiểm tra file trước khi include
$layoutPath = __DIR__ . '/../layout.php';
if (!file_exists($layoutPath)) {
    die("Error: Layout file not found at: " . $layoutPath);
}
require_once $layoutPath;
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h2 class="mb-0">Thêm Danh mục</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="?controller=category&action=add">
            <div class="mb-3">
                <label for="name" class="form-label">Tên Danh mục</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="?controller=category&action=index" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>