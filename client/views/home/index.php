<?php
$pageTitle = "Trang chủ";
$content = __FILE__;
// Kiểm tra file trước khi include
$layoutPath = __DIR__ . '/../layout.php';
if (!file_exists($layoutPath)) {
    die("Error: Layout file not found at: " . $layoutPath);
}
require_once $layoutPath;
?>

<div class="container">
    <!-- Top bar -->
    <div class="top-bar mb-3">
        <div class="top-links">
            <a href="#" class="top-link"><i class="fas fa-store me-1"></i> Mở cửa hàng trực tiếp</a>
            <a href="#" class="top-link"><i class="fas fa-headset me-1"></i> Bộ phận Hỗ trợ Miền Bắc</a>
            <a href="#" class="top-link"><i class="fas fa-shield-alt me-1"></i> Chức Lương Đăng Bảo</a>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="category-nav mb-4">
        <a href="#" class="category-link <?php echo isset($_GET['category']) && $_GET['category'] == 'iphone16' ? 'active' : ''; ?>">iPhone 16</a>
        <a href="#" class="category-link <?php echo isset($_GET['category']) && $_GET['category'] == 'samsungs23' ? 'active' : ''; ?>">Samsung S23</a>
        <a href="#" class="category-link <?php echo isset($_GET['category']) && $_GET['category'] == 'iphone15promax' ? 'active' : ''; ?>">iPhone 15 Pro Max</a>
        <a href="#" class="category-link <?php echo isset($_GET['category']) && $_GET['category'] == 'iphone14' ? 'active' : ''; ?>">iPhone 14</a>
        <a href="#" class="category-link <?php echo isset($_GET['category']) && $_GET['category'] == 'samsungs24ultra' ? 'active' : ''; ?>">Samsung S24 Ultra</a>
        <a href="#" class="category-link <?php echo isset($_GET['category']) && $_GET['category'] == 'iphone13' ? 'active' : ''; ?>">iPhone 13</a>
        <a href="#" class="category-link <?php echo isset($_GET['category']) && $_GET['category'] == 'iphone11' ? 'active' : ''; ?>">iPhone 11</a>
    </nav>

    <!-- Banner -->
    <div class="banner mb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="banner-content">
                    <h2 class="banner-title">MUA NGAY iPHONE 16</h2>
                    <p class="fs-5 banner-price">Chỉ từ 16.489.000đ</p>
                    <p class="banner-offer">Thu cũ 90% - Trả góp 0% lãi suất</p>
                    <a href="?controller=product&action=detail&id=1" class="btn btn-primary btn-lg banner-btn">Mua ngay</a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="/duan1/assets/images/banner-iphone16.jpg" alt="iPhone 16 Banner" class="img-fluid rounded banner-image">
            </div>
        </div>
    </div>

    <!-- Sản phẩm nổi bật -->
    <section class="hot-products mb-5">
        <h2 class="mb-4">Sản phẩm nổi bật</h2>
        <?php if (empty($products)): ?>
            <div class="alert alert-info">
                <?php echo isset($_GET['search']) && $_GET['search'] ? 'Không tìm thấy sản phẩm phù hợp với từ khóa "' . htmlspecialchars($_GET['search']) . '".' : 'Không có sản phẩm nào.'; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 product-card">
                            <?php if ($index < 3): ?>
                                <span class="hot-badge">Hot</span>
                            <?php endif; ?>
                            <img src="/duan1/assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text text-danger fw-bold">Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
                                <div class="d-flex justify-content-between">
                                    <a href="?controller=product&action=detail&id=<?php echo $product['id']; ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                                    <form method="POST" action="?controller=cart&action=add">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- Khuyến mãi -->
    <section class="promo-section">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="promo-item card shadow-sm">
                    <img src="/duan1/assets/images/promo-smartwatch.jpg" alt="Smart Watch" class="card-img-top promo-image">
                    <div class="card-body text-center">
                        <h3 class="card-title">SMART WATCH</h3>
                        <p class="card-text">Chỉ từ 979.000đ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="promo-item card shadow-sm">
                    <img src="/duan1/assets/images/promo-iphone-old.jpg" alt="iPhone Cũ" class="card-img-top promo-image">
                    <div class="card-body text-center">
                        <h3 class="card-title">IPHONE CŨ</h3>
                        <p class="card-text">Giảm cực sốc - 95% OFF</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="promo-item card shadow-sm">
                    <img src="/duan1/assets/images/promo-samsung.jpg" alt="Samsung Sale" class="card-img-top promo-image">
                    <div class="card-body text-center">
                        <h3 class="card-title">ĐẠI TIỆC SAMSUNG</h3>
                        <p class="card-text">Sale kịch trần - Deal đỉnh nhất</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>