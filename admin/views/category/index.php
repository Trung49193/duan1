<?php
$pageTitle = "Quản lý Danh mục";
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
        <h3 class="mb-0 text-dark">Danh sách Danh mục</h3>
        <a href="?controller=category&action=add" class="btn btn-success"><i class="fas fa-plus me-1"></i> Thêm Danh mục</a>
    </div>
    <div class="card-body">
        <!-- Thanh tìm kiếm -->
        <form method="GET" class="mb-4">
            <input type="hidden" name="controller" value="category">
            <input type="hidden" name="action" value="index">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm danh mục..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search me-1"></i> Tìm kiếm</button>
            </div>
        </form>

        <!-- Thông báo và bảng -->
        <?php if (empty($categories)): ?>
            <div class="alert alert-info">
                <?php echo isset($_GET['search']) && $_GET['search'] ? 'Không tìm thấy danh mục phù hợp với từ khóa "' . htmlspecialchars($_GET['search']) . '".' : 'Không có danh mục nào. Hãy thêm danh mục mới!'; ?>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Tên Danh mục</th>
                            <th class="text-center">Ngày Tạo</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td class="text-center"><?php echo $category['id']; ?></td>
                                <td><?php echo htmlspecialchars($category['name']); ?></td>
                                <td class="text-center"><?php echo $category['created_at']; ?></td>
                                <td class="text-center">
                                    <a href="?controller=category&action=edit&id=<?php echo $category['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                    <a href="?controller=category&action=delete&id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fas fa-trash"></i> Xóa</a>
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
                        <a class="page-link" href="?controller=category&action=index&page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Trước</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?controller=category&action=index&page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?controller=category&action=index&page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Sau</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>