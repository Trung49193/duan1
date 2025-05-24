<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Cửa hàng điện thoại</title>
    <link rel="stylesheet" href="/duan1/assets/css/style.css">
</head>
<body>
    <header>
        <h1>Cửa hàng điện thoại</h1>
        <nav>
            <a href="?controller=home&action=index">Trang chủ</a>
            <a href="?controller=product&action=list">Sản phẩm</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="?controller=user&action=logout">Đăng xuất</a>
            <?php else: ?>
                <a href="?controller=user&action=login">Đăng nhập</a>
                <a href="?controller=user&action=register">Đăng ký</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <h2>Sản phẩm nổi bật</h2>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="../../../assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Giá: $<?php echo $product['price']; ?></p>
                    <a href="?controller=product&action=detail&id=<?php echo $product['id']; ?>">Xem chi tiết</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>© 2025 Cửa hàng điện thoại</p>
    </footer>
</body>
</html>