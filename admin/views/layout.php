<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Cửa hàng điện thoại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar bg-primary text-white">
            <div class="sidebar-header p-3 text-center">
                <h3 class="fs-4 fw-bold">Admin Panel</h3>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo isset($_GET['controller']) && $_GET['controller'] == 'category' ? 'active' : ''; ?>" href="?controller=category&action=index">
                        <i class="fas fa-list me-2"></i> Quản lý Danh mục
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo isset($_GET['controller']) && $_GET['controller'] == 'product' ? 'active' : ''; ?>" href="?controller=product&action=index">
                        <i class="fas fa-box me-2"></i> Quản lý Sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo isset($_GET['controller']) && $_GET['controller'] == 'order' ? 'active' : ''; ?>" href="?controller=order&action=index">
                        <i class="fas fa-shopping-cart me-2"></i> Quản lý Đơn hàng
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="?controller=user&action=logout">
                        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Nội dung chính -->
        <div class="main-content flex-grow-1">
            <!-- Header -->
            <header class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-primary"><?php echo isset($pageTitle) ? $pageTitle : 'Trang quản trị'; ?></h2>
                <div class="user-info d-flex align-items-center">
                    <i class="fas fa-user-circle me-2 text-primary"></i>
                    <span class="fw-medium"><?php echo isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : 'Admin'; ?></span>
                </div>
            </header>

            <!-- Nội dung -->
            <div class="content p-4">
                <?php
                // Debug: Kiểm tra file nội dung
                echo "Debug: Content file path: " . (isset($content) ? $content : 'Not set') . "<br>";
                if (isset($content) && file_exists($content) && $content !== __FILE__) {
                    require_once $content;
                } else {
                    echo "Error: Invalid content file or recursive include detected.";
                }
                ?>
            </div>

            <!-- Footer -->
            <footer class="bg-white p-3 text-center text-muted">
                <p class="mb-0">© 2025 Cửa hàng điện thoại. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>