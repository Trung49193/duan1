<?php
$pageTitle = "Quản lý Sản phẩm";
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
        <h3 class="mb-0 text-dark">Danh sách Sản phẩm</h3>
        <a href="?controller=product&action=add" class="btn btn-success"><i class="fas fa-plus me-1"></i> Thêm Sản phẩm</a>
    </div>
    <div class="card-body">
        <!-- Thanh tìm kiếm -->
        <form method="GET" class="mb-4">
            <input type="hidden" name="controller" value="product">
            <input type="hidden" name="action" value="index">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search me-1"></i> Tìm kiếm</button>
            </div>
        </form>

        <!-- Thông báo và bảng -->
        <?php if (empty($products)): ?>
            <div class="alert alert-info">
                <?php echo isset($_GET['search']) && $_GET['search'] ? 'Không tìm thấy sản phẩm phù hợp với từ khóa "' . htmlspecialchars($_GET['search']) . '".' : 'Không có sản phẩm nào. Hãy thêm sản phẩm mới!'; ?>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Danh mục</th>
                            <th>Tên Sản phẩm</th>
                            <th class="text-center">Giá</th>
                            <th>Mô tả</th>
                            <th>Hình ảnh</th>
                            <th class="text-center">Kho</th>
                            <th class="text-center">Ngày Tạo</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="text-center"><?php echo $product['id']; ?></td>
                                <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td class="text-center"><?php echo number_format($product['price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($product['description']); ?></td>
                                <td><?php echo htmlspecialchars($product['image']); ?></td>
                                <td class="text-center"><?php echo $product['stock']; ?></td>
                                <td class="text-center"><?php echo $product['created_at']; ?></td>
                                <td class="text-center">
                                    <a href="?controller=product&action=edit&id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                    <a href="?controller=product&action=delete&id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fas fa-trash"></i> Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Phân trang -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?controller=product&action=index&page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Trước</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?controller=product&action=index&page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?controller=product&action=index&page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Sau</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>