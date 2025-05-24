<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Cửa hàng điện thoại</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/duan1/assets/css/style.css">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="top-links">
                <a href="#">Mở cửa hàng trực tiếp</a>
                <a href="#">Bộ phận Hỗ trợ Miền Bắc</a>
                <a href="#">Chức Lương Đăng Bảo</a>
            </div>
        </div>
        <div class="main-header">
            <div class="logo">
                <h1>XTMOBILE</h1>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Tìm kiếm sản phẩm, thương hiệu...">
                <button type="submit">🔍</button>
            </div>
            <div class="user-actions">
                <a href="#" class="cart">🛒 Giỏ hàng</a>
                <a href="#" class="account">👤 Tài khoản</a>
            </div>
        </div>
        <nav class="category-nav">
            <a href="#">iPhone 16</a>
            <a href="#">Samsung S23</a>
            <a href="#">iPhone 15 Pro Max</a>
            <a href="#">iPhone 14</a>
            <a href="#">Samsung S24 Ultra</a>
            <a href="#">iPhone 13</a>
            <a href="#">iPhone 11</a>
        </nav>
    </header>
    <main>
        <div class="banner">
            <div class="banner-content">
                <h2>MUA IỚ iPHONE 16</h2>
                <p>Chỉ từ 16.489.000đ</p>
                <p>Thu cũ 90% - Trả góp 0% lãi suất</p>
                <button>Mua ngay</button>
            </div>
            <img src="../../../assets/images/banner-iphone16.jpg" alt="iPhone 16 Banner">
        </div>
        <section class="hot-products">
            <h2>Sản phẩm nổi bật</h2>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <img src="../../../assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
                        <a href="?controller=product&action=detail&id=<?php echo $product['id']; ?>">Xem chi tiết</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="promo-section">
            <div class="promo-item">
                <img src="../../../assets/images/promo-smartwatch.jpg" alt="Smart Watch">
                <h3>SMART WATCH</h3>
                <p>Chỉ từ 979.000đ</p>
            </div>
            <div class="promo-item">
                <img src="../../../assets/images/promo-iphone-old.jpg" alt="iPhone Cũ">
                <h3>IPHONE CŨ</h3>
                <p>Giảm cực sốc - 95% OFF</p>
            </div>
            <div class="promo-item">
                <img src="../../../assets/images/promo-samsung.jpg" alt="Samsung Sale">
                <h3>ĐẠI TIỆC SAMSUNG</h3>
                <p>Sale kịch trần - Deal đỉnh nhất</p>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2025 Cửa hàng điện thoại</p>
    </footer>
</body>
</html>