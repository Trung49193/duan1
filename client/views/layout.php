<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Cửa hàng điện thoại'; ?> - Cửa hàng điện thoại</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/duan1/assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Top bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-links">
                <a href="#" class="top-link"><i class="fas fa-store me-1"></i> Mở cửa hàng trực tiếp</a>
                <a href="#" class="top-link"><i class="fas fa-headset me-1"></i> Bộ phận Hỗ trợ Miền Bắc</a>
                <a href="#" class="top-link"><i class="fas fa-shield-alt me-1"></i> Chức Lương Đăng Bảo</a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="?controller=home&action=index">
                <img src="/duan1/assets/images/logo-xtmobile.png" alt="XTMOBILE Logo" class="logo-image">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($_GET['controller']) && $_GET['controller'] == 'home' ? 'active' : ''; ?>" href="?controller=home&action=index">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($_GET['controller']) && $_GET['controller'] == 'cart' ? 'active' : ''; ?>" href="?controller=cart&action=index">
                            <i class="fas fa-cart-shopping me-1"></i> Giỏ hàng
                            <?php
                            $cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
                            if ($cartCount > 0) {
                                echo '<span class="badge bg-warning text-dark ms-1">' . $cartCount . '</span>';
                            }
                            ?>
                        </a>
                    </li>
                </ul>
                <form class="d-flex my-2 my-lg-0 me-3 search-form" method="GET" action="?controller=home&action=index">
                    <input type="hidden" name="controller" value="home">
                    <input type="hidden" name="action" value="index">
                    <input class="form-control me-2" type="search" name="search" placeholder="Tìm kiếm sản phẩm, thương hiệu..." aria-label="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="btn btn-outline-light search-btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="?controller=user&action=logout">Đăng xuất</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isset($_GET['controller']) && $_GET['controller'] == 'user' && $_GET['action'] == 'login' ? 'active' : ''; ?>" href="?controller=user&action=login"><i class="fas fa-sign-in-alt me-1"></i> Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isset($_GET['controller']) && $_GET['controller'] == 'user' && $_GET['action'] == 'register' ? 'active' : ''; ?>" href="?controller=user&action=register"><i class="fas fa-user-plus me-1"></i> Đăng ký</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content flex-grow-1 mt-4">
        <?php
        if (isset($content) && file_exists($content) && $content !== __FILE__) {
            require_once $content;
        } else {
            echo "Error: Invalid content file or recursive include detected.";
        }
        ?>
    </div>

    <footer class="footer bg-dark text-white">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-3">XTMOBILE</h5>
                    <p>Chuyên cung cấp điện thoại chính hãng, giá tốt nhất thị trường.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-3">Liên hệ</h5>
                    <p><i class="fas fa-phone me-2"></i> Hotline: 0123 456 789</p>
                    <p><i class="fas fa-envelope me-2"></i> Email: support@xtmobile.com</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Địa chỉ: 123 Đường Điện Tử, TP.HCM</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-3">Theo dõi chúng tôi</h5>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <p class="text-center mb-0">© 2025 Cửa hàng điện thoại. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>