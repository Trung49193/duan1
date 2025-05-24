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
        <h2 class="mb-0">Sửa Sản phẩm</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="?controller=product&action=edit&id=<?php echo $product['id']; ?>">
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Tên Sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh (Tên file)</label>
                <input type="text" class="form-control" id="image" name="image" value="<?php echo htmlspecialchars($product['image']); ?>" placeholder="e.g., iphone14.jpg">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Số lượng trong kho</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $product['stock']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="?controller=product&action=index" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>